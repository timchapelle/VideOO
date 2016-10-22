<nav class="navbar navbar-default">
    <div class="container-fluid ">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">videOO</a>
        </div>
        <ul class="nav navbar-nav navbar-right">


            <?php if (empty($_SESSION['login'])) { ?>
                <li>
                    <a href="index.php?p=inscription">Inscription</a>
                </li>
                <li>
                    <a href="index.php?p=utilisateurs.login">Login</a>
                </li>

                <?php
            } else {
                ?>
                <li class="dropdown" style="margin-right:30px;margin-top:15px">
                    <button id="btnMsg" href="#" class="btn btn-md" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <i class="fa fa-envelope-o"></i> ?>
                    </button>
                    <ul class="dropdown-menu list-group" aria-labelledby="btnMsg">


                        <li class=list-group-item">
                            <a href="index.php?page=messagerie/boite">
                                <img class="img-circle pull-left" style="height:25px" 
                                     src="assets/img/avatar/default_user.jpg">

                                <small><strong>Expediteur</strong></small><br>Contenu</a></li>

                    </ul>

                </li>
                <li>
                    <img class="img-thumbnail" src="data/img/avatar/default_user.jpg ?>" title="nom du user" style="height:50px;margin-right: 10px;margin-top:8px">
                </li>
                <li class="dropdown active">
                    <a id="menuUser" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <?php echo 'Bienvenue $utilisateur'; ?>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="menuUser">
                        <li>
                            <a href="index.php?page=membres/edit_membre&id=tim"><i class="fa fa-user fa-fw"></i>&nbsp; Profil</a>
                        </li>
                        <li>
                            <a href="index.php?page=favoris/films"><i class="fa fa-film fa-fw"></i>&nbsp; Films</a>
                        </li>
                        <li>
                            <a href="index.php?page=messagerie/boite"><i class="fa fa-envelope"></i>&nbsp; Messagerie</a>
                        </li>
                    </ul>
                </li>
                <li><a href="index.php?page=recherches/recherche">
                        <i class="fa fa-search"></i>&nbsp;Allocine</a></li>
                <li><a href="index.php?page=membres/membres"><i class="fa fa-users"></i>&nbsp;Membres</a></li>
                <li><a href="index.php?deco=yes"><i class="fa fa-external-link-square"></i>&nbsp;Déconnexion</a></li>
                <?php } ?>      
        </ul>

    </div>
</nav>
