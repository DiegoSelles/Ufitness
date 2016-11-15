<?php

class Ejercicio
{
 	private $idEjercicio;
  private $nombre;
  private $usuario_Dni;
	private $tipoEjercicio;
	private $maquina;
	private $grupoMuscular;
	private $descripcion;
  private $imagen;
  private $video;

	function __construct($nombre,$usuario_Dni,$tipoEjercicio,$grupoMuscular,$maquina,$descripcion, $imagen, $video, $idEjercicio = null)
	{
		$this ->idEjercicio = $idEjercicio;
    $this ->nombre = $nombre;
    $this ->usuario_Dni = $usuario_Dni;
    $this ->tipoEjercicio = $tipoEjercicio;
		$this ->grupoMuscular = $grupoMuscular;
		$this ->maquina = $maquina;
		$this ->grupoMuscular = $grupoMuscular;
    $this ->descripcion = $descripcion;
   	$this ->imagen = $imagen;
    $this ->video = $video;

	}

  public function getNombre (){
    return $this ->nombre;
  }

	public function getIdEjercicio (){
		return $this ->idEjercicio;
	}

  public function getTipoEjercicio (){
		return $this ->tipoEjercicio;
	}

  public function getUsuario (){
    return $this ->usuario;
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

  public function getImagen (){
    return $this ->imagen;
  }

  public function getVideo (){
    return $this ->video;
  }

  public function comprobarDatosNuevo() {
      $errors = array();

      if (strlen(trim($this->idEjercicio)) == 0 ) {
				$errors["id"] = "El ID no es válido";
      }

      if (strlen(trim($this->nombre)) == 0 ) {
				$errors["nombre"] = "El Ejercicio debe tener nombre.";
      }

      if (strlen(trim($this->tipoEjercicio)) == 0 ) {
				$errors["tipoEjercicio"] = "El Ejercicio debe tener tipo.";
      }

      if (strlen($this->maquina) == 0 ) {
				$errors["maquina"] = "El ejercicio debe tener una máquina asignada.";
      }

			if (strlen(trim($this->grupoMuscular)) == 0 ) {
				$errors["grupoMuscular"] = "El Ejercicio debe tener un gurpo muscular.";
      }

      if (strlen(trim($this->descripcion)) == 0 ) {
				$errors["descripcion"] = "El Ejercicio debe tener una descripcion.";
      }

      if (sizeof($errors) > 0){
				throw new ValidationException($errors, "Existen errores. No se puede crear el ejercicio.");
      }
  }

	public function comprobarDatosModificacion() {
    $errors = array();

		if (strlen(trim($this->idEjercicio)) == 0 ) {
			$errors["id"] = "El ID no es válido";
		}

    try{
      $this->comprobarDatosNuevo();
    }catch(ValidationException $ex) {
      foreach ($ex->getErrors() as $key=>$error) {
				$errors[$key] = $error;
      }
    }
    if (sizeof($errors) > 0) {
      throw new ValidationException($errors, "Existen errores. No se pueden actualizar el ejercicio.");
    }
  }



}

?>
