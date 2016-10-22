<?php
/*
 * Page d'administration des groupes d'utilisateurs
 */
$i = 1;
?>
<a href="?p=admin.groupes.add" class="btn btn-success-outline"><i class="fa fa-plus"></i> Ajouter un groupe</a>
<table class="table ">
    <thead>
    <th>Id</th>
    <th>Nom</th>
</thead>

<?php foreach ($groupes as $groupe) : ?>
    <?php $membresGroupe = App::getInstance()->getTable('Groupe')->getGroupMembers($groupe->id); ?>
    <tr>
        <td><?= $groupe->id ?></td>
        <td><?= $groupe->nom ?></td>
        <td>
            <a href="?p=admin.groupes.edit&id=<?= $groupe->id ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>

            <form action='?p=admin.groupes.delete' method="POST">
                <input type="hidden" name="id" value="<?= $groupe->id ?>">
                <button type="submit" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash-o"></i>                                                                                    </button>
            </form>
            <a href="#" data-toggle="modal" data-target="#membre<?= $i ?>"><i class="fa fa-eye"></i> Afficher membres</a>
        </td>
    </tr>
    <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" id="membre<?= $i ?>">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <ul class="list-group">
                    <?php foreach ($membresGroupe as $membre): ?>
                        <li class="list-group-item">
                            <a href="index.php?p=utilisateurs.show&id=<?= $membre->id ?>">
                                <img src="../assets/img/avatar/<?= $membre->avatar($membre) ?>" class=" thumbnail" style="display:inline;width:50px;height:50px">

                                <?= $membre->prenom . ' ' . $membre->nom ?>
                            </a>
                        </li>

                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>

    <?php
    $i++;
endforeach;
?>
</table>

