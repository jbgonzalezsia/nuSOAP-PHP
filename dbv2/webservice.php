<?php 

require_once "lib/nusoap.php";

$server = new soap_server();
$server->configureWSDL("mi primer ws","urn:mundopccmb");

if(!isset($HTTP_RAW_POST_DATA)){
	$HTTP_RAW_POST_DATA = file_get_contents("php://input");
}


function cargarVehiculos($id){
	$cn = mysqli_connect("localhost","root","","db_transporte");
	$vehiculos = $cn->query("SELECT Codigo,flota,p_neto FROM vehiculos WHERE Codigo=".$id);
	$ArrVehiculos = [];
	while ($vehiculo = mysqli_fetch_array($vehiculos,MYSQLI_ASSOC)) {
		$ArrVehiculos[] = $vehiculo ;
	}
	return json_encode($ArrVehiculos);
}

$server->register("cargarVehiculos",array("id"=>"xsd:int"),
				 				    array("return"=>"xsd:string"),
				 				    "urn:mundopccmb",
				 				    "urn:mundopccmb#cargarVehiculos",
				 				    "rpc",
				 				    "encoded",
				 				    "Carga todos los vehículos"
				  );

$server->service($HTTP_RAW_POST_DATA);