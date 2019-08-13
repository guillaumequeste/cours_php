<?php
require '../pdo_config.php';
$pdo->beginTransaction();
$pdo->exec('UPDATE posts SET name = "demo" WHERE id = 3');
$pdo->exec('UPDATE posts SET content = "demo" WHERE id = 3');
$pdo->query('SELECT * FROM posts WHERE id = 3')->fetch();

//$pdo->commit(); -> toutes les opérations entre begin et commit vont être exécutées

$pdo->rollback(); // toutes les opérations vont être annulées