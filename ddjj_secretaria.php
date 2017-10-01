<?php
include "includes/init.php";
verificar_sesion();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php
$title = "Reporte para SAGPyA";
$menu_open = "ddjj";
$msg = "";    // el mensaje se ejecuta junto a la llamada de la función.

/** Valido tipo de usuario para configurar filtros del Reporte */
//si es primer ingreso 

$vigentes_US = "";
$vigentes_AR = "";
$emitidos_US = "";
$emitidos_AR = "";


if (isset($_POST['submit-filtro'])) {

    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];

    $vigentes_US = tabla_reporte_secretaria_vigentes($desde, $hasta, 'USD');
    $vigentes_AR = tabla_reporte_secretaria_vigentes($desde, $hasta, 'Pesos');
    $emitidos_US = tabla_reporte_secretaria_emitidos($desde, $hasta, 'USD');
    $emitidos_AR = tabla_reporte_secretaria_emitidos($desde, $hasta, 'Pesos');
}
?>
<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Reporte para SAGPyA</h2>
            </div>
            <!-- /.col-lg-12 -->

        </div>
        <!-- /.row -->

        <div class="row">

            <div class="col-lg-10">

                <form class="form-inline" role="form" method="POST" action="ddjj_secretaria.php">

                    <div class="form-group">

                        <label><i class="fa fa-calendar"></i></label> 
                        <input name="desde" value="<?php if (isset($_POST['submit-filtro'])) {
    echo $desde;
} ?>" class="form-control fecha_filtro" type="text" placeholder="Desde">
                    </div>

                    <div class="form-group">
                        <label><i class="fa fa-calendar"></i></label> 
                        <input name="hasta" value="<?php if (isset($_POST['submit-filtro'])) {
    echo $hasta;
} ?>" class="form-control fecha_filtro" type="text" placeholder="Hasta">
                    </div>

                    <button type="submit" name="submit-filtro" class="btn btn-primary">Aplicar</button>

                </form>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->

        <br />
        <div class="row">
            <h4>Vigentes en Dólares</h4>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">          
                <div class="table-responsive">
                    <table id="reporte-secretaria1" class="table table-striped table-bordered" >
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>CD&W</th>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Valor W</th>
                                <th>Moneda</th>
                                <th>Emision</th>
                                <th>Vencimiento</th>
                                <th>Dirección de la operación</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>Fin o Uso</th>
                            </tr>
                        </thead>
                        <tbody>
<?php echo $vigentes_US; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
        </div>

        <br />
        <div class="row">
            <div class="col-lg-12">
                <h4>Vigentes en Pesos</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="reporte-secretaria2">
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>CD&W</th>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Valor W</th>
                                <th>Moneda</th>
                                <th>Emision</th>
                                <th>Vencimiento</th>
                                <th>Dirección de la operación</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>Fin o Uso</th>
                            </tr>
                        </thead>
                        <tbody>
<?php echo $vigentes_AR; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->

        </div>
        <!-- /.row -->


        <br />
        <div class="row">
            <div class="col-lg-12">
                <h4>Emitidos en Dólares</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="reporte-secretaria3">
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>CD&W</th>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Valor W</th>
                                <th>Moneda</th>
                                <th>Emision</th>
                                <th>Vencimiento</th>
                                <th>Dirección de la operación</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>Fin o Uso</th>
                            </tr>
                        </thead>
                        <tbody>
<?php echo $emitidos_US; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->

        </div>
        <!-- /.row -->


        <br />
        <div class="row">
            <div class="col-lg-12">
                <h4>Emitidos en Pesos</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="reporte-secretaria4">
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>CD&W</th>
                                <th>Producto</th>
                                <th>Unidad</th>
                                <th>Cantidad</th>
                                <th>Valor W</th>
                                <th>Moneda</th>
                                <th>Emision</th>
                                <th>Vencimiento</th>
                                <th>Dirección de la operación</th>
                                <th>Localidad</th>
                                <th>Provincia</th>
                                <th>Fin o Uso</th>
                            </tr>
                        </thead>
                        <tbody>
<?php echo $emitidos_AR; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.col-lg-12 -->

        </div>
        <!-- /.row -->








    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>