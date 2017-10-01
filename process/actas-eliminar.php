<?php


$id = $_POST['id'];


$sql = "DELETE FROM actas WHERE ACTA_NRO = $id";
$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if($result){
    
    $sql = "DELETE FROM actas_almacenes_qx WHERE AAQX_ACTA_NRO = $id";
    $result2 = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    
    if($result2){
        header("Location: actas.php");
    }    
    
}


?>