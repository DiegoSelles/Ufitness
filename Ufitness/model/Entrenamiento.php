<?php

class Entrenamiento
{
	public $idEntrenamiento;
	public $duracion;
	public $nombre;
	public $nivel;


	function __construct($duracion,$nombre,$nivel,$idEntrenamiento=NULL)
  {
		$this ->duracion = $duracion;
		$this ->nombre = $nombre;
		$this ->nivel = $nivel;
		$this ->idEntrenamiento = $idEntrenamiento;

	}

  public function getId() {
    return $this ->idEntrenamiento;
  }

  public function getDuracion() {
    return $this ->duracion;
  }

  public function setDuracion ($duracion){
    $this ->duracion = $duracion;
  }

  public function getNombre(){
	  return $this ->nombre;
  }


		public function getNivel() {
	    return $this ->nivel;
	  }

	  public function setNivel ($nivel){
	    $this ->nivel = $nivel;
	  }

	public function comprobarDatos() {
			$errors = array();

			if (strlen(trim($this->id)) == 0 ) {
				$errors["id"] = "El ID no es válido";
      }

			if (strlen($this->duracion) == 0) {
				$errors["edad"] = "El entrenamiento debe tener duración.";
			}

			if (sizeof($errors)>0){
				throw new ValidationException($errors, "Existen errores. No se puede registrar el entrenamiento.");
			}
	}

}

?>
