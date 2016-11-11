<?php
// file: model/UserMapper.php

require_once(__DIR__."/../resources/conexion.php");

/**
 * Class UserMapper
 *
 * Database interface for User entities
 *
 * @author lipido <lipido@gmail.com>
 */
class DeportistaMapper {

  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;

/*  public function __construct() {
    $this->db = PDOConnection::getInstance();
  }

  /**
   * Saves a User into the database
   *
   * @param User $user The user to be saved
   * @throws PDOException if a database error occurs
   * @return void
   */
 /* public function save($deportista) {
    $stmt = $this->db->prepare("INSERT INTO Deportista values (?,?)");
    $stmt->execute(array($deportista->getRiesgos(), $user->getTipo()));
  }

  /**
   * Checks if a given username is already in the database
   *
   * @param string $username the username to check
   * @return boolean true if the username exists, false otherwise
   */
  /**
   * Checks if a given pair of username/password exists in the database
   *
   * @param string $username the username
   * @param string $passwd the password
   * @return boolean true the username/passwrod exists, false otherwise.
   */
 /* public function isValidUser($username, $passwd) {
    $stmt = $this->db->prepare("SELECT count(username) FROM users where username=? and passwd=?");
    $stmt->execute(array($username, $passwd));

    if ($stmt->fetchColumn() > 0) {
      return true;
    }
  }*/
}
?>
