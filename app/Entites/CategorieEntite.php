<?php

namespace App\Entites;

use Core\Entites\Entite;

/**
 * Description of Article
 *
 * @author Tim <tim at tchapelle.be>
 */
class CategorieEntite extends Entite {

    public function getUrl() {
        return 'index.php?p=articles.categories&id=' . $this->id;
    }

}
