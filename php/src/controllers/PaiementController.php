<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\PaiementModel;
use TCPDF;

class PaiementController  extends CoreController
{
    private PaiementModel $paiementModel;
    private TCPDF $pdf;
    public function __construct(){
        parent::__construct();
        $this->paiementModel = new PaiementModel();
        $this->pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
    }

    
    
    public function load()
    {
        if (isset($_REQUEST["action"])) {
            $action=$_REQUEST["action"];
            if ($action=="addpaiement") {
                $this->addPaiement();
            }elseif ($action=="recu") {
                $this->AfficheRecu();
            }
        }
    }


    public  function addPaiement(){
            $this->validator->isEmpty("montantpay");
            $this->validator->isNumeric("montantpay");
            $this->validator->isPositif("montantpay");
            if ($this->validator->validate($this->validator->errors)) {
                if ($_POST["montantpay"] <= $_POST["restant"]) {
                    parent::unsetKey($_POST, ["controller", "verif", "action", "restant"]);
                    $_POST["numeropay"] = self::genererNumeroPAY();
                    $_POST["datepay"] = date("Y-m-d");
                   $idPay= $this->paiementModel->doInsert("paiement", $_POST);
                    parent::redirect("paiement", "recu", ["key" => $idPay]);
                } else {
                    $this->session->addAsoc("errors", "montantpay", "le montant doit etre inferieur ou egal au montant restant");
                }
            } else {
                $this->session->add("errors", $this->validator->errors);
            }
            parent::redirect("dettes", "detail", ["idDette" => $_POST["idDette"]]);
    }

    public function AfficheRecu(){
        $idPay = $_REQUEST["key"];
       $info= $this->paiementModel->findByIdWithClientAndDette($idPay);
       if (isset($_REQUEST["verif"])) {
        $verif=$_REQUEST["verif"];
        if ($verif=="download") {
           $this->generateRecu($info);
        }elseif ($verif=="print") {
            echo "print";
        }
       }
        parent::loadview("paiements/recu",[
            "info"=>$info
        ]);
    }

    public function genererNumeroPAY()
    {
        $n = mt_rand(0, 9999999999);
        return 'PAY' . str_pad($n, 10, '0', STR_PAD_LEFT);
    }

    

    public function generateRecu($info)
{
    $this->pdf->AddPage();
    $this->pdf->SetFont('helvetica', 'B', 16);
    // Section Boutique
    $this->pdf->Cell(0, 7, 'Boutique Bi', 0, 1, 'C');
    $this->pdf->SetFont('helvetica', '', 12);
    $this->pdf->Cell(0, 10, 'Dieupeul Dakar', 0, 1, 'C');
    $this->pdf->Cell(0, 7, 'Téléphone : 338000000', 0, 1, 'C');
    $this->pdf->Cell(0, 7, 'Email : boutiquebi@boutiquebi.sn', 0, 1, 'C');
    $this->pdf->Cell(0, 7, 'Date :'.date("d-m-Y"), 0, 1, 'C');

    // Ajouter une ligne de séparation
    $this->pdf->Ln(3);
    $this->pdf->Cell(0, 0, '', 'T', 1, 'C');
    $this->pdf->Ln(3);

    // Informations du Client
    $this->pdf->SetFont('helvetica', 'B', 14);
    $this->pdf->Cell(0, 7, 'Informations du Client', 0, 1, 'L');
    $this->pdf->SetFont('helvetica', '', 12);
    $this->pdf->Cell(0, 10, 'Nom: ' . $info->nomc, 0, 1);
    $this->pdf->Cell(0, 7, 'Prenom: ' . $info->prenomc, 0, 1);
    $this->pdf->Cell(0, 7, 'Telephone: ' . $info->tel, 0, 1);
    $this->pdf->Cell(0, 7, 'Email: ' . $info->email, 0, 1);
    $this->pdf->Cell(0, 7, 'Adresse: ' . $info->adresse, 0, 1);

    // Ajouter une ligne de séparation
    $this->pdf->Ln(3);
    $this->pdf->Cell(0, 0, '', 'T', 1, 'C');
    $this->pdf->Ln(3);

    // Détails de la Transaction
    $this->pdf->SetFont('helvetica', 'B', 14);
    $this->pdf->Cell(0, 10, 'Détails de la Transaction', 0, 1, 'L');
    $this->pdf->SetFont('helvetica', '', 12);
    $this->pdf->Cell(0, 7, 'Numero Dette: ' . $info->numerodet, 0, 1);
    $this->pdf->Cell(0, 7, 'Montant Dette: ' . $info->montantdet. ' Fcfa', 0, 1);
    $this->pdf->Cell(0, 7, 'Numero Paiement: ' . $info->numeropay, 0, 1);
    $this->pdf->Cell(0, 7, 'Montant Paiement: ' . $info->montantpay . ' Fcfa', 0, 1);
    $this->pdf->Cell(0, 7, 'Date Paiement: ' . $info->datepay, 0, 1);

    // Génération du PDF
    $filename = 'recu_paiement_' . $info->numeropay;
    $this->pdf->Output($filename . '.pdf', 'I');
}

}
