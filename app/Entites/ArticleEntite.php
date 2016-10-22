<?php

namespace App\Entites;

use Core\Entites\Entite;

/**
 * Description of Article
 *
 * @author Tim <tim at tchapelle.be>
 */
class ArticleEntite extends Entite {

    public function getUrl() {
        return 'index.php?p=articles.show&id=' . $this->id;
    }

    /**
     * Retourne les 50 premiers caractères du contenu de l'article
     * @return string
     */
    public function getExtrait() {
        return substr($this->contenu, 0, 50) . '...';
    }

}
