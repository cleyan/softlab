<?php
//BindEvents Method @1-CCE63397
function BindEvents()
{
    global $test;
    global $CCSEvents;
    $test->test_TotalRecords->CCSEvents["BeforeShow"] = "test_test_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//test_test_TotalRecords_BeforeShow @12-7B9961A7
function test_test_TotalRecords_BeforeShow(& $sender)
{
    $test_test_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_test_TotalRecords_BeforeShow

//Retrieve number of records @13-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close test_test_TotalRecords_BeforeShow @12-6CBF7389
    return $test_test_TotalRecords_BeforeShow;
}
//End Close test_test_TotalRecords_BeforeShow

//Page_BeforeOutput @1-4B660AFE
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $edit_test; //Compatibility
//End Page_BeforeOutput

//Custom Code @62-2A29BDB7
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
