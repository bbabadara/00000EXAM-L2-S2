<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class PaiementModel extends CoreModel{
    public function __construct() {
       parent::__construct();

    }
public function getAll(){
     $sql="SELECT * from paiement";
    return parent::doSelect($sql);
}
public function findAllByDetteId($id){
    $sql="SELECT * from paiement where idDette=$id";
    return parent::doSelect($sql);
}

}
