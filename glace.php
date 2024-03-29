<?php
require_once 'functions.php';

// Checkbox
$parfums = [
    "Fraise" => 4,
    "Chocolat" => 5,
    "Vanille" => 3
];
// Radio
$cornets = [
    "Pot" => 2,
    "Cornet" => 3
];
// Checkbox
$supplements = [
    "Pépites de chocolat" => 1,
    "Chantilly" => 0.5
];

$title = "Composez votre glace";
$ingredients = [];
$total = 0;

// Composition de la glace
if (isset($_GET['parfum'])) {
    foreach($_GET['parfum'] as $parfum) {
        if (isset($parfums[$parfum])) {
            $ingredients[] = $parfum;
            $total += $parfums[$parfum];
        }
    }
}
if (isset($_GET['supplement'])) {
    foreach($_GET['supplement'] as $supplement) {
        if (isset($supplements[$supplement])) {
            $ingredients[] = $supplement;
            $total += $supplements[$supplement];
        }
    }
}
if (isset($_GET['cornet'])) {
    $cornet = $_GET['cornet'];
    if (isset($cornets[$cornet])) {
        $ingredients[] = $cornet;
        $total += $cornets[$cornet];
    }   
}

/* Composition de la glace 2ème méthode
foreach(['parfum', 'supplement'] as $name) {
    if (isset($_GET[$name])) {
        $liste = $name . 's';
        foreach($_GET[$name] as $value) {
            if (isset($$liste[$value])) {
                $ingredients[] = $value;
                $total += $$liste[$value];
            }
        }
    }
}
if (isset($_GET['cornet'])) {
    $cornet = $_GET['cornet'];
    if (isset($cornets[$cornet])) {
        $ingredients[] = $cornet;
        $total += $cornets[$cornet];
    }   
}
*/

/* Composition de la glace 3ème méthode*/
foreach(['parfum', 'supplement', 'cornet'] as $name) {
    if (isset($_GET[$name])) {
        $liste = $name . 's';
        $choix = $_GET['name'];
        if (is_array($choix)) {
            foreach($choix as $value) {
                if (isset($$liste[$value])) {
                    $ingredients[] = $value;
                    $total += $$liste[$value];
                }
            }
        } else {
            if (isset($$liste[$choix])) {
                $ingredients[] = $choix;
                $total += $$liste[$choix];
            } 
        }
        
    }
}

require 'header.php';
?>

<h1>Composez votre glace</h1>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Votre glace</h5>
                <ul>
                    <?php foreach($ingredients as $ingredient): ?>
                    <li><?= $ingredient ?></li>
                    <?php endforeach ?>
                </ul>
                <p>
                    <strong>Prix: </strong> <?= $total ?> €
                </p>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <form action="glace.php" method="GET">
            <h2>Choisissez vos parfums</h2>
            <?php foreach ($parfums as $parfum => $prix): ?>
            <div class="checkbox">
                <label>
                    <?= checkbox('parfum', $parfum, $_GET) ?>
                    <?= $parfum ?> - <?= $prix ?> €
                </label>
            </div>
            <?php endforeach ?>

            <h2>Choisissez votre cornet</h2>
            <?php foreach ($cornets as $cornet => $prix): ?>
            <div class="checkbox">
                <label>
                    <?= radio('cornet', $cornet, $_GET) ?>
                    <?= $cornet ?> - <?= $prix ?> €
                </label>
            </div>
            <?php endforeach ?>

            <h2>Choisissez vos suppléments</h2>
            <?php foreach ($supplements as $supplement => $prix): ?>
            <div class="checkbox">
                <label>
                    <?= checkbox('supplement', $supplement, $_GET) ?>
                    <?= $supplement ?> - <?= $prix ?> €
                </label>
            </div>
            <?php endforeach ?>

            <button type="submit" class="btn btn-primary">Composez ma glace</button>
        </form>
    </div>
</div>



<pre>
<h2>$_GET</h2>
<?php
    var_dump($_GET);
?>
</pre>

<pre>
<h2>$_POST</h2>
<?php
    var_dump($_POST);
?>
</pre>

<?php require 'footer.php' ?>