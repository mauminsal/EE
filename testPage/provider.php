<?php


//1.- Incluimos la libreria nusoap dentro de nuestro archivo

require_once('nusoap/lib/nusoap.php');

//2.- Creamos la instancia al servidor

$server = new soap_server();

//3.- Inicializamos el soporte WSDL

$server->configureWSDL('hellowsdl2', 'urn:hellowsdl2');

//4.- Registramos la estructura de datos usado por el servicio

// Parametros de entrada
$server->wsdl->addComplexType(
'Person',
'complexType',
'struct',
'all',
'',
array(
'firstname' => array('name' => 'firstname', 'type' => 'xsd:string'),
'age' => array('name' => 'age', 'type' => 'xsd:int'),
'gender' => array('name' => 'gender', 'type' => 'xsd:string')
)
);
// Parametros de salida
$server->wsdl->addComplexType(
'SweepstakesGreeting',
'complexType',
'struct',
'all',
'',
array(
'greeting' => array('name' => 'greeting', 'type' => 'xsd:string'),
'winner' => array('name' => 'winner', 'type' => 'xsd:boolean')
)
);

//5.- Registramos el metodo a exponer

$server->register('hello',                // method name
array('person' => 'tns:Person'),        // input parameters
array('return' => 'tns:SweepstakesGreeting'),    // output parameters
'urn:hellowsdl2',                // namespace
'urn:hellowsdl2#hello',                // soapaction
'rpc',                        // style
'encoded',                    // use
'Greet a person entering the sweepstakes'    // documentation
);

//6.- Definimos el metodo como una función PHP

function hello($person) {
global $server;

$greeting = 'Hello, ' . $person['firstname'] .
'. It is nice to meet a ' . $person['age'] .
' year old ' . $person['gender'] . '.';

if (isset($_SERVER['REMOTE_USER'])) {
$greeting .= '  How do you know ' . $_SERVER['REMOTE_USER'] . '?';
}

$winner = $person['firstname'] == 'Scott';

return array(
'greeting' => $greeting,
'winner' => $winner
);
}

//7.- Usamos el pedido para invocar el servicio

$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
$server->service($HTTP_RAW_POST_DATA);

?>