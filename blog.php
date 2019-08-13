<?php
require_once 'class/Post.php';
//new PDO(dbname, login, mots de passe, options)
$pdo = new PDO('sqlite:blog/data.db', null, null, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    // dès que tu récupères les enregistrements, je veux que tu les récupères sous forme d'objets
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
$error = null;
try {
    if (isset($_POST['name'], $_POST['content'])) {
        $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('Location: /cours/blog/edit.php?id=' . $pdo->lastInsertId());
    }
    $query = $pdo->query('SELECT * FROM posts');
    /** @var Post[] */
    $posts = $query->fetchAll(PDO::FETCH_CLASS, 'Post');
} catch (PDOException $e) {
    $error = $e->getMessage();
}

require 'header.php';
?>

<!-- SQLite: 
    créer un fichier data.db
    télécharger DB Browser for SQLite
    ouvrir une base de données -> chercher le fichier data.db
    -> créer une table posts
        -> id : integer, clé primaire, autoincrement
        -> name : text
        -> content : text
        -> created_at : integer
    -> enregistrer les modifications
    -> Parcourir les données -> nouvel enregistrement
        name : Article de test, content : Contenu de test, created_at : 0
    -> enregistrer les modifications -->

<div class="container">
    <?php if ($error): ?>
    <div class="alert alert-danger">
        <?= $error ?>
    </div>
    <?php else: ?>
    <ul>
        <?php foreach ($posts as $post): ?>
        <h2><a href="blog/edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name) ?></a></h2>
        <p class="small text-muted">
            Ecrit le <?= $post->created_at->format('d/m/Y à H:i') ?>
        </p>
        <p>
            <?= nl2br(htmlentities($post->getExcerpt())) ?>
        </p>
        <?php endforeach ?>
    </ul>

    <form action="" method="POST">
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="name">
        </div>
        <div class="form-group">
            <textarea class="form-control" name="content"></textarea>
        </div>
        <button class="btn btn-primary">Sauvegarder</button>
    </form>
    <?php endif ?>
</div>

<?php require 'footer.php' ?>