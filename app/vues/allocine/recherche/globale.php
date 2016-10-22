<?php

/* 
 * Affichage des résultats d'une recherche allocine
 */
$infos = json_decode($result);
$acteurs = $infos->feed->person;
$films = $infos->feed->movie;
$series = $infos->feed->tvseries;
$news = $infos->feed->news;

$nbActeurs = count($acteurs);
$nbFilms = count($films);
$nbSeries = count($series);
$nbNews = count($news);
?>
<div class="section">
    <div class="container">
        <div class="row">
            <?php if ($nbActeurs > 0) : ?>
                <div class="col-lg-4">
                    <ul class="list-group" draggable="true">
                        <li class="list-group-item active">ACTEURS 
                            <span class="label label-default label-pill pull-right">
                                <?= $nbActeurs ?>
                            </span>
                        </li>
                        <?php
                        for ($i = 0; $i < $nbActeurs; $i++) {
                            $acteur = $acteurs[$i];
                            $imgActeur = ($acteur->picture->href != '') ? $acteur->picture->href : 'data/img/avatar/default_user.jpg';
                            ?>
                        <a href="index.php?p=allocine.acteurs.show&id=<?= $acteur->code ?>">
                            <li class="list-group-item"><?= $acteur->name ?>
                                <img src="<?= $imgActeur ?>" 
                                     class="img-circle pull-right" 
                                     style="width:40px;height:40px;margin-top:-10px">
                            </li>
                        </a>    
                        <?php } ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($nbFilms > 0) : ?>
                <div class="col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item active">FILMS 
                            <span class="label label-default label-pill pull-right">
                                <?= $nbFilms ?>
                            </span></li>
                        <?php
                        for ($j = 0; $j < $nbFilms; $j++) {
                            $film = $films[$j];
                            $imgFilm = ($film->poster->href != '') ? $film->poster->href : 'assets/img/ph_film.png';
                            ?>
                            <a href="index.php?p=allocine.films.show&id=<?= $film->code ?>">
                            <li class="list-group-item"> <p><?= $film->originalTitle . ' (' . $film->productionYear . ')' ?></p>
                                <img src="<?= $imgFilm ?>" class="img-circle pull-right" style="width:40px;height:40px;margin-top:-40px">
                            </li>
                            </a>
                    <?php } ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($nbSeries > 0) : ?>
                <div class="col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item active">SERIES 
                            <span class="label label-default label-pill pull-right">
                                <?= $nbSeries ?>
                            </span>
                        </li>
                        <?php
                        for ($k = 0; $k < $nbSeries; $k++) {
                            $serie = $series[$k];
                            $imgSerie = ($serie->poster->href != '') ? $serie->poster->href : 'assets/img/ph_film.png';
                            ?>
                        <a href="index.php?p=allocine.series.show&id=<?=$serie->code?>">
                            <li class="list-group-item"><?= $serie->originalTitle ?>
                                <img src="<?= $imgSerie ?>" class="img-circle pull-right" style="width:40px;height:40px;margin-top:-10px">
                            </li>
                        </a>
                <?php } ?>
                    </ul>
                </div>
            <?php endif; ?>
            <?php if ($nbNews > 0) : ?>
                <div class="col-lg-4">
                    <ul class="list-group">
                        <li class="list-group-item active">NEWS
                            <span class="label label-default label-pill pull-right">
                                 <?= $nbNews ?>
                            </span></li>
                    <?php for ($l=0;$l < $nbNews; $l++) { 
                        $new = $news[$l];
                        $imgNews = ($new->picture->href != '') ? $new->picture->href : 'assets/img/ph_film.png' ;
                        ?>
                        <a href="index.php?p=allocine.news.show&id=<?=$new->code?>">
                            <li class="list-group-item"><?= $new->title; ?>
                            <img src="<?= $imgNews ?>" class="img-circle pull-right" style="width:40px;height:40px;margin-top:-10px">
                            
                        </li>
                        </a>
                    <?php } ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>



