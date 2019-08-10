<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Compteur.php';
 class DoubleCompteur extends Compteur {

    public function recuperer(): int
    {
        /*if(!file_exists($this->fichier)) {
            return 0;
        }
        return 2 * (int)file_get_contents($this->fichier);*/

        // ou

        // on peut faire juste :
        return 2 * parent::recuperer();
    }

    // ou

    // const INCREMENT = 10;

 }