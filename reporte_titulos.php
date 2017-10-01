<?php include "includes/init.php"; 
verificar_sesion();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>

<?php 
$title = "Reporte de títulos"; 
$msg = "";    // el mensaje se ejecuta junto a la llamada de la función.

/** Valido tipo de usuario para configurar filtros del Reporte*/
    
//si es primer ingreso 
if(!isset($_POST['submit-filtro'])){
    $ver = "V"; //titulos vigentes
    $reporteTitulos = tabla_reporte_titulos($_SESSION['perfil'],$_SESSION['filtroPerfilId'],$ver);

}else{

    $ver = $_POST['ver'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    $filtroDin = $_POST['filtroDin']; //id  (value) O STRING plan_raso

    $reporteTitulos = tabla_reporte_titulos($_SESSION['perfil'],$_SESSION['filtroPerfilId'],$ver,$desde,$hasta,$filtroDin);

    //Mensaje para filtro: "Vigentes con rango de fechas".
    if($ver == "V" AND !empty($desde) AND !empty($hasta)){
        $msg = "<p><strong>Atención:</strong> El siguiente reporte arroja como resultado los warrants vigentes a una fecha dada, 
        definida por el usuario. Si desea incluir los warrants liberados y vigentes durante un rango de fechas, seleccione la opción “Todos”.</p><br />";  
                 
    }
    
}

?>


<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">       
        
        <div class="row">
            <div class="col-lg-12">
                <h4 class="page-header">Reporte de Títulos:</h4>
            </div>
            <div class="col-lg-9"><?php if($msg <> ""){echo $msg;} ?></div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.col-lg-12 -->
        <div class="row">
                <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered" id="reporte-titulos-dataTable">
                                    <thead class="panel-primary small">
                                        <tr class="panel-heading">
                                            <th>Nro.</th>
                                            <th>Estado</th>
                                            <th>Planta_Razón_Social</th>
                                            <th>Depositante</th>
                                            <th>Fecha_Emision</th>
                                            <th>Plazo</th>
                                            <th>Vencimiento</th>
                                            <th>Liberación</th>
                                            <th>Producto</th>
                                            <th>Unidad</th>
                                            <th>Cantidad</th>
                                            <th>Moneda</th>
                                            <th>P.Unitario</th>
                                            <th>Monto</th>
                                            <th>Inspecciones</th>
                                            <th>Nombre Planta</th>
                                            <th>Domicilio</th>
                                            <th>Localidad</th>
                                            <th>Provincia</th>
                                            <th>Cia. de Seguro</th>
                                            <th>Vto. TRO</th>
                                            <th>Tipo de W</th>
                                            <th>Beneficiario</th>
                                            <th>Identificacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php 
                                        //es la función resultante según perfil de usuario.
                                        echo $reporteTitulos;

                                        ?>
  
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