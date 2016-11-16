<?php
require_once("../resources/conexion.php");
require_once("../model/Deportista.php");
if(!isset($_SESSION)) session_start();

class DeportistaMapper {

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
      $deportista = new Deportista($actual["Nombre"],$actual["email"],$actual["password"],$actual["fecha_nacimiento"],$actual["DNI"],$actual["rol"],$actual["riesgos"],$actual["tipoDep"],NULL);
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
        $deportista = new Deportista($actual["Nombre"],$actual["email"],$actual["password"],$actual["fecha_nacimiento"],$actual["DNI"],$actual["rol"],$actual["riesgos"],$actual["tipoDep"],$actual["historialEntrenamiento"]);
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
    $consulta = "SELECT * FROM Usuario U, Deportista D WHERE U.Dni = D.DNI AND U.Dni='$dni' ";
    $res = $connect->query($consulta);
    $resultado = mysqli_fetch_assoc($res);

    if($resultado != null) {
      return new Deportista($resultado["Nombre"],$resultado["email"],$resultado["password"],$resultado["fecha_nacimiento"],$resultado["Dni"],$resultado["rol"],$resultado["riesgos"],$resultado["tipoDep"],$resultado["historialEntrenamiento"]);
    } else {
      return NULL;
    }
  }

	public function modificarDeportista($deportista,$dniAntiguo){
		global $connect;
		$consulta= "UPDATE Deportista set DNI='".$deportista->getDni()."', riesgos='".$deportista->getRiesgos()."', tipoDep='".$deportista->getTipo()."' WHERE DNI='".$dniAntiguo."'";
		$connect->query($consulta);
    $consulta2= "UPDATE Usuario SET Dni='". $deportista->getDni() ."' ,Nombre='". $deportista->getNombre() ."', email='". $deportista->getEmail() ."', password='". $deportista->getPassword() ."' WHERE Dni='". $dniAntiguo ."'";
    $connect->query($consulta2);
		header("Location: ../view/adminDeportistas.php");
	}
}
?>
