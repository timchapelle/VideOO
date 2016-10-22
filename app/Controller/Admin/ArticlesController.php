<?php

namespace App\Controller\Admin;

use App;
use App\Controller\Admin\AppController;
use Core\HTML\BootstrapForm;

/**
 * Description of AdminController
 *
 * @author Tim <tim at tchapelle.be>
 */
class ArticlesController extends AppController {

    public function __construct() {
        parent::__construct();
        if (empty($_SESSION["auth"])) {
            $this->forbidden();
        
        }
        $this->loadModele('Article');
    }

    public function index() {
        $articles = $this->Article->all();
        $this->afficher('admin.articles.index', compact('articles'));
    }

    /**
     * Ajouter un article
     */
    public function add() {
        if (!empty($_POST)) {
            $resultat = $this->Article->create([
                'titre' => $_POST["titre"],
                'contenu' => $_POST["contenu"],
                'auteur' => $_SESSION["auth"],
                'categorie_art' => $_POST["categorie"]
            ]);

            if ($resultat) {
                return $this->index();
            }
        }
        $this->loadModele('Categorie');
        $form = new BootstrapForm($_POST);
        $categories = $this->Categorie->liste('id', 'titre');
        $titre = 'Créer un article';
        $this->afficher('admin.articles.edit', compact('form', 'categories', 'titre'));
    }

    /**
     * Modifier un article
     */
    public function edit() {

        $this->loadModele('Article');
        $this->loadModele('Categorie');

        if (!empty($_POST)) {
            $resultat = $this->Article->update($_GET["id"], [
                'titre' => $_POST["titre"],
                'contenu' => $_POST["contenu"],
                'categorie_art' => $_POST["categorie"]
            ]);
            if ($resultat) {
                return $this->index();
            }
        }

        $article = $this->Article->find($_GET["id"]);
        $categories = $this->Categorie->liste('id', 'titre');

        if (!$article) {
            $this->notFound();
        }
        $form = new BootstrapForm($article);
        $titre = 'Modifier un article';
        $this->afficher('admin.articles.edit', compact('article', 'categories', 'form', 'titre'));
    }

    /**
     * Supprimer un article 
     */
    public function delete() {
        $this->loadModele('Article');

        if (!empty($_POST)) {
            $resultat = $this->Article->delete($_POST["id"]);
            if ($resultat) {
                return $this->index();
            }
        }
    }

}
