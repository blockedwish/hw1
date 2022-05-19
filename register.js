array =[] 


function crelement(message, position){
    let e = document.createElement("div")
    e.classList.add("row_form");
    e.classList.add("error");
    e.appendChild(document.createElement("p"));
    e.textContent=message;
    console.log(e);
    array[position]=e;
}

function update()
 {
    for(let element of form.querySelectorAll(".error")){ //Eliminiamo gli errori del precedente click.
        element.remove();
    }

    for(let element of array){ //Aggiungiamo il tutto 
        if(element != null){
            form.appendChild(element);
        }
    }
 }
function ontext(text){
    

    if(text=="FALSE"){
      crelement("Username gia' in uso.", 0);
   
    }
    else{
        array[0] = null;
    }
    /*
    if(String(document.querySelector("#pwd").value).length <5){
        crelement("La password deve avere 5 o piu' caratteri per essere valida", 1);
    }
    */
    if(String(document.querySelector("#username").value).length <3){
        crelement("L'username deve avere 3 o piu' caratteri per essere valido", 1);
       
    }else{
      
        array[1]=null;
    }
    update();
    
}
function response(response){
    return response.text();
}
function validatefunc(event){
    if(array.length ==0){
        event.preventDefault();
    }
    for( let el of array){
        if (el != null){
            event.preventDefault();
            return;
        }
    }
    //Altrimenti esegue il php e quindi la richiesta.
    
    
}
function validateUsername(event){
    console.log("Sto eseguendo");
    const formData = new FormData();
    formData.append("username",event.target.value);
    fetch("control_username.php", {method:"POST", body:formData}).then(response).then(ontext);
    
}
function validatePassword(event){
    if(String(event.target.value).length <5){
        crelement("La password e' troppo corta",2);

    }
    else{
        array[2]=null;
    }
    update();
}

function checkchanged(event){
    if(event.target.checked ==false){
        
        crelement("Accetta le nostre condizioni se vuoi registrarti.", 3)
    }
    else{
        array[3]= null;
        
    }
    update();
}

const form = document.querySelector("#register_form");
const username = document.querySelector("#username");
const password = document.querySelector("#pwd");
const checkbox = document.querySelector("#check");

form.addEventListener("submit", validatefunc);
username.addEventListener("blur", validateUsername);
password.addEventListener("blur",   validatePassword);
checkbox.addEventListener('change', checkchanged);
