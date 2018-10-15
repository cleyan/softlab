<?php
// //Events @1-F81417CB

//info_test_BeforeOutput @1-6A89B504
function info_test_BeforeOutput(& $sender)
{
    $info_test_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $info_test; //Compatibility
//End info_test_BeforeOutput

//Custom Code @27-2A29BDB7
// -------------------------
    // Write your own code here.

	global $main_block;

	CorrigeCodigo($main_block);


// -------------------------
//End Custom Code

//Close info_test_BeforeOutput @1-AD3E5394
    return $info_test_BeforeOutput;
}
//End Close info_test_BeforeOutput


?>
