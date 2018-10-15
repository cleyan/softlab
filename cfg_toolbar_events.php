<?php
//BindEvents Method @1-13B76EB7
function BindEvents()
{
    global $tool_bar;
    global $CCSEvents;
    $tool_bar->tool_bar_TotalRecords->CCSEvents["BeforeShow"] = "tool_bar_tool_bar_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//tool_bar_tool_bar_TotalRecords_BeforeShow @26-CD25AC41
function tool_bar_tool_bar_TotalRecords_BeforeShow(& $sender)
{
    $tool_bar_tool_bar_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tool_bar; //Compatibility
//End tool_bar_tool_bar_TotalRecords_BeforeShow

//Retrieve number of records @27-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tool_bar_tool_bar_TotalRecords_BeforeShow @26-02CF30D7
    return $tool_bar_tool_bar_TotalRecords_BeforeShow;
}
//End Close tool_bar_tool_bar_TotalRecords_BeforeShow

//Page_BeforeOutput @1-7135202D
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cfg_toolbar; //Compatibility
//End Page_BeforeOutput

//Custom Code @58-2A29BDB7
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
