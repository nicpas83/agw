<?php
$err = array();


$raso           =  trim(mysqli_real_escape_string($cnx, $_POST['raso']));
$cuit           =  trim(mysqli_real_escape_string($cnx, $_POST['cuit']));
$domleg         =  trim(mysqli_real_escape_string($cnx, $_POST['domleg']));
$domfis         =  trim(mysqli_real_escape_string($cnx, $_POST['domfis']));
$domcom         =  trim(mysqli_real_escape_string($cnx, $_POST['domcom']));
$prov_id        =  $_POST['prov_id'];
$loca_id        =  $_POST['loca_id'];
$contacto1      =  trim(mysqli_real_escape_string($cnx, $_POST['contacto1']));
$contacto2      =  trim(mysqli_real_escape_string($cnx, $_POST['contacto2']));
$contacto3      =  trim(mysqli_real_escape_string($cnx, $_POST['contacto3']));



//include "validaciones-plantas.php";
/**
 * Validacion que no exista Razon Social y/o CUIT.
 */

$sql = "select * from beneficiarios where BENE_RASO = '$raso' or BENE_CUIT = '$cuit'";
$result = mysqli_query($cnx, $sql);
@$filas = mysqli_num_rows($result);

if($filas > 0){
    $err['existe'] = "<p style='color: red;'>Razón social y/o Nro de CUIT ya existen en tabla beneficiarios. Use el botón 'atrás' de su navegador para corregir.</p>";
        
}


if(empty($err)){
    
    $sql = "INSERT INTO beneficiarios
    (BENE_RASO, BENE_CUIT, BENE_DOMLEG, BENE_DOMFIS, BENE_DOMCOM, BENE_PROV_ID, BENE_LOCA_ID, BENE_CONTACTO1, BENE_CONTACTO2, BENE_CONTACTO3)
    VALUES        
    ('$raso', '$cuit', '$domleg', '$domfis', '$domcom', '$prov_id', '$loca_id', '$contacto1', '$contacto2', '$contacto3')";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

    if($result){
        header("Location: beneficiarios.php?msg=ok");
        

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }
    
}
    

?>