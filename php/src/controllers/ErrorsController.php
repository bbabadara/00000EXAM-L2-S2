<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;


class ErrorsController  extends CoreController
{
    public function load404()
    {
        parent::loadview("errors/404error", [], "security");
    }
}
