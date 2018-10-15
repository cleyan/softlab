<?php

//BindEvents Method @1-8DDDA944
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_AfterInitialize @1-B8ABEAA2
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menu_rapido; //Compatibility
//End Page_AfterInitialize

//Custom Code @3-B040CEE8
// -------------------------
    global $menu_rapido;
	global $lblBotones;
	    // Write your own code here.
// -------------------------

	$db= new clsDBDatos();
	$db->query("select * from tool_bar where usar_en <> 'WIN' and usuario_id=".CCGetUserID());
	while ($db->next_record()) {
		$caption=$db->f("caption");
		$tooltip=$db->f("tooltip");
		$ruta=$db->f("accion");
		
		$icono=($db->f("icono")=="")? "images/menu/browser.gif": $db->f("icono");

		$nuevo_btn="<a class=\"InLineDataLink\" href=\"$ruta\" target=\"mainFrame\"><img src=\"$icono\" alt=\"$tooltip\" border=\"0\"><br/>$caption</a> ";
		$lblBotones->SetValue($lblBotones->GetValue()."$nuevo_btn<br/>");	

	}

//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-0580FC32
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $menu_rapido; //Compatibility
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
