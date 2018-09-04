<?php 

require_once "lib/nusoap.php";


$client = new nusoap_client("http://nusoapwebservice-one.local/withdatabase/serviciodb.php?wsdl");
$vehiculos = $client->call("cargarVehiculos");
$vehiculos = json_decode($vehiculos);

echo "<ul>";
foreach ($vehiculos as $vehiculo) {
	echo "<li>ID:".$vehiculo->id." - TXT:".$vehiculo->txt." - PRECIO:".$vehiculo->precio." "."</li>";
} 
echo "</ul>";