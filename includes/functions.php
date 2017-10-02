<?php
function _porcentaje($num){
    
    $num = round($num,2);  
    return $num * 100 . ' %';
}

function datecheck($input,$format="")
{
    $separator_type= array(
        "/",
        "-",
        "."
    );
    foreach ($separator_type as $separator) {
        $find= stripos($input,$separator);
        if($find<>false){
            $separator_used= $separator;
        }
    }
    $input_array= explode($separator_used,$input);
    if ($format=="mdy") {
        return checkdate($input_array[0],$input_array[1],$input_array[2]);
    } elseif ($format=="ymd") {
        return checkdate($input_array[1],$input_array[2],$input_array[0]);
    } else {
        return checkdate($input_array[1],$input_array[0],$input_array[2]);
    }
    $input_array=array();
}

	/**
 * CARGAR COMBO_PROVINCIA
 * Si el usuario ya tiene configurada provincia en su perfil, deberá generar el <option selected> 
 * que corresponde. Si no tiene datos (null), entonces el primer <option selected> deberá tener 
 * value 0 y texto genérico.
 * 
 * $parametros vienen desde "clubcero/mi_perfil_datos_usuario.php" 
 */
function combo_provincia($prov_select_id = NULL)
{
    global $cnx;
    
    $query = "SELECT * FROM provincias";
    $result = mysqli_query($cnx, $query) or die(mysqli_error($cnx));
    $option_provincia = "";

    while($provincias = mysqli_fetch_array($result)){
        
        if($provincias['PROV_ID'] == $prov_select_id){
            
            $option_provincia .= "<option value='".$provincias['PROV_ID']."' selected>
                                    ".$provincias['PROV_NOMBRE']."</option>";
                                    
        }else{
            
            $option_provincia .= "<option value='".$provincias['PROV_ID']."'>
                                    ".$provincias['PROV_NOMBRE']."</option>";
        }
        
    }
   
    return $option_provincia;     
    
}

/**
 * CARGAR COMBO_LOCALIDAD
 * Si el usuario ya tiene configurada provincia y localidad en su perfil, deberá generar el <option selected> 
 * que corresponde.
 */
function combo_localidad($prov_select_id, $loca_select_id)
{
    global $cnx;
    
    if($prov_select_id === "" or empty($prov_select_id)){
        
        $option_localidad = "";
    
    }else{
     
        $query = "SELECT * FROM localidades WHERE LOCA_PROV_ID = $prov_select_id";
        $result = mysqli_query($cnx, $query);
        
        while($localidades = mysqli_fetch_array($result)){
        
            if($localidades['LOCA_ID'] == $loca_select_id){
                
                $option_localidad .= "<option value='".$localidades['LOCA_ID']."' selected>
                                        ".$localidades['LOCA_NOMBRE']."</option>";
                                        
            }else{
                
                $option_localidad .= "<option value='".$localidades['LOCA_ID']."'>
                                        ".$localidades['LOCA_NOMBRE']."</option>";
            }
            
        }
 
    }


    return $option_localidad;
      
}



function combo_beneficiarios($bene_select = null, $usuaPerfil = null, $usuaFiltroId = null)
{
    global $cnx;
    $codigo = "";
    
    
    if(empty($usuaFiltroId)){
        //perfil adm, busco todos de tabla simple
        $sql = "SELECT * FROM beneficiarios";
    
    }elseif(!empty($usuaFiltroId) AND $usuaPerfil == "clie2"){
        
        $sql = "SELECT distinct(BENE_RASO), BENE_ID from titulos 
                left outer join beneficiarios
                ON TITU_ENDO_BENE_ID = BENE_ID
                WHERE TITU_DEPO_ID = $usuaFiltroId";
    }

    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    
    while($fila = mysqli_fetch_array($result)){
        
        if($fila['BENE_ID'] == $bene_select){
            $codigo .= "<option value='".$fila['BENE_ID']."' selected=''>".$fila['BENE_RASO']."</option>";    
        
        }else{
            $codigo .= "<option value='".$fila['BENE_ID']."'>".$fila['BENE_RASO']."</option>";
            
        }

    }
    
    return $codigo;
}



/**
 *  $usuaFiltroId  sale de tabla usuarios. Pasando éste valor, el combo se forma según perfil de usuario. ()
 * 
*/
function combo_depositantes($depo_select = null, $usuaPerfil = null, $usuaFiltroId = null)
{
    global $cnx;
    $codigo = "";
    
    if(empty($usuaFiltroId)){
        //perfil adm, busco todos de tabla simple
        $sql = "SELECT DEPO_ID, DEPO_RASO FROM depositantes order by DEPO_RASO";
            
    }elseif(!empty($usuaFiltroId) AND $usuaPerfil == "seg"){
        //perfil SEG. (ej,Allianz)
        $sql = "SELECT distinct(DEPO_RASO), DEPO_ID, POLI_RASO
                FROM titulos 
                LEFT OUTER JOIN polizas 
                ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
                left outer join depositantes
                ON TITU_DEPO_ID = DEPO_ID
                WHERE POLI_RASO LIKE '%".$usuaFiltroId."%'";
    
    }elseif(!empty($usuaFiltroId) AND $usuaPerfil == "clie1"){
        //perfil clie1. OK 
        $sql = "SELECT distinct(DEPO_RASO), DEPO_ID from titulos 
                left outer join depositantes
                ON TITU_DEPO_ID = DEPO_ID
                WHERE TITU_ENDO_BENE_ID = $usuaFiltroId";
    }
    
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        if($fila['DEPO_ID'] == $depo_select){
            $codigo .= "<option value = '".$fila['DEPO_ID']."' selected=''>".$fila["DEPO_RASO"]."</option>";
        
        }else{
        
            $codigo .= "<option value = '".$fila['DEPO_ID']."'>".$fila["DEPO_RASO"]."</option>";    
        }
        
        
    }
    
    return $codigo;
}

function combo_polizas()
{
    global $cnx;
    $option = "";
    
    $sql = "SELECT * FROM polizas where POLI_VIGENTE = 'S'";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        $option .= "<option value='".$fila['POLI_POLIZA_NRO']."'>".$fila['POLI_POLIZA_NRO']."</option>"; 
        
    }
    
    return $option;
}

function combo_inspectores($insp_selected = NULL)
{
    global $cnx;
    $codigo = "";
    $selected= "";
    
    
    $sql = "SELECT * FROM inspectores";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        $selected= "";
        if($fila['INSP_ID'] == $insp_selected){
            $selected = "selected = 'selected'";
        }
        $codigo .= "<option value='".$fila['INSP_ID']."' ".$selected.">".$fila['INSP_APELLIDO'].", ".$fila['INSP_NOMBRE']."</option>"; 
        
    }
    
    return $codigo;
}

/**
 * $order --> ASC o DESC 
*/
function combo_nro_titulos_vigentes($order)
{
    global $cnx;
    $codigo = "";

    $sql = "SELECT TITU_WCD_NR from titulos where TITU_ESTADO = 'V' ORDER BY TITU_WCD_NR ".$order."";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "<option>".$fila['TITU_WCD_NR']."</option>"; 
        
    }
    
    return $codigo;
}

function combo_nro_titulos_cliente($perfil, $filtroPerfilId, $nro_select=null)
{
    
    global $cnx;
    $codigo = "";
    $filtro = "";
    $orderBy = " ORDER BY TITU_WCD_NR DESC";
    
    $sql = "SELECT TITU_ESTADO, TITU_WCD_NR, POLI_RASO
            from titulos
            LEFT OUTER JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
             WHERE TITU_ESTADO <> 'A'";
    
    if($perfil=="clie" or $perfil=="clie2"){
        $filtro = " AND TITU_DEPO_ID = $filtroPerfilId";    
    
    }elseif($perfil=="seg"){
        $filtro = " AND POLI_RASO LIKE '%$filtroPerfilId%'";    
    
    }elseif($perfil=="clie1"){
        $filtro = " AND TITU_ENDO_BENE_ID = $filtroPerfilId";
    }
    
    
    
    $result = mysqli_query($cnx, $sql.$filtro.$orderBy) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        if($nro_select == $fila['TITU_WCD_NR']){
            $codigo .= "<option selected=''>".$fila['TITU_WCD_NR']."</option>";    
        
        }else{
            $codigo .= "<option>".$fila['TITU_WCD_NR']."</option>";    
        }
         
        
    }
    
    return $codigo;
    
    
}


function combo_reporte_titulos_filtro_ver($ver_selected=null, $perfil)
{
    global $cnx;
    $codigo = "";
    $selected= "";
    
    if($perfil !== "adm"){
        $sql = "SELECT * FROM filtros WHERE FILT_RETI_VER_VALUE <> 'A'";    
    }else{
        $sql = "SELECT * FROM filtros";
    }
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        $selected= "";
        if($fila['FILT_RETI_VER_VALUE'] == $ver_selected){
            $selected = "selected = 'selected'";
        }
        $codigo .= "<option value='".$fila['FILT_RETI_VER_VALUE']."' ".$selected.">".$fila['FILT_RETI_VER']."</option>"; 
        
    }
    
    return $codigo;
}


/** por defecto muestro las plantas activas */
function tabla_plantas_listado($state)
{
    global $cnx;
    $codigo = "";
    $check = "checked";
    $i=1;
    
    if($state == 'I'){
        $check = "";    
    }
    
    $sql = "SELECT * FROM plantas 
            LEFT OUTER JOIN provincias ON PLAN_PROV_ID = PROV_ID 
            WHERE PLAN_STATE = '$state'
            order by PLAN_NOMBRE";
    
    $result = mysqli_query($cnx, $sql);
    
    while($plantas = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$plantas['PLAN_NOMBRE']."</td>
            <td>".$plantas['PLAN_RASO']."</td>
            <td>".$plantas['PROV_NOMBRE']."</td>
            <td>
                <div class='checkbox'>
                    <label>
                        <input class='plan-check-state' type='checkbox' name='".$plantas['PLAN_ID']."' $check />
                    </label>
                </div>
                 - 
                <a href='plantas.php?id=".$plantas['PLAN_ID']."'><button type='button' name='id'><i class='fa fa-list'></i></button>
                </a>          
            </td>
        </tr>
        ";
    
    }
    
    return $codigo;
    
}

function tabla_depositantes_listado()
{
    global $cnx;
    $codigo = "";
    $sql = "SELECT * FROM depositantes LEFT OUTER JOIN provincias ON DEPO_PROV_ID = PROV_ID order by DEPO_RASO";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$fila['DEPO_RASO']."</td>
            <td>".$fila['PROV_NOMBRE']."</td>
            <td>".$fila['DEPO_CONTACTO1']."</td>
            <td><a class='fa fa-list-ul' href='depositantes.php?id=".$fila['DEPO_ID']."'> Ver detalles</a></td>
        </tr>
        ";
    }
    
    return $codigo;
    
}

