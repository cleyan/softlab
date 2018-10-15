<?php
//BindEvents Method @1-E6A60924
function BindEvents()
{
    global $indicaciones_muestra;
    global $CCSEvents;
    $indicaciones_muestra->indicaciones_muestra_TotalRecords->CCSEvents["BeforeShow"] = "indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow @8-B3170668
function indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow(& $sender)
{
    $indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $indicaciones_muestra; //Compatibility
//End indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow @8-863D5527
    return $indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow;
}
//End Close indicaciones_muestra_indicaciones_muestra_TotalRecords_BeforeShow

//Page_BeforeOutput @1-7BEDE410
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_indicaciones_muestra; //Compatibility
//End Page_BeforeOutput

//Custom Code @31-2A29BDB7
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
