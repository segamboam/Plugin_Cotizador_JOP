<?php
#$parametros="{\"emails\":[\"segamboam@gmail.com\"]";
$parametros="{\"emails\"=\"segamboam@gmail.com\"";
$correo="platziteam@platzi.com";
$correo="segamboam@gmail.com";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.alegra.com/api/v1/contacts?email=".$correo);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);

$usuario=base64_encode("jopavisos@gmail.com:d88ed99150aa52140919");
    
$headers = array();
$headers[] = 'Accept: application/json';
$headers[] = 'Authorization: Basic '.$usuario;
$headers[] = 'Content-Type: application/json';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    }
curl_close($ch);

print_r($result);