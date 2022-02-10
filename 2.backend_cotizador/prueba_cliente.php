<?php

function request_Contacto($urlO,$tipo_request,$parametros){
    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlO);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $tipo_request);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);
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
        return $result;

};


$Nombre_Empresa="Platzi-Teams";
$email_cliente="platziteam@platzi.com";
$telefono_cliente="3234567890";
$Direccion_cliente="Calle falsa 123";
$ciudad_cliente="Bogotá, D.C.";
$Identificacion="1234567891";
$Tipo_identificacion="NIT"; #CC 

/* $Nombre_Empresa="Freddy Beltranita";
$email_cliente="Freduardo@platzi.com";
$telefono_cliente="3214567890";
$Direccion_cliente="Avenida siempreviva 742";
$ciudad_cliente="Bogotá, D.C.";
$Identificacion="1031178119";
$Tipo_identificacion="CC"; #NIT 
 */
$params= '{"name": {"firstName": "'.$Nombre_Empresa.'", "lastName" : " "},"identificationObject": {"type": "'.$Tipo_identificacion.'", "number": "'.$Identificacion.'"} , "email": "'.$email_cliente.'", "phonePrimary": "'.$telefono_cliente.'", "address":{"description":"'.$Direccion_cliente.'", "city":"'.$ciudad_cliente.'"}}'; 

$csv = array_map('str_getcsv', file('C:\xampp\htdocs\APIJOPAvisos\contactos.csv'));

$emails = array_column($csv, 2);
$telefonos = array_column($csv, 1);

if( in_array( $email_cliente ,$emails))
    {
        $id=array_search($email_cliente,$emails);
        $id=$csv[$id][0];
        $url='https://api.alegra.com/api/v1/contacts/'.$id;
        $result=request_Contacto($url,'PUT',$params);  
        echo "contacto actualizado con el id ".$id;
            
        
    } else {
        $url='https://api.alegra.com/api/v1/contacts/';
        $result=request_Contacto($url,'POST',$params);
        $array= json_decode($result,true);
        $id=$array["id"];
        echo "<br>"."crear contacto con el id ".$id;
    }

