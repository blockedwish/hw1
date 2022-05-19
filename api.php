<?php
require_once("library.php");

if(isset($_GET["action"]) && isset($_POST["auth_code"])  ){
    switch ($_GET["action"]){
        case "1": //get all aste
            echo get_aste($_POST["filter"]);
            break;
        case "2"://Update money of asta.
                $user = control_authcode($_POST["auth_code"]);
                $asta_id = $_POST["asta_id"];
                
                if($user!=false){
                    $arr = array("success"=> update_prezzo($user, $asta_id) ,
                                "asta_id" => $asta_id,
                                "user"=> $user
                                );
                    echo json_encode($arr);
                  
                }
                else{
                    echo "ERRORE NELL'AGGIORNAMENTO DELL'ASTA";
                }
            
            break;
        case "3"://Insert bookmark
            if( isset($_POST["asta_id"])){
                toggle_bookmark($_POST["auth_code"], $_POST["asta_id"]);
            }
            break;
        case '4':
                echo get_bookmarks($_POST["auth_code"]);//json
            break;
        case '5':
                echo add_new_asta($_POST["auth_code"], $_POST["img_link"], $_POST["money"], $_POST["nome_pianta"]);

            break;
        case '6': //recognize_img
            if( isset($_POST["img_link"])){
                echo recognize_img($_POST["img_link"]);
            }
            break;
        case '7':
            echo get_number_follow_all_aste($_POST["auth_code"]);
            break;
        case '8'://cambiare immagine profilo
            change_img_profile($_POST["auth_code"], $_POST["img_link"]);
            break;
        case '9'://Change password
            echo change_password($_POST["auth_code"], $_POST["old_password"], $_POST["new_password"]);
            break;


    }
    
}

?>