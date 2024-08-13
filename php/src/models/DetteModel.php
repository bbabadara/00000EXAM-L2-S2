<?php
namespace  Boutik\Models;

use Boutik\Core\Model\CoreModel;

class DetteModel extends CoreModel{
    
    public function __construct() {
       parent::__construct();

    }
public function getAll(){
      $sql="SELECT d.*,cl.*,COALESCE(SUM(montantpay),0) verse,(d.montantdet - COALESCE(SUM(p.montantpay),0)) AS restant FROM `dette`d JOIN client cl on d.idClient=cl.idcl LEFT JOIN paiement p on d.iddet=p.idDette GROUP BY d.iddet HAVING restant>0";
    return parent::doSelect($sql);
}
public function getTotalVerseRestant(){
      $sql="SELECT SUM(total_verse) AS totalverse, SUM(total_restant) AS totalrestant
      FROM ( SELECT d.iddet, d.montantdet, COALESCE(SUM(p.montantpay), 0) AS total_verse, (d.montantdet - COALESCE(SUM(p.montantpay), 0)) AS total_restant
       FROM dette d JOIN client cl ON d.idClient = cl.idcl LEFT JOIN paiement p ON d.iddet = p.idDette GROUP BY d.iddet, d.montantdet HAVING total_restant > 0 )
     AS sous_requete;";
    return parent::doSelect($sql,true);
}
public function getDetteToday(){
    $sql="SELECT d.*, cl.*, COALESCE(SUM(p.montantpay), 0) AS verse, (d.montantdet - COALESCE(SUM(p.montantpay), 0)) AS restant
     FROM dette d JOIN client cl ON d.idClient = cl.idcl LEFT JOIN paiement p ON d.iddet = p.idDette WHERE d.datedet = CURDATE();";
    $count="SELECT COUNT(*) as count  FROM dette d JOIN client cl ON d.idClient = cl.idcl LEFT JOIN paiement p ON d.iddet = p.idDette WHERE d.datedet = CURDATE();";
    return [parent::doSelect($sql),parent::doSelect($count,true)];
}
public function findByTel($tel){
      $sql="SELECT d.*,cl.*,COALESCE(SUM(montantpay),0) verse,(d.montantdet - COALESCE(SUM(p.montantpay),0)) AS restant FROM `dette`d JOIN client cl on d.idClient=cl.idcl LEFT JOIN paiement p on d.iddet=p.idDette where cl.tel=$tel GROUP BY d.iddet";
    return parent::doSelect($sql);
}
public function findById($id){
     $sql="SELECT d.*, cl.*, COALESCE(SUM(p.montantpay), 0) AS verse, (d.montantdet - COALESCE(SUM(p.montantpay), 0)) AS restant FROM dette d JOIN client cl ON d.idClient = cl.idcl LEFT JOIN paiement p ON d.iddet = p.idDette WHERE d.iddet = $id GROUP BY d.iddet;";
    return parent::doSelect($sql,true);
}
public function addToArtDette($iddette,$table){
    foreach ($table as $value) {
        $nArtDette=[
            "idDette"=>$iddette,
            "idArticle"=>$value["idart"],
            "qte"=>$value["qte"],
            "prixAchat"=>$value["prixu"]
        ];
       
        parent::doInsert("artdette",$nArtDette);
    }

}
public function updateArticleStock($stock,$idart){
    $sql="UPDATE `article` SET qtestock=(qtestock-:stock) WHERE idart =:idart";
    parent::doUpdate($sql,["stock"=>$stock,"idart"=>$idart]);
    }
    
  public  function updateArticleStockAfterDette($tab){
        foreach ($tab as $value) {
          self::updateArticleStock($value["qte"],$value["idart"]);
        }
    }

}
