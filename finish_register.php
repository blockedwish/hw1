<?php
$array = array("success" => "Registrazione avvenuta con successo", 
            "failure" =>"Si e' verificato un problema nella registazione, riprova.");
if(!isset($_GET["register"])){
    header("Location: register.php");
}



?>

<html>
<head>
<link rel="stylesheet" href="finish_register.css">
</head>
<body class=" <?php echo  $_GET["register"]   ?>">
<h1> <?php echo $array[$_GET["register"]]; ?> </h1>
<a href="index.php">Vai alla Login page</a>
</body>

</html>