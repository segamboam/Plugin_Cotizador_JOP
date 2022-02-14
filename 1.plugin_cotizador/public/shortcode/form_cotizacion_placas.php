<?php

function jop_styles_coti(){
    wp_register_style("jop-cotizador-css",plugins_url("../assets/css/cotizador_items.css",__FILE__));
    wp_enqueue_style("jop-cotizador-css");

}

function jop_script_coti()
{
  wp_register_script("jop-cotizador-placa",plugins_url("../assets/js/cotizacion_placas.js",__FILE__));
  wp_localize_script("jop-cotizador-placa","JOP",array(
      "rest_URL"=> rest_url("jop"),
      "home_URL"=> home_url()
  ));
  wp_register_script("jop-cotizador-tabla",plugins_url("../assets/js/crearTablaCotizacion.js",__FILE__));
  
 
  wp_enqueue_script("jop-cotizador-placa");
  wp_enqueue_script("jop-cotizador-tabla");
  
}
function html_body(){
    $html = file_get_contents(plugins_url("../assets/html/cotizador_items.html",__FILE__));
    libxml_use_internal_errors(true); //Prevents Warnings, remove if desired
    $dom = new DOMDocument();
    $dom->loadHTML($html);
    $body = "";
    foreach($dom->getElementsByTagName("body")->item(0)->childNodes as $child) {
        $body .= $dom->saveHTML($child);
    }
    return $body;
}

add_action("wp_enqueue_script","jop_script_coti");

function jop_add_form_cot_placas(){
    jop_styles_coti();
    $body_items=html_body();    
    $response = $body_items;
    jop_script_coti();
    
    return $response;

}
add_shortcode("jop_cotizador_placa","jop_add_form_cot_placas");

/*         <td> Calcomania </td>
        <td> Fotoluminiscente </td>
        <td> 10 </td>
        <td> 30 </td>
        <td> 12 </td>
        <td> Color negro con rojo con logo inferior izquerda </td>
        <td>  Area de sllado </td>
        </tr>
        <tr>
        <td> Marquillas </td>
        <td> Acrilico Nacional </td>
        <td> 25 </td>
        <td> 4 </td>
        <td> 2 </td>
        <td> marquillas negrar para tablero 5 por cada numero </td>
        <td> ABC No (1 a 5) </td>
        </tr>  */;
/*         <a href="http://pruebasvarios.local/cotizador-cliente/"> 
 */

/* <table class="tablaPlacas">
<thead>
<tr>
<th>Tipo</th>
<th>Material</th>
<th>Cantidad</th>
<th>Ancho</th>
<th>Alto</th>
<th>Descripcion</th>
<th>Texto</th>    
</tr>
</thead>
<tbody>
<tr>
    <td> Placa </td>
    <td> Poliestireno </td>
    <td> 10 </td>
    <td> 20 </td>
    <td> 10 </td>
    <td> Color rojo con blanco Logo </td>
    <td> Perros peligrosos </td>
</tr>
<tr>
    <td> Marquillas </td>
    <td> Acrilico Americano </td>
    <td> 3 </td>
    <td> 5 </td>
    <td> 6 </td>
    <td> marquillas negrar para hotel </td>
    <td> Numeros de 201 a 203 </td>
    <tr>      
</tbody>
</table>

<table class="tablaImplementos">
<thead>
<tr>
<th>Descripcion</th>
<th>Tipo/Material</th>
<th>Tamaño</th>
<th>Cantidad</th>
<th>Especificaciones</th>
</tr>
</thead>
<tbody>
<tr>
    <td> Extintor </td>
    <td> Multipropósito </td>
    <td> 5 lbs </td>
    <td> 5 </td>
    <td> Es necesario revisar que este optimos </td>        
</tr>
<tr>
    <td> Camilla </td>
    <td> Con inmovilizador </td>
    <td> 185x45 Unica </td>
    <td> 2 </td>
    <td> Se necesita con todo los juguetes </td>
    <tr>      
</tbody>
</table> */