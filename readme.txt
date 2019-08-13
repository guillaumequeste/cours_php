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