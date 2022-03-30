const form = document.querySelector('.main__data');

form.addEventListener("submit" , function(event) {
    event.preventDefault();
    let formData = new FormData(form);
    let dataObject = convertFormDataToAnObject(formData);
    saveCotizarObj(dataObject);
    form.reset();
})

function convertFormDataToAnObject (formData){
    let empresa = formData.get("empresa");
    let email = formData.get("email");
    let nombre = formData.get("nombre");
    let celular = formData.get("celular");
    let direccion = formData.get("direccion");
    let ciudad = formData.get("ciudad");
    let identificacion = formData.get("identificacion");
    let tipo = formData.get("tipo");
    let politica = formData.get("politica");
    let promo = formData.get("promos")

    return {
     "empresa":empresa,
     "email": email,
     "nombre": nombre,
     "celular": celular,
     "direccion": direccion,
     "ciudad": ciudad,
     "identificacion": identificacion,
     "tipo": tipo,
     "politica": politica,
     "promo": promo,
    }
 }
 function saveCotizarObj(Object){
    let array = JSON.parse(localStorage.getItem("userData")) || [];
    array.push({Object});
    let arrayJSON = JSON.stringify(array); 
    localStorage.setItem("userData", arrayJSON);  
}

function toggleOn () {
    const menu = document.querySelector('.navBar__mobile')
    menu.style.left = 0;   
}
function toggleOff () {
    const menu = document.querySelector('.navBar__mobile')
    menu.style.left = '100%';   
}
 