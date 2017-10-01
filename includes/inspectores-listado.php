<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">ABM Inspectores</h2>
            
                <a href="inspectores.php?abm=alta"><button type="button" class="btn btn-primary btn-xs">Nuevo Inspector</button></a>
                
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

<br />

        <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Inspectores activos a la fecha
                        </div>
                        <!-- /.panel-heading -->
                        
                        <div class="panel-body">
                            <div class="dataTables_wrapper form-inline table-responsive">
                                
                                <table class="table table-striped table-bordered dataTable no-footer" id="inspectores-listado-dataTables">
                                    <thead>
                                        <tr>
                                            <th>Apellido, Nombre</th>
                                            <th>Telefono</th>
                                            <th>Zona Cobertura</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php echo tabla_inspectores_listado(); ?>                                        
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
