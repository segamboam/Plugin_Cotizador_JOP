<?php
  
#Variables de una cotizacion
function precios_señales($categoria,$cantidad,$area){
    #Variables calculadas 
    #filtrar por categoria nuestro array de precios
    $precioSeñales = array_map('str_getcsv', file('Precios_Señalizacion.csv'));
    function filtro($var)
    {
        global $categoria;
        return $var[2]==$categoria;
    }
    $Matriz_filtrada=array_filter($precioSeñales,"filtro");

    #Codigo para ver las areas y calcular el precio.
    $valores =array_column($Matriz_filtrada, 5);
    $busca = $area;
    if (in_array($area, $valores)) {
        $id=array_search($busca,$valores);
        $precio=array_column($Matriz_filtrada,6)[$id] * $cantidad;
        
    }else{
            function menor($var)
        {
            global $area;
            $pp=$var < $area;
            return $pp;
        }
        function mayor($var)
        {
            global $area;
            return $var > $area;
        }
        
        function mayor_menor($array,$direc) {
            $valor=array_filter($array, $direc);
            
            if ($direc=="mayor") {
                $id=array_key_first($valor);
                
                $valor=$valor[$id];
            } else {
                $id=array_key_last($valor);
                $valor=$valor[$id];
               
            }
            return $valor;

        }
        $menor=mayor_menor($valores,"menor");
        $mayor=mayor_menor($valores,"mayor");
        $area_fil=$mayor;
        $pmayor=array_filter($Matriz_filtrada, function($var) use ($area_fil) {return $var[5]==$area_fil;});
        $pmayor=array_column($pmayor,6)[0];
        $area_fil=$menor;
        $pmenor=array_filter($Matriz_filtrada,function($var) use ($area_fil) {return $var[5]==$area_fil;});
        $pmenor=array_column($pmenor,6)[0];
    
        #calculo precio
        $m=($pmayor-$pmenor)/($mayor-$menor);
        $b=$pmayor-($m*$mayor);
        $precio=(($area*$m)+$b)* $cantidad ;
        
}  


    return $precio;
}
