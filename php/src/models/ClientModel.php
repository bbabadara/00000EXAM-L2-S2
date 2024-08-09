<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class ClientModel extends CoreModel{
    public function __construct() {
       parent::__construct();

    }
public function getAll(){
     $sql="SELECT * from client";
    return parent::doSelect($sql);
}
public function findByTel($tel){
    $sql="SELECT * from client where tel=$tel";
    return parent::doSelect($sql,true);
}

}
    