<?php
//BindEvents Method @1-53B909B4
function BindEvents()
{
    global $medicos_especialidades;
    global $CCSEvents;
    $medicos_especialidades->medicos_especialidades_TotalRecords->CCSEvents["BeforeShow"] = "medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow @12-99BF9362
function medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow(& $sender)
{
    $medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $medicos_especialidades; //Compatibility
//End medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow @12-041ED1F9
    return $medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow;
}
//End Close medicos_especialidades_medicos_especialidades_TotalRecords_BeforeShow

//Page_BeforeOutput @1-4E28CDCD
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_medicos; //Compatibility
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
