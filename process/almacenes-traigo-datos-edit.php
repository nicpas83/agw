<?php

if(isset($_GET['edit'])){
    
    $sql = "select * from almacenes where ALMA_ID = $alma_id";

    $result = mysqli_query($cnx,$sql);
    $fila = mysqli_fetch_array($result);
 
    $aforoNum = explode(".",$fila['ALMA_AFORO_TEC']);
}


?>