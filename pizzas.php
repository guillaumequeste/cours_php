<?php
require_once 'functions.php';
$title = "Notre menu";
// On lit toutes les lignes du fichier 'pizzas.csv' situé dans le dossier data
$lignes = file(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'pizzas.csv');
// On fait une boucle pour lire ligne par ligne
foreach($lignes as $k => $ligne) {
    $lignes[$k] = explode("&", $ligne);
}
require 'header.php';
?>

<h1>Menu</h1>

<?php foreach ($lignes as $ligne): ?>
    <?php if (count($ligne) === 1): ?>
        <h2><?= $ligne[0] ?></h2>
    <?php else: ?>
        <div class="row">
            <div class="col-sm-8">
                <p>
                    <strong><?= $ligne[0]; ?></strong><br>
                    <?= $ligne[1]; ?>
                </p>
            </div>
            <div class="col-sm-4">
                <strong><?= number_format($ligne[2], 2, ',', ' '); ?> €</strong>
            </div>
        </div>
    <?php endif; ?>
<?php endforeach; ?>

<?php require 'footer.php'; ?>