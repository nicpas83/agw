<?php

/**
 * Traigo datos de la tarifa a editar
 */

$sql = "select * from tarifas where TARI_ID = $tari_id";

$result = mysqli_query($cnx,$sql);

$fila = mysqli_fetch_array($result);
 




?>