function tabla_beneficiarios_listado()
{
    global $cnx;
    $codigo = "";
    $sql = "SELECT * FROM beneficiarios LEFT OUTER JOIN provincias ON BENE_PROV_ID = PROV_ID order by BENE_RASO";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$fila['BENE_RASO']."</td>
            <td>".$fila['PROV_NOMBRE']."</td>
            <td>".$fila['BENE_CONTACTO1']."</td>
            <td><a class='fa fa-list-ul' href='beneficiarios.php?id=".$fila['BENE_ID']."'> Ver detalles</a></td>
        </tr>
        ";
    }
    
    return $codigo;
    
}


/** 
 * POLI_VIGENTE = S/N   POLI_PROPIA = S/N
*/
function tabla_polizas_listado($vigente)
{
    global $cnx;
    $codigo = "";
    
    $check = "checked";
    
    if($vigente == 'N'){
        $check = "";    
    }
    
    $sql = "SELECT 
                POLI_ID,
                POLI_RASO,
                POLI_POLIZA_NRO,
                POLI_VENC,
                POLI_PROPIA
            FROM polizas 
            WHERE POLI_VIGENTE = '$vigente'
            ORDER BY POLI_RASO ASC
            ";  
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$fila['POLI_RASO']."</td>
            <td>".$fila['POLI_POLIZA_NRO']."</td>
            <td>".$fila['POLI_VENC']."</td>
            <td>".$fila['POLI_PROPIA']."</td>
            
            <td>
            <div class='checkbox'>
                <label>
                    <input class='poli-check-state' type='checkbox' name='".$fila['POLI_POLIZA_NRO']."' $check />
                </label>
            </div>
            </td>
            <td>
            <a href='polizas.php?id=".$fila['POLI_ID']."'><button type='button' name='id'><i class='fa fa-list'></i></button></a>
            </td>
        </tr>
        ";
    }
    
    return $codigo;
    
}

function tabla_actas_listado()
{
    global $cnx;
    $codigo = "";
    $sql = "SELECT * FROM actas 
            LEFT OUTER JOIN plantas
            ON ACTA_PLANTA_ID = PLAN_ID
            LEFT OUTER JOIN inspectores
            ON ACTA_INSPECTOR_ID = INSP_ID
            ORDER BY ACTA_NRO DESC";  
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$fila['ACTA_NRO']."</td>
            <td>".$fila['ACTA_FECHA']."</td>
            <td>".$fila['PLAN_NOMBRE']."</td>
            <td>".$fila['INSP_APELLIDO'].", ".$fila['INSP_NOMBRE']."</td>
            <td>
                <a class='fa fa-trash-o' href='actas.php?abm=baja&id=".$fila['ACTA_NRO']."'></a> - 
                <a class='fa fa-list-ul' href='actas.php?id=".$fila['ACTA_NRO']."'></a>
            </td>
        </tr>
        ";
    }
    
    return $codigo;
    
}


function tabla_actasQX_listado($acta_nro, $styleHidden = NULL)
{
    global $cnx;
    $codigo = "";
    $sql = "SELECT * FROM actas_almacenes_qx 
            LEFT OUTER JOIN almacenes
            ON AAQX_ALMA_ID = ALMA_ID
            LEFT OUTER JOIN productos
            ON AAQX_PRODUCTO_ID = PROD_ID 
            WHERE AAQX_ACTA_NRO = $acta_nro";  
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$fila['ALMA_NOMBRE_INT']."</td>
            <td>".$fila['PROD_NOMBRE']."</td>
            <td>".$fila['AAQX_UNIDAD']."</td>
            <td>".number_format($fila['AAQX_QX_INICIALES'],2,',','.')."</td>
            <td ".$styleHidden.">".number_format($fila['AAQX_QX_RECIBIDAS'],2,',','.')."</td>
            <td ".$styleHidden.">".number_format($fila['AAQX_QX_LIBERADAS'],2,',','.')."</td>
            
        </tr>
        ";
    }
    
    return $codigo;
    
}


function tabla_inspectores_listado()
{
    global $cnx;
    $codigo = "";
    
    $sql = "SELECT * FROM inspectores order by INSP_APELLIDO";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        
        
        $codigo .= "
        <tr>
            <td>".$fila['INSP_APELLIDO'].", ".$fila['INSP_NOMBRE']."</td>
            <td>".$fila['INSP_TEL']."</td>
            <td>".lista_explode_id('-',$fila['INSP_ZONAS'],'provincias','PROV_ID','PROV_NOMBRE')."</td>
            <td><a class='fa fa-list-ul' href='inspectores.php?id=".$fila['INSP_ID']."'> Ver detalles</a></td>
        </tr>
        ";
    }
    
    return $codigo;
    
}

/** 
* Funcion para armar una lista tipo string a partir de una serie de id's almacenados 
* en base con un separador
* (por ejemplo: "1-4-34-4-2-7" )
*/
function lista_explode_id($separador, $cadena, $tabla, $valorBuscado, $valorListado)
{
    
    global $cnx;
    //vuelvo a crear array a partir del string almacenado en base. (cadena/separador)
    $array = explode($separador, $cadena);
    $lista = "";
    
    //traigo todos los beneficiarios para luego comparar con el array.
    $sql = "SELECT * FROM $tabla";
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        //busco dentro del array si coincide y armo la lista.
        if(in_array($fila["$valorBuscado"],$array)){
            
            if(empty($lista)){
                $lista .= "".$fila["$valorListado"]."";
            }else{
                $lista .= " - ".$fila["$valorListado"]."";
            }
        }
    }
    
    return $lista;
    
}


/** 
* Funcion para generar los <option> a partir de una serie de id's almacenados 
* en base con un separador  (por ejemplo: "1-4-34-4-2-7" )
*/

function option_select_explode_id($separador, $cadena, $tabla, $valorBuscado, $valorOption)
{
    
    global $cnx;
    //vuelvo a crear array a partir del string almacenado en base.
    $array = explode($separador, $cadena);
    $option = "";
    
    //traigo todo de la tabla para luego comparar con el array.
    $sql = "SELECT * FROM $tabla";
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
        
        if(in_array($fila["$valorBuscado"],$array)){
            
            $option .= "<option selected value='".$fila["$valorBuscado"]."'>".$fila["$valorOption"]."</option>";    
        
        }else{
            $option .= "<option value='".$fila["$valorBuscado"]."'>".$fila["$valorOption"]."</option>";           
            
        }
    }
    
    return $option;
    
}

function tabla_almacenes_listado($plan_id)
{
    global $cnx;
    
    $codigo = "";
    $sql = "SELECT * FROM almacenes WHERE ALMA_PLAN_ID = '$plan_id'";
    
    $result = mysqli_query($cnx, $sql);
    $i = 1;
    
    if(mysqli_num_rows($result) > 0){
        while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$i."</td>
            <td>".$fila['ALMA_TIPO']."</td>
            <td>".$fila['ALMA_CAPACIDAD']." ".$fila['ALMA_UNIDAD']."</td>
            <td>".$fila['ALMA_NOMBRE_INT']."</td>
            <td>".$fila['ALMA_AFORO_TEC']." %</td>
            <td><a class='fa fa-edit' href='almacenes.php?edit=".$fila['ALMA_ID']."&p=".$plan_id."'> Editar</a></td>
        </tr>
        ";
        
        $i++;
        }    
    }else{
        $codigo .= "
        <tr>
            <td></td>
            <td>No hay depositos cargados en sistema.</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        ";
        
    }
    
    
    return $codigo;
    
}


function tabla_tarifas_listado($id)
{
    global $cnx;
    
    $codigo = "";
    $sql = "SELECT * FROM tarifas WHERE TARI_DEPO_ID = '$id'order by TARI_DESDE asc";
    
    $result = mysqli_query($cnx, $sql);
    
    if(mysqli_num_rows($result) > 0){
        
        while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <tr>
            <td>".$fila['TARI_FECHA']."</td>
            <td>".$fila['TARI_DESDE']."</td>
            <td>".$fila['TARI_HASTA']."</td>
            <td>".$fila['TARI_UNIDAD']."</td>
            <td>".$fila['TARI_EMISION']."</td>
            <td>".$fila['TARI_SEGURO']."</td>
            <td>".$fila['TARI_OTROS']."</td>
            <td>".$fila['TARI_MIN']."</td>
            <td><a class='fa fa-edit' href='tarifas.php?edit=".$fila['TARI_ID']."&d=".$id."'> Editar</a></td>
        </tr>
        ";
        
        }    
    }else{
        $codigo .= "
        <tr>
            <td>No hay datos cargados en sistema.</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        ";
        
    }
    
    
    return $codigo;
    
}



function combo_productos($prod_selected = NULL, $need_value = "true")
{
    global $cnx;
    $selected = "";
    $codigo = "";
    $sql = "SELECT * FROM productos order by PROD_NOMBRE";
    
    $result = mysqli_query($cnx, $sql);
    
    if($need_value == "false"){

        while($fila = mysqli_fetch_array($result)){
        
            $selected = "";
            //si no paso el prod_select entonces busco poroto de soja como default
            if(is_null($prod_selected)){
                if($fila['PROD_ID'] == 28){ //poroto de soja
                    $selected = "selected = 'selected'";
                }else{
                    $selected = "";
                }   
            }else{
                if($fila['PROD_ID'] == $prod_selected){
                    $selected = "selected = 'selected'";
                }else{
                    $selected = "";
                }    
                
            }

            $codigo .= "<option ".$selected.">".$fila['PROD_NOMBRE']."</option>"; // sin value para form-emision
        }
        
    }else{
    
        while($fila = mysqli_fetch_array($result)){
        
            $selected = "";
            //si no paso el prod_select entonces busco poroto de soja como default
            if(is_null($prod_selected)){
                if($fila['PROD_ID'] == 28){ //poroto de soja
                    $selected = "selected = 'selected'";
                }else{
                    $selected = "";
                }   
            }else{
                if($fila['PROD_ID'] == $prod_selected){
                    $selected = "selected = 'selected'";
                }else{
                    $selected = "";
                }    
                
            }
            
            
            $codigo .= "
            <option value='".$fila['PROD_ID']."' ".$selected.">".$fila['PROD_NOMBRE']."</option>
            ";
        }
        
    }
    
    
    return $codigo;
}



