<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\ClientModel;

class ClientJsController  extends CoreController
{
    private ClientModel $clientModel;
    public function __construct()
    {
        parent::__construct();
        $this->clientModel = new ClientModel();
    }
    public function load()
    {
        if (isset($_REQUEST["action"])) {
            $action=$_REQUEST["action"];
            if ($action=="liste") {
                $this->listeClient();
            }elseif ($action=="add") {
                $this->ajoutClient();
            }elseif ($action=="fiche") {
                $this->ficheClient();
            }
        }else{
            $this->listeClient();
        }
    }



    public function listeClient(){
        $elementPerPage =5;
        $page = $_REQUEST["page"] ?? "1";
        $offset = ($page - 1) * $elementPerPage;
        $datas = $this->clientModel->findBy([], $offset);
        if (isset($_REQUEST["verif"])) {
            $datas = $this->clientModel->findBy()(["tel" => $_REQUEST["tel"], "categorie" => $_REQUEST["categorie"]]);
             parent::loadJson($datas);
             exit();
        }
        $clients = $datas["datas"];
        $count = $datas['count']->count;
        $nbrPage = ceil($count / $elementPerPage);
        parent::loadview("clients/liste",[
            "clients" => $clients,
            "page" => $page,
            "nbrPage" => $nbrPage,
            "filtre" => ["tel" => $_REQUEST["tel"] ?? "", "categorie" => $_REQUEST["categorie"] ?? ""]
        ]);
    }
    public function ajoutClient(){
      
        parent::loadview("clients/ajout");
    }
    public function ficheClient(){
      
        parent::loadview("clients/fiche");
    }
}
