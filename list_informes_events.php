<?php
//BindEvents Method @1-1C99848F
function BindEvents()
{
    global $informe_datosSearch;
    global $informe_datos;
    global $informe_datos2;
    global $Panel1;
    global $informe_datos1;
    global $CCSEvents;
    $informe_datosSearch->Panel1->CCSEvents["BeforeShow"] = "informe_datosSearch_Panel1_BeforeShow";
    $informe_datos->ds->CCSEvents["AfterExecuteSelect"] = "informe_datos_ds_AfterExecuteSelect";
    $informe_datos->ds->CCSEvents["BeforeExecuteSelect"] = "informe_datos_ds_BeforeExecuteSelect";
    $informe_datos2->CCSEvents["BeforeShowRow"] = "informe_datos2_BeforeShowRow";
    $informe_datos2->ds->CCSEvents["BeforeExecuteSelect"] = "informe_datos2_ds_BeforeExecuteSelect";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $informe_datos1->ds->CCSEvents["BeforeExecuteSelect"] = "informe_datos1_ds_BeforeExecuteSelect";
    $informe_datos1->CCSEvents["BeforeShowRow"] = "informe_datos1_BeforeShowRow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//informe_datosSearch_Panel1_BeforeShow @105-CE421EA4
function informe_datosSearch_Panel1_BeforeShow(& $sender)
{
    $informe_datosSearch_Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datosSearch; //Compatibility
//End informe_datosSearch_Panel1_BeforeShow

//Custom Code @106-2A29BDB7
// -------------------------
    // Write your own code here.
	if (CCGetGroupID() >11 ) { 
		$informe_datosSearch->Panel1->Visible=true;
	} else {
		$informe_datosSearch->Panel1->Visible=false;
	}

// -------------------------
//End Custom Code

//Close informe_datosSearch_Panel1_BeforeShow @105-8F067A40
    return $informe_datosSearch_Panel1_BeforeShow;
}
//End Close informe_datosSearch_Panel1_BeforeShow

//informe_datos_ds_AfterExecuteSelect @2-577CE5C8
function informe_datos_ds_AfterExecuteSelect(& $sender)
{
    $informe_datos_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datos; //Compatibility
//End informe_datos_ds_AfterExecuteSelect

//Custom Code @32-6107A570
// -------------------------
    global $informe_datos;
    // Write your own code here.

	//Informacion para depurar
	$debug=CCGetParam("debug","");
	
	if ($debug==1){
		print("<br><br><b>Consulta After:</b> " .  $informe_datos->ds->SQL  . " " .   $informe_datos->ds->Where);
	}
// -------------------------
//End Custom Code

//Close informe_datos_ds_AfterExecuteSelect @2-A37DC159
    return $informe_datos_ds_AfterExecuteSelect;
}
//End Close informe_datos_ds_AfterExecuteSelect

//informe_datos_ds_BeforeExecuteSelect @2-3DC68901
function informe_datos_ds_BeforeExecuteSelect(& $sender)
{
    $informe_datos_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datos; //Compatibility
//End informe_datos_ds_BeforeExecuteSelect

//Custom Code @72-6107A570
// -------------------------
    global $informe_datos;

	$s_peticion_id=CCGetParam("s_peticion_id","");
	$s_paciente=CCGetParam("s_paciente","");

    $s_fecha_ini	=CCGetParam("s_fecha_ini",""); 
    $s_fecha_fin	=CCGetParam("s_fecha_fin","");


	if ($s_peticion_id!=""){
		
		$db = new clsDBDatos();
		$sql="SELECT procedencia_id FROM informe_datos WHERE peticion_id = $s_peticion_id";
		$db->query($db);
		$s_procedencia_id=($db->next_record()) ? $db->f(0) : 0;
		unset($db);


		if((CCGetGroupID() <= 4) && (GetUserProcedenciaID() != $s_procedencia_id)){
			header("Location: list_informes.php?aviso=Sus permisos no permiten ver Informes de otras procedencias");
			exit;
		}

		$sql="SELECT DISTINCT informe_datos.peticion_id, pacientes.nombres, pacientes.apellidos , informe_datos.fecha FROM informe_datos LEFT OUTER JOIN pacientes ON (informe_datos.paciente_id = pacientes.paciente_id) ".
			 " WHERE informe_datos.peticion_id= $s_peticion_id" ; 

		$informe_datos->ds->SQL=$sql;

	}

	if ($s_paciente!=""){
		
		$nom_pac=split(' ', $s_paciente);
		$condicion="";

		reset ($nom_pac);
		while (list ($clave, $val) = each ($nom_pac)) {
			if ($condicion!=""){
	        	$condicion .= " OR pacientes.nombres like '%$val%' OR  pacientes.apellidos like '%$val%' ";
			} else {
	            $condicion .= " pacientes.nombres like '%$val%' OR  pacientes.apellidos like '%$val%' ";
			}
			
		} 

		if(CCGetGroupID() <= 4) 
			$condicion .= " AND informe_datos.procedencia_id = " .  GetUserProcedenciaID();
			

		$sql="SELECT DISTINCT informe_datos.peticion_id, pacientes.nombres, pacientes.apellidos , informe_datos.fecha FROM informe_datos LEFT OUTER JOIN pacientes ON (informe_datos.paciente_id = pacientes.paciente_id) ".
			 " WHERE $condicion"; 

		$informe_datos->ds->SQL=$sql;

	}
	//Información para depurar
	$debug=CCGetParam("debug","");
	if ($debug==1){
		print("<br><b>Consulta Antes:</b> " .  $informe_datos->ds->SQL  . " " .   $informe_datos->ds->Where);
	}

/*
SELECT DISTINCT informe_datos.peticion_id, pacientes.nombres, pacientes.apellidos , informe_datos.fecha, informe_datos.fecha_firma FROM informe_datos LEFT OUTER JOIN pacientes ON (informe_datos.paciente_id = pacientes.paciente_id) 
WHERE 
  (informe_datos.peticion_id= {s_peticion_id} OR {s_peticion_id}=0) 
  AND (informe_datos.fecha BETWEEN '{s_fecha_ini}' AND '{s_fecha_fin}')
  AND (informe_datos.nombres LIKE '%{s_paciente}%' OR informe_datos.apellidos LIKE '%{s_paciente}%')
*/
// -------------------------
//End Custom Code

//Close informe_datos_ds_BeforeExecuteSelect @2-C0EF48C1
    return $informe_datos_ds_BeforeExecuteSelect;
}
//End Close informe_datos_ds_BeforeExecuteSelect

//informe_datos2_BeforeShowRow @112-6169C6C4
function informe_datos2_BeforeShowRow(& $sender)
{
    $informe_datos2_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datos2; //Compatibility
//End informe_datos2_BeforeShowRow

//Custom Code @130-6F165062
// -------------------------
    global $informe_datos1;
    // Write your own code here.


	$db=new clsDBDatos();


	$serie=$informe_datos1->serie->GetValue();
	$informe_id=$informe_datos1->informe_id->GetValue();


	$sql="SELECT fecha_firma, impreso, firma_nombre FROM informe_datos WHERE serie='$serie' AND informe_id=$informe_id LIMIT 1";

	$db->query($sql);

	if ($db->next_record()) {
		$impreso=$db->f('impreso');
		$fecha_firma=$db->f('fecha_firma');
		$firma_nombre=$db->f('firma_nombre');
	}
		
	unset($db);

	$peticion_id=CCGetParam("peticion_id","0");

	$condicion = "__P:$peticion_id" . "S:$serie" ."I:$informe_id";

	$informe_datos1->lbl_chk->SetValue("<input id=\"marca\" type=\"checkbox\" name=\"marca[]\" value=\"$condicion\">");

	if ($impreso=='V') {
		$informe_datos1->lbl_icono->SetValue('<img src="images/ico_test_imprimible.gif" title="Informe Impreso Anteriormente">');
	} else {
		$informe_datos1->lbl_icono->SetValue('');
	}	

	$informe_datos1->firma_nombre->SetValue($firma_nombre);
//	$informe_datos1->fecha_firma->SetValue($fecha_firma);



// -------------------------
//End Custom Code

//Close informe_datos2_BeforeShowRow @112-DACE55B3
    return $informe_datos2_BeforeShowRow;
}
//End Close informe_datos2_BeforeShowRow

//informe_datos2_ds_BeforeExecuteSelect @112-B5277F22
function informe_datos2_ds_BeforeExecuteSelect(& $sender)
{
    $informe_datos2_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datos2; //Compatibility
//End informe_datos2_ds_BeforeExecuteSelect

//Custom Code @131-2A29BDB7
// -------------------------
    $todos=CCGetParam("filtra","");
	$peticion_id=CCGetParam("peticion_id","0");

	if ($todos==1){
		$sql="SELECT DISTINCT serie, informe_id, nom_informe " .
			 " FROM informe_datos " .
			 " WHERE peticion_id = $peticion_id ";

		$informe_datos1->ds->SQL=$sql;

	}
// -------------------------
//End Custom Code

//Close informe_datos2_ds_BeforeExecuteSelect @112-CFAC48E6
    return $informe_datos2_ds_BeforeExecuteSelect;
}
//End Close informe_datos2_ds_BeforeExecuteSelect

//Panel1_BeforeShow @110-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @111-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @110-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//informe_datos1_ds_BeforeExecuteSelect @34-6A04D811
function informe_datos1_ds_BeforeExecuteSelect(& $sender)
{
    $informe_datos1_ds_BeforeExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datos1; //Compatibility
//End informe_datos1_ds_BeforeExecuteSelect

//Custom Code @134-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close informe_datos1_ds_BeforeExecuteSelect @34-3DFBA51E
    return $informe_datos1_ds_BeforeExecuteSelect;
}
//End Close informe_datos1_ds_BeforeExecuteSelect

//informe_datos1_BeforeShowRow @34-A41CE223
function informe_datos1_BeforeShowRow(& $sender)
{
    $informe_datos1_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informe_datos1; //Compatibility
//End informe_datos1_BeforeShowRow

//DEL  // -------------------------
//DEL      global $informe_datos1;
//DEL      // Write your own code here.
//DEL  
//DEL  
//DEL  	$db=new clsDBDatos();
//DEL  
//DEL  
//DEL  	$serie=$informe_datos1->serie->GetValue();
//DEL  	$informe_id=$informe_datos1->informe_id->GetValue();
//DEL  
//DEL  
//DEL  	$sql="SELECT fecha_firma, impreso, firma_nombre FROM informe_datos WHERE serie='$serie' AND informe_id=$informe_id LIMIT 1";
//DEL  
//DEL  	$db->query($sql);
//DEL  
//DEL  	if ($db->next_record()) {
//DEL  		$impreso=$db->f('impreso');
//DEL  		$fecha_firma=$db->f('fecha_firma');
//DEL  		$firma_nombre=$db->f('firma_nombre');
//DEL  	}
//DEL  		
//DEL  	unset($db);
//DEL  
//DEL  	$peticion_id=CCGetParam("peticion_id","0");
//DEL  
//DEL  	$condicion = "__P:$peticion_id" . "S:$serie" ."I:$informe_id";
//DEL  
//DEL  	$informe_datos1->lbl_chk->SetValue("<input id=\"marca\" type=\"checkbox\" name=\"marca[]\" value=\"$condicion\">");
//DEL  
//DEL  	if ($impreso=='V') {
//DEL  		$informe_datos1->lbl_icono->SetValue('<img src="images/ico_test_imprimible.gif" title="Informe Impreso Anteriormente">');
//DEL  	} else {
//DEL  		$informe_datos1->lbl_icono->SetValue('');
//DEL  	}	
//DEL  
//DEL  	$informe_datos1->firma_nombre->SetValue($firma_nombre);
//DEL  //	$informe_datos1->fecha_firma->SetValue($fecha_firma);
//DEL  
//DEL  
//DEL  
//DEL  // -------------------------

//Custom Code @135-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close informe_datos1_BeforeShowRow @34-89540E37
    return $informe_datos1_BeforeShowRow;
}
//End Close informe_datos1_BeforeShowRow

//DEL  // -------------------------
//DEL      $todos=CCGetParam("filtra","");
//DEL  	$peticion_id=CCGetParam("peticion_id","0");
//DEL  
//DEL  	if ($todos==1){
//DEL  		$sql="SELECT DISTINCT serie, informe_id, nom_informe " .
//DEL  			 " FROM informe_datos " .
//DEL  			 " WHERE peticion_id = $peticion_id ";
//DEL  
//DEL  		$informe_datos1->ds->SQL=$sql;
//DEL  
//DEL  	}
//DEL  // -------------------------

//Page_AfterInitialize @1-FDF69395
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_informes; //Compatibility
//End Page_AfterInitialize

//Custom Code @80-7F80E35E
// -------------------------
    global $list_informes;
	global $Redirect;

	$imprimir=CCGetParam("Imprimir","");

	if ($imprimir!= ""){    
		$marca=CCGetParam("marca","");
	    $s_fecha_ini	=CCGetParam("s_fecha_ini",""); 
	    $s_fecha_fin	=CCGetParam("s_fecha_fin","");
	    $s_paciente		=CCGetParam("s_paciente","");
	    $s_peticion_id	=CCGetParam("s_peticion_id",""); 
		$peticion_id	=CCGetParam("x_peticion_id",""); 
		$nom_paciente	=CCGetParam("nom_paciente",""); 

		$condicion="";
		reset ($marca);
		while (list ($clave, $val) = each ($marca)) {
			if ($condicion!=""){
	        	$condicion .= " OR CONCAT('__P:',peticion_id,'S:', serie, 'I:', informe_id) = '$val' ";
			} else {
	            $condicion .= " CONCAT('__P:',peticion_id,'S:', serie, 'I:', informe_id) = '$val' ";
			}
			
		} 

		//echo "CONDICION: $condicion";

		$rutareporte=$_SERVER["SERVER_ADDR"];

		if ($marca=="") {
			$Redirect="list_informes.php?aviso=No se ha seleccionado ningún informe&s_fecha_ini=$s_fecha_ini&s_fecha_fin=$s_fecha_fin&s_peticion_id=$s_peticion_id&s_paciente=$s_paciente&peticion_id=$peticion_id&s_nombres=$nom_paciente";
	
		} else {
			$db=new clsDBDatos();
			$db->query( "UPDATE informe_datos SET impreso='V' WHERE $condicion");
			unset($db);		

			$Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=reporte&aliasname=REPORTE&username=lab&password=lab&ParamFILTROSQL=$condicion";
		}

		header("Location: $Redirect");
		exit;		
	}




// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-786311F5
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_informes; //Compatibility
//End Page_BeforeOutput

//Custom Code @104-2A29BDB7
// -------------------------

	CorrigeCodigoEx();


// -------------------------
//End Custom Code

//Panel1UpdatePanel PageBeforeOutput @111-0DFF2749
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $_SERVER["REQUEST_URI"] . "|" . $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeInitialize @1-E540AA16
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_informes; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @111-37A82194
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $CCSLocales, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $CCSLocales->GetFormatInfo("PHPEncoding"));
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_BeforeShow @1-119E34F3
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_informes; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @111-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeUnload @1-4918E1E3
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_informes; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @111-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload


?>
