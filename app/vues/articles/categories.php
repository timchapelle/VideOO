<?php
/*
 * Affichage des articles d'une catégorie
 */
?>
<h1><span class="label label-primary"><?= $categorie->titre ?></span></h1>

<?php foreach ($articles as $article) : ?>

    <h2><a href="<?= $article->url ?>"><?= $article->titre ?></a></h2>
    <small><?= $article->date ?></small>
    <p><?= $article->contenu ?></p>
<?php endforeach; ?>