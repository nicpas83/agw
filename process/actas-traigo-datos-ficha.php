<?php
$acta_nro = mysqli_real_escape_string($cnx, $_GET['id']);

$s1 = "SELECT * FROM actas 
        LEFT OUTER JOIN plantas
        ON ACTA_PLANTA_ID = PLAN_ID
        LEFT OUTER JOIN inspectores
        ON ACTA_INSPECTOR_ID = INSP_ID
        WHERE ACTA_NRO = $acta_nro";

$result = mysqli_query($cnx, $s1) or die(mysqli_error($cnx));
$fila = mysqli_fetch_array($result);


$s2 = "SELECT * FROM actas_almacenes_qx WHERE AAQX_ACTA_NRO = $acta_nro";

$result = mysqli_query($cnx, $s2) or die(mysqli_error($cnx));

    


?>