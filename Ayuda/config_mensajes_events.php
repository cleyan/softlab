<?php
//BindEvents Method @1-E2770C0B
function BindEvents()
{
    global $mensajes_ayuda;
    global $CCSEvents;
    $mensajes_ayuda->mensajes_ayuda_TotalRecords->CCSEvents["BeforeShow"] = "mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow @4-850B465B
function mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow(& $sender)
{
    $mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $mensajes_ayuda; //Compatibility
//End mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow @4-45F8AE61
    return $mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow;
}
//End Close mensajes_ayuda_mensajes_ayuda_TotalRecords_BeforeShow

//Page_BeforeOutput @1-1BC487FF
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $config_mensajes; //Compatibility
//End Page_BeforeOutput

//Custom Code @21-2A29BDB7
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
