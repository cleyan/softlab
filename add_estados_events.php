<?php
//BindEvents Method @1-DABFE1F7
function BindEvents()
{
    global $estados;
    global $CCSEvents;
    $estados->estados_TotalRecords->CCSEvents["BeforeShow"] = "estados_estados_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//estados_estados_TotalRecords_BeforeShow @4-CE95615B
function estados_estados_TotalRecords_BeforeShow(& $sender)
{
    $estados_estados_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $estados; //Compatibility
//End estados_estados_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close estados_estados_TotalRecords_BeforeShow @4-B08069E7
    return $estados_estados_TotalRecords_BeforeShow;
}
//End Close estados_estados_TotalRecords_BeforeShow

//Page_BeforeOutput @1-FA903547
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_estados; //Compatibility
//End Page_BeforeOutput

//Custom Code @26-2A29BDB7
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
