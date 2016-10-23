<?php
/*
 * Page d'accueil du calendrier
 */

if (!empty($calendriers)) : ?>
<div class="input-group">
    <form action="index.php?p=calendriers.index" method="POST">
        <?= $formCal->select('choixCal', '<i class="fa fa-calendar-o"></i>', $calendriers) ?>
        <div class="btn-group">
            <button class="btn btn-primary-outline" type="submit" name="confirmer" value="confirmer">Confirmer</button>
            <button class="btn btn-primary-outline" type="button" data-toggle="collapse" href="#divAjoutCal" name="ajoutCal" value="ajoutCal"><i class="fa fa-plus"></i></button>
        </div>

    </form>
</div>
<div class="collapse" id="divAjoutCal">
    <form action="index.php?p=calendriers.add" method="POST">
    <?= $form->input('title', 'text', 'Nom') ?>
        <?= $form->submit('ajouter') ?>
    </form>
</div>
<h1><?= $calendrier->titre ?></h1>
<div class="periodes">
    <div class="annee">
        <h3>
            <a href="index.php?p=calendriers.index&id=<?= $_SESSION['auth'] ?>&year=<?= $year - 1 ?>">
                <span class="badge"><i class="fa fa-chevron-left"></i>
                </span>
            </a>
            &nbsp;
            <span class="label label-info"><?= $year ?></span>
            &nbsp;
            <a href="index.php?p=calendriers.index&id=<?= $_SESSION['auth'] ?>&year=<?= $year + 1 ?>">
                <span class="badge">
                    <i class="fa fa-chevron-right"></i>
                </span>
            </a>
        </h3>
    </div>
    <div class="choixmois">
        <ul>
            <?php foreach ($date->mois as $id => $mois) : ?>
                <li><a href="#" id="lienMois<?= $id + 1 ?>">
                        <span class="label label-primary"> <?= utf8_encode(substr(utf8_decode($mois), 0, 3)) ?></span>
                    </a>
                </li>

            <?php endforeach; ?>
        </ul>
    </div>
    <?php $dates = $dates[$year]; ?>
    <?php foreach ($dates as $mois => $jours) : ?>
        <div class="mois" id="mois<?= $mois ?>">
            <table class="table table-striped">
                <thead>
                    <?php foreach ($date->getJours() as $jour) : ?>
                    <td><?= $jour ?></td>
                <?php endforeach; ?>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        $end = end($jours);
                        foreach ($jours as $j => $w) :
                            $time = strtotime("$year-$mois-$j");
                            if ($time == strtotime(date('Y-m-d'))) {
                                $classeJour = 'aujourdhui';
                            } else if ($w >= 6) {
                                $classeJour = 'weekend';
                            } else {
                                $classeJour = 'jour';
                            }
                            ?>
                            <?php if (($j == 1) && ($w - 1) != 0) : ?>
                                <td colspan="<?= $w - 1 ?>"></td>
                            <?php endif; ?>
                            <td class="<?= $classeJour ?>">
                                <span class="badge"> <?= $j ?></span>
                                <?php if ($time >= strtotime(date('Y-m-d'))) : ?>
                                    <span class="pull-right label label-info">
                                        <i class="fa fa-plus"  onclick="ajout(<?= date('H') . ',' . strtotime(date('Y-m-d')) . ',' . $time ?>)"></i>
                                    </span>
                                    <?php
                                endif;

                                foreach ($evenements as $id => $evenement) :
                                    if (strtotime($evenement->date_debut) == $time) :
                                        ?>
                                        <!-- Evenements -->
                            <li class="events" >

                                <!-- Popover -->
                                <div id="pop<?= $id ?>"         
                                     data-toggle="popover" 
                                     data-placement="<?= ($w < 5) ? 'right' : 'left' ?>" 
                                     data-title="<?= '<b>' . $evenement->titre . '</b>' ?>"
                                     data-content="<?= $evenement->contenu ?>"
                                     data-html="true">
                                </div>
                                <!-- Lien vers le modal -->
                                <a data-target="#modal<?= $id ?>" 
                                   onmouseover="showPopover(<?= $id ?>)" 
                                   data-toggle="modal" 
                                   data-target=".bs-example-modal-md">
                                    <span class="label label-success">
                                        <?= (!is_null($evenement->heure_debut)) ? substr('0' . $evenement->heure_debut, -2) . 'h' . substr('0' . $evenement->min_debut, -2) : "Toute la journée"; ?>
                                    </span>
                                </a>
                            </li>
                            <!-- Modal événement -->
                            <div id="modal<?= $id ?>" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="DescriptionEvenement">
                                <div class="modal-dialog modal-md" role="document">
                                    <div class="modal-content">

                                        <div class="container">
                                            <h3><?= $evenement->titre ?></h3>
                                            <h4>
                                                <span class="label label-primary">
                                                    <i class="fa fa-calendar-check-o fa-fw"></i>
                                                    <?= $j . '/' . $mois ?>

                                                </span>
                                                &nbsp;
                                                <span class="label label-warning">
                                                    <i class="fa fa-clock-o"></i>
                                                    <?= ((isset($evenement->heure_debut)) ? substr('0' . $evenement->heure_debut, -2) . 'h' . substr('0' . $evenement->min_debut, -2) : 'Toute la journée') ?>
                                                    <?= ((isset($evenement->heure_fin)) ? ' - ' . substr('0' . $evenement->heure_fin, -2) . 'h' . substr('0' . $evenement->min_fin, -2) : '') ?>
                                                </span>
                                                &nbsp;
                                                <?php
                                                $parent = $evenement->isParent();
                                                if ($parent) :
                                                    $enfants = $evenement->enfants;
                                                    ?>
                                                    <span class="label label-default">Parent : <?= $enfants->nb ?> enfants

                                                    </span>
                                                    <?php
                                                endif;
                                                $enfant = $evenement->isEnfant();
                                                if ($enfant) :
                                                    ?>
                                                    <span class="label label-default">Enfant

                                                    </span>

                                                <?php endif; ?>

                                            </h4>

                                            <?php if ($_SESSION["auth"] == $evenement->user_id): ?>

                                                <div class="btn-group" role="group" aria-label="...">

                                                    <form action="index.php?p=evenements.edit" method="POST" style="display:inline-block">
                                                        <input type="hidden" name="id" value="<?= $evenement->id ?>">
                                                        <input type="hidden" name="calendrier_id" value="<?= $evenement->calendrier_id ?>">
                                                        <input type="hidden" name="time" value="<?= strtotime($evenement->date_debut) ?>">

                                                        <button type="button" class="btn btn-primary-outline"><i class="fa fa-edit"></i></button>
                                                    </form>
                                                    <button type="button" class="btn btn-danger-outline" id="btnDelete" onclick="toggleChoixDelete(<?= $evenement->id ?>)"><i class="fa fa-trash-o"></i></button>
                                                </div>
                                                <form action="index.php?p=evenements.delete" method="POST">
                                                    <input type="hidden" name="id" value="<?= $evenement->id ?>">
                                                    <input type="hidden" name="calendrier_id" value="<?= $evenement->calendrier_id ?>">
                                                    <input type="hidden" name="date_debut" value="<?= $evenement->date_debut ?>">
                                                    <input type="hidden" name="parent_id" value="<?= (is_null($evenement->parent_id)) ? $evenement->id : $evenement->parent_id ?>">
                                                    <div class="hide" id="choixDelete<?= $evenement->id ?>">
                                                        <div class="checkbox">
                                                            <label><input name="only1" id="only1" type="checkbox">Seulement celui-ci</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input name="all" id="all" type="checkbox">Tous</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input name="previous" id="previous" type="checkbox">Les précédents</label>
                                                        </div>
                                                        <div class="checkbox">
                                                            <label><input name="next" id="next" type="checkbox">Les suivants</label>
                                                        </div>
                                                        <button type="submit" class="btn btn-danger" id="confirmDelete"><i class="fa fa-trash-o"></i></button>
                                                    </div>
                                                </form>


                                            <?php endif; ?>

                                            <p><?= $evenement->contenu ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach;
                    ?>
                    </td>
                    <?php
                    if ($w == 7) {
                        echo '</tr><tr>';
                    }
                    ?>
                <?php endforeach; ?>
                <?php if ($end != 7) : ?>
                    <td colspan="<?= 7 - $end ?>"></td>
                <?php endif; ?>
                </tr>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

