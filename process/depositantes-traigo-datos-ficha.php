<?php
$id = $_GET['id'];

$sql = "SELECT * FROM depositantes
            LEFT OUTER JOIN provincias
            ON DEPO_PROV_ID = PROV_ID
            LEFT OUTER JOIN localidades
            ON DEPO_LOCA_ID = LOCA_ID
            LEFT OUTER JOIN tarifas
            ON TARI_DEPO_ID = $id
            WHERE DEPO_ID = $id";   //depositantes

$result = mysqli_query($cnx, $sql);
$fila = mysqli_fetch_array($result);



/**
 * Si hay provincia y localidad, ejecuto consulta INNER JOIN. 
 * MySQL no acepta FULL OUTER JOIN, por eso parto la query en 2. 
 */

if(!empty($fila['DEPO_PROV_ID'])){
    
    // preparo datos para mostrar en los value=""
    $provincia  = $fila['PROV_NOMBRE'];
    $localidad  = $fila['LOCA_NOMBRE'];

}else{
    $provincia  = "";
    $localidad  = "";
}        



?>