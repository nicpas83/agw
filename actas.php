<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php require_once "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
	$menu_open = "adm"; 
    $title = "Actas de Inspección";

/** Proceso si viene por el formulario de New2 */
    if(isset($_POST['submit-new2'])){        
        include "process/actas-process-new.php";
    }


/** Proceso si viene por el formulario de EDIT */
    if(isset($_POST['submit-edit'])){        
        include "process/actas-process-edit.php";
    }

/** Proceso si viene por el formulario de EDIT */
    if(isset($_POST['submit-eliminar'])){        
        include "process/actas-eliminar.php";
    }
    
?>

<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>


<?php 

if(isset($_GET['msg']) and $_GET['msg'] == 'ok'){
    include "includes/msg-datos-almacenados-ok.php";
     
}

/** NEW 1 */    
if(!isset($_GET['id']) AND !isset($_GET['edit']) AND !isset($_GET['abm'])){
    
    if(!isset($_POST['submit-new1'])){
    
        include "includes/actas-listado.php";

    }
}    

if(isset($_GET['abm']) and $_GET['abm'] == "alta"){
    
    include "includes/actas-form-new1.php";
}

if(isset($_GET['abm']) and $_GET['abm'] == "baja" and isset($_GET['id'])){
    $id = trim(mysqli_real_escape_string($cnx, $_GET['id']));
    include "includes/actas-msg-confirma-eliminar.php";
}   


/** NEW 2 */    
if(isset($_POST['submit-new1'])){
    include "includes/actas-form-new2.php";   
}



/** FICHA */    
if(isset($_GET['id'])){
    include "process/actas-traigo-datos-ficha.php";
    include "includes/actas-ficha-detalles.php";    
}

/** EDIT */    
if(isset($_GET['edit'])){
    include "process/actas-traigo-datos-edit.php";
    include "includes/actas-form-edit.php";
      
}


?>



<?php include "includes/footer.php" ?>