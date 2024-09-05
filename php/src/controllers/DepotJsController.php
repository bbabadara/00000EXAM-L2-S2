<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\ClientModel;
use Boutik\Models\DepotModel;

class DepotJsController  extends CoreController
{
    private DepotModel $depotModel;
    private ClientModel $clientModel;
    public function __construct()
    {
        parent::__construct();
        $this->depotModel = new DepotModel();
        $this->clientModel = new ClientModel();
    }
    public function load()
    {
        if (isset($_REQUEST["verif"])) {
            $verif=$_REQUEST["verif"];
            if ($verif=="findbytel") {
                $this->findByTel();
            }elseif ($verif=="new") {
                $this->addDepot();
            }
        }
        $this->showList();
        // parent::loadview("depots/depot");
    }

    public function showList()
    {
        $elementPerPage = 3;
        $page = $_REQUEST["page"] ?? "1";
        $offset = ($page - 1) * $elementPerPage;
        $datas = $this->depotModel->findDep([], $offset);
        if (isset($_REQUEST["verif"]) && $_REQUEST["verif"]="filter") {
            $datas = $this->depotModel->findDep(["tel" => $_REQUEST["tel"], "datedep" => $_REQUEST["datedep"]], $offset);
        }
        $depots = $datas["datas"];
        $count = $datas['count']->count;
        $nbrPage = ceil($count / $elementPerPage);
        parent::loadview("depots/depot", [
            "depots" => $depots,
            "page" => $page,
            "nbrPage" => $nbrPage,
            "filtre" => ["tel" => $_REQUEST["tel"] ?? "", "datedep" => $_REQUEST["datedep"] ?? ""]
        ]);
    }

    public function findByTel()
    {
        $this->session->unset("clientDepot");
        $this->validator->isNumeric("telsearch");
        $this->validator->isEmpty("telsearch");
        if ($this->validator->validate($this->validator->errors)) {
            $client = $this->clientModel->findByTel($_REQUEST["telsearch"]);
            if ($client) {
                $this->session->add("clientDepot", $client);
                if ($client->categorie != "solvable") {
                    $this->session->addAsoc("errors","categorie","Les depots ne sont possibles que pour les clients solvables");
                }
            } else {
                $this->session->addAsoc("errors", "telsearch", "ce client n'existe pas");
            }
        } else {
            $this->session->add("errors", $this->validator->errors);
        }
        parent::redirect("depots", "depot");
    }
   

    public  function addDepot(){
        $this->validator->isEmpty("montantdep");
        $this->validator->isNumeric("montantdep");
        $this->validator->isPositif("montantdep");
        if ($this->validator->validate($this->validator->errors)) {
                parent::unsetKey($_POST, ["controller", "verif", "action", "restant","origine"]);
                $_POST["numerodep"] = parent::genererNumero("DEP");
                $_POST["datedep"] = date("Y-m-d");
                $this->depotModel->doInsert("depot", $_POST);
                $this->clientModel->updateSolde(["solde"=> $_POST["montantdep"],"idcl"=> $_POST["idClient"]]);
                $this->session->unset("clientDepot");
                $this->session->addAsoc("success", "montantdep", "Le depot a bien été effectué");
                parent::redirect("depots", "depot");
           
        } else {
            $this->session->add("errors", $this->validator->errors);
        }
        parent::redirect("depots", "depot");
}

}
