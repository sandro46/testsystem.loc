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
  function add($req){
    $this->model->add($req);
    header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  function add_quest($req){
    // var_dump($req);
    $this->model->add_quest($req);
    header("Location: ".$_SERVER['HTTP_REFERER']);
  }
  function save_quest($req){
    // var_dump($req);
    $this->model->save_quest($req);
    header("Location: ".$_SERVER['HTTP_REFERER']);
  }
}
