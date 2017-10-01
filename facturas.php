<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
	$menu_open = "gral"; 
    $title = "Facturas";

    $facturas = facturacion_listado_facturas(); //array 
    

?>
<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<?php 

   if(isset($_GET['id'])){
   
    $detalle = facturacion_detalle_factura($_GET['id']);
    include "includes/facturas-detalle.php"; 
    
   }else{
    
    include "includes/facturas-listado.php";
    
   }
    

?>


<?php include "includes/footer.php" ?>