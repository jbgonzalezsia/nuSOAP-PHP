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

function MetodoConsulta($param_id,$param_txt) {
    // Conectamos y seleccionamos la base de datos 
    $link = mysql_connect(localhost,usr_webservice,w3bs3rv1c3) or die("Error: ".mysql_error()); 
    $ddbb = mysql_select_db(db_webservice_nusoap) or die("Error: ".mysql_error());
    
    // Realizar una consulta MySQL 
    $query = "SELECT * FROM articulos WHERE id = '$param_id' AND txt = '$param_txt'"; 
    $result = mysql_query($query) or die('Consulta fallida: ' . mysql_error());
    
    // Tratamos los datos seleccionados 
    $row = mysql_fetch_array($result);
    
    // Obtenemos los campos buscados 
    $descripcion = $row['txt']; 
    $precio = $row['precio'];
    
    // Devolvemos el descriptivo y el precio consultado 
    return "RESULTADO = ".strtoupper($descripcion)." ".strtoupper($precio)."€";
    
    // Liberar resultados 
    mysql_free_result($result);
    
    // Cerrar la conexión 
    mysql_close($link); 
    
    }
 
    $dbservicio->service($HTTP_RAW_POST_DATA);
?>