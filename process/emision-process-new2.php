<?php
include "lib/numeros_a_letras.php";

$err = array();

/** preparo variables que surgen del PASO 1/2 */
$wcd_nr             = $_SESSION['wcd_nr'];
$tipo_w             = $_SESSION['tw'];
$operacion          = $_POST['operacion'];
$renovado           = trim(mysqli_real_escape_string($cnx, $_POST['renovado']));
$fecha_emision      = trim(mysqli_real_escape_string($cnx, $_POST['fecha_emision']));
$plazovenc          = trim(mysqli_real_escape_string($cnx, $_POST['plazovenc']));
$estado             = "V";  //sale como VIGENTE
$plan_id            = $_SESSION['planta'];

$vendedor           = trim(mysqli_real_escape_string($cnx, $_POST['vendedor']));
$depo_id            = $_SESSION['depositante'];

/** preparo variables que surgen del PASO 2/2 */
$producto           = $_POST['producto'];
$identificacion     = trim(mysqli_real_escape_string($cnx, $_POST['identificacion']));
$calidad            = trim(mysqli_real_escape_string($cnx, $_POST['calidad']));
$unidad             = $_POST['unidad'];
$moneda             = $_POST['moneda'];
$cantidad           = trim(mysqli_real_escape_string($cnx, $_POST['cantidad']));
$precio_u           = trim(mysqli_real_escape_string($cnx, $_POST['precio_u']));
$valor_w            = $cantidad * $precio_u;
$observaciones      = trim(mysqli_real_escape_string($cnx, $_POST['observaciones']));
$poliza_nro           = $_SESSION['poliza'];

if(empty($_POST['poliza_valor'])){
    $poliza_valor = $valor_w;    
}else{
    $poliza_valor = trim(mysqli_real_escape_string($cnx, $_POST['poliza_valor']));
}




/** definir el PLAZO y VENCIMIENTO 
*   si la variable es un número entero es porque el usuario ingresó el pazo en DIAS. 
*   Sino, debería tener un formato fecha Y-m-d.
*/
if(is_numeric($plazovenc)){
    $plazo = $plazovenc;
    $venc = date('Y-m-d',strtotime("+$plazo days", strtotime($fecha_emision)));
    
}else{
    $venc = $plazovenc; 
    
    if(datecheck($venc,$format="ymd") === false){
        $err['plazovenc'] = "el formato de Fecha Vencimiento es inválido";
    }else{
        $plazo = strtotime($venc) - strtotime($fecha_emision);
        $plazo = $plazo / 86400;  // divido por los segundos que tiene un día (86400)    
    }
}


/** CARGOS - TARIFAS */

$cargos_emi         = (($valor_w * $_SESSION['tari_emision'] / 100) * $plazo) / 180;
$cargos_seg         = (($valor_w * $_SESSION['tari_seguro'] / 100) * $plazo) / 180;
$cargos_otros       = (($valor_w * $_SESSION['tari_otros'] / 100) * $plazo) / 180;
$cargos_total       = $cargos_emi + $cargos_seg + $cargos_otros;




/** Si hay endoso... */
if($_SESSION['tw'] == "CMA"){
    
    $endo_fecha = trim(mysqli_real_escape_string($cnx, $_POST['endo_fecha']));
    $endo_lugar = trim(mysqli_real_escape_string($cnx, $_POST['endo_lugar']));
    $endo_tenedor = $_SESSION['depo_raso'];
    $endo_dom = trim(mysqli_real_escape_string($cnx, $_POST['endo_domicilio']));
    $endo_bene_id = $_POST['endo_bene_id'];
    
    if(!empty($_POST['endo_capital'])){
        $endo_capital = trim(mysqli_real_escape_string($cnx, $_POST['endo_capital']));
    }else{
        $endo_capital = $valor_w;
    }

    $endo_capital_string = numtoletras($endo_capital);
        
    
    $endo_interes = trim(mysqli_real_escape_string($cnx, $_POST['endo_interes']));
    $endo_total = ($valor_w * $endo_interes * $plazo / 360) + $valor_w;
   
    
    if(!empty($_POST['endo_venc'])){
        
        $endo_venc = trim(mysqli_real_escape_string($cnx, $_POST['endo_venc']));
        
    }else{
        $endo_venc = $venc;
    }

}


