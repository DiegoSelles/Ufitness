<?php

class Ejercicio
{
  public $idEjercicio;
	public $tipoEjercicio;
	public $maquina;
	public $grupoMuscular;
	public $descripcion;
  public $imagen;
  public $video;

	function __construct($tipoEjercicio,$grupoMuscular,$maquina,$descripcion, $imagen, $video){
    //$this ->idEjercicio =
    $this ->tipoEjercicio = $tipoEjercicio;
		$this ->grupoMuscular = $grupoMuscular;
		$this ->maquina = $maquina;
		$this ->grupoMuscular = $grupoMuscular;
    $this ->descripcion = $descripcion;
    $this ->imagen = $imagen;
    $this ->video = $video;

	}

	public function getIdEjercicio (){
		return $this ->idEjercicio;
	}

  public function getTipoEjercicio (){
		return $this ->tipoEjercicio;
	}

	public function setTipoEjercicio ($tipoEjercicio){
		$this ->tipoEjercicio = $tipoEjercicio;
	}

  public function getMaquina (){
		return $this ->maquina;
	}

  public function setMaquina ($maquina){
		$this ->maquina = $maquina;
	}

  public function getGrupoMuscular (){
		return $this ->getGrupoMuscular;
	}

  public function setGrupoMuscular ($grupoMuscular){
		$this ->grupoMuscular = $grupoMuscular;
	}

  public function getDescripcion (){
		return $this ->descripcion;
	}

  public function setDescripcion ($descripcion){
		$this ->descripcion = $descripcion;
	}

}

?>
