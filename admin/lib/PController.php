<?php
/**
 *
 */
class PController
{
  protected $model;
  function __construct($model){
    $this->model = $model;
  }

  protected function render($tpl, $params, $req = null){
    ob_start();
    include $tpl;
    $tpl = ob_get_contents();
    ob_end_clean();
    return $tpl;
  }
}


 ?>
