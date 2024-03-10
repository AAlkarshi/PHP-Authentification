<?php

//Permet de Stocker des données pour chaque utilisateur en utilisant un identifiant de session
session_start();

$password = "lemdp";

//Algorithme de hashage FAIBLE
$md5 = hash("md5" , $password);
//echo $md5 . "<br>";

//Algorithme de hashage FORT le MDP crypté change à chaque refresh
$mdpCrypteFort = password_hash($password, PASSWORD_DEFAULT);
//echo $mdpCrypteFort. "<br>";

// saisi dans le formulaire
$saisie = "lemdp";

//Vérification du mdp
$check = password_verify($saisie, $mdpCrypteFort);

// Variable UTILISATEUR
$utilisateur = "Abdullrahman";

//Boucle permettant de vérifier si la variable $saisie est IDENTIQUE à la variable $password
// et affiche des commentaires selon cette condition
if(password_verify($saisie, $mdpCrypteFort)){
     $_SESSION["utilisateur"] = $utilisateur;
    echo $utilisateur . " est connecté !";
} else {
    echo "Les mots de passes ne sont pas identiques ! ";
}




// Redirection des l'ouverture du projet vers home.php
header("Location: home.php");
exit;


?>












