<?php

namespace App\Controller;

use Core\Controller\Controller;
use \App;

/**
 * Description of AppController
 *
 * @author Tim <tim at tchapelle.be>
 */
class AppController extends Controller {

    protected $template = 'defaut';

    public function __construct() {
        $this->viewPath = ROOT . '/app/vues/';
    }

    protected function loadModele($modele) {
        $this->$modele = App::getInstance()->getTable($modele);
    }

    

}
