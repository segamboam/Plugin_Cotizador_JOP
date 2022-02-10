<?php
$body_Cinit="\"items\" : [";
$body_Cfin="],\"warehouse\": 1}";

function crear_items($id_item,$des_item,$precio_item,$cant_item)
{
    $body_Cbody="{ \"id\": ".$id_item.",\"description\": \"".$des_item."\",\"price\": ".$precio_item.",\"quantity\": \"".$cant_item."\"}";
    return$body_Cbody;

}
$item1=crear_items(974,"Señalizaciones",15000,3);
$item2=crear_items(975,"Señalizaciones x2",20000,5);
$body_c=$item1.",".$item2;
$body=$body_Cinit.$body_c.$body_Cfin;


$head_C="{\"date\": \"2022-01-26\",\"dueDate\": \"2022-01-26\",\"client\":{\"id\": 178},\"seller\" : {\"id\" : \"1\"},";
$cotizacion=$head_C.$body;


#####################3
$cotiz="{\"date\": \"2022-01-26\",\"dueDate\": \"2022-01-26\",\"client\":{\"id\": 178},\"seller\" : {\"id\" : \"1\"},\"items\" : [{ \"id\": 974,\"description\": \"Velocidad max 20 km\",\"price\": 45000,\"quantity\": \"3\"}],\"warehouse\": 1}";
#$cotizaciones="{\"date\": \"2022-01-26\",\"dueDate\": \"2022-01-26\",\"client\":{\"id\": 178},\"seller\" : {\"id\" : \"1\"},\"items\" : [{ \"id\": 974,\"description\": \"Velocidad max 20 km\",\"price\": 45000,\"quantity\": \"3\"},{\"id\": 975,\"description\": \"Zona de Cargue y Descargue\",\"price\": 55000,\"quantity\": \"2.00\"}],\"warehouse\": 1}";


    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, 'https://api.alegra.com/api/v1/estimates/');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$cotizacion);
    curl_setopt($ch, CURLOPT_USERPWD, 'jopavisos@gmail.com' . ':' . 'd88ed99150aa52140919');
    
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'Content-Type: application/json';
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    print_r($result);