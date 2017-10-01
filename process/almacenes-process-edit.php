<?php
$plan_id = $_POST['plan_id'];  // viene por input hidden
$alma_id = $_POST['alma_id']; // viene por input hidden

$tipo = $_POST['tipo'];
$capacidad = $_POST['capacidad'];
$unidad = $_POST['unidad'];
$nombre_int = trim(mysqli_real_escape_string($cnx,$_POST['nombre_int']));
$aforo_num = $_POST['aforo_num'];
$aforo_dec = $_POST['aforo_dec'];
$aforo_tec = $aforo_num.".".$aforo_dec;



$sql = "UPDATE almacenes 
        SET
        ALMA_TIPO = '$tipo', 
        ALMA_CAPACIDAD = '$capacidad', 
        ALMA_UNIDAD = '$unidad', 
        ALMA_NOMBRE_INT = '$nombre_int', 
        ALMA_AFORO_TEC = '$aforo_tec'
        where ALMA_ID = $alma_id
        ";

$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if($result){
    
    echo "<meta http-equiv='refresh' content='0;url=almacenes.php?msg=ok&plan=".$plan_id."'>"; 
    
}else{
    echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
}

?>