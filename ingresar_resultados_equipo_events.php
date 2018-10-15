<?php
//BindEvents Method @1-903F11D3
function BindEvents()
{
    global $peticiones_detalle_result;
    global $CCSEvents;
    $peticiones_detalle_result->peticiones_detalle_result_TotalRecords->CCSEvents["BeforeShow"] = "peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow";
    $peticiones_detalle_result->CCSEvents["BeforeShowRow"] = "peticiones_detalle_result_BeforeShowRow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow @47-279D4653
function peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow(& $sender)
{
    $peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_detalle_result; //Compatibility
//End peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow

//Retrieve number of records @48-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow @47-3C0E1ABB
    return $peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow;
}
//End Close peticiones_detalle_result_peticiones_detalle_result_TotalRecords_BeforeShow

//peticiones_detalle_result_BeforeShowRow @2-51042E9A
function peticiones_detalle_result_BeforeShowRow(& $sender)
{
    $peticiones_detalle_result_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_detalle_result; //Compatibility
//End peticiones_detalle_result_BeforeShowRow

//Custom Code @445-004B14D8
// -------------------------
    global $peticiones_detalle_result;
    global $DBDatos;
	global $linea;
	
	$linea = $peticiones_detalle_result->linea->GetValue() + 1;
//--------------------------------------------------------------------------------------------------------
	$test_id= $peticiones_detalle_result->test_id->GetValue();
	$muestra_id= $peticiones_detalle_result->muestra_id->GetValue();

	$db = new clsDBDatos();
	$db->query("SELECT count(*) AS valores FROM resultados WHERE muestra_id=$muestra_id AND test_id=$test_id");
	if($db->next_record()){
		$cant = intval($db->f("valores"));
		if($cant > 1){
			$html_list .= "<select name='valores_$linea' id='valores_$linea' class='InLineSelect' onchange='javascript: pasar_valor(&quot;valor_$linea&quot;,&quot;valores_$linea&quot;);'>";
			$html_list .= "<option value=''>Resultados</option>";
			$db->query("SELECT valor, resultado_id FROM resultados WHERE muestra_id=$muestra_id AND test_id=$test_id");
			while($db->next_record()){
				$html_list .= "<option value='".$db->f("valor")."'>".$db->f("valor")." ID:".$db->f("resultado_id")."</option>";
			}
			$html_list .= "<select>";
			$peticiones_detalle_result->lb_list_resultados->SetValue($html_list);
			$peticiones_detalle_result->valor->Visible = false;
		}
		elseif($cant == 0){
			$peticiones_detalle_result->lb_list_resultados->SetValue("");
		}
		else{
			$valor=CCGetDBValue("SELECT valor FROM resultados WHERE muestra_id='$muestra_id' AND test_id='$test_id'",$DBDatos);
			$peticiones_detalle_result->valor->SetValue($valor);
		}
	}
	
	$peticiones_detalle_result->linea->SetValue($linea);
//--------------------------------------------------------------------------------------------------------
	$fecha = $peticiones_detalle_result->fecha->GetValue();
	$hora = $peticiones_detalle_result->hora->GetValue();
	if($fecha==""){
		$peticiones_detalle_result->fecha->SetValue(GetFechaServer("d/m/Y"));
	}
	if($hora==""){
		$peticiones_detalle_result->hora->SetValue(GetFechaServer("H:i:s"));
	}
//--------------------------------------------------------------------------------------------------------

	$peticiones_detalle_result->ingresado_por->SetValue(CCGetUserID());

//--------------------------------------------------------------------------------------------------------

// -------------------------
//End Custom Code

//Close peticiones_detalle_result_BeforeShowRow @2-2A3009A1
    return $peticiones_detalle_result_BeforeShowRow;
}
//End Close peticiones_detalle_result_BeforeShowRow

//Page_BeforeOutput @1-3C8C229A
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ingresar_resultados_equipo; //Compatibility
//End Page_BeforeOutput

//Custom Code @530-2A29BDB7
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

?>
