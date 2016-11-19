<?php
$G24 = file_get_contents("G24.sql");
$servername = "localhost";
$username = "root";
$password = "root";// ASI SI
// Create connection
global  $conection;
$conection = new mysqli($servername, $username, $password);
// Check connection
if ($conection->connect_error) {
    die("Connection failed: " . $conection->connect_error);
}
// Create database
$sql = "DROP DATABASE G24";
$conection->query($sql);
$sql = "CREATE DATABASE G24";
if ($conection->query($sql) === TRUE) {
    echo "La base de datos ha sido creada correctamente";
    doQuery($G24);
} else {
    echo "Error al crear la BD: " . $conection->error;
}
$conection->close();

function doQuery($query){
  global $conection;
  $result = $conection->multi_query($query);
  if(!$result){
    die("Error en la consulta: ".$conection->error);
  }
  return $result;
}

?>
