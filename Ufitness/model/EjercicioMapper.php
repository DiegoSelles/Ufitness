<?php
// file: model/PostMapper.php
require_once(__DIR__."/../core/PDOConnection.php");

require_once(__DIR__."/../model/Ejercicio.php");
require_once(__DIR__."/../model/Usuario.php");

/**
 * Class PostMapper
 *
 * Database interface for Post entities
 *
 * @author lipido <lipido@gmail.com>
 */
class EjercicioMapper {

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
  public function findAllEjercicios() {
    $stmt = $this->db->query("SELECT * FROM Ejercicio");
    $ejercicios_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $ejercicios = array();

    foreach ($ejercicios_db as $ejercicio) {
      array_push($ejercicios, new Ejercicio($ejercicio["idEjercicio"], new Usuario($ejercicio["Usuario_DNI"]), $ejercicio["tipoEjercicio"],$ejercicio["maquina"],$ejercicio["grupoMuscular"],
      $ejercicio["descripcion"],$ejercicio["imagen"],$ejercicio["video"]));
    }

    return $ejercicios;
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
  public function findEjercicioById($idEjercicio){
    $stmt = $this->db->prepare("SELECT * FROM Ejercicio WHERE id=?");
    $stmt->execute(array($idEjercicio));
    $ejercicio = $stmt->fetch(PDO::FETCH_ASSOC);

    if($ejercicio != null) {
      return new Ejercicio($ejercicio["idEjercicio"],
      new Usuario($ejercicio["Usuario_DNI"]),
      $ejercicio["tipoEjercicio"],
      $ejercicio["maquina"],
      $ejercicio["grupoMuscular"],
      $ejercicio["descripcion"],
      $ejercicio["imagen"],
      $ejercicio["video"]);
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
  public function save(Ejercicio $ejercicio) {
    $stmt = $this->db->prepare("INSERT INTO Ejercicio(/*idEjercicio???,*/ Usuario_Dni, tipoEjer,maquina, grupoMuscular, descripcion, imagen, video) values (?,?,?,?,?,?,?)");
    $stmt->execute(array($ejercicio->getUsuario()->getDni(),$ejercicio->getTipoEjercicio(),$ejercicio->getMaquina(),
    $ejercicio->getGrupoMuscular(),$ejercio->getDescripcion(),$ejercio->getImagen(),$ejercio->getVideo()));

    return $this->db->lastInsertId();
  }

  /**
   * Updates a Post in the database
   *
   * @param Post $post The post to be updated
   * @throws PDOException if a database error occurs
   * @return void
   */
   public function update(Ejercicio $ejercicio) {
    $stmt = $this->db->prepare("UPDATE Ejercicio set tipoEjer=?,maquina=?, grupoMuscular=?, descripcion=?, imagen=?, video=? where id=?");
    $stmt->execute(array($ejercicio->getTipoEjercicio(),$ejercicio->getMaquina(), $ejercicio->getGrupoMuscular(),$ejercio->getDescripcion(),
    $ejercio->getImagen(),$ejercio->getVideo(),$ejercicio->getIdEjercicio()));
  }

  /**
   * Deletes a Post into the database
   *
   * @param Post $post The post to be deleted
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function delete(Ejercicio $ejercicio) {
    $stmt = $this->db->prepare("DELETE from Ejercicio WHERE id=?");
    $stmt->execute(array($ejercicio->getidEjercicio()));
  }

}
