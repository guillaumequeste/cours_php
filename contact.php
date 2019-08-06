<?php
$title = "Nous contacter";
require_once 'config.php';
require_once 'functions.php';

// Définir le bon fuseau horaire
date_default_timezone_set('Europe/Paris');
// Récupérer l'heure d'aujourd'hui (heure saisie si vide heure actuelle)
$heure = (int)($_GET['heure'] ?? date('G'));
// Récupérer le jour (jour saisi si vide on récupère le jour)
$jour = (int)($_GET['jour'] ?? date('N') - 1);
// Récupérer les créneaux d'aujourd'hui
$creneaux = CRENEAUX[$jour];
// Vérifier si le magasin est ouvert
$ouvert = in_creneaux($heure, $creneaux);

// couleur si ouvert = vert, si fermé = rouge
$color = $ouvert ? 'green' : 'red';

require 'header.php';
?>

<div class="row">
    <div class="col-md-8">
        <h2>Nous contacter</h2>
        <p>Ceci est un paragraphe.</p>
    </div>
    <div class="col-md-4">
        <h2>Horaires d'ouverture :</h2>

        <!-- message indiquant si le magasin est ouvert -->
        <?php if($ouvert): ?>
        <div class="alert alert-success">
            Le magasin sera ouvert
        </div>
        <?php else: ?>
        <div class="alert alert-danger">
            Le magasin sera fermé
        </div>
        <?php endif ?>

        <!-- formulaire pour déterminer si le magasin est ouvert -->
        <form action="" method="GET">
            <div class="form-group">
                <?= select('jour', $jour, JOURS) ?>

                <!-- <select class="form-control" name="jour">
                    <?php foreach (JOURS as $k => $jour): ?>
                    <option value="<?= $k ?>"><?= $jour ?></option>
                    <?php endforeach ?>
                </select> -->

            </div>
            <div class="form-group">
                <input class="form-control" type="number" name="heure" value="<?= $heure ?>">
            </div>
            <button class="btn btn-primary" type="submit">Voir si le magasin est ouvert</button>
        </form>

        <!-- afficher la date -->
        <!-- <?= date('l d F Y') ?> -->

        <ul>
            <!-- afficher les horaires d'ouverture du magasin -->
            <?php foreach(JOURS as $k => $jour): ?>
                <!-- afficher le texte en couleur en fonction de la date et l'heure -->
                <!-- <li <?php if ($k + 1 === (int)date('N')): ?> style="color:<?= $color ?>" <?php endif ?>> -->
                <li>
                    <strong><?= $jour ?></strong> :
                    <?= creneaux_html(CRENEAUX[$k]) ?>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</div>


<?php require 'footer.php'; ?>