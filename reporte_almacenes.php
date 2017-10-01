<?php include "includes/init.php"; 
verificar_sesion();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>


<?php 

$title = "Reporte de almacenes"; 
$plan_id = null;

//si es primer ingreso 
if(!isset($_POST['submit-filtro'])){
    
    $reporteAlmacenes = "";

}else{

    $plan_id = $_POST['plan'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    
    $reporteAlmacenes = tabla_reporte_almacenes($plan_id, $desde, $hasta);

}


?>



<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Reporte de Almacenes</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
          <div class="col-lg-12">
              <h4>Seleccionar Planta</h4>
              
              <form role="form" class="form-inline" method="POST" action="reporte_almacenes.php" >
                <div class="form-group">
                    <select class="form-control selectpicker" name="plan" data-live-search="true">
                        <option>Seleccionar...</option>
                        <?php echo combo_plantas_nombre($plan_id); ?>
                    </select>
                </div>
                <div class="form-group">
                    <div>
                        <i class="fa fa-calendar"></i> 
                        <input name="desde" value="<?php if(isset($_POST['submit-filtro'])){echo $desde;} ?>" class="form-control input-sm fecha_filtro" type="text" placeholder="Desde">
                        
                        <i class="fa fa-calendar"></i> 
                        <input name="hasta" value="<?php if(isset($_POST['submit-filtro'])){echo $hasta;} ?>" class="form-control input-sm fecha_filtro" type="text" placeholder="Hasta">
                    </div>
                </div>
                <button type="submit" name="submit-filtro" class="btn btn-primary btn-sm">Aplicar</button>
                <button type="submit" class="btn btn-default btn-sm">Reset</button>
              
              </form>
          </div>
          <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    <br />
        <div class="row">
            <div class="col-lg-12">
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="reporte-almacenes-dataTable">
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>Nombre</th>
                                <th>Tipo</th>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Cant. Recibida</th>
                                <th>Cant. Liberada</th>
                                <th>Disponibles</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php  echo $reporteAlmacenes; ?>
                           
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
        
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>
