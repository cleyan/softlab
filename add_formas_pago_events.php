<?php
//BindEvents Method @1-4AC80664
function BindEvents()
{
    global $formas_pago;
    global $CCSEvents;
    $formas_pago->formas_pago_TotalRecords->CCSEvents["BeforeShow"] = "formas_pago_formas_pago_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//formas_pago_formas_pago_TotalRecords_BeforeShow @17-78856A21
function formas_pago_formas_pago_TotalRecords_BeforeShow(& $sender)
{
    $formas_pago_formas_pago_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formas_pago; //Compatibility
//End formas_pago_formas_pago_TotalRecords_BeforeShow

//Retrieve number of records @18-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close formas_pago_formas_pago_TotalRecords_BeforeShow @17-595229C8
    return $formas_pago_formas_pago_TotalRecords_BeforeShow;
}
//End Close formas_pago_formas_pago_TotalRecords_BeforeShow

//Page_BeforeOutput @1-E7F144E2
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_formas_pago; //Compatibility
//End Page_BeforeOutput

//Custom Code @27-2A29BDB7
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
