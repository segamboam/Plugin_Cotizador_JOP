let $form =document.querySelector(".placa");

$form.addEventListener("submit",function(e){
    let array=[];
    console.log("registro cargado");
    e.preventDefault();
    let datos = new FormData($form);
    let arr={};
    tabla=document.querySelector(".tablaPlacas tbody");
    var newRow=tabla.insertRow();
    for(var dats of datos.entries()) {
        var newCell=newRow.insertCell();
        var newText=document.createTextNode(dats[1]);
        newCell.appendChild(newText);        
   
     }

})



