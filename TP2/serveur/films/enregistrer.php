<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IFT 1147 - TP1</title>

    </head>

    <body>

        <?php //ini_set ('display_errors', 'On'); error_reporting (E_ALL); ?>
        

        <?php
    
            require_once ("../BD/connexion.inc.php");
            $categorie = $_POST['categorie'];
            $titre = trim($_POST['titre']);
            $realisateur = trim($_POST['realisateur']);
            $duree = trim($_POST['duree']);
            $langue = trim($_POST['langue']);
            $date = trim($_POST['date']);
            $lien = trim($_POST['lien']);
            $dossier = "../ressources/pochettes/";
            $nomPochette = sha1($titre.time());
            $pochette = "avatar.jpg";

        
            if($_FILES['pochette']['tmp_name']!==""){

                //Upload de la photo
                $tmp = $_FILES['pochette']['tmp_name'];
                $fichier= $_FILES['pochette']['name'];

                $extension=strrchr($fichier,'.');

                @move_uploaded_file($tmp,$dossier.$nomPochette.$extension);

                // Enlever le fichier temporaire chargé
                @unlink($tmp); //effacer le fichier temporaire
                $pochette=$nomPochette.$extension;
            }
            
            $insererFilm = "INSERT INTO `films` (`categorie`, `titre`, `realisateur`, `duree`, `langue`, `date`, `lien`, `pochette`) values (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $connexion->prepare($insererFilm);
            $stmt->bind_param("sssissss", $categorie, $titre, $realisateur, $duree, $langue, $date, $lien, $pochette);

            $stmt->execute();
            echo "<font size=\"4.5em\" color=\"green\"> $stmt->affected_rows film a été bien ENREGISTRÉ</font>";

            echo "<hr><br><input type= 'button' onclick='location.replace(document.referrer);' value='Retour à la page ADMIN'>" ;
            
            mysqli_close($connexion);

        ?>

    </body>

</html>

