<?php


/////////////////// crear servidor//////////////////////
require_once('nusoap/lib/nusoap.php');

$miURL = 'http://localhost/EEMINSAL/nusoap';

$endpoint = 'http://127.0.0:80/EEMINSAL/wsdl_hello_server.php';

$server = new soap_server();

$server->configureWSDL('ws_regochan', $miURL,$endpoint);

$server->wsdl->schemaTargetNamespace=$miURL;


//////////////////////////funcion//////////////////////////
function ValidarCadena($cadena) {

 $respuesta= "invalido";

 if(strlen($cadena)>5){

 $cadena="valido";

 }

 return new soapval('return', 'xsd:string', $respuesta);

}

////////////////////////// registro de la funcion ///////////////////////
$server->register(

  'ValidarCadena',     // Nombre del método

  array( 'Cadena' => 'xsd:string'),     // Parámetros de entrada

  array('return' => 'xsd:string'),    // Parámetros de salida

  $miURL,     // url

  $endpoint."/ValidarCadena"    //endpoint

 );

$server->service($HTTP_RAW_POST_DATA);



?>