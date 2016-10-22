<?php

namespace Core\Tables;

use Core\Database\MySQLDatabase;

/**
 * Description of Tables
 *
 * @author Tim <tim at tchapelle.be>
 */
class Table {

    protected $table;
    protected $db;

    public function __construct(MySQLDatabase $db) {

        $this->db = $db;

        if (is_null($this->table)) {
            $parts = explode('\\', get_class($this));
            $className = end($parts);
            $this->table = strtolower(str_replace('Table', '', $className)) . 's';
        }
    }

    public function liste($cle, $valeur) {
        $enregistrements = $this->all();
        $return = [];
        foreach ($enregistrements as $val) {
            $return[$val->$cle] = $val->$valeur;
        }
        return $return;
    }

    public function requete($sql, $params = null, $one = false) {
        if ($params) {
            return $this->db->prepare(
                            $sql, $params, str_replace('Table', 'Entite', get_class($this)), $one);
        } else {
            return $this->db->requete(
                            $sql, str_replace('Table', 'Entite', get_class($this)), $one);
        }
    }

    /**
     * Mise à jour d'un enregistrement
     * @param int $id       Id de l'enregistrement
     * @param array $champs Champs à modifier
     */
    public function update($id, $champs) {
        // Tableau des champs
        $sql_parts = [];
        // Tableau des valeurs
        $attributs = [];
        foreach ($champs as $cle => $val) {
            $sql_parts[] = "$cle = ?";
            $attributs [] = $val;
        }
        $attributs[] = $id;
        // Concaténation des bouts de requete avec une virgule entre chaque champ
        $sql_part = implode(',', $sql_parts);

        return $this->requete(""
                        . "UPDATE {$this->table} SET $sql_part WHERE id = ?", $attributs, true);
    }

    public function create($champs) {
        // Tableau des champs
        $sql_parts = [];
        // Tableau des valeurs
        $attributs = [];
        foreach ($champs as $cle => $val) {
            $sql_parts[] = "$cle = ?";
            $attributs [] = $val;
        }
        // Concaténation des bouts de requete avec une virgule entre chaque champ
        $sql_part = implode(',', $sql_parts);

        return $this->requete(""
                        . "INSERT INTO {$this->table} SET $sql_part", $attributs, true);
    }

    public function delete($id) {
        return $this->requete("DELETE FROM {$this->table} WHERE id = ?", [$id]);
    }

    /**
     * Retourne un élément dans la table correspondant à la classe appelée
     * @param int $id
     * @return object
     */
    public function find($id) {
        return $this->requete(""
                        . "SELECT * FROM "
                        . $this->table . "
                   WHERE id = ? "
                        , [$id], get_called_class(), true);
    }

    public function all() {
        return $this->requete("SELECT * FROM " . $this->table);
    }

}
