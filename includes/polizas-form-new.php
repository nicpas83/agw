<?php 
$prov_select_id = ""; 
$provincia = "";

?>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
    
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Nueva Póliza TRO</h3>
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
                                        <input name="raso" class="form-control" id="input_raso_new">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nro. CUIT: </label>
                                    <div class="col-lg-9">  
                                        <input name="cuit" class="form-control" required="">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio Legal: </label>
                                    <div class="col-lg-9">
                                        <input name="domleg" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio Fiscal: </label>
                                    <div class="col-lg-9">
                                        <input name="domfis" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Provincia: </label>
                                    <div class="col-lg-9">
                                        <select name="prov_id" class="form-control" id="combo_provincia">
                                        <option></option>
                                            <?php echo combo_provincia($prov_select_id, $provincia); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Localidad: </label>
                                    <div class="col-lg-9">
                                        <select name="loca_id" class="form-control" id="combo_localidad">
                                            <option></option>
                                            <!-- entra x js -->
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Cobertura:</label>
                                    <div class="col-lg-9">
                                        <input name="cobertura" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Póliza Nro.</label>
                                    <div class="col-lg-9">
                                        <input name="poliza_nro" class="form-control" required="">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Vencimiento:</label>
                                    <div class="col-lg-9">
                                        <input name="venc" class="form-control fecha_form" required="">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Propia: </label>
                                    <div class="col-lg-9">
                                        <select name="propia" class="form-control" >
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                  
                                
                            </div>
                            <!-- /.col-lg-12 -->
                            
                            <br />
                            
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary" name="submit-new">Aceptar</button>
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