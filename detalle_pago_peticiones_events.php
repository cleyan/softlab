<?php
//BindEvents Method @1-B2EBC573
function BindEvents()
{
    global $peticiones_estados_pagosSearch;
    global $pacientes;
    global $peticiones_estados_pagos;
    global $CCSEvents;
    $peticiones_estados_pagosSearch->CCSEvents["BeforeShow"] = "peticiones_estados_pagosSearch_BeforeShow";
    $pacientes->CCSEvents["BeforeShow"] = "pacientes_BeforeShow";
    $peticiones_estados_pagos->peticiones_estados_pagos_TotalRecords->CCSEvents["BeforeShow"] = "peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_estados_pagosSearch_BeforeShow @139-E234F270
function peticiones_estados_pagosSearch_BeforeShow(& $sender)
{
    $peticiones_estados_pagosSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_estados_pagosSearch; //Compatibility
//End peticiones_estados_pagosSearch_BeforeShow

//Custom Code @191-83F8650C
// -------------------------
    global $peticiones_estados_pagosSearch;
    // Write your own code here.

	$paciente_id=CCGetParam("paciente_id","");

	if ($paciente_id != "") {
		$peticiones_estados_pagosSearch->Visible=False;
	} else {
		$peticiones_estados_pagosSearch->Visible=True;
	}

// -------------------------
//End Custom Code

//Close peticiones_estados_pagosSearch_BeforeShow @139-33A8A3D2
    return $peticiones_estados_pagosSearch_BeforeShow;
}
//End Close peticiones_estados_pagosSearch_BeforeShow

//pacientes_BeforeShow @181-49063E02
function pacientes_BeforeShow(& $sender)
{
    $pacientes_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_BeforeShow

//Custom Code @190-B5B910A1
// -------------------------
    global $pacientes;
    // Write your own code here.

	$paciente_id=CCGetParam("paciente_id","");

	if ($paciente_id != "") {
		$pacientes->Visible=True;
	} else {
		$pacientes->Visible=False;
	}

// -------------------------
//End Custom Code

//Close pacientes_BeforeShow @181-86C19A9D
    return $pacientes_BeforeShow;
}
//End Close pacientes_BeforeShow

//peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow @148-97C85BCD
function peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow(& $sender)
{
    $peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_estados_pagos; //Compatibility
//End peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow

//Retrieve number of records @149-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow @148-24192795
    return $peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow;
}
//End Close peticiones_estados_pagos_peticiones_estados_pagos_TotalRecords_BeforeShow

//Page_BeforeOutput @1-014AC947
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago_peticiones; //Compatibility
//End Page_BeforeOutput

//Custom Code @192-2A29BDB7
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

//DEL  // -------------------------
//DEL      global $peticiones_estados_pagos;
//DEL      $peticion_id = $peticiones_estados_pagos->peticion_id->GetValue();
//DEL  	$db = new clsDBDatos();
//DEL  	$sSQL = "SELECT SUM(precio) AS total FROM peticiones_detalle WHERE peticion_id='$peticion_id'";
//DEL  	$db->query($sSQL);
//DEL  	if($db->next_record())
//DEL  		//$peticiones_estados_pagos->total->SetValue(number_format($db->f("total"), 0, ',', '.'));
//DEL  		$peticiones_estados_pagos->total->SetValue($db->f("total"));
//DEL  	else
//DEL  		$peticiones_estados_pagos->total->SetValue(0);
//DEL  	unset($db);
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $peticiones_estados_pagos;
//DEL      $peticion_id = $peticiones_estados_pagos->peticion_id->GetValue();
//DEL  	$db = new clsDBDatos();
//DEL  	$sSQL = "SELECT SUM(valor) AS total FROM detalle_pago WHERE peticion_id='$peticion_id'";
//DEL  	$db->query($sSQL);
//DEL  	if($db->next_record())
//DEL  		//$peticiones_estados_pagos->pagado->SetValue(number_format($db->f("total"), 0, ',', '.'));
//DEL  		$peticiones_estados_pagos->pagado->SetValue($db->f("total"));
//DEL  	else
//DEL  		$peticiones_estados_pagos->pagado->SetValue(0);
//DEL  	unset($db);
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $peticiones_estados_pagos;
//DEL      $total = $peticiones_estados_pagos->total->GetValue();
//DEL  	$pagado = $peticiones_estados_pagos->pagado->GetValue();
//DEL  	$deuda = $total - $pagado;
//DEL  	//$peticiones_estados_pagos->deuda->SetValue(number_format($deuda, 0, ',', '.'));
//DEL  	$peticiones_estados_pagos->deuda->SetValue($deuda);
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $peticiones_estados_pagos;
//DEL      $peticion_id = $peticiones_estados_pagos->Alt_peticion_id->GetValue();
//DEL  	$db = new clsDBDatos();
//DEL  	$sSQL = "SELECT SUM(precio) AS total FROM peticiones_detalle WHERE peticion_id='$peticion_id'";
//DEL  	$db->query($sSQL);
//DEL  	if($db->next_record())
//DEL  		$peticiones_estados_pagos->alt_total->SetValue($db->f("total"));
//DEL  	else
//DEL  		$peticiones_estados_pagos->alt_total->SetValue(0);
//DEL  	unset($db);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $peticiones_estados_pagos;
//DEL      $peticion_id = $peticiones_estados_pagos->Alt_peticion_id->GetValue();
//DEL  	$db = new clsDBDatos();
//DEL  	$sSQL = "SELECT SUM(valor) AS total FROM detalle_pago WHERE peticion_id='$peticion_id'";
//DEL  	$db->query($sSQL);
//DEL  	if($db->next_record())
//DEL  		$peticiones_estados_pagos->alt_pagado->SetValue($db->f("total"));
//DEL  	else
//DEL  		$peticiones_estados_pagos->alt_pagado->SetValue(0);
//DEL  	unset($db);
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $peticiones_estados_pagos;
//DEL      $total = $peticiones_estados_pagos->alt_total->GetValue();
//DEL  	$pagado = $peticiones_estados_pagos->alt_pagado->GetValue();
//DEL  	$deuda = $total - $pagado;
//DEL  	//$peticiones_estados_pagos->alt_deuda->SetValue(number_format($deuda, 0, ',', '.'));
//DEL  	$peticiones_estados_pagos->alt_deuda->SetValue($deuda);
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $totales;
//DEL  	$paciente_id = CCGetParam("paciente_id","");
//DEL  	if($paciente_id!=""){
//DEL  		$total_a_pagar = number_format(total_pagar($paciente_id), 0, ',', '.');
//DEL  		$total_pagado = number_format(total_pagado($paciente_id), 0, ',', '.');
//DEL  		$total_deuda = number_format((total_pagar($paciente_id)-total_pagado($paciente_id)), 0, ',', '.');
//DEL  
//DEL  		$tabla_html = "<table class='InLineFormTABLE' cellspacing='0' cellpadding='1' width='100%'>
//DEL  						<tr>
//DEL  							<td class='InLineFormHeaderFont' align='center'>Total Cobrado</td>
//DEL  							<td class='InLineFormHeaderFont' align='center'>Total Pagado</td>
//DEL  							<td class='InLineFormHeaderFont' align='center'>Total Deuda</td>
//DEL  						</tr>
//DEL  						<tr>
//DEL  							<td class='InLineDataTD' align='center'>$$total_a_pagar</td>
//DEL  							<td class='InLineDataTD' align='center'>$$total_pagado</td>
//DEL  							<td class='InLineDataTD' align='center'>$$total_deuda</td>
//DEL  						</tr>
//DEL  						</table>";
//DEL  	    $totales->totales->SetValue($tabla_html);
//DEL  	}
//DEL  // -------------------------

function total_pagar($paciente_id){
	$db = new clsDBDatos();
	$peticiones = peticiones_del_paciente($paciente_id);
	$totales = array();
	for($i=0;$i<sizeof($peticiones);$i++){
		$db->query("SELECT SUM(precio) AS total FROM peticiones_detalle WHERE peticion_id=".$peticiones[$i]);
		if($db->next_record())
			$totales[] = $db->f("total");
	}
	for($i=0;$i<sizeof($totales);$i++){
		$suma_total += $totales[$i]; 
	}
	unset($db);
	return $suma_total;
}
function total_pagado($paciente_id){
	$db = new clsDBDatos();
	$peticiones = peticiones_del_paciente($paciente_id);
	$totales = array();
	for($i=0;$i<sizeof($peticiones);$i++){
		$db->query("SELECT SUM(valor) AS total FROM detalle_pago WHERE peticion_id=".$peticiones[$i]);
		if($db->next_record())
			$totales[] = $db->f("total");
	}
	for($i=0;$i<sizeof($totales);$i++){
		$suma_total += $totales[$i]; 
	}
	unset($db);
	return $suma_total;

}
function peticiones_del_paciente($paciente_id){
	$db = new clsDBDatos();
	$db->query("SELECT peticion_id FROM peticiones WHERE paciente_id=$paciente_id");
	$peticiones = array();
	while($db->next_record()){
		$peticiones[] = $db->f("peticion_id");
	}
	unset($db);
	return $peticiones;
}
?>