function combo_vendedor($vend_selected = NULL, $need_value = "true")
{
    global $cnx;
    $selected = "";
    $codigo = "";
    $sql = "SELECT * FROM vendedor order by VEND_NOMBRE";
    
    $result = mysqli_query($cnx, $sql);
    
    if($need_value == "false"){

        while($fila = mysqli_fetch_array($result)){
        
            $selected = "";
            //si no paso el vend_select entonces busco poroto de soja como default
       
            if($fila['VEND_ID'] == $vend_selected){
                $selected = "selected = 'selected'";
            }else{
                $selected = "";
            }    
            
            $codigo .= "<option ".$selected.">".$fila['VEND_NOMBRE']."</option>"; 
        }
        
    }else{
    
        while($fila = mysqli_fetch_array($result)){
        
            $selected = "";
            //si no paso el vend_select entonces busco poroto de soja como default
       
            if($fila['VEND_ID'] == $vend_selected){
                $selected = "selected = 'selected'";
            }else{
                $selected = "";
            }    
            
            $codigo .= "<option value='".$fila['VEND_ID']."' ".$selected.">".$fila['VEND_NOMBRE']."</option>"; 
        }        
    }
    
    return $codigo;
}


/**  */
function combo_plantas_nombre($plan_selected = null)
{
    global $cnx;
    $codigo = "";
    
    //$plan_id = null;
    $selected = "";

    $sql = "select PLAN_ID, PLAN_NOMBRE from plantas WHERE PLAN_STATE = 'A' order by PLAN_NOMBRE";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $selected = "";
        if($fila['PLAN_ID'] === $plan_selected){
            $selected = "selected = 'selected'";
        }
        
        $codigo .= "
        <option value = '".$fila['PLAN_ID']."' ".$selected.">".$fila['PLAN_NOMBRE']."</option>
        ";
    }
    
    return $codigo;
    
    
}


/** La razon social de la planta, en el caso de necesitar filtrarlas por perfil de usuario, 
*   la debo tomar pasando por tabla titulos. 
*   El 
*/

function combo_plantas($filtroDin = null, $usuaFiltroId = null, $perfil = null)
{
    global $cnx;
    $codigo = "";
    $selected = "selected=''";

    if(!empty($usuaFiltroId)){
        
        if($perfil == "seg"){

            $sql = "SELECT DISTINCT(PLAN_RASO), POLI_RASO
                    FROM plantas
                    INNER JOIN titulos ON PLAN_ID = TITU_PLANTA_ID
                    INNER JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
                    WHERE PLAN_RASO <> '' AND POLI_RASO LIKE '%".$usuaFiltroId."%'";
            
            
        }else{
            //perfil cliente pasa id $_SESION['filtroPerfilId']
            $sql = "select DISTINCT PLAN_RASO 
                    from plantas 
                    where PLAN_RASO <> '' AND PLAN_ID IN(SELECT DISTINCT TITU_PLANTA_ID 
                                                        from titulos where TITU_DEPO_ID = $usuaFiltroId)";
            
            
        }
        
        
        
        $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
        while($fila = mysqli_fetch_array($result)){
                        
            if($fila['PLAN_RASO'] == $filtroDin){
                $codigo .= "<option selected=''>".$fila['PLAN_RASO']."</option>";
            }else{
                $codigo .= "<option>".$fila['PLAN_RASO']."</option>";
            }
        
        }
    
    }
    
    
    if(empty($usuaFiltroId)){
        //perfil adm usa filtro por planta nombre interno.
        $sql = "SELECT DISTINCT PLAN_NOMBRE FROM plantas WHERE PLAN_NOMBRE IS NOT NULL AND PLAN_STATE = 'A' order by PLAN_NOMBRE";
    
        $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
        
        while($fila = mysqli_fetch_array($result)){
                
            if($fila['PLAN_NOMBRE'] == $filtroDin){
                $codigo .= "<option selected=''>".$fila['PLAN_NOMBRE']."</option>";
            }else{
                $codigo .= "<option>".$fila['PLAN_NOMBRE']."</option>";
            }     
        
        }
    
    }
    
    return $codigo;    
    
}


/**  */
function combo_plantas_raso($plan_selected = null)
{
    global $cnx;
    $codigo = "";
    
    //$plan_id = null;
    $selected = "";

    $sql = "select DISTINCT(PLAN_RASO) from plantas order by PLAN_RASO";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $selected = "";
        if($fila['PLAN_RASO'] === $plan_selected){
            $selected = "selected = 'selected'";
        }
        
        $codigo .= "
        <option ".$selected.">".$fila['PLAN_RASO']."</option>
        ";
    }
    
    return $codigo;
    
    
}






function combo_unidades($unidad_selected = NULL)
{
    global $cnx;
    $codigo = "";
    $selected = "";
    $sql = "SELECT * FROM unidades";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $selected = "";
        if($fila['UNI_NOMBRE'] == $unidad_selected){
            $selected = "selected = 'selected'";
        }
        
        $codigo .= "
        <option ".$selected.">".$fila['UNI_NOMBRE']."</option>
        ";
    }
    
    return $codigo;
    
}




function combo_tipo_deposito()
{
    global $cnx;
    $codigo = "";
    
    $sql = "SELECT * FROM tipo_deposito";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $codigo .= "
        <option>".$fila['TIDE_NOMBRE']."</option>
        ";
    }
    
    return $codigo;
    
}

function combo_almacenes_de_planta($plan_id, $alma_selected = NULL)
{
    
    global $cnx;
    $codigo = "";
    $selected = "";
    $sql = "SELECT * FROM almacenes where ALMA_PLAN_ID = $plan_id";
    
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
        
        $selected = "";
        if($fila['ALMA_ID'] === $alma_selected){
            $selected = "selected = 'selected'";
        }
        
        $codigo .= "
        <option value = '".$fila['ALMA_ID']."' ".$selected.">".$fila['ALMA_NOMBRE_INT']."</option>
        ";
    }
    
    return $codigo;
    
    
    
}


/** 
 * El perfil de usuario y su Id para filtrar el reporte surgen de variables SESSION creadas al momento de Login.
* Filtros: $ver = Titulos (Vigentes,Todos,Liberados,Anulados,Emitidos) 
*  
*/

