<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>

<?php
    /** Actualizar TC */
    if(isset($_POST['tc-grabar']) AND is_numeric($_POST['tc_hoy'])){
        tc_new($_POST['tc_hoy']);
        echo "<meta http-equiv='refresh' content='0;url=facturacion.php'>";
        exit();
    }
    
    /** Grabar factura */
    if(isset($_POST['submit-new'])){
        include "process/facturacion-process-new.php";
    }
    
	$menu_open = "adm"; 
    $title = "Facturación";
    $depo_id = null;
    $err = "";
    $leyenda = "";
    $tarifas = array('unidad' => "",'cliente' => "", 'cant_vigente' => 0,'emision' => "", 'seguro' => "", 'minimo' => 0);  
    $desde = "";
    $hasta = "";
    $totales = "";
    $detalles = "";
    $dif_por_minimo = 0;
    $unidad = "";
    $vigente = 0;
    $tar_emision = 0;
    $tar_seguro = 0;
    $minimo = 0;
    $total_emision = 0;
    $total_seguro= 0;
    $subtotal = 0;
    $total = 0;
    $dif_por_minimoARS =  0;
    $dif_por_minimoUSD = 0;
    $dif_total_porcentaje = "";
    $tc = tc();
    $tc_hoy = $tc['tc'];
    $tc_hasta = null; //es el tc más cercano a la fecha "hasta".
    $moneda = "";
    $detalle_pivot = null;
    $estado = null;  // facturado/pendiente
    
    //totalizadores 
    $emisionARS = 0;
    $seguroARS = 0;
    $subtotalARS = 0;
    $totalARS = 0;
 
    $emisionUSD = 0;
    $seguroUSD = 0;
    $subtotalUSD = 0;
    $totalUSD = 0;
 
    
//var_dump($_SESSION['desde']); exit();    

//$detalle_pivot = facturacion_niveles('2017-02-1', '2017-02-28', 2, 5);
//var_dump($detalle_pivot); exit();


?>

<?php include "includes/header.php" ?>
<?php include "includes/sidebar.php" ?>

<?php  

if(isset($_GET['msg']) and $_GET['msg'] == 'ok'){
    include "includes/msg-datos-almacenados-ok.php";         
}


/** Vista Totales de facturacion por cliente. */
if(!isset($_POST['depo_id'])){
    
    if(isset($_POST['submit-filtro']) OR (isset($_SESSION['desde']) AND $_SESSION['desde'] <> "")){
     
        if(isset($_POST['submit-filtro'])){
            $desde = $_POST['desde'];
            $hasta = $_POST['hasta'];    
        }
        
        if(isset($_SESSION['desde']) AND $_SESSION['desde'] <> ""){
            
            $desde = $_SESSION['desde'];
            $hasta = $_SESSION['hasta'];
            
            //limpio
            $_SESSION['desde'] = "";
            $_SESSION['hasta'] = "";  
        }
          
        //validar fechas: hasta debe ser mayor
        if($desde > $hasta){
            
            $err = "Rango de fechas incorrecto.";
            
        }else{
            //Tabla Facturación Total. Agrupa por Depositante. 
            //No Considera si en la tarifa existe minimo. Eso se verá al acceder al detalle.
            $totales = facturacion_tabla_total_por_cliente($desde, $hasta);
            $leyenda = "*A efectos de definir los cargos a aplicar, se consideran los valores vigentes al cierre del mes.</span>";
            $tc_hasta = tc_busca_tc_historico($hasta); //es el tc más cercano a la fecha "hasta".
            $estado = facturacion_buscar_fc_periodo_depositante($desde,$hasta);
            //var_dump($estado); exit();                                          
        }
    }
    
    include "includes/facturacion-totales.php";
}


/** Vista a nivel depositante, totales x planta y  detalle warrants */
if(isset($_POST['depo_id']) AND isset($_POST['desde']) and isset($_POST['hasta'])){
    
    //var_dump($_POST['depo_id']);exit();
    
    $depo_id = $_POST['depo_id'];
    $depo_raso = $_POST['depo_raso'];
    $desde = $_POST['desde'];
    $hasta = $_POST['hasta'];
    
    //devuelve $result.
    $detalle_pivot = facturacion_tabla_detalle_cliente($depo_id, $desde, $hasta);
    $detalles = facturacion_tabla_detalle_cliente_warrants($depo_id,$desde, $hasta);
    $tc_hasta = tc_busca_tc_historico($hasta); //es el tc más cercano a la fecha "hasta".
    $ult_fc = facturacion_buscar_ultima_factura();
    $estado = facturacion_buscar_fc_periodo_depositante($desde,$hasta);
    
    include "includes/facturacion-detalle.php";
    
}
      
?>


<?php include "includes/footer.php"; ?>