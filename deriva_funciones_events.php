<?php
//BindEvents Method @1-8DDDA944
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_AfterInitialize @1-B55766FA
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $deriva_funciones; //Compatibility
//End Page_AfterInitialize

//Custom Code @2-C1D61BE3
// -------------------------
    global $func_imprimir;
	$funcion=CCGetParam("funcion","");

	if ($funcion=="imprimir"){
		$peticion_id=CCGetParam("peticion_id","");
		if ($peticion_id=="") {
			die("<h1>Faltaron parámetros</h1>");
		} else {
			die("<h1>Creando Recibo... para Peticion: $peticion_id </h1>");
		}
	} else {
		die("<h1>Faltaron parámetros</h1>");
	}



    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-7450305D
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $deriva_funciones; //Compatibility
//End Page_BeforeOutput

//Custom Code @3-2A29BDB7
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
