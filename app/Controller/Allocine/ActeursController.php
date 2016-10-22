<?php

namespace App\Controller\Allocine;

use App;
use App\Controller\AppController;
use App\Allocine;

/**
 * Description of ActeursController
 *
 * @author Tim <tim at tchapelle.be>
 */
class ActeursController extends AppController {

    public function show() {
        if (!empty($_GET)) {
            $id = $_GET["id"];
            $type = 'person';
            $allocine = new Allocine(ALLOCINE_PARTNER_KEY, ALLOCINE_SECRET_KEY);
            $result = $allocine->get($id, $type);
            App::getInstance()->setTitre('Fiche acteur');


            $this->afficher('allocine.acteurs.show', compact('result'));
        } else {
            return $this->index();
        }
    }

    public function age($date_naissance) { {
            $arr1 = explode('/', $date_naissance);
            $arr2 = explode('/', date('d/m/Y'));

            if (($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
                return $arr2[2] - $arr1[2];

            return $arr2[2] - $arr1[2] - 1;
        }
    }

}
