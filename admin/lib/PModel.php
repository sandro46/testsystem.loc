<?php
/**
 *
 */
class PModel{
  protected $db;
  public function __construct(){
    $dsn = "mysql:host=localhost;dbname=testsystem;charset=utf8";
    $opt = array(
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );
    $this->db = new PDO($dsn, 'root', '', $opt);
  }
}


 ?>
