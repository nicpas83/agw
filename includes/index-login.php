<!-- FORMULARIO LOGIN -->
<div class="row">
  <div class="col-lg-4">
  
    <form role="form" class="form-horizontal" method="POST" action="process/index-process-login.php">
    
        <div class="form-group">
            <label class="col-lg-4">usuario:</label>
            <div class="col-lg-8">
                <input class="form-control" type="text" name="usuario" required="" />
            </div>
        </div> <!-- /.form-group -->
        
        <div class="form-group">
            <label class="col-lg-4">contraseña:</label>
            <div class="col-lg-8">
                <input class="form-control" type="password" name="password" required="" />
            </div>
        </div> <!-- /.form-group -->                    
            
        <div class="col-lg-3">
            <button name="submit-login" type="submit" class="btn btn-primary">Ingresar</button>
        </div>

    </form>
    
  </div>
</div>
<!-- /.row -->