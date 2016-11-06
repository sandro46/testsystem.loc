<?php
/**
 *
 */
class Controller extends PController{
  function index($req){
    $params['test'] = $this->model->get($req);
    $params['quest'] = $this->model->get_quest($req);
    // if($req['id'])
    return $this->render(__DIR__.'/tpl/root.php', $params, $req);
  }
  function save_res($req){
    // var_dump($req);
    $this->model->save_res($req);
    header("Location: /test/finish?test=".$req['test_id']."&uemail=".$req["uemail"]);
  }
  function finish($req){
    return $this->render(__DIR__.'/tpl/finish.php', null, $req);
    // header("Location: /test/finish?test=".$req['test_id']."&uemail=".$req["uemail"]);
  }
}
