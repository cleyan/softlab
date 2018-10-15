<?php
//BindEvents Method @1-221B1EB6
function BindEvents()
{
    global $s_fecha;
    global $respaldos_precios_test_te;
    global $CCSEvents;
    $s_fecha->s_fecha->CCSEvents["BeforeShow"] = "s_fecha_s_fecha_BeforeShow";
    $s_fecha->bt_cambiaFecha->CCSEvents["OnClick"] = "s_fecha_bt_cambiaFecha_OnClick";
    $respaldos_precios_test_te->respaldos_precios_test_te_TotalRecords->CCSEvents["BeforeShow"] = "respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow";
    $respaldos_precios_test_te->CCSEvents["BeforeShow"] = "respaldos_precios_test_te_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//s_fecha_s_fecha_BeforeShow @48-E39E56A0
function s_fecha_s_fecha_BeforeShow(& $sender)
{
    $s_fecha_s_fecha_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $s_fecha; //Compatibility
//End s_fecha_s_fecha_BeforeShow

//Custom Code @49-2ACDC81A
// -------------------------
    global $s_fecha;
    global $DBDatos;

	$db = new clsDBDatos();
	$sql_fechas = "SELECT DISTINCT fecha FROM respaldos_precios_test ORDER BY fecha desc";
	$db->query($sql_fechas);
	//$fechas = array();
	while($db->next_record()){
		$fecha_txt = date("d/m/Y (H:i:s)",strtotime($db->f("fecha")));
		$fecha_value = $db->f("fecha");
		$fechas[] = array($fecha_value,$fecha_txt);
	}
	unset($db);
	$s_fecha->s_fecha->Values = $fechas;
// -------------------------
//End Custom Code

//Close s_fecha_s_fecha_BeforeShow @48-C0D071EA
    return $s_fecha_s_fecha_BeforeShow;
}
//End Close s_fecha_s_fecha_BeforeShow

//s_fecha_bt_cambiaFecha_OnClick @51-96D5E750
function s_fecha_bt_cambiaFecha_OnClick(& $sender)
{
    $s_fecha_bt_cambiaFecha_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $s_fecha; //Compatibility
//End s_fecha_bt_cambiaFecha_OnClick

//Custom Code @52-2ACDC81A
// -------------------------
    global $s_fecha;
	
	$fecha=$s_fecha->s_fecha->GetValue();
	$sql_start="START TRANSACTION; ";
	$sql_delete="DELETE FROM precios_test; ";
	$sql_insert="INSERT INTO precios_test (test_id, prevision_id, procedencia_id, precio) ".
				"SELECT test_id, prevision_id, procedencia_id, precio ".
				"FROM respaldos_precios_test ".
				"WHERE fecha='$fecha'; ";
	$sql_commit="COMMIT;"	;
	$sql_rollback="ROLLBACK; ";

	$db = new clsDBDatos();

	$db->query($sql_start);
	$db->query($sql_delete);
	$db->query($sql_insert);
	if ($db->Error) {
		$db->query($sql_rollback);
	} else { 
		$db->query($sql_commit);
	}	
	unset($db);

// -------------------------
//End Custom Code

//Close s_fecha_bt_cambiaFecha_OnClick @51-2490DABA
    return $s_fecha_bt_cambiaFecha_OnClick;
}
//End Close s_fecha_bt_cambiaFecha_OnClick

//respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow @30-0EC1BBE0
function respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow(& $sender)
{
    $respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $respaldos_precios_test_te; //Compatibility
//End respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow

//Retrieve number of records @31-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow @30-361AF7D1
    return $respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow;
}
//End Close respaldos_precios_test_te_respaldos_precios_test_te_TotalRecords_BeforeShow

//respaldos_precios_test_te_BeforeShow @2-3A6C0093
function respaldos_precios_test_te_BeforeShow(& $sender)
{
    $respaldos_precios_test_te_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $respaldos_precios_test_te; //Compatibility
//End respaldos_precios_test_te_BeforeShow

//Custom Code @50-D2FB6F56
// -------------------------
    global $respaldos_precios_test_te;
    $cont_reg= intval($respaldos_precios_test_te->ds->RecordsCount);
	if($cont_reg == 0){ $respaldos_precios_test_te->Visible = false; }
// -------------------------
//End Custom Code

//Close respaldos_precios_test_te_BeforeShow @2-41CCC142
    return $respaldos_precios_test_te_BeforeShow;
}
//End Close respaldos_precios_test_te_BeforeShow

//Page_BeforeOutput @1-76524B71
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $modificar_precios_desde_respaldo; //Compatibility
//End Page_BeforeOutput

//Custom Code @58-2A29BDB7
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
