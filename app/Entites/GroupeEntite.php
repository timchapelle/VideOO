<?php

namespace App\Entites;
use Core\Entites\Entite;
/**
 * Description of UtilisateurEntite
 *
 * @author Tim <tim at tchapelle.be>
 */
class GroupeEntite extends Entite {
    public function getUrl() {
        return 'index.php?p=admin.groupes.show&id=' . $this->id;
    }
    
    public function avatar($user) {
        if (is_null($user->avatar)) {
            return 'default_user.jpg';
        }
        return $user->avatar;
    }
    
}