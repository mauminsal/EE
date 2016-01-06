<?php
require_once('nusoap/lib/nusoap.php');
echo '<h2>uno</h2>';

$client = new soapclient('http://127.0.0.1:80/EE/ws5.php?wsdl');
echo '<h2>dos</h2>';

$err = $client->getError();
if ($err) {
	echo '<h2>Constructor error</h2><pre>' . $err . '</pre>';
}

echo '<h2>tres</h2>';

$result = $client->call('ws5.getFood', array('nroTramiteAsd' => 1, 'idTramiteEe' => 2, 'idNuevoEstado' => 3));

echo '<h2>cuatro</h2>';


if ($client->fault) {
    echo '<h2>Fault</h2><pre>';
    print_r($result);
    echo '</pre>';
} else {
    $error = $client->getError();
    if ($error) {
        echo '<h2>Error</h2><pre>' . $error . '</pre>';
    } else {
        echo '<h2>Main</h2>';
        if ($result==1){
        echo "True";
        }else{
        echo "False";
        }
    }
}
echo '<h2>cinco</h2>';
$request = $client->request;
$url = $request;

echo $url;
echo '<h2>seis</h2>';


// show soap request and response
echo '<h2>Request</h2>';
echo '<pre>' . htmlspecialchars($client->request, ENT_QUOTES) . '</pre>';
echo '<h2>Response</h2>';
echo '<pre>' . htmlspecialchars($client->response, ENT_QUOTES) . '</pre>';
echo '<h2>seis</h2>';

?>