<?php
require_once("library.php");
session_start();

if(isset($_POST["img_link"])){
    change_img_profile($_SESSION["auth_code"],$_POST["img_link"]);
    $_SESSION["img_link"] = $_POST["img_link"];
    $_COOKIE["img_link"] = $_POST["img_link"];

}


if(isset($_POST["logout"])){

    setcookie("username","", time()-3600);
    setcookie("img_link","", time()-3600);
    session_destroy();
    header("Location: index.php");
    exit();
}

if(!isset($_SESSION["username"])){
    header("Location: index.php ");
    exit();
}
else{
    //In questo caso esiste la sessione 
  
    
}

?>

<html>
<head>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="profile.css">
    <script src="profile.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noticia+Text&display=swap" rel="stylesheet">
   
</head>
<body>
            <div id="pop_up" class="hidden">
                <h1> ✅ </h1>
                <h1>LA PASSWORD E' STATA CAMBIATA CON SUCCESSO</h1>

            </div>

    <nav>
            <div class="options">
                <a  href="bacheca.php"> BACHECA</a>
                <a  href="control_panel.php" > PANNELLO DI CONTROLLO</a>
            </div>  
            <div class="profile_info">
                <img src="<?php echo $_SESSION["img_link"] ?>">
                <a href="profile.php"> <?php echo $_SESSION["username"] ?>   </a>
                
                
            </div>
    </nav>
   

    <section>
        <div class="container">
            <div class="box">
                <div>
                    <div class="containerimg">
                        <img id="profileimg" src=" <?php echo $_SESSION["img_link"] ?> ">
                    </div>
                </div>
                <div>
                    <p>Username:<?php echo $_SESSION["username"] ?></p>
                    <form method="POST">
                         <button name="logout" id="logout" > logout </a>
                      </form>
                </div>
            </div>
            <form method ="post">
                 <input name ="img_link" type="button" id="img_profile_widget" value="Cambia immagine profilo"></input>
            </form>
            <div class="password_changer_container">
                <button id="reimposta_password" >Reimposta password</button>
                <div id="sub_window" class="hidden">
                    <div class="row">
                        <label for="old_password">Vecchia password</label>
                        <input id="old_password">
                    </div>
                    <div class="row">
                        <label for="new_password">Nuova password </label>
                        <input id="new_password">
                    </div>
                    <button id="button_changer" > Cambia </button>
                </div>
            </div>
    </div>

    </section>
    <p id="auth_code" hidden><?php echo $_SESSION["auth_code"] ?> </p>

</body>
</html>