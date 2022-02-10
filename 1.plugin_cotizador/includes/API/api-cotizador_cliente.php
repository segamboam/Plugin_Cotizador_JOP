<?php
function jop_api_cliente(){
    register_rest_route(
        "jop",
        "cliente",
        array(
            'methods'=>'POST',
            'callback'=>'jop_coti_cliente_callback'
        )
        );
}
function jop_coti_cliente_callback($request)
{
    $data=$request->get_params();
    #$ruta=plugin_dir_path(__FILE__);
    #$ruta=substr($ruta,0,strlen($ruta)-13)."public/temporalcsv/cliente.csv";
    $ruta=JOP_PATH."public/temporalcsv/cliente.csv";
    $fp = fopen($ruta, 'w');
    foreach($data as $key => $value){
        fputcsv($fp, array( $key => $value));
    };
    fclose($fp);
    
    return $ruta;
}
add_action("rest_api_init","jop_api_cliente");