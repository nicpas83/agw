<!-- ############## AGREGAR DEPOSITOS POR PLANTA ########################## -->    
    
<div class="row">
  <div class="col-lg-6">
  
  <h4>2. Agregar Almacén:</h4>
  
  
  <form role="form" class="form-horizontal" method="POST" action="almacenes.php?plan=<?php echo $plan_id; ?>" >
    
    <div class="form-group">
        <label class="col-lg-3">Tipo de Depósito:</label>
        <div class="col-lg-9">
            <select class="form-control" name="tipo">
                 <?php echo combo_tipo_deposito(); ?>
            </select>
        </div>
    </div> <!-- /.form-group -->
    
    <div class="form-inline form-group">
        <label class="col-lg-3 ">Capacidad de Almacenaje:</label>
        <div class="col-lg-9">
            <input size="2" name="capacidad" class="form-control" required=""> - 
            <select name="unidad" class="form-control">
                <?php echo combo_unidades(); ?>
            </select>
        </div>

    </div> <!-- /.form-group -->
    
    <div class="form-group">
        <label class="col-lg-3 ">Nombre Interno:</label>
        <div class="col-lg-9">
            <input name="nombre_int" class="form-control" required="">
        </div>
    </div> <!-- /.form-group -->

    <div class="form-inline form-group">
        <label class="col-lg-3 ">Aforo Técnico:</label>
        
        <div class="col-lg-9">
            <input size="1" name="aforo_num" class="form-control" > , <input size="1" name="aforo_dec" class="form-control" value="00">
        </div>
        
    </div> <!-- /.form-group -->

    <input type="submit" name="submit-new" class="btn btn-primary" value="Agregar" />
  
  </form>
  
  </div>
  <!-- /.col-lg-6 -->
</div>
<!-- /.row -->