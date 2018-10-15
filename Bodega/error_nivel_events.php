<?php
//BindEvents Method @1-8DDDA944
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_AfterInitialize @1-A818A37C
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $error_nivel; //Compatibility
//End Page_AfterInitialize

//Custom Code @4-CD4709D6
// -------------------------
    global $error_nivel;
	global $ImageLink1;
    // Write your own code here.

	$auto=CCGetParam("auto","");

	if ($auto=="si")
		$ImageLink1->SetValue("inicio.php");


// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-1533B5EC
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $error_nivel; //Compatibility
//End Page_BeforeOutput

//Custom Code @5-2A29BDB7
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
