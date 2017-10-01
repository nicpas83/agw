<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Listado Facturas a la fecha</h2>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

<br />

        <div class="row">
            <div class="table-responsive">
                
                <table class="table table-striped table-bordered" id="facturas-listado">    
                    <thead class="panel-primary small">
                        <tr class="panel-heading">
                            <th>Factura Nro.</th>
                            <th>Fecha</th>
                            <th>Cliente</th>
                            <th>Periodo</th>
                            <th>Total</th>
                            <th>Comentario</th>
                            <th>Estado</th>
                            <th>Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        
                        while($fila = mysqli_fetch_array($facturas)){
                                
                        ?>
                        
                        <tr>
                            <td><?php echo $fila['FACTURA']; ?></td>
                            <td><?php echo $fila['FACT_FECHA']; ?></td>
                            <td><?php echo $fila['DEPO_RASO']; ?></td>
                            <td><?php echo $fila['PERIODO']; ?></td>
                            <td><?php echo number_format($fila['FACT_TOTAL'],2,",","."); ?></td>
                            <td><?php echo $fila['FACT_COMENT']; ?></td>
                            <td><?php echo $fila['FACT_ESTADO']; ?></td>
                            <td style="text-align: center;">
                                <form method="GET" action="facturas.php">
                                <input type="hidden" name="id" value="<?php echo $fila['FACT_ID']; ?>" />
                                <button type="submit" ><i class='fa fa-list'></i></button>
                                </form>
                            </td>
                        </tr>
                        
                        <?php  
                        }
                        ?>
                    </tbody>
                </table>
                
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
