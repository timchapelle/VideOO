<?php
/*
 * Page d'administration des catégories
 */
?>
<a href="?p=admin.categories.add" class="btn btn-success-outline"><i class="fa fa-plus"></i> Ajouter une catégorie</a>
<table class="table ">
    <thead>
    <th>Id</th>
    <th>Titre</th>
</thead>

<?php foreach ($categories as $categorie) : ?>
    <tr>
        <td><?= $categorie->id ?></td>
        <td><?= $categorie->titre ?></td>
        <td>
            <a href="?p=admin.categories.edit&id=<?= $categorie->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

            <form action='?p=admin.categories.delete' method="POST">
                <input type="hidden" name="id" value="<?= $categorie->id ?>">
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash-o"></i>                                                                                    </button>
            </form>
        </td>
    </tr>
<?php endforeach; ?>
</table>
