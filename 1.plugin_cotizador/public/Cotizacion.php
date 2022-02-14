<?php

require __DIR__."/assets/php/Funcion_cal_precio_señales.php";
require __DIR__."/assets/php/Funcion_id_items.php";
require __DIR__."/assets/php/Funcion_request.php";


function crear_items_($id_item,$des_item,$precio_item,$cant_item)
{
    $body_Cbody="{ \"id\": ".$id_item.",\"description\": \"".$des_item."\",\"price\": ".$precio_item.",\"quantity\": \"".$cant_item."\"}";
    return$body_Cbody;

}

function escribir_datos($ruta,$matriz){
    $fp = fopen($ruta, 'w');
    foreach($matriz as $key => $value){
        fputcsv($fp, array( $key => $value));
    };
    fclose($fp);
}

# Crear items de cotizacion placas;
$url_coti_placas= __DIR__."/temporalcsv/cotizacion_placas.csv";
$array_placas = array_map('str_getcsv', file($url_coti_placas));
if (count($array_placas)==0){$items_placas="N.A";}else{
    $items_placas="";
    for ($i = 0; $i < count($array_placas); $i++) {
        $array_item=str_getcsv($array_placas[$i][0],",");
        $categoria = $array_item[0]."-".$array_item[1];
        $area=$array_item[3]*$array_item[4];
        $precio= precios_señales($categoria,$area,__DIR__."/temporalcsv/Precios_Señalizacion.csv");
        $id_item=id_items($categoria,__DIR__."/temporalcsv/Precios_Señalizacion.csv");
        $descripcion = "Tipo: ".$categoria." -Cantidad: ".$array_item[2]." - Tamaño: ".$array_item[3]."x".$array_item[4]." - Descripcion: ".$array_item[5]." - Texto:".$array_item[6];
        $item=crear_items_($id_item,$descripcion,$precio,$array_item[2]);
        if ($i==0){$items_placas=$item;}else{$items_placas=$items_placas.",".$item;}
}};

#crear items de cotizacion implementos
$url_coti_implementos= __DIR__."/temporalcsv/cotizacion_implementos.csv";
$array_implementos = array_map('str_getcsv', file($url_coti_implementos));
if (count($array_implementos)==0){$items_implementos="N.A";}else{
    $items_implementos="";
    for ($i = 0; $i < count($array_implementos); $i++) {
        $array_I_items=str_getcsv($array_implementos[$i][0],",");
        $categoria_I=$array_I_items[0]."-".$array_I_items[1]."-".$array_I_items[2];
        $id_item_I=id_items_I($categoria_I,__DIR__."/temporalcsv/Precios_Implementos.csv");
        $precio_I=precios_implementos($categoria_I,__DIR__."/temporalcsv/Precios_Implementos.csv");
        $descripcion_I="Tipo: ".$categoria_I." -Cantidad: ".$array_I_items[3]." - Tamaño: ".$array_I_items[2]." - Especificaciones: ".$array_I_items[4];
        $item_I=crear_items_($id_item_I,$descripcion_I,$precio_I,$array_I_items[3]);
        if ($i==0){$items_implementos=$item_I;}else{$items_implementos=$items_implementos.",".$item_I;}
}};

