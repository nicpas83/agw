<?php 



?>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Depositante: <?php echo $fila['DEPO_RASO']?></h3>
                <p><a href="depositantes.php">Depositantes</a> > Ficha detalles</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <a href="depositantes.php?edit=<?php echo $id;?>"><button class="btn btn-primary btn-xs">Modo Edición</button></a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
<br /> 
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ficha:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="col-lg-3">Razón Social: </label><span class="col-lg-9 "><?php echo $fila['DEPO_RASO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Nro. CUIT : </label><span class="col-lg-9"><?php echo $fila['DEPO_CUIT']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Legal: </label><span class="col-lg-9"><?php echo $fila['DEPO_DOMLEG']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Fiscal: </label><span class="col-lg-9"><?php echo $fila['DEPO_DOMFIS']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Comercial: </label><span class="col-lg-9"><?php echo $fila['DEPO_DOMCOM']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Provincia: </label><span class="col-lg-9"><?php echo $provincia ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Localidad: </label><span class="col-lg-9"><?php echo $localidad ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Teléfono: (*print)</label><span class="col-lg-9"><?php echo $fila['DEPO_CONTACTO1']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Contacto 1: </label><span class="col-lg-9"><?php echo $fila['DEPO_CONTACTO2']; ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Contacto 2: </label><span class="col-lg-9"><?php echo $fila['DEPO_CONTACTO3']; ?></span>
                            </div>

                        </div>
                        <!-- /.row -->

                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 (nested) -->
        </div>
        <!-- /.row -->
        
        <div class="row">
          <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        Cuadro Tarifario:
                </div>
                
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
                                    <th>Cargos Mín</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php echo tabla_tarifas_listado($id); ?>                                        
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    
                </div>
                <!-- /.panel-body -->
            </div>
          </div>
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->