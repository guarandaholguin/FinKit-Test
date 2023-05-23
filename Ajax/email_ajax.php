<?php
require_once ("../Control/login_control.php");
require_once ("../Model/login_model.php");
class AjaxFormularios{
    public $validarEmail;
	public function ajaxValidarEmail(){
		$item = "email";
		$valor = $this->validarEmail;
		$respuesta = LoginControl::ControlSelectRegistros($item, $valor);
		echo json_encode($respuesta);
	}
}
if(isset($_POST["validarEmail"])){
	$valEmail = new AjaxFormularios();
	$valEmail -> validarEmail = $_POST["validarEmail"];
	$valEmail -> ajaxValidarEmail();
}

