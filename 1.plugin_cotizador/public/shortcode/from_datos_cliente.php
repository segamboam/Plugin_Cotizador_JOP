<?php

function jop_script_cliente()
{
  wp_register_script("jop_cotizador_cliente",plugins_url("../assets/js/cliente_data.js",__FILE__));
  wp_localize_script("jop_cotizador_cliente","JOP",array(
    "rest_URL"=> rest_url("jop"),
    "home_URL"=> home_url(),
    "plugin_URL"=> plugins_url()
));
  wp_enqueue_script("jop_cotizador_cliente"); 
}

add_action("wp_enqueue_script","jop_script_cliente");

function jop_add_form_clientes(){
  jop_script_cliente();
  $url_cliente=plugins_url("../assets/css/clientes.css",__FILE__);
  $response = 
'
<head>
<link rel="stylesheet" href="'.$url_cliente.'">
</head>
<form class="clientes__form" id="clientes">
<div class="clientes__name name--campo">
<label for="Name">Nombre de la empresa</label>
<input name="NombreEmpresa" type="text" id="nEmpresa">
</div>
<div class="cliente_email name--campo">
<label for="email">Email</label>
<input name="email" type="email" id="nemail">
</div>
<div class="cliente__telefono name--campo">
<label for="Teñefono">Telefono</label>
<input name="Telefono" type="number" id="nTelefono">
</div>
<div class="cliente__direccion name--campo">
<label for="adress">Dirección</label>
<input name="direccion" type="text" id="direccion">
</div>

<div class="cliente__ciudad name--campo">
<label for="ciudad">ciudad</label>
<input name="ciudad" type="text" id="ciudad">
</div>

<div class="cliente__identificacion name--campo">
<label for="identificacion">Identificacion</label>
<input name="identificacion" type="numero" id="identificacion">
</div>


<div class="cliente__Tindentificacion name--campo">
<label for="tidentificacion">Tipo de indentificacion</label>
<input name="tidentificacion" type="text" id="tidentificacion">
</div>
<div class="Button_clientes">
<input type="submit" value="Create">
</div>

</form>
';
return $response;

}
add_shortcode("jop_cotizador_cliente","jop_add_form_clientes");


/* $response = 
'
<form class="clientes__form" id="clientes">
<div class="clientes__name name--campo">
<label for="Name">Nombre de la empresa</label>
<input name="NombreEmpresa" type="text" id="nEmpresa">
</div>
<div class="cliente_email name--campo">
<label for="email">Email</label>
<input name="email" type="email" id="nemail">
</div>
<div class="cliente__telefono name--campo">
<label for="Teñefono">Telefono</label>
<input name="Telefono" type="number" id="nTelefono">
</div>
<div class="cliente__direccion name--campo">
<label for="adress">Dirección</label>
<input name="direccion" type="text" id="direccion">
</div>

<div class="cliente__ciudad name--campo">
<label for="ciudad">ciudad</label>
<input name="ciudad" type="text" id="ciudad">
</div>

<div class="cliente__identificacion name--campo">
<label for="identificacion">Identificacion</label>
<input name="identificacion" type="numero" id="identificacion">
</div>


<div class="cliente__Tindentificacion name--campo">
<label for="tidentificacion">Tipo de indentificacion</label>
<input name="tidentificacion" type="text" id="tidentificacion">
</div>

<div class="signin__submit">
<input type="submit" value="Create">
</div>
</form>

' */