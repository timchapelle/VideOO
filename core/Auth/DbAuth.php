<?php

namespace Core\Auth;

use Core\Database\MySQLDatabase;

/**
 * Classe représentant une connexion par db
 *
 * @author Tim <tim at tchapelle.be>
 */
class DbAuth {

    private $db;

// Injection de dépendance
    public function __construct(MySQLDatabase $db) {
        $this->db = $db;
    }

    /**
     * 
     * @param string $login
     * @param string $pass
     * @return bool
     */
    public function login($login, $pass) {
        $user = $this->db->prepare(""
                . "SELECT * "
                . "FROM utilisateurs "
                . "WHERE login = ?", [$login], null, true);
        if ($user) {
            if ($user->password === md5($pass)) {
                $_SESSION["auth"] = $user->id;
                $_SERVER["connectedUsers"][] = $user->id;
                return true;
            }
        }
        return false;
    }

    public function logged() {
        return $_SESSION["auth"];
    }

    public function getUserId() {
        if ($this->logged()) {
            return $_SESSION["auth"];
        }
        return false;
    }

}
