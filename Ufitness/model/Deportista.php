<?php
require_once("Usuario.php");

class Deportista extends Usuario 
{
	public $riesgos;
	public $historialEntrenamiento;
	public $tipo;

	function __construct($nombre,$email,$password,$edad,$dni,$rol,$riesgos,$historialentrenamiento,$tipoDeportista)
	{
		parent::__construct($nombre,$email,$password,$edad,$dni,$rol);
		$this ->riesgos = $riesgos;
		$this ->historialEntrenamiento = $historialentrenamiento;
		$this ->tipo = $tipoDeportista;
	}

	public function getRiesgos (){
		return $this ->riesgos;
	}

	public function setRiesgos ($riesgos){
		$this ->riesgos = $riesgos;
	}

	public function getHistorialEntrenamiento (){
		return $this ->historialEntrenamiento;
	}

	public function setHistorialEntrenamiento ($historialEntrenamiento){
		$this ->historialEntrenamiento = $historialEntrenamiento;
	}

	public function getTipo (){
		return $this ->tipo;
	}

	public function setTipo ($tipoDeportista){
		$this ->tipo = $tipoDeportista;
	}

	public function comprobarDatos() {
			$errors = array();

			/*if (!validar_dni(this->dni)) {
				$errors["dni"] = "El DNI no es válido.";
			}*/

			if (strlen($this->edad) < 1) {
				$errors["edad"] = "La edad no es válida.";
			}

			if((strcasecmp ($this->tipo , "PEF" )!=0) || (strcasecmp ($this->rol , "TDU" )!=0)){
				$errors["tipo"] = "El tipo no es válido. Debe ser: TDU o PEF.";
			}

			if (sizeof($errors)>0){
				throw new ValidationException($errors, "Existen errores. No se puede registrar el deportista.");
			}
	}

	function validar_dni($dni){
		$letra = substr($dni, -1);
		$numeros = substr($dni, 0, -1);
		if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
			return true;
		}else{
			return false;
	}
}

}
?>
