<?php
session_start();

 /////////////connexion base de donné et requetes\\\\\\\\\\\ 
  $user = $_SESSION['username'];
  $bdd = mysqli_connect("localhost:3306","root66","root66","mathieu-tatat_livre-or");mysqli_set_charset($bdd,"UTF8");
  $requete = mysqli_query($bdd,"SELECT * FROM `utilisateurs` ");
  $bd = mysqli_fetch_all($requete, MYSQLI_ASSOC); 

  /////////////variable message acceuil\\\\\\\\\\\ -->
  $mescom = "Ajoute içi ton commentaire $user!:"; 


/////////////deconnexion\\\\\\\\\\\ -->

    if(isset($_GET['deco']))
    { 
    session_destroy();
    header("location: index.php");
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
  <title>livre or commentaire</title>
</head>
<body class="backgroundIndex">

  <!-- /////////////nav\\\\\\\\\\\ -->

    <header>
        <h1>LIVRE D'OR Commentaire</h1> 
        
        <a href="index.php">Index</a>
        <a href="profil.php">Profil</a>
        <a href="livre-or.php">Livre D'or</a>
        <?php 
          if (isset($_SESSION['username'])){
          echo"<a href='?deco=true' alt='bouton deconnexion'>Deconnexion</a>";
          }
        ?>
    </header>
    <?php

/////////////message pour entrer un commentaire \\\\\\\\\\\ -->
        if(isset($_SESSION['username'])){
        echo "<h2>$mescom</h2>";
        }

/////////////nouvelle requete + connexion via ID de l'utilisateur\\\\\\\\\\\ -->
        $user = $_SESSION['username'];
        $req = mysqli_query($bdd,"SELECT * FROM `utilisateurs` WHERE `login` = '$user'") ;
        $res = mysqli_fetch_all($req, MYSQLI_ASSOC);
        $_SESSION['userid']= $res[0]['id'];
        $id_user = $_SESSION['userid'];
        $com = $_POST["com"];
        $date = date('d-m-Y');
        
      /////////////condition affichage commentaire et redirection vers livre-or\\\\\\\\\\\ -->
      
        if (empty($_POST["com"])){
          echo"<p>champs vide</p>";
          }
          else{
            $sql = mysqli_query($bdd,"INSERT INTO commentaires (commentaire, id_utilisateur, date) VALUES ('$com', '$id_user', NOW())");
            header("Location:livre-or.php");
          } 
?>

<!-- /////////////formulaire pour poster un commentaire\\\\\\\\\\\ -->
        <div class="container">
        <form action="" method="post">

                    <div>
                        <textarea name="com" rows="" cols="" style="width: -moz-available; height:110px"></textarea required><br />
                    </div>
       
                    <div class="button">
                        <button type="submit" name="envoyer">Soumettre</button>
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