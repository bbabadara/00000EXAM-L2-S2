<?php

namespace Boutik\Core\Model;

class CoreModel
{
    protected \PDO|null $pdo = null;
    protected $table;
    protected $primaryKey;
    protected $nbrElement=3;

    public function __construct()
    {
        if ($this->pdo == null) {
            $this->pdo = new \PDO('mysql:host=localhost;dbname=ges_dette_up;charset=utf8', 'ges_dette', 'ExamL2S2E221');
            $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ);
        }
    }

    public function doSelect(string $sql, bool $one = false)
    {
        $result = $this->pdo->query($sql);
        if ($one) {
            return $result->fetch();
        }
        return $result->fetchAll();
    }
    public function doInsert(string $table, array $data)
    {
        $columns = array_keys($data);
        $placeholders = array_map(function ($key) {
            return ":$key";
        }, $columns);
        $sql = "INSERT INTO $table (" . implode(', ', $columns) . ") VALUES (" . implode(', ', $placeholders) . ")";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $this->pdo->lastInsertId();
    }
    public function doUpdate($sql, $data)
    {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);

    }
   

    

    public function selectALL()
    {
        $sql = "SELECT * FROM $this->table";
        return $this->doSelect($sql);
    }
    public function countTable()
    {
        $sql = "SELECT COUNT(*) as count FROM $this->table";
        return $this->doSelect($sql,true);
    }

    public function selectById($id)
    {
        $sql = "SELECT * FROM $this->table WHERE $this->primaryKey =$id";
        return $this->doSelect($sql, true);
    }

    public function findByPaginate(int $offset = 0, int $nbrElement = 5)
    {
        $sql = "SELECT * FROM $this->table LIMIT $offset,$nbrElement";
        return $this->doSelect($sql);
    }

    public function findBy(array $filtre=[],int $offset = 0)
    {
        $conditions = self::generateCondition($filtre);
        $count="SELECT count(*) as count FROM $this->table";
        $sql = "SELECT * FROM $this->table";
        $sql=$conditions!=""?$sql." WHERE $conditions":$sql;
        $sql=$sql." LIMIT $offset,$this->nbrElement";
        $count=$conditions!=""?$count." WHERE $conditions":$count;
        return ["datas"=>$this->doSelect($sql),"count"=>$this->doSelect($count,true)] ;
    }

    protected function generateCondition(array $filtre)
    {
       
        $conditions = "";
        if (!empty($filtre)) {
            foreach ($filtre as $key => $value) {
                if (trim($value)) {
                    $conditions .= "$key = '$value' AND ";
                }
            }
            $conditions = rtrim($conditions, ' AND ');
        }
        return $conditions;
    }
}
