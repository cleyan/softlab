<?php
//BindEvents Method @1-D40060DD
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
}
//End BindEvents Method

//Page_BeforeShow @1-D8BD2467
function Page_BeforeShow()
{
    $Page_BeforeShow = true;
//End Page_BeforeShow

//Custom Code @3-13323C73
// -------------------------
    global $info_top;
    // Write your own code here.
	global $fecha_del_sistema;
	
	$tmpfecha=GetFechaSistema();
	$fecha_del_sistema->SetValue("Fecha del Sistema: $tmpfecha ");


// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow


?>
