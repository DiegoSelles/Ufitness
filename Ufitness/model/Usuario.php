<?php

class Usuario 
{
	private $nombre;
	public $email;
	private $password;
	public $edad;
	public $dni;
	function __construct($nombre,$email,$password,$edad,$dni)
	{
		$this->nombre = $nombre;
		$this->email = $email;
		$this->password = $password;
		$this->edad = $edad;
		$this->dni = $dni;
	}
}

  public function getNombre() {
    return $this-> nombre;
  }

  public function setUsername($nombre) {
    $this->nombre = $nombre;
  }

  public function getPassword() {
    return $this->password;
  }  
   
  public function setPassword($password) {
    $this->password = $password;
  }

?>