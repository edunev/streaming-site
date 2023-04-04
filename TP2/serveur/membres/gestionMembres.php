<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../publique/css/tableau.css">

        <title>IFT 1147 - TP1</title>

    </head>

    <body>

        <!--<input type= 'button' onclick="location.href = '../../publique/admin.php';" value='Retour à la page ADMIN'> <hr>-->

        <?php ini_set ('display_errors', 'On'); error_reporting (E_ERROR); ?>

        <?php

            require_once ("../BD/connexion.inc.php");

            if (!isset($_SESSION['estAdmin']) || $_SESSION['estAdmin'] == NULL){
                echo "<span><font size=\"4.5em\" color=\"red\">Vous devez vous connecter comme ADMIN pour accéder
                à cette page : </font></span>";
                echo "<a href=\"../../publique/connexion.html\">Retour au formulaire</a>";
                exit();
                }
            
            echo "<input type= 'button' onclick=\"location.href = '../../publique/admin.php';\" value='Retour à la page ADMIN'> <hr>";

            $rep="<table id='tab'><caption>LISTE DES MEMBRES</caption>";  
            $rep.="<tr><th>Courriel</th><th>Type : Admin (A), Membre (M), Employee (E)</th><th>STATUT : Actif (A), Inacfif (I) &nbsp;&nbsp;</th><th></th></tr>";

            $requette="SELECT * FROM `connexion` ORDER BY courriel ASC";

            try{

                $listeMembres = mysqli_query ($connexion, $requette);
                while ($ligne = mysqli_fetch_object($listeMembres)){
                    $rep.="<tr><td>".($ligne->courriel)."</td><td>".($ligne->type)."</td><td>".($ligne->statut)."</td>
                    <td><form id='changerStatut' action='changerStatut.php' method='POST'> 
                    <input type='hidden' id='changeStatutU' name='changeStatutU' value='$ligne->courriel'>
                    <button type='submit'>Changer statut</button></form> </td></tr>";		 
                }

                mysqli_free_result($listeMembres);
            }catch (Exception $e){

                echo "Probleme pour lister";

            }finally {

                $rep.="</table>";
                echo $rep;

            }
            mysqli_close($connexion);

        ?>

    </body>

</html>