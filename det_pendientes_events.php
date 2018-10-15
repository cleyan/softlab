<?php
//BindEvents Method @1-3AEBC2A1
function BindEvents()
{
    global $bitacora_estados_usuarios;
    global $CCSEvents;
    $bitacora_estados_usuarios->bitacora_estados_usuarios_TotalRecords->CCSEvents["BeforeShow"] = "bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow @11-639C9D6C
function bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow(& $sender)
{
    $bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $bitacora_estados_usuarios; //Compatibility
//End bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow

//Retrieve number of records @12-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow @11-BB7ACF0F
    return $bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow;
}
//End Close bitacora_estados_usuarios_bitacora_estados_usuarios_TotalRecords_BeforeShow

//Page_BeforeOutput @1-6DA36FC7
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $det_pendientes; //Compatibility
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
