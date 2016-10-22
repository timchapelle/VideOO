<?php

namespace App\Controller\Admin;
use App;
use App\Controller\Admin\AppController;
use Core\HTML\BootstrapForm;
/**
 * Description of GroupesController
 *
 * @author Tim <tim at tchapelle.be>
 */
class GroupesController extends AppController {
    
    public function __construct() {
        parent::__construct();
        $this->loadModele('Groupe');
    }
    
    public function index() {
        $groupes = $this->Groupe->all();
        App::getInstance()->setTitre(('Groupes'));
        $this->afficher('admin.groupes.index', compact('groupes'));
    }

    /**
     * Ajouter un groupe
     */
    public function add() {
        if (!empty($_POST)) {
            $resultat = $this->Groupe->create([
                'nom' => $_POST["nom"],
            ]);

            if ($resultat) {
                return $this->index();
            }
        }
        $form = new BootstrapForm($_POST);
        $titre = 'Ajouter un groupe';
        App::getInstance()->setTitre($titre);
        $this->afficher('admin.groupes.edit', compact('form', 'titre'));
    }

    /**
     * Modifier un groupe
     */
    public function edit() {

        if (!empty($_POST)) {
            $resultat = $this->Groupe->update($_GET["id"], [
                'nom' => $_POST["nom"],
            ]);
            if ($resultat) {
                return $this->index();
            }
        }

        $groupe = $this->Groupe->find($_GET["id"]);
        

        if (!$groupe) {
            $this->notFound();
        }
        $form = new BootstrapForm($groupe);
        $titre = 'Modifier un groupe';
        App::getInstance()->setTitre($titre);
        $this->afficher('admin.groupes.edit', compact('groupe', 'form', 'titre'));
    }

    /**
     * Supprimer un groupe 
     */
    public function delete() {
        if (!empty($_POST)) {
            $resultat = $this->Groupe->delete($_POST["id"]);
            if ($resultat) {
                return $this->index();
            }
        }
    }
    
}
