<?php
//BindEvents Method @1-8DDDA944
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_AfterInitialize @1-A78CF2A7
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $print_Peticion; //Compatibility
//End Page_AfterInitialize

//Custom Code @2-BF9ED56C
// -------------------------
    global $print_Peticion;
	global $Redirect;
    // Write your own code here.

	$peticion_id=CCGetParam("peticion_id","");
	if($peticion_id!=""){
		$Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=%5Corden_examen&aliasname=REPORTE&username=lab&password=lab&ParamPETICIONID=$peticion_id";
	} else {
		echo "<h1>NO se ha seleccionado una petición</h1>";
	}
				

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-EABB067D
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $print_Peticion; //Compatibility
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
