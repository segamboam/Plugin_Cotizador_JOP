<?php
require __DIR__ . '/Funcion_cal_precio_señales.php';

$tipoProducto="Marquillas"; 
$cantidad=7;
$material="Acrilico Americano";
$ancho=6;
$alto=3;
$descripcion="Es una placa xyz";
$texto="Holisss";
$area=$ancho*$alto;
$categoria=$tipoProducto." ".$material;
$precio=precios_señales($categoria,$cantidad,$area);
echo $precio;
/* 
$htmlContent = file_get_contents("http://localhost:8080/APIJOPAvisos/webcotizacion1.html");
		
$DOM = new DOMDocument();
$DOM->loadHTML($htmlContent);

$Header = $DOM->getElementsByTagName('th');
$Detail = $DOM->getElementsByTagName('td');

//#Get header name of the table
foreach($Header as $NodeHeader) 
{
    $aDataTableHeaderHTML[] = trim($NodeHeader->textContent);
}
//print_r($aDataTableHeaderHTML); die();
//#Get row data/detail table without header name as key
$i = 0;
$j = 0;
foreach($Detail as $sNodeDetail) 
{
    $aDataTableDetailHTML[$j][] = trim($sNodeDetail->textContent);
    $i = $i + 1;
    $j = $i % count($aDataTableHeaderHTML) == 0 ? $j + 1 : $j;
}
#print_r($aDataTableDetailHTML); die();
	
	//#Get row data/detail table with header name as key and outer array index as row number
	for($i = 0; $i < count($aDataTableDetailHTML)-1; $i++)
	{
		for($j = 0; $j < count($aDataTableHeaderHTML); $j++)
		{
			$aTempData[$i][$aDataTableHeaderHTML[$j]] = $aDataTableDetailHTML[$i][$j];
		}
	}
	$aDataTableDetailHTML = $aTempData; unset($aTempData);
    print_r($aDataTableDetailHTML); die();


	

    

     */