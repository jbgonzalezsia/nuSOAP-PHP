<!doctype html>
<html>
<head>
<title>Title</title>
<meta charset="utf-8"/>
</head>
<body>
<?php

include('lib/nusoap.php');
$dbcliente = new nusoap_client('http://nusoapwebservice-one.local/withdatabase/serviciodb.php?wsdl', 'wsdl');
$dbcliente->soap_defencoding = 'UTF-8';
$err = $dbcliente->getError();
if ($err) {	echo 'Error en Constructor' . $err ; }

$param = array('param_id' => '2','param_txt' => 'DVD');
$result = $dbcliente->call('MetodoConsulta', $param);



if ($dbcliente->fault) {
	echo 'Fallo';
	print_r($result);
} else {	// Chequea errores
	$err = $dbcliente->getError();
	if ($err) {		// Muestra el error
		echo 'Error' . $err ;
	} else {		// Muestra el resultado
		echo 'Resultado';
		print_r ($result);
	}
}

?>
</body>
</html>