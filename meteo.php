<?php
require_once 'class/OpenWeather.php';
$error = null;
try { // j'essaie d'exécuter la requête
    $weather = new OpenWeather('51fc8505d55fe845e4c757ea6b9ff0cf');
    $forecast = $weather->getForecast('Dieppe,fr');
} catch (Exception $e) {
    $error = $e->getMessage();
} // finally {...} : le code à exécuter quoi qu'il arrive

/* catch (APIException $e) { // si je n'arrive pas à exécuter la requête, j'attrape le message d'erreur en utilisant la classe APIException que j'ai créée
    $error = 'Erreur API';
    // $error = $e->getMessage();
} catch (Exception $e) { // si je n'arrive pas à exécuter la requête, j'attrape le message d'erreur
    $error = 'Erreur classique';
    // $error = $e->getMessage();
} */

require 'header.php';
?>

<!-- si j'ai une erreur, je l'affiche -->
<?php if ($error): ?>
<div class="alert alert-danger"><?= $error ?></div>
<!-- sinon j'affiche les données -->
<?php else: ?>
<div class="container">
    <p>Le <?= $forecast[0]['date']->format('d/m/Y') ?> : <?= $forecast[0]['temp'] ?> °C - <?= $forecast[0]['description'] ?></p>
    <ul>
        <?php foreach ($forecast as $threeHour): ?>
        <li><?= $threeHour['date']->format('d/m/Y') ?>, <?= $threeHour['description'] ?>, <?= $threeHour['temp'] ?> °C - <em>date</em> : <?= $threeHour['date2'] ?></li>
        <?php endforeach ?>
    </ul>
</div>
<?php endif ?>

<?php require 'footer.php'; ?>