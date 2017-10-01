<?php
$id = $_GET['id'];

$sql = "SELECT * FROM beneficiarios
            LEFT OUTER JOIN provincias
            ON BENE_PROV_ID = PROV_ID
            LEFT OUTER JOIN localidades
            ON BENE_LOCA_ID = LOCA_ID
            LEFT OUTER JOIN tarifas
            ON TARI_DEPO_ID = $id
            WHERE BENE_ID = $id";   

$result = mysqli_query($cnx, $sql);
$fila = mysqli_fetch_array($result);



/**
 * Si hay provincia y localidad, ejecuto consulta INNER JOIN. 
 * MySQL no acepta FULL OUTER JOIN, por eso parto la query en 2. 
 */

if(!empty($fila['BENE_PROV_ID'])){
    
    // preparo datos para mostrar en los value=""
    $provincia  = $fila['PROV_NOMBRE'];
    $localidad  = $fila['LOCA_NOMBRE'];

}else{
    $provincia  = "";
    $localidad  = "";
}        



?>