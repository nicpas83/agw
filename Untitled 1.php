<?php

/**
 * @author gencyolcu
 * @copyright 2017
 */



?>

 <br />
        <p>Periodo analizado: <?php echo $desde." al ".$hasta; ?> | Vigente al Cierre: <?php echo number_format($tarifas['cant_vigente'],2,",",".") ." ". $tarifas['unidad'];?>  </p>
        <p>Tarifa Emision: <?php echo number_format($tarifas['emision']/100,4,",","."); ?> | Tarifa Seguro: <?php echo number_format($tarifas['seguro']/100,4,",",".");?> | 
        Minimo por Ubicación: <?php echo number_format($tarifas['minimo'],2,",","."); ?></p>
        <br />
        <?php 
        if($dif_por_minimo > 0){
        ?>
        <h4 style="font-weight: bold;">Diferencia total por aplicar tarifa mínima: <?php echo $dif_por_minimo; ?></h4>
        <?php
        }
        ?>

        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Warrants a Facturar</h4>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        <br />
        <div class="row">
                <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="facturacion_detalle">
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
                                    if(isset($_POST['submit-filtro'])){
                                
                                        $res = facturacion_detalle($depo_id,$desde,$hasta);
                                        
                                        while($fila = mysqli_fetch_array($res)){
    
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
                                        <td><?php echo $fila['EMISION'];?></td>
                                        <td><?php echo $fila['SEGURO'];?></td>
                                        <td><?php echo $fila['TOTAL'];?></td>
                                    </tr>
                                    <?php
                                        } 
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->      
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->