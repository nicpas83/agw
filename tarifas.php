<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>



<?php
/** Proceso si viene por el formulario de New */
if(isset($_POST['submit-new'])){
    include "process/tarifas-process-new.php";
}

/** Proceso si viene por el formulario de Edit */
if(isset($_POST['submit-edit'])){
    include "process/tarifas-process-edit.php";
}


?>

<?php
	$menu_open = "gral"; 
    $title = "Depositantes - Tarifas";
    $depo_id = "";
?>

<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header">Tarifas</h2>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->

<?php

if(isset($_GET['msg']) and $_GET['msg'] == 'ok'){
    include "includes/msg-datos-almacenados-ok.php"; 
}

if(isset($_GET['depo'])){
    include "process/tarifas-traigo-datos-depo.php"; //prepara $fila
    include "includes/tarifas-listado.php";  
    include "includes/tarifas-form-new.php";
        
        
}elseif(isset($_GET['edit'])){
    
    $tari_id = $_GET['edit'];  
    $depo_id = $_GET['d'];    
    include "process/tarifas-traigo-datos-edit.php";
    include "includes/tarifas-form-edit.php";

    
}else{
    include "includes/tarifas-seleccionar-depo.php";
}


?>
  
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->


<?php include "includes/footer.php" ?>