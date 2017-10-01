<?php
$err = array();


$nombre = mysqli_real_escape_string($cnx,$_POST['nombre']);
$apellido = mysqli_real_escape_string($cnx,$_POST['apellido']);
$dni = mysqli_real_escape_string($cnx,$_POST['dni']);
$tel = mysqli_real_escape_string($cnx,$_POST['tel']);
$email = mysqli_real_escape_string($cnx,$_POST['email']);
$prov_id = $_POST['prov_id'];
@$loca_id = $_POST['loca_id'];
$domicilio = mysqli_real_escape_string($cnx,$_POST['domicilio']);

@$array_zonas = $_POST['zonas'];
@$array_especialidad = $_POST['especialidad'];

$referencia = mysqli_real_escape_string($cnx,$_POST['referencia']);
$conocimiento = $_POST['conocimiento'];
$movilidad = $_POST['movilidad'];
$honorarios_por = $_POST['honorarios_por'];
$nro_poliza = mysqli_real_escape_string($cnx,$_POST['nro_poliza']);
$venc_poliza = mysqli_real_escape_string($cnx,$_POST['venc_poliza']);          //fecha
$disponibilidad = mysqli_real_escape_string($cnx,$_POST['disponibilidad']);
$capacitacion = $_POST['capacitacion'];



/*
var_dump($_FILES);
exit;
*/

/**
 * Validacion fechas para variable en $sql
 */
if($venc_poliza == ""){
    $venc_poliza = 'null';
}else{
    $venc_poliza = "'".$venc_poliza."'";
}

/** 
 * preparo array zonas en $zonas_mult
 */


$string_zonas = "";

for($i=0;$i<count($array_zonas);$i++){
    
    if($i==0){
        $string_zonas .= "".$array_zonas[$i]."";
    }else{
        $string_zonas .= "-".$array_zonas[$i]."";
    }
    
}

/** 
 * preparo array especialidad en $especialidad_mult
 */


$string_especialidad = "";

for($i=0; $i<count($array_especialidad);$i++){
    
    if($i==0){
        $string_especialidad .= "".$array_especialidad[$i]."";    
    }else{
        $string_especialidad .= "-".$array_especialidad[$i]."";    
    }
    
}


/**
 * Validacion que no exista NOMBRE Planta.
 */

$sql = "select * from inspectores where INSP_APELLIDO = '$apellido'";
$result = mysqli_query($cnx, $sql);
$filas = mysqli_num_rows($result);

if($filas > 0){
    $err['apellido'] = "<p style='color: red;'>ya existe en la base de datos. Use el botón 'atrás' de su navegador para corregir.</p>";
}

if(empty($err)){
    
    $sql = "INSERT INTO inspectores
        (INSP_NOMBRE,INSP_APELLIDO,INSP_DNI,INSP_TEL
        ,INSP_EMAIL,INSP_DOMICILIO,INSP_PROV_ID,INSP_LOCA_ID,INSP_ZONAS
        ,INSP_ESPECIALIDAD,INSP_REFERENCIA,INSP_CONOCIMIENTO,INSP_MOVILIDAD
        ,INSP_HONORARIOS_POR,INSP_NRO_POLIZA,INSP_VENC_POLIZA,INSP_DISPONIBILIDAD
        ,INSP_CAPACITACION)
        VALUES        
        ('$nombre','$apellido','$dni','$tel','$email','$domicilio','$prov_id'
        ,'$loca_id','$string_zonas','$string_especialidad','$referencia'
        ,'$conocimiento','$movilidad','$honorarios_por','$nro_poliza',$venc_poliza,'$disponibilidad'
        ,'$capacitacion')";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    if($result){
        echo "<meta http-equiv='refresh' content='0;url=inspectores.php?msg=ok'>";

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }  
    
}

?>