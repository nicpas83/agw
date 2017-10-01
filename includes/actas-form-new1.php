<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">Actas de Inspección</h3>
                <p><a href="actas.php">Actas</a> > Nueva - Paso 1/2</p>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
<br />

        <!-- Seleccionamos la planta para completar la tabla de almacenes  -->
        <div class="row">
          <div class="col-lg-6">
            <p>Seleccionar la Planta y el tipo de Inspección.</p>
            
            <form role="form" class="form-horizontal" method="POST" action="actas.php">
            
                <div class="form-group">
                    <label class="col-lg-4">Planta:</label>
                    <div class="col-lg-8">
                        <select name="planta" class="form-control">
                            <?php echo combo_plantas_nombre();?>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
                
                <div class="form-group">
                    <label class="col-lg-4">Motivo de Inspección:</label>
                    <div class="col-lg-8">
                        <select name="motivo" class="form-control">
                            <option>Inspección de rutina</option>
                            <option>Recepción de mercadería</option>
                            <option>Liberación de mercadería</option>
                            <option>Auditoría</option>
                            <option>Movimiento Interno de mercadería</option>
                            <option>Otros</option>
                        </select>
                    </div>
                </div> <!-- /.form-group -->
 
                <div class="col-lg-3">
                    <button name="submit-new1" type="submit" class="btn btn-primary">Siguiente</button>
                </div>
        
            </form>
            
          </div>
          <!-- /.col-lg-12 -->          
        </div>
        <!-- /.row -->
    
    </div>
    <!-- /.col-lg-12 (nested) -->
</div>
<!-- /.row -->    
    
    
    
