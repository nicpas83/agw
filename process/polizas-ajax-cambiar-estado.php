<?php
include "../includes/conexion.php";


$poli_nro = $_POST['poli'];


//verifico estado original
$sql = "SELECT POLI_VIGENTE FROM polizas WHERE POLI_POLIZA_NRO = '$poli_nro'";
$result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));
$fila = mysqli_fetch_array($result);

if($fila['POLI_VIGENTE'] == "S"){
    $new_state = "N";
}else{
    $new_state = "S";
}

//actualizo estado.
$sql = "UPDATE polizas SET POLI_VIGENTE = '$new_state' WHERE POLI_POLIZA_NRO = '$poli_nro'";
$result2 = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));

if($result2){
    echo "true";
}else{
    echo "false";
}


?>