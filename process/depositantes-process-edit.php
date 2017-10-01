<?php
$err = array();
$depo_id = $_POST['depo_id'];


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



if(empty($err)){
    
    $sql = "UPDATE depositantes
            SET
            DEPO_RASO = '$raso', 
            DEPO_CUIT = '$cuit', 
            DEPO_DOMLEG = '$domleg', 
            DEPO_DOMFIS = '$domfis', 
            DEPO_DOMCOM = '$domcom', 
            DEPO_PROV_ID = '$prov_id', 
            DEPO_LOCA_ID = '$loca_id', 
            DEPO_CONTACTO1 = '$contacto1', 
            DEPO_CONTACTO2 = '$contacto2', 
            DEPO_CONTACTO3 = '$contacto3'
            WHERE DEPO_ID = $depo_id ";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

    if($result){
        header("Location: depositantes.php?msg=ok");
        

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }
    
}
    

?>