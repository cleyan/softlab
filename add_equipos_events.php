<?php
//BindEvents Method @1-8318EE50
function BindEvents()
{
    global $equipos;
    global $CCSEvents;
    $equipos->equipos_TotalRecords->CCSEvents["BeforeShow"] = "equipos_equipos_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//equipos_equipos_TotalRecords_BeforeShow @25-96664415
function equipos_equipos_TotalRecords_BeforeShow(& $sender)
{
    $equipos_equipos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $equipos; //Compatibility
//End equipos_equipos_TotalRecords_BeforeShow

//Retrieve number of records @26-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close equipos_equipos_TotalRecords_BeforeShow @25-1F0DA404
    return $equipos_equipos_TotalRecords_BeforeShow;
}
//End Close equipos_equipos_TotalRecords_BeforeShow

//Page_BeforeOutput @1-2CEB9F03
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_equipos; //Compatibility
//End Page_BeforeOutput

//Custom Code @39-2A29BDB7
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
