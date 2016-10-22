<?php

/* 
 * Fiche détaillée d'un acteur/producteur/réalisateur/...
 */

    $acteur = json_decode($result);
    $acteur = $acteur->person;
    $stats = $acteur->statistics;
    $dol = "$";
    $nom = $acteur->name->given . ' ' . $acteur->name->family;
    $vraiNom = ' (' . $acteur->realName . ')';
    $vraiNom = ($vraiNom === ' ()') ? '' : $vraiNom;
    $sexeIcone = ($acteur->gender == 1) ? '<i class="fa fa-male"></i>' : '<i class="fa fa-female>';
    $nationalite = $acteur->nationality[0]->$dol;
    $urlImage = $acteur->picture->href;
    $nbFilms = count($acteur->participation);
    $biographie = (strip_tags($acteur->biography, '<br><strong><b><em>') != '') ? strip_tags($acteur->biography, '<br><strong><b><em>') : 'Pas de biographie disponible' ;
    $age = $this->age(date('d/m/Y',  strtotime($acteur->birthDate))) ; 

?>
<div class="page-header">
    <h1><?= $nom ?> <small><?= $vraiNom ?></small></h1>
</div>
<div class="section">
    <div class="row">
        <div class="col-md-4">
        <div class="col-md-12">
            <img class="img-responsive" src="<?= $urlImage ?>" alt="<?= $nom ?>">
        </div>
        <div class="col-md-12">
            <ul class="list-group">
                <li class="list-group-item">
                    <?= $nationalite ?>
                </li>
                <li class="list-group-item">
                    <?= date('d/m/Y',  strtotime($acteur->birthDate)) . ' (' . $age . ' ans)' ?><br>
                    <?= $acteur->birthPlace ?>
                </li>
            </ul>
        </div>
        </div>
        <div class="col-md-8">
            <div>

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#bio" aria-controls="bio" role="tab" data-toggle="tab">Biographie</a></li>
                    <li role="presentation"><a href="#filmo" aria-controls="filmo" role="tab" data-toggle="tab">Filmographie</a></li>
                    <li role="presentation"><a href="#stats" aria-controls="stats" role="tab" data-toggle="tab">Statistiques</a></li>
                </ul>

                <!-- Tabs -->
                <div class="tab-content">
                    <!-- Tab biographie -->
                    <div role="tabpanel" class="tab-pane fade in active" id="bio">
                        <br>
                        <?= $biographie ?>
                    </div>
                    <!-- Tab Filmographie -->
                    <div role="tabpanel" class="tab-pane fade" id="filmo">
                        <br>
                        <div class="card-columns">
                            <?php
                            for ($j = 0; $j < $nbFilms; $j++) {
                                $part = $acteur->participation[$j];
                                $film = ($part->movie->code != '') ? $part->movie : $part->tvseries;
                                $titreVF = (($film->title != $film->originalTitle) && $film->originalTitle != '') ? ' (' . $film->title . ')' : '';
                                $typeFilm = ($film->movieType->$dol != '') ? $film->movieType->$dol : $film->seriesType->$dol;
                                $annee = ($film->productionYear != '') ? $film->productionYear : ((($film->yearStart != $film->yearEnd) && $film->yearEnd != '') ? ($film->yearStart . ' - ' . $film->yearEnd) : $film->yearStart);
                                $note = ($film->statistics->userRating != '') ? $film->statistics->userRating : 0;
                                $lienImg = ($film->poster->href != '') ? $film->poster->href : 'assets/img/ph_film.png';
                                $dol = "$";
                                ?>

                                <div class="card">
                                    <a href="index.php?p=allocine.films.show&id=<?= $film->code ?>">
                                        <img class="card-img-top img-responsive" src="<?= $lienImg ?>" alt="<?= $film->title ?>">
                                        <div class="card-block">
                                            <h4 class="card-title"><?= $film->originalTitle ?>
                                                <small><?= $titreVF ?></small>
                                            </h4>
                                    </a>
                                    <span class="label label-default"><?= $annee ?></span>
                                    <?php
                                    for ($z = 0; $z < floor($film->statistics->userRating); $z++) {
                                        echo '<i class="fa fa-star jaune"></i>';
                                    }
                                    if (($film->statistics->userRating - 0.5) > floor($film->statistics->userRating)) {
                                        echo '<i class="fa fa-star-half jaune"></i>';
                                    }
                                    ?>
                                    <p class="card-text"><?= $film->synopsisShort ?></p>
                                </div>
                            </div>


                        <?php } ?>
                    </div>
                </div>

                <!-- Tab Statistiques -->
                <div role="tabpanel" class="tab-pane fade" id="stats">
                    <br>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <?php if ($stats->movieCount != 0) : ?>
                            <li class="list-group-item active">
                                <span class="badge"><?= $stats->movieCount ?></span>
                                Films
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->movieActorCount != 0) : ?>
                            <li class="list-group-item">
                                <span class="badge"><?= $stats->movieActorCount ?></span>
                                Acteur 
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->movieDirectorCount != 0) : ?>
                            <li class="list-group-item">
                                <span class="badge"><?= $stats->movieDirectorCount ?></span>
                                Réalisateur 
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->movieProducerCount != 0) : ?>
                            <li class="list-group-item">
                                <span class="badge"><?= $stats->movieProducerCount ?></span>
                                Producteur 
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->seriesCount != 0) : ?>
                            <li class="list-group-item active">
                                <span class="badge"><?= $stats->seriesCount ?></span>
                                Séries TV
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->seriesActorCount != 0) : ?>
                            <li class="list-group-item">
                                <span class="badge"><?= $stats->seriesActorCount ?></span>
                                Acteur 
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->seriesDirectorCount != 0) : ?>
                            <li class="list-group-item">
                                <span class="badge"><?= $stats->seriesDirectorCount ?></span>
                                Réalisateur
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->seriesProducerCount != 0) : ?>
                            <li class="list-group-item">
                                <span class="badge"><?= $stats->seriesProducerCount ?></span>
                                Producteur
                            </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <?php if ($stats->nominationCount != 0) : ?>
                            <li class="list-group-item">
                                <span class="badge"><?= $stats->nominationCount ?></span>
                                Nominations
                            </li>
                            <?php endif; ?>
                            <?php if ($stats->awardCount != 0) : ?>
                                <li class="list-group-item">
                                    <span class="badge"><?= $stats->awardCount ?></span>

                                    <a href="#awards" onclick="montrerAwards()">Awards</a>

                                </li>

                                <li class="list-group-item" id="awards" style="display: none">
                                    <?php
                                    for ($i = 0; $i < count($acteur->festivalAward); $i++) {
                                        $award = $acteur->festivalAward[$i];
                                        $titreAward = ($award->entities->movie->title != '') ? $award->entities->movie->title : $award->entities->tvseries->title;
                                        $imgAward = ($award->entities->movie->poster->href != '') ? $award->entities->movie->poster->href : $award->entities->tvseries->poster->href;
                                        ?>

                                        <div class="media">
                                            <div class="media-left media-middle">
                                                <a href="index.php?p=allocine.films.show&id=<?= $award->entities->movie->code ?>">
                                                    <img class="media-object thumbFilmo"
                                                         src="<?= $imgAward ?>" 
                                                         alt="Pas de photo dispo"

                                                         >
                                                </a>
                                            </div>
                                            <div class="media-body">

                                                <h5 class="media-heading"><?= $titreAward ?>
                                                    <span class="label label-default">
                                                        <?= $award->parentEdition->name ?>
                                                    </span>
                                                </h5>
                                                <h6><span class="label label-info">
                                                        <?= $award->parentFestival->name ?>
                                                    </span></h6>
                                                <p><?= $award->name ?></p>
                                            </div>
                                        </div> 
                                        <?php if ($i != count($acteur->festivalAward) - 1) { ?>
                                            <hr>


                                            <?php
                                        }
                                    }
                                    ?>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function montrerAwards() {
        $("#awards").toggle();
    }
</script>

