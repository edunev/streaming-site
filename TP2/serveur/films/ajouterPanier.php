<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IFT 1147 - TP1</title>

    </head>

    <body>
        <?php ini_set ('display_errors', 'On'); error_reporting (E_ERROR); ?>

        <?php

    require_once ("../BD/connexion.inc.php");

    $idFilm = $_POST['location'];
    $courriel = $_SESSION['utilisateur'];
    $prix = $_POST['prix'];
    $nomFil = $_POST['nomFil'];

    if(isset($_POST['location']) && isset($_SESSION['utilisateur'])) {

        try{
            $insererLoc = "INSERT INTO `location_payment`(`id_film`, `nom_film`, `courriel`, `prix`) VALUES (?, ?, ?, ?)";

            $stmt = $connexion->prepare($insererLoc);
            $stmt->bind_param("issd", $idFilm, $nomFil, $courriel, $prix);
    
            $stmt->execute();

            mysqli_close($connexion);

        }catch (Exception $e){

            echo "Probleme pour louer";

        }finally {

            echo "<font size=\"4.5em\" color=\"green\"> Ce film a été bien ajouté! </font><br> <p>Attendez le retour automatique...</p>";
            header("refresh:3; url=../../publique/membres.php");
            exit();

        }

    } else {
        header("Location: ../../index.html", true, 301);
    }


    ?>



    </body>

</html>