<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

/**
 * Class UserMapper
 *
 * Database interface for User entities
 *
 * @author lipido <lipido@gmail.com>
 */
class UsuarioMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Saves a User into the database
   *
   * @param User $user The user to be saved
   * @throws PDOException if a database error occurs
   * @return void
   */
  public function save($usuario) {
    $stmt = $this->db->prepare("INSERT INTO Usuario values (?,?,?,?,?,?)");
    $stmt->execute(array($usuario->getDni(), $usuario->getRol(), $usuario->getNombre(), $usuario->getEmail(), $usuario->getPassword(), $usuario->getEdad())); //Usuario_dni?
  }

  /**
   * Checks if a given username is already in the database
   *
   * @param string $username the username to check
   * @return boolean true if the username exists, false otherwise
   */
  public function usuarioExiste($Dni) {
    $stmt = $this->db->prepare("SELECT count(Dni) FROM Usuario where Dni=?");
    $stmt->execute(array($Dni));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }

  /**
   * Checks if a given pair of username/password exists in the database
   *
   * @param string $username the username
   * @param string $passwd the password
   * @return boolean true the username/passwrod exists, false otherwise.
   */

   //###########################
  public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(Dni) FROM Usuario where dni=? and password=?");
    $stmt->execute(array($username, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }
}
