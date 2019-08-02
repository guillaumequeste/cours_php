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
?>