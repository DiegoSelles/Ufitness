<?php
// file: model/ActividadMapper.php
//require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Actividad.php");

/**
 * Class ActividadMapper
 *
 * Database interface for Actividad entities
 *
 * @author lipido <lipido@gmail.com>
 */
class ActividadMapper {

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
  public function findAllActividades() {
    $stmt = $this->db->query("SELECT * FROM Actividad");
    $actividades_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $actividades = array();

    foreach ($actividades_db as $actividad) {
      array_push($actividades, new Actividad($actividad["nombre"], $actividad["numPlazas"], $actividad["horario"], $actividad["lugar"], $actividad["tipoActividad"], ));
    }

    return $actividades;
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
  public function findActividadById($actividadid){
    $stmt = $this->db->prepare("SELECT * FROM Actividad WHERE id=?");
    $stmt->execute(array($actividadid));
    $actividad = $stmt->fetch(PDO::FETCH_ASSOC);

    if($actividad != null) {
      return new Actividad($actividad["nombre"], $actividad["numPlazas"], $actividad["horario"], $actividad["lugar"], $actividad["tipoActividad"], ));
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
  public function save(Actividad $actividad) {
    $stmt = $this->db->prepare("INSERT INTO Actividad(nombre, numPlazas, horario, lugar, tipoAct) values (?,?,?,?,?)");
    $stmt->execute(array($actividad->getNombre(), $actividad->getnumPlazas(),$actividad->getHorario(),$actividad->getLugar(),$actividad->getTipoActividad()));
    return $this->db->lastInsertId();
  }

  /**
   * Updates a Post in the database
   *
   * @param Post $post The post to be updated
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function update(Actividad $actividad) {
    $stmt = $this->db->prepare("UPDATE Actividad set nombre=?, numPlazas=?, horario=?, lugar=?, tipoAct=? where id=?");
    $stmt->execute(array($actividad->getNombre(), $actividad->getnumPlazas(),$actividad->getHorario(),$actividad->getLugar(),$actividad->getTipoActividad(), $actividad->getId()));
  }

  /**
   * Deletes a Post into the database
   *
   * @param Post $post The post to be deleted
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function delete(Actividad $actividad) {
    $stmt = $this->db->prepare("DELETE from Actividad WHERE id=?");
    $stmt->execute(array($actividad->getId()));
  }

}
