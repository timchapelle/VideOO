<?php

namespace App\Tables;
use Core\Tables\Table;

/**
 * Description of EvenementsTable
 *
 * @author Tim <tim at tchapelle.be>
 */
class EvenementTable extends Table {
    /**
     * Récupérer tous les événéments d'un calendrier
     * @param int $id
     * @return Evenement
     */
    public function all($id) {
        return $this->requete("
            SELECT * FROM evenements WHERE evenements.calendrier_id = ?
            ", [$id]);
    }

    public function nbEnfants($id) {
        return $this->requete("
            SELECT count(*) as nb FROM evenements WHERE evenements.parent_id = ?
            ", [$id], true);
    }

    /**
     * Supprimer les événements enfants antérieurs
     * @param type $id   Id de l'événement parent
     * @param type $date Date en-deça de laquelle il faut supprimer les événéments enfants
     */
    public function deletePreviousChildren($id, $date) {
        $req = $this->db->getPdo()->prepare("
            DELETE FROM evenements WHERE evenements.parent_id = ? AND evenements.date_debut < ?
            ");
        return $req->execute([$id, $date]);
    }

    /**
     * Supprimer les événements enfants ultérieurs
     * @param type $id Idd de l'événement parent
     * @param type $date Date au-delà de laquelle il faut supprimer les événéments enfants
     */
    public function deleteNextChildren($id, $date) {
        $req = $this->db->getPdo()->prepare("
            DELETE FROM evenements WHERE evenements.parent_id = ? AND evenements.date_debut > ?
            ");
        return $req->execute([$id, $date]);
    }

    /**
     * Supprimer tous les enfants d'un événement (celui-ci compris)
     * @param type $id
     * @param type $date
     */
    public function deleteAllChildren($id) {
        $req = $this->db->getPdo()->prepare("
            DELETE FROM evenements WHERE evenements.parent_id = ? OR evenements.id = ?
            ");
        return $req->execute([$id, $id]);
    }

}
