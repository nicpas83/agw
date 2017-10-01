<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
	$menu_open = "gral"; 
    $title = "Plantas";

/** Proceso si viene por el formulario de New */
    if(isset($_POST['submit-new'])){
        include "process/plantas-process-new.php";
    }

/** Proceso si viene por el formulario de Edit */
    if(isset($_POST['submit-edit'])){
        include "process/plantas-process-edit.php";
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
        include "includes/plantas-form-new.php";    
    }
    
    /** EDIT */
    elseif(isset($_GET['edit'])){
        include "process/plantas-traigo-datos-edit.php";
        include "includes/plantas-form-edit.php";    
    }
    
    /** FICHA */
    elseif(isset($_GET['id'])){
        include "process/plantas-traigo-datos-ficha.php";
        include "includes/plantas-ficha-detalles.php";    
    }
    
    else{
        //viendo activas
        $state = 'A';
        $state_title = "Activas";
        $state_link = "<a href='plantas.php?state=I'>(ver Inactivas)</a>";
             
        //viendo inactivas
        if(isset($_GET['state'])){
            $state = $_GET['state'];
            $state_title = "Inactivas";
            $state_link = "<a href='plantas.php'>(ver Activas)</a>";
        }
        
        
        include "includes/plantas-listado.php";
    }

?>


<?php include "includes/footer.php" ?>