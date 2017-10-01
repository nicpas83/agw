<!-- ############## AGREGAR TARIFAS POR DEPOSITANTE ########################## -->    
    
<div class="row">
  <div class="col-lg-6">
  
  <h4>Editar Tarifa:</h4>
  
  
  <form role="form" class="form-horizontal" method="POST" action="tarifas.php" >
    
    <div class="form-group">
        <label class="col-lg-4">Fecha vigencia:</label>
        <div class="col-lg-4">
            <input name="fecha" class="form-control fecha_form" required="" value="<?php echo $fila['TARI_FECHA']; ?>">
        </div>
    </div> <!-- /.form-group -->
    
    <div class="form-group">
        <label class="col-lg-4">Rango Desde:</label>
        <div class="col-lg-4">
            <input name="desde" class="form-control" value="<?php echo $fila['TARI_DESDE']; ?>">
        </div>
    </div> <!-- /.form-group -->
    
    <div class="form-group">
        <label class="col-lg-4 ">Rango Hasta:</label>
        <div class="col-lg-4">
            <input name="hasta" class="form-control" value="<?php echo $fila['TARI_HASTA']; ?>">
        </div>
    </div> <!-- /.form-group -->
    
    <div class="form-inline form-group">
        <label class="col-lg-4 ">Unidad de tarifa:</label>
        <div class="col-lg-5"> 
            <select name="unidad" class="form-control">
                <option><?php echo $fila['TARI_UNIDAD']; ?></option>
                <option>Dólares</option>
                <option>Pesos</option>
                <option>Toneladas</option>
                <option>Cajas</option>
                <option>Bolsas</option>
            </select>
        </div>

    </div> <!-- /.form-group -->
    
    <div class="form-group">
        <label class="col-lg-4 ">Cargo por Emisión:</label>
        <div class="col-lg-4">
            <input name="emision" class="form-control" required="" placeholder="%" value="<?php echo $fila['TARI_EMISION']; ?>"> 
        </div>
    </div> <!-- /.form-group -->

    <div class="form-group">
        <label class="col-lg-4 ">Cargo por Seguro:</label>
        <div class="col-lg-4">
            <input name="seguro" class="form-control" required="" placeholder="%" value="<?php echo $fila['TARI_SEGURO']; ?>"> 
        </div>
    </div> <!-- /.form-group -->

    <div class="form-group">
        <label class="col-lg-4 ">Otros Cargos:</label>
        <div class="col-lg-4">
            <input name="otros" class="form-control" required="" value="<?php echo $fila['TARI_OTROS']; ?>">
        </div>
    </div> <!-- /.form-group -->

    <div class="form-group">
        <label class="col-lg-4 ">Cargo Mínimo:</label>
        <div class="col-lg-4">
            <input name="min" class="form-control" required="" value="<?php echo $fila['TARI_MIN']; ?>">
        </div>
    </div> <!-- /.form-group -->

    <input type="hidden" name="tari_id" value="<?php echo $tari_id ?>" />
    <input type="hidden" name="depo_id" value="<?php echo $depo_id ?>" />
    <input type="submit" name="submit-edit" class="btn btn-primary" value="Guardar" />
  
  </form>
  
  </div>
  <!-- /.col-lg-6 -->
</div>
<!-- /.row -->