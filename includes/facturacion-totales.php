<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
        
            <div class="col-lg-12">
                <h2 class="page-header">Resúmen de Facturación</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
          <div class="col-lg-10">
              
              <form style="display: inline;" role="form" class="form-inline col-3-1" method="POST" action="facturacion.php" >
                <div class="form-group">
                    <div>
                        <i class="fa fa-calendar"></i> 
                        <input id="desde" name="desde" value="<?php if($desde <> ""){echo $desde;} ?>" class="form-control input-sm fecha_filtro" type="text" placeholder="Desde" required="">
                        
                        <i class="fa fa-calendar"></i> 
                        <input id="hasta" name="hasta" value="<?php if($hasta <> ""){echo $hasta;} ?>" class="form-control input-sm fecha_filtro" type="text" placeholder="Hasta" required="">
                    </div>
                </div>
                <button type="submit" name="submit-filtro" class="btn btn-primary btn-sm">Aplicar</button>
                <button type="submit" class="btn btn-default btn-sm">Reset</button>
                </form>
                
                
                <form style="display: inline;" role="form" class="form-inline" method="POST" action="facturacion.php" >
                <div class="form-group" >
                    <label>TC al <?php echo date('d-m',strtotime($tc['fecha'])); ?>:</label>     
                    <input name="tc_hoy" value="<?php echo $tc_hoy; ?>" class="form-control input-sm" type="text" >
                    <button type="submit" name="tc-grabar" class="btn btn-primary btn-sm">Actualizar</button>
                </div>
              
          </div>
          <!-- /.col-lg-6 -->
        </div>
        <!-- /.row -->
    <br />
    <p><span style="color: red;"><?php echo $err;?></span><?php echo $leyenda?></p>
    
        <div class="row">
            <div class="col-lg-10">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="FacturacionResumen">
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>Depositante</th>
                                <th>Moneda</th>
                                <th>Emision</th>
                                <th>Seguro</th>
                                <th>Total</th>
                                <th>Estado</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($totales !== ""){
                            
                            while($fila = mysqli_fetch_array($totales)){ 

                        ?>
                            <tr>
                                <td><?php echo $fila['DEPO_RASO']; ?></td>
                                <td><?php echo $fila['TITU_MONEDA']; ?></td>
                                <td><?php echo number_format($fila['EMISION'],2,",","."); ?></td>
                                <td><?php echo number_format($fila['SEGURO'],2,",","."); ?></td>
                                <td><?php echo number_format($fila['TOTAL'],2,",","."); ?></td>
                                <td>
                                    <?php 
                                    if(!is_null($estado) AND in_array($fila['DEPO_ID'],$estado)){
                                        echo "<span style='color:green;'>facturado</span>";
                                    }else{
                                        echo "<span style='color:red;'>pendiente</span>";
                                    }
                                    ?>
                                </td>
                                <td style="text-align: center;">
                                    <button class="btn-fact-detalles" data-value='<?php echo $fila['DEPO_RASO']; ?>' name='<?php echo $fila['DEPO_ID']; ?>'><i class='fa fa-list'></i></button>
                                </td>
                            </tr>
   
                        <?php 
                            /** antes de loopear, voy acumulando totales. 
                             */
                            if($fila['TITU_MONEDA'] == "Pesos"){
                                $emisionARS += $fila['EMISION'];
                                $seguroARS += $fila['SEGURO'];
                                $totalARS += $fila['TOTAL'];
                                
                            }else{
                                $emisionUSD += $fila['EMISION'];
                                $seguroUSD += $fila['SEGURO'];
                                $totalUSD += $fila['TOTAL'];
                            }
                        }
                        ?>
                        
                            <tr class="success" >
                                <td>Total General:</td>
                                <td>Dólares</td>
                                <td><?php echo number_format($emisionUSD,2,",","."); ?></td>
                                <td><?php echo number_format($seguroUSD,2,",","."); ?></td>
                                <td><?php echo number_format($totalUSD,2,",","."); ?></td>
                                <td></td>
                                <td></td>
                            
                            </tr>
                            <?php 
                            if($emisionARS > 0){
                            ?>
                            <tr class="info">
                                <td>Total General:</td>
                                <td>Pesos</td>
                                <td><?php echo number_format($emisionARS,2,",","."); ?></td>
                                <td><?php echo number_format($seguroARS,2,",","."); ?></td>
                                <td><?php echo number_format($totalARS,2,",","."); ?></td>
                                <td></td>
                                <td></td>
                            
                            </tr>
                            <?php
                            }
                            ?>
                            <tr class="active">
                                <td>Suma Total de facturación en Pesos:</td>
                                <td>Pesos</td>
                                <td><?php echo number_format(($emisionARS+$emisionUSD*$tc_hasta),2,",","."); ?></td>
                                <td><?php echo number_format(($seguroARS+$seguroUSD*$tc_hasta),2,",","."); ?></td>
                                <td><?php echo number_format(($totalARS+$totalUSD*$tc_hasta),2,",","."); ?></td>
                                <td>TC: <?php echo $tc_hasta ?></td>
                                <td></td>
                            
                            </tr>
                        <?php } ?>
        
                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
        
            </div>
        </div>
        <form action="facturacion.php" method="POST" id="fact-form-hidden">
          <input type="hidden" id="f-depo_id" name="depo_id" value=""/>
          <input type="hidden" id="f-depo_raso" name="depo_raso" value=""/>
          <input type="hidden" id="f-desde" name="desde" value=""/>
          <input type="hidden" id="f-hasta" name="hasta" value=""/>
          <button type="submit" style="display: none;" id="fact-form-hidden-button"></button>
        </form>
        <br />
        
        
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->