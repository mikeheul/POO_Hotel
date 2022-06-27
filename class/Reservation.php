<?php

class Reservation {

    private Client $client;
    private Chambre $chambre;
    private DateTime $dateDebut;
    private DateTime $dateFin;
    private int $nbJours;

    public function __construct(Client $client, Chambre $chambre, string $dateDebut, string $dateFin){
        
        if(!$chambre->getIsReserved()){
            $this->client = $client;
            $this->chambre = $chambre;
            $this->dateDebut = new DateTime($dateDebut);
            $this->dateFin = new DateTime($dateFin);
            $hotel = $chambre->getHotel();
            $hotel->ajouterReservation($this);
            $client->ajouterReservation($this);
            $chambre->setIsReserved(true);
            $this->nbJours = $this->dateDebut->diff($this->dateFin)->format("%d");
        } else {
            echo "Réservation impossible, la chambre $chambre est déjà réservée !<br/>";
            return;
        }
    }

    public function getClient() : Client {
        return $this->client;
    }

    public function getChambre() : Chambre {
        return $this->chambre;
    }

    public function getDateDebut() : DateTime {
        return $this->dateDebut;
    }

    public function getDateFin() : DateTime {
        return $this->dateFin;
    }

    public function getNbJours() : int {
        return $this->nbJours;
    }

    public function __toString(){
        return "<strong>Hotel : ". $this->chambre->getHotel()."</strong> / Chambre : ".$this->chambre. " du ".$this->dateDebut->format("d-m-Y")." au ".$this->dateFin->format("d-m-Y");  
    }
}