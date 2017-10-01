<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Póliza Nro.: <?php echo $fila['POLI_POLIZA_NRO']?></h3>
                <p><a href="polizas.php">Polizas</a> > Ficha detalles</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <a href="polizas.php?edit=<?php echo $id;?>"><button class="btn btn-primary btn-xs">Modo Edición</button></a>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
<br /> 
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Ficha:
                    </div>
                    
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <label class="col-lg-3">Razón Social: </label><span class="col-lg-9 "><?php echo $fila['POLI_RASO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Nro. CUIT : </label><span class="col-lg-9"><?php echo $fila['POLI_CUIT']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Legal: </label><span class="col-lg-9"><?php echo $fila['POLI_DOMLEG']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Fiscal: </label><span class="col-lg-9"><?php echo $fila['POLI_DOMFIS']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Provincia: </label><span class="col-lg-9"><?php echo $provincia ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Localidad: </label><span class="col-lg-9"><?php echo $localidad ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Cobertura: </label><span class="col-lg-9"><?php echo $fila['POLI_COBERTURA']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Vencimiento: </label><span class="col-lg-9"><?php echo $fila['POLI_VENC']; ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Propia: </label><span class="col-lg-9"><?php echo $fila['POLI_PROPIA']; ?></span>
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