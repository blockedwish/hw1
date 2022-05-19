
<?php
session_start();



?>

<html>
<head>
    <title>Bacheca </title>
    <link rel="stylesheet" href="nav.css">
    <link rel="stylesheet" href="bacheca.css">
   <script src="bacheca.js" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Noticia+Text&display=swap" rel="stylesheet">
  

</head>
<body>
    <nav>
        <div class="options">
            <a  href="bacheca.php"> BACHECA</a>
            <a href="control_panel.php"> PANNELLO DI CONTROLLO</a>
            
        </div>  
        <div class="profile_info">
            <img src="<?php echo $_SESSION["img_link"] ?>">
            <a href="profile.php"> <?php echo $_SESSION["username"] ?>   </a>
        </div>
        
    </nav>
    <form id="form_search" >
        <div class="center_flex">
            <label for="text_filtro">Filtra per autore</label>
            <input id="text_filtro" type="textbox">
            <button >Cerca</button>
        </div>
    </form>

    <div class="center_flex column_direction ">
        <div >
            <input id="onoff_bookmark" type="checkbox">
            <label for="onoff_bookmark">Mostra solo preferiti</label>
        
        </div>
        <button id="add_button"></button>
        <div id="contenitore_form_crea_nuova_asta" class="container hidden" >
            <div class="border padding">
                <div class="container centered">
                  <input id="nome_pianta" placeholder="Nome pianta">
                </div>
                <div  class="image_preview">
                    <img id="picture_img_preview" src="">
                </div>
                <div class="container column_direction ">
                    <div>
                        <label for="link_textbox"  >Link </label> 
                        <input type="textbox" placeholder ="www.ex.it/img.jpg" id="link_textbox">
                    </div>

                    <div>
                        <button id="increment_button">+</button>
                        <h1 id="base_asta"></h1>
                        <button id="decrement_button">-</button>
                    </div>
                    <button id="button_new_asta" >PUBBLICA</button>
                    
                </div>
            </div>
        </div>
    </div>

    </div>
    <section>
       
    </section>
    <p id="auth_code" hidden><?php echo $_SESSION["auth_code"] ?> </p>
</body>
</html>