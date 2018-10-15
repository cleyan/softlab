<?php
//BindEvents Method @1-66173AF4
function BindEvents()
{
    global $grupos_detalle_test_grupo;
    global $CCSEvents;
    $grupos_detalle_test_grupo->nom_grupo->CCSEvents["BeforeShow"] = "grupos_detalle_test_grupo_nom_grupo_BeforeShow";
    $grupos_detalle_test_grupo->grupos_detalle_test_grupo_TotalRecords->CCSEvents["BeforeShow"] = "grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//grupos_detalle_test_grupo_nom_grupo_BeforeShow @89-1E832B92
function grupos_detalle_test_grupo_nom_grupo_BeforeShow(& $sender)
{
    $grupos_detalle_test_grupo_nom_grupo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos_detalle_test_grupo; //Compatibility
//End grupos_detalle_test_grupo_nom_grupo_BeforeShow

//DLookup @90-0DA9B06C
    global $DBDatos;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp('nom_grupo', 'grupos', 'grupo_id=' . CCGetParam('grupo_id','0'), $Page->Connections["Datos"]);
    $ccs_result = strval($ccs_result);
    $Container->nom_grupo->SetValue($ccs_result);
//End DLookup

//Close grupos_detalle_test_grupo_nom_grupo_BeforeShow @89-8E8E50BE
    return $grupos_detalle_test_grupo_nom_grupo_BeforeShow;
}
//End Close grupos_detalle_test_grupo_nom_grupo_BeforeShow

//grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow @59-920B3322
function grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow(& $sender)
{
    $grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos_detalle_test_grupo; //Compatibility
//End grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow

//Retrieve number of records @60-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow @59-00DFD6BE
    return $grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow;
}
//End Close grupos_detalle_test_grupo_grupos_detalle_test_grupo_TotalRecords_BeforeShow

//Page_BeforeOutput @1-58A39431
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $edit_orden; //Compatibility
//End Page_BeforeOutput

//Custom Code @99-2A29BDB7
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
