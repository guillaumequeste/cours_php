<?php

// j'utilise la classe Message dans le namespace Gui\Guestbook
use \Gui\Guestbook\Message;

require_once 'class/Message.php';
require_once 'class/GuestBook.php';
$errors = null;
$success = false;
$guestbook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'messages');
// si le message est valide, on l'ajoute dans le fichier messages
// normalement, on utilise une base de données ppour gérer ce genre de choses
if (isset($_POST['username'], $_POST['message'])) {
    $message = new Message($_POST['username'], $_POST['message']);
    if ($message->isValid()) {
        $guestbook->addMessage($message);
        $success = true;
        $_POST = [];
    } else {
        $errors = $message->getErrors();
    }
}
// récupère les messages
$messages = $guestbook->getMessages();
$title = "Livre d'or";
require 'header.php';
?>

<div class="container">
    <h1>Livre d'or</h1>

    <!-- message d'erreur suite à la validation du formulaire -->
    <?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        Formulaire invalide
    </div>
    <?php endif; ?>

    <!-- message de succès suite à la validation du formulaire -->
    <?php if($success): ?>
    <div class="alert alert-success">
        Merci pour votre message
    </div>
    <?php endif; ?>

    <!-- formulaire pour enregistrer un message -->
    <form action="" method="POST">
        <div class="form-group">
            <!-- le crochet et la parenthèse en rouge indiquent une erreur, ce qui empêche le message d'erreur pour les messages de s'afficher -->
            <!-- pour pouvoir afficher le message d'erreur il faut ajouter une classe bootstrap -->
            <input value="<?= htmlentities($_POST['username'] ?? '') ?>" type="text" name="username" placeholder="Votre pseudo" class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>">
            <?php if (isset($errors['username'])): ?>
            <div class="invalid-feedback">
                <?= $errors['username']; ?>
            </div>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <textarea name="message" placeholder="Votre message" class="form-control <?= isset($errors['message']) ? 'is-invalid' : '' ?>"><?= htmlentities($_POST['message'] ?? '') ?></textarea>
        </div>
        <?php if (isset($errors['message'])): ?>
            <div class="invalid-feedback">
                <?= $errors['message']; ?>
            </div>
            <?php endif; ?>
        <button type="submit" class="btn btn-primary">Envoyer</button>
    </form>

    <!-- affichage des messages -->
    <?php if (!empty($messages)): ?>
    <h1 class="mt-4">Vos messages</h1>

    <?php foreach ($messages as $message): ?>
    <?= $message->toHTML() ?>
    <?php endforeach ?>

    <?php endif ?>
   
</div>

<?php require 'footer.php'; ?>