<?php


class Deportista extends Usuario
{
	public $riesgos;
	public $historialentrenamiento;
	public $tipoDeportista;
	function __construct($nombre,$email,$password,$edad,$dni,$riesgos,$historialentrenamiento,$tipoDeportista)
	{
		parent::__construct($nombre,$email,$password,$edad,$dni);
		$this ->riesgos = $riesgos;
		$this ->historialentrenamiento = $historialentrenamiento;
		$this ->tipoDeportista = $tipoDep;
	}
}
?>
