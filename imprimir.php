<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php include "includes/functions.php"; ?>
<?php include "lib/numeros_a_letras.php"; ?>

<?php
	 
$titulo = $_POST['titulo'];

$sql = "select * 
        from titulos 
        inner join (select 
						DEPO_ID,
                        DEPO_RASO,
                        DEPO_CUIT,
                        DEPO_CONTACTO1,
    					DEPO_DOMLEG,
                        LOCA_NOMBRE AS DEPO_LOCA,
    					PROV_NOMBRE AS DEPO_PROV

                    from depositantes 
    					INNER JOIN provincias ON DEPO_PROV_ID = PROV_ID
    					INNER JOIN localidades ON DEPO_LOCA_ID = LOCA_ID
					) d
			ON TITU_DEPO_ID = DEPO_ID

        left outer join vendedor ON TITU_VENDEDOR = VEND_ID
        inner join (select 
                        PLAN_ID,
                        PLAN_RASO,
                        PLAN_NOMBRE,
                        PLAN_DOMICILIO,
                        LOCA_NOMBRE AS PLAN_LOCA,
    					PROV_NOMBRE AS PLAN_PROV

                    from plantas
                        INNER JOIN provincias ON PLAN_PROV_ID = PROV_ID
        				INNER JOIN localidades ON PLAN_LOCA_ID = LOCA_ID
                    ) p ON TITU_PLANTA_ID = PLAN_ID
        
        inner join (SELECT 
						POLI_RASO,
						POLI_POLIZA_NRO,
						POLI_COBERTURA,
						POLI_VENC,
						POLI_DOMLEG,
						PROV_NOMBRE AS POLI_PROV,
						LOCA_NOMBRE AS POLI_LOCA
					FROM polizas 
					INNER JOIN provincias ON POLI_PROV_ID = PROV_ID 
					INNER JOIN localidades ON POLI_LOCA_ID = LOCA_ID
					) t
			ON TITU_POLIZA_NRO = POLI_POLIZA_NRO 

        WHERE TITU_WCD_NR = $titulo";

$result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
$fila = mysqli_fetch_array($result);

if($fila['VEND_NOMBRE'] <> ''){
    $vendedor = $fila['VEND_NOMBRE'];
}else{
    $vendedor = $fila['PLAN_RASO'];
}


$cantidad = number_format($fila['TITU_CANTIDAD'],2,',','.');
$precio_u = number_format($fila['TITU_PRECIO_U'],2,',','.');
$total = number_format($fila['TITU_PRECIO_U']*$fila['TITU_CANTIDAD'],2,',','.');

$cargos_emi = number_format($fila['TITU_CARGOS_EMI'],2,',','.');
$cargos_seg = number_format($fila['TITU_CARGOS_SEG'],2,',','.');
$cargos_otros = number_format($fila['TITU_CARGOS_OTROS'],2,',','.');
$cargos_total = number_format($fila['TITU_CARGOS_EMI']+$fila['TITU_CARGOS_SEG']+$fila['TITU_CARGOS_OTROS'],2,',','.');

$poli_venc = date('d-m-Y', strtotime($fila['POLI_VENC']));
$fecha_emision = date('d-m-Y', strtotime($fila['TITU_FECHA_EMISION']));
$plazo = $fila['TITU_PLAZO'];
$plazovenc = date('d-m-Y', strtotime($fila['TITU_VENC']));


?>

<!DOCTYPE HTML>
<html>
<head>

    <meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html" />
	<meta name="author" content="gencyolcu" />

	<title>Impresión de títulos</title>

    <link href="css/imprimir.css" rel="stylesheet" type="text/css" />
    
    
</head>

<body>

<!-- ################################## CERTIFICADO DE DEPOSITO ################################################# -->

