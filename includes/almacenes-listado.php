<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Almacenes</h3>
        <p><a href="plantas.php">Plantas</a> > <a href="almacenes.php">Almacenes</a> > Lista/Nuevo</p>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<!-- ############## TABLA - ALMACENES POR PLANTA ########################## -->   


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Almacenes en Planta [<?php if(isset($_GET['plan'])){echo $fila['PLAN_NOMBRE'];} ?>]
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tipo de Almacén</th>
                                <th>Capacidad</th>
                                <th>Nombre Interno</th>
                                <th>Aforo Técnico</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo tabla_almacenes_listado($_GET['plan']); ?>                                        
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
