<?php
require_once 'lib/nusoap.php';

$cliente = new nusoap_client("http://nusoapwebservice-one.local/servicio.php", false);

$num1 = 78;
$num2 = 88;

$parametros = array('num1'=>$num1, 'num2'=>$num2);
$respuesta = cliente->call('MiFuncion',$parametros);
?>

