<?php
//BindEvents Method @1-9380E3E4
function BindEvents()
{
    global $traducciones;
    global $CCSEvents;
    $traducciones->traducciones_TotalRecords->CCSEvents["BeforeShow"] = "traducciones_traducciones_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//traducciones_traducciones_TotalRecords_BeforeShow @9-FC97A5F4
function traducciones_traducciones_TotalRecords_BeforeShow(& $sender)
{
    $traducciones_traducciones_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $traducciones; //Compatibility
//End traducciones_traducciones_TotalRecords_BeforeShow

//Retrieve number of records @10-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close traducciones_traducciones_TotalRecords_BeforeShow @9-32B7A0DE
    return $traducciones_traducciones_TotalRecords_BeforeShow;
}
//End Close traducciones_traducciones_TotalRecords_BeforeShow

//Page_BeforeOutput @1-7D39C5C0
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $def_traduciones; //Compatibility
//End Page_BeforeOutput

//Custom Code @29-2A29BDB7
// -------------------------
    // Write your own code h
	
	global $main_block;

	CorrigeCodigo($main_block);

ere.
// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput


?>
