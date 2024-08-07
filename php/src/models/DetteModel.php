<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class DetteModel extends CoreModel{
    
    public function __construct() {
       parent::__construct();

    }
public function getAll(){
     $sql="SELECT d.*,cl.*,SUM(montantpay) verse,(d.montantdet - SUM(p.montantpay)) AS restant FROM `dette`d JOIN client cl on d.idClient=cl.idcl JOIN paiement p on d.iddet=p.idDette GROUP BY cl.idcl HAVING restant>0";
    //  $sql="SELECT d.*,cl.*,SUM(montantpay) verse,(d.montantdet - SUM(p.montantpay)) AS restant FROM `dette`d JOIN client cl on d.idClient=cl.idcl JOIN paiement p on d.iddet=p.idDette GROUP BY cl.idcl";
    return parent::doSelect($sql);
}
public function findById($id){
     $sql="SELECT d.*,cl.*,SUM(montantpay) verse,(d.montantdet - SUM(p.montantpay)) AS restant FROM `dette`d JOIN client cl on d.idClient=cl.idcl JOIN paiement p on d.iddet=p.idDette where d.iddet=$id GROUP BY cl.idcl";
    return parent::doSelect($sql,true);
}

}
