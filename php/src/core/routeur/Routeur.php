<?php
namespace Boutik\Core\Routeur;
use Boutik\Controllers\DetteController;
class Routeur
{
    public function root()
    {
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
            } elseif ($recup == "paiement") {
                echo "paiement";
            }else{
                echo "on y viendra";
            }
        } else {
            echo "default";
        }
    }
}
