async function addnavbar(){
    let response = await getSessionVars();
    if(!response["is_medico"]){
        return;
    }
    let item =  document.createElement("li");
    item.classList.add("nav-item");
    let link  = document.createElement("a");
    link.classList.add("nav-link");
    link.href = "agendamentos-medico.php";
    link.innerHTML = "Meus agendamentos";
    item.appendChild(link);

    let container =  document.querySelector("#navbar");
    container.prepend(item);
}

async function getSessionVars(){
try{
    let response = await fetch("./php/getSessionVars.php")
    if (!response.ok) {
        throw new Error(response.status);
    }
    let vars = await response.json();
    return vars;
}
catch(error){
    console.log(error);
    return;
}
}


window.addEventListener("DOMContentLoaded",addnavbar);