<?php 



?>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Planta: <?php echo $fila_plan['PLAN_NOMBRE']?></h3>
                <p><a href="plantas.php">Plantas</a> > ficha detalles</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <a href="plantas.php?edit=<?php echo $id_planta;?>"><button class="btn btn-primary btn-xs">Modo Edición</button></a>
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
                                <label class="col-lg-3">Razón Social: </label><span class="col-lg-9 "><?php echo $fila_plan['PLAN_RASO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Nombre Planta : </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_NOMBRE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Responsable de Planta: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_RESPONSABLE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Tel 1: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_TEL1']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Tel 2: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_TEL2']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Propiedad de: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_PROPDE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Vencimiento alquiler: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_VENC_ALQ']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Vencimiento comodato: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_VENC_COM']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Provincia: </label><span class="col-lg-9"><?php echo $provincia; ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Localidad: </label><span class="col-lg-9"><?php echo $localidad; ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_DOMICILIO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Zona: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_ZONA']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Capacidad de almacenaje: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_ALMACENAJE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Capacidad de carga diaria: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_CAP_CARGA_DIARIA']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Cumple condiciones póliza: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_CUMPLE_COND']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Estado gral de la Planta: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_ESTADO_GRAL']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Comentarios: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_COMENTARIOS']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Distancia a puerto más cercano: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_DIST_PTO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Beneficiarios: </label><span class="col-lg-9"><?php echo lista_explode_id('-',$fila_plan['PLAN_BENEF_TODOS'],'beneficiarios','BENE_ID','BENE_RASO'); ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Número de Póliza: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_NRO_POLIZA'] ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Vencimiento Póliza: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_VENC_POLIZA'] ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Geolocalización: </label><span class="col-lg-9"><?php echo $fila_plan['PLAN_GEO'] ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Imágenes: </label>
                                <div class="col-lg-9">
                                    <span> [hay <?php echo $cant_img;  ?> imágenes]</span> <br />
                                    
                                    <?php echo $img_links; ?>
                                    
                                    
                                </div>
                                
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
                            <?php echo tabla_almacenes_listado($id_planta); ?>                                        
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
                
            </div>
            <!-- /.panel-body -->
        
        </div>

    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->