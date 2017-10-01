<?php
$err = array();


$raso           =  trim(mysqli_real_escape_string($cnx, $_POST['raso']));
$cuit           =  trim(mysqli_real_escape_string($cnx, $_POST['cuit']));
$domleg         =  trim(mysqli_real_escape_string($cnx, $_POST['domleg']));
$domfis         =  trim(mysqli_real_escape_string($cnx, $_POST['domfis']));
//$domcom         =  trim(mysqli_real_escape_string($cnx, $_POST['domcom']));
$prov_id        =  $_POST['prov_id'];
$loca_id        =  $_POST['loca_id'];
$cobertura      =  trim(mysqli_real_escape_string($cnx, $_POST['cobertura']));
$poliza_nro     =  trim(mysqli_real_escape_string($cnx, $_POST['poliza_nro']));
$venc           =  trim(mysqli_real_escape_string($cnx, $_POST['venc']));
$propia         = $_POST['propia'];



//include "validaciones-plantas.php";
/**
 * Validacion que no exista Razon Social y/o CUIT.
 */

$sql = "select * from polizas where POLI_POLIZA_NRO = '$poliza_nro'";
$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
@$filas = mysqli_num_rows($result);


if($filas > 0){
    $err['existe'] = "<p style='color: red;'>El número de póliza ingresado ya existe en tabla pólizas. Use el botón 'atrás' de su navegador para corregir.</p>";
        
}


if(empty($err)){
    
    $sql = "INSERT INTO polizas
    (POLI_RASO, POLI_CUIT, POLI_DOMLEG, POLI_DOMFIS, POLI_PROV_ID, POLI_LOCA_ID, POLI_COBERTURA, POLI_POLIZA_NRO, POLI_VENC, POLI_PROPIA, POLI_VIGENTE)
    VALUES        
    ('$raso', $cuit, '$domleg', '$domfis', '$prov_id', '$loca_id', '$cobertura', '$poliza_nro', '$venc', '$propia', 'S')";
    
    $insert = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

    if($insert){
        header("Location: polizas.php?msg=ok");
        

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }
    
}
    

?>