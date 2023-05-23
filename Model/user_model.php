<?php
require_once "CONNECT.php";
class UserModel{
      static public function UserModelRegistro($tabla, $datos)
      {
            $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(ID_sesion_usuario) VALUES (:ID_sesion_usuario)");
            $stmt->bindParam(":ID_sesion_usuario", $datos, PDO::PARAM_INT);
            if($stmt->execute()){
			return "ok";
		}else{
            print_r(Conexion::conectar()->errorInfo());
		}
            $stmt->close();
            $stmt = null;
      }
      static public function UserModelSeleccionar($tabla, $item, $valor)
      {
            if($item == null && $valor == null){
	      $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha_de_nacimiento,'%Y-%m-%d') AS fecha_de_nacimiento FROM $tabla ORDER BY ID_sesion_usuario DESC");
            $stmt->execute();
            return $stmt->fetchAll();
		}else{
            $stmt = Conexion::conectar()->prepare("SELECT *,DATE_FORMAT(fecha_de_nacimiento,'%Y-%m-%d') AS fecha_de_nacimiento FROM $tabla WHERE $item = :$item ORDER BY ID_sesion_usuario DESC");
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
            }
            $stmt->close();
            $stmt = null;
      }
      static public function UserModelActualizar($tabla, $datos)
      {
            $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET fecha_de_nacimiento=:fecha_de_nacimiento, 
            direccion=:direccion, 
            telefono=:telefono, 
            instituto=:instituto, 
            cafedra=:cafedra,
            curso=:curso, 
            grupo=:grupo,
            ID_tipo_genero=:ID_tipo_genero,
            tipo_educacion=:tipo_educacion, 
            forma_educacion=:forma_educacion, promedio_academico=:promedio_academico, numero_serie_pasaporte=:numero_serie_pasaporte, emitido_por_quien=:emitido_por_quien, 
            fecha_emision=:fecha_emision, 
            snils=:snils, 
            parientes=:parientes, 
            telefono_pariente=:telefono_pariente 
            WHERE ID_sesion_usuario=:ID_sesion_usuario");
            $stmt->bindParam(":fecha_de_nacimiento", $datos["fecha_de_nacimiento"], PDO::PARAM_STR);
            $stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
            $stmt->bindParam(":instituto", $datos["instituto"], PDO::PARAM_STR);
            $stmt->bindParam(":cafedra", $datos["cafedra"], PDO::PARAM_STR);
            $stmt->bindParam(":curso", $datos["curso"], PDO::PARAM_STR);
            $stmt->bindParam(":grupo", $datos["grupo"], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_educacion", $datos["tipo_educacion"], PDO::PARAM_STR);
            $stmt->bindParam(":forma_educacion", $datos["forma_educacion"], PDO::PARAM_STR);
            $stmt->bindParam(":promedio_academico", $datos["promedio_academico"], PDO::PARAM_STR);
            $stmt->bindParam(":numero_serie_pasaporte", $datos["numero_serie_pasaporte"], PDO::PARAM_STR);
            $stmt->bindParam(":emitido_por_quien", $datos["emitido_por_quien"], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_emision", $datos["fecha_emision"], PDO::PARAM_STR);
            $stmt->bindParam(":snils", $datos["snils"], PDO::PARAM_STR);
            $stmt->bindParam(":parientes", $datos["parientes"], PDO::PARAM_STR);
            $stmt->bindParam(":telefono_pariente", $datos["telefono_pariente"], PDO::PARAM_STR);
            $stmt->bindParam(":ID_sesion_usuario", $datos["ID_sesion_usuario"], PDO::PARAM_INT);
            $stmt->bindParam(":ID_tipo_genero", $datos["ID_tipo_genero"], PDO::PARAM_INT);
            if($stmt->execute()){
			return "ok";
		}else{
            print_r(Conexion::conectar()->errorInfo());
		}
            $stmt->close();
            $stmt = null;
      }
      static public function UserModelSeleccionarTipoGenero()
      {
             $stmt = Conexion::conectar()->prepare("SELECT * 
            FROM tipo_genero ORDER BY ID_tipo_genero");
            $stmt->execute();
            return $stmt->fetchAll();
      }
}
