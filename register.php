<?php
require_once("library.php");

if(   isset($_POST["username"]) && isset($_POST["pwd"])  ){
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $user = mysqli_real_escape_string($conn, $_POST["username"]);
    $pwd =  mysqli_real_escape_string($conn, $_POST["pwd"]);


    //lo prende dalla libreria condivisa.
    if( (controlUsername($user) == "FALSE") ||  strlen($pwd) <5){
     header("Location: finish_register.php?register=failure");
     exit();
    }
        //esegue la registrazione
    $query="INSERT INTO  USERS(USERNAME, PASSWORD, PROFILE_IMAGE, MD5_CODE) VALUES('".$user."','".crypt($pwd, 10)."', null,'".uniqid()."')";
    $res = mysqli_query($conn, $query);
    echo "redirect";
    header("Location: finish_register.php?register=success");
    exit();
  
}
?>


<html>
<head>
    <link rel="stylesheet" href="register.css">
    <script src="register.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noticia+Text&display=swap" rel="stylesheet">
</head>
<body>
    <section>
        <img id="logo" src="logo.png">
            <form id="register_form" method="post">
                <div class="row_form">
                    <label for="username">Username</label>
                    <input id="username" name=username type="text">
                </div>
                <div class="row_form">
                    <label for="pwd">Password</label>
                    <input id ="pwd" name=pwd type="password">
                </div>
                <div class="row_form">
                    <input id="check" name="check" type="checkbox" checked>
                    <label for="check">Acconsento il trattamento dei dati</label>
                </div>
                <div class="row_form">
                    <button >REGISTRA</button>
                </div>
            </form>
    </section>
</body>
</html>
