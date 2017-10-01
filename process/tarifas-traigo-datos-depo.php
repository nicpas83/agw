<?php

/**
 * Traigo datos del depositante seleccionado
 */

if(isset($_GET['depo'])){
    
    $id = $_GET['depo'];
    $sql = "select depositantes.DEPO_RASO, tarifas.* 
            from depositantes LEFT OUTER JOIN tarifas
            ON depositantes.DEPO_ID = tarifas.TARI_DEPO_ID
            where depositantes.DEPO_ID = '$id'";

    $result = mysqli_query($cnx,$sql);
    $fila = mysqli_fetch_array($result);
 
}



?>