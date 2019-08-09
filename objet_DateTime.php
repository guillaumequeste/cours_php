<?php
$date = '2014-01-01';
$date2 = '2019-04-01';

$d = new DateTime($date);
$d2 = new DateTime($date2);
// true : valeur absolue
$diff = $d->diff($d2, true);
echo "Il y a {$diff->y} années, {$diff->m} mois et {$diff->d} jours de différence";

// Sans les objets :
$time = strtotime($date);
$time2 = strtotime($date2);
$days = floor(abs(($time - $time2) / (24 * 60 * 60)));
echo "Il y a $days jours de différence";

// On ajoute un intervalle
$date3 = new DateTime('2019-01-01');
// P : périod, j'ajoute 1 mois, 1 jour, T : time, j'ajoute 1 minute
$interval = new DateInterval('P1M1DT1M');
$date3->add($interval);
var_dump($date3);