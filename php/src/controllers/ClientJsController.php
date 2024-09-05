<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\ClientModel;
use Boutik\Models\DepotModel;
use Boutik\Models\DetteModel;

class ClientJsController  extends CoreController
{
    private ClientModel $clientModel;
    private DetteModel $detteModel;
    private DepotModel $depotModel;


    public function __construct()
    {
        parent::__construct();
        $this->clientModel = new ClientModel();
        $this->detteModel = new DetteModel();
        $this->depotModel = new DepotModel();

    }
    public function load()
    {
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
            if ($action == "liste") {
                $this->listeClient();
            } elseif ($action == "add") {
                $this->ajoutClient();
            } elseif ($action == "fiche") {
                $this->ficheClient();
            }
        } else {
            $this->listeClient();
        }
    }



    public function listeClient()
    {
        $elementPerPage = 5;
        $page = $_REQUEST["page"] ?? "1";
        $offset = ($page - 1) * $elementPerPage;
        $datas = $this->clientModel->findBy([], $offset);
        if (isset($_REQUEST["verif"])) {
            $datas = $this->clientModel->findBy()(["tel" => $_REQUEST["tel"], "categorie" => $_REQUEST["categorie"]]);
            //  parent::loadJson($datas);
            //  exit();
        }
        $clients = $datas["datas"];
        $count = $datas['count']->count;
        $nbrPage = ceil($count / $elementPerPage);
        parent::loadview("clients/liste", [
            "clients" => $clients,
            "page" => $page,
            "nbrPage" => $nbrPage,
            "filtre" => ["tel" => $_REQUEST["tel"] ?? "", "categorie" => $_REQUEST["categorie"] ?? ""]
        ]);
    }
    public function ajoutClient()
    {
        if(isset($_REQUEST["verif"])){
            foreach ($_GET as $key => $value) {
                $this->validator->isEmpty("$key");
            }
            
            if ($this->validator->validate($this->validator->errors)) {
                echo "a";
            }else {
                $this->session->add("errors", $this->validator->errors);
            }
        }

        parent::loadview("clients/ajout");
    }
    public function ficheClient()
    {
        $client = $this->clientModel->findById($_REQUEST["idcl"]);
        $dettes=$this->detteModel->findByIdClient($_REQUEST["idcl"]);
        $depots=$this->depotModel->findByIdClient($_REQUEST["idcl"]);
        // parent::dd($dettes);
        parent::loadview(
            "clients/fiche",
            [
                "client" => $client,
                "dettes"=>$dettes,
                "depots"=>$depots
            ]
        );
    }
}
