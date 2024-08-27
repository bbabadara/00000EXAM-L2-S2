<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class DepotModel extends CoreModel{
    public function __construct() {
       parent::__construct();
       $this->primaryKey="iddep";
       $this->table="depot";
       $this->nbrElement=5;

    }



}
