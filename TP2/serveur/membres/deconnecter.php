
<!DOCTYPE html>
<html lang="fr">

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IFT 1147 - TP1</title>

    </head>

    <body>
        <?php

        session_start(); //activer les sessions
        session_destroy();

        echo "<br><span><font size=\"4.5em\" color=\"green\">Vous êtes DÉCONNECTÉ </font></span>";
        echo "<br><br><a href=\"../../publique/membres.php\">Retour à la page des membres</a>";
        exit();
        //header("Location: ../../index.html", true, 301);

        ?>
    </body>
</html>