<?php
/**
 *
 */
class Controller{
  private $model;
  function __construct($model){
    $this->model = $model;
  }

  private function render($tpl, $params, $req = null){
    ob_start();
    include 'tpl/'.$tpl;
    $tpl = ob_get_contents();
    ob_end_clean();
    return $tpl;
  }

  function index($req){
    return $this->render('root.php', $req);
  }
}
