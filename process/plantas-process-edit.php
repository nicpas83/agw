<?php
$id_planta = $_GET['edit'];
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
 * Validacion fechas para variable en $sql
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


/**
 * Valido que al actualizar no se ponga un nombre de planta existente
 */

$sql = "select * from plantas where PLAN_NOMBRE = '$nombre' AND PLAN_ID <> $id_planta";
$result = mysqli_query($cnx, $sql);
$filas = mysqli_num_rows($result);

if($filas > 0){
    $err['nombre'] = "<p style='color: red;'>El nombre ya existe en la base de datos. Use el botón 'atrás' de su navegador para corregir.</p>";
}


if(empty($err)){
    
    $sql = "UPDATE plantas SET
        PLAN_RASO = '$raso',
        PLAN_NOMBRE = '$nombre',
        PLAN_RESPONSABLE = '$responsable',
        PLAN_TEL1 = '$tel1',
        PLAN_TEL2 = '$tel2',
        PLAN_PROPDE = '$propde',
        PLAN_VENC_ALQ = $venc_alq,
        PLAN_VENC_COM = $venc_com,
        PLAN_PROV_ID = '$prov_id',
        PLAN_LOCA_ID = '$loca_id',
        PLAN_DOMICILIO = '$domicilio',
        PLAN_ZONA = '$zona',
        PLAN_ALMACENAJE = '$almacenaje',
        PLAN_CAP_CARGA_DIARIA = '$cap_carga_diaria',
        PLAN_CUMPLE_COND = '$cumple_cond',
        PLAN_ESTADO_GRAL = '$estado_gral',
        PLAN_COMENTARIOS = '$comentarios',
        PLAN_DIST_PTO = '$dist_pto',
        PLAN_BENEF_TODOS = '$benef_mult',
        PLAN_NRO_POLIZA = '$nro_poliza',
        PLAN_VENC_POLIZA = $venc_poliza,
        PLAN_GEO = '$geo'    
        WHERE PLAN_ID = '$id_planta'";
        
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

    if($result){
        echo "<meta http-equiv='refresh' content='0;url=plantas.php?msg=ok'>";
        
    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }
}


?>