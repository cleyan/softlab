<?php
//BindEvents Method @1-89E01111
function BindEvents()
{
    global $tipos_muestra;
    global $CCSEvents;
    $tipos_muestra->tipos_muestra_TotalRecords->CCSEvents["BeforeShow"] = "tipos_muestra_tipos_muestra_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//tipos_muestra_tipos_muestra_TotalRecords_BeforeShow @8-1BBA21CA
function tipos_muestra_tipos_muestra_TotalRecords_BeforeShow(& $sender)
{
    $tipos_muestra_tipos_muestra_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $tipos_muestra; //Compatibility
//End tipos_muestra_tipos_muestra_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close tipos_muestra_tipos_muestra_TotalRecords_BeforeShow @8-8A38CFB4
    return $tipos_muestra_tipos_muestra_TotalRecords_BeforeShow;
}
//End Close tipos_muestra_tipos_muestra_TotalRecords_BeforeShow

//Page_BeforeOutput @1-32207368
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_tipos_muestra; //Compatibility
//End Page_BeforeOutput

//Custom Code @29-2A29BDB7
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
