<hr />                                
<!-- ### ENDOSO ### -->
<h4 style="text-decoration: underline;">Endoso:</h4>                                     
<div class="form-group">
    <label class="col-lg-3 ">Fecha:</label>
    <div class="col-lg-9">
        <input name="endo_fecha" class="form-control fecha_form" value="<?php echo date("Y-m-d"); ?>">
    </div>
</div> <!-- /.form-group -->

<div class="form-group">
    <label class="col-lg-3 ">Lugar:</label>
    <div class="col-lg-9">
        <input name="endo_lugar" class="form-control" value="<?php echo $_SESSION['depo_domleg']; ?>">
    </div>
</div> <!-- /.form-group -->


<div class="form-group">
    <label class="col-lg-3 ">Tenedor:</label>
    <div class="col-lg-9">
        <p><?php echo $_SESSION['depo_raso']; ?></p>
    </div>
</div> <!-- /.form-group -->

<div class="form-group">
    <label class="col-lg-3 ">Domicilio:</label>
    <div class="col-lg-9">
        <input name="endo_domicilio" class="form-control" value="<?php echo $_SESSION['depo_domleg']; ?>">
    </div>
</div> <!-- /.form-group -->


<!-- ### beneficiario ### -->                                                         
<div class="form-group">
    <label class="col-lg-3 ">Beneficiario:</label>
    <div class="col-lg-9">
        <select name="endo_bene_id" class="form-control" id="emision-plantas">
            <?php echo combo_beneficiarios(); ?>
        </select>
    </div>
</div> <!-- /.form-group -->   


<div class="form-group">
    <label class="col-lg-3 ">Capital:</label>
    <div class="col-lg-9">
        <input name="endo_capital" class="form-control" placeholder="Completar sólo si difiere de Valor Total">
    </div>
</div> <!-- /.form-group -->

<div class="form-group">
    <label class="col-lg-3 ">Interés %:</label>
    <div class="col-lg-9">
        <input name="endo_interes" class="form-control" >
    </div>
</div> <!-- /.form-group -->


<div class="form-group">
    <label class="col-lg-3 ">Vencimiento:</label>
    <div class="col-lg-9">
        <input name="endo_venc" class="form-control" placeholder="Completar sólo si difiere de vencimiento warrant" >
    </div>
</div> <!-- /.form-group -->            