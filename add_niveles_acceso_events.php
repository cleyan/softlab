<?php
//BindEvents Method @1-010FBCC7
function BindEvents()
{
    global $niveles_acceso;
    global $CCSEvents;
    $niveles_acceso->niveles_acceso_TotalRecords->CCSEvents["BeforeShow"] = "niveles_acceso_niveles_acceso_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//niveles_acceso_niveles_acceso_TotalRecords_BeforeShow @4-27ECEE6A
function niveles_acceso_niveles_acceso_TotalRecords_BeforeShow(& $sender)
{
    $niveles_acceso_niveles_acceso_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $niveles_acceso; //Compatibility
//End niveles_acceso_niveles_acceso_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close niveles_acceso_niveles_acceso_TotalRecords_BeforeShow @4-0AD42001
    return $niveles_acceso_niveles_acceso_TotalRecords_BeforeShow;
}
//End Close niveles_acceso_niveles_acceso_TotalRecords_BeforeShow

//Page_BeforeOutput @1-85DBBCE6
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_niveles_acceso; //Compatibility
//End Page_BeforeOutput

//Custom Code @15-2A29BDB7
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
