<?php
/*
 * Index de l'administration des utilisateurs
 */
?>
<div class="container-fluid">
    <div class="section">
        <div class="row">
            <a href="?p=admin.utilisateurs.add" class="btn btn-success-outline"><i class="fa fa-plus"></i> Ajouter un utilisateur</a>
            <table class="table ">
                <thead>
                <th>Id</th>
                <th>Login</th>
                <th>E-mail</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Admin</th>
                <th>Groupe</th>
                <th>Avatar</th>
                </thead>

                <?php foreach ($utilisateurs as $user) : ?>
                    <?php //$avatar = (is_null($user->avatar)) ? 'default_user.jpg' : $user->avatar;  ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->login ?></td>
                        <td><?= $user->mail ?></td>
                        <td><?= $user->nom ?></td>
                        <td><?= $user->prenom ?></td>
                        <td><?= ($user->admin == 1) ? 'Oui' : 'Non' ?></td>
                        <td><?= $user->groupe ?></td>
                        <td><img class="thumbnail avatar" src="../assets/img/avatar/<?= $user->getAvatar() ?>" alt="Avatar"></td>
                        <td>
                            <div class="btn-group-lg">
                                <button type="button" class="btn btn-primary btn-link">
                                    <a href="index.php?p=utilisateurs.show&id=<?= $user->id ?>" title="Afficher le profil">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </button>

                                <button type="button" class="btn btn-link"><a href="?p=admin.utilisateurs.edit&id=<?= $user->id ?>"><i class="fa fa-edit center-block"></i></a></button>
                                <form action='?p=admin.utilisateurs.delete' method="POST">
                                    <input type="hidden" name="id" value="<?= $user->id ?>">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fa fa-trash-o center-block"></i>
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>

