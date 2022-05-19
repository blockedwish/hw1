<?php
session_start();

?>

<html>
<head>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="control_panel.css">
    <script src="control_panel.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noticia+Text&display=swap" rel="stylesheet">
</head>
<body>

    <nav>
            <div class="options">
                <a  href="bacheca.php"> BACHECA</a>
                <a  href="control_panel.php"> PANNELLO DI CONTROLLO</a>
            </div>  
            <div class="profile_info">
                <img src="<?php echo $_SESSION["img_link"] ?>">
                <a href="profile.php"> <?php echo $_SESSION["username"] ?>   </a>
                
                
            </div>
    </nav>

    <section>
    <table>
        <tr>
            <th>Nome pianta in asta</th>
            <th>Prezzo corrente</th>
            <th>Follower</th>
        </tr>

</table>
    </section>
    <p id="auth_code" hidden><?php echo $_SESSION["auth_code"] ?> </p>

</body>
</html>