/*
<div class="article">
            <div class="seventy_block">
                <div class="img_container">
                    <img src="https://www.tropicalflowersaronno.it/shop/479-large_default/pianta-generica.jpg">
                </div>
                <div class="interaction_block">
                    <img class="icon" src="offri.png">
                    <img class="icon" src="follow.png">
                </div>
            </div>
            <div class="thirty_block">
                <p>Proprietario: Pippo</p>
                <p>Inizio asta : 17/18/899</p>
                <p>Fine asta: 11/11/11</p>
      
                <p>Prezzo corrente</p>
                <h1>78</h1>
                <p class="miglior_offerente" >Pino</p>
            </div>
        </div>


*/

var counter = 40;
var onoff_bookmark = false;
var filter = "";
function onresult(json){
        if(json["success"]==true){//UPDATE AVVENUTO CON SUCCESSO
            let h1_prezzo = document.querySelector("#h1-"+json["asta_id"])
            let p5_mofferente = document.querySelector("#miglior_offerente-"+json["asta_id"]);
            h1_prezzo.textContent = parseInt(h1_prezzo.textContent)+2;
            p5_mofferente.textContent =json["user"];


            //update();

        }

    //Qui dobbiamo modificare il prezzo dell'asta, solo di quella.

}
function onResponse2(resp){
    return resp.json();
}
function offer(event){
    let astadiappartenenza = event.target.dataset.astaid
    //let authcode = document.querySelector("#auth_code");
    //In modo tale che se non faccio il login nessuno puo' eseguire una richiesta non autorizzata in grado di modificare il database in maniera arbitraria.
    let form = new FormData();
    form.append("auth_code",authcode);
    form.append("asta_id",astadiappartenenza);
    fetch("api.php?action=2", {method:"POST", body: form}).then(onResponse2).then(onresult);
    event.preventDefault();
}




function bookmark(event){
   
    let astadiappartenenza = event.target.dataset.astaid
    let form = new FormData();
    form.append("asta_id", astadiappartenenza);
    form.append("auth_code",authcode);
   
    fetch("api.php?action=3", {method:"POST", body:form});
    
    event.target.classList.toggle("selected");
    event.preventDefault();
}
function onjson(json){
    let element;
    for(let index=0; index< json.length;index++){
        element = json[index]
        
        if(onoff_bookmark==true && aste_preferite.indexOf(element["CODICE_ASTA"])==-1)
        {
            continue;
        }
        
        let article = document.createElement("div");
        article.setAttribute("data-astaid", element["CODICE_ASTA"]);
        article.classList.add("article");
        let seventy_block = document.createElement("div");
        let thirty_block = document.createElement("div");
        seventy_block.classList.add("seventy_block");
        thirty_block.classList.add("thirty_block");
        let img_container = document.createElement("div");
        img_container.classList.add("img_container");
        let img = document.createElement("img");
        img.src=element["LINK_IMG"];
        let interaction_block = document.createElement("div");
        interaction_block.classList.add("interaction_block");
        let icon1 = document.createElement("input");
        icon1.setAttribute("type","image");

        let icon2 = document.createElement("input");
        icon2.setAttribute("type","image");
        icon1.classList.add("icon");
        icon2.classList.add("icon");
        if(aste_preferite.indexOf(element["CODICE_ASTA"]) !=-1){
            icon2.classList.add("selected");
        }
        let form = document.createElement("form");

        form.setAttribute("method","post");
        
        form.appendChild(icon1);

        icon1.src = "offri.png";
        icon2.src="follow.png";
        icon1.setAttribute("data-astaid", element["CODICE_ASTA"]);
        icon1.setAttribute("id","button-offer-"+element["CODICE_ASTA"]);
        icon2.setAttribute("data-astaid", element["CODICE_ASTA"]);

        
        icon1.addEventListener("click", offer);
        icon2.addEventListener("click", bookmark);
        interaction_block.appendChild(form);
        interaction_block.appendChild(icon2);
        img_container.appendChild(img);
        seventy_block.appendChild(img_container)
        seventy_block.appendChild(interaction_block);
        
        
        title = document.createElement("p");
        title.classList.add("bold");
        title.textContent = element["NOME_PIANTA"];
        p1 = document.createElement("p");
       
        p1.textContent = "Proprietario:"+element["USERNAME"];
        p2 = document.createElement("p");
        p2.textContent = "Inizio asta:"+element["DATA_INIZIO"];
        p3= document.createElement("p");
        p3.textContent = "Fine asta:"+element["DATA_FINE"];
        p4 = document.createElement("p");
        p4.textContent="Prezzo corrente";
        h1 = document.createElement("h1");
        h1.setAttribute("id","h1-"+element["CODICE_ASTA"]);
        h1.textContent = element["PREZZO_CORRENTE"]+"€";
        p5 = document.createElement("p");
        p5.classList.add("migliore_offerente");
        p5.textContent = element["MIGLIOR_OFFERENTE"];
        p5.setAttribute("id", "miglior_offerente-"+element["CODICE_ASTA"]);

        thirty_block.appendChild(title);
        thirty_block.appendChild(p1);
        thirty_block.appendChild(p2);
        thirty_block.appendChild(p3);
        thirty_block.appendChild(p4);
        thirty_block.appendChild(h1);
        thirty_block.appendChild(p5);

        article.appendChild(seventy_block);
        article.appendChild(thirty_block);
        document.querySelector("section").appendChild(article);


    }
}
function onResponse(resp){
    console.log(resp);
    return resp.json();
}

