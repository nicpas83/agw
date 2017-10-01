<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
    
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Editar información Depositante</h3>
                <p><a href="depositantes.php">Depositantes</a> > <a href="depositantes.php?id=<?php echo $depo_id; ?>">Ficha detalles</a> > Editar...</p>
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
                                action="depositantes.php?abm=alta" >

                              <div class="col-lg-12">
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Razón Social: </label>
                                    <div class="col-lg-9">
                                        <input name="raso" class="form-control" value="<?php echo $fila['DEPO_RASO']; ?>" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nro. CUIT: </label>
                                    <div class="col-lg-9">  
                                        <input name="cuit" class="form-control" required="" value="<?php echo $fila['DEPO_CUIT']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio Legal: </label>
                                    <div class="col-lg-9">
                                        <input name="domleg" class="form-control" value="<?php echo $fila['DEPO_DOMLEG']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio Fiscal: </label>
                                    <div class="col-lg-9">
                                        <input name="domfis" class="form-control" value="<?php echo $fila['DEPO_DOMFIS']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio Comercial:</label>
                                    <div class="col-lg-9">
                                        <input name="domcom" class="form-control" value="<?php echo $fila['DEPO_DOMCOM']; ?>">
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
                                    <label class="col-lg-3 ">Teléfono: (*print)</label>
                                    <div class="col-lg-9">
                                        <input name="contacto1" class="form-control" value="<?php echo $fila['DEPO_CONTACTO1']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Contacto 1:</label>
                                    <div class="col-lg-9">
                                        <input name="contacto2" class="form-control" value="<?php echo $fila['DEPO_CONTACTO2']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Contacto 2:</label>
                                    <div class="col-lg-9">
                                        <input name="contacto3" class="form-control" value="<?php echo $fila['DEPO_CONTACTO3']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                  
                                
                            </div>
                            <!-- /.col-lg-12 -->
                            
                            <br />
                            
                            <div class="col-lg-12 text-right">
                                <input name="depo_id" type="hidden" value="<?php echo $depo_id; ?>" />
                                <button type="submit" class="btn btn-primary" name="submit-edit">Aceptar</button>
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