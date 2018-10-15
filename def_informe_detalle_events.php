<?php
//BindEvents Method @1-98D5E83C
function BindEvents()
{
    global $informes_detalle1;
    global $CCSEvents;
    $informes_detalle1->CCSEvents["BeforeSelect"] = "informes_detalle1_BeforeSelect";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//informes_detalle1_BeforeSelect @14-E25687A6
function informes_detalle1_BeforeSelect(& $sender)
{
    $informes_detalle1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informes_detalle1; //Compatibility
//End informes_detalle1_BeforeSelect

//Custom Code @27-6BA94DFA
// -------------------------
    global $informes_detalle1;
    // Write your own code here.

	$informe_id=CCGetParam("informe_id","");

	if ($informe_id=="")
		$informes_detalle1->Visible=false;


// -------------------------
//End Custom Code

//Close informes_detalle1_BeforeSelect @14-C4AA31A6
    return $informes_detalle1_BeforeSelect;
}
//End Close informes_detalle1_BeforeSelect

//Page_BeforeOutput @1-1057AB3E
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $def_informe_detalle; //Compatibility
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
