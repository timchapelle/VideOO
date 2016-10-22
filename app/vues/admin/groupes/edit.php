<?php

/*
 * Edition d'un groupe
 */
?>
<h2> <?= $titre ?> </h2>
<form method='POST'>
    <?php
    echo $form->input('nom', 'text', 'Nom');
    echo $form->submit('sauvegarder');
    ?>
</form>
