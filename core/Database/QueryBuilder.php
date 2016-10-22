<?php

namespace Core\Database;

/**
 * Description of QueryBuilder
 *  Générateur de requêtes SQL
 * @author Tim <tim at tchapelle.be>
 */
class QueryBuilder {

    private $champs = [];
    private $conditions = [];
    private $andWhere = [];
    private $orWhere = [];
    private $table = [];
    private $innerJoin = [];
    private $leftJoin = [];
    private $rightJoin = [];
    private $on = [];
    private $orderBy = [];
    private $groupBy = [];

    public function select() {
        $this->champs = func_get_args();
        return $this;
    }

    public function where() {
        foreach (func_get_args() as $condition) {
            $this->conditions[] = $condition;
        }
        return $this;
    }

    public function andWhere() {
        $this->conditions = func_get_args();
        return $this;
    }

    public function orWhere() {
        $this->conditions = func_get_args();
        return $this;
    }

    public function from($table, $alias = null) {
        if (is_null($alias)) {
            $this->table = $table;
        } else {
            $this->table = "$table AS $alias";
        }
        return $this;
    }

    public function innerJoin() {
        
    }

    public function leftJoin() {
        
    }

    public function rightJoin() {
        
    }

    public function on() {
        
    }

    public function orderBy() {
        
    }

    public function groupBy() {
        
    }

    public function __toString() {
        return 'SELECT ' . implode(', ', $this->champs)
                . ' FROM ' . implode(', ', $this->from)
                . ' wHERE ' . implode(' AND ', $this->where);
    }

}
