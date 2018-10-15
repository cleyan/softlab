<?php
//BindEvents Method @1-F0AC5085
function BindEvents()
{
    global $sexos;
    global $CCSEvents;
    $sexos->sexos_TotalRecords->CCSEvents["BeforeShow"] = "sexos_sexos_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//sexos_sexos_TotalRecords_BeforeShow @4-947EE6AA
function sexos_sexos_TotalRecords_BeforeShow(& $sender)
{
    $sexos_sexos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sexos; //Compatibility
//End sexos_sexos_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close sexos_sexos_TotalRecords_BeforeShow @4-4D6FC4C4
    return $sexos_sexos_TotalRecords_BeforeShow;
}
//End Close sexos_sexos_TotalRecords_BeforeShow

//Page_BeforeOutput @1-302A1BFD
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_sexos; //Compatibility
//End Page_BeforeOutput

//Custom Code @18-2A29BDB7
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
