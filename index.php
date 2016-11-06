<?php

// define(SYS_ROOT, __DIR__);
session_start();
define(SYS_PATH, '/');
set_include_path(get_include_path().';'.__DIR__.'/lib/');
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});



$request = explode('?', $_SERVER['REQUEST_URI'])[0];
$ctl = substr($request,1) ? substr($request,1) : 'root/index';
$ctl = explode('/',$ctl);
// var_dump($request);
// var_dump($ctl);
if(!$_SESSION['uemail'] and $ctl[1]!='save_user'){$ctl[0]='root'; $ctl[1]='auth';}
if(file_exists($path = __DIR__.'/app/'.$ctl[0].'/Controller.php')) {
  include __DIR__.'/app/'.$ctl[0].'/Model.php';
  include $path;
  define('CONTROLLER', $ctl[0]);
}else die('controller not found');
if(!$ctl[1]) $ctl[1]='index';
$controller = new Controller(new Model);
echo $controller->$ctl[1]($_REQUEST);

?>
