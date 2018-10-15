<?php
//BindEvents Method @1-B00577AB
function BindEvents()
{
    global $precios_test_test;
    global $CCSEvents;
    $precios_test_test->precios_test_test_TotalRecords->CCSEvents["BeforeShow"] = "precios_test_test_precios_test_test_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//precios_test_test_precios_test_test_TotalRecords_BeforeShow @20-CFD30C75
function precios_test_test_precios_test_test_TotalRecords_BeforeShow(& $sender)
{
    $precios_test_test_precios_test_test_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $precios_test_test; //Compatibility
//End precios_test_test_precios_test_test_TotalRecords_BeforeShow

//Retrieve number of records @21-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close precios_test_test_precios_test_test_TotalRecords_BeforeShow @20-6384D8A6
    return $precios_test_test_precios_test_test_TotalRecords_BeforeShow;
}
//End Close precios_test_test_precios_test_test_TotalRecords_BeforeShow

//Page_BeforeOutput @1-A30BC4AB
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $edit_precios_test; //Compatibility
//End Page_BeforeOutput

//Custom Code @118-2A29BDB7
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
