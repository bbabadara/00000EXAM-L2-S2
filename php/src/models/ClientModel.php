<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class ClientModel extends CoreModel{
    public function __construct() {
       parent::__construct();
       $this->table="client";
       $this->primaryKey="idcl";
       $this->nbrElement=5;

    }

//     public function getAll(){
//      $sql="SELECT * from client";
//     return parent::doSelect($sql);
// }
public function findByTel($tel){
    $sql="SELECT * from client where tel=$tel";
    return parent::doSelect($sql,true);
}
public function updateSolde($data){
    $sql="UPDATE `client` SET `solde` = `solde`+:solde WHERE `client`.`idcl` =:idcl;";
    return parent::doUpdate($sql,$data);
}

public function findById($id){
    $sql="SELECT cl.*, COALESCE(SUM(p.montantpay), 0) AS verse, (d.montantdet - COALESCE(SUM(p.montantpay), 0)) AS restant FROM dette d JOIN client cl ON d.idClient = cl.idcl LEFT JOIN paiement p ON d.iddet = p.idDette WHERE cl.idcl ='$id'";
   return parent::doSelect($sql,true);
}

}
    