<div id="pagina">


    <div id="cabecera">
        <p class="p1">Ley 9643</p>
        <p id="CD" class="p2">CERTIFICADO DE DEPOSITO <span>Nro. <?php echo $titulo; ?></span></p>
        <p class="p3">AG Warrants S.A. Tte. Gral. J. D. Perón 315 Piso 1º A, (C1038AAG) C.A.B.A, Argentina. C.U.I.T. 30-71132029-2</p>
    </div>
    
    
    
    <div id="cuerpo1">
    
        <p>Certifica que: <span id="depositante"><?php echo $fila['DEPO_RASO']; ?></span>  <span id="cuit">C.U.I.T.: <?php echo $fila['DEPO_CUIT']; ?></span></p>
        <p><span>Con domicilio en: <?php echo $fila['DEPO_DOMLEG']; ?>, <?php echo $fila['DEPO_LOCA']; ?>, <?php echo $fila['DEPO_PROV']; ?> </span> <span id="telefono">Telefono: <?php echo $fila['DEPO_CONTACTO1']?></span></p>
        <p class="p3"><span>Ha depositado en nuestro almacen No.: <?php echo $fila['PLAN_NOMBRE']; ?> Ubicado en: <?php echo "".$fila['PLAN_DOMICILIO'].", ".$fila['PLAN_LOCA'].", ".$fila['PLAN_PROV'].". (".$vendedor.")"; ?></p>
    
    </div>
    
    
    <div id="tabla1">
    
        <table>
        
            <thead>
                <tr>
                    <th>TIPO DE PRODUCTO</th>
                    <th>CALIDAD</th>
                    <th>UNIDAD</th>
                    <th>CANTIDAD</th>
                    <th>VALOR UNITARIO</th>
                    <th>VALOR TOTAL</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td><?php echo $fila['TITU_PRODUCTO'];?></td>
                    <td><?php echo $fila['TITU_CALIDAD'];?></td>
                    <td><?php echo $fila['TITU_UNIDAD'];?></td>
                    <td><?php echo $cantidad;?></td>
                    <td>$<?php echo $precio_u;?> <?php echo $fila['TITU_MONEDA'];?></td>
                    <td>$<?php echo $total;?> <?php echo $fila['TITU_MONEDA'];?></td>
                </tr>
                
            </tbody>
            
        </table>
    
        <p class="p1">COMENTARIOS: <?php echo $fila['TITU_OBSERVACIONES'];?></p>
        <p class="p2">VALOR TOTAL DE LAS MERCADERIAS A LA EMISIÓN: <span id="totalLetras"><?php echo numtoletras($fila['TITU_PRECIO_U']*$fila['TITU_CANTIDAD']);?> <?php echo $fila['TITU_MONEDA'];?></span></p>
        
    </div>
    
    <div><!-- contenedor -->
    <div class="col-3-1">
    
        <table>
        
            <thead>
                <tr>
                    <th colspan="4">Seguros de las Mercaderías</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>Cobertura:</td>
                    <td colspan="3"><?php echo $fila['POLI_COBERTURA'];?></td>
                    
                </tr>
                <tr>
                    <td>Cía. de Seg:</td>
                    <td colspan="3"><?php echo $fila['POLI_RASO'];?></td>
                    
                </tr>
                <tr>
                    <td>Domicilio:</td>
                    <td colspan="3"><?php echo $fila['POLI_DOMLEG'];?>, <?php echo $fila['POLI_LOCA'];?>, <?php echo $fila['POLI_PROV'];?></td>
                </tr>
                <tr>
                    <td>Póliza Nro.:</td>
                    <td class="no-borde"><?php echo $fila['POLI_POLIZA_NRO'];?></td>
                    <td class="no-borde">Valor en: $<?php echo number_format($fila['TITU_POLIZA_VALOR'],2,',','.');?> USD</td>
                    <td class="no-borde">Vencimiento: <?php echo $poli_venc;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3"></td>
                </tr>
                
            </tbody>
        
        </table>
        <p id="leyenda">No se entregarán los efectos depositados a la presentación del respectivo Certificado de Depósito, sin estar acompañados del
    warrant correspondiente y arribos con endoso en forma si se hubieren negociado.</p>
        
    
    </div>
    
    <div class="col-3-2">
        <p id="leyenda">Los cargos aquí expresados deberán ser pagados contra la emisión de este certificado. En caso de remate, AG Warrants S.A. deducirá de la venta de las mercaderías todo lo adeudado hasta la entrega a su comprador. </p>
    </div>
    
    
    <div class="col-3-3">
    
        <table>
        
            <thead>
                <tr>
                    <th colspan="4">Las mercaderías adeudan:</th>
                </tr>
                <tr>
                    <th>Concepto</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>EMISION:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_emi; ?></td>
                    
                </tr>
                <tr>
                    <td>SEGURO:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_seg;?></td>
                </tr>
                
                <tr>
                    <td>OTROS CARGOS:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_otros;?></td>
                </tr>
                
                <tr>
                    <td>TOTAL:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_total;?></td>
                </tr>
                
            </tbody>    
        </table>
        
        <p id="leyenda">Todos los intervinientes en este certificado autorizan a AG Warrants S.A., a realizar todos los actos e incurrir en todos los gastos que fueran necesarios para asegurar el mantenimiento  de la calidad y cantidad de la mercadería. Todos los gastos que ello demande serán reembolsados a AG Warrants S.A. a su reclamo, y por su pago AG Warrants S.A. gozará de privilegio sobre el producido de la mercadería.</p>
    
    </div>
    </div><!-- /contenedor -->
    
    
    <div id="pie1">
    
        <p class="p1">Este documento está sujeto a las condiciones de emisión y a las normas de la Ley 9643 y su decreto reglamentario.</p>
        <p>Lugar y Fecha de Emisión: Buenos Aires, Argentina <?php echo $fecha_emision;?>; El deposito se efectúa por <?php echo $plazo;?> dias a contar desde la emisión de este documento. Vencimiento: <?php echo $plazovenc;?></p>
    
    </div>
    
    
    <div id="pie2">
        <p class="p1">DEPOSITANTE (Firma y Sello)</p>
        <p class="p2">Aclaración de la Firma y No. de Documento de Identidad.</p>
        
        <p id="leyenda">Declaración Jurada: El Depositante declara bajo juramento: Que es propietario de las mercaderías depositadas según este certificado y que
        las mismas son de libre disponibilidad sin que existan gravámenes, embargos, inhibiciones o impedimento alguno para su comercializacion. 2
        - Que rigen las condiciones impresas en este Certificado y todo lo establecido por la ley No. 9643, sus reglamentaciones y modificaciones. 3-
        Que a todo efecto derivado del presente serán válidas todas las notificaciones recibidas en el domicilio especial constituido.
        </p>
    </div>
    
    
    
    <div id="pie3">
    
        <p class="p1">AG WARRANTS S. A. (firma y sello)</p>
        
        <table>
            <thead>
                <tr>
                    <th colspan="3">Registro de la Operación</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>Libro: </td>
                    <td>Folio: </td>
                    <td>Posición: </td>
                </tr>
            </tbody>
        </table>    
    </div>