function tabla_reporte_titulos($perfil, $filtroPerfilId = null, $ver, $desde = null, $hasta = null, $filtroDinId = null)
{
    global $cnx;
    $codigo = "";
    $err = "";    // el error genera un return y mensaje en rojo.
    
    $filtro = "";
    $filtroDin = "";
    $filtroPerfil = "";  //desde ddjj_seguro le voy a pasar "SI" para que levante los titulos con POLI_PROPIA = SI
    
    // forma de la consulta :  $selectCampos.$selectCount.$selectFinal.$filtro.$filtroDin.$filtroPerfil
    $selectCampos = "select t.*, 
                            p.PLAN_RASO, p.PLAN_NOMBRE, p.PLAN_DOMICILIO, 
                            prov.PROV_NOMBRE, loc.LOCA_NOMBRE, 
                            d.DEPO_RASO, 
                            pol.POLI_RASO, pol.POLI_VENC,
                            b.BENE_RASO, ";
    
    if(!empty($desde) AND !empty($hasta)){
        // Con rango de fechas debo contar la cantidad de inspecciones en el rango dado. 
        $selectCount = "(SELECT count(*) FROM actas AS a 
                    WHERE a.ACTA_PLANTA_ID = t.TITU_PLANTA_ID AND a.ACTA_FECHA >= t.TITU_FECHA_EMISION AND a.ACTA_FECHA between '$desde' AND '$hasta') as CANT_INSP ";
    }else{
        // Default: Contar la cantidad de inspecciones que tuvo la planta posterior a la emisión del título.
        $selectCount = "(SELECT count(*) FROM actas AS a 
                    WHERE a.ACTA_PLANTA_ID = t.TITU_PLANTA_ID AND a.ACTA_FECHA >= t.TITU_FECHA_EMISION) as CANT_INSP ";    
    }
    
    
    $selectFinal = "FROM titulos AS t
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
                    where"; //continua en los IF  $filtro.$filtroDin  
                    
  
    
      
                        
    //esto es general a todos los fiiltros. 
    if(!empty($filtroDinId) AND ($perfil == "adm" or $perfil == "seg" or $perfil == "clie1")){
        $filtroDin = " AND TITU_DEPO_ID = '$filtroDinId'";
        
    }elseif(!empty($filtroDinId) AND $perfil == "clie"){
        $filtroDin = " AND PLAN_RASO = '$filtroDinId'";
        
   }
    
    
    /** Preparo reportes según perfil de usuario */
    if($perfil == "clie"){
        
        $filtroPerfil = " AND TITU_DEPO_ID = $filtroPerfilId AND TITU_ESTADO != 'A'";
            
    }elseif($perfil === "seg"){
        
        $filtroPerfil = " AND (pol.POLI_RASO like '$filtroPerfilId%' OR TITU_POLIZA_EXTRA like '$filtroPerfilId%') AND TITU_ESTADO != 'A'";
        
    }elseif($perfil == "clie1"){
        
        $filtroPerfil = " AND TITU_ENDO_BENE_ID = '$filtroPerfilId' AND TITU_ESTADO != 'A'";
        
    }elseif($perfil == "clie2"){
        
        $filtroPerfil = " AND TITU_DEPO_ID = '$filtroPerfilId' AND TITU_ESTADO != 'A'";
        
    }elseif($perfil === "ADM-seg"){
        
        $filtroPerfil = " AND pol.POLI_PROPIA = 'SI' AND TITU_ESTADO != 'A'";
        
    }

    /** preparo consulta según filtro "ver" 
    *   el  va en este filtro ya que $ver siempre será algo.
    */
      
    /** VIGENTES */
    if($ver == "V" AND empty($desde) AND empty($hasta)){
        //VIGENTES  sin rango fechas
        $filtro = " TITU_ESTADO = '$ver'";
        
    }elseif($ver == "V" AND (empty($desde) OR empty($hasta))){
        //VIGENTES  con rango fechas incompleto
        $err = "<p style='color:red;'>Para filtrar con fechas debe completar rango 'desde y hasta'.</p>";
        return $err;

    }elseif($ver == "V" AND !empty($desde) AND !empty($hasta)){
        //VIGENTES  con rango fechas correcto        
        $selectCount = "(SELECT count(*) FROM actas AS a 
                    WHERE a.ACTA_PLANTA_ID = t.TITU_PLANTA_ID AND a.ACTA_FECHA >= t.TITU_FECHA_EMISION AND ACTA_FECHA between '$desde' AND '$hasta') as CANT_INSP ";
        
        $filtro = " TITU_FECHA_EMISION <= '$hasta' AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION >= '$hasta') AND TITU_ESTADO <> 'A'";
    }        
    
    /** TODOS */
    if($ver == "T" AND empty($desde) AND empty($hasta)){
        //TODOS sin rango de fechas
        $filtro = " TITU_ESTADO IS NOT NULL";
        
    }elseif($ver == "T" AND (empty($desde) OR empty($hasta))){
        //TODOS no acepta fecha desde y/o hasta
        $err = "<p style='color:red;'>Para filtrar con fechas debe completar rango 'desde y hasta'.</p>";
        return $err;
        
    }elseif($ver == "T" AND !empty($desde) AND !empty($hasta)){
        //TODOS  con rango fechas correcto        
        $selectCount = "(SELECT count(*) FROM actas AS a 
                    WHERE a.ACTA_PLANTA_ID = t.TITU_PLANTA_ID AND a.ACTA_FECHA >= t.TITU_FECHA_EMISION AND ACTA_FECHA between '$desde' AND '$hasta') as CANT_INSP ";
        
        $filtro = " TITU_FECHA_EMISION <= '$hasta' AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION >= '$hasta' or TITU_FECHA_LIBERACION between '$desde' AND '$hasta')";
    
    } 
    

    /** EMITIDOS */
    if($ver == "E" AND empty($desde) AND empty($hasta)){
        //EMITIDOS sin fecha --error.  ver los emitidos necesita 'desde' y/o 'hasta'.    
        $err = "<p style='color:red;'>Para filtrar por 'Emitidos' debe seleccionar una fecha o un rango de fechas.</p>";
        return $err;
            
    }elseif($ver == "E" AND !empty($desde) AND !empty($hasta)){
        //EMITIDOS con rango fecha correcto. 
        $selectCount = "(SELECT count(*) FROM actas AS a 
            WHERE a.ACTA_PLANTA_ID = t.TITU_PLANTA_ID AND a.ACTA_FECHA >= t.TITU_FECHA_EMISION AND ACTA_FECHA between '$desde' AND '$hasta') as CANT_INSP ";
        $filtro = " TITU_FECHA_EMISION between '$desde' AND '$hasta'";
           
    }elseif($ver == "E" AND !empty($desde) AND empty($hasta)){
        //EMITIDOS con fecha desde
        $filtro = " TITU_FECHA_EMISION >= '$desde'";
    
    }elseif($ver == "E" AND empty($desde) AND !empty($hasta)){
        //EMITIDOS con fecha hasta
        $filtro = " TITU_FECHA_EMISION <= '$hasta'";
    }
       
    /** LIBERADOS */
    if($ver == "L" AND empty($desde) AND empty($hasta)){
        //LIBERADOS sin rango de fechas
        $filtro = " TITU_ESTADO = '$ver'";

    }elseif($ver == "L" AND !empty($desde) AND empty($hasta)){
        //LIBERADOS con fecha desde
        $filtro = " TITU_ESTADO = '$ver' AND TITU_FECHA_LIBERACION >= '$desde'";
        
    }elseif($ver == "L" AND empty($desde) AND !empty($hasta)){
        //LIBERADOS con fecha hasta
        $filtro = " TITU_ESTADO = '$ver' AND TITU_FECHA_LIBERACION <= '$hasta'"; 
    
    }elseif($ver == "L" AND !empty($desde) AND !empty($hasta)){
        //LIBERADOS con rango fecha completo
        $selectCount = "(SELECT count(*) FROM actas AS a 
            WHERE a.ACTA_PLANTA_ID = t.TITU_PLANTA_ID AND a.ACTA_FECHA >= t.TITU_FECHA_EMISION AND ACTA_FECHA between '$desde' AND '$hasta') as CANT_INSP ";
        $filtro = " TITU_ESTADO = '$ver' AND TITU_FECHA_LIBERACION between '$desde' AND '$hasta'"; 
    
    }

    /** ANULADOS */
    if($ver == "A" AND empty($desde) AND empty($hasta)){     
        $filtro = " TITU_ESTADO = '$ver'";
    
    }elseif($ver == "A" AND !empty($desde) AND !empty($hasta)){
    
        $filtro = " TITU_ESTADO = '$ver' AND TITU_FECHA_EMISION between '$desde' AND '$hasta'";
        
    }
    

    $resut = mysqli_query($cnx, $selectCampos.$selectCount.$selectFinal.$filtro.$filtroDin.$filtroPerfil) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($resut)){
        
        if($fila['TITU_ESTADO'] == "L"){
            $estado = "Liberado";
        }
        if($fila['TITU_ESTADO'] == "A"){
            $estado = "Anulado";
        }      
        if($fila['TITU_ESTADO'] == "V"){
            $estado = "Vigente";
        }
        
        $cant_insp = $fila['CANT_INSP'];
        if($fila['CANT_INSP'] == 0){
            $cant_insp = "1";
        }
           
        $codigo .= "
        <tr>
            <td>".$fila['TITU_WCD_NR']."</td>
            <td>".$estado."</td>
            <td>".$fila['PLAN_RASO']."</td>
            <td>".$fila['DEPO_RASO']."</td>
            <td>".$fila['TITU_FECHA_EMISION']."</td>
            <td>".$fila['TITU_PLAZO']."</td>
            <td>".$fila['TITU_VENC']."</td>
            <td>".$fila['TITU_FECHA_LIBERACION']."</td>
            <td>".$fila['TITU_PRODUCTO']."</td>
            <td>".$fila['TITU_UNIDAD']."</td>
            <td>".number_format($fila['TITU_CANTIDAD'],2,",",".")."</td>
            <td>".$fila['TITU_MONEDA']."</td>
            <td>".number_format($fila['TITU_PRECIO_U'],2,",",".")."</td>
            <td>".number_format($fila['TITU_VALOR_W'],2,",",".")."</td>
            <td>".$cant_insp."</td>
            <td>".$fila['PLAN_NOMBRE']."</td>
            <td>".$fila['PLAN_DOMICILIO']."</td>
            <td>".$fila['LOCA_NOMBRE']."</td>
            <td>".$fila['PROV_NOMBRE']."</td>
            <td>".$fila['POLI_RASO']."</td>
            <td>".$fila['POLI_VENC']."</td>
            <td>".$fila['TITU_TIPO_W']."</td>
            <td>".$fila['BENE_RASO']."</td>
            <td>".$fila['TITU_IDENTIFICACION']."</td>
        </tr>
        ";
        
    }
    
    return $codigo;
    
}

/** 
* Trazabilidad de Inspecciones:
*/

