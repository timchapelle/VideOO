<?php

namespace App\Controller\Allocine;

use App\Controller\AppController;
use App;
use App\Allocine;
/**
 * Description of SeriesController
 *
 * @author Tim <tim at tchapelle.be>
 */
class SeriesController extends AppController {

    public function show() {
        if (!empty($_GET)) {
            $id = $_GET["id"];
            $type = 'tvseries';
            $allocine = new Allocine(ALLOCINE_PARTNER_KEY, ALLOCINE_SECRET_KEY);
            $result = $allocine->get($id, $type);
            App::getInstance()->setTitre('Fiche série');


            $this->afficher('allocine.series.show', compact('result'));
        } else {
            return $this->index();
        }
    }
    public function afficherEtoiles($note) {
    for ($i=0; $i< floor($note);$i++) {
        echo '<i class="fa fa-star jaune"></i>';
    }
    if ($note - 0.4999 > floor($note)) {
        echo '<i class="fa fa-star-half jaune"></i>';
    }
}

}
