<!-- ############## AGREGAR DEPOSITOS POR PLANTA ########################## -->    
    
<div class="row">
  <div class="col-lg-6">
  
  <h4>Editar Almacén:</h4>
  
  
  <form role="form" class="form-horizontal" method="POST" action="almacenes.php" >
    
    <div class="form-group">
        <label class="col-lg-3">Tipo de Depósito:</label>
        <div class="col-lg-9">
            <select class="form-control" name="tipo">
                <option><?php echo $fila['ALMA_TIPO']; ?></option>
                 <?php echo combo_tipo_deposito(); ?>
            </select>
        </div>
    </div> <!-- /.form-group -->
    
    <div class="form-inline form-group">
        <label class="col-lg-3 ">Capacidad de Almacenaje:</label>
        <div class="col-lg-9">
            <input size="2" name="capacidad" class="form-control" required="" value="<?php echo $fila['ALMA_CAPACIDAD']; ?>"> - 
            <select name="unidad" class="form-control">
                <?php echo combo_unidades(); ?>
            </select>
        </div>

    </div> <!-- /.form-group -->
    
    <div class="form-group">
        <label class="col-lg-3 ">Nombre Interno:</label>
        <div class="col-lg-9">
            <input name="nombre_int" class="form-control" required="" value="<?php echo $fila['ALMA_NOMBRE_INT']; ?>">
        </div>
    </div> <!-- /.form-group -->

    <div class="form-inline form-group">
        <label class="col-lg-3 ">Aforo Técnico:</label>
        
        <div class="col-lg-9">
            <input size="1" name="aforo_num" class="form-control" value="<?php echo $aforoNum[0];?>" > , <input size="1" name="aforo_dec" class="form-control" value="<?php echo $aforoNum[1];?>">
        </div>
        
    </div> <!-- /.form-group -->
    
    <input type="hidden" value="<?php echo $plan_id; ?>" name="plan_id" />
    <input type="hidden" value="<?php echo $alma_id; ?>" name="alma_id" />
    <input type="submit" name="submit-edit" class="btn btn-primary" value="Actualizar" />
  
  </form>
  
  </div>
  <!-- /.col-lg-6 -->
</div>
<!-- /.row -->