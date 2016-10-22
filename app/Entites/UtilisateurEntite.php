<?php

namespace App\Entites;
use Core\Entites\Entite;
/**
 * Description of UtilisateurEntite
 *
 * @author Tim <tim at tchapelle.be>
 */
class UtilisateurEntite extends Entite {
    
    public function getUrl() {
        return 'index.php?p=utilisateurs.show&id=' . $this->id;
    }
    
    public function getAvatar() {
        if (is_null($this->avatar)) {
            return 'default_user.jpg';
        }
        return $this->avatar;
    }
    
    
}
