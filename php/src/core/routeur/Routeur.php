<?php
namespace Boutik\Core\Routeur;
use Boutik\Controllers\DetteController;
use Boutik\Controllers\SecurityController;
use Boutik\Controllers\UserController;
use Boutik\Core\Controller\CoreController;

class Routeur
{
    public function root()
    {
        // if (!isset($_SESSION["user"]) && $_REQUEST["controller"]!="security") {
        //    $coreController=new CoreController();
        //    $coreController->redirect("security","login");
        // }

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
            }else{
                echo "on y viendra";
            }
        } else {
            $controller=new SecurityController;
                $controller->load();
        }
    }
}
