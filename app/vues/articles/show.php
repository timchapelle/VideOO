<?php
/*
 * Vue d'un article unique
 */
if (isset($_SESSION["auth"])) {
    $app = App::getInstance();
    $currentUser = $app->getTable('Utilisateur')->find($_SESSION["auth"]);
}
?>

<h4><span class="label label-info"><?= $cat ?></span>
    <?php if ($currentUser->admin): ?>
    <a href="index.php?p=admin.articles.edit&id=<?=$article->id ?>">
    <h3><span class="label label-default pull-right"><i class="fa fa-edit"></i></span></h3>
    </a>
    <?php endif; ?>
</h4>
<h2><?= $article->titre ?>&nbsp;<small><?= date('d/m/Y , H\h', strtotime($article->date)) ?></small></h2>
<p><?= $article->contenu ?></p>
