<?php

namespace  Boutik\Controllers;

use Boutik\Controllers\ErrorsController;
use Boutik\Core\Controller\CoreController;
use Boutik\Models\ArticleModel;
use Boutik\Models\ClientModel;
use Boutik\Models\DetteModel;
use Boutik\Models\PaiementModel;

class DetteController  extends CoreController
{
    private DetteModel $detteModel;
    private ArticleModel $articleModel;
    private ErrorsController $errorsController;
    private PaiementModel $paiementModel;
    private ClientModel $clientModel;
    public function __construct()
    {
        parent::__construct();
        $this->detteModel = new DetteModel();
        $this->errorsController = new ErrorsController();
        $this->articleModel = new ArticleModel();
        $this->paiementModel = new PaiementModel();
        $this->clientModel = new ClientModel();
    }
    public function load()
    {
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
            if ($action == "liste") {
                self::showListDette();
            } elseif ($action == "detail") {
                self::showDetailsDette();
            } elseif ($action == "add") {
                self::addDette();
            } else {
                $this->errorsController->load404();
            }
        } else {
            self::showListDette();
        }
    }

    public function showListDette()
    {
        $dettes = $this->detteModel->getAll();
        if (isset($_REQUEST["verif"]) && $_REQUEST["verif"] == "findbytel") {
            $this->validator->isEmpty("telclient");
            if ($this->validator->validate($this->validator->errors)) {
                $recup = $this->detteModel->findByTel($_REQUEST["telclient"]);
                if (!empty($recup)) {
                    $dettes = $recup;
                } else {
                    $this->session->addAsoc("errors", "telclient", "Client introuvable");
                }
            } else {
                $this->session->add("errors", $this->validator->errors);
            }
        }
        // parent::dd(serialize($dettes));
        // parent::loadview("dettes/listeDette", ["dettes" => $dettes]);
        parent::loadview("users/dashboard");
    }
    public function showDetailsDette()
    {
        if (isset($_REQUEST["idDette"])) {
            $key = $_REQUEST["idDette"];
            if (isset($_REQUEST["verif"]) && $_REQUEST["verif"] == "addpay") {
                $this->validator->isEmpty("montantpay");
                $this->validator->isNumeric("montantpay");
                $this->validator->isPositif("montantpay");
                if ($this->validator->validate($this->validator->errors)) {
                    if ($_POST["montantpay"] <= $_POST["restant"]) {
                        parent::unsetKey($_POST, ["controller", "verif", "action", "restant"]);
                        $_POST["numeropay"] = self::genererNumeroPAY();
                        $_POST["datepay"] = date("Y-m-d");
                        $this->detteModel->doInsert("paiement", $_POST);
                        parent::redirect("dettes", "detail", ["idDette" => $_POST["idDette"]]);
                    } else {
                        $this->session->addAsoc("errors", "montantpay", "le montant doit etre inferieur ou egal au montant restant");
                    }
                } else {
                    $this->session->add("errors", $this->validator->errors);
                }
            }
            $dette = $this->detteModel->findById($key);
            
            $disable = $dette->restant == 0 ? "disabled" : "";
            parent::loadview("dettes/detailDette", [
                "dette" => $dette,
                "articles" => $this->articleModel->findByDetteId($key),
                "paiements" => $this->paiementModel->findAllByDetteId($key),
                "disable" => $disable
            ]);
        } else {
            $this->errorsController->load404();
        }
    }
    public function addDette()
    {
        if (isset($_REQUEST["verif"])) {
            $verif = $_REQUEST["verif"];
            if ($verif == "findbytel") {
                $this->session->unset("client");
                $this->session->unset("article");
                $this->session->add("tabArticle",[]);
                $this->validator->isNumeric("telsearch");
                $this->validator->isEmpty("telsearch");
                if ($this->validator->validate($this->validator->errors)) {
                    $client = $this->clientModel->findByTel($_REQUEST["telsearch"]);
                    if ($client) {
                        $this->session->add("client",$client);
                        // parent::dd($_SESSION["client"]);
                    } else {
                        $this->session->addAsoc("errors", "telsearch", "ce client n'existe pas");
                    }
                } else {
                    $this->session->add("errors", $this->validator->errors);
                }
            }elseif($verif == "findart") {
                $this->session->unset("article");
                $this->validator->isEmpty("ref");
                if ($this->validator->validate($this->validator->errors)) {
                    $article=$this->articleModel->getByRef($_REQUEST["ref"]);
                    if ($article) {
                        $this->session->add("article",$article);
                        } else {
                            $this->session->addAsoc("errors", "ref", "ce produit n'existe pas");
                        }
                    } else {
                    $this->session->add("errors", $this->validator->errors);
                }
            }elseif($verif == "sltqte") {
                $this->validator->isNumeric("qte");
                $this->validator->isPositif("qte");
                if ($this->validator->validate($this->validator->errors)) {
                   if ($_REQUEST["qte"]<=$this->session->get("article")->qteStock) {
                    if (self::findArticleSessionByid($this->session->get("article")->idart,$this->session->get("tabArticle"))) {
                        self::updateQteTabArticle($this->session->get("article")->idart,$_SESSION["tabArticle"],$_REQUEST["qte"]);
                    }else{
                        $newAdd=[
                            "idart" => $this->session->get("article")->idart,
                            "refart"=>$this->session->get("article")->refart,
                            "libart"=>$this->session->get("article")->libart,
                            "qte"=>$_REQUEST["qte"],
                            "prixu"=>$this->session->get("article")->prixu,
                            "total" => $_REQUEST["qte"]*$this->session->get("article")->prixu
                        ];
                        $this->session->addtotable("tabArticle",$newAdd);
                    }
                    
                   }else {
                    $this->session->addAsoc("errors", "qte", "la quantite doit etre inferieur ou egal à la quantite en stock");
                   }
                }else{
                    $this->session->add("errors", $this->validator->errors);
                }
            }elseif($verif == "remove") {
                $this->session->unset2("tabArticle",$_REQUEST["key"]);
            }elseif($verif == "saveDette") {
                $nDette = [
                    "numerodet" => self::genererNumeroDette(),
                    "datedet" => date("Y-m-d"),
                    "montantdet" => intval($_REQUEST["montant"]),
                    "idClient" => $this->session->get("client")->idcl
                ];
                // parent::dd($nDette);
              $idDette=$this->detteModel->doInsert("dette",$nDette);
              $this->detteModel->addToArtDette($idDette,$this->session->get("tabArticle"));
              $this->detteModel->updateArticleStockAfterDette($this->session->get("tabArticle"));
              $this->session->unset("client");
              $this->session->unset("article");
              $this->session->unset("tabArticle");
              parent::redirect("dettes","detail",["idDette"=>$idDette]);
            }
        }

        parent::loadview("dettes/ajoutDette");
    }

    public function genererNumeroPAY()
    {
        $n = mt_rand(0, 9999999999);
        return 'PAY' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }
    public function genererNumeroDette()
    {
        $n = mt_rand(0, 9999999999);
        return 'DET' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }
  public  function findArticleSessionByid($ref,$all){
    if(!empty($all)){
        foreach ($all as $value) {
            if ($value["idart"]==$ref) {
                return $value;
            }
        }
    }
       return false;
    }
   public function updateQteTabArticle($ref,&$all,$qte){
        foreach ($all as $key =>$value) {
            if ($value["idart"]==$ref) {
                 $all[$key]["qte"]=$all[$key]["qte"]+$qte;
                 break;
            }
        }
    }
   public function updateQteArticleSession($ref,&$all,$qte){
        
        foreach ($all as $key => $value) {
            if ($value["libelle"]==$ref) {
                 $all[$key]["qtestock"]-=$qte;
                 break;
            }
        }
    }
}
