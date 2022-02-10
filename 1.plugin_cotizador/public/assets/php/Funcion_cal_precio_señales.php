<?php
function mayor_menor($array,$direc) {
    if ($direc=="mayor") {
        $id=array_key_first($array);                
        $valor=$array[$id];
    } else {
        $id=array_key_last($array);
        $valor=$array[$id];               
    }
    return $valor;
}

  
#Variables de una cotizacion
function precios_señales($categoria,$area,$url){
    #Variables calculadas 
    #filtrar por categoria nuestro array de precios
    $precioSeñales = array_map('str_getcsv', file($url));
    $Matriz_filtrada=array_filter($precioSeñales,function($var) use ($categoria) {return $var[2]==$categoria;});

    #Codigo para ver las areas y calcular el precio.
    $valores =array_column($Matriz_filtrada, 5);
    $busca = $area;
    if (in_array($area, $valores)) {
        $id=array_search($busca,$valores);
        $precio=array_column($Matriz_filtrada,6)[$id];
        
    }else{ 
        $menor_array=array_filter($valores,function($var)use($area){return $var < $area;});
        $mayor_array=array_filter($valores,function($var)use($area){return $var > $area;});
        $menor=mayor_menor($menor_array,"menor");
        $mayor=mayor_menor($mayor_array,"mayor");
        $area_fil=$mayor;
        $pmayor=array_filter($Matriz_filtrada, function($var) use ($area_fil) {return $var[5]==$area_fil;});
        $pmayor=array_column($pmayor,6)[0];
        $area_fil=$menor;
        $pmenor=array_filter($Matriz_filtrada,function($var) use ($area_fil) {return $var[5]==$area_fil;});
        $pmenor=array_column($pmenor,6)[0];

        #calculo precio
        $m=($pmayor-$pmenor)/($mayor-$menor);
        $b=$pmayor-($m*$mayor);
        $precio=(($area*$m)+$b);
    }
    return $precio;
}


function precios_implementos($categoria,$url){
    $precioSeñales = array_map('str_getcsv', file($url));
    $Matriz_filtrada=array_filter($precioSeñales,function($var) use ($categoria){return $var[1]==$categoria;});
    $valores =array_column($Matriz_filtrada, 5);
    $valores=array_values($valores);
    $precio=array_shift($valores);
    return $precio;
}    
     