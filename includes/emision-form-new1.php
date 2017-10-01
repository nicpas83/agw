<?php 
/** Busco último título emitido y sumo 1 */
$sql = "SELECT MAX(TITU_WCD_NR) AS TITU_WCD_NR FROM titulos";
$result = mysqli_query($cnx, $sql);
$fila = mysqli_fetch_row($result);
$_SESSION['wcd_nr'] = $fila[0] + 1;


?>
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Emisión de Títulos</h3>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Crear nuevo Título Paso 1/2:  (Nro. <?php echo $_SESSION['wcd_nr']; ?> )
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
<!-- ### FORMULARIO ### -->                            
                            <form role="form" class="form-horizontal" method="POST"
                                action="emision.php" >

                              <div class="col-lg-12">
                                
                                <div style="color: red;">
                                <?php if(isset($err['tarifas'])){echo $err['tarifas'];} ?>
                                <?php if(isset($err['poli'])){echo $err['poli'];} ?>

                                </div>
                                
<!-- ### tipo W ### -->                                  
                                <div class="form-group">
                                    <label class="col-lg-4">Tipo de Warrant: </label>
                                    <div class="col-lg-8">
                                        <select name="tw" class="form-control">
                                            <option>SA</option>
                                            <option>CMA</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
<!-- ### planta ### -->                                                         
                                <div class="form-group">
                                    <label class="col-lg-4 ">Planta:</label>
                                    <div class="col-lg-8">
                                        <select name="planta" class="form-control" id="emision-plantas">
                                            <?php echo combo_plantas_nombre(); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->                                    
                                    
<!-- ### depositante ### -->                                                         
                                
                                <div class="form-group">
                                    <label class="col-lg-4">Depositante:</label>
                                    <div class="col-lg-8">
                                        <select name="depositante" class="form-control">
                                            <?php echo combo_depositantes(); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->                                    

<!-- ### TRO ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-4 ">Nro. Póliza asociada:</label>
                                    <div class="col-lg-8">
                                        <select name="poliza" class="form-control">
                                            <?php echo combo_polizas(); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                
                            </div>
                            <!-- /.col-lg-12 -->
                            
                            <br />
                            
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary" name="submit-new1">Siguiente</button>
                            </div>
                            <!-- /.col-lg-12 -->
                                
                          </form>
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

<br />        
        
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Impresión de Títulos:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
 
<!-- ### FORMULARIO ### -->                            
                            <form role="form" class="form-horizontal" method="POST" target="_blank"
                                action="imprimir.php" >
                                 
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="col-lg-4 ">Seleccionar Título Nro.: </label>
                                        <div class="col-lg-8">
                                            <select name="titulo" class="form-control">
                                                <?php echo combo_nro_titulos_vigentes("DESC"); ?>
                                            </select>
                                        </div>
                                    </div> <!-- /.form-group -->
                                    
                                    
                                    <div class="text-right">
                                        <input type="submit" value="Imprimir..." class="btn btn-primary"/>
                                    </div>
                                    
                                  </form>
                                
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

   
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

