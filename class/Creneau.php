<?php
class Creneau {

    public $debut;

    public $fin;

    public function __construct(int $debut, int $fin) 
    {
        $this->debut = $debut;
        $this->fin = $fin;
    }

    public function toHTML(): string
    {
        return "<strong>{$this->debut}h</strong> à <strong>{$this->fin}h</strong";
    }

    public function inclutHeure(int $heure): bool 
    {
        return $heure >= $this->debut && $heure <= $this->fin;
    }

    public function intersect(Creneau $creneau): bool
    {
        // est-ce que le créneau défini inclut le début du créneau que l'on passe en paramètre
        return $this->inclutHeure($creneau->debut) ||
        // est-ce que le créneau défini inclut la fin du créneau que l'on passe en paramètre
            $this->inclutHeure($creneau->fin) ||
        // est-ce que le créneau passé en paramètre englobe le créneau défini
            ($this->debut > $creneau->debut && $this->fin < $creneau->fin);
    }

}