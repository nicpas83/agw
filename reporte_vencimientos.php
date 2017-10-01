<?php include "includes/init.php"; 
verificar_sesion();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php 

$title = "Reporte de Vencimientos"; 

/** Defino intervalo. Aplica a todos los Alertas.   $intervalo = 1 o 2 (meses)  */
$int = 1;
if(isset($_GET['int']) AND is_numeric($_GET['int'])){
    $int = $_GET['int'];
}

if($int == 1){

    $int_string = "<a style='font-weight: bold; text-decoration: underline;'>30 días</a> - <a href='reporte_vencimientos.php?int=2'>60 días</a>";    

}elseif($int == 2){

    $int_string = "<a href='reporte_vencimientos.php?int=1'>30 días</a> - <a style='font-weight: bold; text-decoration: underline;'>60 días</a>";
    
}


?>
<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Reporte de Vencimientos</h2>
                <h4>Intervalo: <?php echo $int_string; ?></h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
          <div class="col-lg-12">
              <h5>Títulos:</h5>
              
              <ul>
                <?php echo venc_titulos($int); ?>
              </ul>
              
          </div>
          <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
          <div class="col-lg-12">
              <h5>Plantas - Comodato:</h5>
              
              <ul>
                <?php echo venc_planta_comodato($int); ?>
              </ul>
              
          </div>
          <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
          <div class="col-lg-12">
              <h5>Plantas - Seguro:</h5>
              
              <ul>
                <?php echo venc_planta_seguro($int); ?>
              </ul>
              
          </div>
          <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
          <div class="col-lg-12">
              <h5>Seguros TRO:</h5>
              
              <ul>
                <?php echo venc_seguro_tro($int); ?>
              </ul>
              
          </div>
          <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
        
    <br />
        
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>
