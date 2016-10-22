<?php

/*
 * Edition d'un article
 */
?>
<h2> <?= $titre ?> </h2>
<form method='POST'>
    <?php
    echo $form->input('titre', 'text', 'Titre');
    echo $form->submit('sauvegarder');
    ?>
</form>

