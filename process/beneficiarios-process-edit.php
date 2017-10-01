<?php
$err = array();
$bene_id = $_POST['bene_id'];   //viene por input hidden


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
    
    $sql = "UPDATE beneficiarios
            SET
            BENE_RASO = '$raso', 
            BENE_CUIT = '$cuit', 
            BENE_DOMLEG = '$domleg', 
            BENE_DOMFIS = '$domfis', 
            BENE_DOMCOM = '$domcom', 
            BENE_PROV_ID = '$prov_id', 
            BENE_LOCA_ID = '$loca_id', 
            BENE_CONTACTO1 = '$contacto1', 
            BENE_CONTACTO2 = '$contacto2', 
            BENE_CONTACTO3 = '$contacto3'
            WHERE BENE_ID = $bene_id ";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));

    if($result){
        header("Location: beneficiarios.php?msg=ok");
        

    }else{
        echo "ocurrió un error durante el registro: ".mysqli_error($cnx)."";
    }
    
}
    

?>