function tabla_reporte_inspecciones($perfil, $filtroPerfilId=null, $desde=null, $hasta=null, $planta=null, $filtroDin=null)
{
    global $cnx;
    $codigo = "";
    $err = "";    // el error genera un return y mensaje en rojo.
    
    $filtroReporte = " AND al.ACTA_FECHA > DATE_SUB(curdate(), INTERVAL 1 YEAR)";
    $filtroHaving = "";           
    $orderBy = " ORDER BY al.ACTA_FECHA DESC";    


    /** Preparo reportes según perfil de usuario // Cosidera Aforo diferenciado por usuario 
    *   Para eso creamos columna adicional y obtenemos aforo_usuario por diferencia con aforo adm.
    */
    if($perfil == "adm"){
        $select_cant = "";
        $select_lista = "";
        $cant_w_us = "";
        $lista_warrant_us = "";
        $filtroUsuario = "WHERE al.ACTA_NRO IS NOT NULL";
            
    }elseif($perfil == "clie"){
        $select_cant = ", w.CANT_W_US,";
        $select_lista = " w.LISTA_WARRANT_US";
        $cant_w_us = ", SUM(IF(TITU_DEPO_ID = $filtroPerfilId,TITU_CANTIDAD,NULL)) as CANT_W_US,";
        $lista_warrant_us = " COALESCE(GROUP_CONCAT(IF(TITU_DEPO_ID = $filtroPerfilId, TITU_WCD_NR, null) ORDER BY TITU_WCD_NR SEPARATOR '-'),0) AS LISTA_WARRANT_US";
        $filtroUsuario = "WHERE w.CANT_W_US IS NOT NULL";
            
    }elseif($perfil == "seg"){
        $select_cant = ", w.CANT_W_US,";
        $select_lista = " w.LISTA_WARRANT_US";
        $cant_w_us = ", SUM(IF((POLI_RASO LIKE '%".$filtroPerfilId."%' OR TITU_POLIZA_EXTRA like '$filtroPerfilId%'),TITU_CANTIDAD,NULL)) as CANT_W_US,";
        $lista_warrant_us = " COALESCE(GROUP_CONCAT(IF(POLI_RASO LIKE '%".$filtroPerfilId."%', TITU_WCD_NR, null) ORDER BY TITU_WCD_NR SEPARATOR '-'),0) AS LISTA_WARRANT_US";
        $filtroUsuario = "WHERE w.CANT_W_US IS NOT NULL";
        
    }elseif($perfil == "clie1"){   
        $select_cant = ", w.CANT_W_US,";
        $select_lista = " w.LISTA_WARRANT_US";
        $cant_w_us = ", SUM(IF(TITU_ENDO_BENE_ID = $filtroPerfilId,TITU_CANTIDAD,NULL)) as CANT_W_US,";
        $lista_warrant_us = " COALESCE(GROUP_CONCAT(IF(TITU_ENDO_BENE_ID = $filtroPerfilId, TITU_WCD_NR, null) ORDER BY TITU_WCD_NR SEPARATOR '-'),0) AS LISTA_WARRANT_US";
        $filtroUsuario = "WHERE w.CANT_W_US IS NOT NULL";
    
    }


    
    $sql = "
            SELECT
                COALESCE(w.GROUP_DEPO_ID, 'sin tit') as GROUP_DEPO_ID,
                COALESCE(w.GROUP_DEPO_RASO, '-') as GROUP_DEPO_RASO,
                al.ACTA_FECHA,
                PLAN_ID,
                PLAN_RASO,
                PLAN_NOMBRE,
                LOCA_NOMBRE,
                al.ACTA_MOTIVO,
                al.ACTA_NRO,
                CONCAT(al.INSP_NOMBRE, ' ', al.INSP_APELLIDO) AS INSPECTOR,
                al.PROD_NOMBRE,
                al.AAQX_UNIDAD,
                al.CANT_VERIF,
                COALESCE(w.CANT_W, 0) as CANT_W,
                COALESCE(w.LISTA_WARRANT, 'sin títulos vigentes') as LISTA_WARRANT
                ".$select_cant."
                ".$select_lista."
            
            FROM
            plantas 

            INNER JOIN localidades ON PLAN_LOCA_ID = LOCA_ID            
            
            LEFT JOIN (
            	SELECT 
            		*,
            		SUM(AAQX_QX_INICIALES + AAQX_QX_RECIBIDAS - AAQX_QX_LIBERADAS) AS CANT_VERIF
                        
            	FROM almacenes 
            	INNER JOIN actas_almacenes_qx ON ALMA_ID = AAQX_ALMA_ID
            	INNER JOIN productos ON AAQX_PRODUCTO_ID = PROD_ID
            	INNER JOIN actas ON AAQX_ACTA_NRO = ACTA_NRO
            	INNER JOIN inspectores ON INSP_ID = ACTA_INSPECTOR_ID
            
            	GROUP BY ALMA_PLAN_ID, ACTA_NRO, PROD_NOMBRE
            
            ) al
            ON PLAN_ID = al.ALMA_PLAN_ID
            
            LEFT JOIN (
            	SELECT 
            		GROUP_CONCAT(DISTINCT(DEPO_ID)) as GROUP_DEPO_ID,
                    GROUP_CONCAT(DISTINCT(DEPO_RASO) SEPARATOR ' - ') as GROUP_DEPO_RASO,
                    POLI_RASO,
                    TITU_ENDO_BENE_ID,
            		TITU_PLANTA_ID,
            		TITU_PRODUCTO,
            		ac.ACTA_NRO,
            		SUM(TITU_CANTIDAD) as CANT_W,
            		GROUP_CONCAT(TITU_WCD_NR ORDER BY TITU_WCD_NR SEPARATOR '-') AS LISTA_WARRANT
                    ".$cant_w_us."
            		".$lista_warrant_us."
            	from titulos
            	LEFT JOIN depositantes ON TITU_DEPO_ID = DEPO_ID
                LEFT JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
                RIGHT JOIN (
    					SELECT 
    						ALMA_PLAN_ID,
    						ACTA_FECHA,
    						ACTA_NRO,
    						PROD_NOMBRE
    					FROM almacenes 
    					INNER JOIN actas_almacenes_qx ON ALMA_ID = AAQX_ALMA_ID
    					INNER JOIN productos ON AAQX_PRODUCTO_ID = PROD_ID
    					RIGHT JOIN actas ON AAQX_ACTA_NRO = ACTA_NRO
    					GROUP BY ALMA_PLAN_ID, ACTA_NRO, PROD_NOMBRE
    					) ac
    					ON TITU_PLANTA_ID = ac.ALMA_PLAN_ID AND TITU_PRODUCTO = ac.PROD_NOMBRE
    					AND TITU_FECHA_EMISION < ac.ACTA_FECHA and (TITU_FECHA_LIBERACION is null or TITU_FECHA_LIBERACION > ac.ACTA_FECHA) 
    	   GROUP BY TITU_PLANTA_ID, TITU_PRODUCTO, ac.ACTA_NRO

            ) w
            
            ON PLAN_ID = w.TITU_PLANTA_ID
            AND al.ACTA_NRO = w.ACTA_NRO AND al.PROD_NOMBRE = w.TITU_PRODUCTO
            
            ";  // incluyo este where para poder usar directamente "AND" en los $filtro.
              
              
    /** Filtro FECHAS */
    //todas las actas, con sus titulos vigentes a la fecha del acta, o liberados luego de la inspección.             
    if(!empty($desde) AND !empty($hasta)){
        //actas según rango de fechas y sus titulos vigentes a la fecha del acta. 
        $filtroReporte .= " AND al.ACTA_FECHA between '$desde' AND '$hasta'"; 
        
    }elseif((!empty($desde) AND empty($hasta)) OR (empty($desde) AND !empty($hasta))){
        //rango de fechas incompleto
        $err = "<p style='color:red;'>Para filtrar con fechas debe completar rango 'desde y hasta'.</p>";
        return $err;
    }
    
    /** Filtro PLANTAS */
    if(!empty($planta) AND $perfil !== "adm"){
        $filtroReporte .= " AND PLAN_RASO = '$planta'";
    
    }elseif(!empty($planta) AND $perfil == "adm"){
        $filtroReporte .= " AND PLAN_NOMBRE = '$planta'";
    }
    
    /** Filtro DINAMICO */
    if(!empty($filtroDin) AND ($perfil == "adm" OR $perfil == "seg")){
        $filtroHaving .= " HAVING FIND_IN_SET('$filtroDin',GROUP_DEPO_ID)"; //en este caso ya estaba con la coma.
    
    }elseif(!empty($filtroDin) AND ($perfil == "clie" OR $perfil == "clie1")){
        $filtroHaving = " HAVING FIND_IN_SET('$filtroDin',REPLACE(LISTA_WARRANT,'-',','))";  //La funcion sólo acepta la coma como separador
    
    }
    
    //var_dump($sql.$filtroUsuario.$filtroReporte.$filtroHaving.$orderBy); die;
    
    $result = mysqli_query($cnx, $sql.$filtroUsuario.$filtroReporte.$filtroHaving.$orderBy) OR die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
                
        $aforo = $fila['CANT_VERIF']-$fila['CANT_W'];
        
        if($perfil == "adm" or $perfil == "seg" or $perfil == "clie1"){
            $depo = $fila['GROUP_DEPO_RASO'];
            $cantBajoWarrants = number_format($fila['CANT_W'],2,',','.');
            $lista_warrant =  $fila['LISTA_WARRANT'];
        
        }elseif($perfil == "clie"){
            $depo = $_SESSION['raso'];
            $cantBajoWarrants = number_format($fila['CANT_W_US'],2,',','.');
            $lista_warrant =  $fila['LISTA_WARRANT_US'];
        
        }
        
                
        $codigo .= "
                    <tr class = 'limit.height'>
                        <td>".$depo."</td>
                        <td>".date('d-m-Y',strtotime($fila['ACTA_FECHA']))."</td>
                        <td>".$fila['PLAN_RASO']."</td>
                        <td>".$fila['PLAN_NOMBRE']."</td>
                        <td>".$fila['LOCA_NOMBRE']."</td>
                        <td>".$fila['ACTA_MOTIVO']."</td>
                        <td>".$fila['ACTA_NRO']."</td>
                        <td>".$fila['INSPECTOR']."</td>
                        <td>".$fila['PROD_NOMBRE']."</td>
                        <td>".$fila['AAQX_UNIDAD']."</td>
                        <td>".number_format($fila['CANT_VERIF'],2,',','.')."</td>
                        <td>".$cantBajoWarrants."</td>
                        <td>".number_format($aforo,2,',','.')."</td>
                        <td>".$lista_warrant."</td>
                    </tr>
                ";
                
    }                    
                        

    
    return $codigo;
    
}
 

/** 
*
*/
function tabla_reporte_inspecciones_resumen($perfil, $filtroPerfilId=null, $desde=null, $hasta=null, $planta=null, $filtroDin=null)
{
    global $cnx;
    $codigo = "";
    $err = "";    // el error genera un return y mensaje en rojo.
    $filtroDep = "";
    
    $filtroFecha = "";    // filtra fecha desde y hasta
    if(!empty($desde) and !empty($hasta)){
        $filtroFecha = " WHERE ACTA_FECHA BETWEEN '$desde' AND '$hasta' ";
    }
    
    /** Preparo reportes según perfil de usuario // Cosidera Aforo diferenciado por usuario 
    *   Para eso creamos columna adicional y obtenemos aforo_usuario por diferencia con aforo adm.
    */
    if($perfil == "adm"){
        $filtro = "";
        $cantUsuario = "";
        
        
    }elseif($perfil == "clie" OR $perfil == "clie2"){
        $filtro = " AND t3.TITU_DEPO_ID = $filtroPerfilId ";
        $cantUsuario = ", COALESCE(SUM(IF(TITU_DEPO_ID = $filtroPerfilId, TITU_CANTIDAD,null)),0) AS CANT_W_USUARIO";

            
    }elseif($perfil == "seg"){
        $filtro = " AND (t3.POLI_RASO LIKE '%$filtroPerfilId%' OR t3.TITU_POLIZA_EXTRA like '$filtroPerfilId%')";
        $cantUsuario = ", COALESCE(SUM(IF(POLI_RASO LIKE '%".$filtroPerfilId."%', TITU_CANTIDAD,null)),0) AS CANT_W_USUARIO";

    
    }elseif($perfil == "clie1"){   
        $filtro         = " AND t3.TITU_ENDO_BENE_ID = $filtroPerfilId";
        $cantUsuario = ", COALESCE(SUM(IF(TITU_ENDO_BENE_ID = ".$filtroPerfilId.", TITU_CANTIDAD,0)),0) AS CANT_W_USUARIO";

    }


    /** Filtro PLANTAS */
    if(!empty($planta) AND $perfil !== "adm"){
        $filtro .= " AND PLAN_RASO = '$planta'";
    
    }elseif(!empty($planta) AND $perfil == "adm"){
        $filtro .= " AND PLAN_NOMBRE = '$planta'";
    }
    
    /** Filtro DINAMICO */
    if(!empty($filtroDin) AND ($perfil == "adm" OR $perfil == "seg")){
        $filtro = " AND t3.TITU_DEPO_ID = $filtroDin";
        $cantUsuario = ", COALESCE(SUM(IF(TITU_DEPO_ID = ".$filtroDin.", TITU_CANTIDAD,null)),0) AS CANT_W_USUARIO";
        $filtroDep = " AND TITU_DEPO_ID = '$filtroDin'"; //en este caso ya estaba con la coma.
    }
    
    
    $sql = "
        SELECT 
        * 
        FROM
            (SELECT 
            *
            FROM actas a
            INNER JOIN 
                (SELECT
                ACTA_PLANTA_ID as ID_PLANTA,
                MAX(ACTA_FECHA) AS ULT_ACTA
                FROM actas
                $filtroFecha 
                GROUP BY ACTA_PLANTA_ID
            ) b
        ON b.ID_PLANTA = a.ACTA_PLANTA_ID AND a.ACTA_FECHA = b.ULT_ACTA
        GROUP BY a.ACTA_PLANTA_ID
        ) t1

        LEFT JOIN 
            (SELECT 
            ALMA_PLAN_ID,
            AAQX_PRODUCTO_ID,
            AAQX_ACTA_NRO,
            SUM(AAQX_QX_INICIALES + AAQX_QX_RECIBIDAS - AAQX_QX_LIBERADAS) AS CANT_VERIF
            FROM almacenes INNER JOIN actas_almacenes_qx ON ALMA_ID = AAQX_ALMA_ID
            GROUP BY ALMA_PLAN_ID, AAQX_ACTA_NRO, AAQX_PRODUCTO_ID
            ) t2
        ON t1.ACTA_NRO = t2.AAQX_ACTA_NRO
        
        LEFT JOIN plantas ON t1.ACTA_PLANTA_ID = PLAN_ID 
        LEFT JOIN productos ON t2.AAQX_PRODUCTO_ID = PROD_ID
        
        LEFT JOIN 
            (SELECT  
            *,
            SUM(TITU_CANTIDAD) AS CANT_W
            $cantUsuario
            FROM titulos
            INNER JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
            WHERE TITU_FECHA_LIBERACION IS NULL
            GROUP BY TITU_PLANTA_ID, TITU_PRODUCTO
            )t3
        ON t1.ACTA_PLANTA_ID = t3.TITU_PLANTA_ID AND PROD_NOMBRE = t3.TITU_PRODUCTO 
            $filtro 
        
        WHERE CANT_VERIF > 0 OR CANT_W > 0
            ";
                
    
    

    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($result)){
                
        $aforo = $fila['CANT_VERIF']-$fila['CANT_W'];
        
        if($perfil == "adm"){
            if(empty($filtroDin)){
                $cantBajoWarrants = number_format($fila['CANT_W'],2,',','.');    
            }else{
                $cantBajoWarrants = number_format($fila['CANT_W_USUARIO'],2,',','.');
            } 
        }else{
            $cantBajoWarrants = number_format($fila['CANT_W_USUARIO'],2,',','.');
        }
       
       
        //CALCULO CANT DIAS DESDE LA ULTIMA INSPECCION.
        $hoy = strtotime('now');
        $acta = strtotime($fila['ULT_ACTA']);
        $dif = $hoy - $acta;
        $dias = $dif / 60 / 60 / 24; 
        $dias = abs($dias); //quito posible signo negativo
        $dias = floor($dias); // quito decimales
        
        //DEFINO COLOR DE BANDERA - SEGUN DIAS -
        if($dias < 8){
            $bandera = "style='background-color: green;'";
        
        }elseif($dias >= 8 AND $dias < 14){
            $bandera = "style='background-color: yellow;'";
            
        }elseif($dias >= 14 AND $dias < 21){
            $bandera = "style='background-color: orange;'";
            
        }elseif($dias >= 21){
            $bandera = "style='background-color: red;'";
            
        }
        
        
        $codigo .= "
                    <tr>
                        <td>".date('d-m-Y',strtotime($fila['ULT_ACTA']))."</td>
                        <td>".$dias."</td>
                        <td>".$fila['PLAN_RASO']."</td>
                        <td ".$bandera.">".$fila['PLAN_NOMBRE']."</td>
                        <td>".$fila['PROD_NOMBRE']."</td>
                        <td>".number_format($fila['CANT_VERIF'],2,',','.')."</td>
                        <td>".$cantBajoWarrants."</td>
                        <td>".number_format($aforo,2,',','.')."</td>
                        
                    </tr>
                ";
                
    }                    
    
    return $codigo;
    
}


