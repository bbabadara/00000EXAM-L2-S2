<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\ClientModel;
use Boutik\Models\UserModel;

class SecurityController  extends CoreController
{
    private UserModel $userModel;
    private ClientModel $clientModel;

    public function __construct()
    {
        parent::__construct();
        $this->userModel = new UserModel();
        $this->clientModel = new ClientModel();
    }
    public function load()
    {
        if (isset($_REQUEST["action"])) {
            $action = $_REQUEST["action"];
            if ($action == "login") {
                self::login();
            } elseif ($action == "logout") {
                self::logout();
            }
        } else {
            self::login();
        }
    }

    public function login()
    {
        if ($this->session->isset("userConnect")) {
            parent::redirect("user", "dashboard");
        }
        if (isset($_REQUEST["login"])) {
            $this->session->add("userLog", $_POST);
            $this->validator->isEmpty("login", "login obligatoire");
            $this->validator->isEmpty("mdp", "mot de passe obligatoire");
            if ($this->validator->validate($this->validator->errors)) {
                extract($_POST);
                $userConnect = $this->userModel->findUserConnect($login, $mdp);
                if ($userConnect) {
                    if ($userConnect->etat == "actif") {
                        $this->session->add("userConnect", $userConnect);
                        switch ($this->session->getRole()) {
                            case 'Boutiquier':
                                parent::redirect("user", "dashboard");
                                break;
                            case 'Client':
                                $client = $this->clientModel->findByTel($userConnect->login);
                                parent::redirect("clients", "fiche",["idcl"=>$client->idcl]);

                                break;
                            default:
                                parent::redirect("security", "login");
                                break;
                        }
                    } elseif ($userConnect->etat == "inactif") {
                        $this->session->addAsoc("errors", "alert", "Ce compte est inactif.");
                    }
                    // parent::dd($this->session->getRole());
                } else {
                    $this->session->addAsoc("errors", "alert", "login ou mot de passe incorrect!");
                }
            } else {
                $this->session->add("errors", $this->validator->errors);
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
