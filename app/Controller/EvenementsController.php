<?php

namespace App\Controller;
use App;
use Core\Date\Date;
use Core\HTML\BootstrapForm;

/**
 * Description of EvenementsController
 *
 * @author Tim <tim at tchapelle.be>
 */
class EvenementsController extends AppController {

    public function __construct() {
        parent::__construct();
        $this->loadModele('Evenement');
        $this->loadModele('Calendrier');
    }

    /**
     * Fonction index
     */
    public function index($cal = null) {
        if (isset($_POST["calendrier_id"])) {
            $cal = $_POST["calendrier_id"];
        }
        $id = $cal;
        $calendrier = $this->Calendrier->find($_SESSION["auth"], $cal);
        $calendriers = $this->Calendrier->liste('id','titre',$_SESSION["auth"]);
        $evenements = $this->Evenement->all($cal);
        $form = new BootstrapForm($_POST);
        $formCal = new BootstrapForm($calendriers);
        $date = new Date();
        $year = date('Y');
        $dates = $date->all($year);
        return $this->afficher('calendrier.index', compact('calendrier','calendriers', 'formCal', 'evenements', 'date', 'dates', 'year', 'form', 'id'));
    }

    /**
     * 
     * Création d'un événement
     */
    public function add() {

        if (!empty($_POST)) {
            $titre = filter_input(INPUT_POST, 'titre', FILTER_SANITIZE_STRING);
            $calendrier_id = filter_input(INPUT_POST, 'calendrier_id', FILTER_SANITIZE_NUMBER_INT);
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT);
            $contenu = filter_input(INPUT_POST, 'contenu', FILTER_SANITIZE_STRING);
            $heure_debut = (!isset($_POST["journee"])) ? $_POST["heure_debut"] : null;
            $heure_fin = (!isset($_POST["journee"])) ? $_POST["heure_fin"] : null;
            $min_debut = (!isset($_POST["journee"])) ? $_POST["min_debut"] : null;
            $min_fin = (!isset($_POST["journee"])) ? $_POST["min_fin"] : null;
            
            /* Ajout événement récurrent */
            
            if (isset($_POST["recur"]) && $_POST["recur"] == '1') {

                $date = new \DateTime($_POST["date_debut"]);
                // Si xfois est coché
                if (isset($_POST["xfois"]) && $_POST["xfois"] == "1") {
                    if (isset($_POST["hebdo"]) && $_POST["hebdo"] == "1") {
                        $inter = 'P' . $_POST["nbXfois"] . 'W';
                        $entreDeux = 'P1W';
                    }
                    if (isset($_POST["mensu"]) && $_POST["mensu"] == "1") {
                        $inter = 'P' . $_POST["nbXfois"] . 'M';
                        $entreDeux = 'P1M';
                    }
                    if (isset($_POST["quoti"]) && $_POST["quoti"] == "1") {
                        $inter = 'P' . $_POST["nbXfois"] . 'D';
                        $entreDeux = 'P1D';
                    }
                    $interval = new \DateInterval($inter);
                    $fin = new \DateTime($_POST["date_debut"]);
                    $fin = $fin->add($interval);
                } else if (isset($_POST["recur_fin"])) { // sinon si c'est une date de fin
                    if (isset($_POST["quoti"]) && $_POST["quoti"] && "1") {
                        $entreDeux = 'P1D';
                    }
                    if (isset($_POST["hebdo"]) && $_POST["hebdo"] && "1") {
                        $entreDeux = 'P1W';
                    }
                    if (isset($_POST["mensu"]) && $_POST["mensu"] && "1") {
                        $entreDeux = 'P1M';
                    }
                    $fin = new \DateTime($_POST["recur_fin"]);
                } 
                // Détermination de l'intervalle entre 2 événements
                $entreDeux = new \DateInterval($entreDeux);
                // Création de l'événement "mère"
                $this->Evenement->create([
                        'titre' => $titre,
                        'calendrier_id' => $calendrier_id,
                        'user_id' => $user_id,
                        'contenu' => $contenu,
                        'heure_debut' => $heure_debut,
                        'heure_fin' => $heure_fin,
                        'min_debut' => $min_debut,
                        'min_fin' => $min_fin,
                        'date_debut' => $date->format('Y-m-d')
                    ]);
                // Ajout du premier intervalle
                $date->add($entreDeux);
                // Récupération du dernier id inséré (= id de l'événement mère)
                $lastId = App::getInstance()->getDb()->lastInsertId();
                // Boucle entre le début et la fin de la récurrence
                while (strtotime($date->format('Y-m-d')) <= strtotime($fin->format('Y-m-d'))) {
                    $this->Evenement->create([
                        'titre' => $titre,
                        'calendrier_id' => $calendrier_id,
                        'user_id' => $user_id,
                        'contenu' => $contenu,
                        'heure_debut' => $heure_debut,
                        'heure_fin' => $heure_fin,
                        'min_debut' => $min_debut,
                        'min_fin' => $min_fin,
                        'parent_id' => $lastId,
                        'date_debut' => $date->format('Y-m-d')
                    ]);
                    // Incrémentation de la date
                    $date->add($entreDeux);
                }
                return $this->index();
            } else {
                
                /* Ajout normal */
                
                $result = $this->Evenement->create([
                    'titre' => $titre,
                    'calendrier_id' => $calendrier_id,
                    'user_id' => $user_id,
                    'contenu' => $contenu,
                    'heure_debut' => $heure_debut,
                    'heure_fin' => $heure_fin,
                    'min_debut' => $min_debut,
                    'min_fin' => $min_fin,
                    'date_debut' => $_POST["date_debut"]
                ]);
                if ($result) {
                    return $this->index();
                }
            }
        } else {
            return $this->index();
        }
    }

    /**
     * Editer un événement
     */
    public function edit() {
        if (!empty($_POST["contenu"])) {
            $resultat = $this->Evenement->update($_POST["id"], [
                'titre' => $_POST["titre"],
                'calendrier_id' => $_POST["calendrier_id"],
                'user_id' => $_POST["user_id"],
                'contenu' => $_POST["contenu"],
                'heure_debut' => (!isset($_POST["journee"])) ? $_POST["heure_debut"] : null,
                'heure_fin' => (!isset($_POST["journee"])) ? $_POST["heure_fin"] : null,
                'min_debut' => (!isset($_POST["journee"])) ? $_POST["min_debut"] : null,
                'min_fin' => (!isset($_POST["journee"])) ? $_POST["min_fin"] : null,
                'date_debut' => $_POST["date_debut"]
            ]);
            if ($resultat) {
                return $this->index($_POST["calendrier_id"]);
            }
        }

        $evenement = $this->Evenement->find($_POST["id"]);

        if (!$evenement) {
            $this->notFound();
        }
        $form = new BootstrapForm([
            'titre' => $evenement->titre,
            'date_debut' => strtotime("2016-04-01"),
            'contenu' => $evenement->contenu,
            'heure_debut' => $evenement->heure_debut,
            'heure_fin' => $evenement->heure_fin,
            'min_debut' => $evenement->min_debut,
            'min_fin' => $evenement->min_fin
        ]);
        $titre = 'Modifier un événement';
        $this->afficher('evenements.edit', compact('evenement', 'form', 'titre'));
    }

    /**
     * Supprimer un événement
     */
    public function delete() {
        if (!empty($_POST)) {
            if (isset($_POST["only1"])) {
                $this->Evenement->delete($_POST["id"]);
            }
            if (isset($_POST["all"])) {
                $this->Evenement->delete($_POST["parent_id"]);
                $this->Evenement->deleteAllChildren($_POST["parent_id"]);
            }
            if (isset($_POST["next"])) {
               $this->Evenement->deleteNextChildren($_POST["parent_id"], $_POST["date_debut"]);
            }
            if (isset($_POST["previous"])) {
               $this->Evenement->deletePreviousChildren($_POST["parent_id"], $_POST["date_debut"]);
            }
            
            return $this->index();
        }
    }

}
