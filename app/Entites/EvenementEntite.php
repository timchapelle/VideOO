<?php

namespace App\Entites;
use App;
use Core\Entites\Entite;

/**
 * Description of EvenementEntite
 *
 * @author Tim <tim at tchapelle.be>
 */
class EvenementEntite extends Entite{
    
    protected $calendrier; 
    
    public function isParent() {
        return $this->parent;
    }
    
    public function isEnfant() {
        return $this->parent_id > 0;
    }
    public function getEnfants() {
        $nbenfants = App::getInstance()->getTable('Evenement')->nbEnfants($this->id);
        return $nbenfants;
        
    }
    
    
   
}
