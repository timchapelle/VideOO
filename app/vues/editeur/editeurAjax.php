<?php

/* 
 * Editeur live ajax
 */

if (isset($_POST["fichier"])) {
    $contenu = file_get_contents($_POST["fichier"]);
    echo $contenu;
}
