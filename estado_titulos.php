<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
	$menu_open = "adm"; 
    $title = "Estado de Títulos";

/** Proceso si viene por el formulario de edición */
    if(isset($_POST['submit-edit'])){
        
        $titulo_nro = $_POST['titulo_nro'];
        $estado = $_POST['estado'];
        $fecha  = $_POST['fecha'];
        
        $sql = "UPDATE titulos SET
                TITU_ESTADO = '$estado',
                TITU_FECHA_LIBERACION = '$fecha'
                where TITU_WCD_NR = $titulo_nro";
    
        $result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));
        
        if($result){
            header("Location: index.php?msg=ok");
        }
        
    
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
        include "includes/estado-form-edit.php";    
    }
    
    
    

?>


<?php include "includes/footer.php" ?>