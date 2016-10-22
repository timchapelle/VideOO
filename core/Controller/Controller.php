<?php

namespace Core\Controller;

/**
 * Classe Controller
 *
 * @author Tim <tim at tchapelle.be>
 */
class Controller {

    protected $viewPath;
    protected $template;

    protected function afficher($vue, $variables = []) {
        ob_start();
        extract($variables);
        require($this->viewPath . str_replace('.', '/', $vue) . '.php');

        $contenu = ob_get_clean();

        require ($this->viewPath . 'templates/' . $this->template . '.php');
    }

    protected function forbidden() {
        header('Location:index.php?p=erreurs.erreur403');
    }

    protected function notFound() {
        header('HTTP/1.0 404 Not Found');
        header('Location:index.php?p=erreurs.404');
    }
    
}
