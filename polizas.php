<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
	$menu_open = "gral"; 
    $title = "Pólizas TRO";

/** Proceso si viene por el formulario de New */
    if(isset($_POST['submit-new'])){
        include "process/polizas-process-new.php";
        echo "si";
        exit;
    }

/** Proceso si viene por el formulario de Edit */
    if(isset($_POST['submit-edit'])){
        include "process/polizas-process-edit.php";
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
        include "includes/polizas-form-new.php";    
    }
    
    /** EDIT */
    elseif(isset($_GET['edit'])){
        include "process/polizas-traigo-datos-edit.php";
        include "includes/polizas-form-edit.php";    
    }
    
    /** FICHA */
    elseif(isset($_GET['id'])){
        include "process/polizas-traigo-datos-ficha.php";
        include "includes/polizas-ficha-detalles.php";    
    }
    
    else{
        
        //viendo pólizas vigentes
        $state = 'S';
        $state_title = "Vigentes";
        $state_link = "<a href='polizas.php?state=N'>(ver Vencidas)</a>";
             
        //viendo pólizas vencidas
        if(isset($_GET['state'])){
            $state = $_GET['state'];
            $state_title = "Vencidas";
            $state_link = "<a href='polizas.php'>(ver Vigentes)</a>";
        }
        
        
        include "includes/polizas-listado.php";
    }

?>


<?php include "includes/footer.php" ?>