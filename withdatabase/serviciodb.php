<?php

$GLOBALS['HTTP_RAW_POST_DATA'] = file_get_contents ('php://input');
$HTTP_RAW_POST_DATA = $GLOBALS['HTTP_RAW_POST_DATA'];
include('lib/nusoap.php');
$dbservicio = new soap_server();
$dbservicio->soap_defencoding = 'UTF-8';
$ns = 'urn:Servidor';
$dbservicio->configureWSDL('Web Service PHP MySQL - nuSOAP', $ns );

$dbservicio->register('MetodoConsulta',
    array('param_id' => 'xsd:string','param_txt' => 'xsd:string'),
    array('return' => 'xsd:string'), $ns,
    'urn:MetodoConsultawsdl',
    'urn:MetodoConsultawsdl#MetodoConsulta',
    // soapaction: (use default)
    false,
    'rpc',
    'encoded',
    'Retorna el datos'
);
function MetodoConsulta() {
    $mysqli = mysqli_connect("127.0.0.1", "root", "", "db_webservice_nusoap");
    $mysqli->set_charset("utf8");
    $articulos = $mysqli->query("SELECT id,txt,precio FROM articulos");

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    echo "Connected successfully<br>";
    
    $ArrArticulos = [];
	while ($articulo = mysqli_fetch_array($articulos,MYSQLI_ASSOC)) {
		$ArrArticulos[] = $articulo ;
	}     
    return json_encode($ArrArticulos);
}
echo MetodoConsulta();
?>