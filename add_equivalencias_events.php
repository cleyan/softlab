<?php
//BindEvents Method @1-9F3B6AC6
function BindEvents()
{
    global $equivalencias;
    global $CCSEvents;
    $equivalencias->equivalencias_TotalRecords->CCSEvents["BeforeShow"] = "equivalencias_equivalencias_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//equivalencias_equivalencias_TotalRecords_BeforeShow @7-9733C530
function equivalencias_equivalencias_TotalRecords_BeforeShow(& $sender)
{
    $equivalencias_equivalencias_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $equivalencias; //Compatibility
//End equivalencias_equivalencias_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close equivalencias_equivalencias_TotalRecords_BeforeShow @7-73BBE8EA
    return $equivalencias_equivalencias_TotalRecords_BeforeShow;
}
//End Close equivalencias_equivalencias_TotalRecords_BeforeShow

//Page_BeforeOutput @1-E3382548
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_equivalencias; //Compatibility
//End Page_BeforeOutput

//Custom Code @27-2A29BDB7
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
