<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
    $menu_open = "adm"; 
    $title = "Emisión";

    if(isset($_GET['msg'])){
        if($_GET['msg'] == 'ok'){
            include "includes/msg-datos-almacenados-ok.php";
        }
    }   
    
/** Proceso si viene por el formulario de New1 */
    if(isset($_POST['submit-new1'])){
        include "process/emision-process-new1.php";
    }
    
/** Proceso si viene por el formulario de New2 */
    if(isset($_POST['submit-new2'])){
        include "process/emision-process-new2.php";
    }    

/** Cancelar  */
    if(isset($_POST['submit-cancelar'])){
        include "process/emision-process-cancelar.php";
    }     

/** Proceso si viene por el formulario de Edit */
    if(isset($_POST['submit-edit'])){
        include "process/emision-process-edit.php";
    }

?>
<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>




<?php 

    if(isset($_GET['msg']) and $_GET['msg'] == 'ok'){
        include "includes/msg-datos-almacenados-ok.php";
         
    }
    
    /** NEW 
    * Si el process-1 tiene error, continúa la ejecución sin crear $_GET.
    */
    if(!isset($_GET['form'])){
        include "includes/emision-form-new1.php";    
    }
    
    if(isset($_GET['form']) AND $_GET['form'] == 2){
        
        include "includes/emision-form-new2.php";    
    }
       

    /** FICHA */
    if(isset($_GET['id'])){
        include "process/emision-traigo-datos-ficha.php";
        include "includes/emision-ficha-detalles.php";    
    }
    

?>


<?php include "includes/footer.php" ?>