<?php include "includes/init.php"; 
verificar_sesion();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>


<?php 

$title = "Reporte de inspecciones"; 



//si es primer ingreso 
if(!isset($_POST['submit-filtro'])){
    
    $reporteInspeccionesResumen = tabla_reporte_inspecciones_resumen($_SESSION['perfil'],$_SESSION['filtroPerfilId']);

    $reporteInspecciones = tabla_reporte_inspecciones($_SESSION['perfil'],$_SESSION['filtroPerfilId']);


}else{

    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    $planta = $_POST['planta'];
    
    $filtroDin = $_POST['filtroDin']; //id  (value)
    
    $reporteInspeccionesResumen = tabla_reporte_inspecciones_resumen($_SESSION['perfil'],$_SESSION['filtroPerfilId'],$desde,$hasta,$planta,$filtroDin);
    $reporteInspecciones = tabla_reporte_inspecciones($_SESSION['perfil'],$_SESSION['filtroPerfilId'],$desde,$hasta,$planta,$filtroDin);
    
}


?>



<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">

<!-- 
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Reporte de Inspecciones</h2>
                <?php 
                if(isset($_SESSION['perfil']) AND $_SESSION['perfil'] == "adm"){
                ?>    
                <h4>Alertas:</h4>
                <ul>
                    <?php //echo alerta_inspecciones(); ?>
                </ul>    
                    
                <?php
                }
                ?>
                
                
            </div>
            
        </div>
        
 -->

        <br />
        <div class="row">
            <div class="col-lg-12">
                <h4>Posición a la fecha:</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="reporte-inspeccionesResumen-dataTable">
                        <thead class="panel-primary small">
                            <tr class="panel-heading">
                                <th>Última Inspección</th>
                                <th>Días hasta hoy</th>
                                <th>Planta Razón Social</th>
                                <th>Planta Nombre Interno</th>
                                <th>Producto</th>
                                <th>Cant. Verificada</th>
                                <th>Cant. Warrants a Hoy</th>
                                <th>Stock libre disp.</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                            <?php  echo $reporteInspeccionesResumen; ?>
                           
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
        
            </div>
        </div>

<br />        

<?php 
if(isset($_SESSION['perfil']) AND ($_SESSION['perfil'] == "adm" OR $_SESSION['perfil'] == "seg")){
?>         
        <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                    <h4>Trazabilidad de Inspecciones:</h4>
                        <table class="table table-striped table-bordered table-hover" id="reporte-inspecciones-dataTable">
                            <thead class="panel-primary small">
                                <tr class="panel-heading">
                                    <th>Depositante</th>
                                    <th>Fecha</th>
                                    <th>Planta</th>
                                    <th>Nombre Planta</th>
                                    <th>Localidad</th>
                                    <th>Tipo de Inspección</th>
                                    <th>N° de Acta</th>
                                    <th>Inspector</th>
                                    <th>Producto</th>
                                    <th>Unidad</th>
                                    <th>Cantidad Verificada</th>
                                    <th>Cantidad Warrant</th>
                                    <th>Stock libre disp.</th>
                                    <th>Listado de Warrants asociados</th>

                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php  echo $reporteInspecciones; ?>
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        
<?php
}
?>   

    
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>
