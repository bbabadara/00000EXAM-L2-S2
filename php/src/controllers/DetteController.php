<?php

namespace  Boutik\Controllers;

use Boutik\Controllers\ErrorsController;
use Boutik\Core\Controller\CoreController;
use Boutik\Models\ArticleModel;
use Boutik\Models\DetteModel;
use Boutik\Models\PaiementModel;

class DetteController  extends CoreController
{
    private DetteModel $detteModel;
    private ArticleModel $articleModel;
    private ErrorsController $errorsController;
    private PaiementModel $paiementModel;
    public function __construct()
    {
        parent::__construct();
        $this->detteModel = new DetteModel();
        $this->errorsController = new ErrorsController();
        $this->articleModel = new ArticleModel();
        $this->paiementModel = new PaiementModel();
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
       $dettes= $this->detteModel->getAll();
        if (isset($_REQUEST["verif"]) && $_REQUEST["verif"] == "findbytel"){
            $this->validator->isEmpty("telclient");
            if ($this->validator->validate($this->validator->errors)) {
                $recup=$this->detteModel->findByTel($_REQUEST["telclient"]);
                if (!empty($recup)) {
                   $dettes=$recup;
                }else{
                    $this->session->addAsoc("errors", "telclient", "Client introuvable");
                }
        }else {
            $this->session->add("errors", $this->validator->errors);
        }
    }
    parent::loadview("dettes/listeDette", ["dettes" =>$dettes]);
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
            parent::loadview("dettes/detailDette", [
                "dette" => $this->detteModel->findById($key),
                "articles" => $this->articleModel->findByDetteId($key),
                "paiements" => $this->paiementModel->findByDetteId($key)
            ]);
        } else {
            $this->errorsController->load404();
        }
    }
    public function addDette()
    {
        parent::loadview("dettes/ajoutDette");
    }

    public function genererNumeroPAY()
    {
        $n = mt_rand(0, 9999999999);
        return 'PAY' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }
}
