<?php
//BindEvents Method @1-905B80CF
function BindEvents()
{
    global $peticiones_pacientes_proc;
    global $CCSEvents;
    $peticiones_pacientes_proc->peticiones_pacientes_proc_TotalRecords->CCSEvents["BeforeShow"] = "peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow @33-9D3C53D0
function peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow(& $sender)
{
    $peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_pacientes_proc; //Compatibility
//End peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow

//Retrieve number of records @34-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow @33-A779B823
    return $peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow;
}
//End Close peticiones_pacientes_proc_peticiones_pacientes_proc_TotalRecords_BeforeShow

//Page_BeforeOutput @1-5988BD0F
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones; //Compatibility
//End Page_BeforeOutput

//Custom Code @70-2A29BDB7
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
