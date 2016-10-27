<?php

class Actividad
{
	public $numPlazas;
	public $horario;
	public $lugar;
	public $tipoAct;

	function __construct($numPlazas,$horario,$lugar,$tipoAct){
		$this ->numPlazas = $numPlazas;
		$this ->horario = $horario;
		$this ->lugar = $lugar;
		$this ->tipoAct = $tipoAct;
	}

}

?>