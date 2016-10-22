<?php

namespace App\Entites;

use Core\Entites\Entite;

/**
 * Description of MessageEntite
 *
 * @author Tim <tim at tchapelle.be>
 */
class MessageEntite extends Entite{
    
    public function getExtrait() {
        return substr($this->contenu,0,40);
    }
    
    
}
