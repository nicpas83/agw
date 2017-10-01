<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">ABM Depositantes</h2>
            
                <a href="depositantes.php?abm=alta"><button type="button" class="btn btn-primary btn-xs">Nuevo Depositante</button></a>
                
                <a href="tarifas.php"><button type="button" class="btn btn-primary btn-xs">Tarifas</button></a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

<br />

        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Depositantes activos a la fecha
                        </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="dataTables_wrapper form-inline table-responsive">
                                                 
                                <table class="table table-striped table-bordered dataTable no-footer" id="plantas-listado-dataTables">    
                                    <thead>
                                        <tr>
                                            <th>Razon Social</th>
                                            <th>Provincia</th>
                                            <th>Contacto</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo tabla_depositantes_listado(); ?>
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
