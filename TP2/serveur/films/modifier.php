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

            if(isset($_POST['id_film'])) {

                require_once ("../BD/connexion.inc.php");

                $num = $_POST['id_film'];
                $categorie = $_POST['categorie'];
                $titre = $_POST['titre'];
                $duree = $_POST['duree'];
                $realisateur = $_POST['realisateur'];
                $pochette = $_POST['pochette'];

                $langue = $_POST['langue'];
                $date = $_POST['date'];
                $lien = $_POST['lien'];



                $dossier="../pochettes/";
                $requettePochette="SELECT pochette FROM films WHERE id_film=?";

                $stmt = $connexion->prepare($requettePochette);
                $stmt->bind_param("i", $num);
                $stmt->execute();
                $result = $stmt->get_result();
                $ligne = $result->fetch_object();

                $pochetteBD = $ligne->pochette;


                if ($_FILES['pochette']['tmp_name'] != null) {

                        if($pochetteBD != "avatar.jpg"){
                            $rmPoc='../ressources/pochettes/'.$pochetteBD;
                    
                            $tabFichiers = glob('../ressources/pochettes/*');
        
                            foreach($tabFichiers as $fichier){

                                if(is_file($fichier) && $fichier==trim($rmPoc)) {
                    
                                    unlink($fichier);
                                    break;
                                }
                            }
                        }

                    //Upload de la photo
                    $tmp = $_FILES['pochette']['tmp_name'];
                    $fichier= $_FILES['pochette']['name'];

                    $extension=strrchr($fichier,'.');

                    $dossier = "../ressources/pochettes/";
                    $nomPochette = sha1($titre.time());

                    @move_uploaded_file($tmp,$dossier.$nomPochette.$extension);

                    // Enlever le fichier temporaire chargé
                    @unlink($tmp); //effacer le fichier temporaire
                    $pochette=$nomPochette.$extension;

                } else {
                    $pochette = $pochetteBD;
                }


                $modifierFilm = "UPDATE `films` SET `categorie` = ?, `titre` = ?, `realisateur` = ?, `duree`= ?, `langue` = ? ,`date` = ?, `lien` = ?, `pochette`= ? WHERE id_film = ?";

                $stmt = $connexion->prepare($modifierFilm);
                $stmt->bind_param("sssissssi", $categorie, $titre, $realisateur, $duree, $langue, $date, $lien, $pochette, $num);

                $stmt->execute();
                
                echo "<font size=\"4.5em\" color=\"green\">Le film ".$num." a été bien MODIFIÉ!</font>";
                echo "<hr><br><input type= 'button' onclick=\"location.href = '../../publique/admin.php';\" value='Retour à la page ADMIN'>" ;

            }
            else {
                header("Location: ../../index.html", true, 301);
            }
        ?>
    </body>
</html>
