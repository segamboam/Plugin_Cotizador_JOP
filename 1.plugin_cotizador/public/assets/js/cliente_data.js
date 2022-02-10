window.addEventListener("DOMContentLoaded",function(){
    console.log("registro cargado")
    let $form =document.querySelector("#clientes")
    
    $form.addEventListener("submit",function(e)
    {
        console.log("registro cargado");
        e.preventDefault();

        let datos = new FormData($form);
        let datosParse = new URLSearchParams(datos);

        fetch(`${JOP.rest_URL}/cliente`,
        {
            method: "POST",
            body: datosParse
        })
        .then(res=>res.json())
        .then(json=>{
            console.log(json)
            window.location.href=`${JOP.plugin_URL}/cotizador_jop/public/Cotizacion.php`
        })
        .catch(err=>{
            console.log(`Hay un error: ${err}`)
        })
 
    })

    });

 /*    $form.addEventListener("submit",function(e) */