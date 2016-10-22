<?php

/*
 * Fiche détaillée d'une série
 */

$infos = json_decode($result);
$serie = $infos->tvseries;
$titre = $serie->originalTitle;
$titreVF = ($titre != $serie->title) ? ' (' . $serie->title . ')' : '';
$annees = (($serie->yearStart != $serie->yearEnd) && $serie->yearEnd != '') ? $serie->yearStart . ' - ' . $serie->yearEnd : $serie->yearStart;
$dol = "$";
?>
<div class="page-header"
<?php if ($serie->topBanner->href != '') : ?>
         style="background-size:cover;
         background-image: url('<?= $serie->topBanner->href ?>');
         background-attachment: scroll;
         height:200px"
     <?php endif; ?>>
    <h1><?= $titre ?> <small><?= $titreVF ?></small> <span class="label label-default"><?= $annees ?></span></h1>
    <h3><span class="label label-info"><?= $serie->seriesType->$dol ?></span>
        <?php for ($i = 0; $i < count($serie->genre); $i++) { ?>
            <span class="label label-success"><?= $serie->genre[$i]->$dol ?></span>
        <?php } ?>
        <?php for ($j = 0; $j < count($serie->nationality); $j++) { ?>
            <span class="label label-warning"><?= $serie->nationality[$j]->$dol ?></span>
        <?php } ?>
    </h3>
