<?php
use Boutik\Config\Router;
 define("ROOT", "C:/Users/bbaba/Documents/00EXAML2S2/php");
 define("WEBROOT", "http://localhost:8000");
 require_once ROOT . "/vendor/autoload.php";
$root=new Router;
$root->root();