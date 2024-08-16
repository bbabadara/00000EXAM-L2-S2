<?php

namespace  Boutik\Controllers;

use Boutik\Controllers\ErrorsController;
use Boutik\Core\Controller\CoreController;
use Boutik\Models\ArticleModel;
use Boutik\Models\ClientModel;
use Boutik\Models\DetteModel;
use Boutik\Models\PaiementModel;

use TCPDF;

class DetteController  extends CoreController
{
    private DetteModel $detteModel;
    private ArticleModel $articleModel;
    private ErrorsController $errorsController;
    private PaiementModel $paiementModel;
    private ClientModel $clientModel;

    private TCPDF $pdf;
    public function __construct()
    {
        parent::__construct();
        $this->detteModel = new DetteModel();
        $this->errorsController = new ErrorsController();
        $this->articleModel = new ArticleModel();
        $this->paiementModel = new PaiementModel();
        $this->clientModel = new ClientModel();
        $this->pdf = new TCPDF();
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
        $elementPerPage = 3;
        $page = $_REQUEST["page"] ?? "1";
        $offset = ($page - 1) * $elementPerPage;
        $datas = $this->detteModel->findBy007([], $offset);
        if (isset($_REQUEST["verif"])) {
            $datas = $this->detteModel->findBy007(["tel" => $_REQUEST["tel"], "datedet" => $_REQUEST["datedet"], "etatdet" => $_REQUEST["etatdet"]], $offset);
        }
        $dettes = $datas["datas"];
        $count = $datas['count']->count;
        $nbrPage = ceil($count / $elementPerPage);
        parent::loadview("dettes/listeDette", [
            "dettes" => $dettes,
            "page" => $page,
            "nbrPage" => $nbrPage,
            "filtre" => ["tel" => $_REQUEST["tel"] ?? "", "datedet" => $_REQUEST["datedet"] ?? "", "etatdet" => $_REQUEST["etatdet"] ?? ""]
        ]);
    }
    public function showDetailsDette()
    {

        if (isset($_REQUEST["idDette"])) {
            $key = $_REQUEST["idDette"];
            $elementPerPage = 4;
            $page = $_REQUEST["page"] ?? "1";
            $offset = ($page - 1) * $elementPerPage;
            $datas = $this->paiementModel->findBy(["idDette" => $key], $offset);
            $paiements = $datas["datas"];
            $count = $datas['count']->count;
            $nbrPage = ceil($count / $elementPerPage);
            $dette = $this->detteModel->findById($key);
            $disable = $dette->restant == 0 ? "disabled" : "";
            parent::loadview("dettes/detailDette", [
                "dette" => $dette,
                "articles" => $this->articleModel->findByDetteId($key),
                "paiements" => $paiements,
                "disable" => $disable,
                "page" => $page,
                "nbrPage" => $nbrPage,
                "idDette" => $key
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
                $this->findByTel();
            } elseif ($verif == "findart") {
                $this->findArt();
            } elseif ($verif == "sltqte") {
                $this->selectQte();
            } elseif ($verif == "remove") {
                self::updateQteArticleAfterRemove($this->session->get("tabArticle"), $_SESSION["article"]);
                $this->session->unset2("tabArticle", $_REQUEST["key"]);
                parent::redirect("dettes", "add");
            } elseif ($verif == "saveDette") {
                $this->saveDette();
            }
        }

        parent::loadview("dettes/ajoutDette");
    }

    public function findByTel()
    {
        $this->session->unset("client");
        $this->session->unset("article");
        $this->session->add("tabArticle", []);
        $this->validator->isNumeric("telsearch");
        $this->validator->isEmpty("telsearch");
        if ($this->validator->validate($this->validator->errors)) {
            $client = $this->clientModel->findByTel($_REQUEST["telsearch"]);
            if ($client) {
                $this->session->add("client", $client);
            } else {
                $this->session->addAsoc("errors", "telsearch", "ce client n'existe pas");
            }
        } else {
            $this->session->add("errors", $this->validator->errors);
        }
        parent::redirect("dettes", "add");
    }
    public function findArt()
    {
        $this->session->unset("article");
        $this->validator->isEmpty("ref");
        if ($this->validator->validate($this->validator->errors)) {
            $article = $this->articleModel->getByRef($_REQUEST["ref"]);
            if ($article) {
                if ($this->session->isset("tabArticle")) {
                    self::updateQteArticleAfterSelect($this->session->get("tabArticle"), $article);
                }
                $this->session->add("article", $article);
            } else {
                $this->session->addAsoc("errors", "ref", "ce produit n'existe pas");
            }
        } else {
            $this->session->add("errors", $this->validator->errors);
        }
        parent::redirect("dettes", "add");
    }
    public function selectQte()
    {
        $this->validator->isNumeric("qte");
        $this->validator->isPositif("qte");
        if ($this->validator->validate($this->validator->errors)) {
            if ($_REQUEST["qte"] <= $this->session->get("article")->qteStock) {
                if (self::findArticleSessionByid($this->session->get("article")->idart, $this->session->get("tabArticle"))) {
                    self::updateQteTabArticle($this->session->get("article")->idart, $_SESSION["tabArticle"], $_REQUEST["qte"]);
                    $this->session->get("article")->qteStock -= $_REQUEST["qte"];
                } else {
                    $newAdd = [
                        "idart" => $this->session->get("article")->idart,
                        "refart" => $this->session->get("article")->refart,
                        "libart" => $this->session->get("article")->libart,
                        "qte" => $_REQUEST["qte"],
                        "prixu" => $this->session->get("article")->prixu,
                        "total" => $_REQUEST["qte"] * $this->session->get("article")->prixu
                    ];
                    $this->session->addtotable("tabArticle", $newAdd);
                    $this->session->get("article")->qteStock -= $_REQUEST["qte"];
                }
            } else {
                $this->session->addAsoc("errors", "qte", "la quantite doit etre inferieur ou egal à la quantite en stock");
            }
        } else {
            $this->session->add("errors", $this->validator->errors);
        }
        parent::redirect("dettes", "add");
    }

    public function saveDette()
    {
        $nDette = [
            "numerodet" => self::genererNumeroDette(),
            "datedet" => date("Y-m-d"),
            "montantdet" => intval($_REQUEST["montant"]),
            "idClient" => $this->session->get("client")->idcl
        ];
        $idDette = $this->detteModel->doInsert("dette", $nDette);
        $this->detteModel->addToArtDette($idDette, $this->session->get("tabArticle"));
        $this->detteModel->updateArticleStockAfterDette($this->session->get("tabArticle"));
        $this->session->unset("client");
        $this->session->unset("article");
        $this->session->unset("tabArticle");
        parent::redirect("dettes", "detail", ["idDette" => $idDette]);
    }


    public function genererNumeroDette()
    {
        $n = mt_rand(0, 9999999999);
        return 'DET' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }
    public  function findArticleSessionByid($ref, $all)
    {
        if (!empty($all)) {
            foreach ($all as $value) {
                if ($value["idart"] == $ref) {
                    return $value;
                }
            }
        }
        return false;
    }
    public function updateQteTabArticle($ref, &$all, $qte)
    {
        foreach ($all as $key => $value) {
            if ($value["idart"] == $ref) {
                $all[$key]["qte"] += $qte;
                break;
            }
        }
    }
    public function updateQteArticleAfterSelect($all, &$article)
    {
        foreach ($all as $key => $value) {
            if ($value["idart"] == $article->idart) {
                $article->qteStock -= $all[$key]["qte"];
                break;
            }
        }
    }
    public function updateQteArticleAfterRemove($all, &$article)
    {
        foreach ($all as $key => $value) {
            if ($value["idart"] == $article->idart) {
                $article->qteStock += $all[$key]["qte"];
                break;
            }
        }
    }



    public function generateRecu($data)
    {
        $this->pdf->AddPage();
        $this->pdf->SetFont('helvetica', 'B', 16);

        // Titre
        $this->pdf->Cell(0, 10, 'Reçu de Paiement', 0, 1, 'C');

        // Contenu
        $this->pdf->SetFont('helvetica', '', 12);
        $this->pdf->Cell(0, 10, 'Numero: ' . $data['numeropay'], 0, 1);
        $this->pdf->Cell(0, 10, 'Montant: ' . $data['montantpay'] . ' Fcfa', 0, 1);
        $this->pdf->Cell(0, 10, 'Date: ' . $data['datepay'], 0, 1);

        // Génère le PDF
        $this->pdf->Output('recu_paiement_' . $data['numeropay'] . '.pdf', 'I');
    }
}
