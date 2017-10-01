<?php
session_start();

unset($_SESSION['usuario']);
unset($_SESSION['nombre']);
unset($_SESSION['perfil']);
unset($_SESSION['filtroPerfilId']);

session_destroy();
    
    echo "<meta http-equiv='refresh' content='0;url=../index.php'>";


?>