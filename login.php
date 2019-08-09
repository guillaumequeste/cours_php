<?php
$erreur = null;
// password_hash('Doe', PASSWORD_DEFAULT, ['cost' => 12])
$password = '$2y$12$VmlWOtO1SDl03QfXmohpy.9ekLB0AgEVe.miqqvyuRHK4V/GrPN.m';
// vérifie que les identifiants sont corrects, démarre une session, met la valeur 1 à $_SESSION['connecte']
// et redirige l'utilisateur vers le dashboard, sinon message d'erreur
if (!empty($_POST['pseudo']) && !empty($_POST['motdepasse'])) {
    if ($_POST['pseudo'] === 'John' && password_verify($_POST['motdepasse'], $password)) {
        session_start();
        $_SESSION['connecte'] = 1;
        header('Location: dashboard.php');
    } else {
        $erreur = "Identifiants incorrects";
    }
}

require_once 'functions/auth.php';
// si l'utilisateur est déjà connecté, il le redirige vers le dashboard
if (est_connecte()) {
    header('Location: dashboard.php');
    exit();
}

require 'header.php';
?>

<!-- message d'erreur si identifiants incorrects -->
<?php if ($erreur): ?>
    <div class="alert alert-danger">
        <?= $erreur ?>
    </div>
<?php endif; ?>

<!-- formulaire de connexion -->
<form action="" method="POST">
    <div class="form-group">
        <input type="text" class="form-control" name="pseudo" placeholder="Nom d'utilisateur">
    </div>
    <div class="form-group">
        <input type="password" class="form-control" name="motdepasse" placeholder="Votre mot de passe">
    </div>
    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<?php require 'footer.php'; ?>