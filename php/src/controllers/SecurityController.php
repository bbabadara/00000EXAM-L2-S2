<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\UserModel;

class SecurityController  extends CoreController
{
    private UserModel $userModel;
    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
    }
    public function load()
    {
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
            if ($action == "login") {
                self::login();
            } elseif ($action == "logout") {
                self::logout();
            } else {
                parent::redirect("errors", "");
            }
        } else {
            self::login();
        }
    }

    public function login()
    {
        if (isset($_REQUEST["login"])) {
        extract($_POST);
        $userConnect = $this->userModel->findUserConnect($login, $mdp);
        if ($userConnect) {
            $this->session->add("userConnect", $userConnect);
            parent::redirect("user", "dashboard");
        } else {
            $this->session->addAsoc("errors", "alert", "login ou mot de passe incorrect");
        }
    }
        $this->loadview("security/login", [], "security");
    }

    public function logout()
    {
        session_unset();
        session_destroy();
        parent::redirect("security", "login");
    }
}
