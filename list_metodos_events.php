<?php
//BindEvents Method @1-6E0A6AE3
function BindEvents()
{
    global $metodos;
    global $CCSEvents;
    $metodos->metodos_TotalRecords->CCSEvents["BeforeShow"] = "metodos_metodos_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//metodos_metodos_TotalRecords_BeforeShow @8-5F538691
function metodos_metodos_TotalRecords_BeforeShow(& $sender)
{
    $metodos_metodos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $metodos; //Compatibility
//End metodos_metodos_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close metodos_metodos_TotalRecords_BeforeShow @8-9910C163
    return $metodos_metodos_TotalRecords_BeforeShow;
}
//End Close metodos_metodos_TotalRecords_BeforeShow

//Page_BeforeOutput @1-CBD1C9BF
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_metodos; //Compatibility
//End Page_BeforeOutput

//Custom Code @26-2A29BDB7
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
