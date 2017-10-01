<?php
$err = array();
$id = $_POST['poli_id'];   //viene por input hidden


$raso           =  trim(mysqli_real_escape_string($cnx, $_POST['raso']));
$cuit           =  trim(mysqli_real_escape_string($cnx, $_POST['cuit']));
$domleg         =  trim(mysqli_real_escape_string($cnx, $_POST['domleg']));
$domfis         =  trim(mysqli_real_escape_string($cnx, $_POST['domfis']));
$prov_id        =  $_POST['prov_id'];
$loca_id        =  $_POST['loca_id'];
$cobertura      =  trim(mysqli_real_escape_string($cnx, $_POST['cobertura']));
$poliza_nro     =  trim(mysqli_real_escape_string($cnx, $_POST['poliza_nro']));
$venc           =  trim(mysqli_real_escape_string($cnx, $_POST['venc']));
$propia         = $_POST['propia'];


if(empty($err)){
    
    $sql = "UPDATE polizas
            SET
            POLI_RASO = '$raso', 
            POLI_CUIT = '$cuit', 
            POLI_DOMLEG = '$domleg', 
            POLI_DOMFIS = '$domfis', 
            POLI_PROV_ID = '$prov_id', 
            POLI_LOCA_ID = '$loca_id', 
            POLI_COBERTURA = '$cobertura',
            POLI_POLIZA_NRO = '$poliza_nro', 
            POLI_VENC = '$venc',
            POLI_PROPIA = '$propia'
            WHERE POLI_ID = $id";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

    if($result){
        header("Location: polizas.php?msg=ok");
        

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }
    
}
    

?>