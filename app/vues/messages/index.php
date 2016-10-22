<?php
/*
 * Boite de réception
 */
$ids = [];
foreach ($messages as $msg) {
    $ids[] = $msg->id;
}
?>
<div class="container-fluid">
    <div class="row">
        <!--main-->
        <div class="col-sm-12">
            <a href="?p=messages.send" class="btn btn-success-outline"><i class="fa fa-paper-plane-o"></i> Nouveau message</a>
            <br>
            <table class="table table-striped table-hover">
                <tbody>
                    <!-- Boîte de réception -->
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" class="all" title="Tout sélectionner" onclick="checkAllMsg(<?= count($messages) ?>)">
                            </label>
                        </td>
                        <td>
                            <button class="btn btn-default" onclick="deleteSelection(<?= count($messages) ?>)"><i title="Supprimer la sélection" class="fa fa-trash"></i></button>
                        </td>
                        <td></td>
                    </tr>
                    <tr>
                <div class="alert alert-success" id="delete" style="display:none"></div>
                </tr>
                <tr>
                    <th>Expéditeur</th>
                    <th>Message</th>
                    <th>Date/Heure</th>
                </tr>
                <!-- Message -->
                <?php foreach ($messages as $msg) : ?>
                    <tr>
                        <td>
                            <label>
                                <input type="checkbox" id="checkMsg<?= $msg->id ?>">
                            </label> <span class="name"><?= $msg->expediteur ?></span></td>
                        <td><a href="?p=messages.show&id=<?= $msg->id ?>">
                                <span class="subject"><?= $msg->sujet ?></span></a> <small class="text-muted"><?= $msg->extrait ?></small></td>
                        <td><span class="badge"><?= $msg->date_envoi ?></span>
                            <span class="label label-success"><?= ($msg->vu == 0 ) ? 'Nouveau' : '' ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row-md-12">
        <div class="well text-right">
            <small>Dernière mise à jour : <b><?= date('d/m/Y H:i:s') ?><b></small>
                        </div>
                        </div>
                        </div>
                        <script type="text/javascript">
                            function marquerVu(id, userId) {
                                jQuery.ajax({
                                    url: "controleurs/controleur.php",
                                    data: 'id=' + id + '&userId=' + userId + '&action=marquerVu',
                                    dataType: 'text',
                                    type: 'POST',
                                    error: function () {
                                        alert('erreur');
                                    }
                                });
                            }
                            function checkAllMsg(max) {
                                var ids = <?php echo json_encode($ids) ?>;
                                for (var i = 0; i < max; i++) {
                                    if (!$("#checkMsg" + ids[i]).is(':checked')) {
                                        $("#checkMsg" + ids[i]).prop('checked', true);
                                    } else {
                                        $("#checkMsg" + ids[i]).prop('checked', false);
                                    }
                                }
                            }
                            function checkAllMsgE(max) {
                                for (var j = 0; j < max; j++) {
                                    if (!$("#checkMsgE" + j).is(':checked')) {
                                        $("#checkMsgE" + j).prop('checked', true);
                                    } else {
                                        $("#checkMsgE" + j).prop('checked', false);
                                    }
                                }
                            }
                            function deleteSelection(max) {
                                var ids = <?php echo json_encode($ids) ?>;
                                for (var i = 0; i < max; i++) {
                                    if ($("#checkMsg" + ids[i]).is(':checked')) {
                                        jQuery.ajax({
                                            url: "index.php?p=messages.delete",
                                            data: 'id=' + ids[i],
                                            dataType: 'text',
                                            type: 'POST',
                                            success: function (data) {
                                                $("#delete").html('Suppression effectuée');
                                                $("#delete").show();
                                            },
                                            error: function () {
                                                $("#delete").text('Erreur lors de la suppression des messages');
                                            }
                                        });
                                    }
                                }
                            }
                            $(function () {
                                var tooltips = $("[title]").tooltip({
                                    position: {
                                        my: "left top",
                                        at: "right+5 top-5",
                                        collision: "none"
                                    }
                                });
                            });
                        </script>
