<?php
/*
 * Fiche détaillée d'un film
 */
$infos = json_decode($result);
$film = $infos->movie;
$acteurs = $this->getActeurs($film->castMember);
$top5act = (count($acteurs["nom"]) < 5) ? count($acteurs["nom"]) : 5;
$totalAct = count($acteurs["nom"]);
// Si un titre en français existe, alors on le met entre ()
$titreVF = ($film->originalTitle != $film->title && $film->title != '') ? ' (' . $film->title . ')' : '';

$userEtoiles = floor($film->statistics->userRating);
$pressEtoiles = floor($film->statistics->pressRating);
$dol = "$";
?>
<a href="javascript:history.go(-1)">retour</a>
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <!-- Image -->
                <img src="<?= $film->poster->href ?>"
                     class="img-responsive">
            </div>
            <div class="col-md-6">
                <!-- Titre original -->
                <h1><?= $film->originalTitle ?></h1>
                <!-- Titre VF (si il existe) -->
                <h3><?= $titreVF ?></h3> 

                <h3><span class="label label-default"><?= $film->productionYear ?></span> 
                    <span class="label label-info"><?= $film->movieType->$dol ?></span> 
                </h3>   

                <h4>       <?php
for ($k = 0; $k < count($film->genre); $k ++) {
    echo '<span class="label label-success">' . $film->genre[$k]->$dol . '</span> ';
}
?>
                </h4>

                <!-- Tabs : Synopsis - Casting - Notes -->
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#synopsis" aria-controls="home" role="tab" data-toggle="tab">Synopsis</a></li>
                        <li role="presentation"><a href="#casting" aria-controls="profile" role="tab" data-toggle="tab">Casting</a></li>
                        <li role="presentation"><a href="#notes" aria-controls="messages" role="tab" data-toggle="tab">Notes</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <!-- Tab Synopsis -->
                        <div role="tabpanel" class="tab-pane fade in active" id="synopsis">
                            <br>
                            <p><?= $film->synopsis ?></p>
                        </div>
                        <!-- Tab casting -->
                        <div role="tabpanel" class="tab-pane fade" id="casting">
                            <br>
<?php for ($i = 0; $i < $top5act; $i++) { ?>

                                <div class="media">
                                    <div class="media-left media-middle">
                                        <a href="index.php?p=allocine.acteurs.show&id=<?= $acteurs["code"][$i] ?>">
                                            <img class="media-object"
                                                 src="<?= $acteurs["image"][$i] ?>" 
                                                 alt="Pas de photo dispo"
                                                 style="width:64px"
                                                 >
                                        </a>
                                    </div>
                                    <div class="media-body">

                                        <h4 class="media-heading"><?= $acteurs["nom"][$i] ?></h4>
    <?= '<span class="label label-danger">' . $film->castMember[$i]->activity->$dol . '</span><br>'; ?>
                                        <?= 'Rôle : ' ?><?= ($acteurs["role"][$i] == '') ? 'Aucun' : $acteurs["role"][$i]; ?>
                                    </div>
                                </div>
<?php } ?>
                            <!-- Bouton casting complet -->
                            <a href="#castingComplet" id="lienCastingComplet" onclick="afficherCastingComplet()">Casting complet</a>
                            <div style="display:none" id="castingComplet">
<?php for ($h = $top5act; $h < $totalAct; $h++) { ?>
                                    <div class="media">
                                        <div class="media-left media-middle">
                                            <a href="index.php?p=allocine.acteurs.show&id=<?= $acteurs["code"][$h] ?>">
                                                <img class="media-object"
                                                     src="<?= $acteurs["image"][$h] ?>" 
                                                     alt="Pas de photo dispo"
                                                     style="width:64px"
                                                     >
                                            </a>
                                        </div>
                                        <div class="media-body">

                                            <h4 class="media-heading"><?= $acteurs["nom"][$h] ?></h4>
    <?= '<span class="label label-danger">' . $film->castMember[$h]->activity->$dol . '</span><br>'; ?>
                                            <?= 'Rôle : ' ?><?= ($acteurs["role"][$h] == '') ? 'Aucun' : $acteurs["role"][$h]; ?>
                                        </div>
                                    </div>  
<?php }
?>
                            </div>
                        </div>
                        <!-- Tab notes -->
                        <div role="tabpanel" class="tab-pane fade" id="notes">
                            <br>
                            <ul>
                                <li>Note du public : <?php
for ($j = 0; $j < $userEtoiles; $j++) {
    echo '<i class="fa fa-star"></i>';
}
if (($film->statistics->userRating - 0.5) > floor($film->statistics->userRating)) {
    echo '<i class="fa fa-star-half"></i>';
}
?>
                                </li>
                                <li>Note de la presse : <?php
                                    for ($j = 0; $j < $pressEtoiles; $j++) {
                                        echo '<i class="fa fa-star"></i>';
                                    }
                                    if (($film->statistics->pressRating - floor($film->statistics->pressRating)) > 0.5) {
                                        echo '<i class="fa fa-star-half"></i>';
                                    }
?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function afficherCastingComplet() {
        $("#castingComplet").toggle();
    }
</script>

