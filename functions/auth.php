<?php

// si pas de session commencée, il en démarre une, sinon il renvoie $_SESSION['connecte'] non vide
function est_connecte(): bool {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return !empty($_SESSION['connecte']);
}

// si l'utilisateur n'est pas connecté, il le renvoie vers la page de login
function forcer_utilisateur_connecte(): void {
    if (!est_connecte()) {
        header('Location: login.php');
    exit();
    }
}