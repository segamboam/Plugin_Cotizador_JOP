window.addEventListener("DOMContentLoaded",function(){
    let $tablaPlaca =document.querySelector(".form_placa");
    $tablaPlaca.addEventListener("submit",function(e){
        e.preventDefault();
        let datos_p = new FormData($tablaPlaca);
        tabla_P=document.querySelector(".tablaPlacas tbody");
        var newRow=tabla_P.insertRow();
        for(var dats of datos_p.entries()) {
            var newCell=newRow.insertCell();
            var newText=document.createTextNode(dats[1]);
            newCell.appendChild(newText);
        }
    })
    let $tablaimplementos =document.querySelector(".implementos");
    $tablaimplementos.addEventListener("submit",function(e){
        e.preventDefault();
        let datos_I = new FormData($tablaimplementos);
        tabla_I=document.querySelector(".tablaImplementos tbody");
        var newRow=tabla_I.insertRow();
        for(var dats of datos_I.entries()) {
            var newCell=newRow.insertCell();
            var newText=document.createTextNode(dats[1]);
            newCell.appendChild(newText);
        }
    })

 
})