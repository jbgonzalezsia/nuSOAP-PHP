<?php 

require_once "lib/nusoap.php";


$client = new nusoap_client("http://www.webservice.fya/index.php?wsdl");
$vehiculos = $client->call("cargarVehiculos",array("id"=>10));
$vehiculos = json_decode($vehiculos);

echo "<ul>";
foreach ($vehiculos as $vehiculo) {
	echo "<li>".$vehiculo->Codigo." ".$vehiculo->flota." ".$vehiculo->p_neto." "."</li>";
}
echo "</ul>";