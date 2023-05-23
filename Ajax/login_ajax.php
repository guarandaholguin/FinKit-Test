<?php
require_once ("../Control/login_control.php");
require_once ("../Model/login_model.php");
class AjaxUsuario{
    public $getUsuario;
	public $actualizarUsuario;
	public function ajaxGetUsuario(){
		session_start();
		$item = "ID_sesion_usuario";
		$valor = $_SESSION["ID_sesion_usuario"];
		$respuesta = LoginControl::ControlSelectRegistros($item, $valor);
		echo json_encode($respuesta);
	}
	public function ControlActualizar(){
		$uploadDir =__DIR__;
        $uploadDir .= '\ProfileImge\\'; 
		$dif_db ="Ajax/ProfileImge/";
        session_start();
        if(isset($_POST["tokenUsuario"])){
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["Username"]) && preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["email"])){
                    $usuario = LoginModel::ModelSelecRegistros("usuarios","token", $_SESSION["token"]);
                    if($_SESSION["token"] == $usuario["token"]){
					    $tabla="usuarios";
                        $Actualizartoken = md5($_POST["Username"]."+".$_POST["email"]);
                        $_SESSION['token'] = $Actualizartoken;
                        if(!empty($_FILES["profileImage"]["name"])){ 
                            // File path config 
                            $fileName = basename($_FILES["profileImage"]["name"]); 
                            $targetFilePath = $uploadDir . $fileName; 
                            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION); 
                            // Allow certain file formats 
                            $allowTypes = array('jpg', 'png', 'jpeg'); 
                            if(in_array($fileType, $allowTypes)){ 
                                // Upload file to the server 
                                if(move_uploaded_file($_FILES["profileImage"]["tmp_name"], $targetFilePath)){ 
									$dif_db .= $fileName;
                                    $uploadedFile = $fileName;
                                    $datos = array("ID_sesion_usuario" => $_SESSION    ["ID_sesion_usuario"],
                                        "token" => $Actualizartoken,
                                        "nombre" => $_POST["Username"],
			                	        "email" => $_POST["email"],
                                        "profileImage_dir" => $dif_db
			                	    );
                                    $respuesta = LoginModel::ModelActualizar($tabla, $datos);
                                    echo $respuesta;
                                }else{ 
                                    $respuesta = "error1";
                                    echo $respuesta;
                                } 
                            }else{ 
                                $respuesta = "error2";
					            echo $respuesta; 
                            } 
                        }
                        else{
                            $datos = array("ID_sesion_usuario" => $_SESSION    ["ID_sesion_usuario"],
                                "token" => $Actualizartoken,
                                "nombre" => $_POST["Username"],
                                "email" => $_POST["email"]
                            );
                            $respuesta = LoginModel::ModelActualizar($tabla, $datos);
                            echo $respuesta; 
                        }
				    }else{
                        $respuesta = "error";
                        echo $respuesta;
				    }
                }else{
                    $respuesta="error";
                    echo $respuesta;
            }
        }
    }
}
if(isset($_POST["getUsuario"])){
	$valUsuario = new AjaxUsuario();
	$valUsuario -> ajaxGetUsuario();
}
if(isset($_POST["actualizarUsuario"])){
	$valUsuario = new AjaxUsuario();
	$valUsuario -> ControlActualizar();
}