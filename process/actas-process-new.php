<?php
$err = array();
//capturo campos hidden
$iteracion = $_POST['iteracion'];  //   es igual a la cantidad de filas a insertar en tabla almacenesQX


/** Tabla Actas*/
$acta_nro = trim(mysqli_real_escape_string($cnx, $_POST['acta_nro']));
$acta_fecha = trim(mysqli_real_escape_string($cnx, $_POST['acta_fecha']));
$acta_motivo = $_POST['motivo'];
$acta_raso = trim(mysqli_real_escape_string($cnx, $_POST['acta_raso']));
$acta_planta_id = $_POST['acta_planta_id'];
$acta_muestras = $_POST['acta_muestras'];
$acta_tyh = $_POST['acta_tyh'];
$acta_cond_com = $_POST['acta_cond_com'];
$acta_precintos = $_POST['acta_precintos'];
$acta_carteles = $_POST['acta_carteles'];
$acta_responsable = $_POST['acta_responsable'];
$acta_firmante = trim(mysqli_real_escape_string($cnx, $_POST['acta_firmante']));
$acta_inspector_id = $_POST['acta_inspector_id'];
$acta_coment = trim(mysqli_real_escape_string($cnx, $_POST['acta_coment']));
//$acta_imagen = $_FILES['acta_imagen'];


//esto es para evitar que se guarde 0000-00-00
if($acta_fecha == ""){
    $acta_fecha = 'null';
}else{
    $acta_fecha = "'".$acta_fecha."'";
}

// si hay foto nueva:
if(!empty($acta_imagen['tmp_name'])){
    
    //incluyo clase que maneja upload 
    include 'class/class.upload.php';

    $handle = new upload($_FILES['acta_imagen']);
    if ($handle->uploaded) {
        
        $handle->image_resize         = true;
        $handle->image_x              = 1200;
        $handle->image_ratio_y        = true;
        $handle->image_convert        = 'jpg';
        $handle->jpeg_quality         = 80;
        $handle->file_overwrite       = true;          
        $handle->file_new_name_body   = $acta_planta_id."_".$acta_nro;   //tomo el nombre de usuario
        
        $handle->process('img/actas/');
      
        if ($handle->processed) {
            
            //preparo ruta para sql.
            $ruta_acta_img = "img/actas/".$acta_planta_id."_".$acta_nro.".jpg";
            
            //limpio temporal
            $handle->clean();
              
        }else{
            $errores['imagen'] = $handle->error;
        }
            
    }
    
}else{

    //si no hay imagen nueva:
    $ruta_acta_img = "";
}


$sql = "insert into actas
        (ACTA_NRO, ACTA_FECHA, ACTA_MOTIVO, ACTA_RASO, ACTA_PLANTA_ID, ACTA_MUESTRAS, ACTA_TYH
        ,ACTA_COND_COM, ACTA_PRECINTOS, ACTA_CARTELES, ACTA_RESPONSABLE, ACTA_FIRMANTE, ACTA_INSPECTOR_ID
        ,ACTA_COMENT, ACTA_IMAGEN)
        values
        ($acta_nro, $acta_fecha, '$acta_motivo', '$acta_raso', '$acta_planta_id', '$acta_muestras'
        ,'$acta_tyh', '$acta_cond_com', '$acta_precintos', '$acta_carteles', '$acta_responsable'
        ,'$acta_firmante', '$acta_inspector_id', '$acta_coment', '$ruta_acta_img')";

$result1 = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

if(!$result1){
    echo mysqli_error($cnx);
    exit();
}

/** Tabla Movimiento Stock*/

for($i=1; $i<$iteracion; $i++){
    
    //compruebo que la fila esté completa
    if(!empty($_POST["aaqx_alma_id_".$i.""])){
        
        $aaqx_acta_nro       = $acta_nro;
        $aaqx_alma_id        = $_POST["aaqx_alma_id_".$i.""];
        $aaqx_producto_id    = $_POST["aaqx_producto_id_".$i.""];
        $aaqx_unidad         = $_POST["aaqx_unidad_".$i.""];
        $aaqx_qx_iniciales   = trim(mysqli_real_escape_string($cnx, $_POST["aaqx_qx_iniciales_".$i.""]));
        
        //estas dos podrian ser null según motivo inspeccion
        $aaqx_qx_recibidas   = trim(mysqli_real_escape_string($cnx, $_POST["aaqx_qx_recibidas_".$i.""]));
        $aaqx_qx_liberadas   = trim(mysqli_real_escape_string($cnx, $_POST["aaqx_qx_liberadas_".$i.""]));
        

        $aaqx_qx_iniciales = str_replace(",",".",$aaqx_qx_iniciales);
        $aaqx_qx_recibidas = str_replace(",",".",$aaqx_qx_recibidas);
        $aaqx_qx_liberadas = str_replace(",",".",$aaqx_qx_liberadas);
        
        
        
        if(empty($aaqx_qx_iniciales)){
            $aaqx_qx_iniciales = 0;
        }
        if(empty($aaqx_qx_recibidas)){
            $aaqx_qx_recibidas = 0;
        }
        if(empty($aaqx_qx_liberadas)){
            $aaqx_qx_liberadas = 0;
        }
      
        
        
              
        $sql = "insert into actas_almacenes_qx 
                (AAQX_ACTA_NRO, AAQX_ALMA_ID, AAQX_PRODUCTO_ID, AAQX_UNIDAD, AAQX_QX_INICIALES
                ,AAQX_QX_RECIBIDAS, AAQX_QX_LIBERADAS)
                VALUES
                ($aaqx_acta_nro, $aaqx_alma_id, $aaqx_producto_id, '$aaqx_unidad', '$aaqx_qx_iniciales'
                , '$aaqx_qx_recibidas' , '$aaqx_qx_liberadas')
                ";     
    
        $result2 = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
        
            
        }
    
    
    
}



if($result1 AND $result2){
    echo "<meta http-equiv='refresh' content='0;url=actas.php?msg=ok'>";

}else{
    echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
}





?>