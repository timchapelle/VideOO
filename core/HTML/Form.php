<?php

namespace Core\HTML;

/**
 * Description of Form
 *  Classe pour gérer et générer des formulaires
 * @author Tim <tim at tchapelle.be>
 * 
 */
class Form {

    /**
     * @var array $donnees Données utilisées par le formulaire
     */
    private $donnees;

    /**
     * @var string $entourer Tag qui va entourer le HTML
     */
    public $entourer = 'div';

    /**
     * @name Constructeur
     * @param array $donnees Données utilisées par le formulaire
     * @return string
     */
    public function __construct($donnees = []) {
        $this->donnees = $donnees;
    }

    public function getValeur($index) {
        if (is_object($this->donnees)) {
            return $this->donnees->$index;
        }
        return isset($this->donnees[$index]) ? $this->donnees[$index] : null;
    }

    /**
     * Entourer du code HTML d'une balise spécifique
     * @param string $html Le code HTML à entourer
     * @return string
     */
    protected function entourer($html) {
        return "<{$this->entourer}>$html</{$this->entourer}><br>";
    }

    /**
     *  Générer un champ de formulaire (<input>)
     * @param string $nom
     * @param string $type
     * @return string
     */
    public function input($nom, $type = 'text') {
        if ($type == 'textarea') {
            return '<textarea type="' . $type . '" name="' . $nom . '" id="' . $nom . '">' . $this->getValeur($nom) . '</textarea>';
        } else {
            return '<label for="' . $nom . '">'
                    . $nom
                    . '<input type="' . $type . '" name="' . $nom . '" id="' . $nom . '" value="' . $this->getValeur($nom) . '">';
        }
    }

    /**
     * Générer une liste de choix (<select>)
     * @param string $nom
     * @param string $label
     * @param array $options
     */
    public function select($nom, $label, $options) {
        
    }

    /**
     * Générer le bouton submit
     * @param string $nom L'attribut 'name', 'id' et 'value' du submit
     * @return string
     */
    public function submit($nom) {
        echo '<button type="submit" class="btn btn-primary" name="' . $nom . '" value="' . $nom . '">' . $nom . '</button>';
    }

}
