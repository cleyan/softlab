<?php
//BindEvents Method @1-4CB9F075
function BindEvents()
{
    global $precios_test_test_procede;
    global $CCSEvents;
    $precios_test_test_procede->precios_test_test_procede_TotalRecords->CCSEvents["BeforeShow"] = "precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow @38-A18BDF2F
function precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow(& $sender)
{
    $precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $precios_test_test_procede; //Compatibility
//End precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow

//Retrieve number of records @39-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow @38-4DD2D7B9
    return $precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow;
}
//End Close precios_test_test_procede_precios_test_test_procede_TotalRecords_BeforeShow

//Page_BeforeOutput @1-AD380F35
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_precios; //Compatibility
//End Page_BeforeOutput

//Custom Code @66-2A29BDB7
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
