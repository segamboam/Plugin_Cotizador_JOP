<?php
$ch = curl_init();
$id = 430; //id a consultar
curl_setopt($ch, CURLOPT_URL, "https://api.alegra.com/api/v1/estimates/$id");
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json','Content-type: application/json'));
curl_setopt($ch, CURLOPT_USERPWD, 'jopavisos@gmail.com:d88ed99150aa52140919');

// Captura la URL y la envía al navegador
curl_exec($ch);

// Cierrar el recurso cURL y libera recursos del sistema
curl_close($ch);


#curl -v -H "Accept: application/json" -H "Content-type: application/json" -X GET  https://api.alegra.com/api/v1/estimates/430 -u 'jopavisos@gmail.com:d88ed99150aa52140919'
#curl -v -H "Accept: application/json" -H "Content-type: application/json" -X POST  https://api.alegra.com/api/v1/estimates/430/email -u 'jopavisos@gmail.com:d88ed99150aa52140919' -d '{"emails":["segamboam@gmail.com"], "sendCopyToUser":true }'
