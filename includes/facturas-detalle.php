<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Factura: <?php echo $detalle['FACTURA']?> </h3>
                <p><a href="facturas.php">Facturas</a> > detalle</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
<br /> 
        <div class="row">
            <div class="col-lg-8">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Detalle:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="col-lg-3">Fecha: </label><span class="col-lg-9 "><?php echo $detalle['FACT_FECHA']?></span>
                            </div>
                            <div class="col-lg-12">
                                <label class="col-lg-3">Cliente: </label><span class="col-lg-9 "><?php echo $detalle['DEPO_RASO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Periodo Facturado: </label><span class="col-lg-9"><?php echo $detalle['FACT_DESDE']." al ".$detalle['FACT_HASTA']; ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Emisión: </label><span class="col-lg-9">$ <?php echo number_format($detalle['FACT_EMISION'],2,",",".");?> (Tarifa: <?php echo $detalle['FACT_TAR_EMI']?>)</span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Seguro: </label><span class="col-lg-9">$ <?php echo number_format($detalle['FACT_SEGURO'],2,",",".");?> (Tarifa: <?php echo $detalle['FACT_TAR_SEG']?>)</span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Subtotal: </label><span class="col-lg-9">$ <?php echo number_format($detalle['FACT_SUBTOTAL'],2,",",".");?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Otros: </label><span class="col-lg-9">$ <?php echo number_format($detalle['FACT_OTROS'],2,",",".");?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Total IVA incluido: </label><span class="col-lg-9">$ <?php echo number_format($detalle['FACT_TOTAL'],2,",","."); ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Bonificación: </label><span class="col-lg-9">$ <?php echo number_format($detalle['FACT_DTO_TOTAL'],2,",","."); ?></span>
                            </div>

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