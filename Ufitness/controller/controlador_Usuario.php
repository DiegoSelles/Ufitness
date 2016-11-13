<?php
require_once("../model/Usuario.php");
require_once("/../model/UsuarioMapper.php");

class controlador_Usuario{

		private $usuarioMapper;

		public function __construct()
		{
			$this->usuarioMapper = new UsuarioMapper();
		}

		public static function login(){
			global $connect;
			$usuario = $_POST['username'];
			$password = $_POST['password'];
			if(empty($usuario) || empty($password)){
				header("Location: ../view/index.php");
				exit();
			}
			$consulta = "SELECT * FROM Usuario WHERE Dni='". $usuario."'";
			$resultado = $connect->query($consulta);
			if($row = mysqli_fetch_assoc($resultado)){
				if($row['password'] == $password){
				session_start();
				$_SESSION['Dni'] = $usuario;
				$_SESSION['rol'] = $row['rol'];
				header("Location: ../view/adminIndex.php");
				}else{
					header("Location: ../view/index.php");
					exit();
				}
			}else{
				header("Location: ../view/index.php");
				exit();
			}
		}

		public static function logout(){
			if(!isset($_SESSION)) session_start();
			session_destroy();
			header("Location: ../view/index.php");
		}

		public static function getUsuarioActual($Dni){
			return Usuario::getbyDni($Dni);

		}

		public function listarEntrenadores()
		{
			return $this->usuarioMapper->listarEntrenadores();
			
		}

		public function buscarPorDni($Dni)
		{
			return $this->usuarioMapper->find($Dni);
			
		}

		public function anhadir()
		{
			
    		$usuarioMapper = new UsuarioMapper();
    		$usuario = new Usuario();

		    if(isset($_POST["submit"])){ 

		      $edad = date(DATE_ATOM)-$_POST["fecha"];//Calculamos la edad
		      //echo $_POST["nombre"];
		      //$usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$edad,$_POST["dni"],"entrenador");

		      $usuario->setDni($_POST["dni"]);
		      $usuario->setNombre($_POST["nombre"]);
		      $usuario->setEmail($_POST["email"]);
		      $usuario->setPassword($_POST["password"]);
		      $usuario->setEdad($edad);
		      $usuario->setRol("entrenador");
			}

		      	try{
		      		$usuario->comprobarDatos();
		      		$usuarioMapper->guardarUsuario($usuario);
		      		header("Location: ../view/adminEntrenadores.php");
		      	}catch(ValidationException $ex)
		      	{
		      		//mensaje error
		      	}
		}

		public function editar()
		{

			$dni = $_REQUEST["dni"];
			$usuario = $this->usuarioMapper->find($dni);

			if($usuario == NULL)
			{
				throw new Exception("deportista no existe: ".$usuario);
			}

		///si va por POST

			if(isset($_POST["submit"]))
			{
				$usuario->setDni($_POST["Dni"]);
				$usuario->setDniAdmin($_POST["DniAdmin"]); //currentUser
				$usuario->setRol($_POST["rol"]);
				$usuario->setNombre($_POST["nombre"]);
				$usuario->setEmail($_POST["email"]);
				$usuario->setPassword($_POST["password"]);
				$usuario->setEdad($_POST["edad"]);

				$usuario->comprobarDatos();
				$this->usuarioMapper->modificarUsuario($usuario);
			}
		}

	public function eliminar()
	{
		 if (!isset($_POST["dni"])) {
      		throw new Exception("dni is mandatory");
    	}

		$dni = $_REQUEST["dni"];
		$usuario = $this->usuarioMapper->buscarPorDni($dni);


		if($usuario == NULL)
		{
			throw new Exception("deportista no existe: ".$usuario);
			
		}

		$this->usuarioMapper->eliminarUsuario($dni);
		header("Location: ../view/adminEntrenadores.php");
	}

}

?>
