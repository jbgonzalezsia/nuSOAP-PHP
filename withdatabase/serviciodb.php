<?php 
require_once "lib/nusoap.php";

$server = new soap_server();
$server->configureWSDL("WebService nuSOAP - PHP","urn:mundopccmb");

if(!isset($HTTP_RAW_POST_DATA)){
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
}


function cargarVehiculos(){
	$cn = mysqli_connect("localhost","root","","db_webservice_nusoap");
	$vehiculos = $cn->query("SELECT id,txt,precio FROM articulos");

	$ArrVehiculos = [];
	while ($vehiculo = mysqli_fetch_array($vehiculos,MYSQLI_ASSOC)) {
		$ArrVehiculos[] = $vehiculo ;
	}
	return json_encode($ArrVehiculos);
}
 //echo cargarVehiculos();
 $server->register("cargarVehiculos",array(),
				 				    array("return"=>"xsd:string"),
				 				    "urn:mundopccmb",
				 				    "urn:mundopccmb#cargarVehiculos",
				 				    "rpc",
				 				    "encoded",
				 				    "Carga todos los vehículos"
				  );

$server->service($HTTP_RAW_POST_DATA);
?>