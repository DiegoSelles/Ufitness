<?php

class Usuario
{
	private $nombre;
	private $email;
	private $password;
	private $edad;
	private $dni;
	function __construct($nombre,$email,$password,$edad,$dni)
	{
		$this->nombre = $nombre;
		$this->email = $email;
		$this->password = $password;
		$this->edad = $edad;
		$this->dni = $dni;
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
    	return $this->Dni;
  	}

  	public function setDni($dni) {
    	$this->dni = $dni;
  	}

  	public function getEdad() {
    	return $this->edad;
  	}
}

?>
