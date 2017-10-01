<?php

$tipo = $_POST['tipo'];
$plan_id = $_GET['plan'];
$capacidad = $_POST['capacidad'];
$unidad = $_POST['unidad'];
$nombre_int = trim(mysqli_real_escape_string($cnx,$_POST['nombre_int']));
$aforo_num = $_POST['aforo_num'];
$aforo_dec = $_POST['aforo_dec'];
$aforo_tec = $aforo_num.".".$aforo_dec;



$sql = "INSERT INTO almacenes
        (ALMA_TIPO, ALMA_PLAN_ID, ALMA_CAPACIDAD, ALMA_UNIDAD, ALMA_NOMBRE_INT, ALMA_AFORO_TEC)
        VALUES
        ('$tipo','$plan_id','$capacidad','$unidad','$nombre_int','$aforo_tec')";

$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if($result){
    echo "<meta http-equiv='refresh' content='0;url=almacenes.php?msg=ok&plan=".$plan_id."'>";
}else{
    echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
}

?>