<?php
function crear_items_($id_item,$des_item,$precio_item,$cant_item)
{
    $body_Cbody="{ \"id\": ".$id_item.",\"description\": \"".$des_item."\",\"price\": ".$precio_item.",\"quantity\": \"".$cant_item."\"}";
    return$body_Cbody;

}


