<?php
$error = null;
$success = null;
$email = null;
if (!empty($_POST['email'])) {
    $email = $_POST['email'];
    // si l'email est valide
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // on crée un fichier avec la date dans le dossier emails et on insère les emails saisis
        $file = __DIR__ . DIRECTORY_SEPARATOR . 'emails' . DIRECTORY_SEPARATOR . date('Y-m-d');
        file_put_contents($file, $email . PHP_EOL, FILE_APPEND);
        $success = "Votre email a bien été enregistré";
        $email = null;
    } else {
        $error = "Email invalide";
    }
}
require 'header.php';
?>

<h1>S'inscrire à la newsletter</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Illo suscipit mo</p>

<!-- Messages de succès ou d'erreur -->
<?php if($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
<?php endif; ?>

<?php if($success): ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
<?php endif; ?>

<!-- Formulaire d'inscription à la newsletter -->
<form action="newsletter.php" method="POST" class="form-inline">
    <div class="form-group">
        <input type="email" name="email" placeholder="Entrez votre email" required class="form-control" value="<?= htmlentities($email) ?>">
    </div>
    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>

<?php require 'footer.php'; ?>