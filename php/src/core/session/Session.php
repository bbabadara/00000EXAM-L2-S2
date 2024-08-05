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
    public function get (string $key){
        return $_SESSION[$key];
    }
}