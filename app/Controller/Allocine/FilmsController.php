<?php

namespace App\Controller\Allocine;

use App;
use App\Allocine;
use App\Controller\AppController;

/**
 * Description of FilmsController
 *
 * @author Tim <tim at tchapelle.be>
 */
class FilmsController extends AppController {

    public function show() {
        if (!empty($_GET)) {
            $id = $_GET["id"];
            $type = 'movie';
            $allocine = new Allocine(ALLOCINE_PARTNER_KEY, ALLOCINE_SECRET_KEY);
            $result = $allocine->get($id, $type);
            App::getInstance()->setTitre('Fiche film');


            $this->afficher('allocine.films.show', compact('result'));
        } else {
            return $this->index();
        }
    }

    public function getActeurs($casting) {
        for ($i = 0; $i < count($casting); $i++) {
            $acteurs["nom"][] = $casting[$i]->person->name;
            $acteurs["role"][] = $casting[$i]->role;
            $acteurs["image"][] = $casting[$i]->picture->href;
            $acteurs["code"][] = $casting[$i]->person->code;
        }
        return $acteurs;
    }

}
