<?php
//BindEvents Method @1-9E1E9678
function BindEvents()
{
    global $insumos;
    global $CCSEvents;
    $insumos->insumos_TotalRecords->CCSEvents["BeforeShow"] = "insumos_insumos_TotalRecords_BeforeShow";
    $insumos->estado->CCSEvents["BeforeShow"] = "insumos_estado_BeforeShow";
    $insumos->total_ingreso->CCSEvents["BeforeShow"] = "insumos_total_ingreso_BeforeShow";
    $insumos->alt_estado->CCSEvents["BeforeShow"] = "insumos_alt_estado_BeforeShow";
    $insumos->alt_total_ingreso->CCSEvents["BeforeShow"] = "insumos_alt_total_ingreso_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//insumos_insumos_TotalRecords_BeforeShow @8-6536C8CB
function insumos_insumos_TotalRecords_BeforeShow(& $sender)
{
    $insumos_insumos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_insumos_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close insumos_insumos_TotalRecords_BeforeShow @8-57BED996
    return $insumos_insumos_TotalRecords_BeforeShow;
}
//End Close insumos_insumos_TotalRecords_BeforeShow

//insumos_estado_BeforeShow @36-32E2B0E0
function insumos_estado_BeforeShow(& $sender)
{
    $insumos_estado_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_estado_BeforeShow

//Custom Code @38-6F502BC2
// -------------------------
    global $insumos;
	global $DBDatos;

	$insumo_id = $insumos->insumo_id->GetValue();
    $total_bodega = total_bodega($insumo_id);
	$total_solicitado = total_solicitado($insumo_id);
	$total_stock = $total_bodega - $total_solicitado;
	$test_id = CCGetParam("s_test_id","");
	if($test_id!=""){
		$cant_usada = CCGetDBValue("SELECT cantidad_x_test FROM insumos_x_test WHERE test_id='$test_id' AND insumo_id='$insumo_id'",$DBDatos);
		$total=$total_stock-$cant_usada;
		$insumos->total_stock->SetValue("<table width='100%' border='0' cellpadding='0' cellspacing='0'>
											<tr>
												<td align='left' width=''><b>Hay:</b></td>
												<td align='left'>$total_stock</td>
											</tr>
											<tr>
												<td align='left' width=''><b>Usa:</b></td>
												<td align='left'>$cant_usada</td>
											</tr>
											<tr>
												<td align='left' width=''><b>Quedan:</b></td>
												<td align='left'>$total</td>
											</tr>
										</table>");
	}
	else{
		$insumos->total_stock->SetValue($total_stock);
	}

	$insumos->total_ingreso->SetValue($total_bodega);
	$insumos->total_salida->SetValue($total_solicitado);

	$stock_min = $insumos->stock_min->GetValue();
	$stock_max = $insumos->stock_max->GetValue();
	
	if($total_stock >= $stock_min and $total_stock <= $stock_max){
		$insumos->estado->SetValue("<img src='images/led_verde.gif' alt='OK'>");
	}
	elseif($total_stock >= $stock_min and $total_stock >= $stock_max){
		$insumos->estado->SetValue("<img src='images/led_amarillo.gif' alt='SOBRE STOCK'>");
	}
	elseif($total_stock <= $stock_min and $total_stock <= $stock_max){
		$insumos->estado->SetValue("<img src='images/led_rojo.gif' alt='STOCK INSUFICIENTE'>");
	}

// -------------------------
//End Custom Code

//Close insumos_estado_BeforeShow @36-14EDE109
    return $insumos_estado_BeforeShow;
}
//End Close insumos_estado_BeforeShow

//insumos_total_ingreso_BeforeShow @28-84D773D4
function insumos_total_ingreso_BeforeShow(& $sender)
{
    $insumos_total_ingreso_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_total_ingreso_BeforeShow

//Custom Code @31-6F502BC2
// -------------------------
    global $insumos;
// -------------------------
//End Custom Code

//Close insumos_total_ingreso_BeforeShow @28-553E897B
    return $insumos_total_ingreso_BeforeShow;
}
//End Close insumos_total_ingreso_BeforeShow

//insumos_alt_estado_BeforeShow @37-F429180E
function insumos_alt_estado_BeforeShow(& $sender)
{
    $insumos_alt_estado_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_alt_estado_BeforeShow

//Custom Code @39-6F502BC2
// -------------------------
    global $insumos;
	global $DBDatos;
	$insumo_id = $insumos->Alt_insumo_id->GetValue();
    $total_bodega = total_bodega($insumo_id);
	$total_solicitado = total_solicitado($insumo_id);
	$total_stock = $total_bodega - $total_solicitado;

	$test_id = CCGetParam("s_test_id","");
	if($test_id!=""){
		$cant_usada = CCGetDBValue("SELECT cantidad_x_test FROM insumos_x_test WHERE test_id='$test_id' AND insumo_id='$insumo_id'",$DBDatos);
		$total=$total_stock-$cant_usada;
		$insumos->alt_total_stock->SetValue("<table width='100%' border='0' cellpadding='0' cellspacing='0'>
											<tr>
												<td align='left' width=''><b>Hay:</b></td>
												<td align='left'>$total_stock</td>
											</tr>
											<tr>
												<td align='left' width=''><b>Usa:</b></td>
												<td align='left'>$cant_usada</td>
											</tr>
											<tr>
												<td align='left' width=''><b>Quedan:</b></td>
												<td align='left'>$total</td>
											</tr>
										</table>");
	}
	else{
		$insumos->alt_total_stock->SetValue($total_stock);
	}


	$insumos->alt_total_ingreso->SetValue($total_bodega);
	$insumos->alt_total_salida->SetValue($total_solicitado);

	$stock_min = $insumos->Alt_stock_min->GetValue();
	$stock_max = $insumos->Alt_stock_max->GetValue();
	
	if($total_stock >= $stock_min and $total_stock <= $stock_max){
		$insumos->alt_estado->SetValue("<img src='images/led_verde.gif' alt='OK'>");
	}
	elseif($total_stock >= $stock_min and $total_stock >= $stock_max){
		$insumos->alt_estado->SetValue("<img src='images/led_amarillo.gif' alt='SOBRE STOCK'>");
	}
	elseif($total_stock <= $stock_min and $total_stock <= $stock_max){
		$insumos->alt_estado->SetValue("<img src='images/led_rojo.gif' alt='STOCK INSUFICIENTE'>");
	}

// -------------------------
//End Custom Code

//Close insumos_alt_estado_BeforeShow @37-4610E0F4
    return $insumos_alt_estado_BeforeShow;
}
//End Close insumos_alt_estado_BeforeShow

//insumos_alt_total_ingreso_BeforeShow @32-D192D875
function insumos_alt_total_ingreso_BeforeShow(& $sender)
{
    $insumos_alt_total_ingreso_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_alt_total_ingreso_BeforeShow

//Custom Code @35-6F502BC2
// -------------------------
    global $insumos;
// -------------------------
//End Custom Code

//Close insumos_alt_total_ingreso_BeforeShow @32-4A6B5202
    return $insumos_alt_total_ingreso_BeforeShow;
}
//End Close insumos_alt_total_ingreso_BeforeShow

//Page_BeforeOutput @1-877983CA
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ver_stock_bodega; //Compatibility
//End Page_BeforeOutput

//Custom Code @65-2A29BDB7
// -------------------------
    // Write your own code here.

	global $main_block;

	CorrigeCodigo($main_block);


// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

function total_bodega($insumo){
	global $DBDatos;
	global $insumos;
	$db = new clsDBDatos();
	$sql_sumar = "SELECT SUM(cantidad) AS total_bodega FROM insumos_ingreso WHERE insumo_id='$insumo'";
	$db->query($sql_sumar);
	$total=($db->next_record()) ? $db->f("total_bodega"): 0;
	return $total;
	unset($db);
}
function total_solicitado($insumo_id){
	global $DBDatos;
	//primero selecciono todos los test que usan ese insumo
	//luego cuento cuantos test se han solicitado que usen este insumo
	$db = new clsDBDatos();
	$db_2 = new clsDBDatos();

	$sql = "SELECT test_id, cantidad_x_test FROM insumos_x_test WHERE insumo_id='$insumo_id'";
	$db->query($sql);
	while($db->next_record()){		
		$sql_2 = "SELECT COUNT(*) AS total_test_solicitados FROM peticiones_detalle WHERE test_id='".$db->f("test_id")."'";
		$db_2->query($sql_2);
		if($db_2->next_record()){
			$cant_test_solicitados = $db_2->f("total_test_solicitados");
			$cant_insumo_test = $db->f("cantidad_x_test");
			$total_usado += intval($cant_test_solicitados * $cant_insumo_test);	
		}	
	}
	unset($db_2);
	unset($db);
	return $total_usado;
}

?>
