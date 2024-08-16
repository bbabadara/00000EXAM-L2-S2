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
                echo "ok";
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
                    $this->paiementModel->doInsert("paiement", $_POST);
                    // self::generateRecu($_POST);
                } else {
                    $this->session->addAsoc("errors", "montantpay", "le montant doit etre inferieur ou egal au montant restant");
                }
            } else {
                $this->session->add("errors", $this->validator->errors);
            }
            parent::redirect("dettes", "detail", ["idDette" => $_POST["idDette"]]);
    }

    public function genererNumeroPAY()
    {
        $n = mt_rand(0, 9999999999);
        return 'PAY' . str_pad($n, 10, '0', STR_PAD_LEFT);
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
