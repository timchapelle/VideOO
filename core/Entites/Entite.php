<?php

namespace Core\Entites;

/**
 * Description of Entite
 *
 * @author Tim <tim at tchapelle.be>
 */
class Entite {

    /**
     * Méthode "magique" qui permet d'appeler la méthode get$cle() lorsqu'on affiche $this->$cle
     * @param string $cle
     * @return method
     */
    public function __get($cle) {
        $method = 'get' . ucfirst($cle);
        $this->$cle = $this->$method();
        return $this->$cle;
    }

}
