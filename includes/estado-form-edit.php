<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
    
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Estado de Títulos</h3>
                
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
                            <form role="form" class="form-horizontal" method="POST" action="estado_titulos.php" >

                              <div class="col-lg-12">
                                
                                
                                <div class="form-group">
                                    <label class="col-lg-4">Título Nro.:</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="titulo_nro">
                                            <?php echo combo_nro_titulos_vigentes("ASC"); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-4">Nuevo Estado:</label>
                                    <div class="col-lg-8">
                                        <select class="form-control" name="estado">
                                            <option value="L">Liberado</option>
                                            <option value="A">Anulado</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-4 ">Fecha: </label>
                                    <div class="col-lg-8">
                                        <input name="fecha" class="form-control fecha_form" value="<?php echo date("Y-m-d"); ?>" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                
                                
                                  
                                
                            </div>
                            <!-- /.col-lg-12 -->
                            
                            <br />
                            
                            <div class="col-lg-12 text-right">
                                
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