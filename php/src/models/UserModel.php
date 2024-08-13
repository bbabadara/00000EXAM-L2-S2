<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class UserModel extends CoreModel{
    public function __construct() {
       parent::__construct();
       $this->table="users";
       $this->primaryKey="idu";
       $this->nbrElement=3;

    }
public function getAll(){
     $sql="SELECT * FROM `users` u JOIN profile p on u.idProfile=p.idp;";
    return parent::doSelect($sql);
}
public function findUserConnect(string $log, string $mdp){
    $sql="SELECT * FROM `users` u JOIN profile p on u.idProfile=p.idp where login='$log' and mdp='$mdp'";
    return parent::doSelect($sql,true);
}

}
    