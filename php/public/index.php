<?php
use Boutik\Core\Routeur\Routeur;
 define("ROOT", "C:/Users/bbaba/Documents/00EXAML2S2/php");
 define("WEBROOT", "http://localhost:8051");
 require_once ROOT . "/vendor/autoload.php";
$root=new Routeur;
$root->root();