/** 
*
*/

function tabla_reporte_almacenes($planta, $desde=null, $hasta=null)
{
    global $cnx;
    $codigo = "";
    $err = "";    // el error genera un return y mensaje en rojo.
    
    $filtroFecha = "";    // filtra fecha desde y hasta
    if(!empty($desde) and !empty($hasta)){
        $filtroFecha = " AND ACTA_FECHA BETWEEN '$desde' AND '$hasta'";
    }
     
    $sql = "SELECT 
            	ACTA_FECHA,
            	ALMA_PLAN_ID,
            	AAQX_ALMA_ID,
            	ALMA_NOMBRE_INT,
            	ALMA_TIPO,
            	PROD_NOMBRE,
                AAQX_UNIDAD,
            	SUM(AAQX_QX_RECIBIDAS) AS RECIBIDAS,
                SUM(AAQX_QX_LIBERADAS) AS LIBERADAS
            
            FROM actas
            INNER JOIN actas_almacenes_qx ON ACTA_NRO = AAQX_ACTA_NRO
            INNER JOIN productos ON AAQX_PRODUCTO_ID = PROD_ID
            INNER JOIN almacenes ON AAQX_ALMA_ID = ALMA_ID
            
            WHERE ALMA_PLAN_ID = $planta ".$filtroFecha."            
            
            GROUP BY ALMA_PLAN_ID, ALMA_ID
            ORDER BY ALMA_NOMBRE_INT ASC
            ";
                
    $result = mysqli_query($cnx, $sql);
    
    while($fila = mysqli_fetch_array($result)){
                
        $disponible = $fila['RECIBIDAS']-$fila['LIBERADAS'];
                
        $codigo .= "
                    <tr>
                        <td>".$fila['ALMA_NOMBRE_INT']."</td>
                        <td>".$fila['ALMA_TIPO']."</td>
                        <td>".$fila['PROD_NOMBRE']."</td>
                        <td>".$fila['AAQX_UNIDAD']."</td>
                        <td>".number_format($fila['RECIBIDAS'],2,',','.')."</td>
                        <td>".number_format($fila['LIBERADAS'],2,',','.')."</td>
                        <td>".number_format($disponible,2,',','.')."</td>
                        
                    </tr>
                ";
                
    }                    
    
    return $codigo;
    
}


/** 
 * Reporte de Vencimientos
*/
function venc_titulos($intervalo=1)
{
    global $cnx;
    $codigo = "";
    
    $sql = "SELECT 
            TITU_WCD_NR,
            TITU_VENC,
            DEPO_RASO
            
            FROM titulos
            INNER JOIN depositantes ON TITU_DEPO_ID = DEPO_ID
            WHERE TITU_FECHA_LIBERACION IS NULL
            AND TITU_VENC < (DATE_ADD(CURDATE(), INTERVAL $intervalo MONTH))
            ORDER BY TITU_VENC ASC";
    
    $result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));    
    $rows = mysqli_num_rows($result);
    
    if($rows > 0){
    
        while($fila = mysqli_fetch_array($result)){
            
            $codigo .= "<li><strong>Nro:</strong> ".$fila['TITU_WCD_NR'].", <strong>Venc:</strong> ".date('d-m-Y',strtotime($fila['TITU_VENC'])).", <strong>Depositante:</strong> ".$fila['DEPO_RASO']." </li>";        
        }
        
    }else{
        $codigo = "<li>No hay resultados</li>";
    }
    
    return $codigo; 

}

function venc_planta_comodato($intervalo=1)
{
    global $cnx;
    $codigo = "";
    
    $sql = "SELECT DISTINCT
            PLAN_NOMBRE,
            PLAN_VENC_COM
            
            FROM titulos 
            INNER JOIN plantas ON TITU_PLANTA_ID = PLAN_ID
            
            WHERE TITU_FECHA_LIBERACION IS NULL 
            AND PLAN_VENC_COM < (DATE_ADD(CURDATE(), INTERVAL $intervalo MONTH))
            ORDER BY PLAN_VENC_COM ASC";
    
    $result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));    
    $rows = mysqli_num_rows($result);
    
    if($rows > 0){
    
        while($fila = mysqli_fetch_array($result)){
            
            $codigo .= "<li><strong>Planta:</strong> ".$fila['PLAN_NOMBRE'].", <strong>Venc:</strong> ".date('d-m-Y',strtotime($fila['PLAN_VENC_COM']))."</li>";        
        }
        
    }else{
        $codigo = "<li>No hay resultados</li>";
    }
    
    return $codigo; 

}

function venc_planta_seguro($intervalo=1)
{
    global $cnx;
    $codigo = "";
    
    $sql = "SELECT DISTINCT
            PLAN_NOMBRE,
            PLAN_VENC_POLIZA
            
            FROM titulos 
            INNER JOIN plantas ON TITU_PLANTA_ID = PLAN_ID
            
            WHERE TITU_FECHA_LIBERACION IS NULL 
            AND PLAN_VENC_POLIZA < (DATE_ADD(CURDATE(), INTERVAL $intervalo MONTH))
            ORDER BY PLAN_VENC_POLIZA ASC";
    
    $result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));    
    $rows = mysqli_num_rows($result);
    
    if($rows > 0){
    
        while($fila = mysqli_fetch_array($result)){
            
            $codigo .= "<li><strong>Planta:</strong> ".$fila['PLAN_NOMBRE'].", <strong>Venc:</strong> ".date('d-m-Y',strtotime($fila['PLAN_VENC_POLIZA']))."</li>";        
        }
        
    }else{
        $codigo = "<li>No hay resultados</li>";
    }
    
    return $codigo; 

}


function venc_seguro_tro($intervalo=1)
{
    global $cnx;
    $codigo = "";
    
    $sql = "SELECT DISTINCT
            POLI_POLIZA_NRO,
            POLI_RASO,
            POLI_VENC
            
            FROM titulos
            inner JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
            
            WHERE TITU_FECHA_LIBERACION IS NULL 
            AND POLI_VENC < (DATE_ADD(CURDATE(), INTERVAL $intervalo MONTH))
            ORDER BY POLI_VENC ASC";
    
    $result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));    
    $rows = mysqli_num_rows($result);
    
    if($rows > 0){
    
        while($fila = mysqli_fetch_array($result)){
            
            $codigo .= "<li><strong>Póliza Nro:</strong> ".$fila['POLI_POLIZA_NRO'].", <strong>Venc:</strong> ".date('d-m-Y',strtotime($fila['POLI_VENC'])).", <strong>Cía.:</strong> ".$fila['POLI_RASO']."</li>";        
        }
        
    }else{
        $codigo = "<li>No hay resultados</li>";
    }
    
    return $codigo; 

}


function alerta_inspecciones($intervalo=10)
{
    global $cnx;
    $codigo = "";
    
    $sql = "SELECT 
            a.PLAN_NOMBRE,
            a.ULT_ACTA,
            GROUP_CONCAT(TITU_WCD_NR ORDER BY TITU_WCD_NR ASC SEPARATOR ' - ') AS TITULOS
            
            FROM titulos
            INNER JOIN (
            SELECT 
            ACTA_PLANTA_ID,
            MAX(ACTA_FECHA) AS ULT_ACTA,
            PLAN_ID,
            PLAN_NOMBRE
             FROM actas
            INNER JOIN plantas
            ON ACTA_PLANTA_ID = PLAN_ID
            GROUP BY PLAN_NOMBRE
            ) a
            ON TITU_PLANTA_ID = a.ACTA_PLANTA_ID
            
            WHERE TITU_FECHA_LIBERACION IS NULL
            
            GROUP BY a.PLAN_NOMBRE
            HAVING DATE_ADD(a.ULT_ACTA,INTERVAL $intervalo DAY) < CURDATE() 
            ";
    
    $result = mysqli_query($cnx,$sql) or die(mysqli_error($cnx));    
    $rows = mysqli_num_rows($result);
    
    if($rows > 0){
    
        while($fila = mysqli_fetch_array($result)){
            
            $codigo .= "<li><strong>Planta:</strong> ".$fila['PLAN_NOMBRE'].", <strong>Última inspección:</strong> ".date('d-m-Y',strtotime($fila['ULT_ACTA'])).", <strong>Títulos:</strong> ".$fila['TITULOS']."</li>";        
        }
        
    }else{
        $codigo = "<li>No se registran atrasos en las inspecciones.</li>";
    }
    
    return $codigo; 

}



/** 
* REPORTE SECRETARIA .
* DEBE GENERAR 4 TABLAS: Vigentes US$ , Vigentes AR$, Emisiones US$, Emisiones AR$
* Filtros: por rango de fechas, desde / hasta. 
*  
*/

