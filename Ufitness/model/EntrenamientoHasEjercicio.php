<?php

class EntrenamientoHasEjercicio
{
	public $idEntrenamiento;
	public $idEjercicio;
	public $seriesxRep;
	public $carga;


	function __construct($idEntrenamiento,$idEjercicio,$seriesxRep=NULL,$carga=NULL)
  {
		$this ->idEntrenamiento = $idEntrenamiento;
		$this ->idEjercicio = $idEjercicio;
		$this ->seriesxRep = $seriesxRep;
		$this ->carga = $carga;

	}

  public function getIdEntrenamiento() {
    return $this ->idEntrenamiento;
  }

  public function getIdEjercicio() {
    return $this ->idEjercicio;
  }

  public function getSxR() {
    return $this ->seriesxRep;
  }

  public function setSxR ($seriesxRep){
    $this ->seriesxRep = $seriesxRep;
  }

  public function getCarga() {
    return $this ->carga;
  }

  public function setCarga ($carga){
    $this ->carga = $carga;
  }

}

?>
