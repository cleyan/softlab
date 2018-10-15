<?php
//BindEvents Method @1-9672D6A9
function BindEvents()
{
    global $secciones;
    global $CCSEvents;
    $secciones->secciones_TotalRecords->CCSEvents["BeforeShow"] = "secciones_secciones_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//secciones_secciones_TotalRecords_BeforeShow @4-AEE3DA91
function secciones_secciones_TotalRecords_BeforeShow(& $sender)
{
    $secciones_secciones_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $secciones; //Compatibility
//End secciones_secciones_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close secciones_secciones_TotalRecords_BeforeShow @4-49A5C39D
    return $secciones_secciones_TotalRecords_BeforeShow;
}
//End Close secciones_secciones_TotalRecords_BeforeShow

//Page_BeforeOutput @1-4361F732
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_secciones; //Compatibility
//End Page_BeforeOutput

//Custom Code @21-2A29BDB7
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
