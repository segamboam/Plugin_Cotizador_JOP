<?php
function crear_items_($id_item,$des_item,$precio_item,$cant_item)
{
    $body_Cbody="{ \"id\": ".$id_item.",\"description\": \"".$des_item."\",\"price\": ".$precio_item.",\"quantity\": \"".$cant_item."\"}";
    return$body_Cbody;

}


/* $body_Cinit="\"items\" : [";
$body_Cfin="],\"warehouse\": 1}";


$item1=crear_items(974,"Señalizaciones",15000,3);
$item2=crear_items(975,"Señalizaciones x2",20000,5);
$body_c=$item1.",".$item2;
$body=$body_Cinit.$body_c.$body_Cfin;


$head_C="{\"date\": \"2022-01-26\",\"dueDate\": \"2022-01-26\",\"client\":{\"id\": 178},\"seller\" : {\"id\" : \"1\"},";
$cotizacion=$head_C.$body;
 */