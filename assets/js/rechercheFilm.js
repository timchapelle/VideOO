/* 
 * Recherche d'un film en live via l'api d'Allociné
 */
function rechercheParNom($nom) {
    jQuery.ajax({
        url: "controleurs/controleur.php",
        data: 'titre=' + $("#titreFilm").val() + '&action=rechercherFilm',
        dataType: 'text',
        type: 'POST',
        success: function (data) {
            $("#descriptionFilm").html(data);
        },
        error: function () {
            $("#descriptionFilm").text('Impossible de rechercher le film...');
        }
    });
}

