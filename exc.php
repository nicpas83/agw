<?php include "includes/init.php"; 
verificar_sesion();
verificar_adm();
?>
<?php include "includes/conexion.php"; ?>
<?php
// Author: Linmic, email: linmicya@gmail.com



$depo_id = 5; 
$desde = "2016-12-1";
$hasta = "2016-12-31";



$select = "
select 
	t.TITU_WCD_NR,
	t.TITU_OPERACION,
	t.TITU_RENOVADO,
	t.TITU_ESTADO,
	p.PLAN_RASO, 
	d.DEPO_RASO,
	t.TITU_FECHA_EMISION,
	t.TITU_PLAZO,
	t.TITU_VENC,
	t.TITU_FECHA_LIBERACION,
	t.TITU_PRODUCTO,
	t.TITU_UNIDAD,
	t.TITU_CANTIDAD,
	t.TITU_MONEDA,
	t.TITU_PRECIO_U,
	t.TITU_VALOR_W,
-- cantidad de inspecciones  con rango de fechas
	(SELECT count(*) FROM actas AS a 
		WHERE a.ACTA_PLANTA_ID = t.TITU_PLANTA_ID AND a.ACTA_FECHA >= t.TITU_FECHA_EMISION 
        AND a.ACTA_FECHA between '$desde' AND '$hasta'
    ) as CANT_INSP,
	p.PLAN_NOMBRE, 
	p.PLAN_DOMICILIO, 
	loc.LOCA_NOMBRE, 
	prov.PROV_NOMBRE, 
	pol.POLI_RASO, 
	pol.POLI_VENC,
	t.TITU_TIPO_W,
	b.BENE_RASO,

-- cant. dias vigente para facturar 
    IF(t.TITU_OPERACION = 'Renovación' AND t.TITU_FECHA_EMISION BETWEEN	'$desde' AND '$hasta',
        (CASE 
        		WHEN t.TITU_FECHA_LIBERACION IS NULL AND t.TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
        		WHEN t.TITU_FECHA_LIBERACION IS NULL AND t.TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', t.TITU_FECHA_EMISION)
        		WHEN t.TITU_FECHA_LIBERACION <= '$hasta' AND t.TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(t.TITU_FECHA_LIBERACION, '$desde')
        		WHEN t.TITU_FECHA_LIBERACION <= '$hasta' AND t.TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(t.TITU_FECHA_LIBERACION, t.TITU_FECHA_EMISION)
        		WHEN t.TITU_FECHA_LIBERACION > '$hasta' AND t.TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
        		WHEN t.TITU_FECHA_LIBERACION > '$hasta' AND t.TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', t.TITU_FECHA_EMISION)
        ELSE 'error'
        END),
        
        (CASE 
        		WHEN t.TITU_FECHA_LIBERACION IS NULL AND t.TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
        		WHEN t.TITU_FECHA_LIBERACION IS NULL AND t.TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', t.TITU_FECHA_EMISION)+1
        		WHEN t.TITU_FECHA_LIBERACION <= '$hasta' AND t.TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(t.TITU_FECHA_LIBERACION, '$desde')+1
        		WHEN t.TITU_FECHA_LIBERACION <= '$hasta' AND t.TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(t.TITU_FECHA_LIBERACION, t.TITU_FECHA_EMISION)+1
        		WHEN t.TITU_FECHA_LIBERACION > '$hasta' AND t.TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
        		WHEN t.TITU_FECHA_LIBERACION > '$hasta' AND t.TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', t.TITU_FECHA_EMISION)+1
        ELSE 'error'
        END)
    ) AS DIAS


-- SELECT.final
FROM titulos AS t
    left outer join plantas as p
    		left outer join provincias as prov
    		ON p.PLAN_PROV_ID = prov.PROV_ID
    		left outer join localidades as loc
    		ON p.PLAN_LOCA_ID = loc.LOCA_ID
    ON t.TITU_PLANTA_ID = p.PLAN_ID
    left outer join depositantes as d
    on t.TITU_DEPO_ID = d.DEPO_ID
    left outer join polizas as pol
    ON t.TITU_POLIZA_NRO = pol.POLI_POLIZA_NRO
    left outer join beneficiarios as b
    ON t.TITU_ENDO_BENE_ID = BENE_ID 

WHERE
-- filtro con rango de fechas
    TITU_FECHA_EMISION <= '$hasta' AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION >= '$hasta' 
											or TITU_FECHA_LIBERACION between '$desde' AND '$hasta')
-- filtrodin  5=bunge
    AND TITU_DEPO_ID = '$depo_id'

-- filtro perfil adm
AND pol.POLI_PROPIA = 'SI' AND TITU_ESTADO != 'A'

";

//mysqli_query('SET NAMES utf8;');
$export = mysqli_query($cnx, $select) or die(mysqli_error($cnx)); 
//$fields = mysql_num_rows($export); // thanks to Eric
$fields = mysql_num_fields($export); // by KAOSFORGE

for ($i = 0; $i < $fields; $i++) {
    $col_title .= '<Cell ss:StyleID="2"><Data ss:Type="String">'.mysql_field_name($export, $i).'</Data></Cell>';
}

$col_title = '<Row>'.$col_title.'</Row>';

while($row = mysqli_fetch_row($export)) {
    $line = '';
    foreach($row as $value) {
        if ((!isset($value)) OR ($value == "")) {
            $value = '<Cell ss:StyleID="1"><Data ss:Type="String"></Data></Cell>\t';
        } else {
            $value = str_replace('"', '', $value);
            $value = '<Cell ss:StyleID="1"><Data ss:Type="String">' . $value . '</Data></Cell>\t';
        }
        $line .= $value;
    }
    $data .= trim("<Row>".$line."</Row>")."\n";
}

$data = str_replace("\r","",$data);

header("Content-Type: application/vnd.ms-excel;");
header("Content-Disposition: attachment; filename=export.xls");
header("Pragma: no-cache");
header("Expires: 0");

$xls_header = '<?xml version="1.0" encoding="utf-8"?>
<Workbook xmlns="urn:schemas-microsoft-com:office:spreadsheet" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns:ss="urn:schemas-microsoft-com:office:spreadsheet" xmlns:html="http://www.w3.org/TR/REC-html40">
<DocumentProperties xmlns="urn:schemas-microsoft-com:office:office">
<Author></Author>
<LastAuthor></LastAuthor>
<Company></Company>
</DocumentProperties>
<Styles>
<Style ss:ID="1">
<Alignment ss:Horizontal="Left"/>
</Style>
<Style ss:ID="2">
<Alignment ss:Horizontal="Left"/>
<Font ss:Bold="1"/>
</Style>

</Styles>
<Worksheet ss:Name="Export">
<Table>';

$xls_footer = '</Table>
<WorksheetOptions xmlns="urn:schemas-microsoft-com:office:excel">
<Selected/>
<FreezePanes/>
<FrozenNoSplit/>
<SplitHorizontal>1</SplitHorizontal>
<TopRowBottomPane>1</TopRowBottomPane>
</WorksheetOptions>
</Worksheet>
</Workbook>';

print $xls_header.$col_title.$data.$xls_footer;
exit;

?>