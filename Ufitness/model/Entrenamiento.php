<?php

class Entrenamiento
{
	private $idEntrenamiento;
	private $duracion;
	private $lugar;
	private $tipoAct;

	function __construct($idEntrenamiento,$duracion,$lugar,$tipoAct)
  {
		$this ->idEntrenamiento = $idEntrenamiento;
		$this ->duracion = $duracion;
    $this ->lugar = $lugar;
    $this ->tipoAct = $tipoAct;
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

  public function getLugar() {
    return $this ->lugar;
  }

  public function setTipoAct ($tipoAct){
    $this ->duracion = $tipoAct;
  }

}

?>
