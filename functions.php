<?php
function nav_item(string $lien, string $titre, string $linkClass = ''): string
{
    $classe = 'nav-item';
    if ($_SERVER['SCRIPT_NAME'] === $lien) {
        $classe .= ' active';
    }
    // heredoc <<<HTML ... HTML;
    return <<<HTML
    <li class="$classe">
        <a class="$linkClass" href="$lien">$titre</a>
    </li>
HTML;
}

function nav_menu(string $linkClass = ''): string
{
    return
    nav_item('/cours/index.php', 'Accueil', $linkClass) . 
    nav_item('/cours/contact.php', 'Contact', $linkClass);
}

function checkbox(string $name, string $value, array $data): string
{
    $attributes = '';
    if (isset($data[$name]) && in_array($value, $data[$name])) {
        $attributes .= 'checked';
    }
    return <<<HTML
    <input type="checkbox" name="{$name}[]" value="$value" $attributes>
HTML;
}

function radio(string $name, string $value, array $data): string
{
    $attributes = '';
    if (isset($data[$name]) && $value === $data[$name]) {
        $attributes .= 'checked';
    }
    return <<<HTML
    <input type="radio" name="{$name}" value="$value" $attributes>
HTML;
}

// fonction pour afficher les données (ex: <?php dump($parfum))
function dump($ariable) {
    echo '<pre'>
    var_dump($variable);
    echo '</pre>';
}