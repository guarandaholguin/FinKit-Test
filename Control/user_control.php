<?php
class UserControl{
    static public function IngresarEstudiante($datos)
    {
        $tabla = "estudiante";
        $respuesta = UserModel::UserModelRegistro($tabla,$datos);
    }

    static public function UserControlSeleccionar($item, $valor)
    {
        $tabla = "estudiante";
        $respuesta = UserModel::UserModelSeleccionar($tabla, $item, $valor);
        return $respuesta;
    }

    static public function UserControlActualizar(){
        if(isset($_POST["fecha_de_nacimiento"])){
            if(preg_match('/^[а-яёА-ЯЁ0-9_.+-]+/ui',$_POST["direccion"]) && preg_match('/^[0-9_.+-]+$/',$_POST["telefono"]) && preg_match('/^[а-яёА-ЯЁ]+/ui',$_POST["instituto"]) && preg_match('/^[а-яёА-ЯЁ]+/ui',$_POST["cafedra"]) && preg_match('/^[0-9]+$/',$_POST["curso"]) && preg_match('/^[а-яёА-ЯЁ0-9-]+/ui',$_POST["grupo"]) && preg_match('/^[а-яёА-ЯЁ]+/ui',$_POST["tipo_educacion"]) && preg_match('/^[а-яёА-ЯЁ]+/ui',$_POST["forma_educacion"]) && preg_match('/^[0-9_.,+-]+$/',$_POST["promedio_academico"]) && preg_match('/^[0-9a-zA-Z_-]+$/',$_POST["numero_serie_pasaporte"]) && preg_match('/^[а-яёА-ЯЁ0-9_.+-]+/ui',$_POST["emitido_por_quien"]) && preg_match('/^[0-9]+$/',$_POST["snils"]) && preg_match('/^[а-яёА-ЯЁ]+/ui',$_POST["parientes"]) && preg_match('/^[0-9_.+-]+$/',$_POST["telefono_pariente"])){
                    $tabla = "estudiante";
                    $ID_sesion_usuario = $_SESSION["ID_sesion_usuario"];
                    $datos = array("ID_sesion_usuario"=> $ID_sesion_usuario,
                                    "fecha_de_nacimiento" => $_POST           ["fecha_de_nacimiento"],
			                    	"direccion" => $_POST["direccion"],
                                    "telefono" => $_POST["telefono"],
                                    "instituto" => $_POST["instituto"],
                                    "cafedra" => $_POST["cafedra"],
                                    "tipo_educacion" => $_POST["tipo_educacion"],
                                    "forma_educacion" => $_POST["forma_educacion"],
                                    "curso" => $_POST["curso"],
                                    "grupo" => $_POST["grupo"],
                                    "promedio_academico" => $_POST["promedio_academico"],
                                    "numero_serie_pasaporte" => $_POST["numero_serie_pasaporte"],
                                    "emitido_por_quien" => $_POST["emitido_por_quien"], 
                                    "fecha_emision" => $_POST["fecha_emision"],
                                    "snils" => $_POST["snils"],
                                    "parientes" => $_POST["parientes"],
                                    "telefono_pariente" => $_POST["telefono_pariente"],
                                    "ID_tipo_genero"=>$_POST['ID_tipo_genero'],
                                );
                    $respuesta = UserModel::UserModelActualizar($tabla, $datos);
                    return $respuesta;
            }else{
                $respuesta = "error";
                return $respuesta;
            }
        }
    }

    static public function UserControlSeleccionarTipoGenero()
    {
        $respuesta = UserModel::UserModelSeleccionarTipoGenero();
        return $respuesta;
    }
}