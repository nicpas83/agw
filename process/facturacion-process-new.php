<?php
$err = array();

// campos hidden
/** Tabla Facturacion*/
$tipo = trim(mysqli_real_escape_string($cnx, $_POST['tipo']));
$ptovta = trim(mysqli_real_escape_string($cnx, $_POST['ptovta']));
$nro = trim(mysqli_real_escape_string($cnx, $_POST['nro']));
$fecha = trim(mysqli_real_escape_string($cnx, $_POST['fecha']));
$depo_id = $_POST['depo_id'];
$desde = $_POST['desde'];
$hasta = $_POST['hasta'];

$emision = $_POST['total_emision'];
$seguro = $_POST['total_seguro'];
$otros = trim(mysqli_real_escape_string($cnx, $_POST['otros']));
$subtotal = $emision + $seguro;
$total = ($subtotal + $otros) *1.21;
$iva_total = $total - $subtotal - $otros;

$dto_emision = trim(mysqli_real_escape_string($cnx, $_POST['dto_emision']));
$dto_seguro = trim(mysqli_real_escape_string($cnx, $_POST['dto_seguro']));
$dto_total = $dto_emision + $dto_seguro;

$tar_emi = $_POST['tar_emi'];
$tar_seg = $_POST['tar_seg'];
$coment = trim(mysqli_real_escape_string($cnx, $_POST['coment']));
$tc = $_POST['tc'];





$sql = "insert into facturacion
        (FACT_TIPO, FACT_PTOVTA, FACT_NRO, FACT_FECHA, FACT_DEPO_ID, FACT_DESDE, FACT_HASTA, FACT_EMISION,
         FACT_SEGURO, FACT_OTROS, FACT_SUBTOTAL, FACT_TOTAL, FACT_IVA_TOTAL, FACT_IVA, FACT_DTO_EMISION, 
         FACT_DTO_SEGURO, FACT_DTO_TOTAL, FACT_TAR_EMI, FACT_TAR_SEG, FACT_ESTADO, FACT_COMENT, FACT_TC)
        values
        ('$tipo', '$ptovta', '$nro', '$fecha', '$depo_id', '$desde', '$hasta', '$emision', '$seguro', '$otros',
         '$subtotal', '$total', '$iva_total', '21', '$dto_emision', '$dto_seguro', '$dto_total', '$tar_emi', '$tar_seg', 
         'Pendiente', '$coment', '$tc')";

$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if($result){

    $_SESSION['desde'] = $desde;
    $_SESSION['hasta'] = $hasta;

    header("Location: facturacion.php?msg=ok");
    
}else{
    
    echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";

}

?>