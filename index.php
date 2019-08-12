<?php
/* pour afficher les erreurs
echo 'Loaded php.ini: ' . php_ini_loaded_file(); */

/* permet de voir les infos sur notre configuration php
phpinfo();
die(); */

// on démarre une session
session_start();
// j'ajoute un rôle dans le tableau session : $_SESSION['role'] = 'administrateur';
// j'enlève le rôle dans le tableau session : unset($_SESSION['role']);

$title = "Page d'accueil";
require 'header.php';
?>

<!--
<pre>
    <?php
    print_r($_SERVER);
    ?>
</pre>
-->

<div class="starter-template">
    <h1>Bootstrap starter template</h1>
    <p class="lead">fsjfb ljhbf ljb lj<br />dczczczcze</p>
</div>

<?php require 'footer.php'; ?>