<?php 

require("constantes.php");

$cnx = mysqli_connect(SERVER, USERNAME, PASSWORD);

if(!$cnx)
{
	die("No se pudo conectar a la base de datos" .mysqli_error() );
}

/* cambiar el conjunto de caracteres a utf8 */
mysqli_set_charset($cnx, "utf8");

$bd_seleccionada = mysqli_select_db($cnx, NAME);

if(!$bd_seleccionada)
{
	die("No se pudo seleccionar a la base de datos" .mysqli_error() );
}

?>