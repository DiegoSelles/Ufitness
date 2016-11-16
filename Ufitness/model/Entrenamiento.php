<?php

class Entrenamiento
{
	public $idEntrenamiento;
	public $deportista;
	public $duracion;
	public $nombre;


	function __construct($duracion,$nombre,$deportista=NULL,$idEntrenamiento=NULL)
  {
		$this ->duracion = $duracion;
		$this ->nombre = $nombre;
		$this ->deportista = $deportista;
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

  public function getDeportista() {
    return $this ->deportista;
  }

  public function getNombre(){
	  return $this ->nombre;
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
