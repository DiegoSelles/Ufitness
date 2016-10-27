<?php


class Deportista extends Usuario
{
	public $riesgos;
	public $historialentrenamiento;
	public $tipoDep;
	function __construct($nombre,$email,$password,$edad,$dni,$riesgos,$historialentrenamiento,$tipoDep)
	{
		parent::__construct($nombre,$email,$password,$edad,$dni);
		$this ->riesgos = $riesgos;
		$this ->historialentrenamiento = $historialentrenamiento;
		$this ->tipoDep = $tipoDep;
	}
}
?>