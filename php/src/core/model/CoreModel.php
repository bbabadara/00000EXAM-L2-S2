<?php
namespace Boutik\Core\Model;

class CoreModel
{
    protected \PDO|null $pdo=null;
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
public function doUpdate(){
  echo "";
}
}