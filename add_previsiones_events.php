<?php
//BindEvents Method @1-B8A22DAD
function BindEvents()
{
    global $previsiones1;
    global $CCSEvents;
    $previsiones1->previsiones1_TotalRecords->CCSEvents["BeforeShow"] = "previsiones1_previsiones1_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//previsiones1_previsiones1_TotalRecords_BeforeShow @20-1C739149
function previsiones1_previsiones1_TotalRecords_BeforeShow(& $sender)
{
    $previsiones1_previsiones1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $previsiones1; //Compatibility
//End previsiones1_previsiones1_TotalRecords_BeforeShow

//Retrieve number of records @21-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close previsiones1_previsiones1_TotalRecords_BeforeShow @20-26454B88
    return $previsiones1_previsiones1_TotalRecords_BeforeShow;
}
//End Close previsiones1_previsiones1_TotalRecords_BeforeShow

//Page_BeforeOutput @1-26E26321
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_previsiones; //Compatibility
//End Page_BeforeOutput

//Custom Code @36-2A29BDB7
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
