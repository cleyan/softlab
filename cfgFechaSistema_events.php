<?php
//BindEvents Method @1-0F9B6666
function BindEvents()
{
    global $fechaSistema;
    global $CCSEvents;
    $fechaSistema->Actualizar->CCSEvents["OnClick"] = "fechaSistema_Actualizar_OnClick";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//fechaSistema_Actualizar_OnClick @9-AB74AA9E
function fechaSistema_Actualizar_OnClick(& $sender)
{
    $fechaSistema_Actualizar_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $fechaSistema; //Compatibility
//End fechaSistema_Actualizar_OnClick

//Custom Code @11-FF3FD3DA
// -------------------------
    global $fechaSistema;
	global $error;
    // Write your own code here.

	$resultado=SetFechaSistema($fechaSistema->nuevafechasistema->GetValue());
	//$error=$resultado;
		

// -------------------------
//End Custom Code

//Close fechaSistema_Actualizar_OnClick @9-871B513A
    return $fechaSistema_Actualizar_OnClick;
}
//End Close fechaSistema_Actualizar_OnClick

//Page_BeforeOutput @1-27E85596
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cfgFechaSistema; //Compatibility
//End Page_BeforeOutput

//Custom Code @12-2A29BDB7
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
