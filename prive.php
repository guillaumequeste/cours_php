<?php

$age = null;

// On définit d'abord le cookie
// si une valeur a été saisie, on l'insère dans un cookie
if (!empty($_POST['birthday'])) {
    setcookie('birthday', $_POST['birthday']);
    /* je force le cookie à intégrer la valeur saisie sinon le cookie existe seulement pour la requête suivante
        et dans ce cas il faut changer de page et revenir pour que le cookie soit actif */
    $_COOKIE['birthday'] = $_POST['birthday'];
}

// si la valeur birthday existe dans le cookie, je calcule l'âge
if (!empty($_COOKIE['birthday'])) {
    $birthday = (int)$_COOKIE['birthday'];
    $age = (int)date('Y') - $birthday;
}

require 'header.php';
?>

<?php if($age >= 18): ?>
    <h1>Du contenu réservé aux adultes</h1>
<?php elseif ($age !== null): ?>
    <div class="alert alert-danger">Vous n'avez pas l'âge requis.</div>
<?php else: ?>
<form action="" method="POST">
    <div class="form-group">
        <label for="birthday">Section réservée aux personnes majeures, entrez votre année de naissance :</label>
        <select name="birthday" id="birthday" class="form-control">
            <?php for($i=2010; $i > 1919; $i--): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
            <?php endfor ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer</button>
</form>
<?php endif ?>

<?php require 'footer.php' ?>