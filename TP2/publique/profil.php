<!DOCTYPE html>
<html lang="fr">

  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <title>IFT 1147 - TP1</title>

      <script src="utilitaires/jquery-3.6.0.min.js"></script>
      <script src="utilitaires/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="utilitaires/bootstrap.css">
      <link rel="stylesheet" type="text/css" href="utilitaires/bootstrap.css.map">

      <!-- <script type="text/javascript" src="js/date-selector.js"></script> -->

      <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
      <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso.css" />

      <!--Font Awesome (added because you use icons in your prepend/append)-->
      <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />

      <!-- Inline CSS based on choices in "Settings" tab -->
      <style>
      .bootstrap-iso .formden_header h2,
      .bootstrap-iso .formden_header p,
      .bootstrap-iso form {
          font-family: Arial, Helvetica, sans-serif;
          color: black
      }

      .bootstrap-iso form button,
      .bootstrap-iso form button:hover {
          color: white !important;
      }

      .asteriskField {
          color: red;
      }
      </style>

      <!-- Extra JavaScript/CSS added manually in "Settings" tab -->
      <!-- Include Date Range Picker -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js">
      </script>
      <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

  </head>

  <body>

      <?php ini_set ('display_errors', 'On'); error_reporting (E_ERROR); ?>

      <?php

          require_once ("../serveur/BD/connexion.inc.php");

          $courrielMembre=$_POST['courrielMembre'];
  

          $requetteMembre = "SELECT * FROM `membres` WHERE courriel = '$courrielMembre'";
          $requetteConnexion = "SELECT * FROM `connexion` WHERE courriel = '$courrielMembre'";



          try {

              
              $trouverMembre = mysqli_query ($connexion, $requetteMembre);
              $unMembre = mysqli_fetch_object ($trouverMembre);
              $membreBD = $unMembre->courriel;

              $trouverMotPasse = mysqli_query ($connexion, $requetteConnexion);
              $uneConnexion = mysqli_fetch_object ($trouverMotPasse);
              $motPasseBD = $uneConnexion->mot_passe;


              if (!$membreBD) {
                  echo "<font size=\"3em\" color=\"red\">

                          Membre introuvable! <br><p>Vous devez vous connecter pour accéder à cette page.</p>
                          <a href=\"connexion.html\">Aller au formulaire</a>

                  </font>";
                  mysqli_close($connexion);
                  exit();
              }
        
            } catch (Exception $e) {
              echo "Probleme de connexion";
              exit();
            } 


            if( isset ($courrielMembre) ) {
              echo "    <div class=\"container\">\n";
              echo "      <div class=\"bootstrap-iso\">\n";
              echo "        <div class=\"container-fluid\">\n";
              echo "          <div class=\"row\">\n";
              echo "            <div class=\"col-md-6 col-sm-6 col-xs-12\">\n";
              echo "              <form class=\"form-horizontal\" action=\"../serveur/membres/changerMembre.php\" method=\"POST\">\n";
              echo "                <div class=\"form-group \">\n";
              echo "                  <h3>Formulaire de changement de profil </h3>\n";
              echo "                  <label class=\"control-label col-sm-2\" for=\"prenom\">\n";
              echo "                    Prénom\n";
              echo "                  </label>\n";
              echo "                  <div class=\"col-sm-10\">\n";
              echo "                    <input class=\"form-control\" id=\"prenom\" name=\"prenom\" type=\"text\" value='".$unMembre->prenom."' />\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "                <div class=\"form-group \">\n";
              echo "                  <label class=\"control-label col-sm-2\" for=\"nom\">\n";
              echo "                    Nom\n";
              echo "                  </label>\n";
              echo "                  <div class=\"col-sm-10\">\n";
              echo "                    <input class=\"form-control\" id=\"nom\" name=\"nom\" type=\"text\" value='".$unMembre->nom."' required/>\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "                <div class=\"form-group \">\n";
              echo "                  <label class=\"control-label col-sm-2 requiredField\" for=\"courriel\">\n";
              echo "                    Courriel\n";
              echo "                  </label>\n";
              echo "                  <div class=\"col-sm-10\">\n";
              echo "                    <input class=\"form-control\" id=\"courriel\" name=\"courriel\" type=\"email\" value='".$unMembre->courriel."' readonly/>\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "                <div class=\"form-group \">\n";
              echo "                  <label class=\"control-label col-sm-2\">\n";
              echo "                    Genre \n";
              echo "                  </label>\n";
              echo "                  <label class=\"col-sm-10\">\n";
              echo "                  </label>\n";
              echo "                  <div class=\"col-sm-10\">\n";
              echo "                    <div class=\"radio\">\n";
              echo "                      <label class=\"radio\">\n";
              echo "                        <input name=\"genre\" type=\"radio\" value=\"homme\" />\n";
              echo "                        Homme\n";
              echo "                      </label>\n";
              echo "                    </div>\n";
              echo "                    <div class=\"radio\">\n";
              echo "                      <label class=\"radio\">\n";
              echo "                        <input name=\"genre\" type=\"radio\" value=\"femme\" />\n";
              echo "                        Femme\n";
              echo "                      </label>\n";
              echo "                    </div>\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "                <div class=\"form-group \">\n";
              echo "                  <label class=\"control-label col-sm-2\" for=\"datepicker\">\n";
              echo "                    Date de Naissance\n";
              echo "                  </label>\n";
              echo "                  <div class=\"col-sm-10\">\n";
              echo "                    <input class=\"form-control\" id=\"datepicker\" name=\"date\" type=\"date\" value='".$unMembre->date_naissance."' required/>\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "                <div class=\"form-group \">\n";
              echo "                  <label class=\"control-label col-sm-2\" for=\"motpasse1\">\n";
              echo "                    Mot de passe\n";
              echo "                  </label>\n";
              echo "                  <div class=\"col-sm-10\">\n";              
              echo "                    <input class=\"form-control\" id=\"motpasse1\" name=\"motpasse1\" type=\"password\"   pattern=\"^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-_]).{8,10}$\" \n";
              echo "                    title=\"Tapez entre 8 et 10 caractères qui incluent des lettes minuscules, majuscules, des chiffres et les caractères '-' ou '_' \"  />\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "                <div class=\"form-group \">\n";
              echo "                  <label class=\"control-label col-sm-2\" for=\"motpasse2\">\n";
              echo "                    Conf. mot de passe\n";
              echo "                  </label>\n";
              echo "                  <div class=\"col-sm-10\">\n";
              echo "                    <input class=\"form-control\" id=\"motpasse2\" name=\"motpasse2\" type=\"password\" pattern=\"^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)(?=.*[-_]).{8,10}$\" \n";
              echo "                    title=\"Tapez entre 8 et 10 caractères qui incluent des lettes minuscules, majuscules, des chiffres et les caractères '-' ou '_' \"  />\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "                <div class=\"form-group\">\n";
              echo "                  <div class=\"col-sm-10 col-sm-offset-2\">\n";
              echo "                    <button class=\"btn btn-primary \" name=\"submit\" type=\"submit\">\n";
              echo "                      Envoyer\n";
              echo "                    </button>\n";
              echo "                  </div>\n";
              echo "                </div>\n";
              echo "              </form>\n";
              echo "            </div>\n";
              echo "          </div>\n";
              echo "        </div>\n";
              echo "      </div>\n";
              echo "    </div>";
              
              } else {
                  echo "Non Trouvé!";
              }


      ?>



  </body>

</html>