function tabla_reporte_secretaria_vigentes($desde, $hasta, $moneda)
{
    global $cnx;
    $codigo = "";
    $err = "";    // el error genera un return y mensaje en rojo.
    
    $vigentes = "select 
                        TITU_WCD_NR,
                        TITU_PRODUCTO,
                        TITU_UNIDAD,
                        TITU_CANTIDAD,
                        TITU_VALOR_W,
                        TITU_MONEDA,
                        TITU_FECHA_EMISION,
                        TITU_VENC,
                        PLAN_DOMICILIO,
                        LOCA_NOMBRE,
                        PROV_NOMBRE,
                        TITU_TIPO_W
                        
                    FROM titulos
                    INNER JOIN (SELECT * FROM plantas 
            						INNER JOIN provincias 
            						ON PLAN_PROV_ID = PROV_ID
            						INNER JOIN localidades
            						ON PLAN_LOCA_ID = LOCA_ID
                    ) p
                    
                    ON TITU_PLANTA_ID = PLAN_ID
                    
                    WHERE TITU_ESTADO <> 'A'
                    AND TITU_FECHA_EMISION <= '$hasta' AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION >= '$hasta')
                    AND TITU_MONEDA = '$moneda'
                    ";
    
    

    $resut = mysqli_query($cnx, $vigentes) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($resut)){
        
        if($fila['TITU_TIPO_W'] == "CMA"){
            $tipo = "Financiero";
        }else{
            $tipo = "Comercial";
        }
        
              
        $codigo .= "
        <tr>
            <td>".$fila['TITU_WCD_NR']."</td>
            <td>".$fila['TITU_PRODUCTO']."</td>
            <td>".$fila['TITU_UNIDAD']."</td>
            <td>".number_format($fila['TITU_CANTIDAD'],2,",",".")."</td>
            <td>".number_format($fila['TITU_VALOR_W'],2,",",".")."</td>
            <td>".$fila['TITU_MONEDA']."</td>
            <td>".$fila['TITU_FECHA_EMISION']."</td>
            <td>".$fila['TITU_VENC']."</td>
            <td>".$fila['PLAN_DOMICILIO']."</td>
            <td>".$fila['LOCA_NOMBRE']."</td>
            <td>".$fila['PROV_NOMBRE']."</td>
            <td>".$tipo."</td>

        </tr>
        ";
        
    }
    
    return $codigo;
    
}


function tabla_reporte_secretaria_emitidos($desde, $hasta, $moneda)
{
    global $cnx;
    $codigo = "";
    $err = "";    // el error genera un return y mensaje en rojo.
    
    $emitidos = "select 
                        TITU_WCD_NR,
                        TITU_PRODUCTO,
                        TITU_UNIDAD,
                        TITU_CANTIDAD,
                        TITU_VALOR_W,
                        TITU_MONEDA,
                        TITU_FECHA_EMISION,
                        TITU_VENC,
                        PLAN_DOMICILIO,
                        LOCA_NOMBRE,
                        PROV_NOMBRE,
                        TITU_TIPO_W
                        
                    FROM titulos
                    INNER JOIN (SELECT * FROM plantas 
            						INNER JOIN provincias 
            						ON PLAN_PROV_ID = PROV_ID
            						INNER JOIN localidades
            						ON PLAN_LOCA_ID = LOCA_ID
                    ) p
                    
                    ON TITU_PLANTA_ID = PLAN_ID
                    
                    WHERE TITU_ESTADO <> 'A'
                    AND TITU_FECHA_EMISION >= '$desde' AND TITU_FECHA_EMISION <= '$hasta'

                    AND TITU_MONEDA = '$moneda'
                    ";
    
    

    $resut = mysqli_query($cnx, $emitidos) or die(mysqli_error($cnx));
    
    while($fila = mysqli_fetch_array($resut)){
        
        if($fila['TITU_TIPO_W'] == "CMA"){
            $tipo = "Financiero";
        }else{
            $tipo = "Comercial";
        }
        
              
        $codigo .= "
        <tr>
            <td>".$fila['TITU_WCD_NR']."</td>
            <td>".$fila['TITU_PRODUCTO']."</td>
            <td>".$fila['TITU_UNIDAD']."</td>
            <td>".number_format($fila['TITU_CANTIDAD'],2,",",".")."</td>
            <td>".number_format($fila['TITU_VALOR_W'],2,",",".")."</td>
            <td>".$fila['TITU_MONEDA']."</td>
            <td>".$fila['TITU_FECHA_EMISION']."</td>
            <td>".$fila['TITU_VENC']."</td>
            <td>".$fila['PLAN_DOMICILIO']."</td>
            <td>".$fila['LOCA_NOMBRE']."</td>
            <td>".$fila['PROV_NOMBRE']."</td>
            <td>".$tipo."</td>

        </tr>
        ";
        
    }
    
    return $codigo;
    
}





/** Funciones para Tipo de Cambio */

function tc()
{
    global $cnx;
    $tc = array('fecha','tc');
    $result = mysqli_query($cnx, "SELECT * FROM tc ORDER BY TC_FECHA DESC LIMIT 1") or die(mysqli_error($cnx));
    
    
    while($ult_tc = mysqli_fetch_array($result)){
        $tc['fecha'] = $ult_tc['TC_FECHA'];
        $tc['tc'] = $ult_tc['TC_VALOR'];
    }
    
    return $tc;
}

function tc_new($tc, $fecha=null)
{
    global $cnx;
    $nuevo_tc = mysqli_real_escape_string($cnx,$tc);
    $nuevo_tc = str_replace(",",".",$nuevo_tc);
    
    mysqli_query($cnx, "INSERT INTO tc (TC_FECHA, TC_VALOR) VALUES  (NOW(), '$nuevo_tc')") or die(mysqli_error($cnx));
    
}

/** Al buscar reportes del pasado con filtros desde/hasta, la función nos trae el TC más cercano a la fecha "hasta" */
function tc_busca_tc_historico($hasta)
{
    global $cnx;
    
    $sql = "
    select *
    from tc
    ORDER BY ABS(DATEDIFF(TC_FECHA, '$hasta')) LIMIT 1
    ";
    
    $result = mysqli_query($cnx,$sql);
    $tc = mysqli_fetch_array($result);
    $tc = $tc['TC_VALOR'];
    
    return $tc;
}


/** facturacion - ver si hay facturas del depositante en el periodo seleccionado */

function facturacion_buscar_fc_periodo_depositante($desde, $hasta)
{
    global $cnx;    
    $estado = null;
    
    $sql = "
    select 
        d.DEPO_ID        
    from depositantes d
    INNER JOIN facturacion f ON DEPO_ID = FACT_DEPO_ID
    where FACT_DESDE = '$desde' AND FACT_HASTA = '$hasta'
    ";
    
    $result = mysqli_query($cnx,$sql);
  
    
    while($fila = mysqli_fetch_array($result)){
        
        $estado[] = $fila['DEPO_ID'];
        
    }
    
    return $estado;
}


/** Listado Facturas emitidas */
function facturacion_listado_facturas()
{
    global $cnx;
    
    $sql = "
    SELECT
    	CONCAT(FACT_TIPO,FACT_PTOVTA,'-',FACT_NRO) AS FACTURA,
    	FACT_FECHA,
    	DEPO_RASO,
    	CONCAT(FACT_DESDE, ' al ', FACT_HASTA) AS PERIODO,
    	FACT_TOTAL,
    	FACT_COMENT,
    	FACT_ESTADO,
    	FACT_ID
    
    FROM
        facturacion
    INNER JOIN depositantes ON FACT_DEPO_ID = DEPO_ID
    ORDER BY FACT_NRO DESC
    ";
    
    
    $result = mysqli_query($cnx,$sql);
    
    return $result;
}

/** DETALLE DE FACTURA GUARDADA */
function facturacion_detalle_factura($id)
{
    global $cnx;
    
    $id = trim(mysqli_real_escape_string($cnx,$id));
    
    $sql = "
        SELECT
        	CONCAT(FACT_TIPO,FACT_PTOVTA,'-',FACT_NRO) AS FACTURA,
        	DEPO_RASO,
        	facturacion.*
        
        FROM        
            facturacion
        INNER JOIN depositantes ON FACT_DEPO_ID = DEPO_ID
        WHERE FACT_ID = $id
    ";
    
    
    $result = mysqli_query($cnx,$sql);
    
    $detalle = mysqli_fetch_array($result);
    
    return $detalle;
}

/** Buscamos el último número de factura en el PtoVta 2 */
function facturacion_buscar_ultima_factura()
{
    global $cnx;
    
    $sql = "select 
            MAX(FACT_NRO) as NRO
            from facturacion
            where FACT_PTOVTA = 2";
    
    $result= mysqli_query($cnx,$sql);
    $ult_fc = mysqli_fetch_array($result);
    $ult_fc = $ult_fc['NRO']+1;
    
    return $ult_fc;
}


/** Retorna array resultados. Totales por cliente (depositante). No refleja aplicación de tarifas mínimas  */
function facturacion_tabla_total_por_cliente($desde,$hasta)
{
    global $cnx;
    
    $sql = "
        SELECT 
        	DEPO_ID,
        	DEPO_RASO,
        	TITU_MONEDA,
        	SUM(EMISION) AS EMISION,
        	SUM(SEGURO) AS SEGURO,
        	SUM(TOTAL) AS TOTAL
        
        FROM
        (select 
        	d.DEPO_ID,
        	DEPO_RASO, 
        	t.TITU_MONEDA,
        	
        -- canT dias vigente para facturar 
        	IF(TITU_OPERACION = 'Renovación' AND TITU_FECHA_EMISION BETWEEN	'$desde' AND '$hasta',
        			(CASE 
        					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
        					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)
        					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, '$desde')
        					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, TITU_FECHA_EMISION)
        					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
        					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)
        			END), -- ELSE, Operacion NUEVO
        			(CASE 
        					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
        					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)+1
        					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, '$desde')+1
        					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, TITU_FECHA_EMISION)+1
        					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
        					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)+1
        			END)
        	) AS DIAS,
        	POLI_PROPIA,
        	(t.TITU_VALOR_W * (SELECT TARI_EMISION) * (SELECT DIAS) /180) as EMISION,
        	IF((SELECT POLI_PROPIA) = 'SI', (t.TITU_VALOR_W * (SELECT TARI_SEGURO) * (SELECT DIAS) /180), '0') as SEGURO,
        	(SELECT EMISION) + (SELECT SEGURO) AS TOTAL,
        	TARI_MIN
        	
        	
        FROM titulos t
        
        INNER JOIN depositantes d ON TITU_DEPO_ID = d.DEPO_ID
        LEFT OUTER JOIN beneficiarios ON TITU_ENDO_BENE_ID = BENE_ID
        LEFT OUTER JOIN (plantas  
        	LEFT OUTER JOIN provincias ON PLAN_PROV_ID = PROV_ID
        	LEFT OUTER JOIN localidades ON PLAN_LOCA_ID = LOCA_ID
        )ON TITU_PLANTA_ID = PLAN_ID
        LEFT OUTER JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
        
        LEFT OUTER JOIN (
        		select 
        			d2.DEPO_ID,
        			TARI_EMISION/100 AS TARI_EMISION,
        			TARI_SEGURO/100 AS TARI_SEGURO,
        			t2.TITU_MONEDA,
        			SUM(TITU_VALOR_W) AS VALOR_VIGENTE,
        			SUM(TITU_CANTIDAD) AS CANT_VIGENTE,
        			TARI_UNIDAD,
        			TARI_MIN,
        			TARI_DESDE,
        			TARI_HASTA
        		FROM depositantes d2 
        		INNER JOIN titulos t2 ON d2.DEPO_ID = TITU_DEPO_ID
        			AND TITU_FECHA_EMISION <= '$hasta' AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION > '$hasta') -- or TITU_FECHA_LIBERACION between '$desde' AND '$hasta')
        			AND TITU_ESTADO != 'A'
        		LEFT OUTER JOIN tarifas ON d2.DEPO_ID = TARI_DEPO_ID
        		
        		GROUP BY d2.DEPO_ID, t2.TITU_MONEDA, TARI_ID
        		HAVING IF(TARI_UNIDAD = 'Toneladas', CANT_VIGENTE BETWEEN TARI_DESDE AND TARI_HASTA, VALOR_VIGENTE BETWEEN TARI_DESDE AND TARI_HASTA)
        	) as taris
        ON TITU_DEPO_ID = taris.DEPO_ID
        
        WHERE TITU_FECHA_EMISION <= '$hasta' 
        			AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION >= '$hasta'or TITU_FECHA_LIBERACION between '$desde' AND '$hasta')
        			AND TITU_ESTADO != 'A'
        			-- AND TITU_DEPO_ID = 15
        
        ) as pivot
        
        GROUP BY DEPO_RASO
    ";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    return $result;
}

