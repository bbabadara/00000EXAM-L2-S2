<?php
namespace  Boutik\Controllers;
use Boutik\Core\Controller\CoreController;


class DetteController  extends CoreController {
    public function load(){
        parent::loadview("dettes/listeDette");
    }

    public function showListDette(){
        echo "";
    }
    public function showDetailsDette(){
        echo "";
    }
    public function addDette(){
        echo "";
    }
   
}