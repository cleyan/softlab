<?php
//BindEvents Method @1-3BA2B6E6
function BindEvents()
{
    global $informe_datos;
    global $CCSEvents;
    $informe_datos->CCSEvents["BeforeShow"] = "informe_datos_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//informe_datos_BeforeShow @2-11530772
function informe_datos_BeforeShow(& $sender)
{
    $informe_datos_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datos; //Compatibility
//End informe_datos_BeforeShow

//Custom Code @45-6107A570
// -------------------------
    global $informe_datos;
    // Write your own code here.
	
	$peticion_id=intval(CCGetParam("s_peticion_id","0"));

	if ($peticion_id <1) {
		$informe_datos->Visible=False;
	} else {
		$informe_datos->Visible=True;
	}
// -------------------------
//End Custom Code

//Close informe_datos_BeforeShow @2-DFC4A3FE
    return $informe_datos_BeforeShow;
}
//End Close informe_datos_BeforeShow

//Page_BeforeOutput @1-E45F2FF1
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $del_Informes; //Compatibility
//End Page_BeforeOutput

//Custom Code @58-2A29BDB7
// -------------------------
    // Write your own code here.

	CorrigeCodigoEx();


// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_AfterInitialize @1-14ED97A3
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $del_Informes; //Compatibility
//End Page_AfterInitialize

//Custom Code @63-2A29BDB7
// -------------------------

	$peticion_id=CCGetParam("peticion_id","0");
	$informe_id=CCGetParam("informe_id","0");
	$serie=CCGetParam("serie","0");
	$borrar=CCGetParam("borrar","no");

	if ($borrar=="si") {


		$sql="DELETE FROM informe_datos WHERE serie='$serie' AND informe_id=$informe_id AND peticion_id=$peticion_id";
		$db=new clsDBDatos();
		$db->query($sql);
		$qty=$db->affected_rows();
		unset($db);
		echo msgbox("Se eliminaron $qty registros");


		$nom_informe=nom_informe($informe_id);

		Registro($peticion_id,"Se eliminó el informe <$informe_id> $nom_informe ($qty filas)",3,4000,14);
		
	}

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
