<?php
// démarre une session, détruit ce qu'il y a dans $_SESSION['connecte'] et redirige vers l'accueil
session_start();
unset($_SESSION['connecte']);
header('Location: /cours/index.php');