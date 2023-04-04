<?php ini_set ('display_errors', 'On'); error_reporting (E_ERROR); ?>

<?php

    require_once ("../BD/connexion.inc.php");
    $cour = $_POST['changeStatutU'];

    if(isset($_POST['changeStatutU'])) {

        try{

            $requette="SELECT statut FROM connexion WHERE courriel=?";
            $stmt = $connexion->prepare($requette);
            $stmt->bind_param("s", $cour);
            $stmt->execute();
            $result = $stmt->get_result();
            $ligne = $result->fetch_object();

            var_dump($ligne->statut);


        }catch (Exception $e){

            echo "Probleme pour lister";

        }finally {
            

            if ($ligne->statut == "A") {
                $statutI = "I";
                $modifierStatutI = "UPDATE `connexion` SET `statut`= ? WHERE `courriel` = ? ";
                $stmt = $connexion->prepare($modifierStatutI);
                $stmt->bind_param("ss", $statutI, $cour);
                $stmt->execute();

            } else {
                $statutA = "A";
                $modifierStatutA = "UPDATE `connexion` SET `statut`= ? WHERE `courriel`= ?";
                $stmt = $connexion->prepare($modifierStatutA);
                $stmt->bind_param("ss", $statutA, $cour);
                $stmt->execute();
            }

            header("Location: gestionMembres.php", true, 301);
            mysqli_close($connexion);
            exit();

        }
    
    } else {
        header("Location: ../../index.html", true, 301);
    }


?>