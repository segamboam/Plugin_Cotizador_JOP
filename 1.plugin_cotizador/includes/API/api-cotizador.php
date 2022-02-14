<?php

function escribir_datos($ruta,$matriz){
    $fp = fopen($ruta, 'w');
    foreach($matriz as $key => $value){
        fputcsv($fp, array( $key => $value));
    };
    fclose($fp);



}

function jop_api_cotizacion_placas(){
    register_rest_route(
        "jop",
        "cotizacion_placas",
        array(
            'methods'=>'POST',
            'callback'=>'jop_coti_placas_callback'
        )
        );
}
function jop_coti_placas_callback($request)
{
    $data=$request->get_params();
    $ruta1=JOP_PATH."public/temporalcsv/cotizacion_placas.csv";
    $ruta2=JOP_PATH."public/temporalcsv/cotizacion_implementos.csv";
    if (array_key_exists('Items_P', $data)) {
        escribir_datos($ruta1,$data["Items_P"]);
    }
    if (array_key_exists('Items_I', $data)) {
        escribir_datos($ruta2,$data["Items_I"]);
    }    
    
    


   return $data;
    

}
add_action("rest_api_init","jop_api_cotizacion_placas");