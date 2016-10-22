<?php
/*
 * Page d'accueil
 */
?> 

<div class="section">
    <div class="row">
        <div class="col-sm-8">
            <?php foreach ($articles as $article) : ?>
                <h2>
                    <a href="<?= $article->url ?>">
                        <?= $article->titre ?>
                    </a>&nbsp;
                </h2>
                <h5><span class="label label-default"><?= $article->categorie ?></span></h5>
                <p><?= $article->extrait ?></p>
            <?php endforeach; ?>

        </div>
        <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item active">
                    <strong>Catégories</strong>
                </li>
                <?php foreach ($categories as $categorie) : ?>
                    <li class="list-group-item">
                        <a href="<?= $categorie->url ?>">    
                            <?= $categorie->titre; ?>
                        </a>    
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>

