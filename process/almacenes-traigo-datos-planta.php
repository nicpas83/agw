<?php

/**
 * Traigo datos de planta seleccionada.
 */

if(isset($_GET['plan'])){
    
    $plan_id = $_GET['plan'];
    $sql = "select plantas.PLAN_NOMBRE, almacenes.* 
            from plantas LEFT OUTER JOIN almacenes
            ON plantas.PLAN_ID = almacenes.ALMA_PLAN_ID
            where plantas.PLAN_ID = '$plan_id'";

    $result = mysqli_query($cnx,$sql);
    $fila = mysqli_fetch_array($result);
 
}



?>