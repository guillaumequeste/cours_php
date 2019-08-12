<?php
require_once 'Message.php';
class GuestBook {

    private $file;

    public function __construct(string $file)
    {
        $directory = dirname($file);
        // si le dossier n'existe pas, tu le crées
        if (!is_dir($directory)) {
            mkdir($directory, 0777, true);
        }
        // si le fichier n'existe pas, tu le crées
        if (!file_exists($file)) {
            touch($file);
        }
        $this->file = $file;
    }

    // ajoute le message envoyé par l'utilisateur dans le fichier messages
    public function addMessage(Message $message): void
    {
        file_put_contents($this->file, $message->toJSON() .PHP_EOL, FILE_APPEND);
    }

    // récupère chaque message stocké dans le fichier messages sous forme de tableau
    // reverse le tableau pour afficher en premier les messages les plus récents
    public function getMessages(): array
    {
        $content = trim(file_get_contents($this->file));
        $lines = explode(PHP_EOL, $content);
        $messages = [];
        foreach ($lines as $line) {
            $messages[] = Message::fromJSON($line);
        }
        return array_reverse($messages);
    }

}