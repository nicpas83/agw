<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
	$menu_open = "gral";
    $title = "Inspectores";
    
/** Proceso si viene por el formulario de New */
    if(isset($_POST['submit-new'])){
        include "process/inspectores-process-new.php";
    }

/** Proceso si viene por el formulario de Edit */
    if(isset($_POST['submit-edit'])){
        include "process/inspectores-process-edit.php";
    }
    
    
?>
<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>




<?php

    if(isset($_GET['msg']) and $_GET['msg'] == 'ok'){
        include "includes/msg-datos-almacenados-ok.php";
        
    }

/** NEW */    
    if(isset($_GET['abm']) and $_GET['abm'] == 'alta'){
        include "includes/inspectores-form-new.php";
        
    }
/** FICHA */    
    elseif(isset($_GET['id'])){
        include "process/inspectores-traigo-datos-ficha.php";
        include "includes/inspectores-ficha-detalles.php";    
    
    }
/** EDIT */    
    elseif(isset($_GET['edit'])){
        include "process/inspectores-traigo-datos-edit.php";
        include "includes/inspectores-form-edit.php";
        
    }else{
        include "includes/inspectores-listado.php";
    }

?>


<?php include "includes/footer.php" ?>