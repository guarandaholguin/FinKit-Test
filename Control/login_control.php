<?php
class LoginControl{
    static public function ControlRegistro(){
        if(isset($_POST["Username"])){
            if(preg_match('/^[а-яёА-ЯЁ ]+/u',$_POST["FIO"]) && preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["Username"]) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["email"]) && preg_match('/^[0-9a-zA-Z_-]+$/',$_POST["password"])){
                $tabla="usuarios";
                $token = md5($_POST["Username"]."+".$_POST["email"]);
                $encriptarPassword = crypt($_POST["password"], '$6$rounds=5000$BjoniOIpm2r4bmiNIM98f4dNJNihbIHIBYC52984khbdxZAOMn$');
                $encriptarPassword2 = crypt($_POST["password2"], '$6$rounds=5000$BjoniOIpm2r4bmiNIM98f4dNJNihbIHIBYC52984khbdxZAOMn$');
                $datos = array("profileImage_dir" => "Image/placeholder.svg",
                                "FIO" => $_POST["FIO"],
                                "token" => $token,
                                "nombre" => $_POST["Username"],
                                "email" => $_POST["email"],
                                "password" => $encriptarPassword,
                                "password2" => $encriptarPassword2,
                                "id_roles_usuarios" => 1);
                $respuesta = LoginModel::ModelRegistro($tabla, $datos);
                if ($respuesta == "ok")
                {
                    $id_usuario = LoginControl::ControlSelectRegistros("email", $_POST["email"]);
                    $id_usuario = $id_usuario["ID_sesion_usuario"];
                    $_SESSION["ID_sesion_usuario"] = $id_usuario;
                }
                return $respuesta;
            }else{
                $respuesta="error";
                return $respuesta;
            }
        }
    }

    static public function ControlSelectRegistros($item, $valor){
        $tabla = "usuarios";
        $respuesta = LoginModel::ModelSelecRegistros($tabla, $item, $valor);
        return $respuesta;
    }

    public function ControlIngreso(){
        session_start();
        if(isset($_POST["ingemail"])){
            $tabla="usuarios";
            $item="email";
            $valor=$_POST["ingemail"];
            $respuesta = LoginModel::ModelSelecRegistros($tabla, $item, $valor);
            $encriptarPassword = crypt($_POST["ingpassword"], '$6$rounds=5000$BjoniOIpm2r4bmiNIM98f4dNJNihbIHIBYC52984khbdxZAOMn$');
            if($respuesta && $respuesta["email"] == $_POST["ingemail"] && $respuesta["password"] == $encriptarPassword ){
                LoginModel::ModelIntentosFallidos($tabla, 0, $respuesta["token"]);
                $_SESSION["FIO"]= $respuesta["FIO"];
                $_SESSION["ValIngreso"] = "ok";
                $_SESSION["ID_sesion_usuario"] = $respuesta["ID_sesion_usuario"];
                $_SESSION["token"] = $respuesta["token"];
                $_SESSION["id_roles_usuarios"] = $respuesta["id_roles_usuarios"];
                switch ($_SESSION["id_roles_usuarios"]) {
                    case 1:
                        echo '<script>
                                if ( window.history.replaceState ) {
                                    window.history.replaceState( null, null, window.location.href );
                                }
                                window.location = "user";
                            </script>';
                        break;
                    case 2:
                        echo '<script>
                                if ( window.history.replaceState ) {
                                    window.history.replaceState( null, null, window.location.href );
                                }
                                window.location = "Admain";
                            </script>';
                        break;
                }
            }else{
                if($respuesta && $respuesta["intentos_fallidos"] < 3){
                    $intentos_fallidos = $respuesta["intentos_fallidos"]+1;
                    LoginModel::ModelIntentosFallidos($tabla,$intentos_fallidos, $respuesta["token"]);
                }else{
                    echo '<div class="alert alert-dark alert-dismissible fade   show" role="alert">
                            <strong>ERROR:</strong> вы превысили количество попыток...
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                }
                echo '<script>
                        if ( window.history.replaceState ) {
                            window.history.replaceState( null, null, window.location.href );
                        }
                    </script>';
                echo '<div class="alert alert-warning alert-dismissible fade    show" role="alert">
                        <strong>Пользователь</strong>  не зарегистрирован...
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';

            }

        }
    }
}
