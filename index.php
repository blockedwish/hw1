<?php 
session_start();
if(isset($_COOKIE["username"])){
    //Nel caso in cui l'utente vuole entrare nella pagina prima dei 30m che scade
    //il cookie senza inserire username e password. 
    //In questo caso, trovato il cookie valido, il codice gli crea una sessione valida.
    if(!isset($_SESSION["username"])){
        $_SESSION["username"]=$_COOKIE["username"];
        $_SESSION["img_link"]=$_COOKIE["img_link"]; 
    }
    header("Location: bacheca.php");
    exit;

}

if (  isset($_POST["username"]) && isset($_POST["pwd"])  ){
    //Allora se e' stata eseguita una richiesta post, dobbiamo controllare se esiste nel db questo user.
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $user = mysqli_real_escape_string($conn, $_POST["username"]);
    $pwd =  mysqli_real_escape_string($conn, $_POST["pwd"]);
    $query="SELECT * FROM USERS WHERE USERNAME='".$user."' AND  PASSWORD='".crypt($pwd, 10) ."'";
    

    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res)==1){ //Perche non ci possono essere due utenti con lo stesso username.
        //una volta dentro settiamo il cookie in modo da mantenere l'accesso attivo 
        $img_link ="";
        $result = mysqli_fetch_assoc($res);
        if(strlen($result["PROFILE_IMAGE"])<3){
            $img_link ="profile.jpeg";
        }
        else{
            $img_link = $result["PROFILE_IMAGE"];
        }
       
        mysqli_free_result($res);
        mysqli_close($conn);
        setcookie("username",$user, time()+1800); //Quindi dura mezz'ora dopo la data di creazione.
        setcookie("img_link", $img_link,  time()+1800);
        setcookie("auth_code", $result["MD5_CODE"]);

        $_SESSION["username"]=$user ;
        $_SESSION["img_link"]=$img_link;
        $_SESSION["auth_code"] = $result["MD5_CODE"];
        header("Location: bacheca.php");
        exit;

    }
    header("Location: index.php ");
    exit;
}

?>
<html>
    <head>
        <title>PLANT COMMUNITY</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="index.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <script src="login.js" defer></script>
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noticia+Text&display=swap" rel="stylesheet">
    </head>
    <body>
        <section>
            <div>
                <img src="logo.png" id="logo">
            </div>

            <div class="login_container">
                <form id="login_form" method="post">
                    <div class="form_row">
                        <label for="username_textbox">Username</label>
                        <input id="username_textbox" name="username" type="text">
                    </div>
                    <div class="form_row">
                        <label for="password_textbox">Password</label>
                        <input id="pwd_textbox" name="pwd" type="password">
                    </div>
                    <a href="register.php">Non ho un account, voglio registrarmi </a>
                    <button >ENTRA</button>
                </form>
                
            </div>
        </section>
    </body>
</html>