</div>
<div class="section">
    <div class="container-fluid"> 

        <div class="col-md-3">
            <img class="img-responsive" src="<?= $serie->poster->href ?>" alt="<?= $serie->originalTitle ?>">
        </div>
        <div class="col-md-9">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#infos" aria-controls="infos" role="tab" data-toggle="tab">Infos</a></li>
                    <li role="presentation"><a href="#saisons" aria-controls="saisons" role="tab" data-toggle="tab">Saisons</a></li>
                    <li role="presentation"><a href="#casting" aria-controls="casting" role="tab" data-toggle="tab">Casting</a></li>
                    <li role="presentation"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Statistiques</a></li>
                    <li role="presentation"><a href="#trivia" aria-controls="trivia" role="tab" data-toggle="tab">Trivia</a></li>
                    <li role="presentation"><a href="#news" aria-controls="news" role="tab" data-toggle="tab">News</a></li>
                </ul>

                <!-- Tabs -->
                <div class="tab-content">
                    <!-- Tab Infos -->
                    <div role="tabpanel" class="tab-pane active" id="infos">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSerie">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#accoSerie" aria-expanded="false" aria-controls="collapseTwo">
                                            La série
                                        </a>
                                    </h4>
                                </div>
                                <div id="accoSerie" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSerie">
                                    <div class="panel-body">
                                        <ul class ="list-group">
                                            <li class="list-group-item">
                                                <strong>Format  : </strong> <?= $serie->formatTime ?> minutes
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Nombre de saisons : </strong> <?= $serie->seasonCount ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Nombre d'épisodes : </strong> <?= $serie->episodeCount ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Statut de production : </strong> <?= $serie->productionStatus->$dol ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Diffuseur original : </strong> <?= $serie->originalChannel->channel->name ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headCasting">
                                    <h4 class="panel-title">
                                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#castingBref" aria-expanded="true" aria-controls="collapseOne">
                                            Le casting en bref
                                        </a>
                                    </h4>
                                </div>
                                <div id="castingBref" class="panel-collapse collapse " role="tabpanel" aria-labelledby="headCasting">
                                    <div class="panel-body">
                                        <ul class="list-group">
                                            <li class="list-group-item">
                                                <strong>Créateur(s) :</strong> <?= $serie->castingShort->creators ?>
                                            </li>
                                            <li class="list-group-item">
                                                <strong>Acteur(s) :</strong> <?= $serie->castingShort->actors ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingHistoire">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#histoireBref" aria-expanded="false" aria-controls="collapseThree">
                                            L'histoire en bref
                                        </a>
                                    </h4>
                                </div>
                                <div id="histoireBref" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingHistoire">
                                    <div class="panel-body">
                                        <?= strip_tags($serie->synopsisShort) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Bande-annonce de la série -->
                        <?= $serie->trailerEmbed ?>
                    </div>
                    <!-- Tab Saisons -->
                    <div role="tabpanel" class="tab-pane" id="saisons">
                        <?php
                        for ($k = 0; $k < count($serie->season); $k++) {
                            $saison = $serie->season[$k];
                            $anneeSaison = ($saison->yearStart != $saison->yearEnd) ? ' (' . $saison->yearStart . ' - ' . $saison->yearEnd . ')' : ' (' . $saison->yearStart . ')';
                            $stats = $saison->statistics;
                            ?>
                            <div class="panel panel-default">
                                <div class="panel-heading" role="tab" id="headingSaison<?= $k ?>">
                                    <h4 class="panel-title">
                                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#saison<?= $k ?>" aria-expanded="false" aria-controls="collapseThree">
                                            Saison <?= $saison->seasonNumber ?> <?= $anneeSaison ?>
                                        </a>
                                    </h4>
                                </div>
                                <div id="saison<?= $k ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSaison<?= $k ?>">
                                    <div class="list-group">
                                        <li class="list-group-item"><strong>Statut :</strong> <?= $saison->productionStatus->$dol ?></li>
                                        <li class="list-group-item"><strong>Nombre d'épisodes :</strong> <?= $saison->episodeCount ?></li>
                                        <li class="list-group-item active"> <strong>Statistiques</strong>  </li>
                                        <li class="list-group-item"> <strong>Note du public :</strong>   
                                            <?php $this->afficherEtoiles($stats->userRating); ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Audience moyenne : </strong> <?= number_format($stats->averageViewerCount, 0, ',', ' ') ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Audience max : </strong> <?= number_format($stats->maxViewerCount, 0, ',', ' ') ?>
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Audience totale : </strong> <?= number_format($stats->totalViewerCount, 0, ',', ' ') ?>
                                        </li>
                                    </div>
                                </div>
                            </div>
                            <!-- Bande annonce de la saison -->
                            <?= $saison->trailerEmbed ?>
                        <?php } ?>
                    </div>
                    <!-- Tab Casting -->
                    <div role="tabpanel" class="tab-pane" id="casting">
                        <ul class="list-group">
                            <?php
                            for ($m = 0; $m < count($serie->castMember); $m++) {
                                $acteur = $serie->castMember[$m];
                                $imgActeur = ($acteur->picture->href != '') ? $acteur->picture->href : 'data/img/avatar/default_user.jpg';
                                ?>

                                <li class="list-group-item">
                                    <a href="index.php?p=allocine.acteurs.show&id=<?= $acteur->person->code ?>"><?= $acteur->person->name ?></a>
                                    <img src="<?= $imgActeur ?>" alt="<?= $acteur->person->name ?>" 
                                         style="height:40px;width: 40px;margin-top:-9px" class="img-rounded pull-right">
                                    <span class="label label-primary">
                                        <?= $acteur->activity->$dol ?>
                                    </span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Tab Stats -->
                    <div role="tabpanel" class="tab-pane" id="stats">
                        <?php $stat = $serie->statistics; ?>
                        <ul class="list-group">
                            <li class="list-group-item active">
                                Note du public : 
                                <?php $this->afficherEtoiles($stat->userRating); ?>
                            </li>
                            <?php for ($n = 0; $n < count($stat->rating); $n++) { ?>
                                <li class="list-group-item">
                                    <?php $this->afficherEtoiles($stat->rating[$n]->note); ?>
                                    <span class="badge pull-right"><?= $stat->rating[$n]->$dol ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <!-- Tab Trivia -->
                    <div role="tabpanel" class="tab-pane" id="trivia">
                        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                            <?php
                            for ($o = 0; $o < count($serie->trivia); $o++) {
                                $trivia = $serie->trivia[$o];
                                ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="heading<?= $o ?>">
                                        <h4 class="panel-title">
                                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse<?= $o ?>" aria-expanded="true" aria-controls="collapse<?= $o ?>">
                                                 <?= $trivia->title ?>
                                                <span class="label label-default"><?= substr($trivia->publication->dateStart, 0, 4) ?></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?= $o ?>" class="panel-collapse collapse " role="tabpanel" aria-labelledby="heading<?= $o ?>">
                                        <div class="list-group">
                                            <li class="list-group-item"><?= $trivia->body ?>
                                            </li>
                                        </div>
                                    </div>
                                </div>
<?php } ?>
                        </div>
                    </div>
                    <!-- Tab news --> 
                    <div role="tabpanel" class="tab-pane" id="news">
                        <div class="card-columns">
                            <?php
                        for ($p = 0; $p < count($serie->news); $p++) {
                            $news = $serie->news[$p];
                            ?>
                            <div class="card">
                                <img class="card-img-top" src="<?=$news->picture->href?>" alt="Pas d'image">
                                <div class="card-block">
                                    <h4 class="card-title"><?= $news->category[0]->$dol ?></h4>
                                    <a href="index.php?p=allocine.news.show&id==<?=$news->code?>"><p class="card-text"><?= $news->title ?></p></a>
                                </div>
                            </div>
                       <?php } ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

