<?php

class Sesion{

	public $anotaciones;
	public $fechaSesion;

	public function __construct($dniDeportista,$idHasEntrenamiento,$idHasEjercicio,$anotaciones,$fechaSesion)
	{
		
		$this ->dniDeportista = $dniDeportista;
		$this ->idHasEntrenamiento = $idHasEntrenamiento;
		$this ->idHasEjercicio = $idHasEjercicio;
		$this ->anotaciones = $anotaciones;
		$this ->fechaSesion = $fechaSesion;
	}

	public function getDniDeportista(){
		return $this ->dniDeportista;
	}

	public function getIdHasEjercicio(){
		return $this ->idHasEjercicio;
	}

	public function getidHasEntrenamiento(){
		return $this ->idHasEntrenamiento;
	}

	public function getAnotaciones(){
		return $this ->anotaciones;
	}

	public function setAnotaciones($anotaciones){
		$this ->anotaciones = $anotaciones;
	}

	public function getFechaSesion(){
		return $this ->fechaSesion;
	}

	public function setFechaSesion($fechaSesion){
		$this ->fechaSesion = $fechaSesion;
	}

}

?>
