<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>



<?php
/** Proceso si viene por el formulario de New */
if(isset($_POST['submit-new'])){
    include "process/almacenes-process-new.php";
}

/** Proceso si viene por el formulario de Edit */
if(isset($_POST['submit-edit'])){
    include "process/almacenes-process-edit.php";
}


?>

<?php
	$menu_open = "gral"; 
    $title = "Plantas - Almacenes";
    $plan_id = "";
?>

<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

<?php

if(isset($_GET['msg']) and $_GET['msg'] == 'ok'){
    include "includes/msg-datos-almacenados-ok.php"; 
}

if(isset($_GET['plan'])){
    include "process/almacenes-traigo-datos-planta.php";
    include "includes/almacenes-listado.php";  
    include "includes/almacenes-form-new.php";
        
        
}elseif(isset($_GET['edit'])){
    
    $alma_id = $_GET['edit'];
    $plan_id = $_GET['p'];    //uso p para que no choque con el otro if.
    include "process/almacenes-traigo-datos-edit.php";
    include "includes/almacenes-form-edit.php";

    
}else{
    include "includes/almacenes-seleccionar-planta.php";
}


?>
  
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php include "includes/footer.php" ?>