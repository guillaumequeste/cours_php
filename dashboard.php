<?php

require_once 'functions/auth.php';
// renvoie l'utilisateur vers la page de login si celui-ci n'est pas connecté
forcer_utilisateur_connecte();

require_once 'functions/compteur.php';

// $total = nombre_vues();
$annee = (int)date('Y');
$annee_selectionnee = empty($_GET['annee']) ? $annee : (int)$_GET['annee'];
$mois_selectionne = empty($_GET['mois']) ? date('m') : $_GET['mois'];

// affiche le nombre de vues si année et mois sélectionnés
if ($annee_selectionnee && $mois_selectionne) {
    $total = nombre_vues_mois($annee_selectionnee, $mois_selectionne);
    $detail = nombre_vues_detail_mois($annee_selectionnee, $mois_selectionne);
} else {
    $total = nombre_vues();
}

$mois = [
    '01' => 'Janvier',
    '02' => 'Février',
    '03' => 'Mars',
    '04' => 'Avril',
    '05' => 'Mai',
    '06' => 'Juin',
    '07' => 'Juillet',
    '08' => 'Août',
    '09' => 'Septembre',
    '10' => 'Octobre',
    '11' => 'Novembre',
    '12' => 'Décembre'
];
require 'header.php';
?>

<div class="row">
    <div class="col-md-4">
        <div class="list-group">
            <!-- boucle pour afficher les années -->
            <?php for ($i = 0; $i < 5; $i++): ?>
            <!-- met en surbrillance l'année lorsqu'elle est sélectionnée -->
            <a class="list-group-item <?= $annee - $i === $annee_selectionnee ? 'active' : '' ?>" href="dashboard.php?annee=<?= $annee - $i ?>"><?= $annee - $i ?></a>
            <?php if ($annee - $i === $annee_selectionnee): ?>
                <div class="list-group">
                    <!-- boucle pour afficher les mois -->
                    <?php foreach ($mois as $numero => $nom): ?>
                    <!-- met en surbrillance le mois lorsqu'il est sélectionné -->
                    <a class="list-group-item <?= $numero === $mois_selectionne ? 'active' : '' ?>" href="dashboard.php?annee<?= $annee_selectionnee ?>&mois=<?= $numero ?>">
                        <?= $nom ?>
                    </a>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <?php endfor ?>
</div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-body">
                <strong style="font-size:3em;"><?= $total ?></strong><br>
                Visite<?= $total > 1 ? 's' : '' ?> totale<?= $total > 1 ? 's' : '' ?>
            </div>
        </div>
        <?php if (isset($detail)): ?>
        <h2>Détail des visites pour le mois</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Jour</th>
                    <th>Nombre de visites</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($detail as $ligne): ?>
                <tr>
                    <td><?= $ligne['jour'] ?></td>
                    <td><?= $ligne['visites'] ?> visite<?= $ligne['visites'] > 1 ? 's' : '' ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>



<?php require 'header.php'; ?>