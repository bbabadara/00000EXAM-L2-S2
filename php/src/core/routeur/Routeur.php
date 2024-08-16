<?php
namespace Boutik\Core\Routeur;
use Boutik\Controllers\DetteController;
use Boutik\Controllers\PaiementController;
use Boutik\Controllers\SecurityController;
use Boutik\Controllers\UserController;
use Boutik\Core\Controller\CoreController;
use Boutik\Core\Session\Session;

class Routeur
{
    private Session $session;
    private CoreController $coreController;
    public function __construct() {
       $this->session= new Session();
       $this->coreController = new CoreController();
    }
    public function root()
    {
        if (!$this->session->isset("userConnect") && $_REQUEST["controller"]!="security") {
           $this->coreController->redirect("security","login");
        }

        if (isset($_REQUEST["controller"])) {
            $recup = $_REQUEST["controller"];
            if ($recup == "dettes") {
                $controller=new DetteController;
                 $controller->load();
            } elseif ($recup == "articles") {
                echo "articles";
            } elseif ($recup == "clients") {
                echo "clients";
            } elseif ($recup == "depots") {
                echo "depots";
            } elseif ($recup == "security") {
                $controller=new SecurityController;
                $controller->load();
            } elseif ($recup == "user") {
                $controller=new UserController();
                $controller->load();
            } elseif ($recup == "paiement") {
                $controller=new PaiementController();
                $controller->load();
            }else{
                echo "on y viendra";
            }
        } else {
            $controller=new SecurityController;
                $controller->load();
        }
    }
}
