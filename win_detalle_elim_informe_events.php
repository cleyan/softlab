<?php
//BindEvents Method @1-F30B03C8
function BindEvents()
{
    global $grupos;
    global $test;
    global $CCSEvents;
    $grupos->CCSEvents["BeforeSelect"] = "grupos_BeforeSelect";
    $test->CCSEvents["BeforeSelect"] = "test_BeforeSelect";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//grupos_BeforeSelect @2-7241BFAC
function grupos_BeforeSelect(& $sender)
{
    $grupos_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos; //Compatibility
//End grupos_BeforeSelect

//Custom Code @20-A9E277D0
// -------------------------
    global $grupos;
    // Write your own code here.

	$grupo=CCGetParam("mostrar","");
	if ($grupo!="grupo") $grupos->Visible=false;

// -------------------------
//End Custom Code

//Close grupos_BeforeSelect @2-5A48106C
    return $grupos_BeforeSelect;
}
//End Close grupos_BeforeSelect

//test_BeforeSelect @11-46DF6830
function test_BeforeSelect(& $sender)
{
    $test_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_BeforeSelect

//Custom Code @21-BC68F432
// -------------------------
    global $test;
    // Write your own code here.
	$ver_test=CCGetParam("mostrar","");
	if ($ver_test!="test") $test->Visible=false;

// -------------------------
//End Custom Code

//Close test_BeforeSelect @11-1F0B5428
    return $test_BeforeSelect;
}
//End Close test_BeforeSelect

//Page_BeforeOutput @1-7B2D0805
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $win_detalle_elim_informe; //Compatibility
//End Page_BeforeOutput

//Custom Code @22-2A29BDB7
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
