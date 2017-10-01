<?php require_once "../includes/conexion.php" ;?>

<?php
/**
 * Devuelvo lista plantas en html (las asociadas a la Razón Social elegida.)
 */

$raso = $_GET['raso'];

if($raso != "" ){
    
    $sql = "SELECT PLAN_NOMBRE FROM plantas WHERE PLAN_RASO like '$raso'";
    $result = mysqli_query($cnx, $sql);
    
    $respuesta = "";
     
    while($fila = mysqli_fetch_array($result)){
        
        //Vamos concatenando a la respuesta cada opcion
        $respuesta .= "<option>".$fila['PLAN_NOMBRE']."</option>";

    }
    

echo $respuesta;

}

?>