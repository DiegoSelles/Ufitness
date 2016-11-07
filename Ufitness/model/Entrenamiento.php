<?php

class Entrenamiento
{
	public $idEntrenamiento;
	public $deportista
	public $duracion;


	function __construct($idEntrenamiento,$deportista,$duracion)
  {
		$this ->idEntrenamiento = $idEntrenamiento;
		$this ->deportista = $deportista;
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

  public function getDeportista() {
    return $this ->deportista;
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
