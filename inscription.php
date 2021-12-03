<?php
session_start();

// connexion à la base de données
$bdd = mysqli_connect("localhost:3306","root66","root66","mathieu-tatat_livre-or");mysqli_set_charset($bdd,"UTF8");
$login = $_POST['username'];  
$password = $_POST['password'];
$confirmation = $_POST['confirmation']; 

// messages d'erreur
$error = "mots de passe differents";
$error2 = "login indisponible";

// Créer tableau utilisateurs
$sql = mysqli_query($bdd,"SELECT * FROM `utilisateurs`");
$users = mysqli_fetch_all($sql);

    if (isset($login)  && isset($password)  && isset($confirmation) ){
        $login = $_POST['username'];  
        $password = $_POST['password'];
        $confirmation = $_POST['confirmation'];

            // comparaison login et BDD entré par user 
            foreach($users as $user){ 
                if (isset($_POST["username"]) && $login == $user[1] ){
                    $taken = true;
                }
            }

             ///////////// requete pour envoyer les infos dans la bdd\\\\\\\\\\\ -->
             if($password == $confirmation && $taken == false){
                 $req = mysqli_query($bdd,"INSERT INTO utilisateurs(login, password) VALUES ('$login','$password')");
                 header('Location: connexion.php');
            }
             else{}
               
        }
?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="livre-or.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@1,200&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet">
  <title>livre or inscription</title>
</head>
<body class="backgroundIndex">

    <!-- /////////////Nav\\\\\\\\\\\ -->

    <header>
        <h1>LIVRE D'OR Inscription</h1>
        <a href="index.php">Index</a>
    </header>
    
        <div class="container">

            <!-- /////////////formulaire d'inscription\\\\\\\\\\\ -->
            <form action="" method="post">
                <div class="formInput">
                    <label for="username">Username :</label>
                    <input type="text" placeholder="Entrer un nom d'utilisateur" name="username"required>
                </div>

                <div class="formInput">
                    <label for="password">Password :</label>
                    <input type="text" placeholder="Choisir un mot de passe" name="password" required>
                </div>

                <div class="formInput">
                    <label for="confirmation">Confirmation :</label>
                    <input type="text"  placeholder="Confirmer votre mot de passe" name="confirmation" required>
                </div>

                <div class="button" class="formInput">
                    <button type="submit">Soumettre</button>
                </div>
            </form>

       
        </div>

<!-- /////////////footer\\\\\\\\\\\ -->

    <footer>
        <a href="https://github.com/mathieu-tatat/livre-or" class="fa fa-github" style="font-size:40px; display:flex"></a>  
        <p>&copy; 2021 livre d'or</p>
    </footer>

</body>
</html>
