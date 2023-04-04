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

      try {
        $verifierMembre = mysqli_query ($connexion, $requetteCourriel);
        $leRegistre = mysqli_fetch_object ($verifierMembre);
        $courrielBD = $leRegistre->courriel;
        if ($courrielBD) {
          echo "<span> Membre déjà enregistré. Le courriel a été utilisé pour créer un membre. &#8594; </span>" . $courriel;
          echo "<br><br><input type= 'button' onclick='javascript:history.back();return false;' value='Retour au formulaire'>";
          exit();
        }
   
      } catch (Exception $e) {
        echo "Probleme pour lister";
        exit();
      } 

      if (   ( isset($prenom)   ||   isset ($nom)  ) &&  ( empty (trim ($prenom))   ||   empty (trim ($nom)) )  ){
        echo "<p> Le <b>prénom</b> ou le <b>nom</b> ne peuvent pas être vides <br><br></p>";
        echo "<input type= 'button' onclick='javascript:history.back(); return false;' value='Retour au formulaire'>" ;
        $enregistrer = false;
        exit();
        
      }

      // Généralement 13 ans c'est l'âge légal pour l'utilisation de ces genres de services.
      if (  (date('Y-m-d', strtotime('-13 years'))) <= $date_naiss) {
        
        echo "<p>Les services sont disponibles seulement pour les clients de 13 ans ou plus.</p> ";
        echo "<input type= 'button' onclick='javascript:history.back(); return false;' value='Retour au formulaire'>" ;
        $enregistrer = false;
        exit();
      } 

      $motPasseRegex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[-_]).{8,10}$/';  //REGEX (entre 8 et 10 caractères qui incluent forcément des lettres minuscules, majuscules, des chiffres et les caractères - et _)
      $motPasseCorrige = str_replace(' ', '', $motPasse); // Il représente le mot de passe sans espaces.
      
      if ($motPasse != $motPasseConf){
        echo "<p>Les mots des passes fournis ne sont pas identiques. </p> ";
        echo "<input type= 'button' onclick='javascript:history.back(); return false;' value='Retour au formulaire'>" ;
        $enregistrer = false;
        //exit();

      } else {
        if ($motPasse != $motPasseCorrige) {
          echo "<p>Les espaces ne sont pas acceptés dans les mots des passes.</p> ";
          echo "<input type= 'button' onclick='javascript:history.back(); return false;' value='Retour au formulaire'>" ;
          $enregistrer = false;
          //exit();

        } else {
          if (preg_match ($motPasseRegex, $motPasse)) {
            $enregistrer = true;
            
          } else {
            echo "<p>Le mot de passe ne suit pas les règles : il doit être entre 8 et 10 caractères qui incluent des lettres minuscules, majuscules, au moins un chiffre et les caractères \"-\" ou \"_\" </p>";
            echo "<input type= 'button' onclick='javascript:history.back(); return false;' value='Retour au formulaire'>" ;
            $enregistrer = false; 
          }
        }
      }
      

      if ($enregistrer == true) {

        $requette = "INSERT INTO membres VALUES (?, ?, ?, ?, ?)";
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("sssss", $courriel, $prenom, $nom, $genre, $date_naiss);
        $stmt->execute();

        $type = "M";
        $statut = "A";

        $requette = "INSERT INTO connexion VALUES (?, ?, ?, ?)";
        $stmt = $connexion->prepare($requette);
        $stmt->bind_param("ssss", $courriel, $type, $statut, $motPasse);
        $stmt->execute();
      
        echo "<p> Membre créé avec succès : </p>";
        echo "<p> Prénom : " . $prenom . " </p>";
        echo "<p> Nom : " . $nom . "</p>";
        echo "<p> Courriel : " . $courriel . "</p>";
        echo "<p> Genre : " .  $genre  . "</p>";
        echo "<p> Date de Naissance : " . $date_naiss . "</p>";
        echo "<form method=\"get\" action=\"../../index.html\"> <button type=\"submit\">Page principale</button> </form>";

      } 

      mysqli_close ($connexion);
    ?>

  </body>

</html>