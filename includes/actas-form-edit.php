<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Actas de Inspección</h3>
                <p><a href="actas.php">Actas</a> > Edición</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
<br />
        <!-- Seleccionamos la planta para completar la tabla de almacenes  -->
        <div class="row">
          <div class="col-lg-12">
           
           <form role="form" class="form-horizontal" method="POST" action="actas.php">
           
<!-- form1 -->
                <div class="form-group">
                    <label class="col-lg-2">Planta:</label>
                    <div class="col-lg-4">
                        <p><?php echo $f1['PLAN_NOMBRE'] ?></p>
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Motivo de Inspección:</label>
                    <div class="col-lg-4">
                        <select name="motivo" class="form-control">
                        <option><?php echo $f1['ACTA_MOTIVO'] ?></option>
                            <option>Inspección de rutina</option>
                            <option>Recepción de mercadería</option>
                            <option>Liberación de mercadería</option>
                            <option>Auditoría</option>
                            <option>Movimiento Interno de mercadería</option>
                            <option>Otros</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->

<!-- form2 -->
                <div class="form-group">
                    <label class="col-lg-2">Nro. Acta:</label>
                    <div class="col-lg-4">
                        <input name="acta_nro" class="form-control" required="" value="<?php echo $f1['ACTA_NRO'] ?>">
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Fecha:</label>
                    <div class="col-lg-4">
                        <input name="acta_fecha" class="form-control fecha_form" required="" value="<?php echo $f1['ACTA_FECHA'] ?>">
                    </div>
                </div> <!-- /.form-group -->

                <div class="form-group">
                    <label class="col-lg-12">Cantidades:</label>
                    <div class="col-lg-11">
                    </div>
                </div> <!-- /.form-group -->

<!-- ############# inicio tabla almacenes  ################# -->                                        
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Almacenes en Planta 
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
                                                <th>Qx Recibidas</th>
                                                <th>Qx Liberadas</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                        <?php
                                        /** cantidad de filas variables  */
                                        $iteracion = 1;                                                    
                                        while($f2 = mysqli_fetch_array($r2)){
                                            
                                            
                                        ?>

                                            <tr>
                                                <td class="col-lg-2">
                                                    <select name="aaqx_alma_id_<?php echo $iteracion ?>" class="form-control">
                                                        <?php echo combo_almacenes_de_planta($f1['ACTA_PLANTA_ID'],$f2['AAQX_ALMA_ID']);  ?>
                                                    </select>
                                                </td>
                                                <td class="col-lg-2">
                                                    <select name="aaqx_producto_id_<?php echo $iteracion ?>" class="form-control" name="producto_">
                                                        <?php echo combo_productos($f2['AAQX_PRODUCTO_ID']);  ?>
                                                    </select>
                                                </td>
                                                <td class="col-lg-2">
                                                    <select name="aaqx_unidad_<?php echo $iteracion ?>" class="form-control">
                                                        <?php echo combo_unidades($f2['AAQX_UNIDAD']);  ?>
                                                    </select>
                                                </td>
                                                <td class="col-lg-1">
                                                    <input name="aaqx_qx_iniciales_<?php echo $iteracion ?>" class="form-control" value="<?php echo $f2['AAQX_QX_INICIALES'];?>">
                                                </td>
                                                <td class="col-lg-1">
                                                    <input name="aaqx_qx_recibidas_<?php echo $iteracion ?>" class="form-control" value="<?php echo $f2['AAQX_QX_RECIBIDAS'];?>">
                                                </td>
                                                <td class="col-lg-1">
                                                    <input name="aaqx_qx_liberadas_<?php echo $iteracion ?>" class="form-control" value="<?php echo $f2['AAQX_QX_LIBERADAS'];?>">
                                                </td>
                                                
                                                <?php /** En el caso del EDIT tengo que mandar el ID de la fila */ ?>
                                                <input type="hidden" name="aaqx_id_<?php echo $iteracion ?>" value="<?php echo $f2['AAQX_ID'];?>" />
                                                
                                            </tr>
                                         
                                         <?php 
                                         /** esta variable actúa en el process-edit para la cantidad de UPDATES */
                                         $iteracion++; 
                                         } 
                                         ?>   
                                               
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
                            <option><?php echo $f1['ACTA_MUESTRAS']; ?></option>
                            <option>SI</option>
                            <option>NO</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Verificación de T° y H°:</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="acta_tyh">
                            <option><?php echo $f1['ACTA_TYH']; ?></option>
                            <option>SI</option>
                            <option>NO</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Producto bajo condicion comercial:</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="acta_cond_com">
                            <option><?php echo $f1['ACTA_COND_COM']; ?></option>
                            <option>SI</option>
                            <option>NO</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Precintos:</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="acta_precintos">
                            <option><?php echo $f1['ACTA_PRECINTOS']; ?></option>
                            <option>SI</option>
                            <option>NO</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Carteles:</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="acta_carteles">
                            <option><?php echo $f1['ACTA_CARTELES']; ?></option>
                            <option>SI</option>
                            <option>NO</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Responsable de planta:</label>
                    <div class="col-lg-4">
                        <input name="acta_responsable" class="form-control" readonly="" value="<?php echo $f1['ACTA_RESPONSABLE']; ?>">
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Firmante por la empresa:</label>
                    <div class="col-lg-4">
                        <input name="acta_firmante" class="form-control" placeholder="Completar sólo si difiere del responsable de planta" value="<?php echo $f1['ACTA_FIRMANTE']; ?>">
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-2">Inspector:</label>
                    <div class="col-lg-4">
                        <select class="form-control" name="acta_inspector_id">
                            <?php echo combo_inspectores($f1['ACTA_INSPECTOR_ID']); ?>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                 
                 
                <div class="form-group">
                    <label class="col-lg-2">Observaciones / Comentarios:</label>
                    <div class="col-lg-4">
                        <textarea class="form-control" rows="3" name="acta_coment"><?php echo $f1['ACTA_COMENT']; ?></textarea>
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




 
                <div class="col-lg-3">
                    <input type="hidden" value="<?php echo $iteracion; ?>" name="iteracion" />
                    <input type="hidden" value="<?php echo $edit; ?>" name="edit" />
                    <button name="submit-edit" type="submit" class="btn btn-primary">Guardar</button>
                </div>
        
            </form>
            
          </div>
          <!-- /.col-lg-12 -->          
        </div>
        <!-- /.row -->
    
    </div>
    <!-- /.col-lg-12 (nested) -->
</div>
<!-- /.row -->    
    
    
    
