<?php
 class Compteur {

    const INCREMENT = 1;
    protected $fichier;

    public function __construct(string $fichier)
    {
        $this->fichier = $fichier;
    }

    // incrémente le compteur et met le nombre dans le fichier compteur
    public function incrementer(): void
    {
        $compteur = 1;
        if (file_exists($this->fichier)) {
        $compteur = (int)file_get_contents($this->fichier);
        //$compteur++;
        $compteur += self::INCREMENT;
        // si on veut incrémenter par 10 :
        // $compteur += static::INCREMENT;
    }
    file_put_contents($this->fichier, $compteur);
    }

    // récupère le nombre dans le fichier compteur
    public function recuperer(): int
    {
        if(!file_exists($this->fichier)) {
            return 0;
        }
        return file_get_contents($this->fichier);
    }

 }