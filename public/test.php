<?php

if ($_POST["recur"] == '1') {

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
    } else {
        /* Ajout normal */
    }
    $entreDeux = new \DateInterval($entreDeux);
    while (strtotime($date->format('Y-m-d')) <= strtotime($fin->format('Y-m-d'))) {
        echo $date->format('Y-m-d') . '<br>';
        $date->add($entreDeux);
    }
}