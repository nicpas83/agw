<?php

$err = array();

$_SESSION['tw'] = $_POST['tw'];
$_SESSION['planta'] = $_POST['planta'];
$_SESSION['depositante'] = $_POST['depositante'];
$_SESSION['poliza'] = $_POST['poliza'];

$plan_id = $_SESSION['planta'];
$depo_id = $_SESSION['depositante'];
$poli_nro = $_SESSION['poliza'];


//defino si muestro endoso o no
if($_SESSION['tw'] == "CMA"){
    $_SESSION['endoso'] = "S";
}else{
    $_SESSION['endoso'] = "N";
}


/** traigo datos de PLANTA  y creo variables de sesion */
$sql = "select * from plantas 
        LEFT OUTER JOIN provincias
        ON PLAN_PROV_ID = PROV_ID
        LEFT OUTER JOIN localidades
        ON PLAN_LOCA_ID = LOCA_ID
        where PLAN_ID = $plan_id";
$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
$fila = mysqli_fetch_array($result);

$_SESSION['plan_raso'] = $fila['PLAN_RASO'];
$_SESSION['plan_nombre'] = $fila['PLAN_NOMBRE'];
$_SESSION['plan_dom'] = $fila['PLAN_DOMICILIO'];
$_SESSION['plan_prov'] = $fila['PROV_NOMBRE'];
$_SESSION['plan_loca'] = $fila['LOCA_NOMBRE'];



/** traigo datos del depositante y creo variables de sesion */
$sql = "select * from depositantes 
        LEFT OUTER JOIN provincias
        ON DEPO_PROV_ID = PROV_ID
        LEFT OUTER JOIN localidades
        ON DEPO_LOCA_ID = LOCA_ID
        where DEPO_ID = $depo_id";
        
$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
$fila = mysqli_fetch_array($result);

$_SESSION['depo_raso'] = $fila['DEPO_RASO'];
$_SESSION['depo_cuit'] = $fila['DEPO_CUIT'];
$_SESSION['depo_domleg'] = $fila['DEPO_DOMLEG'];
$_SESSION['depo_prov'] = $fila['PROV_NOMBRE'];
$_SESSION['depo_loca'] = $fila['LOCA_NOMBRE'];


/** tarifas del depositante */
$sql = "select * from tarifas where TARI_DEPO_ID = $depo_id";
        
$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if(mysqli_num_rows($result) > 0){

    $fila = mysqli_fetch_array($result);
    
    $_SESSION['tari_emision'] = $fila['TARI_EMISION'];
    $_SESSION['tari_seguro'] = $fila['TARI_SEGURO'];
    $_SESSION['tari_otros'] = $fila['TARI_OTROS'];
    
    
}else{
    $err['tarifas'] = "No hay tarifas cargadas en el sistema para el depositante seleccionado.";
}



/** traigo datos de la póliza y creo variables de sesion */
$sql = "select * from polizas where POLI_POLIZA_NRO = '$poli_nro'";
        
$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if(mysqli_num_rows($result) > 0){
    
    $fila = mysqli_fetch_array($result);
    
    $_SESSION['poli_raso'] = $fila['POLI_RASO'];
    $_SESSION['poli_cobertura'] = $fila['POLI_COBERTURA'];
    $_SESSION['poli_domicilio'] = $fila['POLI_DOMLEG'];
    $_SESSION['poli_venc'] = $fila['POLI_VENC'];

}else{
    $err['poli'] = "El número de póliza ingresado no existe.";
}


/** si no hay errores, avanzo al paso 2 */
if(empty($err)){

    header("Location:emision.php?form=2");
    exit;  

}


?>