/** Detalle totales cliente con apertura a nivel planta nombre interno   */
function facturacion_tabla_detalle_cliente($depo_id,$desde,$hasta)
{
    global $cnx;
    
    $sql = "
SELECT 
PLAN_RASO,
PLAN_NOMBRE,
PROV_NOMBRE,
TITU_MONEDA,
SUM(EMISION) AS EMISION,
SUM(SEGURO) AS SEGURO,
SUM(SUBTOTAL) AS SUBTOTAL,
IF(SUM(SUBTOTAL) < TARI_MIN, TARI_MIN, SUM(SUBTOTAL)) AS TOTAL,
VALOR_VIGENTE,
CANT_VIGENTE,
TARI_EMISION,
TARI_SEGURO,
TARI_MIN,
TARI_UNIDAD

FROM
(select 
	PLAN_RASO, 
	PLAN_NOMBRE,	
	t.TITU_MONEDA,
	PROV_NOMBRE, 
	
-- canT dias vigente para facturar 
	IF(TITU_OPERACION = 'Renovación' AND TITU_FECHA_EMISION BETWEEN	'$desde' AND '$hasta',
			(CASE 
					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)
					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, '$desde')
					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, TITU_FECHA_EMISION)
					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)
			END), -- ELSE, Operacion NUEVO
			(CASE 
					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
					WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)+1
					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, '$desde')+1
					WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, TITU_FECHA_EMISION)+1
					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
					WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)+1
			END)
	) AS DIAS,
	POLI_PROPIA,
	ROUND((t.TITU_VALOR_W * (SELECT TARI_EMISION) * (SELECT DIAS) /180),2) as EMISION,
	IF((SELECT POLI_PROPIA) = 'SI', ROUND((t.TITU_VALOR_W * (SELECT TARI_SEGURO) * (SELECT DIAS) /180),2), '0') as SEGURO,
	(SELECT EMISION) + (SELECT SEGURO) AS SUBTOTAL,
	TARI_MIN,
	VALOR_VIGENTE,
	CANT_VIGENTE,
	TARI_EMISION,
  TARI_SEGURO,
	TARI_UNIDAD
	
	
FROM titulos t

INNER JOIN depositantes d ON TITU_DEPO_ID = d.DEPO_ID
LEFT OUTER JOIN beneficiarios ON TITU_ENDO_BENE_ID = BENE_ID
LEFT OUTER JOIN (plantas  
	LEFT OUTER JOIN provincias ON PLAN_PROV_ID = PROV_ID
	LEFT OUTER JOIN localidades ON PLAN_LOCA_ID = LOCA_ID
)ON TITU_PLANTA_ID = PLAN_ID
LEFT OUTER JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO

LEFT OUTER JOIN (
		select 
			d2.DEPO_ID,
			TARI_EMISION/100 AS TARI_EMISION,
			TARI_SEGURO/100 AS TARI_SEGURO,
			t2.TITU_MONEDA,
			SUM(TITU_VALOR_W) AS VALOR_VIGENTE,
			SUM(TITU_CANTIDAD) AS CANT_VIGENTE,
			TARI_UNIDAD,
			TARI_MIN,
			TARI_DESDE,
			TARI_HASTA
		FROM depositantes d2 
		INNER JOIN titulos t2 ON d2.DEPO_ID = TITU_DEPO_ID
			AND TITU_FECHA_EMISION <= '$hasta' AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION > '$hasta' or TITU_FECHA_LIBERACION between '2017-03-01' AND '2017-03-31')
			AND TITU_ESTADO != 'A'
		LEFT OUTER JOIN tarifas ON d2.DEPO_ID = TARI_DEPO_ID
		
		GROUP BY d2.DEPO_ID, t2.TITU_MONEDA, TARI_ID
		HAVING IF(TARI_UNIDAD = 'Toneladas', CANT_VIGENTE BETWEEN TARI_DESDE AND TARI_HASTA, VALOR_VIGENTE BETWEEN TARI_DESDE AND TARI_HASTA)
	) as taris
ON TITU_DEPO_ID = taris.DEPO_ID

WHERE TITU_FECHA_EMISION <= '$hasta' 
			AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION >= '$hasta'or TITU_FECHA_LIBERACION between '$desde' AND '$hasta')
			AND TITU_ESTADO != 'A'
			AND TITU_DEPO_ID = '$depo_id'
) as pivot

GROUP BY PLAN_NOMBRE 


    ";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    return $result;
}

/** Detalle warrants que se facturan     */
function facturacion_tabla_detalle_cliente_warrants($depo_id,$desde,$hasta)
{
    global $cnx;
    
    $sql = "
    select 
    	TITU_WCD_NR,
    	TITU_OPERACION,
    	TITU_RENOVADO,
    	TITU_ESTADO,
    	PLAN_RASO, 
    	DEPO_RASO,
    	TITU_FECHA_EMISION,
    	TITU_PLAZO,
    	TITU_VENC,
    	TITU_FECHA_LIBERACION,
    	TITU_PRODUCTO,
    	TITU_UNIDAD,
    	TITU_CANTIDAD,
    	t.TITU_MONEDA,
    	TITU_PRECIO_U,
    	TITU_VALOR_W,
    	PLAN_NOMBRE, 
    	PLAN_DOMICILIO, 
    	LOCA_NOMBRE, 
    	PROV_NOMBRE, 
    	POLI_RASO, 
    	POLI_VENC,
    	TITU_TIPO_W,
    	BENE_RASO,
        -- can dias vigente para facturar 
    	IF(TITU_OPERACION = 'Renovación' AND TITU_FECHA_EMISION BETWEEN	'$desde' AND '$hasta',
    		(CASE 
    			WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
    			WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)
    			WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, '$desde')
    			WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, TITU_FECHA_EMISION)
    			WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')
    			WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)
    		END), -- ELSE, Operacion NUEVO
    		(CASE 
				WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
				WHEN TITU_FECHA_LIBERACION IS NULL AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)+1
				WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, '$desde')+1
				WHEN TITU_FECHA_LIBERACION <= '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF(TITU_FECHA_LIBERACION, TITU_FECHA_EMISION)+1
				WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION < '$desde' THEN DATEDIFF('$hasta', '$desde')+1
				WHEN TITU_FECHA_LIBERACION > '$hasta' AND TITU_FECHA_EMISION >= '$desde' THEN DATEDIFF('$hasta', TITU_FECHA_EMISION)+1
    		END)
    	) AS DIAS,
    	POLI_PROPIA,
    	(t.TITU_VALOR_W * (SELECT TARI_EMISION) * (SELECT DIAS) /180) as EMISION,
    	IF((SELECT POLI_PROPIA) = 'SI', (t.TITU_VALOR_W * (SELECT TARI_SEGURO) * (SELECT DIAS) /180) , '0') as SEGURO,
    	(SELECT EMISION) + (SELECT SEGURO) AS TOTAL,
    	taris.*
    	
    FROM titulos t
    
    INNER JOIN depositantes d ON TITU_DEPO_ID = d.DEPO_ID
    LEFT OUTER JOIN beneficiarios ON TITU_ENDO_BENE_ID = BENE_ID
    LEFT OUTER JOIN (plantas  
    	LEFT OUTER JOIN provincias ON PLAN_PROV_ID = PROV_ID
    	LEFT OUTER JOIN localidades ON PLAN_LOCA_ID = LOCA_ID
    )ON TITU_PLANTA_ID = PLAN_ID
    LEFT OUTER JOIN polizas ON TITU_POLIZA_NRO = POLI_POLIZA_NRO
    LEFT OUTER JOIN 
    (
        select 
        	d2.DEPO_ID,
        	TARI_EMISION/100 AS TARI_EMISION,
        	TARI_SEGURO/100 AS TARI_SEGURO,
        	t2.TITU_MONEDA,
        	SUM(TITU_VALOR_W) AS VALOR_VIGENTE,
        	SUM(TITU_CANTIDAD) AS CANT_VIGENTE,
        	TARI_UNIDAD,
        	TARI_MIN,
        	TARI_DESDE,
        	TARI_HASTA
        FROM depositantes d2 
        INNER JOIN titulos t2 ON d2.DEPO_ID = TITU_DEPO_ID
        	AND TITU_FECHA_EMISION <= '$hasta' AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION > '$hasta' or TITU_FECHA_LIBERACION between '$desde' AND '$hasta')
        	AND TITU_ESTADO != 'A'
        LEFT OUTER JOIN tarifas ON d2.DEPO_ID = TARI_DEPO_ID
        
        GROUP BY d2.DEPO_ID, t2.TITU_MONEDA, TARI_ID
        HAVING IF(TARI_UNIDAD = 'Toneladas', CANT_VIGENTE BETWEEN TARI_DESDE AND TARI_HASTA, VALOR_VIGENTE BETWEEN TARI_DESDE AND TARI_HASTA)
    ) as taris
    
    ON TITU_DEPO_ID = taris.DEPO_ID

    WHERE TITU_FECHA_EMISION <= '$hasta' 
    			AND (TITU_FECHA_LIBERACION IS NULL or TITU_FECHA_LIBERACION >= '$hasta'or TITU_FECHA_LIBERACION between '$desde' AND '$hasta')
    			AND TITU_ESTADO != 'A'
    			AND TITU_DEPO_ID = $depo_id
    ";
    
    $result = mysqli_query($cnx, $sql) or die(mysqli_error($cnx));
    
    return $result;
}



?>