<!DOCTYPE html>
<html lang="es">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

<link rel="icon" type="image/png" href="img/favicon.ico" />

    <title>AG Warrants - <?php echo $title ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    
    <!-- MetisMenu CSS -->
    <link href="css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <!-- DataTables CSS -->
     <link rel="stylesheet" type="text/css" href="js/plugins/DataTables/jquery.dataTables.css">
     <link rel="stylesheet" type="text/css" href="js/plugins/DataTables/dataTables.bootstrap.css">
     <link rel="stylesheet" type="text/css" href="js/plugins/DataTables/buttons.dataTables.min.css">

    <!-- Datepicker CSS -->
    <link href="css/plugins/datepicker.css" rel="stylesheet">

     <!-- Bootstrap Select-Master CSS -->
    <link href="js/plugins/select-master/css/bootstrap-select.css" rel="stylesheet">




    
    <!-- prevenir enter -->
    <script language=javascript type=text/javascript>
    function stopRKey(evt) {
    var evt = (evt) ? evt : ((event) ? event : null);
    var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
    if ((evt.keyCode == 13) && (node.type=="text")) {return false;}
    }
    document.onkeypress = stopRKey; 
    </script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>



<?php
$open_adm = "";
$open_gral = "";
$open_ddjj = "";

if(isset($menu_open) AND $menu_open === "adm"){
    $open_adm = "collapse in";
}

if(isset($menu_open) AND $menu_open === "gral"){
    $open_gral = "collapse in";
}

if(isset($menu_open) AND $menu_open === "ddjj"){
    $open_ddjj = "collapse in";
}

	
?>

<body>

    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="index.php" style="margin-left: 15px; padding: 15px;"><img  src="img/logo_up.png" alt="logo" height="45" /></a>
            </div>
            
            <!-- /.navbar-header -->

<?php 

if(isset($_SESSION['usuario']) AND !empty($_SESSION['usuario'])){
   
?>
            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Bienvenido <?php echo $_SESSION['nombre']; ?>
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        -->
                        <li><a href="process/index-process-logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->


<!-- ##################################################################################################### -->
<!-- SIDEBAR -->
            <div class="navbar-default sidebar" role="navigation" >
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
<?php if(isset($_SESSION['perfil']) AND $_SESSION['perfil'] == "adm"){ ?>
    

<!-- Administración -->
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Administración<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level <?php echo $open_adm ?>">
                                <li>
                                    <a href="emision.php"><i class="fa fa-print fa-fw"></i> Emisión de Títulos</a>
                                </li>
                                <li>
                                    <a href="estado_titulos.php"><i class="fa fa-refresh fa-fw"></i> Estado de Títulos</a>
                                </li>
                                <li>
                                    <a href="actas.php"><i class="fa fa-edit fa-fw"></i> Actas de Inspección</a>
                                </li>
                                <li>
                                    <a href="facturacion.php"><i class="fa fa-money fa-fw"></i> Facturación</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

<!-- General -->
                        <li>
                            <a href="#"><i class="fa fa-gear"></i> General<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level <?php echo $open_gral ?>">
                                <li>
                                    <a href="plantas.php"><i class="fa fa-cubes"></i> Plantas</a>
                                </li>
                                    
                                <li>
                                    <a href="inspectores.php"><i class="fa fa-users"></i> Inspectores</a>
                                </li>
                                
                                <li>
                                    <a href="depositantes.php"><i class="fa fa-suitcase"></i> Depositantes</a>
                                </li>
                                
                                <li>
                                    <a href="beneficiarios.php"><i class="fa fa-file-text-o"></i> Beneficiarios</a>
                                </li>
                                
                                <li>
                                    <a href="polizas.php"><i class="fa fa-bank"></i> Pólizas</a>
                                </li>
                                
                                <li>
                                    <a href="facturas.php"><i class="fa fa-folder-open-o"></i> Facturas</a>
                                </li>

                            </ul>
                            <!-- /.nav-second-level -->
                        </li>

<!-- DDJJ -->                        
                        <li>
                            <a href="#"><i class="fa fa-file-excel-o"></i> DDJJ<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level <?php echo $open_ddjj ?>">
                            
                                <li>
                                    <a href="ddjj_seguro.php">Seguro</a>
                                </li>
                                
                                <li>
                                    <a href="ddjj_secretaria.php">SAGPyA</a>
                                </li>
                                
                            </ul>
                        </li>                       
                        
                        
<?php } ?>

<!-- Reportes -->
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o"></i> Reportes<span class="fa arrow"></span></a>
                        
                            <ul class="nav nav-second-level collapse in">
                                <li>
                                    <a href="reporte_titulos.php">Títulos</a>
                                </li>
                                
                                <?php if(isset($_SESSION['perfil']) AND $_SESSION['perfil'] !== "clie2"){ ?>
                                <li>
                                    <a href="reporte_inspecciones.php">Inspecciones</a>
                                </li>
                                <?php } ?>
                                
                                <?php if(isset($_SESSION['perfil']) AND $_SESSION['perfil'] == "adm"){ ?>
                                
                                <li>
                                    <a href="reporte_almacenes.php">Almacenes</a>
                                </li>
                                <li>
                                    <a href="reporte_vencimientos.php">Vencimientos</a>
                                </li>
                                
                                <?php } ?>
                            </ul>
                            <!-- /.nav-second-level -->    
                        
                        </li>

                        
                    </ul>
                    
                    
                    <br />
                    
                    <?php 
                    
                    if(isset($title) AND $title === "Reporte de títulos"){
                        
                        include "includes/reporte_titulos-filtros.php";
                    }
                    
                    if(isset($title) AND $title === "DDJJ Seguro"){
                        
                        include "includes/ddjj_seguro-filtros.php";
                    }
                    
                    if(isset($title) AND $title === "Reporte de inspecciones"){
                        include "includes/reporte_inspecciones-filtros.php";
                    }
                    
                    
                    
                    ?>
                    
                    
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
<?php
}

?>
            
            
        </nav>