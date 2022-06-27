<?php

class Client {

    private string $nom;
    private string $prenom;
    private string $email;
    private string $telephone;
    private array $reservations;

    public function __construct(string $nom, string $prenom, string $email, string $telephone){
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->reservations = [];
    }

    public function getNom() : string {
        return $this->nom;
    }

    public function getPrenom() : string {
        return $this->prenom;
    }

    public function getEmail() : string {
        return $this->email;
    }

    public function getReservations() : array {
        return $this->reservations;
    }

    public function getTelephone() : string {
        return $this->telephone;
    }

    public function __toString(){
        return "$this->prenom $this->nom";
    }

    public function ajouterReservation(Reservation $r) {
        $this->reservations[] = $r;
    }

    public function afficherReservations() {
        $result = "<h3 class='uk-margin-remove-bottom'>Réservations de $this</h3>";
        $result .= "<span class='uk-label uk-label-success'>".count($this->reservations)." réservations</span><br/>";
        foreach($this->reservations as $resa) {
            $result .= "$resa<br/>";
        }
        return $result;
    }

    public function getTotalReservations() {
        $total = 0;
        foreach($this->reservations as $resa) {
            $total += $resa->getNbJours() * $resa->getChambre()->getPrix();
        }
        return "Total : $total €<br/>";
    }
}