<?php
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.alegra.com/api/v1/estimates/430/email');
#curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "{\"emails\":[\"segamboam@gmail.com\"], \"sendCopyToUser\":true }");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
#curl_setopt($ch, CURLOPT_USERPWD, 'jopavisos@gmail.com' . ':' . 'd88ed99150aa52140919');
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