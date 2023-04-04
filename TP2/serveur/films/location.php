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

            $parDate = $_POST['montrerTout'];
            $parCat = $_POST['categorie'];

            $filtre = $parDate . $parCat;

            if ( $_POST['chercherTitre'] != "" && $_POST['chercherRealisateur'] !="" ){
                $filtre = "WHERE titre LIKE '%".$_POST['chercherTitre']."%' AND '%".$_POST['chercherRealisateur']."%'";
            } else {

                if ($_POST['chercherTitre'] != ""){
                    $filtre = "WHERE titre LIKE '%".$_POST['chercherTitre']."%'";
                }

                if ($_POST['chercherRealisateur'] !=""){
                    $filtre = " WHERE realisateur LIKE '%".$_POST['chercherRealisateur']."%'";
                }

            }


            $rep="<table id='tab'>";
            $rep.="<caption>LISTE DES FILMS</caption>";
        
            
            $rep.="<tr><th>ID du film</th><th>Catégorie</th><th>Titre</th><th>Realisateur</th><th>Duree (min)</th><th>Langue</th><th>Date</th><th>Bande-annonce</th><th>Pochette</th></tr>";

            $requette="SELECT * FROM `films`" . $filtre;

            echo "<br><input type= 'button' onclick='location.replace(document.referrer);' value='Retour à la page ADMIN'><hr>";

            try{

                $listeFilms = mysqli_query ($connexion, $requette);
                while ($ligne = mysqli_fetch_object($listeFilms)){
                    $rep.="<tr><td>".($ligne->id_film)."</td><td>".($ligne->categorie)."</td><td>".($ligne->titre)."</td>
                    <td>".($ligne->realisateur)."</td><td>".($ligne->duree)."</td><td>".($ligne->langue)."</td><td>".($ligne->date)."</td>
                    <td> &nbsp; <a href='$ligne->lien' target='_blank'>  Allez</a></td><td><img src='../ressources/pochettes/".($ligne->pochette)."' width=128 height=192></td></tr>";		 
                }

                mysqli_free_result($listeFilms);
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

