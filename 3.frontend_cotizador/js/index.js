
    const tipo = {
         "extintor": ["Multiproposito","Extintor Agente Limpio","CO2","Agua"],
         "base":["Plastico PVC", "Metal"],
         "botiquin":["Termico de 18 productos"],
         "camilla":["Con Inmovilizador","Sin Inmovilizador"],
         "canecaDesechosOrganicos":["Ordinarios", "Plasticos","Papel y carton"]
 
     }
    const tamano = {
         "multiproposito":["5 lbs","10 lbs","20 lbs"],
         "agente":["2500 gr","3700 gr", "7000 gr"],
         "CO2":["5 lbs"," 10 lbs","//"],
         "camilla":["185 x 45"],
         "caneca":["10 lts"]
 
     }
     const material = {
        "placa": ["poliestireno","acrilico","lamina", " "],
        "placaFotoluminiscente":["acrilico", "lamina","poliestireno", " "],
        "placaReflectiva":["acrilico", "lamina","poliestireno", " "],
        "calcomania":["fotoluminiscente","impresa","reflectiva", " "],
        "marquillas":["acrilico americano", "acrilico nacional","gravoplay nacional","pol impreso", " "]

    }
    
    function toggleOn () {
        const menu = document.querySelector('.navBar__mobile')
        menu.style.left = 0;   
    }
    function toggleOff () {
        const menu = document.querySelector('.navBar__mobile')
        menu.style.left = '100%';   
    }
     
 

var checkSenalizacion = document.getElementById("input__senalizacion");
var checkSegIndustrial = document.getElementById("input__industrial");


//display of the cotization in real time 
function display(check,form, container) {
    if (check.checked === true) {
        document.getElementById(form).style.display='flex';
        document.getElementById(form).style.flexDirection = 'column'
        document.getElementById(container).style.border='solid 1px  #FF5E0D'; 
        
    } else {
        document.getElementById(form).style.display='none';
        document.getElementById(container).style.border='none'; 
        
    }

}
function displayLightBox() {
    const lightBox = document.querySelector(".cotizar__notice");
    lightBox.style.display = "flex"
    
}


//here we create a new formData and use de functions to create a new row and to save the data in the local storage

const formulario = document.getElementById ("cotizaForm");

formulario.addEventListener("submit", function(event) {
    event.preventDefault();
    let cotizarFormData = new FormData(formulario);
    let cotizarObject = convertFormDataToAnObject(cotizarFormData);
    saveCotizarObj(cotizarObject);
    insertRowInCotizarTable(cotizarObject) 
    formulario.reset();
    console.log(cotizarFormData)
})

function getNewCotizarId(){
    let lastCotizarId = sessionStorage.getItem("lastCotizarId") || "-1";
    let newCotizarId = JSON.parse(lastCotizarId) + 1;
    sessionStorage.setItem("lastCotizarId", JSON.stringify(newCotizarId))
    return newCotizarId;


}

// here we manage our senalizacion table and put the data in the sessionStorage 

function convertFormDataToAnObject (cotizarFormData){
   let producto = cotizarFormData.get("producto");
   let cantidad = cotizarFormData.get("cantidad");
   let material = cotizarFormData.get("material");
   let ancho = cotizarFormData.get("ancho");
   let largo = cotizarFormData.get("largo");
   let texto = cotizarFormData.get("texto");
   let descripcion = cotizarFormData.get("description");
   let cotizarId = getNewCotizarId();
   return {
    "producto":producto,
    "cantidad": cantidad,
    "material": material,
    "ancho": ancho,
    "largo": largo,
    "texto": texto,
    "cotizarId": cotizarId,
    "description": descripcion,
   }


}



function insertRowInCotizarTable(cotizarObject) {
    let cotizarTableRef = document.getElementById("cotizarTable__senalizacion-tbody");
 

    let newCotizarRowRef = cotizarTableRef.insertRow(-1);
    newCotizarRowRef.setAttribute("data-cotizar-Id", cotizarObject["cotizarId"]);

    let newTypeCellRef = newCotizarRowRef.insertCell(0);
    newTypeCellRef.textContent = cotizarObject["producto"];

    newTypeCellRef = newCotizarRowRef.insertCell(1);
    newTypeCellRef.textContent = cotizarObject["material"];

    newTypeCellRef = newCotizarRowRef.insertCell(2);
    newTypeCellRef.textContent = cotizarObject["cantidad"];

    newTypeCellRef = newCotizarRowRef.insertCell(3);
    newTypeCellRef.textContent = cotizarObject["ancho"];

    newTypeCellRef = newCotizarRowRef.insertCell(4);
    newTypeCellRef.textContent = cotizarObject["largo"];

    newTypeCellRef = newCotizarRowRef.insertCell(5);
    newTypeCellRef.textContent = cotizarObject["description"];

    newTypeCellRef = newCotizarRowRef.insertCell(6);
    newTypeCellRef.textContent = cotizarObject["texto"];


    let newDeleteCell = newCotizarRowRef.insertCell(7);
    let deleteButton = document.createElement("button");
    deleteButton.textContent = "Eliminar";
    newDeleteCell.appendChild(deleteButton);


    
    deleteButton.addEventListener("click",(event)=> {
        let cotizarRow = event.target.parentNode.parentNode;
        let cotizarId = cotizarRow.getAttribute("data-cotizar-Id")
        cotizarRow.remove();
        deleteCotizarObj(cotizarId);
    })
    

    document.getElementById("cotizarTable__senalizacion").style.display='block';
}

