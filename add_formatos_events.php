<?php
//BindEvents Method @1-E53042DD
function BindEvents()
{
    global $formatos;
    global $CCSEvents;
    $formatos->formatos_TotalRecords->CCSEvents["BeforeShow"] = "formatos_formatos_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//formatos_formatos_TotalRecords_BeforeShow @9-130C64BC
function formatos_formatos_TotalRecords_BeforeShow(& $sender)
{
    $formatos_formatos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formatos; //Compatibility
//End formatos_formatos_TotalRecords_BeforeShow

//Retrieve number of records @10-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close formatos_formatos_TotalRecords_BeforeShow @9-AFD88402
    return $formatos_formatos_TotalRecords_BeforeShow;
}
//End Close formatos_formatos_TotalRecords_BeforeShow

//Page_BeforeOutput @1-DF515289
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_formatos; //Compatibility
//End Page_BeforeOutput

//Custom Code @23-2A29BDB7
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
