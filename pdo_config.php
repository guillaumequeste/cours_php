<?php
//new PDO(dbname, login, mots de passe, options)
$pdo = new PDO('sqlite:data.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // dès que tu récupères les enregistrements, je veux que tu les récupères sous forme d'objets
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);