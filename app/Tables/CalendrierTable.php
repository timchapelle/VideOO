<?php

namespace App\Tables;

use Core\Tables\Table;

/**
 * Description of CalendarTable
 *
 * @author Tim <tim at tchapelle.be>
 */
class CalendrierTable extends Table {
    
    public function all($id) {
        return $this->requete("
                SELECT calendriers.id, calendriers.titre, calendriers.created_at, calendriers.updated_at FROM calendriers 
            
            WHERE calendriers.user_id = ? 
            ", [$_SESSION["auth"]]);
            
    }
    public function liste($cle, $valeur, $id) {
        $enregistrements = $this->all($id);
        $return = [];
        foreach ($enregistrements as $val) {
            $return[$val->$cle] = $val->$valeur;
        }
        return $return;
    }
    
    public function find($userId, $id = null) {
        if ($id) {
            return $this->requete("
            SELECT calendriers.id, calendriers.titre, calendriers.created_at, calendriers.updated_at FROM calendriers 
            
            WHERE calendriers.user_id = ? AND calendriers.id = ? 
            ", [$_SESSION["auth"], $id], true);
        } else {
            return $this->requete("
            SELECT calendriers.id, calendriers.titre, calendriers.created_at, calendriers.updated_at FROM calendriers 
            
            WHERE calendriers.user_id = ? LIMIT 1
            ", [$_SESSION["auth"]], true);
        }
        
    }
    
    public function getEvents($id) {
        $retour = [];
        $req = $this->requete("
            SELECT * FROM evenements WHERE calendrier_id = ?
            ", [$id]);
        foreach($req as $event) {
            $retour[strtotime($event->date_debut)][$event->id] = [$event->titre, $event->contenu, $event->date_debut, $event->date_fin, $event->heure_debut, $event->heure_fin];
        }
        return $retour;
    }   
    
}
