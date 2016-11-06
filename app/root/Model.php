<?php
class Model extends PModel{
  function save_user($req){
    $sql = "SELECT count(*) cnt
            FROM user
            WHERE email=?";
    $st = $this->db->prepare($sql);
    $res = $st->execute(array($req['email']));
    $res = $st->fetch();
    if($res['cnt']==0){
      $sql = "INSERT INTO user(name,email)VALUES(?,?)";
      $st = $this->db->prepare($sql);
      $res = $st->execute(array($req['name'], $req['email']));
    }
  }
  function getTest($req){
    $st = $this->db->prepare("SELECT * FROM test");
    $st->execute();
    return $st;
  }
}

 ?>