</div>


<div style="page-break-after:always"></div>

<!-- ################################## WARRANT ################################################# -->
<div id="pagina">


    <div id="cabecera">
        <p class="p1">Ley 9643</p>
        <p id="WA" class="p2">WARRANT <span>Nro. <?php echo $titulo; ?></span></p>
        <p class="p3">AG Warrants S.A. Tte. Gral. J. D. Perón 315 Piso 1º A, (C1038AAG) C.A.B.A, Argentina. C.U.I.T. 30-71132029-2</p>
    </div>
    
    
    
    <div id="cuerpo1">
    
        <p>Certifica que: <span id="depositante"><?php echo $fila['DEPO_RASO']; ?></span>  <span id="cuit">C.U.I.T.: <?php echo $fila['DEPO_CUIT']; ?></span></p>
        <p><span>Con domicilio en: <?php echo $fila['DEPO_DOMLEG']; ?>, <?php echo $fila['DEPO_LOCA']; ?>, <?php echo $fila['DEPO_PROV']; ?> </span> <span id="telefono">Telefono: <?php echo $fila['DEPO_CONTACTO1']?></span></p>
        <p class="p3"><span>Ha depositado en nuestro almacen No.: <?php echo $fila['PLAN_NOMBRE']; ?> Ubicado en: <?php echo "".$fila['PLAN_DOMICILIO'].", ".$fila['PLAN_LOCA'].", ".$fila['PLAN_PROV'].". (".$vendedor.")"; ?></p>
    
    </div>
    
    
    <div id="tabla1">
    
        <table>
        
            <thead>
                <tr>
                    <th>TIPO DE PRODUCTO</th>
                    <th>CALIDAD</th>
                    <th>UNIDAD</th>
                    <th>CANTIDAD</th>
                    <th>VALOR UNITARIO</th>
                    <th>VALOR TOTAL</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td><?php echo $fila['TITU_PRODUCTO'];?></td>
                    <td><?php echo $fila['TITU_CALIDAD'];?></td>
                    <td><?php echo $fila['TITU_UNIDAD'];?></td>
                    <td><?php echo $cantidad;?></td>
                    <td>$<?php echo $precio_u;?> <?php echo $fila['TITU_MONEDA'];?></td>
                    <td>$<?php echo $total;?> <?php echo $fila['TITU_MONEDA'];?></td>
                </tr>
                
            </tbody>
            
        </table>
    
        <p class="p1">COMENTARIOS: <?php echo $fila['TITU_OBSERVACIONES'];?></p>
        <p class="p2">VALOR TOTAL DE LAS MERCADERIAS A LA EMISIÓN: <span id="totalLetras"><?php echo numtoletras($fila['TITU_PRECIO_U']*$fila['TITU_CANTIDAD']);?> <?php echo $fila['TITU_MONEDA'];?></span></p>
        
    </div>
    
    <div><!-- contenedor -->
    <div class="col-3-1">
    
        <table>
        
            <thead>
                <tr>
                    <th colspan="4">Seguros de las Mercaderías</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>Cobertura:</td>
                    <td colspan="3"><?php echo $fila['POLI_COBERTURA'];?></td>
                    
                </tr>
                <tr>
                    <td>Cía. de Seg:</td>
                    <td colspan="3"><?php echo $fila['POLI_RASO'];?></td>
                    
                </tr>
                <tr>
                    <td>Domicilio:</td>
                    <td colspan="3"><?php echo $fila['POLI_DOMLEG'];?>, <?php echo $fila['POLI_LOCA'];?>, <?php echo $fila['POLI_PROV'];?></td>
                </tr>
                <tr>
                    <td>Póliza Nro.:</td>
                    <td class="no-borde"><?php echo $fila['POLI_POLIZA_NRO'];?></td>
                    <td class="no-borde">Valor en: $<?php echo number_format($fila['TITU_POLIZA_VALOR'],2,',','.');?> USD</td>
                    <td class="no-borde">Vencimiento: <?php echo $poli_venc;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3"></td>
                </tr>
                
            </tbody>
        
        </table>
        <p id="leyenda">No se entregarán los efectos depositados a la presentación del respectivo Certificado de Depósito, sin estar acompañados del
    warrant correspondiente y arribos con endoso en forma si se hubieren negociado.</p>
        
    
    </div>
    
    <div class="col-3-2">
        <p id="leyenda">Los cargos aquí expresados deberán ser pagados contra la emisión de este certificado. En caso de remate, AG Warrants S.A. deducirá de la venta de las mercaderías todo lo adeudado hasta la entrega a su comprador. </p>
    </div>
    
    
    <div class="col-3-3">
    
        <table>
        
            <thead>
                <tr>
                    <th colspan="4">Las mercaderías adeudan:</th>
                </tr>
                <tr>
                    <th>Concepto</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>EMISION:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_emi; ?></td>
                    
                </tr>
                <tr>
                    <td>SEGURO:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_seg;?></td>
                </tr>
                
                <tr>
                    <td>OTROS CARGOS:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_otros;?></td>
                </tr>
                
                <tr>
                    <td>TOTAL:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_total;?></td>
                </tr>
                
            </tbody>    
        </table>
        
        <p id="leyenda">Todos los intervinientes en este certificado autorizan a AG Warrants S.A., a realizar todos los actos e incurrir en todos los gastos que fueran necesarios para asegurar el mantenimiento  de la calidad y cantidad de la mercadería. Todos los gastos que ello demande serán reembolsados a AG Warrants S.A. a su reclamo, y por su pago AG Warrants S.A. gozará de privilegio sobre el producido de la mercadería.</p>
    
    </div>
    </div><!-- /contenedor -->
    
    
    <div id="pie1">
    
        <p class="p1">Este documento está sujeto a las condiciones de emisión y a las normas de la Ley 9643 y su decreto reglamentario.</p>
        <p>Lugar y Fecha de Emisión: Buenos Aires, Argentina <?php echo $fecha_emision;?>; El deposito se efectúa por <?php echo $plazo;?> dias a contar desde la emisión de este documento. Vencimiento: <?php echo $plazovenc;?></p>
    
    </div>
    
    
    <div id="pie2">
        <p class="p1">DEPOSITANTE (Firma y Sello)</p>
        <p class="p2">Aclaración de la Firma y No. de Documento de Identidad.</p>
        
        <p id="leyenda">Declaración Jurada: El Depositante declara bajo juramento: Que es propietario de las mercaderías depositadas según este certificado y que
        las mismas son de libre disponibilidad sin que existan gravámenes, embargos, inhibiciones o impedimento alguno para su comercializacion. 2
        - Que rigen las condiciones impresas en este Certificado y todo lo establecido por la ley No. 9643, sus reglamentaciones y modificaciones. 3-
        Que a todo efecto derivado del presente serán válidas todas las notificaciones recibidas en el domicilio especial constituido.
        </p>
    </div>
    
    
    
    <div id="pie3">
    
        <p class="p1">AG WARRANTS S. A. (firma y sello)</p>
        
        <table>
            <thead>
                <tr>
                    <th colspan="3">Registro de la Operación</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>Libro: </td>
                    <td>Folio: </td>
                    <td>Posición: </td>
                </tr>
            </tbody>
        </table>    
    </div>
