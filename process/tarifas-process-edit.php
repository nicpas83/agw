<?php

$tari_id = $_POST['tari_id'];  //viene de input hidden
$depo_id = $_POST['depo_id'];  //viene de input hidden

$fecha = trim(mysqli_real_escape_string($cnx,$_POST['fecha']));

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

$sql = "UPDATE tarifas SET
        TARI_FECHA = '$fecha',  
        TARI_DESDE = $desde, 
        TARI_HASTA = $hasta, 
        TARI_UNIDAD = '$unidad', 
        TARI_EMISION = '$emision',
        TARI_SEGURO = '$seguro', 
        TARI_OTROS = '$otros', 
        TARI_MIN = '$min'
        where TARI_ID = $tari_id
        ";

$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if($result){
    header("Location: tarifas.php?msg=ok&depo=$depo_id");
}else{
    echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
}

?>