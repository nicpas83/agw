<?php

$fecha = trim(mysqli_real_escape_string($cnx,$_POST['fecha']));
$depo_id = $_GET['depo'];

if(empty($_POST['desde'])){
    $desde = "NULL";
}else{
    $desde = trim(mysqli_real_escape_string($cnx,$_POST['desde']));
    $desde = "$desde";    
}

if(empty($_POST['hasta'])){
    $hasta =  "NULL";
}else{
    $hasta = trim(mysqli_real_escape_string($cnx,$_POST['hasta']));
    $hasta = "$hasta";
}


$unidad = $_POST['unidad'];
$emision = trim(mysqli_real_escape_string($cnx,$_POST['emision']));
$seguro = trim(mysqli_real_escape_string($cnx,$_POST['seguro']));
$otros = trim(mysqli_real_escape_string($cnx,$_POST['otros']));
$min = trim(mysqli_real_escape_string($cnx,$_POST['min']));

$sql = "INSERT INTO tarifas
        (TARI_FECHA, TARI_DEPO_ID, TARI_DESDE, TARI_HASTA, TARI_UNIDAD, TARI_EMISION
        ,TARI_SEGURO, TARI_OTROS, TARI_MIN)
        VALUES
        ('$fecha','$depo_id',$desde,$hasta,'$unidad','$emision', '$seguro', '$otros', '$min')";

$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if($result){
    header("Location: tarifas.php?msg=ok&depo=$depo_id");
}else{
    echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
}

?>