</div>
<!-- Modal ajout article -->
<div id="ajoutEvent" class="modal fade bs-example-modal-md" tabindex="-1" role="dialog">

    <div class="modal-dialog modal-md" role="document">

        <div class="modal-content">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <h5>Ajouter un événement</h5>
                        <form action="index.php?p=evenements.add" method="POST">
                            <input name="date_debut" id="date_debut" type="date" disabled="disabled">
                            <div class="error alert alert-danger" id="erreurTitre"></div>
                            <?= $form->input('titre', 'text', 'Titre') ?> 
                            <div class="error alert alert-danger" id="erreurTitre"></div>
                            <?= $form->input('contenu', 'textarea', 'Contenu'); ?>
                            <div class="alert alert-danger error" id="erreurH"></div>
                            <?= $form->time('debut', 'Début') ?>
                            <?= $form->time('fin', 'Fin') ?>
                            <input type="hidden" name="calendrier_id" value="<?= $calendrier->id ?>">
                            <input type="hidden" name="user_id" value="<?= $_SESSION["auth"] ?>">
                            <div class="checkbox">
                                <label><input name="journee" id="journee" type="checkbox">Journée entière</label>
                            </div>
                            <div class="checkbox">
                                <label><input name="recur" id="recur" type="checkbox">Récurrent</label>
                            </div>
                            <div class="checkbox-inline hide" id="choixQuoti">
                                <label><input name="quoti" id="quoti" type="checkbox">Quotidien</label>
                            </div>
                            <div class="checkbox-inline hide" id="choixHebdo">
                                <label><input name="hebdo" id="hebdo" type="checkbox">Hebdomadaire</label>
                            </div>

                            <div class="checkbox-inline hide" id="choixMensu">
                                <label><input name="mensu" id="mensu" type="checkbox">Mensuel</label>
                            </div>

                            <div class="checkbox-inline hide" id="choixXfois">
                                <label><input name="xfois" id="xfois" type="checkbox">x fois</label>
                            </div>

                            <div class="form-group hide" id="choixNbXfois">
                                <label for="nbXfois">Nombre de fois : </label><input name="nbXfois" id="nbXfois" type="number">
                            </div>
                            <div class="form-group hide" id="choixRecur_fin">
                                <label for="recur_fin">Fin : </label><input name="recur_fin" id="recur_fin" type="date">
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="btn btn-primary" name="ajouter" id="ajouter" value="ajouter">ajouter</button>
                        </form>
                    </div>
                    <div class="col-sm-3">

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Fin modal ajout article -->
<?php else: ?>
<button class="btn btn-primary-outline" type="button" data-toggle="collapse" href="#divAjoutCal2" name="ajoutCal2" value="ajoutCal2"><i class="fa fa-plus"></i>Créer votre calendrier</button>
<div class="collapse" id="divAjoutCal2">
    <form action="index.php?p=calendriers.add" method="POST">
        
    <?= $form->input('title', 'text', 'Nom') ?>
        <?= $form->submit('ajouter') ?>
    </form>
</div>
<?php endif; ?>
<div id="show"></div>
<script>
    /**
     $(document).ready(
     function () {
     setInterval(function () {
     var randomnumber = Math.floor(Math.random() * 100);
     $('#show').text(
     'I am getting refreshed every 3 seconds..! Random Number ==> '
     + randomnumber);
     }, 3000);
     });
     **/
</script>
<script src="../assets/js/validationEvenement.js"></script>


