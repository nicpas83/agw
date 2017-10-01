<div class="row">
    <div class="col-lg-12">
        <h3 class="page-header">Almacenes</h3>
        <p><a href="plantas.php">Plantas</a> > Almacenes</p>
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- /.row -->


<div class="row">
  <div class="col-lg-6">
  
  <h4>1. Seleccionar Planta</h4>
  
  <form role="form" class="form-horizontal" method="GET" action="almacenes.php" >
  
    <div class="form-group">
      <div class="col-lg-6">
        <select class="form-control" name="plan"  onchange="this.form.submit()">
            <option></option>
            <?php echo combo_plantas_nombre(); ?>
        </select>
      </div>
    </div>

  </form>
  
  </div>
  <!-- /.col-lg-6 -->
</div>
<!-- /.row -->