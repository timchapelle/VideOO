<?php

namespace App\Tables;

use \Core\Tables\Table;

/**
 * Table 'utilisateurs'
 *
 * @author Tim <tim at tchapelle.be>
 */
class UtilisateurTable extends Table {
    public function all() {
        return $this->requete("SELECT utilisateurs.id, utilisateurs.nom, utilisateurs.prenom,"
                . "utilisateurs.login, utilisateurs.mail, utilisateurs.avatar, utilisateurs.admin, groupes.nom as groupe "
                . "FROM utilisateurs INNER JOIN groupes ON utilisateurs.groupe_id = groupes.id");
    }
    
    public function destinataires($id) {
        return $this->requete("SELECT utilisateurs.id, utilisateurs.nom, utilisateurs.prenom,"
                . "utilisateurs.login, utilisateurs.avatar, utilisateurs.admin, groupes.nom as groupe "
                . "FROM utilisateurs INNER JOIN groupes ON utilisateurs.groupe_id = groupes.id WHERE utilisateurs.id != ?", [$id]);
    }
    
    
    public function liste($cle, $valeur) {
        $enregistrements = $this->destinataires($_SESSION["auth"]);
        $return = [];
        foreach ($enregistrements as $destinataire) {
            $return[$destinataire->$cle] = $destinataire->$valeur;
        }
        return $return;
    }
    
    public function getIdByLogin($login) {
        return $this->requete("SELECT id FROM utilisateurs WHERE login = ?", [$login], true)->id;
    } 
}
