<?php
/*
 * Détail d'un message
 */
?>
<div class = "row">
    <a class = "btn btn-primary"href = "?p=messages.index"><i class = "fa fa-chevron-left"></i></a>
    <div class = "list-group">
        <div class = "list-group-item">
            De : <strong><?= $message->expediteur ?></strong>
        </div>
        <div class="list-group-item">
            A : <strong>Vous</strong>
        </div>
        <div class="list-group-item">
            Date : <strong><?= $message->date_envoi ?></strong>
        </div>
        <div class="list-group-item">
            <span class = "text-center"><?= $message->contenu ?></span>
        </div>
    </div>
</div>