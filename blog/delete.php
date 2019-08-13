<?php
require '../pdo_config.php';
$error = null;
$success = null;
$id = $pdo->quote($_GET['id']);
try {
    $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
    $success = 'Votre article a bien été supprimé'; 
} catch (PDOException $e) {
    $error = $e->getMessage();
}

require '../header.php';
?>

<div class="container">

    <p>
        <a href="/cours/blog.php">Revenir au listing</a>
    </p>

    <?php if ($success): ?>
    <div class="alert alert-success">
        <?= $success ?>
    </div>
    <?php endif ?>
    <?php if ($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php endif ?>
</div>


<?php require '../footer.php' ?>