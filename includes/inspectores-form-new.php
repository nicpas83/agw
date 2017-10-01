<?php 
$prov_select_id = ""; 
$provincia = "";

?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
            <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Alta Nuevo Inspector</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Completar formulario:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">    
                            <form role="form" class="form-horizontal" method="POST" action="inspectores.php?abm=alta">
<!-- ************************** 
*********DATOS OBLIGATORIOS *****
************************************ -->
                              <div class="col-lg-6">
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nombre:</label>
                                    <div class="col-lg-9">
                                        <input name="nombre" class="form-control" required="">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Apellido:</label>
                                    <div class="col-lg-9">
                                        <input name="apellido" class="form-control" required="">
                                        <?php if(isset($err['apellido'])){echo $err['apellido'];} ?>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">DNI/CUIT:</label>
                                    <div class="col-lg-9">
                                        <input name="dni" class="form-control" placeholder="sólo números">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Teléfono:</label>
                                    <div class="col-lg-9">
                                        <input name="tel" class="form-control">
                                    </div>
                                    
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">E-mail:</label>
                                    <div class="col-lg-9">
                                        <input name="email" class="form-control" type="email" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Provincia:</label>
                                    <div class="col-lg-9">
                                        <select name="prov_id" class="form-control" id="combo_provincia">
                                            <option></option>
                                            <?php echo combo_provincia($prov_select_id, $provincia); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Localidad:</label>
                                    <div class="col-lg-9">
                                        <select name="loca_id" class="form-control" id="combo_localidad">
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
                                    <label class="col-lg-3">Zonas de cobertura: <span class="text-muted small">(Varios Ctrl+click)</span></label>
                                    <div class="col-lg-9">
                                        <select name="zonas[]" multiple="" class="form-control">
                                            <?php echo combo_provincia($prov_select_id); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Especialización en el manejo de: <span class="text-muted small">(Varios Ctrl+click)</span></label>
                                    <div class="col-lg-9">
                                        <select name="especialidad[]" multiple="" class="form-control">
                                            <?php echo combo_productos(); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Referenciado por:</label>
                                    <div class="col-lg-9">
                                        <input name="referencia" class="form-control" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Conocimiento de la herramienta:</label>
                                    <div class="col-lg-9">
                                        <select name="conocimiento" class="form-control">
                                            <option>Si</option>
                                            <option>No</option>
                                            <option>No Aplica</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Movilidad propia:</label>
                                    <div class="col-lg-9">
                                        <select name="movilidad" class="form-control">
                                            <option>Si</option>
                                            <option>No</option>
                                            <option>No Aplica</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Honorarios acordados por:</label>
                                    <div class="col-lg-9">
                                        <select name="honorarios_por" class="form-control">
                                            <option>Jornal de trabajo</option>
                                            <option>Visita</option>
                                            <option>Tareas de verificación</option>
                                            <option>Asesoramiento técnico</option>
                                            <option>Otros</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nro. de Póliza:</label>
                                    <div class="col-lg-9">
                                        <input name="nro_poliza" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->                                
                                
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Vencimiento Póliza ART:</label>
                                    <div class="col-lg-9">
                                        <input name="venc_poliza" class="form-control fecha_form">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Disponibilidad:</label>
                                    <div class="col-lg-9">
                                        <input name="disponibilidad" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Recibió capacitación:</label>
                                    <div class="col-lg-9">
                                        <select name="capacitacion" class="form-control">
                                            <option>Si</option>
                                            <option>No</option>
                                            <option>No Aplica</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->

                            </div>
                            <!-- /.col-lg-6 -->
                            
                            <br />
                            
                            <div class="col-lg-12">
                                <button name="submit-new" type="submit" class="btn btn-primary">Aceptar</button>
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