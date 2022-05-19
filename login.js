function validate(event){

    let form_elements =[document.querySelector("#username_textbox"),document.querySelector("#pwd_textbox") ]
    for(let element of form_elements){
        if(element.value.length <4) {
            element.classList.add("error");
            event.preventDefault();
        }
        else{
            element.classList.remove("error");
        }
    }
    
}














const form = document.querySelector("#login_form");
form.addEventListener("submit", validate);