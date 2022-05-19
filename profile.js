
function handler_textbox(event){
    if(event.target.value.length > 10){
        //fetch per cambiare l'img
        img.src=event.target.value;
        
    }
    
    widget_img_changer.setAttribute("type","button");
    widget_img_changer.setAttribute("value","Cambia immagine profilo");
 
    
}
function widget_profile_img_changer(event){
    widget_img_changer.setAttribute("type","textbox");
    widget_img_changer.setAttribute("placeholder","http://example.com/profile.jpg");
    widget_img_changer.setAttribute("value","");
    widget_img_changer.addEventListener("blur", handler_textbox);
    event.preventDefault();
    // widget_img_changer.addEventListener("keypress", handler_textbox)

}


function response_change_password_text(text){
    if(text=='0'){ //failure
        old_password.classList.add("error");
    }
    else{//success
       sub_window.classList.add("hidden");
       reimposta_password_button.classList.remove("hidden");
       widget_img_changer.classList.remove("hidden");
       popup.classList.remove("hidden")
       old_password.classList.remove("error");
       old_password.value="";
       new_password.value="";


    }
}

function change_password_response_handler(resp){
    return resp.text();
}
function button_changer_handler(event){
    let form = new FormData();

    form.append("auth_code", authcode);
    form.append("old_password", old_password.value);
    form.append("new_password", new_password.value);
    fetch("api.php?action=9",{method:"POST", body:form}).then(change_password_response_handler).then(response_change_password_text);
}
function change_password_interrupt(event){
    reimposta_password_button.classList.add("hidden");
    sub_window.classList.remove("hidden");
    widget_img_changer.classList.add("hidden");
}

function popup_click_everywhere(event){
    console.log("click");
    popup.classList.add("hidden");
}

var authcode = document.querySelector("#auth_code"); 
authcode = authcode.textContent; 

let widget_img_changer= document.querySelector("#img_profile_widget");
widget_img_changer.addEventListener("click", widget_profile_img_changer);

let button_changer = document.querySelector("#button_changer");
button_changer.addEventListener("click",button_changer_handler);

let img= document.querySelector("#profileimg");

let reimposta_password_button = document.querySelector("#reimposta_password")
reimposta_password_button.addEventListener("click", change_password_interrupt)
let old_password = document.querySelector("#old_password");
let new_password = document.querySelector("#new_password");
let sub_window = document.querySelector("#sub_window")
let popup = document.querySelector("#pop_up");
popup.addEventListener("click", popup_click_everywhere)