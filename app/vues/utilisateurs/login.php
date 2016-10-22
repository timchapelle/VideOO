<?php

use Core\HTML\BootstrapForm;
use Core\Auth\DbAuth;

if ($errors) :
    ?>

    <div class="alert alert-danger">
        Identifiants incorrects, veuillez ré-essayer
    </div>
<?php endif;?>

<form method='POST'>

    <?php
    echo $formConnexion->input('login', 'text', 'Login');
    echo $formConnexion->input('password', 'password', 'Mot de passe');
    echo $formConnexion->submit('connexion');
    echo $formConnexion->input('action', 'hidden');
    ?>
</form>

    <?php

