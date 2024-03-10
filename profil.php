 <?php session_start(); ?>

 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Mon Profil</h1>

    <?php
    //Si User est connecté
    if (isset($_SESSION["user"])) { 
        $InfosSession = $_SESSION["user"]; 
    }
        
    ?>

<!-- Affiche des infos du compte concernant le pseudo et le mail-->
   <p> Pseudo : <?= $InfosSession["pseudo"] ?> </p>
   <p> Email : <?= $InfosSession["email"] ?> </p>
</body>
</html>