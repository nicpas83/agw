<?php 

?>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
    
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Inspector: <?php echo $fila['INSP_APELLIDO'].", ".$fila['INSP_NOMBRE']; ?></h3> 
                <p><a href="inspectores.php">Inspectores</a> > Ficha detalles</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        <div class="row">
            <div class="col-lg-12">
                <a href="inspectores.php?edit=<?php echo $id_insp;?>"><button class="btn btn-primary btn-xs">Modo Edición</button></a>
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
                                <label class="col-lg-3">Nombre: </label><span class="col-lg-9 "><?php echo $fila['INSP_NOMBRE']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Apellido: </label><span class="col-lg-9"><?php echo $fila['INSP_APELLIDO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">DNI: </label><span class="col-lg-9"><?php echo $fila['INSP_DNI']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Tel.: </label><span class="col-lg-9"><?php echo $fila['INSP_TEL']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">E-mail: </label><span class="col-lg-9"><?php echo $fila['INSP_EMAIL']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio: </label><span class="col-lg-9"><?php echo $fila['INSP_DOMICILIO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Provincia: </label><span class="col-lg-9"><?php echo $provincia ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Localidad: </label><span class="col-lg-9"><?php echo $localidad ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Zonas de cobertura: </label><span class="col-lg-9"><?php echo lista_explode_id('-',$fila["INSP_ZONAS"],'provincias','PROV_ID','PROV_NOMBRE'); ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Especialidad: </label><span class="col-lg-9"><?php echo lista_explode_id('-',$fila["INSP_ESPECIALIDAD"],'productos','PROD_ID','PROD_NOMBRE'); ?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Domicilio: </label><span class="col-lg-9"><?php echo $fila['INSP_DOMICILIO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Referenciado por: </label><span class="col-lg-9"><?php echo $fila['INSP_REFERENCIA']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Conocimiento de la herramienta: </label><span class="col-lg-9"><?php echo $fila['INSP_CONOCIMIENTO']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Movilidad propia: </label><span class="col-lg-9"><?php echo $fila['INSP_MOVILIDAD']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Honorarios: </label><span class="col-lg-9"><?php echo $fila['INSP_HONORARIOS_POR']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Nro. de Póliza: </label><span class="col-lg-9"><?php echo $fila['INSP_NRO_POLIZA']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Vencimiento de Póliza: </label><span class="col-lg-9"><?php echo $fila['INSP_VENC_POLIZA']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Disponibilidad: </label><span class="col-lg-9"><?php echo $fila['INSP_DISPONIBILIDAD']?></span>
                            </div>
                            
                            <div class="col-lg-12">
                                <label class="col-lg-3">Capacitación: </label><span class="col-lg-9"><?php echo $fila['INSP_CAPACITACION']; ?></span>
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