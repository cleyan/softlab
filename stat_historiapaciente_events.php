<?php
//BindEvents Method @1-15AA2194
function BindEvents()
{
    global $resultados_testSearch;
    global $resultados_test;
    global $CCSEvents;
    $resultados_testSearch->lbl_nom_paciente->CCSEvents["BeforeShow"] = "resultados_testSearch_lbl_nom_paciente_BeforeShow";
    $resultados_test->CCSEvents["BeforeShowRow"] = "resultados_test_BeforeShowRow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//resultados_testSearch_lbl_nom_paciente_BeforeShow @141-E0BBCDB0
function resultados_testSearch_lbl_nom_paciente_BeforeShow(& $sender)
{
    $resultados_testSearch_lbl_nom_paciente_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resultados_testSearch; //Compatibility
//End resultados_testSearch_lbl_nom_paciente_BeforeShow

//DLookup @142-2DC8AD7A
    global $DBDatos;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp("concat(nombres, ' ' , apellidos)", pacientes, "paciente_id=" . CCGetParam("paciente_id","0"), $Page->Connections["Datos"]);
    $ccs_result = strval($ccs_result);
    $Container->lbl_nom_paciente->SetValue($ccs_result);
//End DLookup

//Close resultados_testSearch_lbl_nom_paciente_BeforeShow @141-4B8E1A72
    return $resultados_testSearch_lbl_nom_paciente_BeforeShow;
}
//End Close resultados_testSearch_lbl_nom_paciente_BeforeShow

//resultados_test_BeforeShowRow @37-12AD1214
function resultados_test_BeforeShowRow(& $sender)
{
    $resultados_test_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resultados_test; //Compatibility
//End resultados_test_BeforeShowRow

//Custom Code @148-2A29BDB7
// -------------------------
    // Write your own code here.

	$test_id=$resultados_test->test_id->GetValue();
	$paciente_id=CCGetParam("paciente_id","");
	$qty=$resultados_test->qty->GetValue();

	if ($qty <2 ){
		$resultados_test->lnkVerHistoria->SetLink("JavaScript:alert('No hay datos suficientes para Graficar');");
	} else 
		$resultados_test->lnkVerHistoria->SetLink("JavaScript:openWindow('ver_grafico.php?test_id=$test_id&paciente_id=$paciente_id&tipo=historia_paciente','verHistoria',720,500);");

// -------------------------
//End Custom Code

//Close resultados_test_BeforeShowRow @37-5CDDC8B3
    return $resultados_test_BeforeShowRow;
}
//End Close resultados_test_BeforeShowRow

//Page_BeforeOutput @1-04CDCF09
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $stat_historiapaciente; //Compatibility
//End Page_BeforeOutput

//Custom Code @146-2A29BDB7
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
//DEL      global $resultados_test;
//DEL      // Write your own code here.
//DEL  
//DEL  	echo $resultados_test->ds->CountSQL;
//DEL  // -------------------------


//DEL  // -------------------------
//DEL      global $stat_historiapaciente;
//DEL      // Write your own code here.
//DEL  
//DEL  	$stat_historiapaciente->ds->CountSQL;
//DEL  
//DEL  // -------------------------



?>
