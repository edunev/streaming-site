<!DOCTYPE html>
<html lang="fr">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>IFT 1147 - TP1</title>

        <script src="utilitaires/jquery-3.6.0.min.js"></script>
        <script src="utilitaires/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="utilitaires/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="utilitaires/bootstrap.css.map">

    </head>

    <body>

        <?php
        require_once ("../serveur/BD/connexion.inc.php");

        if (!isset($_SESSION['estAdmin']) || $_SESSION['estAdmin'] == NULL){
            echo "<span><font size=\"4em\" color=\"red\">Vous devez vous connecter comme ADMIN pour accéder
            à cette page : </font></span>";
            echo "<a href=\"connexion.html\">Retour au formulaire</a>";
            exit();
            }
        ?>


        <div class="container">
            <h1>Page pour les ADMINS</h1>

            <input type='button' onclick="location.href = '../publique/membres.php';" value='Aller à la page des membres'>
            <hr>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Enregister film
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Enregistrer film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form id="formEnreg" enctype="multipart/form-data" action="../serveur/films/enregistrer.php"
                                method="POST" onSubmit="">

                                Titre : <input type="text" id="titre" name="titre"><br><br>
                                Catégorie : <select id="categ" name="categorie" class="form-select"
                                    aria-label="Default select example">
                                    <option value="choisir">Choisir ...</option>
                                    <option value="drame">drame</option>
                                    <option value="comedie">comédie</option>
                                    <option value="suspense">duspense</option>
                                    <option value="action">action</option>
                                </select> <br>
                                Durée : <input type="number" id="duree" name="duree"><br><br>
                                Realisateur : <input type="text" id="realisateur" name="realisateur"><br><br>
                                Pochette : <input type="file" id="pochette" name="pochette"
                                    class="btn btn-secondary popover-test"><br><br>
                                Hyperlien : <input type="text" id="lien" name="lien"> <br><br>
                                Date : <input type="date" id="date" name="date"> <br><br>
                                Langue : <input type="text" id="langue" name="langue"> <br><br>

                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#listerModal">
                Lister films
            </button>

            <!-- Modal -->
            <div class="modal fade" id="listerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="listerModalLabel">Lister films : &nbsp;&nbsp; </h5>

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">

                            <form id="tout" enctype="multipart/form-data" action="../serveur/films/lister.php" method="POST"
                                onSubmit="">
                                <input type="hidden" id="montrerTout" name="montrerTout" value="ORDER BY date DESC">
                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                                <button type="submit" class="btn btn-primary">Lieter Tous (les plus récent en
                                    premier)</button>
                            </form>

                            <form id="parCategorie" enctype="multipart/form-data" action="../serveur/films/lister.php"
                                method="POST" onSubmit="">
                                <!-- <input type="hidden" id="montrerCat" name="montrerCat" value="ORDER BY categorie ASC" > -->

                                <br>Lister par catégorie : &nbsp; <select class="btn btn-primary" id="categLister"
                                    name="categorie"  aria-label="Default select example"
                                    onchange="this.form.submit()">
                                    <option value="choisir">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                                    <option value="WHERE categorie = 'drame'">drame</option>
                                    <option value="WHERE categorie = 'comedie'">comédie</option>
                                    <option value="WHERE categorie = 'suspense'">suspense</option>
                                    <option value="WHERE categorie = 'action'">action</option>
                                </select>

                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                                <!--  &nbsp; ou &nbsp;<button type="submit" class="btn btn-primary">Par catégorie </button> -->
                            </form>


                            <form id="titreRealisateur" enctype="multipart/form-data" action="../serveur/films/lister.php"
                                method="POST" onSubmit="">
                                <hr>Chercher par titre : <input type="text" id="chercherTitre" name="chercherTitre"><br><br>
                                Chercher par réalisateur : <input type="text" id="chercherRealisateur"
                                    name="chercherRealisateur"><br><br>

                                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                                <button type="submit" class="btn btn-primary">Chercher </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modifierModal">
                Modifier film
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modifierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modifierModalLabel">Modifier film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form id="formMod" enctype="multipart/form-data" action="../serveur/films/fiche.php"
                                method="POST" onSubmit="">

                                Numéro identificateur du film à modifier : <input type="text" id="numEnlever"
                                    name="num"><br><br>

                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                                    <button type="submit" class="btn btn-primary">Prochain</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#enleverModal">
                Enlever film
            </button>

            <!-- Modal -->
            <div class="modal fade" id="enleverModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="enleverModalLabel">Enlever film</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <form id="formEnl" enctype="multipart/form-data" action="../serveur/films/enlever.php"
                                method="POST" onSubmit="">

                                Numéro identificateur du film à enlever : <input type="text" id="num" name="num"><br><br>

                                <div class="modal-footer">
                                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button> -->
                                    <button type="submit" class="btn btn-primary">Envoyer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <br>
            <br>


            <!-- Button trigger modal -->
            <form id="toutMembres" enctype="multipart/form-data" action="../serveur/membres/gestionMembres.php" method="POST"
                onSubmit="">

                <button type="submit" class="btn btn-info"> &nbsp;Lister tous les membres (avec l'option pour changer
                    statut)&nbsp;&nbsp;&nbsp;&nbsp;</button>

            </form>


        </div>
    </body>

</html>