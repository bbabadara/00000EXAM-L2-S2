<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\ClientModel;
use Boutik\Models\DetteModel;
use Boutik\Models\PaiementModel;
use Boutik\Models\UserModel;

class UserController  extends CoreController
{
    private UserModel $userModel;
    private ClientModel $clientModel;
    private DetteModel $detteModel;
    private PaiementModel $paiementModel;
    public function __construct(){
        parent::__construct();
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
        $this->detteModel = new DetteModel();
        $this->paiementModel = new PaiementModel();

    }
    public function load()
    {
        $elementPerPage=3;
        $detteToday=$this->detteModel->getDetteToday();
        $dettes=$detteToday[0];
        $countDetteToday=$detteToday[1]->count;
        $paiementToday=$this->paiementModel->getPaiementToday();
        $paiements=$paiementToday[0];
        $countPaiementToday=$paiementToday[1]->count;
        $versementRestant=$this->detteModel->getTotalVerseRestant();
        //  parent::dd($versementRestant);

        $page=$_REQUEST["page"]??"1";
        $offset=($page-1)*$elementPerPage;
        $datas=$this->clientModel->findBy([],$offset);
        if (isset($_REQUEST["verif"])) {
            $datas=$this->clientModel->findBy(["nomc"=>$_REQUEST["nomc"],"tel"=>$_REQUEST["tel"],"categorie"=>$_REQUEST["categorie"]],$offset);
        }
        $clients=$datas["datas"];
        $count=$datas['count']->count;
        $nbrPage=ceil($count/$elementPerPage);
        parent::loadview('users/dashboard',[
        "clients"=>$clients,
        "nbrPage"=>$nbrPage,
        "page"=>$page,
        "filtre"=>["nomc"=>$_REQUEST["nomc"]??"","tel"=>$_REQUEST["tel"]??"","categorie"=>$_REQUEST["categorie"]??""],
        "nbrClient"=>$this->clientModel->countTable()->count,
        "dettes"=>$dettes,
        "nbrDette"=>$countDetteToday,
        "paiements"=>$paiements,
        "nbrPaiement"=>$countPaiementToday,
        "totalRestant"=>$versementRestant->totalrestant

    ]);
    }
  
}
