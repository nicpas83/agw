<?php
$id_insp = mysqli_real_escape_string($cnx, $_GET['id']);

$sql = "SELECT * FROM inspectores WHERE INSP_ID = $id_insp";

$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
$fila = mysqli_fetch_array($result);

/**
 * Si hay provincia y localidad, ejecuto consulta INNER JOIN. 
 * MySQL no acepta FULL OUTER JOIN, por eso parto la query en 2. 
 */

if(!empty($fila['INSP_PROV_ID'])){
    
    $sql_inner = "SELECT PROV_NOMBRE, LOCA_NOMBRE FROM inspectores
                    INNER JOIN provincias
                    ON INSP_PROV_ID = PROV_ID
                    INNER JOIN localidades
                    ON INSP_LOCA_ID = LOCA_ID
                    WHERE INSP_ID = $id_insp";
    
    $result = mysqli_query($cnx, $sql_inner);
    $datos_inner = mysqli_fetch_array($result);
    // preparo datos para mostrar en los value=""
    $provincia  = $datos_inner['PROV_NOMBRE'];
    $localidad  = $datos_inner['LOCA_NOMBRE'];

}else{
    $provincia  = "";
    $localidad  = "";
}        


?>