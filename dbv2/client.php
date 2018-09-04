<?php 

require_once "lib/nusoap.php";


$client = new nusoap_client("http://nusoapwebservice-one.local/dbv2/webservice.php?wsdl");
$vehiculos = $client->call("cargarVehiculos",array("id"=>1));
$vehiculos = json_decode($vehiculos);

echo "<ul>";
foreach ($vehiculos as $vehiculo) {
	echo "<li>ID:".$vehiculo->id." - MODELO:".$vehiculo->modelo." - FLOTA:".$vehiculo->flota." - PESO NETO:".$vehiculo->p_neto." "."</li>";
} 
echo "</ul>";