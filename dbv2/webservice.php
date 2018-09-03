<?php 

require_once "lib/nusoap.php";

$server = new soap_server();
$server->configureWSDL("mi primer ws","urn:mundopccmb");

if(!isset($HTTP_RAW_POST_DATA)){
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
}


function cargarVehiculos(){
	$cn = mysqli_connect("localhost","root","","db_webservice_nusoap");
	$vehiculos = $cn->query("SELECT id,flota,p_neto FROM dbv2");
	$ArrVehiculos = [];
	while ($vehiculo = mysqli_fetch_array($vehiculos,MYSQLI_ASSOC)) {
		$ArrVehiculos[] = $vehiculo ;
	}
	return json_encode($ArrVehiculos);
}
 echo cargarVehiculos();