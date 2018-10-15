<?php
//BindEvents Method @1-F5C8C6DF
function BindEvents()
{
    global $pacientes;
    global $CCSEvents;
    $pacientes->fecha_nacimiento->CCSEvents["BeforeShow"] = "pacientes_fecha_nacimiento_BeforeShow";
    $pacientes->Button_Insert->CCSEvents["OnClick"] = "pacientes_Button_Insert_OnClick";
    $pacientes->Button_Update->CCSEvents["OnClick"] = "pacientes_Button_Update_OnClick";
    $pacientes->Button_Delete->CCSEvents["OnClick"] = "pacientes_Button_Delete_OnClick";
    $pacientes->Button_Cancel->CCSEvents["OnClick"] = "pacientes_Button_Cancel_OnClick";
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

//Custom Code @38-B5B910A1
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

//pacientes_Button_Insert_OnClick @3-B7870B11
function pacientes_Button_Insert_OnClick(& $sender)
{
    $pacientes_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_Button_Insert_OnClick

//Custom Code @30-B5B910A1
// -------------------------
    global $pacientes;
	global $Redirect;

	$origen=CCGEtParam("origen","");
	if ($origen!="") $Redirect=$origen;


    // Write your own code here.
// -------------------------
//End Custom Code

//Close pacientes_Button_Insert_OnClick @3-B616E466
    return $pacientes_Button_Insert_OnClick;
}
//End Close pacientes_Button_Insert_OnClick

//pacientes_Button_Update_OnClick @4-3A002F79
function pacientes_Button_Update_OnClick(& $sender)
{
    $pacientes_Button_Update_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_Button_Update_OnClick

//Custom Code @31-B5B910A1
// -------------------------
    global $pacientes;
	global $Redirect;

	$origen=CCGEtParam("origen","");
	if ($origen!="") $Redirect=$origen;

    // Write your own code here.
// -------------------------
//End Custom Code

//Close pacientes_Button_Update_OnClick @4-1D81CCDB
    return $pacientes_Button_Update_OnClick;
}
//End Close pacientes_Button_Update_OnClick

//pacientes_Button_Delete_OnClick @5-60DB7140
function pacientes_Button_Delete_OnClick(& $sender)
{
    $pacientes_Button_Delete_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_Button_Delete_OnClick

//Custom Code @32-B5B910A1
// -------------------------
    global $pacientes;
	global $Redirect;

	$origen=CCGEtParam("origen","");
	if ($origen!="") $Redirect=$origen;

    // Write your own code here.
// -------------------------
//End Custom Code

//Close pacientes_Button_Delete_OnClick @5-D1CB36B0
    return $pacientes_Button_Delete_OnClick;
}
//End Close pacientes_Button_Delete_OnClick

//pacientes_Button_Cancel_OnClick @7-3942A6AA
function pacientes_Button_Cancel_OnClick(& $sender)
{
    $pacientes_Button_Cancel_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_Button_Cancel_OnClick

//Custom Code @33-B5B910A1
// -------------------------
    global $pacientes;
	global $Redirect;

	$origen=CCGEtParam("origen","");
	if ($origen!="") $Redirect=$origen;
    // Write your own code here.
// -------------------------
//End Custom Code

//Close pacientes_Button_Cancel_OnClick @7-0B352FC0
    return $pacientes_Button_Cancel_OnClick;
}
//End Close pacientes_Button_Cancel_OnClick

//pacientes_OnValidate @2-0A73C462
function pacientes_OnValidate(& $sender)
{
    $pacientes_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_OnValidate

//Custom Code @39-B5B910A1
// -------------------------
    global $pacientes;
    // Write your own code here.

	$accion=GetConfig("cambiar_str_paciente_auto");

	switch ($accion) {
    case "Mayusculas":
		$pacientes->nombres->SetValue(strtoupper($pacientes->nombres->GetValue()));
		$pacientes->apellidos->SetValue(strtoupper($pacientes->apellidos->GetValue()));

        break;

    case "Minusculas":
		$pacientes->nombres->SetValue(strtolower($pacientes->nombres->GetValue()));
		$pacientes->apellidos->SetValue(strtolower($pacientes->apellidos->GetValue()));
	
        break;

	}


// -------------------------
//End Custom Code

//Close pacientes_OnValidate @2-B93AFE14
    return $pacientes_OnValidate;
}
//End Close pacientes_OnValidate

//Page_BeforeOutput @1-B4A2264B
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_pacientes; //Compatibility
//End Page_BeforeOutput

//Custom Code @47-2A29BDB7
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
