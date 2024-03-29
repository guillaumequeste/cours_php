<?php

// met en surbrillance le lien sur lequel l'utilisateur a cliqué
function nav_item(string $lien, string $titre, string $linkClass = ''): string
{
    $classe = 'nav-item';
    if ($_SERVER['SCRIPT_NAME'] === $lien) {
        $classe .= ' active';
    }
    // heredoc <<<HTML ... HTML; permet de ne pas tout mettre entre guillemets
    return <<<HTML
    <li class="$classe">
        <a class="$linkClass" href="$lien">$titre</a>
    </li>
HTML;
}

// détermine le lien, fait référence à nav_item pour mettre le lien en surbrillance
function nav_menu(string $linkClass = ''): string
{
    return
    nav_item('/index.php', 'Accueil', $linkClass) . 
    nav_item('/jeu.php', 'Jeu', $linkClass) . 
    nav_item('/glace.php', 'Glace', $linkClass) . 
    nav_item('/pizzas.php', 'Pizzas', $linkClass) . 
    nav_item('/newsletter.php', 'Newsletter', $linkClass) . 
    nav_item('/profil.php', 'Profil', $linkClass) . 
    nav_item('/prive.php', 'Privé', $linkClass) . 
    nav_item('/dashboard.php', 'Dashboard', $linkClass) . 
    nav_item('/login.php', 'Login', $linkClass) . 
    nav_item('/contact.php', 'Contact', $linkClass) . 
    nav_item('/livre.php', 'Livre d\'or', $linkClass) .
    nav_item('/meteo.php', 'Météo', $linkClass) .
    nav_item('/blog.php', 'Blog', $linkClass);
}

// garde la cache cochée après la soumission du formulaire
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

// garde le bouton coché après la soumission du formulaire
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

// garde les informations choisies après la soumission du formulaire
function select(string $name, $value, array $options): string
{
    $html_options = [];
    foreach($options as $k => $option) {
        $attributes = $k == $value ? 'selected' : '';
        $html_options[] = "<option value='$k' $attributes>$option</option>";
    }
    return "<select class='form-control' name='$name'>" . implode($html_options) . '</select>';
}

// fonction pour afficher les données (ex: <?php dump($parfum))
function dump($variable) {
    echo '<pre'>
    var_dump($variable);
    echo '</pre>';
}

// affiche les horaires d'ouverture
function creneaux_html(array $creneaux) {
    if (empty($creneaux)) {
        return 'Fermé';
    }
    /* autre possibilité :
    if (count($creneaux) === 0) {
        return 'Fermé';
    } */
    $phrases = [];
    foreach ($creneaux as $creneau) {
        $phrases[] = "de <strong>{$creneau[0]}h</strong> à <strong>{$creneau[1]}h</strong>";
    }
    return 'Ouvert ' . implode(' et ', $phrases);
}

// retourne vrai si l'heure se trouve dans les heures d'ouverture, sinon faux
function in_creneaux(int $heure, array $creneaux): bool
{
    foreach ($creneaux as $creneau) {
        $debut = $creneau[0];
        $fin = $creneau[1];
        if ($heure >= $debut && $heure < $fin) {
            return true;
        }
    }
    return false;
}