<?php

require_once "CONNECT.php";

class LoginModel{
    /*REGISTRO*/
    static public function ModelRegistro($tabla, $datos){
        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(profileImage_dir, FIO, token, nombre, email, password, password2, id_roles_usuarios) VALUES (:profileImage_dir, :FIO, :token, :nombre, :email, :password, :password2, :id_roles_usuarios)");
        $stmt->bindParam(":profileImage_dir", $datos["profileImage_dir"], PDO::PARAM_STR);
        $stmt->bindParam(":FIO", $datos["FIO"], PDO::PARAM_STR);
        $stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":password2", $datos["password2"], PDO::PARAM_STR);
        $stmt->bindParam(":id_roles_usuarios", $datos["id_roles_usuarios"], PDO::PARAM_INT);
        if($stmt->execute()){
			return "ok";
		}else{
            print_r(Conexion::conectar()->errorInfo());
            
		}
        $stmt->close();
        $stmt = null;
    }
    /*END REGISTRO*/
    /*END SELECT REGISTROS*/
	static public function ModelSelecRegistros($tabla, $item, $valor){
		if($item == null && $valor == null){
			 $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha,'%d/%m/%Y') AS fecha FROM $tabla ORDER BY ID_sesion_usuario DESC");
			$stmt->execute();
			return $stmt->fetchAll();
		}else{
            $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla WHERE $item = :$item ORDER BY ID_sesion_usuario DESC");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }
        $stmt->close();
        $stmt = null;
    }
	/*END SELECT REGISTROS*/
    /*ACTUALIZAR REGISTRO*/
    static public function ModelActualizar($tabla, $datos){
        if (isset($datos['profileImage_dir']))
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token=:token, nombre=:nombre, email=:email, profileImage_dir=:profileImage_dir WHERE ID_sesion_usuario=:ID_sesion_usuario");
            $stmt->bindParam(":profileImage_dir", $datos["profileImage_dir"], PDO::PARAM_STR);
        }
        else
        {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token=:token, nombre=:nombre, email=:email WHERE ID_sesion_usuario=:ID_sesion_usuario");
        }       
        $stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);       
        $stmt->bindParam(":ID_sesion_usuario", $datos["ID_sesion_usuario"], PDO::PARAM_INT);
        if($stmt->execute()){
			return "ok";
		}else{
            print_r(Conexion::conectar()->errorInfo());
            
		}
        $stmt->close();
        $stmt = null;
    }
    /*END ACTUALIZAR REGISTRO*/
    /*Actualizar Intentos Fallidos*/
    static public function ModelIntentosFallidos($tabla, $valor, $token){
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET intentos_fallidos=:intentos_fallidos WHERE token=:token");
        $stmt->bindParam(":intentos_fallidos", $valor, PDO::PARAM_INT);$stmt->bindParam(":token", $token, PDO::PARAM_STR);
		if($stmt->execute()){
			return "ok";
		}else{
            print_r(Conexion::conectar()->errorInfo());
            
		}
        $stmt->close();
        $stmt = null;
    }
    /*END Actualizar Intentos Fallidos*/
}