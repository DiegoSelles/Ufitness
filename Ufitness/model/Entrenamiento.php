<?php

class Entrenamiento
{
	public $idEntrenamiento;
	public $duracion;
	public $lugar;
	public $tipoAct;

	function __construct($idEntrenamiento,$duracion){
		$this ->idEntrenamiento = $idEntrenamiento;
		$this ->duracion = $duracion;
	}

  public function getidEntrenamiento() {
    return $this ->idEntrnamiento;
  }

  public function getDuracion() {
    return $this ->duracion;
  }

  public function setDuracion ($duracion){
    $this ->duracion = $duracion;
  }

}

?>
