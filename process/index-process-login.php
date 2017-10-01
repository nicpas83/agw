<?php
session_start();

include "../includes/conexion.php";

$usuario = trim(mysqli_real_escape_string($cnx,$_POST['usuario']));
$password = trim(mysqli_real_escape_string($cnx,$_POST['password']));


$sql = "select * from usuarios where USUA_USUARIO = '$usuario' AND USUA_PASSWORD = '$password'";
$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
$count = mysqli_num_rows($result);


if($count == 1){
    
    $fila = mysqli_fetch_array($result);
    $_SESSION['usuario'] = $fila['USUA_USUARIO'];
    $_SESSION['nombre'] = $fila['USUA_NOMBRE'];
    $_SESSION['raso'] = $fila['USUA_RASO'];
    $_SESSION['perfil'] = $fila['USUA_PERFIL'];
    $_SESSION['filtroPerfilId'] = $fila['USUA_FILTRO_ID'];
    
    
    //echo "si";
    echo "<meta http-equiv='refresh' content='0;url=../index.php'>";
    
}else{
    //echo "no";
    echo "<meta http-equiv='refresh' content='0;url=../index.php?msg=err'>";
}

?>