<?php
include "../includes/conexion.php";


$plan_id = $_POST['planta'];


//verifico estado original
$sql = "SELECT PLAN_STATE FROM plantas WHERE PLAN_ID = '$plan_id'";
$result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));
$fila = mysqli_fetch_array($result);

if($fila['PLAN_STATE'] == "A"){
    $new_state = "I";
}else{
    $new_state = "A";
}

//actualizo estado.
$sql = "UPDATE plantas SET PLAN_STATE = '$new_state' WHERE PLAN_ID = '$plan_id'";
$result2 = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));

if($result2){
    echo "true";
}


?>