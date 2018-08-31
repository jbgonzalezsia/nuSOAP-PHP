<?php
include('lib/nusoap.php');
$server = new soap_server();
$server->configureWSDL('Servidor', 'urn:Servidor');

$server->register('MetodoConsulta',
    array('param_id' => 'xsd:string','param_txt' => 'xsd:string'),
    array('return' => 'xsd:string'),
    'urn:MetodoConsultawsdl',
    'urn:MetodoConsultawsdl#MetodoConsulta',
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
    $HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
    $server->service($HTTP_RAW_POST_DATA);
?>