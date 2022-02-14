const range = (start, stop, step) => Array.from({ length: (stop - start) / step + 1}, (_, i) => start + (i * step));

window.addEventListener("DOMContentLoaded",function(){
    console.log("registro cargado")
    $button_event=document.getElementById("Button_cotizacion")
    $button_event.addEventListener("click", function() {
        console.log("click")

        let datos_P=document.querySelectorAll(".tablaPlacas tbody tr td");
        let dat_P=[...datos_P].map(play=>play.innerText);
        let nItems_P=dat_P.length/7

        let datos_I=document.querySelectorAll(".tablaImplementos tbody tr td");
        let dat_I=[...datos_I].map(play=>play.innerText);
        let nItems_I=dat_I.length/5

        if (nItems_P>0 || nItems_I>0) {
        let $datos = new FormData();
        let n=0;
        if (nItems_P>0){
            for (let i in range(1,nItems_P,1)){
                let items_P=[n,n+1,n+2,n+3,n+4,n+5,n+6].map(x=>dat_P[x]); 
                head_P="Items_P[]"      
                $datos.append(head_P,items_P);
                n=n+7;
        }}
        n=0;
        if (nItems_I>0){
            for (let i in range(1,nItems_I,1)){
                let items_I=[n,n+1,n+2,n+3,n+4].map(x=>dat_I[x]); 
                head_I="Items_I[]"      
                $datos.append(head_I,items_I);
                n=n+5
        }}        
        let datosParse = new URLSearchParams($datos);
    
         /* fetch("http://pruebasvarios.local/wp-json/jop/cotizacion_placas", */
         fetch(`${JOP.rest_URL}/cotizacion_placas`,
        {
            method: "POST",
            body: datosParse
        }
        )
        .then(res=>res.json())
        .then(json=>{
            console.log(json)
            //window.location.href=`${JOP.home_URL}/cotizador-cliente/`

        })
        .catch(err=>{
            console.log(`Hay un error: ${err}`)
        })}
        else{
            swal("Oops!", "Debe agregar por lo menos 1 producto!", "error");

        }
 
    })

    })