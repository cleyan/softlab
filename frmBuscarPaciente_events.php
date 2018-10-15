<?php
//BindEvents Method @1-9ED07D54
function BindEvents()
{
    global $pacientes;
    global $CCSEvents;
    $pacientes->pacientes_TotalRecords->CCSEvents["BeforeShow"] = "pacientes_pacientes_TotalRecords_BeforeShow";
    $pacientes->CCSEvents["BeforeShowRow"] = "pacientes_BeforeShowRow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//pacientes_pacientes_TotalRecords_BeforeShow @9-AAC32E44
function pacientes_pacientes_TotalRecords_BeforeShow(& $sender)
{
    $pacientes_pacientes_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_pacientes_TotalRecords_BeforeShow

//Retrieve number of records @10-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close pacientes_pacientes_TotalRecords_BeforeShow @9-31787783
    return $pacientes_pacientes_TotalRecords_BeforeShow;
}
//End Close pacientes_pacientes_TotalRecords_BeforeShow

//pacientes_BeforeShowRow @2-9859593E
function pacientes_BeforeShowRow(& $sender)
{
    $pacientes_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $pacientes; //Compatibility
//End pacientes_BeforeShowRow

//Custom Code @32-B5B910A1
// -------------------------
    global $pacientes;

	$cadena="'".$pacientes->paciente_id->GetValue()."' , '".$pacientes->nombres->GetValue()." ".$pacientes->apellidos->GetValue()."', '".$pacientes->prevision_id->GetValue()."'";
	$link_cadena="<a hidefocus href=\"#\" title=\"Elegir paciente\" onclick=\"SetOpenerValue($cadena);return false;\"> <img src=\"images/btns_Elegir.png\" border=\"0\"></a>";
	$pacientes->Aceptar->SetVAlue($link_cadena);

	$Alt_cadena="'".$pacientes->Alt_paciente_id->GetValue()."' , '".$pacientes->Alt_nombres->GetValue()." ".$pacientes->Alt_apellidos->GetValue()."', '".$pacientes->Alt_prevision_id->GetValue()."'" ;
	$Alt_link_cadena="<a hidefocus href=\"#\" title=\"Elegir paciente\" onclick=\"SetOpenerValue($Alt_cadena);return false;\"> <img src=\"images/btns_Elegir.png\" border=\"0\"></a>";
	$pacientes->Alt_Aceptar->SetVAlue($Alt_link_cadena);

// -------------------------
//End Custom Code

//Close pacientes_BeforeShowRow @2-40CD74C5
    return $pacientes_BeforeShowRow;
}
//End Close pacientes_BeforeShowRow

//Page_AfterInitialize @1-7E02AF0F
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $frmBuscarPaciente; //Compatibility
//End Page_AfterInitialize

//Custom Code @40-B5805C9C
// -------------------------
    global $frmBuscarPaciente;
	global $fn_eligeAuto;
    // Write your own code here.

	$origen=CCGetParam("origen","");
	$ultimo_id=CCGetParam("ultimoid","0");

	//print("GET:<pre>". print_r($_GET,true) . "</pre>");

	if ($origen=="desdeventana") {
	//	echo "<h1>VENTANA - $ultimo_id </h1>";
		$db= new clsDBDatos();
		$sql="SELECT paciente_id, nombres, apellidos, prevision_id FROM pacientes WHERE paciente_id=$ultimo_id";

		$db->query($sql);

	//print("SQL: $sql <br/>");

		if ($db->next_record()){
			$paciente_id= $db->f("paciente_id");
			$nombres	= $db->f("nombres");
			$apellidos	= $db->f("apellidos");
			$prevision_id=$db->f("prevision_id");

	//print("DB:<pre>" . print_r($db,true)  . "</pre>");

		}
		$lbl_funcion="SetOpenerValue('$paciente_id', '$nombres $apellidos', '$prevision_id');";
		
		$fn_eligeAuto->SetValue($lbl_funcion);

	//print("funcion: $lbl_funcion <br/>");

	//die("EQT: <pre>"  . print_r($fn_eligeAuto,true)  . "</pre>");

		unset($db);


	}

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-36719E12
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $frmBuscarPaciente; //Compatibility
//End Page_BeforeOutput

//Custom Code @58-2A29BDB7
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
