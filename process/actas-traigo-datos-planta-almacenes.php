<?php
  
    
$sql = "select * from plantas
        LEFT JOIN almacenes
        ON PLAN_ID = ALMA_PLAN_ID
        LEFT JOIN provincias
        ON PLAN_PROV_ID = PROV_ID
        LEFT JOIN localidades
        ON PLAN_LOCA_ID = LOCA_ID
        where PLAN_ID = $id_planta_selec";
        
        
$result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));

$cant_almacenes = mysqli_num_rows($result);

$almacenesDePlanta = mysqli_fetch_array($result);

/** hay datos de acá que los paso en campos hidden del formulario */
$nombre_planta = $almacenesDePlanta ['PLAN_NOMBRE'];
$raso_planta = $almacenesDePlanta['PLAN_RASO'];
$domicilio = $almacenesDePlanta['PLAN_DOMICILIO'];
$provincia = $almacenesDePlanta['PROV_NOMBRE'];
$localidad = $almacenesDePlanta['LOCA_NOMBRE'];
$responsable = $almacenesDePlanta['PLAN_RESPONSABLE'];





/**  traigo las cantidades y almacenes de la última acta. 
Si no tiene, el formulario debe estar en blanco para cargar.  */


$ultima_acta = "SELECT *, (AAQX_QX_INICIALES + AAQX_QX_RECIBIDAS - AAQX_QX_LIBERADAS) AS CANT_INICIAL
                from actas 
                INNER JOIN actas_almacenes_qx on AAQX_ACTA_NRO = ACTA_NRO
                INNER JOIN almacenes on AAQX_ALMA_ID = ALMA_ID
                INNER JOIN productos ON AAQX_PRODUCTO_ID = PROD_ID
                where ACTA_NRO = (SELECT ACTA_NRO FROM actas 
                WHERE ACTA_PLANTA_ID = $id_planta_selec
                ORDER BY ACTA_FECHA DESC
                LIMIT 1)";

$cons_ult_acta = mysqli_query($cnx,$ultima_acta);

$cant_almacenes_ult_acta = mysqli_num_rows($cons_ult_acta);

$msg_almacenes_acta = "viendo $cant_almacenes_ult_acta de $cant_almacenes";
 


?>