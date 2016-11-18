<?php
require_once("../model/Usuario.php");
require_once("../model/UsuarioMapper.php");
require_once("../resources/conexion.php");

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
				header("Location: ../index.php");
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
					header("Location: ../index.php");
					exit();
				}
			}else{
				header("Location: ../index.php");
				exit();
			}
		}

		public static function logout(){
			if(!isset($_SESSION)) session_start();
			session_destroy();
			header("Location: ../index.php");
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
			return $this->usuarioMapper->buscar($Dni);
		}

		public static function anhadir()
		{
    		$usuarioMapper = new UsuarioMapper();
    	
		    if(isset($_POST["nombre"])){

		    $fecha = $_POST["fecha"];
		    $fechaNac = str_replace("/","-",$fecha);
			
		    $usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$fechaNac,$_POST["dni"],"entrenador");

		     	try{
		    //  		$usuario->comprobarDatos();
		      		$usuarioMapper->guardarUsuario($usuario);
		      		header("Location: ../view/adminEntrenadores.php");
		      	}catch(ValidationException $ex)
		      	{
		      		//mensaje error
		     	}
		     }
		}

		public static function editar()
		{
			$usuarioMapper = new UsuarioMapper();
			$dni = $_POST["Dni"];
			$dniAdmin = $_POST["DniAdmin"];
			$dniAntiguo = $_POST["dniAntiguo"];
			$nombre = $_POST["nombre"];
			$email = $_POST["email"];
			$password = $_POST["password"];
			$fecha = $_POST["fecha"];
		    $fechaNac = str_replace("/","-",$fecha);

			$usuario = new Usuario($nombre,$email,$password,$fechaNac,$dni,"entrenador");

		/*	if($usuario == NULL)
			{
				throw new Exception("deportista no existe: ".$usuario);
			}*/

			//	$usuario->comprobarDatos();*/
				$usuarioMapper->modificarUsuario($usuario,$dniAntiguo);
				header("Location: ../view/adminEntrenadores.php");
			//}
		}

	public static function eliminar()
	{
		/* if (!isset($_POST["dni"])) {
      		throw new Exception("dni is mandatory");
    	}*/

		$dni = $_POST["dni"];
		//$usuario = $this->usuarioMapper->find($dni);

		$usuarioMapper = new UsuarioMapper();
		$usuarioMapper->eliminarUsuario($dni);
		/*if($usuario == NULL)
		{
			throw new Exception("deportista no existe: ".$usuario);

		}*/
	    header("Location: ../view/adminEntrenadores.php");
	}

}

?>
