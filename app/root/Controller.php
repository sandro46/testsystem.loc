<?php
/**
 *
 */
class Controller extends PController{


  function index($req){
    $params['test'] = $this->model->getTest($req);
    return $this->render(__DIR__.'/tpl/root.php', $params);
  }
  function auth($req){
    return $this->render(__DIR__.'/tpl/auth.php', $req);
  }
  function save_user($req){
    $this->model->save_user($req);
    $_SESSION['uname']=$req['name'];
    $_SESSION['uemail']=$req['email'];
    header("Location: ".$req['uri']);
  }
}
