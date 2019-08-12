<?php
require 'header.php';

/* 4 fonctions essentielles de curl :
    - curl_init() : initialiser
    - curl_exec() : exécuter
    - curl_error() : récupérer l'erreur
    - curl_close() : fermer
*/
$curl = curl_init('http://api.openweathermap.org/data/2.5/weather?q=Dieppe,fr&units=metric&lang=fr&appid=51fc8505d55fe845e4c757ea6b9ff0cf');

// Attention : curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); -> ne vérifie pas les connexions SSL

/* on télécharge le certificat 'cert.cer' et on fait la vérification
    cliquer sur le cadenas à gauche de l'url
    cliquer sur 'certificat'
    cliquer sur le lien racine
    glisser-déposer l'image du certificat, on a un fichier .cer
string(77) "error setting certificate verify locations: CAfile: cert.cer CApath: none"
voir readme.txt */
// curl_setopt($curl, CURLOPT_CAINFO, __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer');

// le résultat est sauvegardé dans la variable $data :
// curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// on regroupe les curl_setopt dans un tableau :
curl_setopt_array($curl, [
    // CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'cert.cer',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT_MS => 1000 // si au bout d'1 seconde tu n'as pas trouvé tu arrêtes
]);

$data = curl_exec($curl);
// si $data === false, on a rencontré une erreur
if ($data === false) {
    var_dump(curl_error($curl));
} else {
    // si le statut code = 200, le résultat est correct, on peut continuer
    if (curl_getinfo($curl, CURLINFO_HTTP_CODE) === 200) {
        $data = json_decode($data, true);
        echo 'Il fait ' . $data['main']['temp'] . '°C';
    }
}
// ferme la session curl et libère la mémoire qui lui était associée
curl_close($curl);

?>

<?php require 'footer.php'; ?>