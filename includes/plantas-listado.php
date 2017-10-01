<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">ABM Plantas</h2>
            
                <a href="plantas.php?abm=alta"><button type="button" class="btn btn-primary btn-xs">Nueva Planta</button></a>
                
                <a href="almacenes.php"><button type="button" class="btn btn-primary btn-xs">Almacenes</button></a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

<br />

        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Plantas <?php echo $state_title; ?> a la fecha. <span style="float: right;"><?php echo $state_link; ?></span> 
                        </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="dataTables_wrapper form-inline table-responsive">
                                                 
                                <table class="table table-striped table-bordered dataTable no-footer" id="plantas-listado-dataTables">    
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Razon Social</th>
                                            <th>Provincia</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo tabla_plantas_listado($state); ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php 
/** Preparo ventana Modal para confirmar cambio de estado en planta.  */
$plan_state = "desactivar";
$msg = "<p>(*) Las plantas inactivas no figurarán como opción en los filtros desplegables del sistema.</p>";

if(isset($_GET['state'])){
    $plan_state = "activar";
    $msg = "";
}
include "msg-plantas-confirm-state.php"; 

?>