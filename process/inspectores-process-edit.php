<?php
$err = array();
$id_insp = $_GET['edit'];

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


if(empty($err)){
    
    $sql = "UPDATE inspectores SET
        INSP_NOMBRE = '$nombre',
        INSP_APELLIDO = '$apellido',
        INSP_DNI = '$dni',
        INSP_TEL = '$tel',
        INSP_EMAIL = '$email',
        INSP_DOMICILIO = '$domicilio',
        INSP_PROV_ID = '$prov_id',
        INSP_LOCA_ID = '$loca_id',
        INSP_ZONAS = '$string_zonas',
        INSP_ESPECIALIDAD = '$string_especialidad',
        INSP_REFERENCIA = '$referencia',
        INSP_CONOCIMIENTO = '$conocimiento',
        INSP_MOVILIDAD = '$movilidad',
        INSP_HONORARIOS_POR = '$honorarios_por',
        INSP_NRO_POLIZA = '$nro_poliza',
        INSP_VENC_POLIZA = $venc_poliza,
        INSP_DISPONIBILIDAD = '$disponibilidad',
        INSP_CAPACITACION = '$capacitacion'
        WHERE INSP_ID = '$id_insp'";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    if($result){
        echo "<meta http-equiv='refresh' content='0;url=inspectores.php?msg=ok'>";

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }  
    
}

?>