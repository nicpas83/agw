
<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
            <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Beneficiario: <?php echo $fila['BENE_RASO']?></h3>
                <p><a href="beneficiarios.php">Beneficiarios</a> > Ficha detalles</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <a href="beneficiarios.php?edit=<?php echo $id;?>"><button class="btn btn-primary btn-xs">Modo Edición</button></a>
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
                                <label class="col-lg-3">Razón Social: </label><span class="col-lg-9 "><?php echo $fila['BENE_RASO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Nro. CUIT : </label><span class="col-lg-9"><?php echo $fila['BENE_CUIT']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Legal: </label><span class="col-lg-9"><?php echo $fila['BENE_DOMLEG']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Fiscal: </label><span class="col-lg-9"><?php echo $fila['BENE_DOMFIS']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio Comercial: </label><span class="col-lg-9"><?php echo $fila['BENE_DOMCOM']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Provincia: </label><span class="col-lg-9"><?php echo $provincia ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Localidad: </label><span class="col-lg-9"><?php echo $localidad ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Contacto 1: </label><span class="col-lg-9"><?php echo $fila['BENE_CONTACTO1']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Contacto 2: </label><span class="col-lg-9"><?php echo $fila['BENE_CONTACTO2']; ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Contacto 3: </label><span class="col-lg-9"><?php echo $fila['BENE_CONTACTO3']; ?></span>
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