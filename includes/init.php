<?php
session_start();

// Verifica la session.
function verificar_sesion()
{
	if(!isset($_SESSION['usuario'])){
		header("Location: index.php?msg=log");
        exit();
        //echo "<meta http-equiv='refresh' content='0;url=index.php?msg=log'>";
	} 
}

function verificar_adm()
{
    if($_SESSION['perfil'] !== "adm"){
        header("Location: index.php");
        exit();
        
    }
    
}
?>