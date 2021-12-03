<?php
session_start();
// connexion base de donnée et requet
$user = $_SESSION['username'];
$bdd = mysqli_connect("localhost","root","root","livreor");mysqli_set_charset($bdd,"UTF8");
$requete = mysqli_query($bdd,"SELECT * FROM `utilisateurs` ");
// test 

$acc = "Bonjour : $user!"; 

// afficher message accueil utilisateur
$bdd = mysqli_fetch_all($requete, MYSQLI_ASSOC); 
if(isset($_SESSIOn['username'])){
echo $acc;
}
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
    <title>livre or index</title>
</head>
<body class="backgroundIndex">
    <header>
      <!-- /////////////nav\\\\\\\\\\\ -->

        <h1>LIVRE D'OR index</h1>
        <?php 
                if (isset($_SESSION['username'])){
               echo"<a href='?deco=true' alt='bouton deconnexion'>Deconnexion</a>";
                }
                else{
                    echo "<a href='connexion.php'>Connexion</a>"; 
                }   
                
                if (isset($_SESSION['username'])){
                    echo "<a href='profil.php'>Profil</a>";
                }
                else {
                    echo "<a href='inscription.php'>Inscription</a>";
                }

                if (isset($_SESSION['username'])){
                  echo "<a href='livre-or.php'>Livre d'or</a>";
              }
              else {}
            ?>
    </header>

    <!-- /////////////affichage message accueil utilisateur\\\\\\\\\\\ -->

    <h2><?php if(isset($_SESSION['username'])){ echo$acc;} ?></h2>

      <div class="container">
        <h3>Dans cette espace de discutions il est possible de dialoguer, donner son avis ou soummettre un probleme auquel vos etes confronté, ou bien poser vos questions existentielles.
          La communauté sera heureuse de vos repondre dans le respect et la tolerence.
        </h3>
      </div>

      <!-- /////////////footer\\\\\\\\\\\ -->

    <footer>
      <a href="https://github.com/mathieu-tatat/livre-or" class="fa fa-github" style="font-size:40px; display:flex"></a>  
      <p>&copy; 2021 livre d'or</p>
    </footer>
</body>
</html>
