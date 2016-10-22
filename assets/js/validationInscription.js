/* 
 * Validation du formulaire d'inscription
 */
// Validation de l'adresse e-mail
function validerEmail(email) {
    var pattern = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern.test(email);
}
// Validation du login
function validerLogin(login) {
    var patter = /^[a-zA-Z]+[a-zA-Z\_\.]+[a-zA-Z]+[a-zA-Z0-9]+$/;
    var ok = true;
    if (patter.test(login) === false || login.length > 12 || login.length < 6) {
        ok = false;
    }
    return ok;
}
function validerNom(nom) {
    var pattern = /^[a-zA-Z\'\- ]+$/;
    var ok = true;
    if (!pattern.test(nom) || nom.length > 30) {
        ok = false;
    }
    return ok;
}
// Vérification de la disponibilité du login
function checkDispoLogin() {
    if ($("#loginD").val() !== '') {
        if (!validerLogin($("#loginD").val())) {
            $("#dispoLogin").text('Ce login n\'est pas valide. 6 à 12 caractères (autorisés : alphanumériques et _ ou . )');
            $("#dispoLogin").addClass('bg-danger');
        } else {
            jQuery.ajax({
                url: "controleurs/controleur.php",
                data: 'login=' + $("#loginD").val() + '&action=validerLogin',
                dataType: 'text',
                type: 'POST',
                success: function (data) {
                    $("#dispoLogin").html(data);
                },
                error: function () {
                    $("#dispoLogin").text('Impossible de vérifier la disponibilité du login...');
                }
            });
        }
    } else {
        $("#dispoLogin").text('Ce champ est obligatoire');
        $("#dispoLogin").addClass('bg-danger');
    }
}
// Vérification des champs obligatoires qd on clique sur inscription
$(function () {
    $("#Inscription").click(function () {
        valid = true;
        if ($("#nom").val() === '') {
            $("#nom").next(".error").fadeIn().text("Ce champ est obligatoire !");
            valid = false;
        }

        if ($("#prenom").val() === '') {
            $("#prenom").next(".error").fadeIn().text("Ce champ est obligatoire !");
            valid = false;
        }
        if ($("#mail").val() === '') {
            $("#mail").next(".error").fadeIn().text("Ce champ est obligatoire !");
            valid = false;
        }
        if (!validerEmail($("#mail").val())) {
            $("#mail").next(".error").fadeIn().text("Adresse e-mail invalide");
            valid = false;

        }
        if ($("#mdpD").val() === '') {
            $("#mdpD").next(".error").fadeIn().text("Ce champ est obligatoire !");
            valid = false;
        }
        return valid;
    });

    // Vérification des champs obligatoires quand on en sort

    $("#nom").blur(function () {
        if ($("#nom").val() === '') {
            $("#nom").next(".error").fadeIn().text("Ce champ est obligatoire !");

        } else if (!validerNom($("#nom").val())) {
            $("#nom").next(".error").fadeIn().text("Nom incorrect");

        } else {
            $("#nom").next(".error").fadeOut();
        }

    });

    $("#prenom").blur(function () {
        if ($("#prenom").val() !== '') {
            $("#prenom").next(".error").fadeOut();
        } else {
            $("#prenom").next(".error").fadeIn().text("Ce champ est obligatoire !");
        }

    });
    $("#mail").blur(function () {
        if ($("#mail").val() === '') {
            $("#mail").next(".error").fadeIn().text("Ce champ est obligatoire !");
        } else if (!validerEmail($("#mail").val())) {
            $("#mail").next(".error").fadeIn().text("Adresse e-mail invalide !");
        } else {
            $("#mail").next(".error").fadeOut();
        }
    });
    $("#mdpD").blur(function () {
        if ($("#mdpD").val() !== '') {
            $("#mdpD").next(".error").fadeOut();
        } else {
            $("#mdpD").next(".error").fadeIn().text("Ce champ est obligatoire !");
        }

    });
    $("#mdp2").blur(function () {
        if ($("#mdp2").val() === $("#mdpD").val()) {
            $("#mdp2").next(".error").fadeOut();
        } else {
            $("#mdp2").next(".error").fadeIn().text("Les mots de passe ne correspondent pas !");
        }

    });
});
/* Prévisualisation de l'avatar */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#apercu').attr('src', e.target.result);
            $("#apercu").show();
        }
        reader.readAsDataURL(input.files[0]);
    }
}
