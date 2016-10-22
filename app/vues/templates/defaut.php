<?php

use Core\Auth\DbAuth;

/*
 * Template (gabarit) par défaut du site
 */
$app = App::getInstance();
if (isset($_SESSION["auth"])) {
    $currentUser = $app->getTable('Utilisateur')->find($_SESSION["auth"]);
}

?>
<!DOCTYPE html>
<!--

VideOO - Site collaboratif (avec api allocine en prime)

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $app->titre ?></title>
    </head>
    <body><?php
        include (ROOT . '/app/vues/trame/head.php');

        if (isset($currentUser) && $currentUser->admin) {
            include (ROOT . '/app/vues/admin/trame/topbar.php');
        } else if (!empty($_SESSION["auth"])) {
            include (ROOT . '/app/vues/membres/trame/topbar.php');
        } else {
            include (ROOT . '/app/vues/trame/topbar.php');
        }
        ?>
        <div class="container-fluid">
            <div class="section">
                <div class="row">
                        <?php
                        if (isset($currentUser) && $currentUser->admin) {
                            echo '<div class=col-sm-3>';
                            include (ROOT . '/app/vues/admin/trame/sidebar.php');
                            echo '</div>';
                        } else if (!empty($_SESSION["auth"])) {
                            echo '<div class=col-sm-3>';
                            include (ROOT . '/app/vues/membres/trame/sidebar.php');
                            echo '</div>';
                        }
                        ?>
                    
                    <div class="col-sm-9">
                        <?= $contenu ?>
                    </div>
                </div>
            </div>
        </div>
<?php include(ROOT . '/app/vues/trame/footer.php'); ?>
        
    </body>
</html>

