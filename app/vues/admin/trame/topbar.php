<?php
/*
 * Topbar admin
 */
$user = App::getInstance()->getTable('Utilisateur')->find($_SESSION["auth"]);
$messages = App::getInstance()->getTable('Message')->getNonLus($user->id);
$nbMessages = count($messages);
?>
<nav class="navbar navbar-default">
    <div class="container-fluid ">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php"> &nbsp; videOO</a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown" style="margin-right:30px;margin-top:15px">
                <button id="btnMsg" href="#" class="btn btn-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="fa fa-envelope-o"></i> (<?= $nbMessages ?>)
                </button>


                <ul class="dropdown-menu list-group" aria-labelledby="btnMsg">
                    <?php if ($nbMessages != 0) {
; ?>
    <?php foreach ($messages as $message): ?>
                            <li class="list-group-item">
                                <a href="index.php?p=messages.show&id=<?=$message->id?>">
                                    <img class="img-circle pull-left" style="height:25px" 
                                         src="../assets/img/avatar/default_user.jpg">
                                    <small><strong><?= $message->sujet ?></strong></small><br><?= $message->extrait . '...' ?></a>
                            </li>
                        <?php endforeach; ?>                    

                    <?php } else { ?>
                            <p><a href="index.php?p=messages.index&id=<?=$user->id?>" title="Boîte de réception">Pas de nouveaux messages</a></p>
<?php } ?>
                </ul>
            </li>
            <li>
                <img class = "img-thumbnail" src = "../assets/img/avatar/<?= $user->getAvatar(); ?>" title = "nom du user" style = "height:50px;margin-right: 10px;margin-top:8px">
            </li>
            <li class = "dropdown active">
                <a id = "menuUser" href = "#" class = "dropdown-toggle" data-toggle = "dropdown" aria-haspopup = "true" aria-expanded = "true">
                    <?php echo 'Bienvenue ' . $user->prenom;
                    ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="menuUser">
                    <li>
                        <a href="index.php?p=admin.utilisateurs.edit&id=<?= $_SESSION['auth'] ?>"><i class="fa fa-user fa-fw"></i> Profil</a>
                    </li>
                    <li>
                        <a href="index.php?p=admin.articles.index"><i class="fa fa-newspaper-o fa-fw"></i> Articles</a>
                    </li>
                    <li>
                        <a href="index.php?p=admin.categories.index"><i class="fa fa-sitemap fa-fw"></i> Catégories</a>
                    </li>
                    <li>
                        <a href="index.php?p=calendriers.index&id=<?=$currentUser->id?>&year=<?=date('Y')?>"><i class="fa fa-calendar fa-fw"></i> Calendrier</a>
                    </li>
                    <li>
                        <a href="index.php?p=editeurs.index"><i class="fa fa-code fa-fw"></i>Editeur</a>
                    </li>
                    <li>
                        <a href="index.php?p=editeurs.live"><i class="fa fa-code fa-fw"></i>Editeur live</a>
                    </li>
                </ul>
            </li>
            <li><a href="index.php?p=allocine.recherche.globale">
                    <i class="fa fa-search"></i>&nbsp;Allocine</a></li>
            <li><a href="index.php?p=admin.utilisateurs.index"><i class="fa fa-users"></i>&nbsp;Membres</a></li>
            <li><a href="index.php?p=utilisateurs.logout"><i class="fa fa-external-link-square"></i>&nbsp;Déconnexion</a></li>
            
        </ul>

    </div>
</nav>

