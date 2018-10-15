<?php
//BindEvents Method @1-833E11F8
function BindEvents()
{
    global $pacientes;
    global $CCSEvents;
    $pacientes->pacientes_TotalRecords->CCSEvents["BeforeShow"] = "pacientes_pacientes_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//pacientes_pacientes_TotalRecords_BeforeShow @213-AAC32E44
function pacientes_pacientes_TotalRecords_BeforeShow(& $sender)
{
    $pacientes_pacientes_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_pacientes_TotalRecords_BeforeShow

//Retrieve number of records @214-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close pacientes_pacientes_TotalRecords_BeforeShow @213-31787783
    return $pacientes_pacientes_TotalRecords_BeforeShow;
}
//End Close pacientes_pacientes_TotalRecords_BeforeShow

//Page_BeforeOutput @1-30FE6A67
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $listPacientes; //Compatibility
//End Page_BeforeOutput

//Custom Code @240-2A29BDB7
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
