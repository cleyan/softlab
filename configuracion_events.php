<?php
//BindEvents Method @1-595365D6
function BindEvents()
{
    global $configuracion;
    global $CCSEvents;
    $configuracion->CCSEvents["BeforeShowRow"] = "configuracion_BeforeShowRow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//configuracion_BeforeShowRow @2-1CD3EEDF
function configuracion_BeforeShowRow(& $sender)
{
    $configuracion_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $configuracion; //Compatibility
//End configuracion_BeforeShowRow

//Custom Code @18-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close configuracion_BeforeShowRow @2-3AE9F801
    return $configuracion_BeforeShowRow;
}
//End Close configuracion_BeforeShowRow

//Page_BeforeOutput @1-C680EE55
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $configuracion; //Compatibility
//End Page_BeforeOutput

//Custom Code @33-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput




?>
