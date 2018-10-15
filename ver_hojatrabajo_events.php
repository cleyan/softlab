<?php
//BindEvents Method @1-DAB45700
function BindEvents()
{
    global $peticiones_detalle_test_s;
    global $CCSEvents;
    $peticiones_detalle_test_s->peticiones_detalle_test_s_TotalRecords->CCSEvents["BeforeShow"] = "peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow";
    $peticiones_detalle_test_s->ds->CCSEvents["AfterExecuteSelect"] = "peticiones_detalle_test_s_ds_AfterExecuteSelect";
    $peticiones_detalle_test_s->CCSEvents["BeforeShow"] = "peticiones_detalle_test_s_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow @34-A60C6391
function peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow(& $sender)
{
    $peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_detalle_test_s; //Compatibility
//End peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow

//Retrieve number of records @35-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow @34-233633B6
    return $peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow;
}
//End Close peticiones_detalle_test_s_peticiones_detalle_test_s_TotalRecords_BeforeShow

//peticiones_detalle_test_s_ds_AfterExecuteSelect @2-07C60178
function peticiones_detalle_test_s_ds_AfterExecuteSelect(& $sender)
{
    $peticiones_detalle_test_s_ds_AfterExecuteSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_detalle_test_s; //Compatibility
//End peticiones_detalle_test_s_ds_AfterExecuteSelect

//Custom Code @428-4CCE53EA
// -------------------------
    global $peticiones_detalle_test_s;
	global $fun_imprimir;

	$cadena="1";

	if ($peticiones_detalle_test_s->ds->RecordsCount) {

        $s_test_equipo_id 	= CCGetFromGet("s_test_equipo_id", "");
        $s_secciones_id 	= CCGetFromGet("s_secciones_id", "");
        $s_fecha 			= CCGetFromGet("s_fecha", "");
		$s_estado_id		= CCGetFromGet("s_estado_id", "");
 		
		if ($s_test_equipo_id != "") $cadena.=" AND test.equipo_id = $s_test_equipo_id";
		if ($s_secciones_id != "") $cadena.=" AND test.secciones_id  = $s_secciones_id";
		if ($s_fecha != "") {

			//echo "Fecha antes de convertir: $s_fecha<br>";
			$s_fecha = fecha_de_mysql($s_fecha);
			
			$cadena.=" AND peticiones.fecha  = \'$s_fecha\'";
		}
		if ($s_estado_id != "") $cadena.=" AND peticiones_detalle.estado_id = $s_estado_id";

		//echo $cadena ;	

		$comando="openWindow('../cgi-bin/repwebexe/execute.pdf?reportname=hoja_carga&aliasname=REPORTE&username=lab&password=lab&ParamCONDICION=$cadena', 'Hoja_de_Carga', 500, 500, 'auto', 50, 50);";
		$fun_imprimir->SetValue("$comando");
	} else {
		$fun_imprimir->SetValue("alert('No hay Registros para imprimir');");
	}
	


// -------------------------
//End Custom Code

//Close peticiones_detalle_test_s_ds_AfterExecuteSelect @2-A38DE459
    return $peticiones_detalle_test_s_ds_AfterExecuteSelect;
}
//End Close peticiones_detalle_test_s_ds_AfterExecuteSelect

//peticiones_detalle_test_s_BeforeShow @2-C6DC1A52
function peticiones_detalle_test_s_BeforeShow(& $sender)
{
    $peticiones_detalle_test_s_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_detalle_test_s; //Compatibility
//End peticiones_detalle_test_s_BeforeShow

//Custom Code @442-2A29BDB7
// -------------------------
    if ($peticiones_detalle_test_s->DataSource->RecordsCount>0) {
		$peticiones_detalle_test_s->Visible=true;
	} else {
		$peticiones_detalle_test_s->Visible=false;
		echo msgbox("No hay registros que conincidan con el criterio de búsqueda");
	}
// -------------------------
//End Custom Code

//Close peticiones_detalle_test_s_BeforeShow @2-2F3B2B34
    return $peticiones_detalle_test_s_BeforeShow;
}
//End Close peticiones_detalle_test_s_BeforeShow

//Page_BeforeOutput @1-E008F029
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ver_hojatrabajo; //Compatibility
//End Page_BeforeOutput

//Custom Code @439-2A29BDB7
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
