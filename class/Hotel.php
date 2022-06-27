<?php 

class Hotel {

    private string $nom;
    private string $adresse;
    private string $cp;
    private string $ville;
    private array $chambres;
    private array $reservations;

    public function __construct(string $nom, string $adresse, string $cp, string $ville) {
        $this->nom = $nom;
        $this->adresse = $adresse;
        $this->cp = $cp;
        $this->ville = $ville;
        $this->chambres = [];
        $this->reservations = [];
    }

    public function ajouterChambre(Chambre $c) {
        $this->chambres[] = $c;
    }

    public function ajouterReservation(Reservation $r) {
        $this->reservations[] = $r;
    }
 
    public function getNom() : string {
        return $this->nom;
    }

    public function getAdresse() : string {
        return $this->adresse;
    }

    public function getCp() : string {
        return $this->cp;
    }

    public function getVille() : string {
        return $this->ville;
    }

    public function getAdresseComplete() : string {
        return "$this->adresse $this->cp $this->ville";
    }

    public function getChambres() : array {
        return $this->chambres;
    }
    
    public function getReservations() : array {
        return $this->reservations;
    }

    public function getInfos() : string {
        $nbChambres = count($this->getChambres());
        $nbResa = count($this->getReservations());
        $nbLibres = $nbChambres - $nbResa; 
        return "<h3 class='uk-margin-remove-bottom'>$this</h3>".$this->getAdresseComplete()."<br/>
                    Nombre de chambres : ".$nbChambres."<br/>
                    Nombre de chambres réservées : ".$nbResa."<br/>
                    Nombre de chambres dispo : ".$nbLibres;
    }

    public function afficherReservations() : string {
        $result = "<h4 class='uk-margin-remove-bottom'>Réservations de l'hôtel $this</h4>";
        if(count($this->reservations) == 0){
            $result .=  "Aucune réservation !<br/>";
        } else {
            echo "<span class='uk-label uk-label-success'>".count($this->reservations)." réservations</span><br/>";
            foreach($this->reservations as $resa) {
                $result .= $resa->getClient()." 
                                - Chambre ".$resa->getChambre()->getNumero()." - 
                                du ".$resa->getDateDebut()->format("d-m-Y")." 
                                au ".$resa->getDateFin()->format("d-m-Y")."<br/>";
            }
        }
        return $result;
    }

    public function getMaxCA() : string {
        $caMax = 0;
        foreach($this->getChambres() as $chambre) {
            $caMax += $chambre->getPrix();
        }
        return "Le CA max de l'hôtel $this est de : $caMax €<br/>";
    }

    public function getActuelCA() : string {
        $caActuel = 0;
        foreach($this->getReservations() as $reservation) {
            $caActuel += $reservation->getChambre()->getPrix();
        }
        return "Le CA actuel de l'hôtel $this est de : $caActuel €<br/>";
    }

    public function rendreChambre(Chambre $chambre) {
        $chambre->setIsReserved(false);
    }

    public function annulerReservation(Reservation $reservation) {
        foreach($this->reservations as $key => $res) {
            if($res->getChambre()->getNumero() == $reservation->getChambre()->getNumero()){
                $reservation->getChambre()->setIsReserved(false);
                unset($this->reservations[$key]);
            }
        }
    }

    public function prochainesReservations() {
        
        $result = "<h2>Prochaines réservation de $this</h2>";
        foreach($this->reservations as $reservation) {
            if($reservation->getDateDebut() > new DateTime()) {
                $result .= "Chambre ".$reservation->getChambre()." par ".$reservation->getClient()." du ".$reservation->getDateDebut()->format("d-m-Y")." au ".$reservation->getDateFin()->format("d-m-Y")."<br>";
            }
        } 

        return $result;
    }

    public function getEtatChambres() {
        $result = "<h3>Statuts des chambres de <strong>$this</strong></h3>";
        $result .= "<table class='uk-table uk-table-striped'>
                        <thead>
                            <tr>
                                <th>Chambre</th>
                                <th>Prix</th>
                                <th>Wifi</th>
                                <th>Etat</th>
                            </tr>
                        </thead>
                        <tbody>";
        foreach($this->getChambres() as $chambre) {
            $status = ($chambre->getIsReserved()) ? "Réservée" : "Disponible";
            $color = ($chambre->getIsReserved()) ? "danger" : "success";
            $wifi = ($chambre->getHasWifi()) ? "<span uk-icon='icon: rss'></span>" : "";
            $result .= "<tr>
                            <td>Chambre ". $chambre->getNumero()."</td>
                            <td>".$chambre->getPrix()." €</td>
                            <td>$wifi</td>
                            <td><span class='uk-label uk-label-$color'>$status</span></td>
                            <td></td>
                        </tr>";
        }
        $result .= "</tbody></table>";
        return $result;
    }

    public function __toString(){
        return $this->nom;
    }
}