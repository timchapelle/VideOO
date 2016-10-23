/* 
 * Validation lors de l'édition d'un événement du calendrier
 * @author Tim 
 */

$(function () {
    /**
     * Création d'un nouvel objet date
     */
    var d = new Date();
    var current = d.getMonth() + 1;

    // On cache tous les mois
    $('.mois').hide();
    // On n'affiche que le mois en cours
    $('#mois' + current).show();
    // Et on rend le lien plus visible
    $('#lienMois' + current + '>span').addClass('label-warning');
    // Actions lorsqu'on clique sur un ds liens des mois
    $('.choixmois a').click(function () {
        var mois = $(this).attr('id').replace('lienMois', '');
        if (mois !== current) {
            $('#mois' + current).hide();
            $('#mois' + mois).fadeToggle();
            $('.choixmois a span').removeClass('label-warning');
            $('.choixmois a#lienMois' + mois + '>span').addClass('label-warning');
            current = mois;
        }

    });
    // Masquer les heures quand on sélectionne une journée entière
    $("#journee").click(function () {
        $(".dateTim").toggle();
        /**/
    });
    // Vérification des champs obligatoires et de l'heure de fin
    $("#ajouter, #modifier").click(function (event) {

        valide = true;
        if ($("#titre").val() === '') {
            //event.preventDefault();
            valide = false;
            $("#erreurTitre").fadeIn().text("Que comptez-vous faire ? ");
        }
        // Réactivation du champ date début (pour l'envoyer par POST)
        $("#date_debut").removeAttr('disabled');

        if (($("#heure_fin").val() < $("#heure_debut").val()) || // Si l'heure de fin est inférieure à l'heure de début
                (($("#heure_fin").val() === $("#heure_debut").val()) && ($("#min_fin").val() < $("#min_debut").val()))) { // ou si heure_debut = heure_fin && min_fin < min_debut
            $("#erreurH").fadeIn().text('Veuillez rentrer une heure de fin correcte');
            valide = false;
        } else {
            $("#erreurH").fadeOut();
        }
        // On réaffiche les heures, si on veut rajouter un autre événement un autre jour
        if (valide) {
            for (var l = 0; l < 24; l++) {
                $("#hfin" + ('0' + l).slice(-2)).show();
                $("#hdebut" + ('0' + l).slice(-2)).show();
            }
        }
        // Si la case journée est cochée, on lui donne la valeur 1
        if ($("#journee").prop('checked')) {
            $("#journee").val("1");
        }
        if ($("#xfois").prop('checked')) {
            $("#xfois").val("1");
        }
        if ($("#hebdo").prop('checked')) {
            $("#hebdo").val("1");
        }
        if ($("#mensu").prop('checked')) {
            $("#mensu").val("1");
        }
        if ($("#recur").prop('checked')) {
            $("#recur").val("1");
        }
        if ($("#quoti").prop('checked')) {
            $("#quoti").val("1");
        }

        return valide;
    });
    

    /**
     * Affichage des choix de récurrence
     */
    $("#recur").click(function () {
        $("#choixHebdo, #choixMensu, #choixXfois, #choixQuoti").toggleClass("hide");
        // Si un des choix avait été fait, on réinitialise tout
        if ($("#mensu").prop('checked') || $("#hebdo").prop('checked') || $("#xfois").prop("checked") || $("#quoti").prop("checked")) {
            $("#mensu, #hebdo, #xfois, #quoti").prop("checked", false);
            $("#choixNbXfois, #choixRecur_fin").addClass("hide");
            $("#choixNbXfois, #choixRecur_fin").val("0");

        }
    });
    $("#hebdo").click(function () {
        if ($("#mensu").prop('checked')) {
            $("#mensu").prop('checked', false);
        } else if ($("#quoti").prop('checked')) {
            $("#quoti").prop('checked', false);
        } else if (!($("#xfois").prop('checked'))) {
            $("#choixRecur_fin").toggleClass("hide");
        }
    });
    $("#mensu").click(function () {
        if ($("#hebdo").prop('checked')) {
            $("#hebdo").prop('checked', false);
        } else if ($("#quoti").prop('checked')) {
            $("#quoti").prop('checked', false);
        } else if (!($("#xfois").prop('checked'))) {
            $("#choixRecur_fin").toggleClass("hide");
        }

    });
    $("#quoti").click(function () {
        if ($("#hebdo").prop('checked')) {
            $("#hebdo").prop('checked', false);
        } else if ($("#mensu").prop('checked')) {
            $("#mensu").prop('checked', false);
        } else if (!($("#xfois").prop('checked'))) {
            $("#choixRecur_fin").toggleClass("hide");
        }

    });
    $("#xfois").click(function () {
        $("#choixNbXfois").toggleClass("hide");
        if ($("#hebdo").prop("checked") || $("#mensu").prop("checked") || $("#quoti").prop("checked")) {
            $("#choixRecur_fin").toggleClass("hide");
        }
    });

});
/**
 * Afficher les choix de suppression
 */
function toggleChoixDelete(id) {
    $("#choixDelete" + id).toggleClass("hide");
}
/**
 * Initialiser les popover
 * @param {type} id id du popover à ouvrir
 * @returns {void}
 */
function showPopover(id) {
    $("#pop" + id).popover('toggle');
}
/**
 * 
 * @param {int} h_actu Heure actuelle
 * @param {timestamp} d_actu Date actuelle 
 * @param {timestamp} dateAjout Date de l'ajout
 * @returns {undefined}
 */
function ajout(h_actu, d_actu, dateAjout) {
    // Affichage du modal d'ajout
    $("#ajoutEvent").modal('show');
    // Création de deux dates, pour stocer d_actu et date_Ajout
    var date = new Date(dateAjout * 1000);
    var date2 = new Date(d_actu * 1000);
    dateAjout = date.getFullYear() + '-' + ('0' + (date.getMonth() + 1)).slice(-2) + '-' + ('0' + date.getDate()).slice(-2);
    d_actu = date2.getFullYear() + '-' + ('0' + (date2.getMonth() + 1)).slice(-2) + '-' + ('0' + date2.getDate()).slice(-2);

    $("#date_debut").attr('value', dateAjout);

    // Si c'est le jour-même, il faut désactiver les heures < heure actuelle
    if (d_actu === dateAjout) {

        for (var k = 0; k < h_actu; k++) {
            $("#hfin" + ('0' + k).slice(-2)).hide();
            $("#hdebut" + ('0' + k).slice(-2)).hide();
        }

    }
}



