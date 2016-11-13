<?php


require_once(__DIR__."/../resources/conexion.php");
require_once(__DIR__."/../model/Deportista.php");
if(!isset($_SESSION)) session_start();

class DeportistaMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct(){}

    public function guardarDeportista($deportista) {
    global $connect;
    $consulta= " INSERT INTO Deportista (DNI, Usuario_Dni, riesgos, tipoDep) VALUES ('". $deportista->getDni() ."',
     '". $_SESSION["Dni"] ."', '". $deportista->getRiesgos() ."', '". $deportista->getTipo() ."')";
    $connect->query($consulta);
  }

    public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(username) FROM users where username=? and passwd=?");
    $stmt->execute(array($username, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  public function listarDeportistas() {
    global $connect;
		$consulta = "SELECT * FROM Usuario U, Deportista D  WHERE U.Dni = D.DNI";
    $resultado = $connect->query($consulta);
		$listaDeportistas = array();
		while ($actual = mysqli_fetch_assoc($resultado)){
        $deportista = new Deportista($actual["Nombre"],$actual["email"],$actual["password"],$actual["edad"],$actual["DNI"],$actual["rol"],$actual["riesgos"],$actual["tipoDep"],NULL);
				array_push($listaDeportistas, $deportista);
		}
		return $listaDeportistas;
	}

  public function listarDeportistasTipo($tipo) {
    global $connect;
		$consulta = "SELECT * FROM Usuario U, Deportista D  WHERE U.dni = D.dni AND tipoDep ='$tipo'";
    $resultado = $connect->query($consulta);
		$listaDeportistas = array();
		while ($actual = mysqli_fetch_assoc($resultado)) {
        $deportista = new Deportista($actual["Nombre"],$actual["email"],$actual["password"],$actual["edad"],$actual["DNI"],$actual["rol"],$actual["riesgos"],$actual["tipoDep"],$actual["historialEntrenamiento"]);
				array_push($listaDeportistas, $deportista);
		}
		return $listaDeportistas;
	}

  public function eliminarDeportista(Deportista $deportista) {
    global $connect;
    $consulta = "DELETE FROM Deportista WHERE Dni='".$deportista->getDni()."' ";
    $connect->query($consulta);
  }

  public function buscarDni($dni){
    global $connect;
    $consulta = "SELECT FROM Usuario U, Deportista D WHERE U.dni = D.dni AND U.dni='$dni' ";
    $resultado = $connect->query($consulta);

    if($resultado != null) {
      return new Deportista($actual["Nombre"],$actual["email"],$actual["password"],$actual["edad"],$actual["DNI"],$actual["rol"],$actual["riesgos"],$actual["tipoDep"],$actual["historialEntrenamiento"]);
    } else {
      return NULL;
    }
  }
}
?>