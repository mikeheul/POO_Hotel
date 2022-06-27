<?php

class Chambre {

    private Hotel $hotel;
    private int $numero;
    private float $prix;
    private int $nbLits;
    private bool $hasWifi;
    private array $options;
    private static array $chambres;
    private bool $isReserved;

    public function __construct(Hotel $hotel, int $numero, int $nbLits, float $prix, bool $hasWifi = true)
    {
        $this->hotel = $hotel;
        $this->numero = $numero;
        $this->nbLits = $nbLits;
        $this->prix = $prix;
        $this->hasWifi = $hasWifi;
        $this->options = [];
        self::$chambres[] = $this;
        $hotel->ajouterChambre($this);
        $this->isReserved = false;
        // echo $this->getHotel()." $this<br/>";
    }

    public function getHotel() : Hotel {
        return $this->hotel;
    }

    public function getNumero() : int {
        return $this->numero;
    }

    public function getPrix() : float {
        return $this->prix;
    }

    public function getNbLits() : int {
        return $this->nbLits;
    }

    public function getHasWifi() : bool {
        return $this->hasWifi;
    }

    public static function getChambres() : array {
        return self::$chambres;
    }

    public function getOptions() : array {
        return $this->options;
    }

    public function ajouterOption(array $options) {
        foreach($options as $option){
            $this->options[] = $option;
        }
    }
    
    public function getIsReserved() : bool {
        return $this->isReserved;
    }

    public function setIsReserved(bool $reserved){
        $this->isReserved = $reserved;
    }

    public function __toString(){
        $wifi = ($this->hasWifi) ? "oui" : "non";
        return $this->numero." (".$this->nbLits." lits - ".$this->prix." € - Wifi : $wifi)";
    }

}