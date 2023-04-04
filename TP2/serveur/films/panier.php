<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="../../publique/css/tableau.css">

        <title>IFT 1147 - TP1</title>

    </head>

    <body>

        <?php ini_set ('display_errors', 'On'); error_reporting (E_ERROR); ?>

        <?php

            require_once ("../BD/connexion.inc.php");

            $courriel = $_SESSION['utilisateur'];

            $date = strtotime("+7 day");
            $dateFin = date("Y-m-d", $date);

            $filtre = "WHERE `courriel` = '$courriel' ";


            $rep="<table id='tab'>";
            $rep.="<caption>LISTE DES LOCATIONS <br> (les films qui ont dépassé la date d'échéance ne sont plus disponibles dans votre panier) <br><br> </caption>";
        
            
            $rep.="<tr><th>ID du film</th><th>Titre</th><th>Date Location</th><th>Date de écheance</th><th>Prix ($)</th></tr>";

            $requetteLoc = "SELECT * FROM `location_payment`" . $filtre;

            echo "<br><input type= 'button' onclick='location.replace(document.referrer);' value='Retour'><hr>";

            $date = date_create($ligne->date_location);
            date_add($date, date_interval_create_from_date_string('7 days'));
            $dataPlus = date_format($date, 'Y-m-d');


            try{

                $listerLoc = mysqli_query ($connexion, $requetteLoc);
                while ($ligne = mysqli_fetch_object($listerLoc)){

                    $date = date_create($ligne->date_location);
                    date_add($date, date_interval_create_from_date_string('7 days'));
                    $dataPlus = date_format($date, 'Y-m-d');

                    if(date("Y-m-d") <= $dataPlus){

                        $rep.="<tr><td>".($ligne->id_film)."</td><td>".($ligne->nom_film)."</td><td>".($ligne->date_location)."</td><td>".($dataPlus)."</td><td>".($ligne->prix)."</td></tr>";
                        $total += $ligne->prix; 	

                    }
                        
                }

                mysqli_free_result($listerLoc);
            }catch (Exception $e){

                echo "Probleme pour lister";

            }finally {


                $rep.="</table>";
                $rep.="<br> <font size=\"4em\" color=\"darkblue\"> TOTAL : $ $total  </font>" ;
                
                echo "                <form id='viderPanier' action='viderPanier.php' method='POST'> \n";
                echo "                <input type='hidden' id='vider' name='vider' value='$courriel'>\n";
                echo "                <button type='submit'>Vider panier</button></form>";

                echo $rep;

                echo "                <form id='payment' action='facture.php' method='POST'> \n";
                echo "                <input type='hidden' id='factureTotal' name='factureTotal' value='$total'>\n";
                echo "                <button type='submit'>Obtenir facture</button></form>";

            }
            mysqli_close($connexion);

        ?>

    </body>
</html>

