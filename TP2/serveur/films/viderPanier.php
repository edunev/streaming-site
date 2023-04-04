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

        if (isset($_SESSION['utilisateur'])) {

            try{
                
                $insererLoc = "UPDATE `location_payment` SET `date_location`='0000-00-00' WHERE `courriel`='$courriel'";
                $stmt = $connexion->prepare($insererLoc);
                $stmt->execute();

                mysqli_close($connexion);

            }catch (Exception $e){

                echo "Probleme pour louer";

            }finally {

                echo "<font size=\"4.5em\" color=\"green\"> Le panier a été vidé! </font><br> <p>Attendez le retour automatique...</p>";
                header("refresh:3; url=../../publique/membres.php");
                exit();

            }

        } else {
            header("Location: ../../index.html", true, 301);
        }


        ?>
    </body>
</html>