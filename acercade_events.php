<?php
//BindEvents Method @1-8DDDA944
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_AfterInitialize @1-EF28A75C
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $acercade; //Compatibility
//End Page_AfterInitialize

//Custom Code @12-B64ED07C
// -------------------------
    global $acercade;
	global $lbl_registrado;
	global $lbl_serie;
	global $lbl_version;
	global $lbl_usuario;
	global $lbl_sw_servidor;
	global $lbl_servidor;
	global $lbl_mysql;
	global $lbl_ip;
	global $lbl_distribuidor;
	global $lbl_logo;

	$db= new clsDBDatos();
	$db->query('SELECT version()');
	$version=($db->next_record()) ? $db->f(0) : 'N/A';
	unset($db);

	$lbl_registrado->SetValue(GetConfig('cedido_a'));
	$lbl_serie->SetValue(GetConfig('nro_licencia'));
	$lbl_distribuidor->SetValue(GetConfig('distribuido_por'));
	$lbl_version->SetValue(SOFTLAB_VERSION);
	$lbl_usuario->SetValue(GetUserName(CCGetUserID()));
	$lbl_sw_servidor->SetValue($_SERVER["SERVER_SOFTWARE"]);
	$lbl_servidor->SetValue($_SERVER["SERVER_ADDR"]);
	$lbl_mysql->SetValue($version);
	$lbl_ip->SetValue($_SERVER["REMOTE_ADDR"]);


//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-73D5CDDC
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $acercade; //Compatibility
//End Page_BeforeOutput

//Custom Code @13-2A29BDB7
// -------------------------
    // Write your own code here.

	CorrigeCodigoEx();



// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput
?>
