<?php

namespace App\Controller;

use Core\Date\Date;
use Core\HTML\BootstrapForm;

/**
 * Description of CalendarController
 *
 * @author Tim <tim at tchapelle.be>
 */
class CalendriersController extends AppController {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION["auth"])) {
            $this->forbidden();
        }
        $this->loadModele('Calendrier');
        $this->loadModele('Evenement');
        
    }

    /**
     * Fonction index
     * @return Affiche une vue
     */
    public function index() {
        $calendrier = $this->Calendrier->find($_SESSION["auth"], $_GET["id"]);
        $calendriers = $this->Calendrier->liste('id','titre',$_SESSION["auth"]);
        $evenements = $this->Evenement->all($calendrier->id);
        $form = new BootstrapForm($_POST);
        $formCal= new BootstrapForm($calendriers);
        $date = new Date();
        $year = $_GET["year"];
        $dates = $date->all($year);
        return $this->afficher('calendrier.index', compact('calendrier','calendriers', 'formCal', 'evenements', 'form', 'dates', 'year', 'date'));
    }

}
