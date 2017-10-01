<?php 
/** 2. INFO SELECCIONADA:  se ofrece posibilidad de cancelar / muestra formulario Actas NEW 2 */        
   
$id_planta_selec = $_POST['planta'];
$motivo = $_POST['motivo'];
$styleHidden = "";

/**
// Aplica para Qx Recibidas y Qx Liberadas
if($motivo === "Auditoría" OR $motivo === "Otros"){
    $styleHidden = "style='display: none;'";
}
*/

//traigo info de la planta y sus almacenes correspondientes
include "process/actas-traigo-datos-planta-almacenes.php";  // $res_ult_acta = mysqli_fetch_array($cons_ult_acta);

 


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
                                    </div>
                                </div> <!-- /.form-group -->
        
<!-- ############# inicio tabla almacenes  ################# -->                                        
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Almacenes en Planta <?php echo $almacenesDePlanta['PLAN_NOMBRE']." | ".$msg_almacenes_acta." (según última acta)"; ?> 
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
                                                        $r = mysqli_num_rows($cons_ult_acta);
                                                        
                                                        /** no tiene actas cargadas - se muestran todos los almacenes */
                                                        if(empty($r)){
                                                            
                                                            mysqli_data_seek($result,0); //reseteo puntero
                                                            
                                                            $iteracion = 1;                                                    
                                                            while($almacenesDePlanta = mysqli_fetch_array($result)){

                                                        ?>
    

                                                            <tr>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_alma_id_<?php echo $iteracion ?>" class="form-control">
                                                                        <option></option>
                                                                        <?php echo combo_almacenes_de_planta($id_planta_selec);  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_producto_id_<?php echo $iteracion ?>" class="form-control" name="producto_">
                                                                        <option></option>
                                                                        <?php echo combo_productos();  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_unidad_<?php echo $iteracion ?>" class="form-control">
                                                                        <option>Tns</option>
                                                                        <?php echo combo_unidades();  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-1">
                                                                    <input name="aaqx_qx_iniciales_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_recibidas_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_liberadas_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                
                                                            </tr>
                                                         
                                                         <?php $iteracion++; }
                                                         
                                                         }else{
                                                            /** Tiene actas, se muestran almacenes según última acta */
                                                            
                                                            $iteracion = 1;                                                    
                                                            while($res_ult_acta = mysqli_fetch_array($cons_ult_acta)){
                                                        
                                                        ?>    
                                                                
                                                            <tr>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_alma_id_<?php echo $iteracion ?>" class="form-control">
                                                                        <option></option>
                                                                        <?php echo combo_almacenes_de_planta($id_planta_selec,$res_ult_acta['ALMA_ID']);  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_producto_id_<?php echo $iteracion ?>" class="form-control" name="producto_">
                                                                        <option></option>
                                                                        <?php echo combo_productos($res_ult_acta['AAQX_PRODUCTO_ID']);  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_unidad_<?php echo $iteracion ?>" class="form-control">
                                                                        <option>Tns</option>
                                                                        <?php echo combo_unidades($res_ult_acta['AAQX_UNIDAD']);  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-1">
                                                                    <input name="aaqx_qx_iniciales_<?php echo $iteracion ?>" value="<?php echo $res_ult_acta['CANT_INICIAL'] ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_recibidas_<?php echo $iteracion ?>" tabindex="<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_liberadas_<?php echo $iteracion ?>" tabindex="<?php echo $iteracion + 1 ?>" class="form-control">
                                                                </td>
                                                                
                                                            </tr>        
                                                             
                                                                
                                                        <?php        
                                                                $iteracion++;
                                                            }
                                                               
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

                                <?php 
                                if($cant_almacenes > $cant_almacenes_ult_acta){
                                    
                                    /** defino cuántos almacenes quedaron por fuera de la última acta */
                                    $cant_otros_almacenes = $cant_almacenes - $cant_almacenes_ult_acta;
                                ?> 
                                
                                <br />
                                
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                Otros Almacenes en Planta
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
                                                        
                                                        /** se muestran todos los almacenes - limitando la cantidad a "otros almacenes" */
                                                         
                                                            mysqli_data_seek($result,0); //reseteo puntero
                                                            $almacenesDePlanta = mysqli_fetch_array($result);
                                                            
                                                            $i = 1;                                                    
                                                            do{

                                                        ?>
    

                                                            <tr>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_alma_id_<?php echo $iteracion ?>" class="form-control">
                                                                        <option></option>
                                                                        <?php echo combo_almacenes_de_planta($id_planta_selec);  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_producto_id_<?php echo $iteracion ?>" class="form-control" name="producto_">
                                                                        <option></option>
                                                                        <?php echo combo_productos();  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-2">
                                                                    <select name="aaqx_unidad_<?php echo $iteracion ?>" class="form-control">
                                                                        <option>Tns</option>
                                                                        <?php echo combo_unidades();  ?>
                                                                    </select>
                                                                </td>
                                                                <td class="col-lg-1">
                                                                    <input name="aaqx_qx_iniciales_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_recibidas_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                <td class="col-lg-1" <?php echo $styleHidden; ?>>
                                                                    <input name="aaqx_qx_liberadas_<?php echo $iteracion ?>" class="form-control">
                                                                </td>
                                                                
                                                            </tr>
                                                         
                                                         <?php $iteracion++; $i++; }while($i<=$cant_otros_almacenes);  //condicion
                                                         
                                                         
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

                                 
                                <?php
                                   
                                } 
                                ?>


<!-- #######  continúa formulario ############-->                            
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
    