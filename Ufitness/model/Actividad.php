<?php

class Actividad
{
	public $numPlazas;
	public $horario;
	public $lugar;
	public $tipoActividad;

	function __construct($numPlazas,$horario,$lugar,$tipoActividad){
		$this ->numPlazas = $numPlazas;
		$this ->horario = $horario;
		$this ->lugar = $lugar;
		$this ->tipoActividad = $tipoActividad;
	}

	public function getNumPlazas (){
		return $this ->numPlazas;
	}

	public function setNumPlazas ($numPlazas){
		$this ->numPlazas = $numPlazas;
	}

	public function getHorario(){
		return $this ->numPlazas;
	}

	public function setNumPlazas ($numPlazas){
		$this ->numPlazas = $numPlazas;
	}

	public function getLugar (){
		return $this ->lugar;
	}

	public function setLugar ($lugar){
		$this ->lugar = $lugar;
	}

	public function getTipoActividad (){
		return $this ->tipoActividad;
	}

	public function setTipoActividad ($tipoActividad){
		$this ->tipoActividad = $tipoActividad;
	}

}

?>
