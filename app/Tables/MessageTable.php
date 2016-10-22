<?php

namespace App\Tables;

use Core\Tables\Table;

/**
 * Description of MessageTable
 *
 * @author Tim <tim at tchapelle.be>
 */
class MessageTable extends Table {

    public function getNonLus($id) {
        return $this->requete("SELECT * FROM messages WHERE user_to = ? AND proprio = ? AND vu = 0 ORDER BY date_envoi DESC", [$id, $id]);
    }
    
    public function all($id) {
        return $this->requete("SELECT messages.id, messages.sujet, messages.contenu, messages.user_from, messages.user_to, messages.date_envoi, messages.vu, messages.date_vu, CONCAT(utilisateurs.prenom, ' ', utilisateurs.nom) as expediteur"
                . " FROM messages INNER JOIN utilisateurs ON messages.user_from=utilisateurs.id WHERE user_to = ? AND proprio = ? ORDER BY date_envoi DESC",[$id, $id]);
    }
    
    public function unique($id) {
        return $this->requete(
                "SELECT messages.id, messages.sujet, messages.contenu, messages.user_from, messages.user_to, messages.date_envoi, messages.vu, messages.date_vu, CONCAT(utilisateurs.prenom, ' ', utilisateurs.nom) as expediteur"
                . " FROM messages INNER JOIN utilisateurs ON messages.user_from=utilisateurs.id WHERE messages.id = ?", [$id], true
                );
    }
    
}
