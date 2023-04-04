<?php
    session_start(); //activer les sessions en PHP
    define ("SERVEUR", "localhost");
    define ("UTILISATEUR", "root");
    define ("PASSE", "");
    define ("BD", "e21bdfilms");
    $connexion = new mysqli(SERVEUR, UTILISATEUR, PASSE, BD);
    if ($connexion->connect_errno) {
        echo "Probleme de connexion au serveur de bd";
        exit();
    }
?>