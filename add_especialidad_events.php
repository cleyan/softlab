<?php
//BindEvents Method @1-3AC87E47
function BindEvents()
{
    global $especialidades;
    global $CCSEvents;
    $especialidades->especialidades_TotalRecords->CCSEvents["BeforeShow"] = "especialidades_especialidades_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//especialidades_especialidades_TotalRecords_BeforeShow @4-1F79375C
function especialidades_especialidades_TotalRecords_BeforeShow(& $sender)
{
    $especialidades_especialidades_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $especialidades; //Compatibility
//End especialidades_especialidades_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close especialidades_especialidades_TotalRecords_BeforeShow @4-E0866233
    return $especialidades_especialidades_TotalRecords_BeforeShow;
}
//End Close especialidades_especialidades_TotalRecords_BeforeShow

//Page_BeforeOutput @1-B0FEA446
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_especialidad; //Compatibility
//End Page_BeforeOutput

//Custom Code @19-2A29BDB7
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
