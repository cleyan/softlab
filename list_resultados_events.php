<?php
//BindEvents Method @1-5D7C0D44
function BindEvents()
{
    global $equipos_estados_pacientes;
    global $CCSEvents;
    $equipos_estados_pacientes->equipos_estados_pacientes_TotalRecords->CCSEvents["BeforeShow"] = "equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow";
    $equipos_estados_pacientes->CCSEvents["BeforeShow"] = "equipos_estados_pacientes_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//DEL  // -------------------------
//DEL      global $equipos_estados_pacientes;
//DEL  // -------------------------

//equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow @260-04D8117E
function equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow(& $sender)
{
    $equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $equipos_estados_pacientes; //Compatibility
//End equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow

//Retrieve number of records @261-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow @260-E4199FC1
    return $equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow;
}
//End Close equipos_estados_pacientes_equipos_estados_pacientes_TotalRecords_BeforeShow

//equipos_estados_pacientes_BeforeShow @2-08E8880A
function equipos_estados_pacientes_BeforeShow(& $sender)
{
    $equipos_estados_pacientes_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $equipos_estados_pacientes; //Compatibility
//End equipos_estados_pacientes_BeforeShow

//Custom Code @399-F3D68AFA
// -------------------------
    global $equipos_estados_pacientes;
	global $DBDatos;
    $s_rut = CCGetParam("s_rut","");
	$s_ficha = CCGetParam("s_ficha","");
	$s_nombres = CCGetParam("s_nombres","");
	$s_apellidos = CCGetParam("s_apellidos","");
	$s_cod_test = CCGetParam("s_cod_test","");
	$s_codigo_fonasa = CCGetParam("s_codigo_fonasa","");
	$s_nom_test = CCGetParam("s_nom_test","");
	$s_fecha = CCGetParam("s_fecha","");
	$s_muestra_id = CCGetParam("s_muestra_id","");
	$s_peticiones_procedencia_id = CCGetParam("s_peticiones_procedencia_id","");
	$s_peticiones_estado_id = CCGetParam("s_peticiones_estado_id","");
	$s_peticiones_detalle_prioridad_id = CCGetParam("s_peticiones_detalle_prioridad_id","");
	$s_test_equipo_id = CCGetParam("s_test_equipo_id","");
	$s_seccion_id = CCGetParam("s_seccion_id","");
	
	if($s_rut!="")  
		$msg .= "<b>Rut:</b> $s_rut<br/>";
	if($s_ficha!="")
		$msg .= "<b>Ficha:</b> $s_ficha<br/>";
	if($s_nombres!="")
		$msg .= "<b>Nombres:</b> $s_nombres<br/>";
	if($s_apellidos!="")
		$msg .= "<b>Apellidos:</b> $s_apellidos<br/>";
	if($s_cod_test!="" )
		$msg .= "<b>Código test:</b> $s_cod_test<br/>";
	if($s_codigo_fonasa!="")
		$msg .= "<b>código fonasa:</b> $s_codigo_fonasa<br/>";
	if($s_nom_test!="")
		$msg .= "<b>Test:</b> $s_nom_test<br/>";
	if($s_seccion_id!=""){
		$seccion = CCGetDBValue("SELECT nom_seccion FROM secciones WHERE seccion_id='$s_seccion_id'",$DBDatos);
		$msg.="<b>Sección:</b> $seccion<br/>";
	}
	if($s_fecha!="")
		$msg .= "<b>Fecha:</b> $s_fecha<br/>";
	if($s_muestra_id!="")
		$msg .= "<b>Muestra ID:</b> $s_muestra_id<br/>";
	if($s_peticiones_procedencia_id!=""){
		$procedencia = CCGetDBValue("SELECT nom_procedencia FROM procedencias WHERE procedencia_id='$s_peticiones_procedencia_id'",$DBDatos);
		$msg .= "<b>Procedencia:</b> $procedencia<br/>";
	}
	if($s_peticiones_estado_id!="" ){
		$estados = CCGetDBValue("SELECT nom_estado FROM estados WHERE estado_id='$s_peticiones_estado_id'",$DBDatos);
		$msg .= "<b>Estado:</b> $estados<br/>";
	}
	if($s_peticiones_detalle_prioridad_id!=""){
		$prioridad = CCGetDBValue("SELECT nom_prioridad FROM prioridades WHERE prioridad_id='$s_peticiones_detalle_prioridad_id'",$DBDatos);
		$msg .= "<b>Prioridad:</b> $prioridad<br/>";
	}
	if($s_test_equipo_id!=""){
		$equipo = CCGetDBValue("SELECT nom_equipo FROM equipos WHERE equipo_id='$s_test_equipo_id'",$DBDatos);
		$msg .= "<b>Equipo:</b> $equipo<br/>";
	}

	$tooltip_html = "toolTip('$msg','images/ayudita.gif','Detalle &nbsp;<a href=&quot;javascript:toolTip();&quot; >X</a>')";
	$tooltip="<a href=\"javascript:$tooltip_html\"><img border=\"0\" src=\"images/detalle.gif\" alt=\"Hacar click para ver detalle de filtro\"></a>";

	$equipos_estados_pacientes->op_filtro->SetValue($tooltip);
// -------------------------
//End Custom Code

//Close equipos_estados_pacientes_BeforeShow @2-FD605F8C
    return $equipos_estados_pacientes_BeforeShow;
}
//End Close equipos_estados_pacientes_BeforeShow

//Page_BeforeOutput @1-796AD5C7
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_resultados; //Compatibility
//End Page_BeforeOutput

//Custom Code @454-2A29BDB7
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
