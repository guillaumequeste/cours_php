<?php
// ajoute 1 au nombre contenu dans le fichier compteur et crée le fichier compteur du jour
function ajouter_vue(): void {
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    $fichier_journalier = $fichier . '-' . date('Y-m-d');
    incrementer_compteur($fichier);
    incrementer_compteur($fichier_journalier);
}

// incrémente le compteur et met le nombre dans le fichier compteur
function incrementer_compteur(string $fichier): void {
    $compteur = 1;
    if (file_exists($fichier)) {
        $compteur = (int)file_get_contents($fichier);
        $compteur++;
    }
    file_put_contents($fichier, $compteur);
}

// affiche le nombre contenu dans le fichier compteur du jour
function nombre_vues(): string {
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur';
    return file_get_contents($fichier);
}

// compte le nombre de vues par mois
function nombre_vues_mois(int $annee, int $mois): int {
    // rajoute un zéro à gauche pour les mois à 1 chiffre (ex: janvier - 1 => 01)
    $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
    // on récupère le chemin des fichiers
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $annee . '-' . $mois . '-' . '*';
    // recherche tous les fichiers d'un mois (tous les jours d'un mois)
    $fichiers = glob($fichier);
    $total = 0;
    // additionne les vues de chaque fichier trouvé auparavant
    foreach ($fichiers as $fichier) {
        $total += (int)file_get_contents($fichier);
    }
    return $total;
}

// détails concernant le nombre de vues par mois (nombre de vues par jour)
function nombre_vues_detail_mois(int $annee, int $mois): array {
    // rajoute un zéro à gauche pour les mois à 1 chiffre (ex: janvier - 1 => 01)
    $mois = str_pad($mois, 2, '0', STR_PAD_LEFT);
    // on récupère le chemin des fichiers
    $fichier = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'compteur-' . $annee . '-' . $mois . '-' . '*';
    // recherche tous les fichiers d'un mois (tous les jours d'un mois)
    $fichiers = glob($fichier);
    $visites = [];
    // additionne les vues de chaque fichier trouvé auparavant
    foreach ($fichiers as $fichier) {
        $parties = explode('-', basename($fichier));
        $visites[] = [
            'annee' => $parties[1],
            'mois' => $parties[2],
            'jour' => $parties[3],
            'visites' => file_get_contents($fichier)
        ];
    }
    return $visites;
}