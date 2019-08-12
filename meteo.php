<?php
require_once 'class/OpenWeather.php';
$weather = new OpenWeather('51fc8505d55fe845e4c757ea6b9ff0cf');
$forecast = $weather->getForecast('Dieppe,fr');
require 'header.php';
?>

<div class="container">
    <p>Le <?= $forecast[0]['date']->format('d/m/Y') ?> : <?= $forecast[0]['temp'] ?> °C - <?= $forecast[0]['description'] ?></p>
    <ul>
        <?php foreach ($forecast as $threeHour): ?>
        <li><?= $threeHour['date']->format('d/m/Y') ?>, <?= $threeHour['description'] ?>, <?= $threeHour['temp'] ?> °C - <em>date</em> : <?= $threeHour['date2'] ?></li>
        <?php endforeach ?>
    </ul>
</div>

<?php require 'footer.php'; ?>