<?php
//BindEvents Method @1-F26B2500
function BindEvents()
{
    global $peticiones_previsiones_pr;
    global $Impresion;
    global $CCSEvents;
    $peticiones_previsiones_pr->peticiones_previsiones_pr_TotalRecords->CCSEvents["BeforeShow"] = "peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow";
    $peticiones_previsiones_pr->lbl_total->CCSEvents["BeforeShow"] = "peticiones_previsiones_pr_lbl_total_BeforeShow";
    $peticiones_previsiones_pr->CCSEvents["BeforeShow"] = "peticiones_previsiones_pr_BeforeShow";
    $Impresion->Imprimir->CCSEvents["OnClick"] = "Impresion_Imprimir_OnClick";
    $Impresion->CCSEvents["BeforeShow"] = "Impresion_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow @17-1D5B6E78
function peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow(& $sender)
{
    $peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_previsiones_pr; //Compatibility
//End peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow

//Retrieve number of records @18-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow @17-BE747A32
    return $peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow;
}
//End Close peticiones_previsiones_pr_peticiones_previsiones_pr_TotalRecords_BeforeShow

//peticiones_previsiones_pr_lbl_total_BeforeShow @51-A01C7173
function peticiones_previsiones_pr_lbl_total_BeforeShow(& $sender)
{
    $peticiones_previsiones_pr_lbl_total_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_previsiones_pr; //Compatibility
//End peticiones_previsiones_pr_lbl_total_BeforeShow

//Custom Code @52-F6BDD9BA
// -------------------------
    global $peticiones_previsiones_pr;
    global $DBDatos;

	$peticion_id=intval($peticiones_previsiones_pr->s_peticion_id->GetValue());

    $result = CCDLookUp("sum(precio) as total", "peticiones_detalle", "peticion_id=$peticion_id", $DBDatos);
    $result = intval($result);
    $peticiones_previsiones_pr->lbl_total->SetValue($result);



// -------------------------
//End Custom Code

//Close peticiones_previsiones_pr_lbl_total_BeforeShow @51-5079B18B
    return $peticiones_previsiones_pr_lbl_total_BeforeShow;
}
//End Close peticiones_previsiones_pr_lbl_total_BeforeShow

//peticiones_previsiones_pr_BeforeShow @2-D6EFB38D
function peticiones_previsiones_pr_BeforeShow(& $sender)
{
    $peticiones_previsiones_pr_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_previsiones_pr; //Compatibility
//End peticiones_previsiones_pr_BeforeShow

//Custom Code @154-2A29BDB7
// -------------------------
    
  	$s_fecha_ini=CCGetParam("s_fecha_ini","");
  	$s_fecha_fin=CCGetParam("s_fecha_fin","");
  
  	if ($s_fecha_ini=="" || $s_fecha_fin=="") {
  		$peticiones_previsiones_pr->Visible=false;
  	}

// -------------------------
//End Custom Code

//Close peticiones_previsiones_pr_BeforeShow @2-90F2B73E
    return $peticiones_previsiones_pr_BeforeShow;
}
//End Close peticiones_previsiones_pr_BeforeShow

//DEL  // -------------------------
//DEL      global $peticiones_previsiones_pr;
//DEL      // Write your own code here.
//DEL  	$s_fecha_ini=CCGetParam("s_fecha_ini","");
//DEL  	$s_fecha_fin=CCGetParam("s_fecha_fin","");
//DEL  
//DEL  	if ($s_fecha_ini=="" || $s_fecha_fin=="") {
//DEL  		$peticiones_previsiones_pr->Errors->AddError("Debe especificar Fecha de Inicio y Término");
//DEL  	}
//DEL  
//DEL  
//DEL  
//DEL  // -------------------------

//Impresion_Imprimir_OnClick @79-D2F27BC5
function Impresion_Imprimir_OnClick(& $sender)
{
    $Impresion_Imprimir_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Impresion; //Compatibility
//End Impresion_Imprimir_OnClick

//Custom Code @83-63E45ABC
// -------------------------
    global $Impresion;

	$prevision_id  =$Impresion->s_prevision_id->GetValue();
	$procedencia_id=$Impresion->s_procedencia_id->GetValue();
	$s_fecha_ini=$Impresion->s_fecha_ini->GetValue();
	$s_fecha_fin=$Impresion->s_fecha_fin->GetValue();
	$s_detallado=$Impresion->s_detallado->GetValue();

	$rutareporte=$_SERVER["SERVER_ADDR"];

	$fecha_ini=CCFormatDate($s_fecha_ini, Array("yyyy", "/", "mm", "/", "dd"));
	$fecha_fin=CCFormatDate($s_fecha_fin, Array("yyyy", "/", "mm", "/", "dd"));
	
	$subtitulo="PERIODO: ". CCFormatDate($s_fecha_ini, Array("dd", "/", "mm", "/", "yyyy")) ." - " . CCFormatDate($s_fecha_ini, Array("dd", "/", "mm", "/", "yyyy")) ;

	$cond_fecha=" peticiones.fecha BETWEEN '$fecha_ini' AND '$fecha_fin' ";
	
	$cond="((peticiones.prevision_id='$prevision_id' or ''='$prevision_id') and (peticiones.procedencia_id='$procedencia_id' or ''='$procedencia_id') and ($cond_fecha))";

	if ($s_detallado=="1") {
		$Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=stat_liquidacion_detalle&aliasname=REPORTE&username=lab&password=lab&ParamCONDICION=$cond&ParamSUBTITULO=$subtitulo";

	} else {

		$Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=stat_liquidacion&aliasname=REPORTE&username=lab&password=lab&ParamCONDICION=$cond&ParamSUBTITULO=$subtitulo";
	}

	header("Location: $Redirect");
	exit;
//End Custom Code

//Close Impresion_Imprimir_OnClick @79-36203C69
    return $Impresion_Imprimir_OnClick;
}
//End Close Impresion_Imprimir_OnClick

//Impresion_BeforeShow @73-E5899FB9
function Impresion_BeforeShow(& $sender)
{
    $Impresion_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Impresion; //Compatibility
//End Impresion_BeforeShow

//Custom Code @153-2A29BDB7
// -------------------------

	$fecha_ini=CCGetParam("s_fecha_ini","");
	$fecha_fin=CCGetParam("s_fecha_fin","");

	if ($fecha_fin=="" || $fecha_ini=="") $Impresion->Visible=false;

// -------------------------
//End Custom Code

//Close Impresion_BeforeShow @73-94D63C52
    return $Impresion_BeforeShow;
}
//End Close Impresion_BeforeShow

//Page_BeforeOutput @1-DA31D815
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $stat_liquidacion; //Compatibility
//End Page_BeforeOutput

//Custom Code @152-2A29BDB7
// -------------------------

	CorrigeCodigoEx();


// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

?>
