<?php
$aDeviner = 150;
$erreur = null;
$succes = null;
$value = null;

if (isset($_POST['chiffre'])) {
    $value = (int)$_POST['chiffre'];
    if ($value > $aDeviner) {
        $erreur = "Votre chiffre est trop grand";
    } elseif ($value < $aDeviner) {
        $erreur = "Votre chiffre est trop petit";
    } else {
        $succes = "Bravo ! Vous avez deviné le chiffre <strong>$aDeviner</strong>";
    }
}

require 'header.php';
?>

<!-- messages -->
<?php if ($erreur): ?>
<div class="alert alert-danger">
    <?= $erreur ?>
</div>
<?php elseif ($succes): ?>
<div class="alert alert-success">
    <?= $succes ?>
</div>
<?php endif ?>

<!-- formulaire du jeu -->
<form action="jeu.php" method="POST">
    <div class="form-group">
        <input type="number" name="chiffre" class="form-control" placeholder="entre 0 et 1000" value="<?= $value ?>">
    </div>
    <button type="submit" class="btn btn-primary">Deviner</button>
</form>

<pre>
<h2>$_GET</h2>
<?php
    var_dump($_GET);
?>
</pre>

<pre>
<h2>$_POST</h2>
<?php
    var_dump($_POST);
?>
</pre>

<?php require 'footer.php' ?>