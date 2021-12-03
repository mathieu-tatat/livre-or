<?php   
    session_start();

        /*  ///////// connexion base de donées et requètes  \\\\\\\\  */
    $bdd = mysqli_connect("localhost:3306","root66","root66","mathieu-tatat_livre-or");mysqli_set_charset($bdd,"UTF8");
    $sql = mysqli_query($bdd,"SELECT * FROM `utilisateurs`");
    $users = mysqli_fetch_all($sql);

    /*  ///////// test login et password  \\\\\\\\  */
    if(isset($_POST['username']) && isset($_POST['password'])){
       $login = $_POST['username'];
       $password = $_POST['password'];
       
    if($login != NULL && $password != NULL){
        $exec_requete = mysqli_query($bdd,"SELECT * FROM utilisateurs WHERE login = '$login' && password = '$password' ");
        $reponse = mysqli_fetch_all($exec_requete);
        $count = count($reponse);
        if ($count == 0 ){
            echo "unsername incorrect";} 
             else{
             $_SESSION['username'] = $login ;
                header('Location: profil.php');}    
            }
        } 
    

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="livre-or.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@1,200&family=Yanone+Kaffeesatz&display=swap" rel="stylesheet"> 
  <title>livre or connexion</title>
</head>
<body class="backgroundIndex">
    <!-- /////////////NAV\\\\\\\\\\\ -->

    <header>
        <h1>LIVRE D'OR Connexion</h1>
        <a href="Index.php">Index</a>
    </header>
<!-- /////////////formulaire de connexion\\\\\\\\\\\ -->
        <div class="container">
            <form action="" method="post">
                <div class="formInput">
                    <label for="username">Username :</label>
                    <input type="text" id="login" name="username">
                </div>

                <div class="formInput">
                    <label for="password">Password :</label>
                    <input type="text" id="password" name="password">
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
