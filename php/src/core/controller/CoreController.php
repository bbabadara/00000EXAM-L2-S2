<?php

namespace Boutik\Core\Controller;

use Boutik\Core\Session\Session;
use Boutik\Core\Validator\Validator;

class CoreController
{
    protected Validator $validator;
    protected Session $session;

    public function __construct()
    {
        $this->validator = new Validator();
        $this->session = new Session();
    }
    public function loadview(string $views, array $datas = [], $layout = "base")
    {
        ob_start();
        extract($datas);
        require_once ROOT . "/views/".$views.".html.php";
        $cFV = ob_get_clean();
        require_once ROOT."/views/layouts/" . $layout . ".layout.php";
    }

    public function path(string $controller, string $action, array $additional =[]): string
    {
        $link = WEBROOT . "/?controller=$controller&action=$action";
        if (!empty($additional)) {
            foreach ($additional as $key => $value) {
                $link =$link."&"."$key=$value";
            }
        }
        return $link;
    }

    public function redirect(string $controller, string $page, array $actions=[])
    {
        $ur="/?controller=$controller&action=$page";
        if (!empty($actions)) {
            foreach ($actions as $key => $value) {
                $ur = $ur . "&" . "$key=$value";
            }
        }
        header("location:".WEBROOT.$ur);
        exit;
    }

    
    public function unsetKey(array &$tab, array $keys): void
    {
        foreach ($keys as $key) {
            unset($tab[$key]);
        }
    }
  

    public function dd($test)
    {
        echo "<pre>";
        var_dump($test);
        echo "</pre>";
        die("ok");
    }

    public function dump($test)
    {
        echo "<pre>";
        var_dump($test);
        echo "</pre>";
    }

  
}
