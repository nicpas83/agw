<!-- ############## TABLA - TARIFAS POR DEPOSITANTE ########################## -->   
<div class="row">
    <div class="col-lg-12">
            <a href="tarifas.php"><button type="button" class="btn btn-primary btn-xs"><i class="fa fa-arrow-left"></i> Volver</button></a>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<br />
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Histórico Tarifas [<?php if(isset($_GET['depo'])){echo $fila['DEPO_RASO'];} ?>]
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Desde</th>
                                <th>Hasta</th>
                                <th>Unidad</th>
                                <th>Emisión</th>
                                <th>Seguro</th>
                                <th>Otros</th>
                                <th>Mínimo</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php echo tabla_tarifas_listado($_GET['depo']); ?>                                        
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
