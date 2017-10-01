

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
    
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Editar Póliza TRO</h3>
                <p><a href="polizas.php">Polizas</a> > <a href="polizas.php?id=<?php echo $id; ?>">Ficha detalles</a> > Edición...</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Completar formulario:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
<!-- ############################# FORMULARIO ############################################ -->                            
                            <form role="form" class="form-horizontal" method="POST"
                                action="polizas.php?abm=alta" >

                              <div class="col-lg-12">
                                
                                <?php if(isset($err['existe'])){echo $err['existe'];} ?>
                                <?php if(isset($err['cuit'])){echo $err['cuit'];} ?>
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Razón Social: </label>
                                    <div class="col-lg-9">
                                        <input name="raso" class="form-control" id="input_raso_new" value="<?php echo $fila['POLI_RASO']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nro. CUIT: </label>
                                    <div class="col-lg-9">  
                                        <input name="cuit" class="form-control" required="" value="<?php echo $fila['POLI_CUIT']; ?>" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio Legal: </label>
                                    <div class="col-lg-9">
                                        <input name="domleg" class="form-control" value="<?php echo $fila['POLI_DOMLEG']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio Fiscal: </label>
                                    <div class="col-lg-9">
                                        <input name="domfis" class="form-control" value="<?php echo $fila['POLI_DOMFIS']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Provincia: </label>
                                    <div class="col-lg-9">
                                        <select name="prov_id" class="form-control" id="combo_provincia">
                                        <option></option>
                                            <?php echo combo_provincia($prov_select_id); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Localidad: </label>
                                    <div class="col-lg-9">
                                        <select name="loca_id" class="form-control" id="combo_localidad">
                                            <?php echo combo_localidad($prov_select_id, $loca_select_id); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Cobertura:</label>
                                    <div class="col-lg-9">
                                        <input name="cobertura" class="form-control" value="<?php echo $fila['POLI_COBERTURA']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Póliza Nro.</label>
                                    <div class="col-lg-9">
                                        <input name="poliza_nro" class="form-control" required="" value="<?php echo $fila['POLI_POLIZA_NRO']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Vencimiento:</label>
                                    <div class="col-lg-9">
                                        <input name="venc" class="form-control fecha_form" required="" value="<?php echo $fila['POLI_VENC']; ?>" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Propia: </label>
                                    <div class="col-lg-9">
                                        <select name="propia" class="form-control" >
                                            <option><?php echo $fila['POLI_PROPIA']; ?></option>
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                  
                                
                            </div>
                            <!-- /.col-lg-12 -->
                            
                            <br />
                            
                            
                            <div class="col-lg-12 text-right">
                                <input name="poli_id" type="hidden" value="<?php echo $id; ?>" />
                                <button type="submit" class="btn btn-primary" name="submit-edit">Guardar</button>
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


        
        
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->