<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="utf-8">
        <meta name="Non disponibleport" content="width=device-width, initial-scale=1">

        <title>IFT 1147 - TP1</title>

        <script src="utilitaires/jquery-3.6.0.min.js"></script>
        <script src="utilitaires/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="utilitaires/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="utilitaires/bootstrap.css.map">


        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
            integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <!-- FontAwesome -->
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
            integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
        </script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
        </script>


        <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
        </style>
    </head>

    <body>
        <?php 
                ini_set ('display_errors', 'On'); error_reporting (E_ERROR);
                require_once ("../serveur/BD/connexion.inc.php");

                if (!isset($_SESSION['utilisateur']) || $_SESSION['utilisateur'] == NULL){
                    echo "<p>Vous devez vous connecter pour accéder
                    à cette page</p>";
                    echo "<a href=\"connexion.html\">Retour au formulaire</a>";
                    //exit();
                    } 

                $utilisateur = $_SESSION['utilisateur'];
                $prenom = $_SESSION['prenom'];
                $nom = $_SESSION['nom'];

                $date = strtotime("+7 day");  //L'ennoncé du TP indique 7 jours de location.
                $dateFin = date("Y-m-d", $date);
            
                $filtre = "WHERE `courriel` = '$utilisateur' ";
            
                $requetteLoc = "SELECT * FROM `location_payment`" . $filtre;
                $compteur = 0;

            
                $listerLoc = mysqli_query ($connexion, $requetteLoc);
                while ($ligne = mysqli_fetch_object($listerLoc)){

                        $date = date_create($ligne->date_location);
                        date_add($date, date_interval_create_from_date_string('7 days'));
                        $dataPlus = date_format($date, 'Y-m-d');
                
                        if(date("Y-m-d") <= $dataPlus){
                
                        $compteur++;	
                        
                        }
                }

            ?>

        <header>
            <div class="collapse bg-dark" id="navbarHeader">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-md-7 py-4">
                            <h4 class="text-white"><?php echo $prenom ." ". $nom; ?> </h4>
                            <p class="text-muted">
                                <?php if (isset ($utilisateur)) echo "Vous êtes connecté avec le courriel : <br>" . $utilisateur; ?>
                            </p>
                        </div>
                        <div class="col-sm-4 offset-md-1 py-4">
                            <p class="text-white">
                            <form action='../serveur/membres/deconnecter.php' method='POST'>
                                <button type='submit'><?php if (isset ($utilisateur)) echo " Déconnecter &nbsp;" ?></button>
                            </form>

                            <ul class="list-unstyled">
                                <li><a href="#" class="text-white"></a>
                                    <form action='profil.php' method='POST'>
                                        <input type="hidden" id="courrielMembre" name="courrielMembre"
                                            value=<?php echo $utilisateur ?>>
                                        <button type='submit'>Modifier Profil</button>
                                    </form>
                                </li>
                                <li>
                                    <div id="cart" class="d-none">

                                    </div>
                                    <br><a href="../serveur/films/panier.php" class="cart position-relative d-inline-flex"
                                        aria-label="View your shopping cart">
                                        <i class="fas fa fa-shopping-cart fa-lg"></i>
                                        <span class="cart-basket d-flex align-items-center justify-content-center">
                                            <?php echo $compteur ?> </span>
                                        <p class="text-white"> &nbsp;&nbsp;Aller au panier</p>

                                    </a>
                                </li>
                                <!-- <button id="sidenav-open-btn" class="menu-hamburger position-absolute pointer p-0">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    </button> -->

                                <!--  <li><a href="#" class="text-white">En construction</a></li> -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="navbar navbar-dark bg-dark shadow-sm">
                <div class="container">
                    <a href="#" class="navbar-brand d-flex align-items-center">
                        <img src="img/logo.png" alt="Logo">
                        <strong>Service de diffusion des films</strong>
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader"
                        aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
            </div>
        </header>

        <main>

            <!--<<section class="py-5 text-center container">
                <div class="row py-lg-5">
                <div class="col-lg-6 col-md-8 mx-auto">
                    <p>
                    <a href="publique/connexion.html" class="btn btn-primary my-2">Deconnexion</a>
                    <a href="publique/inscription.html" class="btn btn-secondary my-2">Devenir Membre</a>
                    </p>
                    h2 class="fw-light">Aperçu du Catalogue :</h2>
                    <p class="lead text-muted"></p>

                </div>
                </div>

                </section>-->

            <div class="album py-5 bg-light">
                <div class="container">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">

                        <?php

                            $requetteFilm="SELECT * FROM `films` ORDER BY `date` DESC";
                            $requettePrix="SELECT prix FROM `location_payment`";


                            try{
                                
                                $rep="";
                                $listeFilms = mysqli_query ($connexion, $requetteFilm);
                                while ($ligne = mysqli_fetch_object($listeFilms)){
                                    $i++;


                            if (substr($ligne->date, 0, 5) > 2010)
                                    $prix = 4.99;
                                        else if (substr($ligne->date, 0, 5) > 1990)
                                        $prix = 3.99;
                                        else
                                        $prix = 2.99;

                                $rep.= "                    <div class=\"col\">\n";
                                $rep.= "                        <div class=\"card shadow-sm\">\n";
                                $rep.= "\n";
                                $rep.= "                            <img src=\"../serveur/ressources/pochettes/".($ligne->pochette)."\" alt=\"film\">\n";
                                $rep.= "\n";
                                $rep.= "                            <div class=\"card-body\">\n";
                                $rep.= "                                <p> Titre : ".$ligne->titre." (<font size=\"4em\" color=\"red\">".$ligne->categorie."</font>)</p>\n";
                                $rep.= "                                <p> Date : ".$ligne->date." (".$ligne->langue.")</p>\n";
                                $rep.= "                                <p> Réalisateur(trice) : ".$ligne->realisateur."</p>\n";
                                $rep.= "                                <p> Prix location : $".$prix." (7 jours)</p> \n";
                                $rep.= "                                <div class=\"d-flex justify-content-between align-items-center\">\n";
                                $rep.= "                                    <div class=\"btn-group\">\n";
                                $rep.= "                                       <a  class='btn btn-sm btn-outline-secondary' href='$ligne->lien' target='_blank'> Bande-annonce &#127909; </a>\n";
                                $rep.= "                                      
                                                                                    <form action='../serveur/films/ajouterPanier.php' method='POST'> 
                                                                                    <input type='hidden' id='location' name='location' value='$ligne->id_film'>
                                                                                    <input type='hidden' id='prix' name='prix' value='$prix'>
                                                                                    <input type='hidden' id='nomFil' name='nomFil' value='$ligne->titre'>
                                                                                    <button class='btn btn-sm btn-outline-secondary' type='submit'>  Ajouter &#128722; </button></form>";
                                $rep.= "                                    </div>\n";
                                $rep.= "                                    <small class=\"text-muted\"> ".$ligne->duree." min</small>\n";
                                $rep.= "                                </div>\n";
                                $rep.= "                            </div>\n";
                                $rep.= "                        </div>\n";
                                $rep.= "                    </div>";
                            }

                            mysqli_free_result($listeFilms);
                            }catch (Exception $e){

                            echo "Probleme pour lister";

                            }finally {

                            //$rep.="</table>";
                            echo $rep;

                            }
                            mysqli_close($connexion);

                        ?>

                    </div>
                </div>
            </div>

        </main>

        <footer class="text-muted py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#">Aller vers le haut</a>
                </p>
                <p class="mb-1"> </p>

            </div>
        </footer>
    </body>

</html>