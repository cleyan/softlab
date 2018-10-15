<?php
//BindEvents Method @1-4DE6A606
function BindEvents()
{
    global $procedencias;
    global $CCSEvents;
    $procedencias->procedencias_TotalRecords->CCSEvents["BeforeShow"] = "procedencias_procedencias_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//procedencias_procedencias_TotalRecords_BeforeShow @7-830652FF
function procedencias_procedencias_TotalRecords_BeforeShow(& $sender)
{
    $procedencias_procedencias_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $procedencias; //Compatibility
//End procedencias_procedencias_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close procedencias_procedencias_TotalRecords_BeforeShow @7-49863D5B
    return $procedencias_procedencias_TotalRecords_BeforeShow;
}
//End Close procedencias_procedencias_TotalRecords_BeforeShow

//Page_BeforeOutput @1-4A1F1B81
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_procedencias; //Compatibility
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
