<?php

namespace App\Controller\Allocine;

use App;
use App\Allocine;
use App\Controller\AppController;
use Core\HTML\BootstrapForm;

/**
 * Description of RechercheController
 *
 * @author Tim <tim at tchapelle.be>
 */
class RechercheController extends AppController {

    public function index() {
        App::getInstance()->setTitre('Recherche AlloCiné');
        $form = new BootstrapForm($_POST);
        return $this->afficher('allocine.index', compact('form'));
        
    }

    public function globale() {
        if (!empty($_POST)) {
            $terme = filter_input(INPUT_POST, 'terme', FILTER_SANITIZE_STRING);
            $type = $_POST["type"];
            if ($type == 'tout') {
                $type = 'person,news,tvseries,movie';
            }
            $allocine = new Allocine(ALLOCINE_PARTNER_KEY, ALLOCINE_SECRET_KEY);
            $result = $allocine->search($terme, $type);
            App::getInstance()->setTitre('Résultats de la recherche');
            
            
            $this->afficher('allocine.recherche.globale', compact('result'));
        } else {
            return $this->index();
        }
    }

}
