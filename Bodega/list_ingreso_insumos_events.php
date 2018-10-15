<?php
//BindEvents Method @1-87C9CB18
function BindEvents()
{
    global $insumos_ingreso_insumos;
    global $CCSEvents;
    $insumos_ingreso_insumos->insumos_ingreso_insumos_TotalRecords->CCSEvents["BeforeShow"] = "insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow @57-70F34D27
function insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow(& $sender)
{
    $insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_ingreso_insumos; //Compatibility
//End insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow

//Retrieve number of records @58-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow @57-E2F43C6E
    return $insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow;
}
//End Close insumos_ingreso_insumos_insumos_ingreso_insumos_TotalRecords_BeforeShow

//Page_BeforeOutput @1-9C3F7246
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_ingreso_insumos; //Compatibility
//End Page_BeforeOutput

//Custom Code @89-2A29BDB7
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
