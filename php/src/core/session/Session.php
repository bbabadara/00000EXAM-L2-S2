<?php
namespace Boutik\Core\Session;

class Session {
    public function __construct(){
        if (session_status()==PHP_SESSION_NONE) {
            session_start();
        }
    }
    public function add (string $key,$value){
        $_SESSION[$key]=$value;
    }
    public function addtotable (string $key,$value){
        $_SESSION[$key][]=$value;
    }
    public function addAsoc (string $tab,string $key,$value){
        $_SESSION[$tab][$key]=$value;
    }
    public function get (string $key){
        return $_SESSION[$key];
    }
    public function isset (string $key){
        return isset($_SESSION[$key]);
    }
    public function unset (string $key){
        unset($_SESSION[$key]);
    }
    public function unset2 (string $key,$key2){
        unset($_SESSION[$key][$key2]);
    }
}