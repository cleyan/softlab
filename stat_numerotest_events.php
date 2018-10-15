<?php
//BindEvents Method @1-300A64EC
function BindEvents()
{
    global $peticiones_previsiones_pr;
    global $Impresion;
    global $CCSEvents;
    $peticiones_previsiones_pr->CCSEvents["BeforeSelect"] = "peticiones_previsiones_pr_BeforeSelect";
    $Impresion->Imprimir->CCSEvents["OnClick"] = "Impresion_Imprimir_OnClick";
    $Impresion->CCSEvents["BeforeShow"] = "Impresion_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_previsiones_pr_BeforeSelect @2-1F031B0D
function peticiones_previsiones_pr_BeforeSelect(& $sender)
{
    $peticiones_previsiones_pr_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_previsiones_pr; //Compatibility
//End peticiones_previsiones_pr_BeforeSelect

//Custom Code @140-2A29BDB7
// -------------------------
	$s_fecha_ini=CCGetParam("s_fecha_ini","");
	$s_fecha_fin=CCGetParam("s_fecha_fin","");

	if ($s_fecha_ini=="" || $s_fecha_fin=="") {
		$peticiones_previsiones_pr->Visible=false;
	}

// -------------------------
//End Custom Code

//Close peticiones_previsiones_pr_BeforeSelect @2-BB1496A8
    return $peticiones_previsiones_pr_BeforeSelect;
}
//End Close peticiones_previsiones_pr_BeforeSelect

//DEL  // -------------------------
//DEL      global $peticiones_previsiones_pr;
//DEL      // Write your own code here.
//DEL  
//DEL  	$peticiones_previsiones_pr->Label1->SetValue($peticiones_previsiones_pr->ds->SQL . '<br/>' . $peticiones_previsiones_pr->ds->Where);
//DEL  
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $peticiones_previsiones_pr;
//DEL      // Write your own code here.
//DEL  
//DEL  	$s_fecha_ini=CCGetParam("s_fecha_ini","");
//DEL  	$s_fecha_fin=CCGetParam("s_fecha_fin","");
//DEL  
//DEL  	if ($s_fecha_ini=="" || $s_fecha_fin=="") {
//DEL  		$peticiones_previsiones_pr->Errors->AddError("Debe especificar Fecha de Inicio y Término");
//DEL  	}
//DEL  
//DEL  // -------------------------

//Impresion_Imprimir_OnClick @119-D2F27BC5
function Impresion_Imprimir_OnClick(& $sender)
{
    $Impresion_Imprimir_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Impresion; //Compatibility
//End Impresion_Imprimir_OnClick

//Custom Code @120-63E45ABC
// -------------------------
    global $Impresion;

	$equipo_id  =$Impresion->s_equipo_id->GetValue();
	$procedencia_id=$Impresion->s_procedencia_id->GetValue();
	$s_fecha_ini=$Impresion->s_fecha_ini->GetValue();
	$s_fecha_fin=$Impresion->s_fecha_fin->GetValue();
	$s_decompuesto=$Impresion->s_decompuesto->GetValue();
	$s_agrupacion=$Impresion->s_agrupacion->GetValue();

//	$rutareporte=$_SERVER["SERVER_ADDR"];
	$rutareporte="..";

	$fecha_ini=CCFormatDate($s_fecha_ini, Array("yyyy", "/", "mm", "/", "dd"));
	$fecha_fin=CCFormatDate($s_fecha_fin, Array("yyyy", "/", "mm", "/", "dd"));
	
	$subtitulo="PERIODO: ". CCFormatDate($s_fecha_ini, Array("dd", "/", "mm", "/", "yyyy")) ." - " . CCFormatDate($s_fecha_ini, Array("dd", "/", "mm", "/", "yyyy")) ;

	$cond=" (test.aislado = 'V') AND " .
  		  "	(peticiones.fecha BETWEEN '$fecha_ini' AND '$fecha_fin') AND " .
		  " (peticiones_detalle.decompuesto = '$s_decompuesto' or 'X' = '$s_decompuesto') AND " .
		  " (peticiones.procedencia_id = $procedencia_id or '0'='$procedencia_id') AND " .
		  " (test.equipo_id=$equipo_id or '0' = '$equipo_id')";

	switch ($s_agrupacion) {
	     case 0:
		 //Sin agrupación
	         $Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=stat_numerotest_0&aliasname=REPORTE&username=lab&password=lab&ParamCONDICION=$cond&ParamSUBTITULO=$subtitulo";
	         break;
	     case 1:
		 //Agrupado por Sección
	         $Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=stat_numerotest_1&aliasname=REPORTE&username=lab&password=lab&ParamCONDICION=$cond&ParamSUBTITULO=$subtitulo";
	         break;
	     case 2:
		 //Agrupado por Equipo
	         $Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=stat_numerotest_2&aliasname=REPORTE&username=lab&password=lab&ParamCONDICION=$cond&ParamSUBTITULO=$subtitulo";
	         break;
	     case 3:
		 //Agrupado por Procedencia
	         $Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=stat_numerotest_3&aliasname=REPORTE&username=lab&password=lab&ParamCONDICION=$cond&ParamSUBTITULO=$subtitulo";
	         break;

	     default:
	         $Redirect="";
	}

	if ($Redirect != "") {
		header("Location: $Redirect");
		exit;
	}

// -------------------------
//End Custom Code

//Close Impresion_Imprimir_OnClick @119-36203C69
    return $Impresion_Imprimir_OnClick;
}
//End Close Impresion_Imprimir_OnClick

//Impresion_BeforeShow @112-E5899FB9
function Impresion_BeforeShow(& $sender)
{
    $Impresion_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Impresion; //Compatibility
//End Impresion_BeforeShow

//Custom Code @139-2A29BDB7
// -------------------------
  	$s_fecha_ini=CCGetParam("s_fecha_ini","");
  	$s_fecha_fin=CCGetParam("s_fecha_fin","");
  
  	if ($s_fecha_ini=="" || $s_fecha_fin=="") {
  		$Impresion->Visible=false;
  	}

// -------------------------
//End Custom Code

//Close Impresion_BeforeShow @112-94D63C52
    return $Impresion_BeforeShow;
}
//End Close Impresion_BeforeShow

//Page_BeforeOutput @1-E5D8AB66
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $stat_numerotest; //Compatibility
//End Page_BeforeOutput

//Custom Code @138-2A29BDB7
// -------------------------
    // Write your own code here.
	global $peticiones_previsiones_pr;
	global $main_block;

	$s_procedencia_id=CCGetParam("s_procedencia_id","");
	$s_equipo_id=CCGetParam("s_equipo_id","");
	$s_fecha_ini=CCGetParam("s_fecha_ini","");
	$s_fecha_fin=CCGetParam("s_fecha_fin","");
	$s_decompuesto=CCGetParam("s_decompuesto","");

	
	$link="stat_numerotest.php?accion=exportar&s_procedencia_id=$scprocedencia_id&s_equipo_id=$s_equipo_id&s_fecha_ini=$s_fecha_ini&s_fecha_fin=$s_fecha_fin&s_decompuesto=$s_decompuesto";
	$link="<a href=\"$link\">Exportar a Excel</a>";

	$main_block=str_replace("EXPORTARXLS",$link,$main_block);


	if (CCGetParam("accion","") == "exportar"){

			include(RelativePath . "/stat_reporte_test_inc.php");
						
			$sql=str_replace("{SQL_OrderBy}", " ORDER BY " . $peticiones_previsiones_pr->DataSource->Order, $peticiones_previsiones_pr->DataSource->SQL );
				  
			$cabeza="Cód.Fonasa|Cód.Test|Test|Cantidad";
				 
			//die($sql);

			$newexport= new Exportar($sql, "Stat_nrotest.xls", "Test Realizados", "Nº De Test realizados $s_fecha_ini - $s_fecha_fin Procedencia: $s_procedencia_id  Equipo: $s_equipo_id", $cabeza);
			$newexport->Generar(true);				

	}

// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput
//DEL  // -------------------------
//DEL      global $peticiones_previsiones_pr;
//DEL      global $DBDatos;
//DEL  
//DEL  	$peticion_id=$peticiones_previsiones_pr->s_peticion_id->GetValue();
//DEL  
//DEL      $result = CCDLookUp("sum(precio) as total", "peticiones_detalle", "peticion_id=$peticion_id", $DBDatos);
//DEL      $result = intval($result);
//DEL      $peticiones_previsiones_pr->lbl_total->SetValue($result);
//DEL  
//DEL  
//DEL  
//DEL  // -------------------------



?>
