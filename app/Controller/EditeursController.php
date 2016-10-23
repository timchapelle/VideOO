<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controller;

/**
 * Description of EditeursController
 *
 * @author Tim <tim at tchapelle.be>
 */
class EditeursController extends AppController {
    
    public function index() {
        return $this->afficher('editeur.index');
    }
    public function live() {
        return $this->afficher('editeur.editeurLive');
    }
}
