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
}
