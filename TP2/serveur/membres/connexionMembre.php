<!DOCTYPE html>
<html lang="fr">

  <head>

      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>IFT 1147 - TP1</title>

  </head>

  <body>

      <?php 
      
      require_once ("../BD/connexion.inc.php");

      $courriel = $_POST["courriel"];
      $motPasse = $_POST["motpasse"];

      $requetteCourriel = "SELECT * FROM `membres` WHERE courriel = '$courriel'";
      $membreTrouve = false;

      //Fonction utilisée pour vérifier si le courriel pour l'authentification fait partie de laBD (table 'membres').
      try {
        $verifierMembre = mysqli_query ($connexion, $requetteCourriel);
        $leRegistre = mysqli_fetch_object ($verifierMembre);
        $courrielBD = $leRegistre->courriel;
        if (!$courrielBD) {
          echo "<p><span><font size=\"4.5em\" color=\"red\"> Membre NON TROUVÉ. Le courriel n'est pas dans la liste de membres  &#8594; " . $courriel. "</font></p>";
          echo "<input type= 'button' onclick='javascript:history.back();return false;' value='< Retour'>";
          exit();
        }
   
      } catch (Exception $e) {
        echo "Probleme d'enregistrement";
        exit();
      } 

      $requetteDonneesConnexion = "SELECT * FROM `connexion` WHERE courriel = '$courriel'";

      try {
        $donneesConnexion = mysqli_query ($connexion, $requetteDonneesConnexion);
        $uneConnexion = mysqli_fetch_object ($donneesConnexion);
        $utilisateurBD = $uneConnexion->courriel;

        if (!$utilisateurBD) {

          echo "<p><span><font size=\"4.5em\" color=\"red\"> Membre NON TROUVÉ. Le courriel n'est pas dans la liste de membres  &#8594; " . $courriel. "</font></p>";
          echo "<input type= 'button' onclick='javascript:history.back();return false;' value='< Retour'>";
          exit();
        } else
            $membreTrouve = true;
   
      } catch (Exception $e) {
        echo "Probleme pour connecter";
        exit();
      }

      //Code utilisée pour VALIDER l'authentification avec les données dans la base de donnees (BD).
      if ($membreTrouve) {

        $motPasseBD = $uneConnexion->mot_passe;
        $typeBD = $uneConnexion->type;
        $statutBD = $uneConnexion->statut;

            if ( $motPasseBD == trim($motPasse) ) {
              //var_dump ($motPasse);
              
              if ($statutBD == 'A') {

                if ($typeBD == 'A') {
                  header("Location: ../../publique/admin.php");
                  $_SESSION['utilisateur'] = $utilisateurBD;
                  $_SESSION['nom'] = $leRegistre->nom;
                  $_SESSION['prenom'] = $leRegistre->prenom;
                  $_SESSION['estAdmin'] = 'vraie';
                  
                  die();
                  exit();
                } 
                
                else {
                  if ($typeBD == 'E') {
                    header("Location: ../../publique/employe.php"); 
                    die();
                    exit();

                  } else {
                      $_SESSION['utilisateur'] = $utilisateurBD;
                      $_SESSION['nom'] = $leRegistre->nom;
                      $_SESSION['prenom'] = $leRegistre->prenom;
                      header("Location: ../../publique/membres.php"); 
                      die();
                      exit();
                    }
                }
               
              } else { echo "<span> Compte INACTIF ! &#8594; </span> " . $courriel . "<p> Contactez votre administrateur. </p> "; exit(); }  
              
            } else { echo "<p><span><font size=\"4.5em\" color=\"red\">Mot de passe INCORRECT!</font></span> </p>" ;
                echo "<br><input type= 'button' onclick='javascript:history.back();return false;' value='< Retour'>";
                exit(); 
              }

      } else {
        echo "<p> Connexion non trouvé. Le courriel n'est pas dans la liste de connexions valides  &#8594; " . $courriel;
        echo "<br><input type= 'button' onclick='javascript:history.back();return false;' value='< Retour'>";
      }

      mysqli_close ($connexion);

      ?>

  </body>

</html>