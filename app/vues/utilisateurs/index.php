<?php

/* 
 *  Page d'affichage des utilisateurs, pour les non-admins
 */
?>
<div class="container-fluid">
    <div class="section">
        <div class="row">
            <table class="table ">
                <thead>
                <th>Login</th>
                <th>Groupe</th>
                <th>Avatar</th>
                </thead>

                <?php foreach ($utilisateurs as $user) : ?>
                    <?php //$avatar = (is_null($user->avatar)) ? 'default_user.jpg' : $user->avatar;  ?>
                    <tr>
                        <td><?= $user->login ?></td>
                        
                        <td><?= $user->groupe ?></td>
                        <td><img class="thumbnail avatar" src="../assets/img/avatar/<?= $user->getAvatar() ?>" alt="Avatar"></td>
                        <td>
                            <ul class="list-group-flush">
                                <li class="list-group-item">
                                    <a class="btn btn-sm" href="index.php?p=utilisateurs.show&id=<?=$user->id?>"
                                       title="Afficher le profil">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

        </div>
    </div>
</div>

