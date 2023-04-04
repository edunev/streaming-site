<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IFT 1147 - TP1</title>

    </head>

    <body>

        <?php ini_set ('display_errors', 'On'); error_reporting (E_ALL); ?>

        <?php
    
            require_once ("../BD/connexion.inc.php");
            $num=$_POST['num'];	

            
            $requete="SELECT * FROM films WHERE id_film=?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("i", $num);
            $stmt->execute();
            $result = $stmt->get_result();

            if(!$ligne = $result->fetch_object()){
                echo "<font size=\"4em\" color=\"red\">Le film ".$num." est INTROUVABLE!</font>";
                echo "<hr><br><input type= 'button' onclick='location.replace(document.referrer);' value='Retour à la page ADMIN'>";
                mysqli_close($connexion);
                exit();
            }

            $pochette=$ligne->pochette;

            if($pochette != "avatar.jpg"){
                $rmPoc='../ressources/pochettes/'.$pochette;

                unlink($rmPoc);

            }
            $requete="DELETE FROM films WHERE id_film=?";
            $stmt = $connexion->prepare($requete);
            $stmt->bind_param("i", $num);

            $stmt->execute();

            mysqli_close($connexion);

            echo "<br><b><font size=\"4.5em\" color=\"green\">Le film ".$num." a été RETIRÉ!</font>";
            echo "<hr><br><input type= 'button' onclick='location.replace(document.referrer);' value='Retour à la page ADMIN'>";

        ?>

    </body>
</html>

