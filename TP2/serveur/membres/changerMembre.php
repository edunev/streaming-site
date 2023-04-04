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

      $courriel = $_POST["courriel"];
      $prenom = $_POST["prenom"];
      $nom = $_POST["nom"];

      $genre = $_POST["genre"];

      $date_naiss = $_POST["date"];
      $motPasse = $_POST["motpasse1"];
      $motPasseConf = $_POST["motpasse2"];

      $enregistrer = true;
      
      $requetteCourriel = "SELECT * FROM `membres` WHERE courriel = '$courriel'";
      $requetteConnexion = "SELECT * FROM `connexion` WHERE courriel = '$courriel'";


      try {
        $verifierMembre = mysqli_query ($connexion, $requetteCourriel);
        $leRegistre = mysqli_fetch_object ($verifierMembre);

        $trouverMotPasse = mysqli_query ($connexion, $requetteConnexion);
        $laConnexion = mysqli_fetch_object ($trouverMotPasse);
        $motPasseBD = $laConnexion->mot_passe;


        if (isset($genre) && $genre != "") { 
            $genreEnreg = $_POST["genre"];
        } else {
          $genreEnreg = $leRegistre->genre;
        }

   
      } catch (Exception $e) {
        echo "Probleme pour lister";
        exit();
      } 

    

      if (   ( isset($prenom)   ||   isset ($nom)  ) &&  ( empty (trim ($prenom))   ||   empty (trim ($nom)) )  ){
        echo "<p> Le <b>prénom</b> ou le <b>nom</b> ne peuvent pas être vides <br><br></p>";
        echo "<form method=\"get\" action=\"../../publique/membres.php\"> <button type=\"submit\">Page des membres</button> </form>";
        $enregistrer = false;
        exit();
        
      }

      // Généralement 13 ans c'est l'âge légal pour l'utilisation de ces genres de services.
      if (  (date('Y-m-d', strtotime('-13 years'))) <= $date_naiss) {
        
        echo "<p>Les services sont disponibles seulement pour les clients de 13 ans ou plus.</p> ";
        echo "<form method=\"get\" action=\"../../publique/membres.php\"> <button type=\"submit\">Page des membres</button> </form>";
        $enregistrer = false;
        exit();
      } 

      $motPasseRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_]).{8,10}$/';  //REGEX (entre 8 et 10 caractères qui incluent forcément des lettres minuscules, majuscules, des chiffres et les caractères - et _)
      $motPasseCorrige = str_replace(' ', '', $motPasse); // Il représente le mot de passe sans espaces.

     
      if (isset($motPasse) && $motPasse != "") {
          

                if ($motPasse != $motPasseConf){
                    echo "<p>Les mots des passes fournis ne sont pas identiques. </p> ";
                    echo "<form method=\"get\" action=\"../../publique/membres.php\"> <button type=\"submit\">Page des membres</button> </form>";
                    $enregistrer = false;
                    //exit();

                } else {
                    if ($motPasse != $motPasseCorrige) {
                    echo "<p>Les espaces ne sont pas acceptés dans les mots des passes.</p> ";
                    echo "<form method=\"get\" action=\"../../publique/membres.php\"> <button type=\"submit\">Page des membres</button> </form>";
                    $enregistrer = false;
                    //exit();

                    } else {
                    if (preg_match ($motPasseRegex, $motPasse)) {
                        $enregistrer = true;
                        
                        } else {
                            echo "<p>Le mot de passe ne suit pas les règles : il doit être entre 8 et 10 caractères qui incluent des lettres minuscules, majuscules, au moins un chiffre et les caractères \"-\" ou \"_\" </p>";
                            echo "<form method=\"get\" action=\"../../publique/membres.php\"> <button type=\"submit\">Page des membres</button> </form>";
                        }
                    }
                }

            $motPasseEnreg = $motPasse;

        } else {
            $motPasseEnreg = $motPasseBD;
        }


      if ($enregistrer == true) {

        $requette = "UPDATE `membres` SET `prenom` = ?,`nom` = ?,`genre` = ? ,`date_naissance` = ? WHERE `courriel` = ? ";
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("sssss", $prenom, $nom, $genreEnreg, $date_naiss, $courriel);
        $stmt->execute();

        $requette = "UPDATE `connexion` SET `mot_passe` = ? WHERE `courriel` = ?";
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("ss", $motPasseEnreg, $courriel);
        $stmt->execute();

        echo "<p> Données soumises avec succès : </p>";
        echo "<p> Prénom : " . $prenom . " </p>";
        echo "<p> Nom : " . $nom . "</p>";
        echo "<p> Courriel : " . $courriel . "</p>";
        echo "<p> Genre : " .  $genreEnreg  . "</p>";
        echo "<p> Date de Naissance : " . $date_naiss . "</p>";
        echo "<form method=\"get\" action=\"../../publique/membres.php\"> <button type=\"submit\">Page des membres</button> </form>";

      } 

      mysqli_close ($connexion);
    ?>

  </body>

</html>