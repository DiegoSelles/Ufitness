<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Entrenamiento.php");
require_once(__DIR__."/../model/Deportista.php");


/**
 * Class PostMapper
 *
 * Database interface for Post entities
 *
 * @author lipido <lipido@gmail.com>
 */
class EntrenamientoMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Retrieves all posts
   *
   * Note: Comments are not added to the Post instances
   *
   * @throws PDOException if a database error occurs
   * @return mixed Array of Post instances (without comments)
   */
  public function findAllEntrenamientos() {
    $stmt = $this->db->query("SELECT * FROM Entrenamiento");
    $entrenamientos_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $entrenamientos = array();

    foreach ($entrenamientos_db as $entrenamiento) {
      $deportista = new Deportista($entrenamiento["Deportista_DNI"]);
      array_push($entrenamientos, new Entrenamiento($entrenamiento["idEntrenamiento"], $deportista, $entrenamiento["duracion"]));
    }

    return $entrenamientos;
  }

  /**
   * Loads a Post from the database given its id
   *
   * Note: Comments are not added to the Post
   *
   * @throws PDOException if a database error occurs
   * @return Post The Post instances (without comments). NULL
   * if the Post is not found
   */
  public function findEntrenamientoById($idEntrenamiento){
    $stmt = $this->db->prepare("SELECT * FROM Entrenamiento WHERE id=?");
    $stmt->execute(array($idEntrenamiento));
    $entrenamiento = $stmt->fetch(PDO::FETCH_ASSOC);

    if($entrenamiento != null) {
      return new Entrenamiento(
      $entrenamiento["idEntrenamiento"],
      new Deportista($entrenamiento["Deportista_DNI"]),
      $entrenamiento["duracion"]);
      } else {
        return NULL;
      }
    }



  /**
   * Saves a Post into the database
   *
   * @param Post $post The post to be saved
   * @throws PDOException if a database error occurs
   * @return int The mew post id
   */
  public function save(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("INSERT INTO Entrenamiento(Deportista_DNI, duracion) values (?,?)");
    $stmt->execute(array($entrenamiento->getDeportista()->getDni(),$entrenamiento->getDuracion()));
    return $this->db->lastInsertId();
  }

  /**
   * Updates a Post in the database
   *
   * @param Post $post The post to be updated
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function update(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("UPDATE Entrenamiento set duracion=? where id=?");
    $stmt->execute(array($entrenamiento->getDuracion(), $entrenamiento->getidEntrenamiento()));
  }

  /**
   * Deletes a Post into the database
   *
   * @param Post $post The post to be deleted
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function delete(Entrenamiento $entrenamiento) {
    $stmt = $this->db->prepare("DELETE from Entrenamiento WHERE id=?");
    $stmt->execute(array($ejercicio->getidEntrenamiento()));
  }

}
