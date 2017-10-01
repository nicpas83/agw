<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
            <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Editar información Inspector</h2>
                <p><a href="inspectores.php">Inspectores</a> > <a href="inspectores.php?id=<?php echo $id_insp ?>">Ficha detalles</a> > Editar...</p>
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
                            <form role="form" class="form-horizontal" method="POST" action="inspectores.php?edit=<?php echo $id_insp ?>">

<!-- ************************** 
*********DATOS OBLIGATORIOS *****
************************************ -->
                              <div class="col-lg-6">
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Nombre:</label>
                                    <div class="col-lg-9">
                                        <input name="nombre" class="form-control" value="<?php echo $fila['INSP_NOMBRE']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Apellido:</label>
                                    <div class="col-lg-9">
                                        <input name="apellido" class="form-control" value="<?php echo $fila['INSP_APELLIDO']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">DNI/CUIT:</label>
                                    <div class="col-lg-9">
                                        <input name="dni" class="form-control" placeholder="sólo números" value="<?php echo $fila['INSP_DNI']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Teléfono:</label>
                                    <div class="col-lg-9">
                                        <input name="tel" class="form-control" value="<?php echo $fila['INSP_TEL']; ?>">
                                    </div>
                                    
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">E-mail:</label>
                                    <div class="col-lg-9">
                                        <input name="email" class="form-control" type="email" value="<?php echo $fila['INSP_EMAIL']; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Provincia:</label>
                                    <div class="col-lg-9">
                                        <select name="prov_id" class="form-control" id="combo_provincia">
                                            <option></option>
                                            <?php echo combo_provincia($prov_id); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Localidad:</label>
                                    <div class="col-lg-9">
                                        <select name="loca_id" class="form-control" id="combo_localidad">
                                            <?php echo combo_localidad($prov_id, $loca_id); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Domicilio:</label>
                                    <div class="col-lg-9">
                                        <input name="domicilio" class="form-control" value="<?php echo $fila['INSP_DOMICILIO'];?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Zonas de cobertura: <span class="text-muted small">(Varios Ctrl+click)</span></label>
                                    <div class="col-lg-9">
                                        <select name="zonas[]" multiple="" class="form-control">
                                           <?php echo $option_zonas; ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Especialización en el manejo de: <span class="text-muted small">(Varios Ctrl+click)</span></label>
                                    <div class="col-lg-9">
                                        <select name="especialidad[]" multiple="" class="form-control">
                                            <?php echo $option_esp; ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Referenciado por:</label>
                                    <div class="col-lg-9">
                                        <input name="referencia" class="form-control" value="<?php echo $fila['INSP_REFERENCIA'];?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Conocimiento de la herramienta:</label>
                                    <div class="col-lg-9">
                                        <select name="conocimiento" class="form-control">
                                            <option><?php echo $fila['INSP_CONOCIMIENTO'];?></option>
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
                                            <option><?php echo $fila['INSP_MOVILIDAD'];?></option>
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
                                            <option><?php echo $fila['INSP_HONORARIOS_POR'];?></option>
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
                                        <input name="nro_poliza" class="form-control" value="<?php echo $fila['INSP_NRO_POLIZA'];?>">
                                    </div>
                                </div> <!-- /.form-group -->                                
                                
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Vencimiento Póliza ART:</label>
                                    <div class="col-lg-9">
                                        <input name="venc_poliza" class="form-control fecha_form" value="<?php echo $fila['INSP_VENC_POLIZA'];?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Disponibilidad:</label>
                                    <div class="col-lg-9">
                                        <input name="disponibilidad" class="form-control" value="<?php echo $fila['INSP_DISPONIBILIDAD'];?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-3">Recibió capacitación:</label>
                                    <div class="col-lg-9">
                                        <select name="capacitacion" class="form-control">
                                        <option><?php echo $fila['INSP_CAPACITACION'];?></option>
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
                                <button name="submit-edit" type="submit" class="btn btn-primary">Actualizar Datos</button>
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