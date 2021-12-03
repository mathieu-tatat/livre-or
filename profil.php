<?php 
session_start();

/*  ///////// connexion base de donées et requètes  \\\\\\\\  */
$bdd = mysqli_connect("localhost:3306","root66","root66","mathieu-tatat_livre-or");mysqli_set_charset($bdd,"UTF8");
$requete = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login = '$user'");
$result = mysqli_fetch_all($requete,MYSQLI_ASSOC);
$user = $_SESSION['username'];

    /*  ///////// mes varriables   \\\\\\\\  */
$login = $result[0]['username'];  
$password = $result[0]['password'];
$confirmation = $result[0]['confirmation'];
$accId = "$user! veux-tu changer tes identifiants? ";  

    /*  ///////// conditions des changements des infos utilisateurs  \\\\\\\\  */
if(isset($_POST['envoyer'])){
    $newusername = $_POST['username'];
    $newpassword = $_POST['password'];
    $newconfirmation = $_POST['confirmation'];

    if (isset($_POST['password']) && isset($_POST['confirmation'])){
        if($newpassword == $newconfirmation){
            $req = mysqli_query($bdd,"UPDATE `utilisateurs` SET password = '$newpassword' WHERE login = '$user'" );
        }
    }

   if (isset($_POST['username']) && $_POST['username'] != $result['username']){   
    $login = $_POST['username'];
    $newusername = mysqli_query($bdd,"UPDATE `utilisateurs` SET login = '$login' WHERE login ='$user' ");
    $_SESSION['username'] = $login;
    header('location: profil.php');
    }
}


//message acccueil utilisateur//
    if(isset($_SESSION['username'])){ 
    echo $acc;
    }

    /*  ///////// Deconnexion  \\\\\\\\  */
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
  <title>livre or profil</title>
</head>
<body class="backgroundIndex">
    <!-- /////////////Nav\\\\\\\\\\\ -->

    <header>
        <h1>LIVRE D'OR Profil</h1>
        <a href="index.php">Index</a>
        
         <?php 
                if (isset($_SESSION['username'])){
               echo"<a href='?deco=true' alt='bouton deconnexion'>Deconnexion</a>";
                }
                else{
                    echo "<a href='connexion.php'>Connection</a>"; 
                }   
                
                if (isset($_SESSION['username'])){
                    echo "<a href='livre-or.php'>Livre d'or</a>";
                }
                else {
                    echo "<a href='inscription.php'>Inscription</a>";
                }
                ?>
    </header>
    <!-- /////////////massage accueil utilisateur\\\\\\\\\\\ -->

        <h2><?php if(isset($_SESSION['username'])){ echo $accId;} ?></h2>
        <div class="container">

            <form action="" method="post">
                    <div class="formInput">
                        <label for="username">Username :</label>
                        <input type="text"   value= "<?php echo $user ;  ?>" name="username"required>
                    </div>

                    <div class="formInput">
                        <label for="password">Password :</label>
                        <input type="text" value="<?php echo $password ?>" name="password"required>
                    </div>

                    <div class="formInput">
                        <label for="confirmation">Confirmation :</label>
                        <input type="text" placeholder="Confirmation new password" name="confirmation"required>
                    </div>

                    <div class="button" class="formInput">
                        <button type="submit" name="envoyer">Soumettre</button>
                    </div>
                </form>
        </div>
<!-- /////////////footer de connexion\\\\\\\\\\\ -->

    <footer>
        <a href="https://github.com/mathieu-tatat/livre-or" class="fa fa-github" style="font-size:40px; display:flex"></a>  
        <p>&copy; 2021 livre d'or</p>
    </footer>

</body>
</html>
