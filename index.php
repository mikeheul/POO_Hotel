<?php
    // Autoloader
    spl_autoload_register(function ($class) {
        require "class/$class.php";
    });
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/css/uikit.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uikit/3.0.3/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
    <title>POO Hotel</title>
</head>
<body>
    <div class="uk-container uk-container-expand">
        <h1>POO HOTEL</h1>
        <?php

            $hilton = new Hotel("Hilton **** Strasbourg", "10 route de la Gare", "67000", "STRASBOURG");
            $regent = new Hotel("Regent **** Paris", "14 avenue des Champs Elysées", "75000", "PARIS");
            
            // Ajouter 30 chambres à chaque hôtel : 
            //    - 15 chambres à 2 lits -> 120 € sans wifi
            //    - 15 chambres à 2 lits -> 300 € avec wifi

            foreach(range(1,30) as $num){
                if($num <= 15){
                    ${"chambreH".$num} = new Chambre($hilton, $num, 2, 120, false);
                    ${"chambreR".$num} = new Chambre($regent, $num, 2, 120, false);
                } else {
                    ${"chambreH".$num} = new Chambre($hilton, $num, 1, 300);
                    ${"chambreR".$num} = new Chambre($regent, $num, 1, 300);
                }
            }

            // var_dump(Chambre::getChambres());

            $client1 = new Client("GIBELLO", "Virgile", "virgile@elan.fr", "06.00.00.00.00");
            $client2 = new Client("MURMANN", "Micka", "micka@elan.fr", "06.11.11.11.11");

            $r1 = new Reservation($client1, $chambreH17, "2021-01-01", "2021-01-08");
            $r2 = new Reservation($client2, $chambreH3, "2021-03-11", "2021-03-15");
            $r3 = new Reservation($client2, $chambreH4, "2021-04-01", "2021-04-17");

            $r4 = new Reservation($client1, $chambreH17, "", "");
            var_dump($r4);

            // Ajouter des options à la chambre 30
            $chambreH30->ajouterOption(["Climatisation", "Vue sur mer", "Bureau"]);
            echo "Options de la chambre H30<br/>";
            var_dump($chambreH30->getOptions());
            echo "Options de la chambre H20<br/>";
            var_dump($chambreH20->getOptions());

            // Infos hôtel
            echo $hilton->getInfos();
            echo $hilton->afficherReservations();
            echo $hilton->getMaxCA();
            echo $hilton->getActuelCA();
            
            echo $regent->getInfos();
            echo $regent->afficherReservations();
            echo $regent->getMaxCA();
            echo $regent->getActuelCA();

            echo $client1->afficherReservations();
            echo $client1->getTotalReservations();
            echo $client2->afficherReservations();
            echo $client2->getTotalReservations();

            $hilton->rendreChambre($chambreH3);

            
            $r5 = new Reservation($client1, $chambreH18, "2021-11-10", "2021-11-14");
            
            echo $hilton->afficherReservations();
            $hilton->annulerReservation($r3);

            // Prochaines réservations
            echo $hilton->prochainesReservations();
            echo $hilton->afficherReservations();
            
            echo $hilton->getEtatChambres();
        ?>
        </div>
    </body>
</html>