<?php
$motivo = $fila['ACTA_MOTIVO'];
$styleHidden = "";

// Aplica para Qx Recibidas y Qx Liberadas
if($motivo === "Auditoría" OR $motivo === "Otros"){
    $styleHidden = "style='display: none;'";
}

?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Acta Nro.: <?php echo $fila['ACTA_NRO']; ?></h3>
                <p><a href="actas.php">Actas</a> > Ficha detalles</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <a href="actas.php?edit=<?php echo $_GET['id'];?>"><button class="btn btn-primary btn-xs">Modo Edición</button></a>
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
                                <label class="col-lg-3">Planta: </label><span class="col-lg-9 "><?php echo $fila['PLAN_NOMBRE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Motivo de Inspección: </label><span class="col-lg-9 "><?php echo $fila['ACTA_MOTIVO']?></span>
                            </div>   
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Fecha: </label><span class="col-lg-9 "><?php echo $fila['ACTA_FECHA']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Muestras: </label><span class="col-lg-9 "><?php echo $fila['ACTA_MUESTRAS']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Verificación de T° y H°: </label><span class="col-lg-9 "><?php echo $fila['ACTA_TYH']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Producto bajo condicion comercial: </label><span class="col-lg-9 "><?php echo $fila['ACTA_COND_COM']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Precintos: </label><span class="col-lg-9 "><?php echo $fila['ACTA_PRECINTOS']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Carteles: </label><span class="col-lg-9 "><?php echo $fila['ACTA_CARTELES']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Responsable de Planta: </label><span class="col-lg-9 "><?php echo $fila['ACTA_RESPONSABLE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Firmante por la empresa: </label><span class="col-lg-9 "><?php echo $fila['ACTA_FIRMANTE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Inspector: </label><span class="col-lg-9 "><?php echo "".$fila['INSP_APELLIDO'].", ".$fila['INSP_NOMBRE'].""; ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Observaciones: </label><span class="col-lg-9 "><?php echo $fila['ACTA_COMENT'] ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Imágen del Acta: </label><span class="col-lg-9 ">[aún no disponible]</span>
                            </div>
                            

                        </div>
                        <!-- /.row -->

                  </div>
                  <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
                
            <br />
            
            <!-- Tabla Cantidades QX -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Cantidades:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
            
                           
                           <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nombre Interno</th>
                                            <th>Producto</th>
                                            <th>Unidad</th>
                                            <th>Qx Iniciales</th>
                                            <th <?php echo $styleHidden; ?>>Qx Recibidas</th>
                                            <th <?php echo $styleHidden; ?>>Qx Liberadas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo tabla_actasQX_listado($fila['ACTA_NRO'],$styleHidden); ?>
                                    </tbody>
                                </table>

                            

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
    
    </div>
    <!-- /.col-lg-12 (nested) -->
</div>
<!-- /.row -->    
    
    
    
