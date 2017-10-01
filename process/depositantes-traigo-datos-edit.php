<?php
$depo_id = $_GET['edit'];

$sql = "SELECT * FROM depositantes
        LEFT OUTER JOIN provincias
        ON DEPO_PROV_ID = PROV_ID
        LEFT OUTER JOIN localidades
        ON DEPO_LOCA_ID = LOCA_ID
            WHERE DEPO_ID = $depo_id";   //depositantes

$result = mysqli_query($cnx, $sql);
$fila = mysqli_fetch_array($result);

$prov_select_id = $fila['DEPO_PROV_ID']; 
$loca_select_id = $fila['DEPO_LOCA_ID'];
$provincia = "";
    

/**
 * Si hay provincia y localidad, ejecuto consulta INNER JOIN. 
 * MySQL no acepta FULL OUTER JOIN, por eso parto la query en 2. 
 */

if($prov_select_id <> ""){
    
    // preparo datos para mostrar en los value=""
    $provincia  = $fila['PROV_NOMBRE'];
    $localidad  = $fila['LOCA_NOMBRE'];
}


?>