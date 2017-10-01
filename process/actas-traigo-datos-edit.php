<?php
$edit = trim(mysqli_real_escape_string($cnx, $_GET['edit']));

$s1 = "SELECT * FROM actas
        LEFT OUTER JOIN plantas
        ON ACTA_PLANTA_ID = PLAN_ID
        WHERE ACTA_NRO = $edit";

$r1 = mysqli_query($cnx, $s1) or die(mysqli_error($cnx));
$f1 = mysqli_fetch_array($r1);



$s2 = "SELECT * FROM actas_almacenes_qx WHERE AAQX_ACTA_NRO = $edit";

$r2 = mysqli_query($cnx, $s2) or die(mysqli_error($cnx));

//$count = mysqli_affected_rows($cnx);


//el fetch_array lo ejecuto en el form-edit dentro de un while
    


?>