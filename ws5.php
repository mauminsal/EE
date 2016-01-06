<?php
require_once('nusoap/lib/nusoap.php');

class ws5 {
    public function getFood($nroTramiteAsd, $idTramiteEe, $idNuevoEstado) {
        $booResult = false;
        if($nroTramiteAsd != "" && $nroTramiteAsd == "0"){
          $booResult  = false;
        }else
        {
        $booResult  = true;
        }
        if($idTramiteEe != ""){
		  $booResult  = true;
        }
        if($idNuevoEstado != ""){
		  $booResult  = true;
        }
        return $booResult;
    }
}


$server = new soap_server();
$server->configureWSDL("foodservice", "http://127.0.0.1:80/EE/foodservice");

$server->register("ws5.getFood",
    array("nroTramiteAsd" => "xsd:int", "idTramiteEe" => "xsd:int", "idNuevoEstado" => "xsd:int"),
    array("return" => "xsd:boolean"),
    "http://127.0.0:80/EE/foodservice",
    "http://127.0.0:80/EE/foodservice#getFood",
    "rpc",
    "encoded",
    "Get food by type");

@$server->service($HTTP_RAW_POST_DATA);

?>