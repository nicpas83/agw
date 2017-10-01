<?php 
$prov_select_id = ""; 
$provincia = "";

?>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
    
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Alta Nueva Planta</h3>
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
                                action="plantas.php?abm=alta" enctype="multipart/form-data">

                              <div class="col-lg-12">
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Razón Social Existente: </label>
                                    <div class="col-lg-9">
                                        <select name="raso" class="form-control" id="combo_raso_exis" style="display:inline !important; width: 80% !important;">
                                            <option></option>
                                            <?php echo combo_plantas_raso(); ?>
                                        </select>
                                        <button id="combo_raso_cancelar" type="button" class="btn-xs btn-primary" style="display: none;">cancelar</button>
                                    </div>
                                </div> <!-- /.form-group -->
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nueva Razón Social: </label>
                                    <div class="col-lg-9">
                                        <input name="raso" class="form-control" id="input_raso_new">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nombre Planta: </label>
                                    <div class="col-lg-9">  
                                        <input name="nombre" class="form-control" required="">
                                        <?php if(isset($err['nombre'])){echo $err['nombre'];}?>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Responsable de Planta: </label>
                                    <div class="col-lg-9">
                                        <input name="responsable" class="form-control" required="">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Tel 1: </label>
                                    <div class="col-lg-9">
                                        <input name="tel1" class="form-control" required="">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Tel 2:</label>
                                    <div class="col-lg-9">
                                        <input name="tel2" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Propiedad de:</label>
                                    <div class="col-lg-9">
                                        <input name="propde" class="form-control" placeholder="Completar sólo si difiere de Razón Social.">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Vencimiento alquiler:</label>
                                    <div class="col-lg-9">
                                        <input name="venc_alq" class="form-control fecha_form">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Vencimiento comodato:</label>
                                    <div class="col-lg-9">
                                        <input name="venc_com" class="form-control fecha_form">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Provincia: </label>
                                    <div class="col-lg-9">
                                        <select name="prov_id" class="form-control" id="combo_provincia">
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
                                    <label class="col-lg-3 ">Domicilio:</label>
                                    <div class="col-lg-9">
                                        <input name="domicilio" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Zona:</label>
                                    <div class="col-lg-9">
                                        <select name="zona" class="form-control">
                                            <option>Urbana</option>
                                            <option>Suburbana</option>
                                            <option>Rural</option>
                                            <option>Otra</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Capacidad Almacenaje:</label>
                                    <div class="col-lg-9">
                                        <input name="almacenaje" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Capacidad de carga diaria:</label>
                                    <div class="col-lg-9">
                                        <input name="cap_carga_diaria" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
              
                                <div class="form-group">
                                    <label class="col-lg-3">Cumple condiciones póliza:</label>
                                    <div class="col-lg-9">
                                        <select name="cumple_cond" class="form-control">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Estado gral de la Planta:</label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="estado_gral">
                                            <option>Bueno</option>
                                            <option>A Mejorar</option>
                                            <option>Regular</option>
                                            <option>Muy Bueno</option>
                                            <option>Excelente</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Observaciones / Comentarios:</label>
                                    <div class="col-lg-9">
                                        <textarea name="comentarios" class="form-control" rows="3"></textarea>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Distancia a puerto más cercano:</label>
                                    <div class="col-lg-9">
                                        <input name="dist_pto" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Beneficiarios: <span class="text-muted small">(Varios Ctrl+click)</span></label>
                                    <div class="col-lg-9">
                                        <select name="benef_todos[]" multiple="" class="form-control">
                                            <?php echo combo_beneficiarios(); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Número de Póliza:</label>
                                    <div class="col-lg-9">
                                        <input name="nro_poliza" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Póliza Planta Vencimiento:</label>
                                    <div class="col-lg-9">
                                        <input name="venc_poliza" class="form-control fecha_form">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Geolocalización:</label>
                                    <div class="col-lg-9">
                                        <input name="geo" class="form-control" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                
                            </div>
                            <!-- /.col-lg-6 -->
                            
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