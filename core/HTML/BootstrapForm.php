<?php

namespace Core\HTML;

/**
 * Permet de générer un formulaire Bootstrap
 *
 * @author Tim <tim at tchapelle.be>
 */
class BootstrapForm extends Form {

    /**
     * Générer un champ d'input
     * @param string $nom
     * @param string $type 'text','date','number','email','password','hidden','submit'
     * @param string $label Le label qui va précéder le champ
     * @return string
     */
    public function input($nom, $type = 'text', $label = null) {
        if ($type == 'textarea') {
            return '<div class="form-group">'
                    . '<label for="' . $nom . '">' . $label . '</label>&nbsp;'
                    . '<textarea class="form-control" name="' . $nom . '">'
                    . $this->getValeur($nom)
                    . '</textarea>'
                    . '</div>';
        } else {
            return '<div class="form-group">'
                    . '<label for="' . $nom . '">' . $label . '</label>&nbsp;'
                    . '<input class="form-control" type="' . $type . '" name="' . $nom . '" id="' . $nom . '" value="' . $this->getValeur($nom) . '">&nbsp;'
                    . '</div>';
        }
    }

    /**
     * Générer une liste de choix (<select>)
     * @param string $nom
     * @param string $label
     * @param array $options
     */
    public function select($nom, $label, $options) {
        $label = '<label for="' . $nom . '">' . $label . '</label>';
        $input = '<select class="form-control" name="' . $nom . '" id="' . $nom . '">';
        foreach ($options as $option => $val) {
            $attributs = '';
            if ($option == $this->getValeur($nom)) {
                $attributs = ' selected';
            }
            $input .= "<option value='$option'$attributs>$val</option>";
        }
        $input .= '</select>';

        return $this->entourer($label . $input);
    }
    /**
     * Génère un groupe de boutons radio
     * @param string $nom Attribut name
     * @param string $labels Labels
     * @param array $choix Attributs value
     * @return string 
     */
    public function radio($nom, $labels, $choix) {
        $max = count($choix);
        $input = '';
        for ($i = 0; $i < $max; $i++) {
            $input .= '<label class="radio-inline">'
                    . '<input type="radio" name="' . $nom . '" id="' . $choix[$i] . '" value="' . $choix[$i] . '">'
                    . $labels[$i]
                    . '</label>';
        }
        return $this->entourer($input);
    }
    /**
     * Génère un champ de recherche
     * @param string $type Par défaut, input text
     * @return string
     */
    public function search($type = 'text') {
        $input = '<input type="' . $type . '" name="terme" class="form-control input-lg" placeholder="Rechercher..." />
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-lg" type="submit">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>';
        return $this->entourer($input);
    }
    /**
     * Génère un double select pour entre heures/minutes
     * @param string $nom Attributs name et id
     * @param string $label Label
     * @return string
     */
    public function time($nom, $label) {
        $action = ($nom == "debut") ? 'onblur="setHfinMin(' . date('H') . ',' . strtotime(date('Y-m-d')) . ')" ': '';
        $label = '<div class="dateTim"><br><label for="' . $nom . '">' . $label . '</label><br>';
        $input = '<select class="col-sm-2 time " name="heure_'. $nom . '" id="heure_'. $nom . '"'
                . $action . '>';
        
        for ($i=0; $i<24; $i++) {
            $input .='<option value="' . substr(("0" . $i),-2) . '" id="h' . $nom  . substr(("0" . $i),-2) . '">' . substr(("0" . $i),-2) . '</option>';
        }
        
        $input .= '</select>';
        $input .= '<select class="col-sm-2 time " name="min_'. $nom . '" id="min_'. $nom . '">';
        
        for ($j=0; $j<60; $j++) {
            $input .= '<option value="' . substr(("0" . $j),-2) . '" >' . substr(("0" . $j),-2) . '</option>';
        }
        $input .= '</select>';
        
        $input .= '&nbsp;&nbsp; h </div>';
        return $this->entourer($label . $input);
    }

}
