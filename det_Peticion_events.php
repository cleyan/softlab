<?php
//BindEvents Method @1-B8FCA137
function BindEvents()
{
    global $grdDetalles;
    global $DetBitacora;
    global $CCSEvents;
    $grdDetalles->lnk_detalles->CCSEvents["BeforeShow"] = "grdDetalles_lnk_detalles_BeforeShow";
    $grdDetalles->CCSEvents["BeforeShowRow"] = "grdDetalles_BeforeShowRow";
    $DetBitacora->lnkAccion->CCSEvents["BeforeShow"] = "DetBitacora_lnkAccion_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//grdDetalles_lnk_detalles_BeforeShow @861-56273DF1
function grdDetalles_lnk_detalles_BeforeShow(& $sender)
{
    $grdDetalles_lnk_detalles_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grdDetalles; //Compatibility
//End grdDetalles_lnk_detalles_BeforeShow

//Custom Code @977-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

    global $grdDetalles;
  
  	$condetalle=CCGetParam("condetalle","V");
  	$peticion_id=CCGetParam("peticion_id","0");
 
	if ($condetalle=='V') {
		$grdDetalles->lnk_detalles->SetValue('<img src="images/sumar.png" border="0">');
  		$grdDetalles->lnk_detalles->Parameters = CCAddParam($grdDetalles->lnk_detalles->Parameters, "condetalle", "X");
  		$grdDetalles->lnk_detalles->Parameters = CCAddParam($grdDetalles->lnk_detalles->Parameters, "peticion_id", "$peticion_id");
  	} else {
  		$grdDetalles->lnk_detalles->SetValue('<img src="images/restar.png" border="0">');
  		$grdDetalles->lnk_detalles->Parameters = CCAddParam($grdDetalles->lnk_detalles->Parameters, "condetalle", "V");
  		$grdDetalles->lnk_detalles->Parameters = CCAddParam($grdDetalles->lnk_detalles->Parameters, "peticion_id", "$peticion_id");
  	}
  
 
  	//Ruta del recibo y Hoja de trabajo
  	$ruta="../cgi-bin/repwebexe/execute.pdf?reportname=orden_examen&aliasname=REPORTE&username=lab&password=lab&ParamPETICIONID=$peticion_id";
  
  	$grdDetalles->lnkRecibo->SetLink( "JavaScript:openWindow('$ruta', 'Recibo', 500, 500, 'auto', 50, 50);");
  
  	$grdDetalles->lnkPendientes->SetLink( "JavaScript:openWindow('add_pendientes.php?peticion_id=$peticion_id', 'AddPendientes', 500, 500, 'auto', 50, 50);");
  	
// -------------------------
//End Custom Code

//Close grdDetalles_lnk_detalles_BeforeShow @861-74460049
    return $grdDetalles_lnk_detalles_BeforeShow;
}
//End Close grdDetalles_lnk_detalles_BeforeShow


//grdDetalles_BeforeShowRow @732-500E42FE
function grdDetalles_BeforeShowRow(& $sender)
{
    $grdDetalles_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grdDetalles; //Compatibility
//End grdDetalles_BeforeShowRow

//Custom Code @787-AFFC7842
// -------------------------
    global $grdDetalles;

	$decompuesto=$grdDetalles->decompuesto->GetValue();
	if ($decompuesto=="V"){
		$grdDetalles->lbl_class->SetValue(" class=\"InLineAltDataTD\"");
		$grdDetalles->lbl_hidden->SetValue('style="VISIBILITY: hidden"');
		$grdDetalles->precio->SetValue(0);

	} else {

		$grdDetalles->lbl_class->SetValue(" class=\"InLineDataTD\"");
		//$grdDetalles->lbl_info->SetValue('<img src="images/treemenu/plustop.gif" align="left">');
		$grdDetalles->lbl_hidden->SetValue('');
	}


// -------------------------
//End Custom Code

//Close grdDetalles_BeforeShowRow @732-1176E1E8
    return $grdDetalles_BeforeShowRow;
}
//End Close grdDetalles_BeforeShowRow

//DetBitacora_lnkAccion_BeforeShow @942-498254D3
function DetBitacora_lnkAccion_BeforeShow(& $sender)
{
    $DetBitacora_lnkAccion_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $DetBitacora; //Compatibility
//End DetBitacora_lnkAccion_BeforeShow

//Custom Code @945-8492B688
// -------------------------
    global $DetBitacora;

	$peticion_id=CCGetParam("peticion_id","");
	$accionbitacora=CCGetParam("accionbitacora","");

	$bitacora_id=$DetBitacora->bitacora_id->GetValue();
	$tipo_bitacora_id=$DetBitacora->tipo_bitacora_id->GetValue();
	$estado_id=$DetBitacora->estado_id->GetValue();

	if ($bitacora_id > 0   &&  $estado_id==1000  && $tipo_bitacora_id>0){
		$DetBitacora->lnkAccion->SetValue("<img src=\"images/btns_Cerrar.png \" border=\"0\"> ");
		$DetBitacora->lnkAccion->SetLink("det_Peticion.php?bitacora_id=$bitacora_id&tipo_bitacora_id=$tipo_bitacora_id&accionbitacora=cerrar&peticion_id=$peticion_id");
	} else {
		$DetBitacora->lnkAccion->SetValue("");
		$DetBitacora->lnkAccion->SetLink("JavaScript:Alert('No es un Pendiente Abierto');");
	}

// -------------------------
//End Custom Code

//Close DetBitacora_lnkAccion_BeforeShow @942-2E01A400
    return $DetBitacora_lnkAccion_BeforeShow;
}
//End Close DetBitacora_lnkAccion_BeforeShow

//Page_AfterInitialize @1-BBB059BE
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $det_Peticion; //Compatibility
//End Page_AfterInitialize

//Custom Code @904-22C12F2B
// -------------------------
    global $det_Peticion;
	global $lblRutaDetalle;
	global $fun_muestrarecibo;
	global $lblRecibo;

	$peticion_id=CCGetParam("peticion_id","");
	$lblRutaDetalle->SetValue("detalle_demoras.php?peticion_id=$peticion_id");
	$accion=CCGetParam("accion","");
	$accionbitacora=CCGetParam("accionbitacora","");
	$bitacora_id=CCGetParam("bitacora_id","");
	$fecha=date("Y/m/d H:i:s");
	$usuario_id=CCGetUserID();
	$usuario=GetUserName($usuario_id);
	$tipo_bitacora_id=CCGetParam("tipo_bitacora_id","");

	//Después de grabar manda si continuar ve el detalle de la grabación
	if($accion=="continuar") {
//		$fun_muestrarecibo->SetValue( "openWindow('$ruta', 'Recibo', 500, 500, 'auto', 50, 50);");
	}

	if ($accionbitacora=="cerrar" && $tipo_bitacora_id>0){
		//Primero cirra el caso
		$db=new clsDBDatos();
		$sql="UPDATE bitacora SET estado_id=2000 WHERE bitacora_id=$bitacora_id AND peticion_id=$peticion_id";
		
		$db->query($sql);
		
		//Ahora graba quien la cerró
		$sql="INSERT INTO `bitacora` ( `bitacora_id` , 
									   `peticion_id` , 
									   `fecha` , 
									   `descripcion` , 
									   `tipo_bitacora_id` , 
									   `usuario_id` , 
									   `estado_id` , `nivel_id` )
							  VALUES (
										'', 
										'$peticion_id', 
										'$fecha', 
										'Pendiente cerrado por: $usuario', 
										'3', 
										'$usuario_id', 
										'4000', 
										'14')";	
		$db->query($sql);
		unset($db);

	}
	

	//die("<pre>". print_r($_REQUEST ,true). "<pre>");

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-4B02E1EC
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $det_Peticion; //Compatibility
//End Page_BeforeOutput

//Custom Code @981-2A29BDB7
// -------------------------


	CorrigeCodigoEx();


// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

?>