function deleteCotizarObj(cotizarId){
    const table = document.querySelector('#cotizarTable__senalizacion')
    let cotizarObjArr = JSON.parse(sessionStorage.getItem("senalizacion"))
    let cotizarIndexInArray = cotizarObjArr.findIndex(element => element.cotizarId === cotizarId);
    cotizarObjArr.splice(cotizarIndexInArray, 1);
    let cotizarArrayJSON = JSON.stringify(cotizarObjArr); 
    sessionStorage.setItem("senalizacion", cotizarArrayJSON);
    console.log(cotizarObjArr.length)

    if (cotizarObjArr.length === 0 ) {
        table.style = "display: none;"

    }
}
function saveCotizarObj(Object){
    let myCotizarArray = JSON.parse(sessionStorage.getItem("senalizacion")) || [];
    myCotizarArray.push({Object});
    let cotizarArrayJSON = JSON.stringify(myCotizarArray); 
    sessionStorage.setItem("senalizacion", cotizarArrayJSON);  
}
function handleSelectSenalizacion () {
    const contenedor = document.querySelector('#material');
    const div = document.querySelector('.material');
    let selectedValue =  document.querySelector('#producto').value;
    
    while (contenedor.options.length > 0) {
        contenedor.options.remove(0)  
    }
  
    switch (selectedValue) {
        case 'placa':
            createSelect(material.placa,contenedor);
            div.style.display='block';
            break;
        case 'placa fotoluminiscente':
            createSelect(material.placaFotoluminiscente,contenedor);
            div.style.display='block';
            break;
        case 'placa reflectiva':
            createSelect(material.placaReflectiva,contenedor);
            div.style.display='block';
            break;
        case 'calcomania':
            createSelect(material.calcomania,contenedor);
            div.style.display='block';
            break;
        case 'marquillas': 
            createSelect(material.marquillas,contenedor);
            div.style.display='block';
            break;

        default: 
            div.style.display='none';
            break;
    }
}

//here we manage our industrial table and create the data to storage in the sessionStorage 

const formularioIndustrial = document.getElementById ("cotizarForm__industrial");

formularioIndustrial.addEventListener("submit", function(event) {
    event.preventDefault();
    let cotizarFormIndustrialData = new FormData(formularioIndustrial);
    let cotizarIndObject = convertFormDataToAnObjectInd(cotizarFormIndustrialData);
    saveCotizarIndObj(cotizarIndObject);
    insertRowInCotizarIndustrialTable(cotizarFormIndustrialData);
    formularioIndustrial.reset();
})

function saveCotizarIndObj(Object){
    let myCotizarIndArray = JSON.parse(sessionStorage.getItem("industrial")) || [];
    myCotizarIndArray.push({Object});
    let cotizarIndArrayJSON = JSON.stringify(myCotizarIndArray); 
    sessionStorage.setItem("industrial", cotizarIndArrayJSON);  
}

function convertFormDataToAnObjectInd (cotizarFormIndustrialData){
    let producto = cotizarFormIndustrialData.get("producto__industrial");
    let cantidad = cotizarFormIndustrialData.get("cantidad__industrial");
    let tipo = cotizarFormIndustrialData.get("tipo__industrial");
    let medidas = cotizarFormIndustrialData.get("medida__industrial");
    let especificacion = cotizarFormIndustrialData.get("especificaciones__industrial");
    let cotizarId = getNewCotizarId();
 
    return {
     "producto":producto,
     "cantidad":cantidad,
     "tipo": tipo,
     "medidas": medidas,
     "especificacion": especificacion,
     "cotizarId": cotizarId
  
    }
 
 
 }
function insertRowInCotizarIndustrialTable(cotizarFormIndustrialData) {
    let cotizarIndustrialTableRef = document.getElementById("cotizarTable__industrial-tbody");

    let newCotizarIndustrialRowRef = cotizarIndustrialTableRef.insertRow(-1);

    let newTypeIndCellRef = newCotizarIndustrialRowRef.insertCell(0);
    newTypeIndCellRef.textContent = cotizarFormIndustrialData.get("producto__industrial");

    newTypeIndCellRef = newCotizarIndustrialRowRef.insertCell(1);
    newTypeIndCellRef.textContent = cotizarFormIndustrialData.get("cantidad__industrial");

    newTypeIndCellRef = newCotizarIndustrialRowRef.insertCell(2);
    newTypeIndCellRef.textContent = cotizarFormIndustrialData.get("tipo__industrial");

    newTypeIndCellRef = newCotizarIndustrialRowRef.insertCell(3);
    newTypeIndCellRef.textContent = cotizarFormIndustrialData.get("medida__industrial");

    newTypeIndCellRef = newCotizarIndustrialRowRef.insertCell(4);
    newTypeIndCellRef.textContent = cotizarFormIndustrialData.get("especificaciones__industrial");

    let newDeleteCell = newCotizarIndustrialRowRef.insertCell(5);
    let deleteButton = document.createElement("button");
    deleteButton.textContent = "Eliminar";
    newDeleteCell.appendChild(deleteButton);
    
    deleteButton.addEventListener("click",(event)=> {
        let cotizarRow = event.target.parentNode.parentNode;
        let cotizarId = cotizarRow.getAttribute("data-cotizar-Id")
        cotizarRow.remove();
        deleteCotizaIndObj(cotizarId);
    })

    document.getElementById("cotizarTable__industrial").style.display='block';

}

