<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class ArticleModel extends CoreModel{
    public function __construct() {
       parent::__construct();

    }
public function getAll(){
     $sql="SELECT * from article";
    return parent::doSelect($sql);
}
public function getByRef($ref){
     $sql="SELECT * from article where refart like '$ref' ";
    return parent::doSelect($sql,true);
}
public function findByDetteId($id){
    $sql="SELECT *,(qte*prixAchat) sousTotal,SUM((qte*prixAchat)) prixTotal from article a join artdette ad on a.idart=ad.idArticle join dette d on ad.idDette=d.iddet WHERE d.iddet=$id GROUP BY d.iddet ";
    return parent::doSelect($sql);
}

}
