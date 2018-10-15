<?php
//BindEvents Method @1-5203041F
function BindEvents()
{
    global $peticiones_pacientes_proc;
    global $CCSEvents;
    $peticiones_pacientes_proc->edad->CCSEvents["BeforeShow"] = "peticiones_pacientes_proc_edad_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_pacientes_proc_edad_BeforeShow @162-B046A0EB
function peticiones_pacientes_proc_edad_BeforeShow(& $sender)
{
    $peticiones_pacientes_proc_edad_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_pacientes_proc; //Compatibility
//End peticiones_pacientes_proc_edad_BeforeShow

//Custom Code @164-5C6A2E12
// -------------------------
    global $peticiones_pacientes_proc;
    // Write your own code here.

	$paciente_id=$peticiones_pacientes_proc->paciente_id->GetValue();

	$edad=GetEdadEx($paciente_id);

	$peticiones_pacientes_proc->edad->SetValue($edad);


// -------------------------
//End Custom Code

//Close peticiones_pacientes_proc_edad_BeforeShow @162-6FD6CFD3
    return $peticiones_pacientes_proc_edad_BeforeShow;
}
//End Close peticiones_pacientes_proc_edad_BeforeShow

//Page_BeforeOutput @1-B27E21F7
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ver_tomademuestra; //Compatibility
//End Page_BeforeOutput

//Custom Code @165-2A29BDB7
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
