<?php
class Model extends PModel{
  public function get($req){
    return $this->db->query("SELECT * FROM test");
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
                              WHERE q.test_id=?
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
  function save_res($req){
    // array(3) { ["test/save_res"]=> string(0) "" ["test_id"]=> string(1) "1" ["res"]=> array(3) { [1]=> string(2) "52" [2]=> string(2) "55" [3]=> string(2) "59" } }

    $ress = array();
    $quest = array();
    foreach ($req["res"] as $key => $val) {
      $ress[]=$key;
      $quest[]=$val;
      $placeholders[] = '?';
    }
    $sql = "SELECT q.question, r.text
            FROM quest q
            JOIN response r ON r.quest_id=q.id and r.id in(".implode(',',$placeholders).")
            WHERE q.id in(".implode(',',$placeholders).")";
    // var_dump($sql);
    $st = $this->db->prepare($sql);
    $st->execute(array_merge($quest,$ress));
    $save = array();
    while($row = $st->fetch()){
      $save[$row['question']] = $row['text'];
    }
    $st = $this->db->prepare("INSERT INTO result(uemail, tid, res) VALUES (?,?,?)");
    $st->execute(array($req['uemail'], $req["test_id"], json_encode($save, JSON_UNESCAPED_UNICODE)));
    // $this->model->save_res($req);
  }
}

 ?>