function update(){
    for(element of document.querySelectorAll(".article")){
        element.remove();
    }
    let form = new FormData();
    form.append("auth_code", authcode);
    form.append("filter", filter);
    fetch("api.php?action=1",{method:"post", body:form}).then(onResponse).then(onjson);
}


function form_search_handler(event){
    let text = document.querySelector("#text_filtro");
    filter = text.value;
    update();
    event.preventDefault();
}

function aste_preferite_response(json){
    aste_preferite = json;
    update();

}
function aste_preferite_handler(resp){
    return resp.json();
}


function add_create(event){
    event.target.classList.toggle("hidden");
    document.querySelector("#contenitore_form_crea_nuova_asta").classList.toggle("hidden");
    update_base_asta();
}


function increment_button_handler(event){
    counter +=1;
    update_base_asta();
}
function decrement_button_handler(event){
    counter -=1
    update_base_asta();
}

function update_base_asta(){
    document.querySelector("#base_asta").textContent=counter;
}

function textbox_link_img_handler(event){
    let link = event.target.value
   document.querySelector("#picture_img_preview").src= link;
   let form = new FormData();
   form.append("auth_code", authcode);
   form.append("img_link", link);
   fetch("api.php?action=6", {method:"POST", body:form}).then(onResponseRecognizeImg).then(recognizeImg);
}

function onReponse3(resp){
    update();
}

function recognizeImg(json){
    let nome_pianta_textbox = document.querySelector("#nome_pianta");
    nome_pianta_textbox.value = json["bestMatch"];
}
function onResponseRecognizeImg(resp){
    return resp.json();
}
function new_asta_create(event){
    if(link_textbox.value.length > 10){
      //counter == money
      //img link = link_textbox.value
      //username giusto no md5 ---> control authcode
      let form = new FormData();
      form.append("money", counter);
      form.append("nome_pianta", document.querySelector("#nome_pianta").value)
      form.append("img_link",link_textbox.value);
      form.append("auth_code", authcode);

      fetch("api.php?action=5", {method:"POST", body:form}).then(onReponse3);



      //resettiamo adesso tutto
      counter= 40;
      link_textbox.value="";
      document.querySelector("#picture_img_preview").src="";
      document.querySelector("#contenitore_form_crea_nuova_asta").classList.add("hidden");
      document.querySelector("#add_button").classList.remove("hidden");
      
    }
    
}


function onoff_bookmark_handler(event){
    onoff_bookmark = event.target.checked;
    update_all();
}
var aste_preferite = null;
var authcode = document.querySelector("#auth_code"); 
authcode = authcode.textContent; //Questo ci serve per mantenerci sicuri. 
document.querySelector("#form_search").addEventListener("submit", form_search_handler);
document.querySelector("#add_button").addEventListener("click", add_create);
document.querySelector("#button_new_asta").addEventListener("click", new_asta_create);
document.querySelector("#increment_button").addEventListener("click", increment_button_handler);
document.querySelector("#decrement_button").addEventListener("click", decrement_button_handler);
var onoff_bookmark_widget=document.querySelector("#onoff_bookmark").addEventListener("click", onoff_bookmark_handler);
//onoff_bookmark = onoff_bookmark_widget.checked;
var link_textbox = document.querySelector("#link_textbox");
link_textbox.addEventListener("blur",textbox_link_img_handler);

let form = new FormData();

function update_all(){
    form.append("auth_code",authcode);
    fetch("api.php?action=4",{method:"post", body:form}).then(aste_preferite_handler).then(aste_preferite_response);
}

update_all();
//lo metto qui perche' questo javascript verra' eseguito subito dopo aver finito di caricare tutto il dom.
//dunque se l'utente andra' a modificare il campo auth_code hidden a me non cambia nulla.

