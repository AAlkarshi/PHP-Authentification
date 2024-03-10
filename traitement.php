<?php

session_start();

if(isset($_GET["action"])) {
     //CAS PAR CAS
    switch($_GET["action"]) {
        //ACTION inscription du FORM page register.php
        case "register":

            if($_POST["submit"]) {
                //Connexion BDD
                $pdo = new PDO("mysql:host=localhost;dbname=phpbash;charset=utf8","root","");

                //Filtrer les Data
                $pseudo = filter_input(INPUT_POST, "pseudo", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);
                $pass1 = filter_input(INPUT_POST, "pass1", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $pass2 = filter_input(INPUT_POST, "pass2", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($pseudo && $email && $pass1 && $pass2) {
                    //Requete Preparé utilise un champ parametré : 
                    $requeteprepare = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                    // tableau de parametre dans une requete preparé
                    $requeteprepare->execute(["email" => $email]);
                    $user = $requeteprepare->fetch();

                    //Si User existe alors redirection
                    if ($user) {
                        header("Location: register.php"); 
                        exit;
                    }
                    else {
                        // Vérifie si mdp1 est identique à mdp2 et que la longueur est supérieur ou = à 5
                        if($pass1 == $pass2 && strlen($pass1) >= 5 ) {
                            $insertionUtilisateur = $pdo->prepare
                            ("INSERT INTO user (pseudo,email,password) VALUES (:pseudo, :email, :password)");
                            
                            $insertionUtilisateur->execute([
                                "pseudo" => $pseudo,
                                "email" => $email,

                                //HASHER avec password_hash(VARIABLE,PASSWORD_DEFAULT)
                                "password" => password_hash($pass1, PASSWORD_DEFAULT)
                            ]);
                            //Redirection à la page Connexion
                            header("Location: login.php");
                            exit;
                        }
                        else {
                           echo "Les Mots de passes ne sont pas identiques !"; 
                        }
                    }
                }
            }
            //Redirection à la page Inscription
            header("Location: register.php");
            exit;
        break;
            

        //Cas de Connexion
        case "login":
        if($_POST["submit"]) {
            $pdo = new PDO("mysql:host=localhost;dbname=phpbash;charset=utf8","root","");

            //Filtrer les input email et mdp dans page login.php 
            $email = filter_input(INPUT_POST,"email",FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST,"password",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            //Si Filtres sont valides
            if($email && $password) {
                $requete = $pdo->prepare("SELECT * FROM user WHERE email = :email");
                $requete->execute(["email" => $email]);

                // Recupere tt les infos de la table user 
                $user = $requete->fetch();

                //Si USER existe alors
                if($user){
                    //Recupere MDP de la BDD
                    $hash = $user["password"];

                    //Vérifie MDP est identique à celui ds la BDD
                    if(password_verify($password,$hash)) {
                        //Si OUI alors USER se connecte et redirection
                        $_SESSION["user"] = $user;
                        header("Location: home.php");
                        exit;
                    } 
                    //SINON NON et redirection vers page Connexion
                    else{
                        header("Location: login.php");
                        echo "Mot de passe Incorrect ! ";
                        exit;
                    }
                }
                else {
                    header("Location: login.php");
                    exit;
                }
            }


        }

            header("Location: login.php");
        exit;
        break;

        //Cas profil cliqué alors affiche infos ds page profil.php
        case "profil":
            header("Location: profil.php");
        exit;
        break;

       

        //Déconnexion
        case "logout":
        //unset permet de supprimer un élement dans le tableau ici la session user qui est connecté afin de le déconnecter
            unset($_SESSION["user"]);
            header("Location: home.php"); 
    
            exit;
        break;
        
    }
}

?>