<?php
/*
 * Page d'accueil des recherches allocine
 */
?>
<h2>Rechercher sur Allociné</h2>

<form action="index.php?p=allocine.recherche.globale" method="POST">
    <div class="form-group">
        <p>Que cherchez-vous ?</p>
        <?= $form->radio('type', ['Tout', 'Films', 'Séries TV', 'Acteurs', 'News'], ['tout','movie','tvseries','person','news']); ?>
    </div>
    <?= $form->search('text') ?>
</form>