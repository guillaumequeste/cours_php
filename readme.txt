require_once '../functions.php' -----> require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'functions.php';

Afficher les erreurs :
php -S localhost:8888 -d error_reporting=E_ALL

utile pour organiser le code (par ex, tout mettre en private au départ et modifier si besoin):
public : accesssible à l'intérieur et depuis l'extérieur
private : accessible uniquement au sein de la classe
protected : accessible dans la classe et dans les classes enfants
La fonction __construct est toujours public.