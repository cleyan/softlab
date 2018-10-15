<?php

//BindEvents Method @1-DC752B32
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_BeforeShow @1-D56A342C
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle; //Compatibility
//End Page_BeforeShow

//Custom Code @2-90D8ABA2
// -------------------------
    global $detalle;
	global $info_detalle; 
	
	$tmp="";
	$tmp.= "<pre>Inicio del reporte....<br><br> <b>POST</b>:<br/>";
	$tmp.= print_r($_POST, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>GET</b>:<br/>";
	$tmp.= print_r($_GET, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>REQUEST</b>:<br/>";
	$tmp.= print_r($_REQUEST, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>SESSION</b>:<br/>";
	$tmp.= print_r($_SESSION, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>GLOBALS</b>:<br/>";
	$tmp.= print_r($GLOBALS, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>COOKIE</b>:<br/>";
	$tmp.= print_r($_COOKIE, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>SERVER</b>:<br/>";
	$tmp.= print_r($_SERVER, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>ENV</b>:<br/>";
	$tmp.= print_r($_ENV, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>FILES</b>:<br/>";
	$tmp.= print_r($_FILES, true);
	$tmp.= "</pre>";

	$tmp.= "<pre> <b>NAVEGADOR:</b> <bR>{$GLOBALS['HTTP_USER_AGENT']} <br/>";
		$browser = @get_browser();
	$tmp.= $tmp.= print_r($browser, true)  ."";
	$tmp.= "<br><br>.... Fin de Reporte ....<hr></pre>";

	$info_detalle->SetValue($tmp);

    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-42112E9B
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle; //Compatibility
//End Page_BeforeOutput

//Custom Code @4-2A29BDB7
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
