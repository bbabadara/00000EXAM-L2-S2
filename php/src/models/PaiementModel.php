<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class PaiementModel extends CoreModel{
    public function __construct() {
       parent::__construct();
       $this->primaryKey="idpay";
       $this->table="paiement";
       $this->nbrElement=5;

    }
public function getAll(){
     $sql="SELECT * from paiement";
    return parent::doSelect($sql);
}
public function findAllByDetteId($id){
    $sql="SELECT * from paiement where idDette=$id";
    return parent::doSelect($sql);
}

public function getPaiementToday(){
    $sql="SELECT p.*,d.iddet FROM paiement p JOIN dette d ON p.idDette = d.iddet WHERE p.datepay = CURDATE()";
    $count="SELECT count(*) as count FROM paiement p JOIN dette d ON p.idDette = d.iddet WHERE p.datepay = CURDATE()";
    return [parent::doSelect($sql),parent::doSelect($count,true)];
}

}
