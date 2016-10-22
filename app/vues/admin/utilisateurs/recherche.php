<?php

/* 
 * Recherche live d'utilisateur
 * @auteur : Tim ( tim at tchapelle be)
 */
$term = $_GET["term"];
$bdd = new PDO('mysql:host=localhost;dbname=timhub','root','miriki');
$requete = $bdd->prepare('SELECT * FROM utilisateurs WHERE login LIKE :term'); // j'effectue ma requête SQL grâce au mot-clé LIKE
$requete->execute(array('term' => '%'.$term.'%'));

$array = array(); // on créé le tableau

while($donnee = $requete->fetch()) // on effectue une boucle pour obtenir les données
{
    array_push($array, $donnee["login"]); // et on ajoute celles-ci à notre tableau
}

echo json_encode($array); // il n'y a plus qu'à convertir en JSON
