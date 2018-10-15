<?php
//BindEvents Method @1-169AB6AD
function BindEvents()
{
    global $pacientes;
    global $CCSEvents;
    $pacientes->fecha_nacimiento->CCSEvents["BeforeShow"] = "pacientes_fecha_nacimiento_BeforeShow";
    $pacientes->ds->CCSEvents["AfterExecuteInsert"] = "pacientes_ds_AfterExecuteInsert";
    $pacientes->ds->CCSEvents["AfterExecuteUpdate"] = "pacientes_ds_AfterExecuteUpdate";
    $pacientes->CCSEvents["OnValidate"] = "pacientes_OnValidate";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//pacientes_fecha_nacimiento_BeforeShow @15-E40C2020
function pacientes_fecha_nacimiento_BeforeShow(& $sender)
{
    $pacientes_fecha_nacimiento_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_fecha_nacimiento_BeforeShow

//Custom Code @30-B5B910A1
// -------------------------
    global $pacientes;
    // Write your own code here.

	$paciente_id=CCGetParam("paciente_id","");

	$pacientes->edad_calc->SetValue(GetEdadEx($paciente_id));


// -------------------------
//End Custom Code

//Close pacientes_fecha_nacimiento_BeforeShow @15-A15D354E
    return $pacientes_fecha_nacimiento_BeforeShow;
}
//End Close pacientes_fecha_nacimiento_BeforeShow

//pacientes_ds_AfterExecuteInsert @2-23F7FA16
function pacientes_ds_AfterExecuteInsert(& $sender)
{
    $pacientes_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_ds_AfterExecuteInsert

//Custom Code @22-B5B910A1
// -------------------------
    global $pacientes;
	global $Redirect;
    // Write your own code here.

	$ultimo_id=mysql_insert_id();
	$Redirect="frmBuscarPaciente.php?origen=desdeventana&ultimoid=$ultimo_id";



// -------------------------
//End Custom Code

//Close pacientes_ds_AfterExecuteInsert @2-0B0ACC9D
    return $pacientes_ds_AfterExecuteInsert;
}
//End Close pacientes_ds_AfterExecuteInsert

//pacientes_ds_AfterExecuteUpdate @2-4490B68F
function pacientes_ds_AfterExecuteUpdate(& $sender)
{
    $pacientes_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_ds_AfterExecuteUpdate

//Custom Code @29-B5B910A1
// -------------------------
    global $pacientes;
	global $Redirect;
    // Write your own code here.

	$ultimo_id=CCGetParam('paciente_id','0');
	$Redirect="frmBuscarPaciente.php?origen=desdeventana&ultimoid=$ultimo_id";


// -------------------------
//End Custom Code

//Close pacientes_ds_AfterExecuteUpdate @2-C4230D12
    return $pacientes_ds_AfterExecuteUpdate;
}
//End Close pacientes_ds_AfterExecuteUpdate

//pacientes_OnValidate @2-0A73C462
function pacientes_OnValidate(& $sender)
{
    $pacientes_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_OnValidate

//Custom Code @31-B5B910A1
// -------------------------
    global $pacientes;
	$pacientes->nombres->SetValue(strtoupper($pacientes->nombres->GetValue()));
	$pacientes->apellidos->SetValue(strtoupper($pacientes->apellidos->GetValue()));

//	$pacientes->Errors->AddError("Malo");

// -------------------------
//End Custom Code

//Close pacientes_OnValidate @2-B93AFE14
    return $pacientes_OnValidate;
}
//End Close pacientes_OnValidate

//Page_BeforeOutput @1-DF9F0B70
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $win_add_paciente; //Compatibility
//End Page_BeforeOutput

//Custom Code @32-2A29BDB7
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
