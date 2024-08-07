<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;


class PaiementController  extends CoreController
{
    public function load()
    {
        parent::loadview("errors/404error", [], "security");
    }
}
