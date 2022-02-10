<?php
function id_items($categoria,$url)
{
    $precioSeñales = array_map('str_getcsv', file($url));
    $Matriz_filtrada=array_filter($precioSeñales,function($var) use ($categoria){return $var[2]==$categoria;});
    $valores =array_column($Matriz_filtrada, 1);
    $valores=array_values($valores);
    $id_item=array_shift($valores);
    return $id_item;

    
}

function id_items_I($categoria,$url)
{
    $precioSeñales = array_map('str_getcsv', file($url));
    $Matriz_filtrada=array_filter($precioSeñales,function($var) use ($categoria){return $var[1]==$categoria;});
    $valores =array_column($Matriz_filtrada, 0);
    $valores=array_values($valores);
    $id_item=array_shift($valores);
    return $id_item;

    
}