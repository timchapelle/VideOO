<?php

namespace App\Controller;

use \App;

/**
 * Classe ArticleController
 *
 * @author Tim <tim at tchapelle.be>
 */
class ArticlesController extends AppController {

    public function __construct() {
        parent::__construct();
        $this->loadModele('Article');
        $this->loadModele('Categorie');
    }

    public function index() {
        $articles = $this->Article->last();
        $categories = $this->Categorie->all();
        $this->afficher('articles.index', compact('articles', 'categories'));
    }

    public function categories() {
        $categorie = $this->Categorie->find($_GET["id"]);

        if (!$categorie) {
            $this->notFound();
        }
        $articles = $this->Article->getByCategorie($_GET["id"]);
        if (!$articles) {
            $this->notFound();
        } else {
            $categories = $this->Categorie->all();
        }
        App::getInstance()->setTitre(($categorie->titre));
        $this->afficher('articles.categories', compact('articles', 'categories', 'categorie'));
    }

    public function show() {
        $article = $this->Article->findWithCategory($_GET["id"]);
        if (!$article) {
            $this->notFound();
        } else {
            $cat = ($article->categorie === null) ? 'Catégorie non définie' : $article->categorie;
            App::getInstance()->setTitre(($article->titre));
        }
        $this->afficher('articles.show', compact('article', 'cat'));
    }

}
