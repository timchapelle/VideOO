<?php

namespace App\Tables;

use \Core\Tables\Table;

/**
 * Description of Article2
 *
 * @author Tim <tim at tchapelle.be>
 */
class ArticleTable extends Table {

    public function all() {
        return $this->requete("SELECT articles.id,articles.titre,articles.contenu,articles.date,categories.titre as categorie"
                        . " FROM articles LEFT JOIN categories "
                        . "ON articles.categorie_art = categories.id");
    }

    /**
     * Récupère les derniers articles
     * @return array
     */
    public function last() {
        return $this->requete("SELECT articles.id,articles.titre,articles.contenu,articles.date,categories.titre as categorie"
                        . " FROM articles LEFT JOIN categories "
                        . "ON articles.categorie_art = categories.id ORDER BY articles.date DESC");
    }

    public function find($id) {
        return $this->requete("SELECT articles.id,articles.titre,articles.contenu,articles.date,articles.categorie_art as categorie"
                        . " FROM articles LEFT JOIN categories "
                        . "ON articles.categorie_art = categories.id WHERE articles.id = ?", [$id], get_called_class(), true);
    }

    public function findWithCategory($id) {
        return $this->requete("SELECT articles.id,articles.titre,articles.contenu,articles.date,categories.titre as categorie"
                        . " FROM articles LEFT JOIN categories "
                        . "ON articles.categorie_art = categories.id WHERE articles.id = ?", [$id], get_called_class(), true);
    }

    public function getByCategorie($cat_id) {
        return $this->requete("SELECT articles.id,articles.titre,articles.contenu,articles.date,categories.titre as categorie"
                        . " FROM articles LEFT JOIN categories "
                        . "ON articles.categorie_art = categories.id WHERE articles.categorie_art = ? ORDER BY articles.date DESC", [$cat_id]);
    }

}
