<?php
require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Creneau.php';
$creneau = new Creneau(9, 12);
$creneau2 = new Creneau(14, 16);
/*var_dump(
    $creneau->inclutHeure(10),
    $creneau2->inclutHeure(10),
    $creneau->intersect($creneau2)
);*/
echo $creneau->toHTML();