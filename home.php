<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <?php

    //Vérifie l'existence d'une variable
    //Si CONNECTE alors afficher lien Se Déconnecter
    	if(isset($_SESSION["user"])) { ?>
    		<a href="traitement.php?action=logout">Se Déconnecter</a>
    		<a href="traitement.php?action=profil">Mon Profil</a>
    	<?php } else { ?>
    		<a href="traitement.php?action=login">Se Connecter</a>
    		<a href="traitement.php?action=register">S'Inscrire</a>
    	<?php } ?>
    
<h1>Accueil</h1>


    <?php 
    	if(isset($_SESSION["user"])){
    		//Si CONNEXION msg affichage qui récupére le pseudo dans la table user dans la BDD
    		echo "<p>Bienvenue ".$_SESSION["user"]["pseudo"]."</p>";
    	}

    ?>

   
</body>
</html>