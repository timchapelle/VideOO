<?php

namespace App\Tables;

use Core\Tables\Table;

/**
 * Table 'groupes'
 *
 * @author Tim <tim at tchapelle.be>
 */
class GroupeTable extends Table {
    
    public function getGroupMembers($id) {
        return $this->requete("SELECT utilisateurs.id, utilisateurs.nom, utilisateurs.prenom,"
                . "utilisateurs.login, utilisateurs.mail, utilisateurs.avatar, utilisateurs.admin, groupes.nom as groupe "
                . "FROM utilisateurs INNER JOIN groupes ON utilisateurs.groupe_id = groupes.id WHERE groupes.id = ?", 
                [$id]);        
    }
}
