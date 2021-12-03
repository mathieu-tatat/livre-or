<?php
session_start();

$profil = $_SESSION['username'];
$bdd = mysqli_fetch_all($requete, MYSQLI_ASSOC); 

/////////////deconnexion\\\\\\\\\\\ 
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
    <title>livre or </title>
</head>
<body class="backgroundIndex">

    <!-- /////////////nav\\\\\\\\\\\ -->
    <header>
        <h1>LIVRE D'OR </h1>
        <a href="index.php">Index</a>
        <a href="profil.php">Profil</a>
        <a href="commentaire.php">Commentaire</a>
        <?php 
                if (isset($_SESSION['username'])){
               echo"<a href='?deco=true' alt='bouton deconnexion'>Deconnexion</a>";
                }?>
    </header>



        <div class="containerLO">
            <?php  
                $bdd = mysqli_connect("localhost:3306","root66","root66","mathieu-tatat_livre-or");mysqli_set_charset($bdd,"UTF8");
                $req = mysqli_query($bdd,"SELECT utilisateurs.login, commentaires.commentaire, commentaires.date FROM utilisateurs INNER JOIN commentaires ON utilisateurs.id = commentaires.id_utilisateur ");
                $coms = mysqli_fetch_all($req);
            ?>   

<!-- /////////////Tableau du chat\\\\\\\\\\\ -->             
    <table>
        <tr>
        <th class = "title">commentaires:</th>
        <th class = "title">De:</th>
        <th class = "title">Posté le :</th></tr>

<!-- /////////////conditions affichage commentaires, noms, dates \\\\\\\\\\\ -->
        <?php foreach($coms as $com){
            echo "<tr><th class = 'com' >$com[1]</th>";
            echo "<th class = 'name'>$com[0]</th>";
            echo "<th class = 'date'>$com[2]</th> </tr>";
            }
        ?>
    </table>

<!-- /////////////footer\\\\\\\\\\\ -->
        </div>
    <footer>
        <a href="https://github.com/mathieu-tatat/livre-or" class="fa fa-github" style="font-size:40px; display:flex"></a>  
        <p>&copy; 2021 livre d'or</p>
    </footer>

</body>
</html>
