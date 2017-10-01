<?php
$id = trim(mysqli_real_escape_string($cnx, $_GET['id']));

$sql = "SELECT * FROM polizas
            LEFT OUTER JOIN provincias
            ON POLI_PROV_ID = PROV_ID
            LEFT OUTER JOIN localidades
            ON POLI_LOCA_ID = LOCA_ID
            WHERE POLI_ID = $id";   

$result = mysqli_query($cnx, $sql) ;
$fila = mysqli_fetch_array($result);



/**
 * Si hay provincia y localidad, ejecuto consulta INNER JOIN. 
 * MySQL no acepta FULL OUTER JOIN, por eso parto la query en 2. 
 */

if(!empty($fila['POLI_PROV_ID'])){
    
    // preparo datos para mostrar en los value=""
    $provincia  = $fila['PROV_NOMBRE'];
    $localidad  = $fila['LOCA_NOMBRE'];

}else{
    $provincia  = "";
    $localidad  = "";
}        



?>