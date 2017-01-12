<?php
require_once("Usuario.php");
require_once("../resources/ValidationException.php");
class Deportista extends Usuario {

	public $riesgos;
	public $tipo;

	function __construct($nombre,$email,$password,$edad,$dni,$rol,$riesgos,$tipoDeportista)
	{
		parent::__construct($nombre,$email,$password,$edad,$dni,$rol);
		$this ->riesgos = $riesgos;
		$this ->tipo = $tipoDeportista;
	}

	public function getRiesgos (){
		return $this ->riesgos;
	}

	public function setRiesgos ($riesgos){
		$this ->riesgos = $riesgos;
	}

	public function getTipo (){
		return $this ->tipo;
	}

	public function setTipo ($tipoDeportista){
		$this ->tipo = $tipoDeportista;
	}

	public function comprobarDatos() {
			$errors = array();

			if(!(strcasecmp ($this->tipo , "PEF" )==0) || !(strcasecmp ($this->tipo , "TDU" )==0)){
				$errors["tipo"] = "El tipo no es válido. Debe ser: TDU o PEF.";
			}

			if (sizeof($errors)>0){
				throw new ValidationException($errors, "Existen errores. No se puede registrar el deportista.");
			}
	}

}

?>
