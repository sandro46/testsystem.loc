<?php
class Model extends PModel{
  public function get_result($req){
    $sql = "SELECT u.email,
            	CONCAT('[', GROUP_CONCAT(concat('{\"', t.name, '\":',r.res, '}')),']') ar
            FROM `result` r
            join user u ON u.email=r.uemail
            join test t ON t.id=r.tid
            GROUP BY u.email";
            // echo "<pre>".$sql."</pre>";
    $st = $this->db->prepare($sql);
    $st->execute(array($req['id']));
    return $st;
  }
  public function add($req){
    $st = $this->db->prepare("INSERT INTO test(name, description)VALUES(?,?)");
    $st->execute(array($req['name'],$req['description']));
  }
  public function get_quest($req){
    $st = $this->db->prepare("SELECT q.test_id, q.question, q.id,
                              	concat('[',GROUP_CONCAT(concat('{\"id\":','\"',r.id,'\"', ',','\"right_res\":\"',r.right_res, '\",', '\"text\":', '\"',r.text,'\"}') SEPARATOR ','),']') res
                              FROM quest q
                              left join response r ON r.quest_id=q.id
                              GROUP BY q.test_id, q.question, q.id");
    $st->execute(array($req['id']));
    return $st;
  }
  public function add_quest($req){
    $st = $this->db->prepare("INSERT INTO quest(test_id, question	)VALUES(?,?)");
    $st->execute(array($req['test_id'],$req['question']));
  }
  public function save_quest($req){
    // var_dump($req);
    $sql = 'INSERT INTO response(	quest_id, `text`, right_res)VALUES(?,?,?)';
    $st = $this->db->prepare($sql);
    foreach ($req['res'] as $key => $val) {
      $std = $this->db->prepare("DELETE FROM response WHERE quest_id=?");
      $std->execute(array($key));
      foreach ($val as $v) {
        // var_dump($v);
        // var_dump(array($key, $v['text'], ($v['right_res'] ? 'Y' : 'N')));
        $st->execute(array($key, $v['text'], ($v['right_res'] ? 'Y' : 'N')));
      }
    }
  }
}

 ?>
