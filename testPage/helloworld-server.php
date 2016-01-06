<?php
//helloworld-server.php
// Insert the NuSOAP code
require_once('nusoap/lib/nusoap.php');

 // Create an instance of the server
$server = new soap_server;

$server->configureWSDL('ws_EE_Hello', 'http://localhost/EE/nusoap','http://localhost/EE/helloworld-server.php');
// This states the method which can be accessed.
$server->register(
    'hello',     // Nombre del método

  array( 'input' => 'xsd:string'),     // Parámetros de entrada

  array('return' => 'xsd:string'),    // Parámetros de salida

  'http://localhost/EE/helloworld-server.php',     // url

  'http://localhost/EE/nusoap' . '/hello',    //endpoint
  'urn:hellowsdl2#hello',                // soapaction
  'rpc',                        // style
  'encoded',                    // use
  'Greet a person entering the sweepstakes'    // documentation
 );

// This is the method
function hello($input) {
    $output_string = 'Hello ' . $input['firstname'] .
                '. You are ' . $input['age'] . ' years old.';

    if ( $input['age'] >= 18 ) { $allow = 1; }

    $output = array(
                'output_string' => $output_string,
                'allow' => $allow
                );

    return new soapval('return', 'HelloInfo', $output, false, 'urn:AnyURN');

}

// This returns the result
$server->service($HTTP_RAW_POST_DATA);
?>