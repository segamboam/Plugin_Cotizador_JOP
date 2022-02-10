<?php
function itemsAll($array,$url_local){
    $items="_________";
    $Lenght_IC=count($array);
    for ($i = 0; $i < $Lenght_IC; $i++) {
        $items_C=str_getcsv($array[$i][0], $separator=",");
        $area=$items_C[3]*$items_C[4];
        $categoria=$items_C[0]." ".$items_C[1];
        $precio=precios_señales($categoria,$items_C[2],$area,$url_local."public/temporalcsv/Precios_Señalizacion.csv");
        $id_items=id_items($categoria,$url_local."public/temporalcsv/Precios_Señalizacion.csv");
        $descripcion=$categoria." -Tamaño: ".$items_C[3]."x".$items_C[4]." -Especificaciones: ".$items_C[5]." -texto: ".$items_C[5];
        $item=crear_items($id_items,$descripcion,$precio,$items_C[2]);
        $items=$items.",".$item;
        /*   if ($i=0){
          $items=$items.",".$item;
        }else{
          $items=$item;
        }*/} 
    return $items;
}