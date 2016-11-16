<?php
require_once("UsuarioMapper.php");
class Usuario
{
	private $nombre;
	private $email;
	private $password;
	private $fecha;
	private $dni;
	private $rol;
	function __construct($nombre,$email,$password,$fecha,$dni,$rol)
	{
		$this->nombre = $nombre;
		$this->email = $email;
		$this->password = $password;
		$this->fecha = $fecha;
		$this->dni = $dni;
		$this->rol = $rol;
	}

  	public function getNombre() {
    	return $this->nombre;
  	}

  	public function setNombre($nombre) {
    	$this->nombre = $nombre;
  	}

  	public function getPassword() {
    	return $this->password;
  	}

  	public function setPassword($password) {
    	$this->password = $password;
  	}

  	public function getEmail() {
    	return $this->email;
  	}

  	public function setEmail($email) {
    	$this->email = $email;
  	}

  	public function getDni() {
    	return $this->dni;
  	}

  	public function setDni($dni) {
    	$this->dni = $dni;
  	}

  	public function getEdad() {

    	return date('Y-m-d') - $this->fecha;
  	}

		public function getFecha() {
    	return $this->fecha;
  	}

  	public function setRol()
  	{
  		$this->rol = $rol;
  	}
	public function getRol() {
    	return $this->rol;
  	}

	/*public function comprobarDatos() {
      $errors = array();
      if (strlen(trim($this->nombre)) < 5) {
				$errors["username"] = "Debes introducir nombre y apellidos.";
      }
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			  echo "Esta dirección de correo ($email_a) es válida.";
			}
      if (strlen($this->password) < 5) {
				$errors["password"] = "La contraseña debe tener al menos 6 caracteres.";
      }
			if (strlen($this->edad) < 1) {
				$errors["edad"] = "La edad no es válida.";
      }
			if (!validar_dni($this->dni)) {
				$errors["dni"] = "El DNI no es válido.";
      }

			if((strcasecmp ($this->rol , "administrador" )!=0) || (strcasecmp ($this->rol , "deportista" )!=0) || (strcasecmp ($this->rol , "entrenador" )!=0)){
				$errors["rol"] = "El rol no es válido. Debe ser: administrador, entrenador o deportista.";
			}

			if (sizeof($errors)>0){
				throw new ValidationException($errors, "Existen errores. No se puede registrar el usuario.");
      }
  }*/

	  public static function getbyDni($Dni){
		  $mapper = UsuarioMapper::find($Dni);

		  return new Usuario($mapper["Nombre"],$mapper["email"],$mapper["password"],$mapper["fecha_nacimiento"],$mapper["Dni"],$mapper["rol"]);

	  }/*

		function validar_dni($dni){
			$letra = substr($dni, -1);
			$numeros = substr($dni, 0, -1);
			if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
				return true;
			}else{
				return false;
		}
}*/
}

?>
