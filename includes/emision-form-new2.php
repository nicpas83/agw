
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Emisión Nuevo Título (Nro. <?php echo $_SESSION['wcd_nr']; ?> )</h3>
                
                <p>Tipo: Warrant <?php if($_SESSION['endoso'] == "N"){echo "Comercial";}else{echo "Financiero";} ?></p>
                <p>Planta: <?php echo $_SESSION['plan_nombre']; ?></p>
                <p>Depositante: <?php echo $_SESSION['depo_raso']; ?></p>
                <p>Tarifas Vigentes: Emisión <?php echo $_SESSION['tari_emision']; ?> - Seguro <?php echo $_SESSION['tari_seguro']; ?> - Otros <?php echo $_SESSION['tari_otros']; ?></p>
                <p>Póliza Nro.: <?php echo $_SESSION['poliza']; ?>  ||  Vto.: <?php echo $_SESSION['poli_venc']; ?></p>
                <p>Cía. de Seguro: <?php echo $_SESSION['poli_raso']; ?></p>
            
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <br />
        
        <div class="row">
            <div class="col-lg-7">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Paso 2/2:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
                     
                        
<!-- ### FORMULARIO ### -->                            
                            <form role="form" class="form-horizontal" method="POST"
                                action="emision.php" >

                              <div class="col-lg-12">
                                
                                <div style="color: red;">
                                <?php if(isset($err['tarifas'])){echo $err['tarifas'];} ?>
                                <?php if(isset($err['poli'])){echo $err['poli'];} ?>

                                </div>
                                
                                
<!-- ### Nueva/Renovacion ### -->                                  
                                <div class="form-group">
                                    <label class="col-lg-3 ">Operación: </label>
                                    <div class="col-lg-9">
                                        <select name="operacion" class="form-control">
                                            <option>Nueva</option>
                                            <option>Renovación</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->
                                
                                
<!-- ### Titulo Renovado - display: none ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Título renovado:</label>
                                    <div class="col-lg-9">
                                        <input name="renovado" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->                                
                                
                                
<!-- ### Fecha Emision ### -->                                                         
                                <div class="form-group">
                                    <label class="col-lg-3 ">Fecha emisión:</label>
                                    <div class="col-lg-9">
                                        <input name="fecha_emision" class="form-control fecha_form" required="" id="emision-fecha">
                                    </div>
                                </div> <!-- /.form-group -->                                    
                                    
<!-- ### Plazo y Vencimiento ### -->                                                         
                                
                                <div class="form-group">
                                    <label class="col-lg-3 ">Plazo o Vto.:</label>
                                    <div class="col-lg-9">
                                        <input name="plazovenc" class="form-control" required="" placeholder="Plazo (núm. entero) ó fecha Vto. ('aaaa-mm-dd')">
                                    </div>
                                </div> <!-- /.form-group -->                                    



<!-- ### TRO ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Vendedor:</label>
                                    <div class="col-lg-9">
                                        <input name="vendedor" class="form-control" placeholder="Completar sólo si difiera de Razón Social Planta">
                                    </div>
                                </div> <!-- /.form-group -->
                 
<hr />                                
<!-- ### Producto ### -->                                  
                                <div class="form-group">
                                    <label class="col-lg-3 ">Producto: </label>
                                    <div class="col-lg-9">
                                        <select name="producto" class="form-control">
                                            <?php echo combo_productos("","false"); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->    

<!-- ### Identificación ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Identificación:</label>
                                    <div class="col-lg-9">
                                        <input name="identificacion" class="form-control" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
<!-- ### Calidad ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Calidad:</label>
                                    <div class="col-lg-9">
                                        <input name="calidad" class="form-control" required="" >
                                    </div>
                                </div> <!-- /.form-group -->
                                
<!-- ### Unidad ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Unidad:</label>
                                    <div class="col-lg-9">
                                        <select name="unidad" class="form-control">
                                            <?php echo combo_unidades(); ?>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->        
                                                                                                                    
<!-- ### Moneda ### -->                                  
                                <div class="form-group">
                                    <label class="col-lg-3 ">Moneda: </label>
                                    <div class="col-lg-9">
                                        <select name="moneda" class="form-control">
                                            <option>USD</option>
                                            <option>Pesos</option>
                                        </select>
                                    </div>
                                </div> <!-- /.form-group -->                                

<!-- ### Cantidad ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Cantidad:</label>
                                    <div class="col-lg-9">
                                        <input name="cantidad" class="form-control" required="" id="emision-cant">
                                    </div>
                                </div> <!-- /.form-group -->                                
<!-- ### Precio ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Precio Unitario:</label>
                                    <div class="col-lg-9">
                                        <input name="precio_u" class="form-control" required="" id="emision-precio" >
                                    </div>
                                </div> <!-- /.form-group -->                                
                                
<!-- ### Total ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Valor Total:</label>
                                    <div class="col-lg-9">
                                        <input name="total" class="form-control" id="emision-total" disabled="">
                                    </div>
                                </div> <!-- /.form-group -->                                
                                
<!-- ### Observaciones ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Observaciones:</label>
                                    <div class="col-lg-9">
                                        <input name="observaciones" class="form-control">
                                    </div>
                                </div> <!-- /.form-group -->

<hr />                                
<!-- ### Valor póliza ### -->                                     
                                <div class="form-group">
                                    <label class="col-lg-3 ">Valor póliza:</label>
                                    <div class="col-lg-9">
                                        <input name="poliza_valor" class="form-control" placeholder="Completar sólo si difiere de Valor Total">
                                    </div>
                                </div> <!-- /.form-group -->
                                

                                
                                
                                
                                
                                

<?php 
/** a la hora de preparar variables en el process hay que preguntar de nuevo */
if($_SESSION['endoso'] == "S"){
    include "emision-form-endoso.php";
} 
?>
                                                            

                                
                            </div>
                            <!-- /.col-lg-12 -->
                            
                            <br />
                            
                            <div class="col-lg-12 text-right">
                                <button type="submit" class="btn btn-primary" name="submit-new2">Aceptar</button>
                                <a href="process/emision-process-cancelar.php"><button type="button" class="btn btn-primary">Cancelar</button></a>
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

