<?php

namespace App\Controller\Admin;

use Core\Auth\DbAuth;
use \App;

/**
 * Description of AppController
 *
 * @author Tim <tim at tchapelle.be>
 */
class AppController extends App\Controller\AppController {

    public function __construct() {
        parent::__construct();
        $this->loadModele('Utilisateur');
        $this->currentUser = $this->Utilisateur->find($_SESSION["auth"]);
        if (!$this->currentUser->admin) {
            $this->admin = false;
            $this->forbidden();
        }
        else $this->admin = true;
    }

}
