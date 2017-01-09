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
			if (isset($_GET['lang'])) {
				$lang = $_GET['lang'];
			} else {
				$lang = "es";
			}
			if(empty($usuario) || empty($password)){
				header("Location: ../index.php?lang=$lang");
				exit();
			}
			$consulta = "SELECT * FROM Usuario WHERE Dni='". $usuario."'";
			$resultado = $connect->query($consulta);
			if($row = mysqli_fetch_assoc($resultado)){
				if($row['password'] == $password){
				session_start();
				$_SESSION['Dni'] = $usuario;
				$_SESSION['rol'] = $row['rol'];
				header("Location: ../view/adminIndex.php?lang=$lang");
				}else{
					header("Location: ../index.php?lang=$lang");
					exit();
				}
			}else{
				header("Location: ../index.php?lang=$lang");
				exit();
			}
		}

		public static function logout(){
			if(!isset($_SESSION)) session_start();
			session_destroy();
			if (isset($_SESSION['lang'])) {
				$lang = $_SESSION['lang'];
			} else {
				$lang = "es";
			}
			header("Location: ../index.php?lang=$lang");
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
    		if (isset($_GET['lang'])) {
				$lang = $_GET['lang'];
			} else {
				$lang = "es";
			}

		    if(isset($_POST["nombre"]))
		    {

			    $fecha = $_POST["fecha"];
			    $fechaNac = str_replace("/","-",$fecha);


			    $usuario = new Usuario($_POST["nombre"],$_POST["email"],$_POST["password"],$fechaNac,$_POST["dni"],"entrenador");

			     	try{
			     		if (!$usuarioMapper->usuarioExiste($usuario->getDni()))
			     		{
				    //  		$usuario->comprobarDatos();
				      		$usuarioMapper->guardarUsuario($usuario);
				      		header("Location: ../view/adminEntrenadores.php?lang=$lang");
						}
						else
						{
							echo '<script language="javascript">alert("Ya existe un entrenador con el mismo DNI."); window.location.href="../view/adminEntrenadores.php?lang=$lang";</script>';
				      	}

		      	}catch(ValidationException $ex)
		      	{
		      		$errors = $ex->getErrors();
						//print_r($errors);
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
		    if (isset($_GET['lang'])) {
				$lang = $_GET['lang'];
			} else {
				$lang = "es";
			}

			$usuario = new Usuario($nombre,$email,$password,$fechaNac,$dni,"entrenador");

			$usuarioMapper->modificarUsuario($usuario,$dniAntiguo);
			header("Location: ../view/adminEntrenadores.php?lang=$lang");
		}

	public static function eliminar()
	{
		$dni = $_POST["dni"];
		//$usuario = $this->usuarioMapper->find($dni);
		if (isset($_GET['lang'])) {
			$lang = $_GET['lang'];
		} else {
			$lang = "es";
		}

		$usuarioMapper = new UsuarioMapper();
		$usuarioMapper->eliminarUsuario($dni);

	    header("Location: ../view/adminEntrenadores.php?lang=$lang");
	}

}

?>
