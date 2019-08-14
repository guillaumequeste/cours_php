<?php

// je range la classe Message dans le namespace Gui\Guestbook
namespace Gui\Guestbook;

// je veux utiliser la classe DateTime qui se situe dans le dossier racine
// si on ne met pas ça, il cherche la classe DateTime dans le namespace Gui\Guestbook
use \DateTime;
use \DateTimeZone;

/* je peux utiliser plusieurs classes situées dans un namespace :
    use Gui\Guestbook\ {
        Guestbook,
        Message
    } */

// je veux utiliser la classe Message située dans le namespace Gui\Contact :
// use Gui\Contact\Message as ContactMessage;
// j'utilise un alias et je peux ensuite appeler la classe :
// $demo = new ContactMessage;

class Message {

    const LIMIT_USERNAME = 3;
    const LIMIT_MESSAGE = 10;
    private $username;
    private $message;
    private $date;

    // décode le message stocké dans le fichier messages
    public static function fromJSON(string $json): Message
    {
        $data = json_decode($json, true);
        // $date = new DateTime("@" . $data['date']);
        // $date->setTimeZone(new DateTimeZone('Europe/Paris'));
        // new self() = new Message()
        return new self($data['username'], $data['message'], new DateTime("@" . $data['date']));
    }

    public function __construct(string $username, string $message, ?DateTime $date = null)
    {
        $this->username = $username;
        $this->message = $message;
        $this->date = $date ?: new DateTime();
    }

    // renvoie true si le tableau d'erreurs est vide, sinon false
    public function isValid(): bool
    {
        return empty($this->getErrors());
    }

    // ajoute une ou des erreur(s) lorsque les saisies sont trop courtes
    public function getErrors(): array
    {
        $errors = [];
        if (strlen($this->username) < self::LIMIT_USERNAME) {
            $errors['username'] = 'Votre pseudo est trop court';
        }
        if (strlen($this->message) < self::LIMIT_MESSAGE) {
            $errors['message'] = 'Votre message est trop court';
        }
        return $errors;
    }

    // permet d'afficher le message en html
    public function toHTML(): string
    {
        $username = htmlentities($this->username);
        $this->date->setTimezone(new DateTimeZone('Europe/Paris'));
        $date = $this->date->format('d/m/Y à H:i');
        $message = nl2br(htmlentities($this->message));
        return <<<HTML
        <p>
            <strong>{$username}</strong> <em>le {$date}</em><br>
            {$message}
        </p>
HTML;
    }

    // encode le message envoyé par l'utilisateur
    public function toJSON(): string
    {
        return json_encode([
            'username' => $this->username,
            'message' => $this->message,
            'date' => $this->date->getTimestamp()
        ]);
    }

}