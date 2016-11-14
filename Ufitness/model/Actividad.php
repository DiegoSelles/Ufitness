<?php

class Actividad
{
	public $id;
	public $nombre;
	public $numPlazas;
	public $horario;
	public $lugar;
	public $tipoAct;

	function __construct($nombre,$numPlazas,$horario,$lugar,$tipoActividad){
		$this ->nombre = $nombre;
		$this ->numPlazas = $numPlazas;
		$this ->horario = $horario;
		$this ->lugar = $lugar;
		$this ->tipoAct = $tipoActividad;
	}


	public function getId (){
		return $this ->id;
	}

	public function getNombre (){
		return $this ->nombre;
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

	public function getLugar (){
		return $this ->lugar;
	}

	public function getTipoActividad (){
		return $this ->tipoAct;
	}
	

	/*
	public function setNumPlazas ($numPlazas){
		$this ->numPlazas = $numPlazas;
	}



	public function setLugar ($lugar){
		$this ->lugar = $lugar;
	}



	public function setTipoActividad ($tipoActividad){
		$this ->tipoAct = $tipoActividad;
	}
	*/

	public function comprobarDatosNuevo() {
      $errors = array();
      if (strlen(trim($this->id)) == 0 ) {
				$errors["id"] = "El ID no es válido";
      }
      if (strlen(trim($this->nombre)) == 0 ) {
				$errors["nombre"] = "La actividad debe tener nombre.";
      }
      if ($this->numPlazas == 0 ) {
				$errors["numPlazas"] = "La actividad debe tener al menos 1 plaza.";
      }
			if (strlen(trim($this->lugar)) == 0 ) {
				$errors["lugar"] = "La actividad debe tener un aula asignada.";
      }
			if (strlen(trim($this->tipoAct)) == 0 ) {
				$errors["tipoAct"] = "La actividad debe tener tipo.";
      }
      if (sizeof($errors) > 0){
				throw new ValidationException($errors, "Existen errores. No se puede crear la actividad.");
      }
  }

	public function comprobarDatosModificacion() {
    $errors = array();

		if (strlen(trim($this->id)) == 0 ) {
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
      throw new ValidationException($errors, "Existen errores. No se pueden actualizar los datos.");
    }
  }

}

?>
