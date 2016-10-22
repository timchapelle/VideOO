<?php

use App\Controller\ArticleController;
use App\Controller\UtilisateurController;

/*
 * Index public
 */
// Définition du dossier de base pour les url
define('ROOT', dirname(__DIR__));
// Définition des clés API allocine
define('ALLOCINE_PARTNER_KEY', '100043982026');
define('ALLOCINE_SECRET_KEY', '29d185d98c984a359e6e6f26a0474269');
// Autoload des classes
require ROOT . '/app/App.php';
App::load();

if (isset($_GET["p"])) {
    $page = $_GET["p"];
} else {
    $page = 'articles.index';
}

$page = explode('.', $page);
if ($page[0] == 'admin') {
    $controller = '\App\Controller\Admin\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
} else if ($page[0] == 'allocine') {
    $controller = '\App\Controller\Allocine\\' . ucfirst($page[1]) . 'Controller';
    $action = $page[2];
}
else {
    $controller = '\App\Controller\\' . ucfirst($page[0]) . 'Controller';
    $action = $page[1];
}

$controller = new $controller();
$controller->$action();
?>

