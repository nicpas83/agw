<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">ABM Pólizas</h2>
            
                <a href="polizas.php?abm=alta"><button type="button" class="btn btn-primary btn-xs">Nueva Póliza</button></a>
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

<br />

        <div class="row">
                <div class="col-lg-12">
                     <div class="panel panel-default">
                        <div class="panel-heading">
                        Pólizas <?php echo $state_title; ?> a la fecha. <span style="float: right;"><?php echo $state_link; ?></span>
                        </div>
                        <!-- /.panel-heading -->
                        
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                                 
                                <table class="table table-striped table-bordered no-footer">    
                                    <thead>
                                        <tr>
                                            <th>Compañía</th>
                                            <th>Póliza Nro.</th>
                                            <th>Próximo Vto.</th>
                                            <th>Propia</th>
                                            <th>Vigente</th>
                                            <th>Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo tabla_polizas_listado($state); ?>
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
$poli_state = "desactivar";
$msg = "<p>(*) Las pólizas desactivadas ya no podrán ser aplicadas en la emisión de títulos.</p>";

if(isset($_GET['state'])){
    $poli_state = "activar";
    $msg = "";
}
include "msg-polizas-confirm-state.php"; 

?>