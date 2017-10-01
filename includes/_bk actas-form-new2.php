
<?php 
/** 2. INFO SELECCIONADA:  se ofrece posibilidad de cancelar / muestra formulario Actas NEW 2 */        
   
$id_planta_selec = $_POST['planta'];
$motivo = $_POST['motivo'];

$styleHidden = "";

// Aplica para Qx Recibidas y Qx Liberadas
if($motivo === "Inspección de rutina" OR $motivo === "Auditoría" OR $motivo === "Otros"){
    $styleHidden = "style='display: none;'";
}

//traigo info de la planta y sus almacenes correspondientes
include "process/actas-traigo-datos-planta-almacenes.php";



?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Actas de Inspección</h3>
                <p><a href="actas.php">Actas</a> > Nueva - Paso 2/2</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
<br />
<!-- Seleccionamos la planta para completar la tabla de almacenes  -->
        <div class="row">
          <div class="col-lg-6">
            <p>
            Planta seleccionada: <span><?php echo $nombre_planta ?></span> <br />
            Razón social: <span><?php echo $raso_planta ?></span> <br />
            Provincia: <span><?php echo $provincia ?></span> <br />
            Localidad: <span><?php echo $localidad ?></span> <br />
            Domicilio: <span><?php echo $domicilio ?></span> <br />
            Motivo de Inspección: <span><?php echo $motivo ?></span>
            </p>
            
            <form role="form" class="form-horizontal" method="POST" action="actas.php?abm=alta">
                <button type="submit" class="btn btn-primary btn-xs">Cancelar y elegir otra Planta</button>
            </form>
            
          </div>
          <!-- /.col-lg-12 -->          
        </div>
        <!-- /.row -->
<br />  
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ingresar datos del Acta:
                    </div>
        
                    <div class="panel-body">
                        <div class="row">    
                            
                            
        <!-- ############# FORMULARIO  ############# -->                            
                            
                            <form role="form" class="form-horizontal" method="POST" action="actas.php" enctype="multipart/form-data" >
        
                              <div class="col-lg-12">
                                
                                <div class="form-group">
                                    <label class="col-lg-2 ">Nro. Acta:</label>
                                    <div class="col-lg-4">
                                        <input name="acta_nro" class="form-control" required="">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Fecha:</label>
                                    <div class="col-lg-4">
                                        <input name="acta_fecha" class="form-control fecha_form" required="">
                                    </div>
                                </div> <!-- /.form-group -->
        
                                <div class="form-group">
                                    <label class="col-lg-12">Cantidades:</label>
                                    <div class="col-lg-11">
                                    <p style="color: red; font-size: small;">(*) para excluir un almacén, dejar vacío el nombre interno.</p>
                                    </div>
                                </div> <!-- /.form-group -->
        
<!-- ############# inicio tabla almacenes  ################# -->                                        
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Almacenes en Planta <?php echo $fila['PLAN_NOMBRE'];?>
                                            </div>
                                            <!-- /.panel-heading -->
                                            <div class="panel-body">
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
                                                        <?php
                                                        /** primero reseteo el puntero del array porque ya se itineró en 'traigo-datos' */
                                                        mysqli_data_seek($result, 0);
                                                        $iteracion = 1;                                                    
                                                        while($fila = mysqli_fetch_array($result)){
                                                        ?>
    
                                                            <tr>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_alma_id_<?php echo $iteracion ?>" class="form-control">
                                                                        <option value="<?php echo $fila['ALMA_ID']; ?>"><?php echo $fila['ALMA_NOMBRE_INT']; ?></option>
                                                                        <option></option>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_producto_id_<?php echo $iteracion ?>" class="form-control" name="producto_">
                                                                        <?php echo combo_productos();  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_unidad_<?php echo $iteracion ?>" class="form-control">
                                                                        <?php echo combo_unidades($fila['AAQX_UNIDAD']);  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-1">
                                                                    <input value="<?php echo $fila['CANT_VERIF']; ?>" name="aaqx_qx_iniciales_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_recibidas_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_liberadas_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                
                                                            </tr>
                                                         
                                                         <?php 
                                                            $iteracion++;  
                                                         
                                                         }?>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- /.table-responsive -->
                                                
                                            </div>
                                            <!-- /.panel-body -->
                                        </div>
                                        <!-- /.panel -->
                                    </div>
                                    <!-- /.col-lg-12 -->
                                </div>
                                <!-- /.row -->


                                
<!-- ############ Fin tabla almacenes ########################################  -->
                                        
                                
                                 <div class="form-group">
                                    <label class="col-lg-2">Muestras:</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="acta_muestras">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Verificación de T° y H°:</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="acta_tyh">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Producto bajo condicion comercial:</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="acta_cond_com">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Precintos:</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="acta_precintos">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Carteles:</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="acta_carteles">
                                            <option>SI</option>
                                            <option>NO</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Responsable de planta:</label>
                                    <div class="col-lg-4">
                                        <input name="acta_responsable" class="form-control" readonly="" value="<?php echo $responsable; ?>">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Firmante por la empresa:</label>
                                    <div class="col-lg-4">
                                        <input name="acta_firmante" class="form-control" placeholder="Completar sólo si difiere del responsable de planta">
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Inspector:</label>
                                    <div class="col-lg-4">
                                        <select class="form-control" name="acta_inspector_id">
                                            <option></option>
                                            <?php echo combo_inspectores(); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                 
                                 
                                <div class="form-group">
                                    <label class="col-lg-2">Observaciones / Comentarios:</label>
                                    <div class="col-lg-4">
                                        <textarea class="form-control" rows="3" name="acta_coment"></textarea>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                <div class="form-group">
                                    <label class="col-lg-2">Imágen del Acta:</label>
                                    <div class="col-lg-4">
                                       [aún no disponible]
                                    </div>
                                        
                                </div> <!-- /.form-group -->
                                
                                                        
                            </div>
                            <!-- /.col-lg-12 -->
                            
                            <br />
                            
                            <div class="col-lg-12">
                                <?php  /** paso algunos datos adicionales que no son ingresados por el usuario */ ?>
                                <input type="hidden" value="<?php echo $iteracion; ?>" name="iteracion" />
                                <input type="hidden" value="<?php echo $raso_planta; ?>" name="acta_raso" />
                                <input type="hidden" value="<?php echo $id_planta_selec; ?>" name="acta_planta_id" />
                                <input type="hidden" value="<?php echo $motivo; ?>" name="motivo" />
                                <input type="hidden" value="<?php echo $responsable; ?>" name="acta_responsable" />
                                <input type="hidden" value="<?php echo $id_planta_selec; ?>" name="acta_planta_id" />
                                
                                <button name="submit-new2" type="submit" class="btn btn-primary">Aceptar</button>
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
    <!-- /.col-lg-12 (nested) -->
</div>
<!-- /.row -->    
    