<?php
$id_planta = $_GET['id'];

$sql_plan = "SELECT * FROM plantas WHERE PLAN_ID = $id_planta";
$sql_al = "SELECT * FROM almacenes WHERE ALMA_PLAN_ID = $id_planta";

$result_plan = mysqli_query($cnx, $sql_plan);
$fila_plan = mysqli_fetch_array($result_plan);

$result_al = mysqli_query($cnx, $sql_al);
$fila_al = mysqli_fetch_array($result_al);

/**
 * Si hay provincia y localidad, ejecuto consulta INNER JOIN. 
 * MySQL no acepta FULL OUTER JOIN, por eso parto la query en 2. 
 */

if(!empty($fila_plan['PLAN_PROV_ID'])){
    
    $sql_inner = "SELECT PROV_NOMBRE, LOCA_NOMBRE FROM plantas
                    INNER JOIN provincias
                    ON PLAN_PROV_ID = PROV_ID
                    INNER JOIN localidades
                    ON PLAN_LOCA_ID = LOCA_ID
                    WHERE PLAN_ID = $id_planta";
    
    $result = mysqli_query($cnx, $sql_inner);
    $datos_inner = mysqli_fetch_array($result);
    // preparo datos para mostrar en los value=""
    $provincia  = $datos_inner['PROV_NOMBRE'];
    $localidad  = $datos_inner['LOCA_NOMBRE'];

}else{
    $provincia  = "";
    $localidad  = "";
}        



/**
 * IMAGENES
 */

$imagenes = array();
$img_links = "";
$img_input = "";

//rutas
if($fila_plan['PLAN_FOTO1'] <> ""){array_push($imagenes,$fila_plan['PLAN_FOTO1']);}
if($fila_plan['PLAN_FOTO2'] <> ""){array_push($imagenes,$fila_plan['PLAN_FOTO2']);}
if($fila_plan['PLAN_FOTO3'] <> ""){array_push($imagenes,$fila_plan['PLAN_FOTO3']);}

$cant_img = count($imagenes);

if($cant_img > 0){
    
    foreach($imagenes as $clave=>$imagen){
        
        $nro = $clave+1;
        $img_links .= "<a href='".$imagen."' target='_blank'>Ver imágen ".$nro."</a><br/>";
        
        
    }
    
}



/**
 * 
 */




?>