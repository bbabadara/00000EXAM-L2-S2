<?php
namespace Boutik\Core\Model;

class CoreModel
{
    protected \PDO|null $pdo=null;
    protected $table;
    protected $primaryKey;

public function __construct() {
    if ($this->pdo==null) {
        $this->pdo=new \PDO('mysql:host=localhost;dbname=ges_dette;charset=utf8','ges_dette','ExamL2S2E221');
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE,\PDO::FETCH_OBJ);
    }
}

public function doSelect(string $sql,bool $one=false){
    $result=$this->pdo->query($sql);
    if ($one) {
        return $result->fetch();
    }
    return $result->fetchAll();
}
public function doInsert(string $table,array $data){
     $columns = array_keys($data);
     $placeholders = array_map(function($key) { return ":$key"; }, $columns);
     $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
        $stmt= $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
}
public function doUpdate($sql,$data){
  $stmt= $this->pdo->prepare($sql);
  $stmt->execute($data);
}

public function selectALL(){
    $sql = "SELECT * FROM $this->table";
    return $this->doSelect($sql);
}

public function selectById($id){
    $sql = "SELECT * FROM $this->table WHERE $this->primaryKey =$id";
    return $this->doSelect($sql,true);
}

public function findByPaginate(int $offset=0,int $nbrElement=5){
    $sql = "SELECT * FROM $this->table LIMIT $offset,$nbrElement";
    return $this->doSelect($sql);
}

public function findBy(array $filtre){
    $conditions =self::generateCondition($filtre);
    $sql = "SELECT * FROM $this->table WHERE $conditions";
    return $this->doSelect($sql);
}

private function generateCondition(array $filtre){
    $conditions = "";
    foreach ($filtre as $key => $value) {
        $conditions .= "$key = '$value' AND ";
        }
        $conditions = rtrim($conditions, ' AND ');
        return $conditions;
}

}