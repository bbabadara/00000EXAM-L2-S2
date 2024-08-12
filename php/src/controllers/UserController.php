<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;


class UserController  extends CoreController
{
    public function load()
    {
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
            if ($action=="dashboard") {
                parent::loadview('users/dashboard');
            }
        }else{
            parent::loadview('users/dashboard');
        }

    }
  
}
