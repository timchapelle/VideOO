<?php
/*
 * Page d'envoi d'un message
 */
?>
<h2> <?= $titre ?> </h2>
<a class = "btn btn-primary" href="?p=messages.index"><i class = "fa fa-chevron-left"></i></a>

<form method='POST'>
    <input type="hidden" name="user_from" value="<?= $_SESSION["auth"] ?>">
    <?php
    echo $form->input('user_to', 'text', 'Utilisateurs');
    echo $form->input('sujet', 'text', 'Sujet');
    echo $form->input('contenu', 'textarea', 'Contenu');
    echo $form->submit('envoyer');
    ?>
</form>

<script> $(function () {
        /*$("#user_to").autocomplete({
         source: ('/VideOO/app/vues/admin/utilisateurs/recherche.php')
         });*/
        function split(val) {
            return val.split(/ \s*/);
        }
        function extractLast(term) {
            return split(term).pop();
        }

        $("#user_to")
                // don't navigate away from the field on tab when selecting an item
                .on("keydown", function (event) {
                    if (event.keyCode === $.ui.keyCode.TAB &&
                            $(this).autocomplete("instance").menu.active) {
                        event.preventDefault();
                    }
                })
                .autocomplete({
                    source: function (request, response) {
                        $.getJSON("../app/vues/admin/utilisateurs/recherche.php", {
                            term: extractLast(request.term)
                        }, response);
                    },
                    search: function () {
                        // custom minLength
                        var term = extractLast(this.value);
                        if (term.length < 2) {
                            return false;
                        }
                    },
                    focus: function () {
                        // prevent value inserted on focus
                        return false;
                    },
                    select: function (event, ui) {
                        var terms = split(this.value);
                        // remove the current input
                        terms.pop();
                        // add the selected item
                        terms.push(ui.item.value);
                        // add placeholder to get the comma-and-space at the end
                        terms.push("");
                        this.value = terms.join(" ");
                        return false;
                    }
                }).data("ui-autocomplete")._renderItem = function (ul, item) {
            return $("<li></li>")
                    .data("item.autocomplete", item)
                    .append("<span class=\"label label-success\">" + item.label + "</span>")
                    .appendTo(ul);
        };
    });
</script>