</div>


<div style="page-break-after:always"></div>

<!-- ################################## HOJA DE REGISTRO ################################################# -->
<div id="pagina">


    <div id="cabecera">
        <p class="p1">Ley 9643</p>
        <p id="HR" class="p2">HOJA DE REGISTRO <span>Nro. <?php echo $titulo; ?></span></p>
        <p class="p3">AG Warrants S.A. Tte. Gral. J. D. Perón 315 Piso 1º A, (C1038AAG) C.A.B.A, Argentina. C.U.I.T. 30-71132029-2</p>
    </div>
    
    
    
    <div id="cuerpo1">
    
        <p>Certifica que: <span id="depositante"><?php echo $fila['DEPO_RASO']; ?></span>  <span id="cuit">C.U.I.T.: <?php echo $fila['DEPO_CUIT']; ?></span></p>
        <p><span>Con domicilio en: <?php echo $fila['DEPO_DOMLEG']; ?>, <?php echo $fila['DEPO_LOCA']; ?>, <?php echo $fila['DEPO_PROV']; ?> </span> <span id="telefono">Telefono: <?php echo $fila['DEPO_CONTACTO1']?></span></p>
        <p class="p3"><span>Ha depositado en nuestro almacen No.: <?php echo $fila['PLAN_NOMBRE']; ?> Ubicado en: <?php echo "".$fila['PLAN_DOMICILIO'].", ".$fila['PLAN_LOCA'].", ".$fila['PLAN_PROV'].". (".$vendedor.")"; ?></p>
    
    </div>
    
    
    <div id="tabla1">
    
        <table>
        
            <thead>
                <tr>
                    <th>TIPO DE PRODUCTO</th>
                    <th>CALIDAD</th>
                    <th>UNIDAD</th>
                    <th>CANTIDAD</th>
                    <th>VALOR UNITARIO</th>
                    <th>VALOR TOTAL</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td><?php echo $fila['TITU_PRODUCTO'];?></td>
                    <td><?php echo $fila['TITU_CALIDAD'];?></td>
                    <td><?php echo $fila['TITU_UNIDAD'];?></td>
                    <td><?php echo $cantidad;?></td>
                    <td>$<?php echo $precio_u;?> <?php echo $fila['TITU_MONEDA'];?></td>
                    <td>$<?php echo $total;?> <?php echo $fila['TITU_MONEDA'];?></td>
                </tr>
                
            </tbody>
            
        </table>
    
        <p class="p1">COMENTARIOS: <?php echo $fila['TITU_OBSERVACIONES'];?></p>
        <p class="p2">VALOR TOTAL DE LAS MERCADERIAS A LA EMISIÓN: <span id="totalLetras"><?php echo numtoletras($fila['TITU_PRECIO_U']*$fila['TITU_CANTIDAD']);?> <?php echo $fila['TITU_MONEDA'];?></span></p>
        
    </div>
    
    <div><!-- contenedor -->
    <div class="col-3-1">
    
        <table>
        
            <thead>
                <tr>
                    <th colspan="4">Seguros de las Mercaderías</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>Cobertura:</td>
                    <td colspan="3"><?php echo $fila['POLI_COBERTURA'];?></td>
                    
                </tr>
                <tr>
                    <td>Cía. de Seg:</td>
                    <td colspan="3"><?php echo $fila['POLI_RASO'];?></td>
                    
                </tr>
                <tr>
                    <td>Domicilio:</td>
                    <td colspan="3"><?php echo $fila['POLI_DOMLEG'];?>, <?php echo $fila['POLI_LOCA'];?>, <?php echo $fila['POLI_PROV'];?></td>
                </tr>
                <tr>
                    <td>Póliza Nro.:</td>
                    <td class="no-borde"><?php echo $fila['POLI_POLIZA_NRO'];?></td>
                    <td class="no-borde">Valor en: $<?php echo number_format($fila['TITU_POLIZA_VALOR'],2,',','.');?> USD</td>
                    <td class="no-borde">Vencimiento: <?php echo $poli_venc;?></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3"></td>
                </tr>
                
            </tbody>
        
        </table>
        <p id="leyenda">No se entregarán los efectos depositados a la presentación del respectivo Certificado de Depósito, sin estar acompañados del
    warrant correspondiente y arribos con endoso en forma si se hubieren negociado.</p>
        
    
    </div>
    
    <div class="col-3-2">
        <p id="leyenda">Los cargos aquí expresados deberán ser pagados contra la emisión de este certificado. En caso de remate, AG Warrants S.A. deducirá de la venta de las mercaderías todo lo adeudado hasta la entrega a su comprador. </p>
    </div>
    
    
    <div class="col-3-3">
    
        <table>
        
            <thead>
                <tr>
                    <th colspan="4">Las mercaderías adeudan:</th>
                </tr>
                <tr>
                    <th>Concepto</th>
                    <th>Valor Total</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>EMISION:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_emi; ?></td>
                    
                </tr>
                <tr>
                    <td>SEGURO:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_seg;?></td>
                </tr>
                
                <tr>
                    <td>OTROS CARGOS:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_otros;?></td>
                </tr>
                
                <tr>
                    <td>TOTAL:</td>
                    <td><?php echo $fila['TITU_MONEDA'];?> $<?php echo $cargos_total;?></td>
                </tr>
                
            </tbody>    
        </table>
        
        <p id="leyenda">Todos los intervinientes en este certificado autorizan a AG Warrants S.A., a realizar todos los actos e incurrir en todos los gastos que fueran necesarios para asegurar el mantenimiento  de la calidad y cantidad de la mercadería. Todos los gastos que ello demande serán reembolsados a AG Warrants S.A. a su reclamo, y por su pago AG Warrants S.A. gozará de privilegio sobre el producido de la mercadería.</p>
    
    </div>
    </div><!-- /contenedor -->
    
    
    <div id="pie1">
    
        <p class="p1">Este documento está sujeto a las condiciones de emisión y a las normas de la Ley 9643 y su decreto reglamentario.</p>
        <p>Lugar y Fecha de Emisión: Buenos Aires, Argentina <?php echo $fecha_emision;?>; El deposito se efectúa por <?php echo $plazo;?> dias a contar desde la emisión de este documento. Vencimiento: <?php echo $plazovenc;?></p>
    
    </div>
    
    
    <div id="pie2">
        <p class="p1">DEPOSITANTE (Firma y Sello)</p>
        <p class="p2">Aclaración de la Firma y No. de Documento de Identidad.</p>
        
        <p id="leyenda">Declaración Jurada: El Depositante declara bajo juramento: Que es propietario de las mercaderías depositadas según este certificado y que
        las mismas son de libre disponibilidad sin que existan gravámenes, embargos, inhibiciones o impedimento alguno para su comercializacion. 2
        - Que rigen las condiciones impresas en este Certificado y todo lo establecido por la ley No. 9643, sus reglamentaciones y modificaciones. 3-
        Que a todo efecto derivado del presente serán válidas todas las notificaciones recibidas en el domicilio especial constituido.
        </p>
    </div>
    
    
    
    <div id="pie3">
    
        <p class="p1">AG WARRANTS S. A. (firma y sello)</p>
        
        <table>
            <thead>
                <tr>
                    <th colspan="3">Registro de la Operación</th>
                </tr>
            </thead>
            
            <tbody>
                <tr>
                    <td>Libro: </td>
                    <td>Folio: </td>
                    <td>Posición: </td>
                </tr>
            </tbody>
        </table>    
    </div>
</div>




</body>
</html>