<?php
//BindEvents Method @1-D8684F87
function BindEvents()
{
    global $compuesto_detalle_test;
    global $CCSEvents;
    $compuesto_detalle_test->compuesto_detalle_test_TotalRecords->CCSEvents["BeforeShow"] = "compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow";
    $compuesto_detalle_test->Label1->CCSEvents["BeforeShow"] = "compuesto_detalle_test_Label1_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow @25-7A75FEAA
function compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow(& $sender)
{
    $compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $compuesto_detalle_test; //Compatibility
//End compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow

//Retrieve number of records @26-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow @25-A1CE320B
    return $compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow;
}
//End Close compuesto_detalle_test_compuesto_detalle_test_TotalRecords_BeforeShow

//compuesto_detalle_test_Label1_BeforeShow @57-71C12C70
function compuesto_detalle_test_Label1_BeforeShow(& $sender)
{
    $compuesto_detalle_test_Label1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $compuesto_detalle_test; //Compatibility
//End compuesto_detalle_test_Label1_BeforeShow

//DLookup @58-FCBAA82D
    global $DBDatos;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp('nom_test', 'test', 'test_id=' . CCGetParam('comp_test_id','0'), $Page->Connections["Datos"]);
    $ccs_result = strval($ccs_result);
    $Container->Label1->SetValue($ccs_result);
//End DLookup

//Close compuesto_detalle_test_Label1_BeforeShow @57-A12D7D20
    return $compuesto_detalle_test_Label1_BeforeShow;
}
//End Close compuesto_detalle_test_Label1_BeforeShow

//Page_BeforeOutput @1-35A6C5FD
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $orden_ingreso; //Compatibility
//End Page_BeforeOutput

//Custom Code @66-2A29BDB7
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
