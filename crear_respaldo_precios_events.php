<?php
//BindEvents Method @1-7C48B512
function BindEvents()
{
    global $respaldos_precios_test;
    global $CCSEvents;
    $respaldos_precios_test->CCSEvents["BeforeInsert"] = "respaldos_precios_test_BeforeInsert";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//respaldos_precios_test_BeforeInsert @2-4C17AD78
function respaldos_precios_test_BeforeInsert(& $sender)
{
    $respaldos_precios_test_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $respaldos_precios_test; //Compatibility
//End respaldos_precios_test_BeforeInsert

//Custom Code @8-2E9EFF92
// -------------------------
    global $respaldos_precios_test;
    RespaldarPrecios();
	$respaldos_precios_test->InsertAllowed = false;
	die(header("Location: crear_respaldo_precios.php?estado=true"));
// -------------------------
//End Custom Code

//Close respaldos_precios_test_BeforeInsert @2-249F1BEE
    return $respaldos_precios_test_BeforeInsert;
}
//End Close respaldos_precios_test_BeforeInsert

//Page_BeforeOutput @1-3CB8428C
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $crear_respaldo_precios; //Compatibility
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
