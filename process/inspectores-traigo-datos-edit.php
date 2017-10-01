<?php

$id_insp = $_GET['edit'];

$sql = "SELECT * FROM inspectores WHERE INSP_ID = $id_insp";
$result = mysqli_query($cnx, $sql);
$fila = mysqli_fetch_array($result);

$prov_id = $fila['INSP_PROV_ID']; 
$loca_id = $fila['INSP_LOCA_ID'];





/**
 * Busco en las Zonas y Especialidades seleccionados para generar
 *  el o los option "selected" correspondientes.
 */

$option_zonas = option_select_explode_id('-',$fila['INSP_ZONAS'],'provincias','PROV_ID','PROV_NOMBRE');
$option_esp = option_select_explode_id('-',$fila['INSP_ESPECIALIDAD'],'productos','PROD_ID','PROD_NOMBRE');



?>