<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\DepotModel;

class DepotJsController  extends CoreController
{
    private DepotModel $depotModel;
    public function __construct()
    {
        parent::__construct();
        $this->depotModel = new DepotModel();
    }
    public function load()
    {
        
        parent::loadview("depots/depot");
    }
}