function deleteCotizaIndObj(cotizarId){
    const table = document.querySelector('#cotizarTable__industrial')
    let cotizarObjIndArr = JSON.parse(sessionStorage.getItem("industrial"))
    let cotizarIndexIndArray = cotizarObjIndArr.findIndex(element => element.cotizarId === cotizarId);
    cotizarObjIndArr.splice(cotizarIndexIndArray, 1);
    let cotizarIndArrayJSON = JSON.stringify(cotizarObjIndArr); 
    sessionStorage.setItem("industrial", cotizarIndArrayJSON);
    console.log(cotizarIndexIndArray )

    if (cotizarObjIndArr.length === 0 ) {
        table.style = "display: none;"

    }
}

//select dinamico

function createSelect (array, container) {
    
    array.map(function(e){
        const node  = `<option value= ${e}> ${e} </option>`
        container.insertAdjacentHTML("afterbegin", node);
        
    })
}
function handleSelect () {
    const contenedor = document.querySelector('#tipo__industrial');
    const div = document.querySelector('.tipo__industrial');
    let selectedValue =  document.querySelector('#producto__industrial').value;
    const contentMed =  document.querySelector('#medida__industrial')
    const divMed = document.querySelector('.medida__industrial');

    while (contenedor.options.length > 0) {
        contenedor.options.remove(0)  
    }
    while (contentMed.options.length > 0) {
        contentMed.options.remove(0);
        divMed.style.display='none'; 
    }

    switch (selectedValue) {
        case 'Extintor':
            createSelect(tipo.extintor,contenedor);
            div.style.display='flex';
            div.style.alignItems= 'center';
            break;
        case 'Recarga Extintor':
            createSelect(tipo.extintor,contenedor);
            div.style.display='flex';
            div.style.alignItems= 'center';
            break;
        case 'Mantenimiento Extintor':
            createSelect(tipo.extintor,contenedor);
            div.style.display='flex';
            div.style.alignItems= 'center';
            break;
        case 'Base de Pared Extintor':
            createSelect(tipo.base,contenedor);
            div.style.display='flex';
            break;
        case 'Botiquin': 
            createSelect(tipo.botiquin,contenedor);
            div.style.display='flex';
            break;
        case 'Camilla':
            createSelect(tipo.camilla,contenedor);
            div.style.display='flex'; 
            break;
        case 'Caneca Desechos Organicos':
            createSelect( tipo.canecaDesechosOrganicos,contenedor);
            div.style.display='flex'; 
            break;
        default: 
            div.style.display='none';
            break;
    }
}

function handleSelectMed () {
    const divMed = document.querySelector('.medida__industrial');
    let selectedValueMed =  document.querySelector('#tipo__industrial').value;
    const contentMed =  document.querySelector('#medida__industrial')

    while (contentMed.options.length > 0) {
        contentMed.options.remove(0)  
    }

    switch (selectedValueMed) {
        case 'Extintor':
            createSelect(tamano.agente,contentMed);
            divMed.style.display='flex';
            divMed.style.alignItems= 'center';
            break;
        case 'Multiproposito':
            createSelect(tamano.multiproposito,contentMed);
            divMed.style.display='flex';
            divMed.style.alignItems= 'center';

            break;
        case 'CO2':
            createSelect(tamano.CO2,contentMed);
            divMed.style.display='flex';
            divMed.style.alignItems= 'center';
            break;
        case ('Sin || Con'):
            createSelect(tamano.camilla,contentMed);
            divMed.style.display='flex';
            divMed.style.alignItems= 'center';
            break;
        default: 
            divMed.style.display='none';
            break;
    }
}

//form validations

function validateInputsSenalization () {
    const cantidad = document.querySelector('#cantidad');
    const ancho = document.querySelector('#ancho');
    const alto = document.querySelector('#largo');

    if (cantidad.value <=  0) {
       cantidad.value = 1 ;
    } else {
        if (ancho.value <= 0 ) {
            ancho.value = 1;  
        } else {
            if (alto.value <= 0 ) {
                alto.value = 1; 
            };
        }

    }

}

function validateInputsIndustrial () {
    const cantidad = document.querySelector('#cantidad__industrial');

    if (cantidad.value <=  0) {
       cantidad.value = 1 ;
    } 

}