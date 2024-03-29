<?php
// si pas de session commencée, on en démarre une pour pouvoir appeler la fonction est_connecte() en bas de page
// sinon message d'erreur
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once 'functions.php';
require_once 'functions' . DIRECTORY_SEPARATOR . 'auth.php';
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>
        <?php if (isset($title)) : ?>
            <?= $title; ?>
        <?php else : ?>
            Mon site
        <?php endif ?>
    </title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
        <a class="navbar-brand" href="#">Mon site</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <?= nav_menu('nav-link') ?>
            </ul>
            <ul class="navbar-nav">
                <!-- affiche le lien pour se déconnecter si l'utilisateur est connecté -->
                <?php if (est_connecte()): ?>
                    <li class="nav-item"><a href="logout.php" class="nav-link">Se déconnecter</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>

    <main role="main" class="container">