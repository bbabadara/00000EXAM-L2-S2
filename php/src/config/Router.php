<?php
namespace  Boutik\Config;
use Boutik\Controllers\DetteController;
class Router
{
    public function root()
    {
        if (isset($_REQUEST["controller"])) {
            $recup = $_REQUEST["controller"];
            if ($recup == "dettes") {
                $controller=new DetteController;
                 $controller->load();
                echo "dettes";
            } elseif ($recup == "articles") {
                echo "articles";
            } elseif ($recup == "clients") {
                echo "clients";
            } elseif ($recup == "depots") {
                echo "depots";
            }
        } else {
            echo "default";
        }
    }
}
