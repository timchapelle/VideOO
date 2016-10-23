<?php

namespace App\Controller;

use Core\Auth\DbAuth;
use Core\HTML\BootstrapForm;
use \App;

/**
 * Description of UtilisateurController
 *
 * @author Tim <tim at tchapelle.be>
 */
class UtilisateursController extends AppController {

    public function login() {
        $errors = false;
        if (!empty($_POST)) {
            $auth = new DbAuth(App::getInstance()->getDb());
            if ($auth->login($_POST["login"], $_POST["password"])) {
                header('Location:index.php?p=articles.index');
            } else {
                $errors = true;
            }
        }
        $formConnexion = new BootstrapForm([$_POST]);
        $this->afficher('utilisateurs.login', compact('formConnexion', 'errors'));
    }
    
    public function logout() {
        session_destroy();
        header('Location:index.php');
    }
    
    public function index() {
        $this->loadModele('Utilisateur');
        $utilisateurs = $this->Utilisateur->all();
        $this->afficher('utilisateurs.index', compact('utilisateurs'));
    }

}