/** INSERT completa con endoso */
if(empty($err)){

    if($_SESSION['tw'] == "CMA"){
        
        $sql = "INSERT INTO titulos
                (TITU_WCD_NR, TITU_TIPO_W, TITU_OPERACION, TITU_RENOVADO, TITU_FECHA_EMISION, TITU_PLAZO, TITU_VENC,
                TITU_ESTADO, TITU_PLANTA_ID, TITU_VENDEDOR, TITU_DEPO_ID, TITU_PRODUCTO, TITU_IDENTIFICACION, TITU_CALIDAD,
                TITU_UNIDAD, TITU_MONEDA, TITU_CANTIDAD, TITU_PRECIO_U, TITU_VALOR_W, TITU_OBSERVACIONES, TITU_POLIZA_NRO,
                TITU_POLIZA_VALOR, TITU_CARGOS_EMI, TITU_CARGOS_SEG, TITU_CARGOS_OTROS, TITU_CARGOS_TOTAL, TITU_ENDO_FECHA,
                TITU_ENDO_LUGAR, TITU_ENDO_TENEDOR, TITU_ENDO_DOM, TITU_ENDO_BENE_ID, TITU_ENDO_CAPITAL, TITU_ENDO_CAPITAL_STRING,
                TITU_ENDO_INTERES, TITU_ENDO_TOTAL, TITU_ENDO_VENC)
                values
                ('$wcd_nr', '$tipo_w', '$operacion', '$renovado', '$fecha_emision', '$plazo', '$venc', '$estado', '$plan_id'
                ,'$vendedor', '$depo_id', '$producto', '$identificacion', '$calidad', '$unidad', '$moneda', '$cantidad', '$precio_u'
                ,'$valor_w', '$observaciones', '$poliza_nro', '$poliza_valor', '$cargos_emi', '$cargos_seg', '$cargos_otros'
                ,'$cargos_total', '$endo_fecha', '$endo_lugar', '$endo_tenedor', '$endo_dom', '$endo_bene_id', '$endo_capital'
                ,'$endo_capital_string', '$endo_interes', '$endo_total', '$endo_venc')
                ";

    }else{
            
        $sql = "INSERT INTO titulos
                (TITU_WCD_NR, TITU_TIPO_W, TITU_OPERACION, TITU_RENOVADO, TITU_FECHA_EMISION, TITU_PLAZO, TITU_VENC,
                TITU_ESTADO, TITU_PLANTA_ID, TITU_VENDEDOR, TITU_DEPO_ID, TITU_PRODUCTO, TITU_IDENTIFICACION, TITU_CALIDAD,
                TITU_UNIDAD, TITU_MONEDA, TITU_CANTIDAD, TITU_PRECIO_U, TITU_VALOR_W, TITU_OBSERVACIONES, TITU_POLIZA_NRO,
                TITU_POLIZA_VALOR, TITU_CARGOS_EMI, TITU_CARGOS_SEG, TITU_CARGOS_OTROS, TITU_CARGOS_TOTAL)
                values
                ('$wcd_nr', '$tipo_w', '$operacion', '$renovado', '$fecha_emision', '$plazo', '$venc', '$estado', '$plan_id'
                ,'$vendedor', '$depo_id', '$producto', '$identificacion', '$calidad', '$unidad', '$moneda', '$cantidad', '$precio_u'
                ,'$valor_w', '$observaciones', '$poliza_nro', '$poliza_valor', '$cargos_emi', '$cargos_seg', '$cargos_otros'
                ,'$cargos_total')
                ";            
            
    }
        
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    if($result){
        header("Location:emision.php?msg=ok");
    }   
    
    
}
?>