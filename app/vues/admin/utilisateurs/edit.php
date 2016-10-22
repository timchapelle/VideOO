<?php
/*
 * Ajout / Modification d'un utilisateur
 */
?>
<h2> <?= $titre ?> </h2>
<?php if(!empty($erreurs)) : ?>
    <div class="alert alert-warning">
    <?php foreach($erreurs as $erreur => $err) : ?>
        <?= $err . '<br>' ?>
    <?php endforeach; ?>
    </div>
<?php endif; ?>
<form method='POST'>
    <?php
    echo $form->input('nom', 'text', 'Nom');
    echo $form->input('prenom', 'text', 'Prénom');
    echo $form->input('login', 'text', 'Login');
    echo $form->input('mail', 'email', 'Adresse e-mail');
    echo $form->input('password', 'text', 'Mot de passe');
    if (is_null($utilisateur)) {
        echo $form->input('password2', 'text', 'Confirmer le mot de passe');
    }
    echo $form->select('groupe_id', 'Groupe', $groupes);
    echo $form->submit('sauvegarder');
    ?>
</form>

