 <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<h1>Se Connecter</h1>
    <form action="traitement.php?action=login" method="POST">
        <label for="email"> Email </label>
        <input type="email" name="email" id="email"> <br>

        <label for="password"> Mot de Passe </label>
        <input type="password" name="password" id="password"> <br>
        
        <input type="submit" name="submit" value="Se Connecter">
    </form>
</body>
</html>