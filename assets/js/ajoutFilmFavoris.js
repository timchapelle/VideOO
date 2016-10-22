/* 
 * Ajouter un film aux favoris
 */
function ajoutFilmFavoris(id, code, titre, ur, image) {
    jQuery.ajax({
        url: "controleurs/controleur.php",
        data: 'id=' + id + '&code=' + code + '&titre=' + titre + '&ur=' + ur + '&image=' + image + '&action=ajouterFilmFavoris',
        dataType: 'text',
        type: 'POST',
        success: function (data) {
            $("#ajoutOk").html(data);
        },
        error: function () {
            $("#ajoutOk").text('Erreur lors de l\'ajout du film');
        }
    });
}



