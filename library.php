<?php
function controlUsername($user){
    $rt = "TRUE";
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $user = mysqli_real_escape_string($conn, $user);
    $query="SELECT * FROM USERS WHERE USERNAME='".$user."'";
    $res = mysqli_query($conn, $query);
    if(mysqli_num_rows($res)>0){
        $rt = "FALSE";
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    
    return $rt;
}

function get_aste($filter){ //RICERCA TRAMITE REST API
    $eventi = array();
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
 
    if($filter!=""){
        $query=sprintf("SELECT * FROM ASTE WHERE USERNAME='%s'", $filter);
    }else{
        $query="SELECT * FROM ASTE";
    }
    
    $res = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($res)){
        $eventi[] = $row;
    }
    //mysqli fetch assoc ritorna ''false'' quando ha finito di 
    //ritornare tutti gli elementi dunque esce dal while
    mysqli_free_result($res);
    mysqli_close($conn);
    return json_encode($eventi);
}

function update_prezzo( $miglior_offerente, $codice_asta){
    //UPDATE ASTE SET PREZZO_CORRENTE=99, MIGLIOR_OFFERENTE="GIUSEPPE" WHERE CODICE_ASTA=1;
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $mofferente =mysqli_real_escape_string($conn, $miglior_offerente);
    $casta=mysqli_real_escape_string($conn, $codice_asta);
    $query="UPDATE ASTE SET PREZZO_CORRENTE=PREZZO_CORRENTE+2, MIGLIOR_OFFERENTE='".$mofferente."' WHERE CODICE_ASTA=".$casta."; ";
    $res = mysqli_query($conn, $query);
    mysqli_close($conn);
    if($res==1){
        return true;
    }
    return false;
    
}

function control_authcode($auth_code){
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $auth_code = mysqli_real_escape_string($conn, $auth_code);
    $query = "SELECT USERNAME FROM USERS WHERE MD5_CODE='".$auth_code."'";
    $res = mysqli_query($conn, $query);
   
    $result = mysqli_fetch_assoc($res);
    if(isset($result["USERNAME"])){
        return $result["USERNAME"];
    }
    else{
        return false;
    }
}

function toggle_bookmark($md5_code, $codice_asta){
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    
    $md5_code = mysqli_real_escape_string($conn, $md5_code);
    $codice_asta =mysqli_real_escape_string($conn, $codice_asta);

    if(mysqli_num_rows(mysqli_query($conn,"SELECT ASTA_CODE FROM ASTE_FOLLOW WHERE MD5_CODE='".$md5_code."' AND ASTA_CODE=".$codice_asta))==0){
        $query="INSERT INTO ASTE_FOLLOW VALUES('".$md5_code."',".$codice_asta.");";
    }
    else{
        $query ="DELETE FROM ASTE_FOLLOW WHERE MD5_CODE='".$md5_code."' AND ASTA_CODE=".$codice_asta;

    }
    mysqli_query($conn, $query);
    
    mysqli_close($conn);
}

function get_bookmarks($md5_code){
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    
    $md5_code = mysqli_real_escape_string($conn, $md5_code);
    $query = "SELECT ASTA_CODE  FROM ASTE_FOLLOW WHERE MD5_CODE='".$md5_code."'";

    $res = mysqli_query($conn, $query);
    $eventi = array();
    while($row = mysqli_fetch_assoc($res)){
        $eventi[] = $row["ASTA_CODE"];
    }
    mysqli_free_result($res);
    mysqli_close($conn);
    return json_encode($eventi);

}


function add_new_asta($md5_code_author_asta, $img_cover_link, $base_asta_money, $nome_pianta){
    $username = control_authcode($md5_code_author_asta);
    if($username!=false){
        $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
        $nome_pianta = mysqli_real_escape_string($conn, $nome_pianta);
        $img_cover_link = mysqli_real_escape_string($conn, $img_cover_link);
        $base_asta_money = mysqli_real_escape_string($conn, $base_asta_money);    
        $query = sprintf("INSERT INTO ASTE(NOME_PIANTA, USERNAME, DATA_INIZIO, DATA_FINE, PREZZO_CORRENTE, MIGLIOR_OFFERENTE, LINK_IMG) VALUES('%s', '%s', now(), now() + INTERVAL 1 DAY, %d, '%s', '%s');",$nome_pianta, $username, $base_asta_money, $username, $img_cover_link );
        mysqli_query($conn, $query);
        mysqli_close($conn);
    }
    else{
        return false;
    }
}

function recognize_img($image){
    $api_key="2b10NrHPeMZWPlPC8GZMmKqHDO";
    $url=sprintf("https://my-api.plantnet.org/v2/identify/all?api-key=%s&images=%s&organs=leaf",$api_key, urlencode($image));
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL,$url); //settiamo l'url
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); //Questo ci serve per fare restituire il risultato come stringa.
    $result = curl_exec($curl);
    curl_close($curl);
    return $result; //JSON

}


function get_number_follow_all_aste($md5_code){
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $query = "SELECT A.CODICE_ASTA, A.NOME_PIANTA, A.PREZZO_CORRENTE, B.C FROM ASTE AS A, (SELECT ASTA_CODE,COUNT(*) AS C FROM ASTE_FOLLOW GROUP BY ASTA_CODE) AS B  WHERE A.USERNAME='".control_authcode($md5_code)."' AND B.ASTA_CODE = A.CODICE_ASTA";    
    $result= mysqli_query($conn, $query);
    $eventi = array();
    while($row = mysqli_fetch_assoc($result)){
        $eventi[] = $row;
    }
    
    mysqli_free_result($result);
    mysqli_close($conn);
    return json_encode($eventi);

}


function change_img_profile($md5_code, $img_profile_link){
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $md5_code =  mysqli_real_escape_string($conn, $md5_code);
    $img_cover_link =  mysqli_real_escape_string($conn, $md5_code);
    $query = sprintf("UPDATE USERS SET PROFILE_IMAGE ='%s' WHERE MD5_CODE ='%s';",$img_profile_link, $md5_code);
    mysqli_query($conn, $query);
    mysqli_close($conn);
}


function change_password($md5_code, $old_password, $new_password){
    $conn = mysqli_connect("localhost","root","","PLANT_COMMUNITY") or die("Errore, Non e' possibile connettersi al database");
    $md5_code = mysqli_real_escape_string($conn, $md5_code);
    $old_password= mysqli_real_escape_string($conn, $old_password);
    $new_password = mysqli_real_escape_string($conn, $new_password);
    $query= sprintf("UPDATE USERS SET PASSWORD='%s' WHERE MD5_CODE='%s' AND PASSWORD='%s';",crypt($new_password,10),$md5_code, crypt($old_password,10));
    $result = mysqli_query($conn, $query);
    $result = mysqli_affected_rows($conn);
    mysqli_close($conn);
    return $result;
}
//get_bookmarks("62823d6a98239 ");
//change_password("6284f6e8a3859","11111","00000");
?>