<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
        
            <div class="col-lg-12">
                <h3 class="page-header">Detalle Facturación: <?php echo $depo_raso;  ?></h3>
                 <p><form method="POST" action="facturacion.php">
                        <button class="btn btn-primary btn-sm" type="submit" name="submit-filtro"><i class="fa fa-arrow-left"> </i> Volver</button>
                        <input type="hidden" name="desde" value="<?php echo $desde ?>" />
                        <input type="hidden" name="hasta" value="<?php echo $hasta ?>" />
                    </form>
                </p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Resumen por ubicación:</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="FacturacionPivotDepositante">
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>Planta Razón Social</th>
                                <th>Nombre Planta</th>
                                <th>Provincia</th>
                                <th>Moneda</th>
                                <th>Emision</th>
                                <th>Seguro</th>
                                <th>SubTotal</th>
                                <th>Total</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        
                        

                        while($fila = mysqli_fetch_array($detalle_pivot)){ 
                                
                        ?>
                            <tr>
                                <td><?php echo $fila['PLAN_RASO']; ?></td>
                                <td><?php echo $fila['PLAN_NOMBRE']; ?></td>
                                <td><?php echo $fila['PROV_NOMBRE']; ?></td>
                                <td><?php echo $fila['TITU_MONEDA']; ?></td>
                                <td><?php echo number_format(round($fila['EMISION'],2),2,",","."); ?></td>
                                <td><?php echo number_format(round($fila['SEGURO'],2),2,",","."); ?></td>
                                <td><?php echo number_format(round($fila['SUBTOTAL'],2),2,",","."); ?></td>
                                <td><?php echo number_format(round($fila['TOTAL'],2),2,",","."); ?></td>
                                
                            </tr>
                            
                        <?php 
                        /** antes de cerrar el loop, obtengo:
                         *  - la diferencia entre total y subtotal para reflejar eldescuento.
                         *  - el valor o cantidad vigente (segun unidad tarifa depositante [dolares/toneladas])
                         *  - tarifas aplicadas
                         *  - totales de columna
                         */
                            
                            //Según la unidad (que figura en cuadro tarifario)defino 
                            //qué cifra se informa como "vigente al cierre".
                            if($fila['TARI_UNIDAD'] == 'Toneladas'){
                                $vigente = number_format($fila['CANT_VIGENTE'],0,",",".");
                                $unidad = "Toneladas";    
                            }else{
                                $vigente = number_format($fila['VALOR_VIGENTE'],2,",",".");    
                                $unidad = $fila['TITU_MONEDA'];
                            }

                            $tar_emision = $fila['TARI_EMISION'];
                            $tar_seguro = $fila['TARI_SEGURO'];
                            $minimo = $fila['TARI_MIN'];
                            
                            
                            /** antes de loopear, voy acumulando totales. 
                             */
                            if($fila['TITU_MONEDA'] == "Pesos"){
                                $emisionARS += $fila['EMISION'];
                                $seguroARS += $fila['SEGURO'];
                                $subtotalARS += $fila['SUBTOTAL'];
                                $totalARS += $fila['TOTAL'];
                                $dif_por_minimoARS += $totalARS - $subtotalARS;
                                
                            }else{
                                $emisionUSD += $fila['EMISION'];
                                $seguroUSD += $fila['SEGURO'];
                                $subtotalUSD += $fila['SUBTOTAL'];
                                $totalUSD += $fila['TOTAL'];
                                $dif_por_minimoUSD += $totalUSD - $subtotalUSD;
                            }  
                            
                        }
                                      
                        /** Diferencias Totales en Pesos. (bonificacion en caso de tarifa minima)  */
                        $dif_emision = round(($dif_por_minimoARS + $dif_por_minimoUSD*$tc_hasta) * (($emisionARS+$emisionUSD*$tc_hasta) / ($subtotalARS+$subtotalUSD*$tc_hasta)),2);
                        $dif_seguro = round(($dif_por_minimoARS + $dif_por_minimoUSD*$tc_hasta) * (($seguroARS+$seguroUSD*$tc_hasta) / ($subtotalARS+$subtotalUSD*$tc_hasta)),2);
                        
                        
                        /** Total Gral en Pesos*/
                        $total_emision = number_format(round($emisionARS+$emisionUSD*$tc_hasta,2),2,",",".");
                        $total_seguro = number_format(round($seguroARS+$seguroUSD*$tc_hasta,2),2,",",".");
                        $total_subtotal = number_format(round($subtotalARS+$subtotalUSD*$tc_hasta,2),2,",",".");
                        $total_total = number_format(round($totalARS+$totalUSD*$tc_hasta,2),2,",",".");
                        
                        
                        $total_emision_SinDto = $total_emision + $dif_emision; //para los campos hidden 
                        $total_seguro_SinDto = $total_seguro + $dif_seguro; //para los campos hidden 
                        $dif_total_porcentaje = round(($dif_emision+$dif_seguro)/($total_emision+$total_seguro),2)*100;
                        
                        //var_dump($unidad); exit();
                        ?>
                            
                            
                            <tr class="success" >
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">Total:</td>
                                <td>Dólares</td>
                                <td><?php echo number_format($emisionUSD,2,",","."); ?></td>
                                <td><?php echo number_format($seguroUSD,2,",","."); ?></td>
                                <td><?php echo number_format($subtotalUSD,2,",","."); ?></td>
                                <td><?php echo number_format($totalUSD,2,",","."); ?></td>
                                
                            
                            </tr>
                            <?php
                            if($emisionARS > 0){
                            ?>
                            <tr class="info">
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">Total:</td>
                                <td>Pesos</td>
                                <td><?php echo number_format($emisionARS,2,",","."); ?></td>
                                <td><?php echo number_format($seguroARS,2,",","."); ?></td>
                                <td><?php echo number_format($subtotalARS,2,",","."); ?></td>
                                <td><?php echo number_format($totalARS,2,",","."); ?></td>
                                
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="active">
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">Total General en Pesos:</td>
                                <td style="font-size: small;">TC: <?php echo $tc_hasta ?></td>
                                <td><?php echo $total_emision; ?></td>
                                <td><?php echo $total_seguro; ?></td>
                                <td><?php echo $total_subtotal; ?></td>
                                <td><?php echo $total_total; ?></td>
                            </tr>
                            
                            <tr class="active" style="font-size: small;">
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">%</td>
                                <td></td>
                                <td><?php echo _porcentaje((($emisionARS+$emisionUSD*$tc_hasta) / ($subtotalARS+$subtotalUSD*$tc_hasta))); ?></td>
                                <td><?php echo _porcentaje((($seguroARS+$seguroUSD*$tc_hasta) / ($subtotalARS+$subtotalUSD*$tc_hasta))); ?></td>
                                <td><?php echo _porcentaje((($subtotalARS+$subtotalUSD*$tc_hasta) / ($subtotalARS+$subtotalUSD*$tc_hasta))); ?></td>
                                <td><?php echo _porcentaje((($totalARS+$totalUSD*$tc_hasta) / ($subtotalARS+$subtotalUSD*$tc_hasta))); ?></td>
                            </tr>
                            
                            <?php 
                            if($dif_por_minimoARS > 0 OR $dif_por_minimoUSD > 0){
                            ?>
                            <tr class="warning" style="font-size: small;">
                                <td></td>
                                <td></td>
                                <td style="text-align: right;">Diferencia por tarifa mínima:</td>
                                <td>Pesos</td>
                                <td><?php echo number_format($dif_emision,2,",",".");?></td>
                                <td><?php echo number_format($dif_seguro,2,",",".");?></td>
                                <td><?php echo number_format($dif_emision+$dif_seguro,2,",",".");?></td>
                                <td><?php  ?></td>
                            </tr>
                            <?php
                            }
                            ?>
        
                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
            </div>
        </div>
        
        
        <br />
        <p>Periodo analizado: <?php echo $desde." al ".$hasta; ?> | Vigente al Cierre: <?php echo $vigente." ".$unidad; ?>  </p>
        <p>Tarifa Emision: <?php echo $tar_emision ?> | Tarifa Seguro: <?php echo $tar_seguro ?> | 
        Minimo por Ubicación: <?php echo $minimo;  ?></p>
        <p>Tipo de cambio: <?php echo number_format($tc_hasta,2,",","."); ?></p>
        <?php 
        if($dif_por_minimoARS > 0 OR $dif_por_minimoUSD > 0){
        ?>
        <p class="h4">
        <span class="mark" >(*) Diferencia total por aplicar tarifa mínima: 
        Dólares: <?php echo number_format($dif_por_minimoUSD,2,",","."); ?> | 
        Pesos: <?php echo number_format($dif_por_minimoARS,2,",","."); ?> 
        (Total Pesos: <?php echo number_format(($dif_por_minimoARS + $dif_por_minimoUSD*$tc_hasta),2,",","."); ?> )
        </span>
        </p>
        
        <?php
        }
        ?>
        
        <?php 
        /** convertir totales a Pesos para la facturación */
 
        ?>
       
       
        <?php 
        
        if(!is_null($estado) AND in_array($depo_id,$estado)){
            echo "<p class = 'alert-info'> Consulta ya facturada. </p>";
        }else{
        
        ?>
             
<!-- ## GRABAR FACTURA ############################################ -->
        <div class="row">                            
             <div class="col-lg-12">
                <h4 class="page-header">Crear Factura:</h4>
            </div>
            
            <div class="col-lg-12">
                
                <form id="fact-form" role="form" class="form-horizontal" method="POST" action="facturacion.php" >
                    
                    <?php if(isset($err['existe'])){echo $err['existe'];} ?>
                    <?php if(isset($err['cuit'])){echo $err['cuit'];} ?>
                   
                   <div class="col-lg-4">

                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Fecha: </label>
                        <div class="col-xs-6">
                        <input class="form-control fecha_filtro" name="fecha" value="<?php echo $hasta;  ?>" >
                        </div>
                    </div> <!-- /.form-group -->
                    
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">FC Nro.: </label>
                        <div class="col-xs-6">
                        <input class="form-control" name="nro" value="<?php echo $ult_fc ?>" required="">
                        </div>
                    </div> <!-- /.form-group -->
                    
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Emision:</label>
                        <div class="col-xs-6">
                        <input class="form-control" name="total_emision" id="total_emision" value="<?php echo $total_emision ?>" >
                        <input type="hidden" id="total_emision_bk" value="<?php echo $total_emision_SinDto ?>" >
                        </div>
                    </div> <!-- /.form-group -->
                    
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Seguro:</label>
                        <div class="col-xs-6">
                        <input class="form-control" name="total_seguro" id="total_seguro" value="<?php echo $total_seguro ?>" >
                        <input type="hidden" id="total_seguro_bk" value="<?php echo $total_seguro_SinDto ?>" >
                        </div>
                    </div> <!-- /.form-group -->
                    
                    
                    
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary" name="submit-new">Guardar</button>
                    </div> <!-- /.form-group -->
                  </div>
                  <!-- /columna 1 -->
                  
                  <div class="col-lg-4">
                  
                  <div class="form-group">
                        <label class="cotrol-label col-xs-4">Tipo: </label>
                        <div class="col-xs-6">
                        <input class="form-control" name="tipo" value="A" >
                        </div>                        
                    </div> <!-- /.form-group -->
                    
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Punto Vta: </label>
                        <div class="col-xs-6">
                        <input class="form-control" name="ptovta" value="0002" required="">
                        </div>
                    </div> <!-- /.form-group -->
                                      
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Otros Cargos: </label>
                        <div class="col-xs-6">
                        <input class="form-control" name="otros" >
                        </div>
                    </div> <!-- /.form-group -->
                    
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Observaciones:</label>
                        <div class="col-xs-6">
                        <input class="form-control" name="coment"  >
                        </div>
                    </div> <!-- /.form-group -->
                  
                  </div>
                  <!-- /columna 2 -->
                  
                  
                  <div class="col-lg-4"> 
                  
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Dto. Emisión:</label>
                        <div class="col-xs-6">
                        <input class="form-control" name="dto_emision" id="dto_emision" value="<?php echo $dif_emision; ?>" >
                        <input type="hidden" id="dto_emision_bk" value="<?php echo $dif_emision; ?>"/>
                        </div>
                    </div> <!-- /.form-group -->
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Dto. Seguro:</label>
                        <div class="col-xs-6">
                        <input class="form-control" name="dto_seguro" id="dto_seguro" value="<?php echo $dif_seguro; ?>" >
                        <input type="hidden" id="dto_seguro_bk" value="<?php echo $dif_seguro; ?>" >
                        </div>
                    </div> <!-- /.form-group -->
                    
                    
                    <?php 
                    /** Sólo muestro checkbox si existe tarifa minima  */ 
                    if($dif_por_minimoARS > 0 OR $dif_por_minimoUSD > 0){
                    ?>
                    <div class="form-group">
                        <div class="col-xs-1"></div>
                        <div class="checkbox col-xs-11">
                            <label class="cotrol-label">  
                              <input type="checkbox" name="chk-tari-min" id="chk-tari-min" > Aplicar Tar. Mínima
                            </label>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                    
                    <!-- Aplicar un porcentaje de descuento. Ejecuta por jquery.   -->
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">Descuento:</label>
                        <div class="col-xs-6 input-group" style="padding-left: 15px!important;">
                            <span class="input-group-addon">%</span>
                            <input class="form-control" name="dto_porcent" id="dto_porcent" value="<?php echo $dif_total_porcentaje; ?>" >
                            <input type="hidden" id="dto_porcent_bk" value="" >
                            <span class="input-group-btn">
                              <button class="btn btn-default" type="button" id="btn-dto-porcent"><i class="fa fa-refresh"></i>
                              </button>
                            </span>
                        </div>
                    </div> <!-- /.form-group -->
                    
                    <!-- IVA .   -->
                    <div class="form-group">
                        <label class="cotrol-label col-xs-4">IVA:</label>
                        <div class="col-xs-6 input-group" style="padding-left: 15px!important;">
                            <span class="input-group-addon">%</span>
                            <select class="form-control" name="iva">
                                <option value="1.21">21</option>
                                
                            </select>
                        </div>
                    </div> <!-- /.form-group -->
                    
                    
                  </div>
                  <!-- /columna 3 -->

                <!-- campos hidden -->
                <input type="hidden" name="depo_id" value="<?php echo $depo_id ?>" />
                <input type="hidden" name="desde" value="<?php echo $desde ?>" />
                <input type="hidden" name="hasta" value="<?php echo $hasta ?>" />
                <input type="hidden" name="emision" value="<?php echo $total_emision ?>" />
                <input type="hidden" name="seguro" value="<?php echo $total_seguro ?>" />
                <input type="hidden" name="subtotal" value="<?php echo $subtotal ?>" />
                <input type="hidden" name="total" value="<?php echo $total ?>" />
                <input type="hidden" name="tar_emi" value="<?php echo $tar_emision ?>" />
                <input type="hidden" name="tar_seg" value="<?php echo $tar_seguro ?>" />
                <input type="hidden" name="tc" value="<?php echo $tc_hasta ?>" />
                    
              </form>
            
            </div>
        </div>
        <!-- /.row -->
        <?php    
        }    /** fin condicional */
        ?>  
       
       

        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Warrants a Facturar</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="table-responsive">
                <table class="table table-striped table-bordered" id="facturacion_detalle">
                    <thead class="panel-primary small">
                        <tr class="panel-heading">
                            <th>Nro.</th>
                            <th>Estado</th>
                            <th>Planta_Razón_Social</th>
                            <th>Depositante</th>
                            <th>Fecha_Emision</th>
                            <th>Plazo</th>
                            <th>Vencimiento</th>
                            <th>Liberación</th>
                            <th>Producto</th>
                            <th>Unidad</th>
                            <th>Cantidad</th>
                            <th>Moneda</th>
                            <th>P.Unitario</th>
                            <th>Monto</th>
                            <th>Nombre Planta</th>
                            <th>Domicilio</th>
                            <th>Localidad</th>
                            <th>Provincia</th>
                            <th>Cia. de Seguro</th>
                            <th>Vto. TRO</th>
                            <th>Tipo de W</th>
                            <th>Beneficiario</th>
                            <th>Operación</th>
                            <th>Nro. Renovado</th>
                            <th>Dias</th>
                            <th>Emision</th>
                            <th>Seguro</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php    
        
                    while($fila = mysqli_fetch_array($detalles)){
        
                    $titu_estado = $fila['TITU_ESTADO'];
                    if($titu_estado == "V"){
                        $titu_estado = "Vigente";
                    }else{
                        $titu_estado = "Liberado";
                    }
        
                    ?>
                    <tr>
                        <td><?php echo $fila['TITU_WCD_NR'];?></td>
                        <td><?php echo $titu_estado;?></td>
                        <td><?php echo $fila['PLAN_RASO'];?></td>
                        <td><?php echo $fila['DEPO_RASO'];?></td>
                        <td><?php echo $fila['TITU_FECHA_EMISION'];?></td>
                        <td><?php echo $fila['TITU_PLAZO'];?></td>
                        <td><?php echo $fila['TITU_VENC'];?></td>
                        <td><?php echo $fila['TITU_FECHA_LIBERACION'];?></td>
                        <td><?php echo $fila['TITU_PRODUCTO'];?></td>
                        <td><?php echo $fila['TITU_UNIDAD'];?></td>
                        <td><?php echo number_format($fila['TITU_CANTIDAD'],2,",",".");?></td>
                        <td><?php echo $fila['TITU_MONEDA'];?></td>
                        <td><?php echo number_format($fila['TITU_PRECIO_U'],2,",",".");?></td>
                        <td><?php echo number_format($fila['TITU_VALOR_W'],2,",",".");?></td>
                        <td><?php echo $fila['PLAN_NOMBRE'];?></td>
                        <td><?php echo $fila['PLAN_DOMICILIO'];?></td>
                        <td><?php echo $fila['LOCA_NOMBRE'];?></td>
                        <td><?php echo $fila['PROV_NOMBRE'];?></td>
                        <td><?php echo $fila['POLI_RASO'];?></td>
                        <td><?php echo $fila['POLI_VENC'];?></td>
                        <td><?php echo $fila['TITU_TIPO_W'];?></td>
                        <td><?php echo $fila['BENE_RASO'];?></td>
                        <td><?php echo $fila['TITU_OPERACION'];?></td>
                        <td><?php echo $fila['TITU_RENOVADO'];?></td>
                        <td><?php echo $fila['DIAS'];?></td>
                        <td><?php echo number_format(round($fila['EMISION'],2),2,",",".");?></td>
                        <td><?php echo number_format(round($fila['SEGURO'],2),2,",",".");?></td>
                        <td><?php echo number_format(round($fila['EMISION'],2) + round($fila['SEGURO'],2),2,",",".");?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
 
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->