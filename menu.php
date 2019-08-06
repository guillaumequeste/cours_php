<!-- menu comme son nom l'indique -->

<?php

if (!function_exists('nav_item')) {
    function nav_item(string $lien, string $titre, string $linkClass = ''): string {
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
// revenir à en début de ligne
        /* équivalent :
            return '<li class="' . $classe . '">
                        <a class="nav-link" href="' . $lien . '">
                    </li>'
        */
    }
}


?>

<?= nav_item('/cours/index.php', 'Accueil', $class); ?>
<?= nav_item('/cours/contact.php', 'Contact', $class); ?>