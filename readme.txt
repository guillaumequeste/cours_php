permet de voir les infos sur notre configuration php :
phpinfo();
die();
Loaded configuration file : fichier de configuration chargé
  -> display_errors = On
  (pour afficher les erreurs)

require_once '../functions.php' -----> require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';

Afficher les erreurs :
php -S localhost:8888 -d error_reporting=E_ALL

utile pour organiser le code (par ex, tout mettre en private au départ et modifier si besoin):
public : accesssible à l'intérieur et depuis l'extérieur
private : accessible uniquement au sein de la classe
protected : accessible dans la classe et dans les classes enfants
La fonction __construct est toujours public.

Erreur certificat :
string(77) "error setting certificate verify locations: CAfile: cert.cer CApath: none"
 - Download the latest cacert.pem from https://curl.haxx.se/ca/cacert.pem
   Add the following line to php.ini:
   curl.cainfo="/path/to/downloaded/cacert.pem"
- I had the same issue.
  The solution provided by @pan-christensen did not work for me.
  The website on which I was requesting in HTTPS was apparently using a custom(?) SSL certificate.
  So, I opened the certificates in chrome and exported all (3) certificates I could: see screenshot
  and added them to a custom mycertfile.pem
  Then using it with Guzzle this way:
  $client = new Client(['verify' => '/my/path/to/mycertfile.pem']);
  Now it's working!
  You can also download a certificate with the openssl command, but I my case it wasn't the right
  certificate. So I had to download them manually.

  Autoloader:
  - composer.org/download
  - dans le terminal, dans le dossier : php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  - l'option opsenssl doit être activée (voir page phpinfo)
    si elle n'est pas activée -> fichier de configuration de php (php.ini)
    -> décommenter extension=openssl (enlever le ; devant) (pour windows)
    -> sauvegarder le fichier en tant qu'administrateur
    -> réexécuter la ligne de code
  - un fichier composer-setup.php a été créé
  - dans le terminal : php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
    -> installer verified
  - dans le terminal : php composer-setup.php
    -> création d'un fichier composer.phar
  - dans le terminal : php -r "unlink('composer-setup.php');"
    -> supprime le fichier composer-setup.php
  - on va utiliser le fichier composer.phar pour générer l'autoloader et plus tard télécharger des librairies
  - dans le terminal : php composer.phar
    -> il nous affiche les options disponibles
  - dans le terminal : php composer.phar init
    -> package name : gui/site
    -> descriptio: ...
    -> author : ...
    -> minimum stability : ...
    -> package type : ...
    -> license : ...
    -> Would you like to define your dependencies (require) interactively [yes]? no
    -> Would you like to define your dev dependencies (require-dev) interactively [yes]? no
    -> Do you confirm generation [yes]? yes
    -> ould you like the vendor directory added to your .gitignore [yes]? (oui ou non)
  - un fichier composer.json a été créé
  - "autoload": {
        "psr-4": {
            "Gui\\": "class/"
        }
    },
    -> on lui dit que Gui\ correspond au dossier class
  - dans le terminal : php composer.phar dump-autoload
    -> crée un fichier autoload.php dans un dossier vendor
  - dans le fichier livre.php, on fait : require 'vendor/autoload.php'
    -> php va essayer dynamiquement de chercher où se trouve la classe désirée et de l'importer
    -> attention, pour que ça marche, il faut bien mettre le namespace au début de chaque classe
      ex : Message.php -> namespace Gui\Guestbook;
           GuestBook.php -> namespace Gui\Guestbook;
  - plugin PHP namespace resolver -> clic droit sur la classe -> import class

  Résumé autoloader :
  1 - générer le fichier autoload.php
  2 - indiquer dans la classe le namespace qui correcpond au chemin du fichier
  3 - dans le fichier index.php, par exemple, require autoload.php et use le chemin vers la classe

  Librairies tierces :
  - composer require nom de la librairie -> dans le dossier vendor, nouveau dossier avec la librairie (packagist.org)
  - lorsqu'on télécharge un projet et qu'on n'a pas le dossier vendor -> composer install
      -> require dans le fichier autoload.php
  - on utilise la librairie selon la documentation (dépôt github)