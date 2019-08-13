<?php
require '../pdo_config.php';
$error = null;
$success = null;
$id = $pdo->quote($_GET['id']);
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('UPDATE posts SET name = :name, content = :content WHERE id = :id');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'id' => $_GET['id']
        ]);
        $success = 'Votre article a bien été modifié';
    }
    $query = $pdo->prepare('SELECT * FROM posts WHERE id = :id');
    $query->execute([
        'id' => $_GET['id']
    ]);
    $post = $query->fetch();
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
    <?php else: ?>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="name" value="<?= htmlentities($post->name) ?>">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="content"><?= htmlentities($post->content) ?></textarea>
        </div>
        <button class="btn btn-primary">Sauvegarder</button>
    </form>
    <p>
        <a href="/cours/blog/delete.php?id=<?= $post->id ?>">Supprimer</a>
    </p>
    <?php endif ?>
</div>


<?php require '../footer.php' ?>