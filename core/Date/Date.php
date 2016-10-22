<?php

namespace Core\Date;

/**
 * Description of Date
 *
 * @author Tim <tim at tchapelle.be>
 */
class Date {
    
    private $days = ['Lundi', 'Mardi', 'Mercredi','Jeudi','Vendredi','Samedi','Dimanche'];
    private $months = ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'];
    
    public function __get($name) {
        $method = 'get' . ucfirst($name);
        return $this->$method();
    }
    /**
     * Retourne un tableau tridimensionnel avec les jours de l'année
     * @param int $year Année en cours
     * @return array
     */
    public function all($year) {
        $tab = [];
        $date = new \DateTime($year.'-01-01');

        while ($date->format('Y') <= $year) {
            
            $annee = $date->format('Y');
            $mois = $date->format('n');
            $jour = $date->format('j');
            $jourSemaine = str_replace('0', '7', $date->format('w'));

            $tab[$annee][$mois][$jour] = $jourSemaine;
            
            $date->add(new \DateInterval('P1D'));
        }
        return $tab;
    }
    /**
     * Retourne les tableau des mois de l'année ("Janvier","Février",...)
     * @return array
     */
    public function getMois() {
        return $this->months;
    }
    /**
     * Retourne un tableau avec les jours de la semaine ("Lundi",...)
     * @return array
     */
    public function getJours() {
        return $this->days;
    }
}
