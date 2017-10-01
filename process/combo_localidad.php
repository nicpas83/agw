<?php require_once "../includes/conexion.php" ;?>

<?php
/**
 * Devuelvo lista ciudades en html
 */

$prov_id = $_GET['id'];

if($prov_id != "" ){
    
    $sql = "SELECT * FROM localidades WHERE LOCA_PROV_ID = $prov_id";
    $result = mysqli_query($cnx, $sql);
    
     
     $respuesta = "";
     
    while($localidades = mysqli_fetch_array($result)){
        
        //Vamos concatenando a la respuesta cada opcion
        $respuesta .= "<option value ='".$localidades['LOCA_ID']."'>".$localidades['LOCA_NOMBRE']."</option>";

    }
    

echo $respuesta;

}

?>