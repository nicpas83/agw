<?php
/** Preparo filtro dinámico según perfil de usuario */

if($_SESSION['perfil'] == "adm" AND !isset($_POST['submit-filtro'])){
    //ADM primer ingreso
    $filtroDinLabel = "Depositante";
    $filtroDinFn= combo_depositantes();
    
}elseif($_SESSION['perfil'] == "adm" AND isset($_POST['submit-filtro'])){
    //ADM ingresando con filtro - pasa su valor seleccionado
    $filtroDinLabel = "Depositante";
    $filtroDinFn= combo_depositantes($_POST['filtroDin']);
}

if($_SESSION['perfil'] == "clie" AND !isset($_POST['submit-filtro'])){
    //CLIE y primer ingreso
    $filtroDinLabel = "Titulos Nro.";
    $filtroDinFn = combo_nro_titulos_cliente($_SESSION['perfil'],$_SESSION['filtroPerfilId']);
    
}elseif($_SESSION['perfil'] == "clie" AND isset($_POST['submit-filtro'])){
    //CLIE ingresando con filtro
    $filtroDinLabel = "Titulos Nro.";
    $filtroDinFn  = combo_nro_titulos_cliente($_SESSION['perfil'],$_SESSION['filtroPerfilId'],$_POST['filtroDin']);
}


if($_SESSION['perfil'] == "seg" AND !isset($_POST['submit-filtro'])){
    //SEG primer ingreso
    $filtroDinLabel = "Depositante";
    $filtroDinFn= combo_depositantes(null,$_SESSION['perfil'],$_SESSION['filtroPerfilId']);
    
}elseif($_SESSION['perfil'] == "seg" AND isset($_POST['submit-filtro'])){
    //SEG ingresando con filtro
    $filtroDinLabel = "Depositante";
    $filtroDinFn= combo_depositantes($_POST['filtroDin'],$_SESSION['perfil'],$_SESSION['filtroPerfilId']);
}


if($_SESSION['perfil'] == "clie1" AND !isset($_POST['submit-filtro'])){
    //CLIE1 primer ingreso
    $filtroDinLabel = "Titulos Nro.";
    $filtroDinFn= combo_nro_titulos_cliente($_SESSION['perfil'],$_SESSION['filtroPerfilId']);
    
}elseif($_SESSION['perfil'] == "clie1" AND isset($_POST['submit-filtro'])){
    //CLIE1 ingresando con filtro
    $filtroDinLabel = "Titulos Nro.";
    $filtroDinFn= combo_nro_titulos_cliente($_SESSION['perfil'],$_SESSION['filtroPerfilId'],$_POST['filtroDin']);
}


if($_SESSION['perfil'] == "clie2" AND !isset($_POST['submit-filtro'])){
    //CLIE2 primer ingreso
    $filtroDinLabel = "";
    $filtroDinFn= "";
    
}elseif($_SESSION['perfil'] == "clie2" AND isset($_POST['submit-filtro'])){
    //CLIE2 ingresando con filtro
    $filtroDinLabel = "";
    $filtroDinFn= "";
}



	
?>



<div class="col-lg-12">

    <div class="panel panel-primary small">
        <div class="panel-heading">
            Filtros del Reporte:
        </div>
        <div class="panel-body">
            
            <div class="row">
            
                <div class="col-lg-10 col-lg-offset-1">
                
                    <form class="form-horizontal" role="form" method="POST" action="reporte_inspecciones.php">
                        
                        <div class="form-group">
                            <label>Fechas:</label>
                            
                            <div>
                            <i class="fa fa-calendar"></i> 
                            <input name="desde" value="<?php if(isset($_POST['submit-filtro'])){echo $desde;} ?>" class="form-control input-sm fecha_filtro" type="text" placeholder="Desde">
                            
                            <i class="fa fa-calendar"></i> 
                            <input name="hasta" value="<?php if(isset($_POST['submit-filtro'])){echo $hasta;} ?>" class="form-control input-sm fecha_filtro" type="text" placeholder="Hasta">
                            </div>
                        </div>
                                                                    
                        <div class="form-group">
                            <label>Planta:</label>
                            <select name="planta" class="form-control input-sm">
                                <option></option>
                                <?php 
                                if(isset($_POST['submit-filtro'])){
                                    echo combo_plantas($_POST['planta'],$_SESSION['filtroPerfilId'],$_SESSION['perfil']);
                                }else{
                                    echo combo_plantas(null,$_SESSION['filtroPerfilId'],$_SESSION['perfil']);
                                }
                                ?>    
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label><?php echo $filtroDinLabel; ?></label>
                            <select name="filtroDin" class="form-control input-sm">
                                <option></option>
                                <?php echo $filtroDinFn; ?>                                
                            </select>
                        </div>
                        
                        <button type="submit" name="submit-filtro" class="btn btn-primary">Aplicar</button>
                        <button type="submit" class="btn btn-default btn-sm">Reset</button>
                    
                    
                    </form>
                
                </div>
                <!-- /.col-lg-10 -->
            
            </div>
            <!-- /.row -->
            
        </div>
        
    </div>
</div>
<!-- /.col-lg-4 -->