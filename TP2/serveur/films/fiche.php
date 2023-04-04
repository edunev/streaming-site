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

            $num=$_POST['num'];

            $requetteFilm = "SELECT * FROM `films` WHERE id_film = '$num'";


            try {

                
                $trouverFilm = mysqli_query ($connexion, $requetteFilm);
                $unFilm = mysqli_fetch_object ($trouverFilm);
                $filmBD = $unFilm->id_film;
                if (!$filmBD) {
                    echo "<font size=\"4.5em\" color=\"red\">Film ".$num." introuvable </font>";
                    echo "<hr><br><input type= 'button' onclick='location.replace(document.referrer);' value='Retour à la page ADMIN'>";
                    mysqli_close($connexion);
                    exit();
                }
        
            } catch (Exception $e) {
                echo "Probleme de connexion";
                exit();
            } 


            if( isset ($filmBD) ) {
                echo "	<div>\n";
                echo "		<form id=\"formEnreg\" enctype=\"multipart/form-data\" action=\"modifier.php\" method=\"POST\" onSubmit=\"\">\n";
                echo "			Identificateur du film (lecture seulement) : <input type=\"text\" id=\"id_film\" name=\"id_film\" value='".$unFilm->id_film."' readonly><br><br>\n";
                echo "			Catégorie : <input type=\"text\" id=\"categorie\" name=\"categorie\" value='".($unFilm->categorie)."'><br><br>\n";
                echo "			Titre : <input type=\"text\" id=\"titre\" name=\"titre\" value='".($unFilm->titre)."'><br><br>\n";
                echo "			Duree : <input type=\"text\" id=\"duree\" name=\"duree\" value='".$unFilm->duree."'><br><br>\n";
                echo "			Realisateur : <input type=\"text\" id=\"realisateur\" name=\"realisateur\" value='".$unFilm->realisateur."'><br><br>\n";


                echo "			Pochette courrante :   <img src=\"../ressources/pochettes/$unFilm->pochette\" alt=\"pochette\"  width=\"96\" height=\"120\" ><br><br>\n";
                echo "			Choisissez une nouvelle pochette : <input type=\"file\" id=\"pochette\" name=\"pochette\"><br><br>\n";

                echo "			Hyperlien : <input type=\"text\" id=\"lien\" name=\"lien\" value='".$unFilm->lien."'><br><br>\n";
                echo "			Date : <input type=\"text\" id=\"date\" name=\"date\" value='".$unFilm->date."'><br><br>\n";
                echo "			Langue : <input type=\"text\" id=\"langue\" name=\"langue\" value='".$unFilm->langue."'><br><br>\n";
                echo "          <br><input type= 'button' onclick=\"location.href = '../../publique/admin.php';\" value='Annuler'>" ;
                echo "			<input type=\"submit\" value=\"Envoyer\">\n";
                echo "		</form>\n";
                echo "	</div>";
                } else {
                    echo "Non Trouvé!";
                }


        ?>

    </body>
</html>

