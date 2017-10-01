<?php
$id_planta = trim(mysqli_real_escape_string($cnx, $_GET['edit']));

$sql = "SELECT * FROM plantas WHERE PLAN_ID = $id_planta";
$result = mysqli_query($cnx, $sql);
$fila = mysqli_fetch_array($result);

$prov_select_id = $fila['PLAN_PROV_ID']; 
$loca_select_id = $fila['PLAN_LOCA_ID'];
$provincia = "";
    

/**
 * Si hay provincia y localidad, ejecuto consulta INNER JOIN. 
 * MySQL no acepta FULL OUTER JOIN, por eso parto la query en 2. 
 */
/*
if($prov_select_id <> ""){
    
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
}
*/
/**
 * Busco en los Beneficiarios seleccionados para generar el o los option "selected" correspondientes.
 */

$option_benef = "";

if(!empty($fila['PLAN_BENEF_TODOS'])){
    
    //vuelvo a crear array a partir del string almacenado en base.
    $benef_id_array = explode('-',$fila['PLAN_BENEF_TODOS']);
    
    //traigo todos los beneficiarios para luego comparar con el array.
    $sql = "SELECT * FROM beneficiarios";
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($beneficiarios = mysqli_fetch_array($result)){
        
        //si está dentro del array, lo agrego como option selected
        if(in_array($beneficiarios['BENE_ID'],$benef_id_array)){
            
            $option_benef .= "<option selected='selected' value='".$beneficiarios['BENE_ID']."'>".$beneficiarios['BENE_RASO']."</option>";    
        
        }else{
            
            $option_benef .= "<option value='".$beneficiarios['BENE_ID']."'>".$beneficiarios['BENE_RASO']."</option>";            
            
        }
     
    }
        
}else{
    //si no hay ninguno seleccionado, muestro el combo original.
    $option_benef = combo_beneficiarios();
    
}


/**
 * IMAGENES
 */

$imagenes = array();
$img_links = "";

//rutas
if($fila['PLAN_FOTO1'] <> ""){array_push($imagenes,$fila['PLAN_FOTO1']);}
if($fila['PLAN_FOTO2'] <> ""){array_push($imagenes,$fila['PLAN_FOTO2']);}
if($fila['PLAN_FOTO3'] <> ""){array_push($imagenes,$fila['PLAN_FOTO3']);}

$cant_img = count($imagenes);

if($cant_img > 0){
    
    foreach($imagenes as $clave=>$imagen){
        
        $nro = $clave+1;
        $img_links .= "<a href='".$imagen."' target='_blank'>Ver imágen ".$nro."</a></br>";
        
        
    }
    
}


?>