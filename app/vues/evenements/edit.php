<?php
/*
 * Modification d'un événement
 */
?>
<h2> <?= $titre ?> </h2>

<form action="index.php?p=evenements.edit" method="POST">
    <input name="date_debut" id="date_debut" type="date" >
    <div class="error alert alert-danger" id="erreurTitre"></div>
    <?= $form->input('titre', 'text', 'Titre') ?> 
    <div class="error alert alert-danger" id="erreurTitre"></div>
    <?= $form->input('contenu', 'textarea', 'Contenu'); ?>
    <div class="alert alert-danger error" id="erreurH"></div>
    <div class="tim"><?= $form->time('debut', 'Début') ?></div>
    <?= $form->time('fin', 'Fin') ?>
    <input type="hidden" name="id" id="id" value="<?= $evenement->id?>">
    <input type="hidden" name="calendrier_id" value="<?= $evenement->calendrier_id ?>">
    <input type="hidden" name="user_id" value="<?= $evenement->user_id ?>">
    <div class="checkbox">
        <label><input name="journee" id="journee" type="checkbox">Journée entière</label>
    </div>
    <button type="submit" class="btn btn-primary" name="modifier" id="modifier" value="modifier">modifier</button>
</form>
<script src="../assets/js/validationEvenement.js"></script>
<?php if(!is_null($evenement->date_debut)) { ?>
<script type="text/javascript">
    // Création d'une date pour stocker la date d'ajout
    $(function() {
        var date4 = new Date(<?=strtotime($evenement->date_debut)?> * 1000);
        dateAdd = date4.getFullYear() + '-' + ('0' + (date4.getMonth() + 1)).slice(-2) + '-' + ('0' + date4.getDate()).slice(-2);        
        // On attribue la date au champ date
        $("#date_debut").val(dateAdd);
        // on donne les valeurs aux différentes heures
        $("select#heure_debut").val(("0" + <?=is_null($evenement->heure_debut) ? "0" : $evenement->heure_debut?>).slice(-2));
        $("select#min_debut").val(("00" + <?=is_null($evenement->min_debut) ? "0" : $evenement->min_debut?>).slice(-2));
        $("select#heure_fin").val(("0" + <?=is_null($evenement->heure_fin) ? "0" : $evenement->heure_fin?>).slice(-2));
        $("select#min_fin").val(("00" + <?=is_null($evenement->min_fin) ? "0" : $evenement->min_fin?>).slice(-2));
        var hdeb = (<?="0" . $evenement->heure_debut ?>);
        if (hdeb == "0") {
            $("#journee").prop('checked',true);
        }
        
    });
       
</script>
<?php } ?>