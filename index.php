<?php include "includes/init.php"; ?>
<?php include "includes/header.php"; ?>


<?php 
if(isset($_GET['msg'])){

    if($_GET['msg'] == "err"){
        include "includes/msg-error-login.php";    
    }
    
    if($_GET['msg'] == "log"){
        include "includes/msg-error-sesion.php";
    }
    
    if($_GET['msg'] == 'ok'){
        include "includes/msg-datos-almacenados-ok.php";
         
    }
    
}     

?>


<!-- Page Content -->
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Bienvenido</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.row -->
        
        
<?php 
if(!isset($_SESSION['usuario'])){
    include "includes/index-login.php";    
} 
?>        
        
        
        
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->

<?php include "includes/footer.php" ?>