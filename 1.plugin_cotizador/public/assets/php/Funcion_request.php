<?php

function request_alegra($url_O,$tipo_request,$parametros){
    $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url_O);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $tipo_request);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$parametros);
        #####################
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

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
        return $result;

};
