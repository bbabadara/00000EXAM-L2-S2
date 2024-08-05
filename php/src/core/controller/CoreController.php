<?php

namespace Boutik\Core\Controller;

use Boutik\Core\Session\Session;
use Boutik\Core\Validator\Validator;

class CoreController
{
    private Validator $validator;
    private Session $session;

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

    public function path(string $controller, string $page, array $additional = []): string
    {
        $link = WEBROOT . "/?controller=$controller&page=$page";
        if (!empty($additional)) {
            foreach ($additional as $key => $value) {
                $link = $link . "&" . "$key=$value";
            }
        }
        return $link;
    }

    public function redirectToRoute(string $controller, string $page, array $actions=[])
    {
        $ur="/?controller=$controller&page=$page";
        if (!empty($actions)) {
            foreach ($actions as $key => $value) {
                $ur = $ur . "&" . "$key=$value";
            }
        }
        header("location:".WEBROOT.$ur);
        exit;
    }

    public function estPositive($val)
    {
        return $val > 0 ? true : false;
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
