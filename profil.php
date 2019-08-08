<?php
$nom = null;
// si action existe et est égale à 'deconnecter'
if (!empty($_GET['action']) && $_GET['action'] === 'deconnecter') {
    // j'enlève 'utilisateur' du tableau cookie
    unset($_COOKIE['utilisateur']);
    // je mets une date antérieure afin de supprimer le cookies
    setcookie('utilisateur', '', time() - 10);
}
// si la valeur utilisateur existe dans le tableau cookie, je l'affecte à la variable $nom
if (!empty($_COOKIE['utilisateur'])) {
    $nom = $_COOKIE['utilisateur'];
}
// si une valeur a été saisie, je l'insère dans le cookie
if (!empty($_POST['nom'])) {
    setcookie('utilisateur', $_POST['nom']);
    $nom = $_POST['nom'];
}
require 'header.php';
?>

<?php if($nom): ?>
    <h1>Bonjour <?= htmlentities($nom) ?></h1>
    <a href="profil.php?action=deconnecter">Se déconnecter</a>
<?php else: ?>
    <form action="" method="POST">
        <div class="form-group">
            <input class="form-control" name="nom" placeholder="Entrez votre nom">
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
</form><?php endif; ?>

<?php require 'footer.php'; ?>

<!-- Pour sauvegarder des informations plus complexes (un tableau clés => valeurs par exemple)
    $user = [
        'prenom' => 'John',
        'nom' => 'Doe',
        'age' => 18
    ];
    setcookie('utilisateur', serialize($user));
    La fonction serialize transforme le tableau clés => valeurs en une chaîne de caractères.
    La fonction unserialize fait l'inverse. -->