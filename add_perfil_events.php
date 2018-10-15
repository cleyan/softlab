<?php
//BindEvents Method @1-38F028E6
function BindEvents()
{
    global $perfiles;
    global $CCSEvents;
    $perfiles->CCSEvents["BeforeShow"] = "perfiles_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//perfiles_BeforeShow @2-DBAADC73
function perfiles_BeforeShow(& $sender)
{
    $perfiles_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $perfiles; //Compatibility
//End perfiles_BeforeShow

//Custom Code @16-88640227
// -------------------------
    global $perfiles;
	$perfil_id = CCGetParam("perfil_id","");
	
	if($perfil_id=="0"){
		$perfiles->Visible = false;
		echo("<br/><br/>
		    <p align='center'>
			  	<b>¡Opción no valida!, debe seleccionar un perfil para poder editarlo.</b>
			</p><br/>
			<p align='center'>
				<a href='javascript:window.close();'>[Cerrar ventana]</a>
			</p>");
	}
// -------------------------
//End Custom Code

//Close perfiles_BeforeShow @2-4E85FFF7
    return $perfiles_BeforeShow;
}
//End Close perfiles_BeforeShow

//Page_BeforeOutput @1-15E2DE1E
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_perfil; //Compatibility
//End Page_BeforeOutput

//Custom Code @17-2A29BDB7
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
