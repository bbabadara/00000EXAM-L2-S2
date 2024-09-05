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

    public function findDep(array $filtre=[],int $offset = 0)
    {
        $conditions = parent::generateCondition($filtre);
        $count="SELECT count(*) as count FROM depot d join client c on d.idClient=c.idcl";
        $sql = "SELECT * FROM  depot d join client c on d.idClient=c.idcl";
        $sql=$conditions!=""?$sql." WHERE $conditions":$sql;
        $sql=$sql." LIMIT $offset,$this->nbrElement";
        $count=$conditions!=""?$count." WHERE $conditions":$count;
        return ["datas"=>$this->doSelect($sql),"count"=>$this->doSelect($count,true)] ;
    }

    public function findByIdClient($id){
        $sql="SELECT * FROM $this->table WHERE idClient=$id";
        return $this->doSelect($sql);
    }

   

}
