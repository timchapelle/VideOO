<?php
/*
 * Index de la partie admin du site
 */
?>
<div class="container-fluid">
    <div class="section">
        <div class="row">
            <a href="?p=admin.articles.add" class="btn btn-success-outline"><i class="fa fa-plus"></i> Ajouter un article</a>
            <table class="table ">
                <thead>
                <th>Id</th>
                <th>Titre</th>
                <th>Contenu</th>
                <th>Date</th>
                <th>Catégorie</th>
                </thead>

                <?php foreach ($articles as $article) : ?>
                    <tr>
                        <td><?= $article->id ?></td>
                        <td><?= $article->titre ?></td>
                        <td><?= $article->contenu ?></td>
                        <td><?= $article->date ?></td>
                        <td><?= $article->categorie ?></td>
                        <td>
                            <a href="?p=admin.articles.edit&id=<?= $article->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

                            <form action='?p=admin.articles.delete' method="POST">
                                <input type="hidden" name="id" value="<?= $article->id ?>">
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash-o"></i>                                                                                    </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>