if (count($array_placas)==0 && count($array_implementos)==0){
    echo "No hay items para cotizar";
}else{
    #crear el head
    $fecha=date("Y-m-d");
    #traer los datos
    $array_clientes = array_map('str_getcsv', file(__DIR__."/temporalcsv/cliente.csv"));
    if (count($array_clientes)==0){
        echo "No hay clientes para cotizar";
    }else{
        $params= "{\"name\": {\"firstName\": \"".$array_clientes[0][0]."\", \"lastName\" : \" \"},\"identificationObject\": {\"type\": \"".$array_clientes[6][0]."\", \"number\": \"".$array_clientes[5][0]."\"} , \"email\": \"".$array_clientes[1][0]."\", \"phonePrimary\": \"".$array_clientes[2][0]."\", \"address\":{\"description\":\"".$array_clientes[3][0]."\", \"city\":\"".$array_clientes[4][0]."\"}}"; 
        #validar si existe el contacto
        $url_validacion="https://api.alegra.com/api/v1/contacts?email=".$array_clientes[1][0];
        $validacion=request_alegra($url_validacion,"GET","");
        $data_validacion=json_decode($validacion,true);
        # cree o actualice el contacto
        if (count($data_validacion)==0){
            $url_cliente='https://api.alegra.com/api/v1/contacts/';
            $result=request_alegra($url_cliente,'POST',$params);
            $array_for_id= json_decode($result,true);
            $id_cliente=$array_for_id["id"];
    
            }else{
            $id_cliente=$data_validacion[0]["id"];
            $url_actualizacion='https://api.alegra.com/api/v1/contacts/'.$id_cliente;
            $result=request_alegra($url_actualizacion,'PUT',$params);
    
        }
        #crear head
        $head="{\"date\": \"".$fecha."\",\"dueDate\": \"".$fecha."\",\"client\":{\"id\": ".$id_cliente."},\"seller\" : {\"id\" : \"3\"},";
        $body_head="\"items\" : [";    
        $body_final="],\"warehouse\": 1}";
        $body="";
        if($items_placas=="N.A" && $items_implementos<>"N.A"){
            $body=$items_implementos;
        }elseif($items_placas<>"N.A" && $items_implementos=="N.A"){
            $body=$items_placas;
        }else{
            $body=$items_placas.",".$items_implementos;
        }
        $cotizacion=$head.$body_head.$body.$body_final;
        #print_r($cotizacion);
    
        #### Crear la cotizacion
        $request_cotizacion=request_alegra('https://api.alegra.com/api/v1/estimates/',"POST",$cotizacion);
        $array_for_cotizacion= json_decode($request_cotizacion,true);
        if (array_key_exists('id', $array_for_cotizacion)==FALSE){
            echo "<h1>Error al crear la cotizacion </h1>".$array_for_cotizacion["id"];;}
        else{
            $id_cotizacion=$array_for_cotizacion["id"];
            $url_envio='https://api.alegra.com/api/v1/estimates/'.$id_cotizacion.'/email';
            #$params_envio="{\"emails\":[\"".$array_clientes[1][0]."\"], \"sendCopyToUser\":true }";
            $params_envio="{\"emails\":[\""."segamboam@gmail.com"."\"], \"sendCopyToUser\":true }";
            $envio_correo=request_alegra($url_envio,"POST",$params_envio);
            $array_for_envio= json_decode($envio_correo,true);
            if ($array_for_envio['code']!=200){
                echo "<h1>Error al enviar la cotizacion </h1>";}
            else{
                $host= "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
                $url= substr($host,0,strlen($host)-14)."assets/css/estilos.css";                                                                 
                echo '
                <head>
                <link rel="stylesheet" href="'.$url.'">
                </head>
                <main>
                <section class="imagen_logo">
                    <img src="https://i0.wp.com/jopavisos.com/wp-content/uploads/2020/07/cropped-logo-final-1.png">
                </section>
                <section class="Textos">
                    <div class="P1">
                        <p>Su cotización ha sido enviada exitosamente a su correo <b>'.$array_clientes[1][0].'</b></p>
                    </div>
                    <div class="P2">
                        <p>Si quiere realizar la compra a partir de este cotizador lo invitamos a comunicarse con nosotros al correo <a href="#">jopavisos@gmail.com</a> o escribirnos al número <a href="#">3046083830</a>.
                        </p>
                    </div>
                    <div class="P3">
                        <p>Le agradecemos que nos retroalimentara de su experiencia o si tuvo algún inconveniente a la hora de realizar su cotización en nuestro cotizador para poder así mejorar en nuestros servicios hacia nuestros clientes.
                        </p>
                    </div>       
                </section>
                <section class="redireccion">
                    <button>Encuesta</button>
                    <button>Home</button>
                </section>
                </main>
                ';
            }
    
        }
    

    };
}



























/* ##enviar la cotizacion
echo "<br>";
$url_envio='https://api.alegra.com/api/v1/estimates/'.$id_cotizacion.'/email';
#$params_envio="{\"emails\":[\"".$array_clientes[1][0]."\"], \"sendCopyToUser\":true }";
$params_envio="{\"emails\":[\""."segamboam@gmail.com"."\"], \"sendCopyToUser\":true }";
$envio_correo=request_alegra($url_envio,"POST",$params_envio);
print_r($envio_correo);
 */


/* $matriz_0=array();
escribir_datos(__DIR__."/temporalcsv/cotizacion_placas.csv",$matriz_0);
escribir_datos(__DIR__."/temporalcsv/cotizacion_implementos.csv",$matriz_0);
escribir_datos(__DIR__."/temporalcsv/cliente.csv",$matriz_0); */

/* #echo $cotizacion;
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.alegra.com/api/v1/estimates/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $cotizacion);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    #curl_setopt($ch, CURLOPT_USERPWD, 'jopavisos@gmail.com' . ':' . 'd88ed99150aa52140919');
    $usuario=base64_encode("jopavisos@gmail.com:d88ed99150aa52140919");
    
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Authorization: Basic '.$usuario;
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    print_r($result);       */