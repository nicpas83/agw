<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Actas de Inspección</h3>
                
                <a href="actas.php?abm=alta"><button type="button" class="btn btn-primary btn-xs">Nueva</button></a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
<br />
        <!-- ############## Actas de Inspección ########################## -->   
        <div class="row">
            <div class="col-lg-12">              
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="actas-listado-datatables">
                        <thead>
                            <tr>
                                <th>Acta Nro.</th>
                                <th>Fecha</th>
                                <th>Planta</th>
                                <th>Inspector</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo tabla_actas_listado(); ?>                                        
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
