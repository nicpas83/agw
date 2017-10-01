<?php include "../includes/init.php"; 
verificar_sesion();
verificar_adm();
?>

<?php

$usuario = $_SESSION['usuario'];
$nombre = $_SESSION['nombre'];
$perfil = $_SESSION['perfil'];

session_unset();

session_start();

$_SESSION['usuario'] = $usuario;
$_SESSION['nombre'] = $nombre;
$_SESSION['perfil'] = $perfil;
    

header("Location: ../emision.php");
exit;




?>