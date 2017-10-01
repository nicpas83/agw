<div class="row">
  <div class="col-lg-6">
  
  <h4>1. Seleccionar Depositante</h4>
  
  <form role="form" class="form-horizontal" method="GET" action="tarifas.php" >
  
    <div class="form-group">
      <div class="col-lg-6">
        <select class="form-control" name="depo"  onchange="this.form.submit()">
            <option></option>
            <?php echo combo_depositantes(); ?>
        </select>
      </div>
    </div>

  </form>
  
  </div>
  <!-- /.col-lg-6 -->
</div>
<!-- /.row -->