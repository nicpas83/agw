<?php
$err = array();


$raso           =  trim(mysqli_real_escape_string($cnx, $_POST['raso']));
$nombre         =  trim(mysqli_real_escape_string($cnx, $_POST['nombre']));
$responsable    =  trim(mysqli_real_escape_string($cnx, $_POST['responsable']));
$tel1           =  trim(mysqli_real_escape_string($cnx, $_POST['tel1']));
$tel2           =  trim(mysqli_real_escape_string($cnx, $_POST['tel2']));
$propde         =  trim(mysqli_real_escape_string($cnx, $_POST['propde']));
$venc_alq       =  trim(mysqli_real_escape_string($cnx, $_POST['venc_alq'])); //fecha
$venc_com       =  trim(mysqli_real_escape_string($cnx, $_POST['venc_com'])); //fecha
$prov_id        =  $_POST['prov_id'];
$loca_id        =  $_POST['loca_id'];
$domicilio      =  trim(mysqli_real_escape_string($cnx, $_POST['domicilio']));
$zona           =  $_POST['zona'];
$almacenaje     =  trim(mysqli_real_escape_string($cnx, $_POST['almacenaje']));
$cap_carga_diaria =  trim(mysqli_real_escape_string($cnx, $_POST['cap_carga_diaria']));
$cumple_cond    =  $_POST['cumple_cond'];
$estado_gral    =  $_POST['estado_gral'];
$comentarios    =  trim(mysqli_real_escape_string($cnx, $_POST['comentarios']));
$dist_pto       =  trim(mysqli_real_escape_string($cnx, $_POST['dist_pto']));
$benef_todos    = $_POST['benef_todos'];
$nro_poliza     =  trim(mysqli_real_escape_string($cnx, $_POST['nro_poliza']));
$venc_poliza    =  trim(mysqli_real_escape_string($cnx, $_POST['venc_poliza']));  //fecha
$geo            =  trim(mysqli_real_escape_string($cnx, $_POST['geo']));



/**
 * Valida fechas para variable $sql
 */

if($venc_alq == ""){
    $venc_alq = 'null';
}else{
    $venc_alq = "'".$venc_alq."'";
}

if($venc_com == ""){
    $venc_com = 'null';
}else{
    $venc_com = "'".$venc_com."'";
}

if($venc_poliza == ""){
    $venc_poliza = 'null';
}else{
    $venc_poliza = "'".$venc_poliza."'";
}

/** preparo array BENEFICIARIOS*/

$benef_mult = "";

for($i=0;$i<count($benef_todos);$i++){
    
    if($i==0){
        $benef_mult .= "".$benef_todos[$i]."";
    }else{
        $benef_mult .= "-".$benef_todos[$i]."";
    }
}

//include "validaciones-plantas.php";
/**
 * Validacion que no exista NOMBRE Planta.
 */

$sql = "select * from plantas where PLAN_NOMBRE = '$nombre'";
$result = mysqli_query($cnx, $sql);
$filas = mysqli_num_rows($result);

if($filas > 0){
    $err['nombre'] = "<p style='color: red;'>El nombre ya existe en la base de datos. Use el botón 'atrás' de su navegador para corregir.</p>";
}


if(empty($err)){
    
    $sql = "INSERT INTO plantas
    (PLAN_RASO,PLAN_NOMBRE,PLAN_RESPONSABLE,PLAN_TEL1,PLAN_TEL2,PLAN_PROPDE,PLAN_VENC_ALQ
    ,PLAN_VENC_COM,PLAN_PROV_ID,PLAN_LOCA_ID,PLAN_DOMICILIO,PLAN_ZONA,PLAN_ALMACENAJE
    ,PLAN_CAP_CARGA_DIARIA,PLAN_CUMPLE_COND,PLAN_ESTADO_GRAL,PLAN_COMENTARIOS,PLAN_DIST_PTO
    ,PLAN_BENEF_TODOS,PLAN_NRO_POLIZA,PLAN_VENC_POLIZA,PLAN_GEO,PLAN_STATE)
    VALUES        
    ('$raso','$nombre','$responsable','$tel1','$tel2','$propde',$venc_alq,$venc_com,'$prov_id','$loca_id'
    ,'$domicilio','$zona','$almacenaje','$cap_carga_diaria','$cumple_cond','$estado_gral','$comentarios','$dist_pto'
    ,'$benef_mult','$nro_poliza',$venc_poliza,'$geo','A')";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

    if($result){
        echo "<meta http-equiv='refresh' content='0;url=plantas.php?msg=ok'>";

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }
    
}
    

?>