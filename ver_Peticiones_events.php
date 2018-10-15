<?php
//BindEvents Method @1-C850C7F4
function BindEvents()
{
    global $peticiones_estados_estado;
    global $CCSEvents;
    $peticiones_estados_estado->peticiones_estados_estado_TotalRecords->CCSEvents["BeforeShow"] = "peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow";
    $peticiones_estados_estado->CCSEvents["BeforeShowRow"] = "peticiones_estados_estado_BeforeShowRow";
    $peticiones_estados_estado->ds->CCSEvents["BeforeBuildSelect"] = "peticiones_estados_estado_ds_BeforeBuildSelect";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow @132-C317F3E7
function peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow(& $sender)
{
    $peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_estados_estado; //Compatibility
//End peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow

//Retrieve number of records @133-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow @132-1381E8CB
    return $peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow;
}
//End Close peticiones_estados_estado_peticiones_estados_estado_TotalRecords_BeforeShow

//peticiones_estados_estado_BeforeShowRow @105-7DA35F1E
function peticiones_estados_estado_BeforeShowRow(& $sender)
{
    $peticiones_estados_estado_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_estados_estado; //Compatibility
//End peticiones_estados_estado_BeforeShowRow

//Custom Code @175-572E2893
// -------------------------
    global $peticiones_estados_estado;

	$db=new clsDBDatos();

	$pid=$peticiones_estados_estado->pid->GetValue();
	$db->query("SELECT count(*) FROM bitacora WHERE tipo_bitacora_id=1 AND estado_id=1000 AND peticion_id=$pid");
	$qty=($db->next_record()) ? $db->f(0) : "";

	if ($qty==0) {
		$qty="&nbsp;";
		$peticiones_estados_estado->pendiente->SetValue($qty);
		$peticiones_estados_estado->img_pendiente->SetValue("");
		$peticiones_estados_estado->img_pendiente->SetLink("Javascript:alert('No hay Pendientes');");

	} else {
		$peticiones_estados_estado->pendiente->SetValue($qty);
		$peticiones_estados_estado->img_pendiente->SetValue("<img src=\"images/rojo.gif\" border=\"0\" align=\"absMiddle\">");
		$peticiones_estados_estado->img_pendiente->SetLink("JavaScript:openWindow('det_pendientes.php?peticion_id=$pid', 'DetPendientes', 500, 500, 'auto', 50, 50);");
	}

	unset($db);



// -------------------------
//End Custom Code

//Close peticiones_estados_estado_BeforeShowRow @105-7178D18C
    return $peticiones_estados_estado_BeforeShowRow;
}
//End Close peticiones_estados_estado_BeforeShowRow

//peticiones_estados_estado_ds_BeforeBuildSelect @105-4903AC09
function peticiones_estados_estado_ds_BeforeBuildSelect(& $sender)
{
    $peticiones_estados_estado_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_estados_estado; //Compatibility
//End peticiones_estados_estado_ds_BeforeBuildSelect

//Custom Code @201-572E2893
// -------------------------
    global $peticiones_estados_estado;

	$s_peticion_id=CCGetParam("s_peticion_id","");
	$s_rut=CCGetParam("s_rut","");

	if ($s_peticion_id != ""){

		$cond="peticiones.peticion_id=$s_peticion_id ";
		$peticiones_estados_estado->ds->Where=$cond ;
	}

	if ($s_rut != ""){

		$cond="pacientes.rut like '%$s_rut%' ";
		$peticiones_estados_estado->ds->Where=$cond ;
	}


	

//	echo $peticiones_estados_estado->ds->Where;
	

    // Write your own code here.
// -------------------------
//End Custom Code

//Close peticiones_estados_estado_ds_BeforeBuildSelect @105-E1647C5E
    return $peticiones_estados_estado_ds_BeforeBuildSelect;
}
//End Close peticiones_estados_estado_ds_BeforeBuildSelect

//Page_BeforeOutput @1-AB0455B2
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ver_Peticiones; //Compatibility
//End Page_BeforeOutput

//Custom Code @204-2A29BDB7
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
//DEL  // -------------------------
//DEL      global $ver_Peticiones;
//DEL      // Write your own code here.
//DEL  
//DEL  	die(GetUserProcedenciaID());
//DEL  
//DEL  // -------------------------


//DEL  // -------------------------
//DEL      global $peticiones_estados_estado;
//DEL      // Write your own code here.
//DEL  
//DEL  
//DEL  	$db=new clsDBDatos();
//DEL  
//DEL  	$pid=$peticiones_estados_estado->pid->GetValue();
//DEL  	$db->query("SELECT count(*) FROM bitacora WHERE tipo_bitacora_id=1 AND estado_id=1000 AND peticion_id=$pid");
//DEL  	$qty=($db->next_record()) ? $db->f(0) : "";
//DEL  
//DEL  	if ($qty==0) {
//DEL  		$qty="&nbsp;";
//DEL  		$peticiones_estados_estado->pendiente->SetValue($qty);
//DEL  		$peticiones_estados_estado->img_pendiente->SetValue("");
//DEL  	} else {
//DEL  		$peticiones_estados_estado->pendiente->SetValue($qty);
//DEL  		$peticiones_estados_estado->img_pendiente->SetValue("<img src=\"images/yellowball.gif\" border=\"0\"> ");
//DEL  	}
//DEL  
//DEL  	unset($db);
//DEL  
//DEL  
//DEL  
//DEL  
//DEL  // -------------------------


//DEL  // -------------------------
//DEL      global $peticiones_pacientes_proc;
//DEL      // Write your own code here.
//DEL  
//DEL  
//DEL  	$db=new clsDBDatos();
//DEL  
//DEL  	$pid=$peticiones_pacientes_proc->peticion_id->GetText();
//DEL  	$db->query("SELECT count(*) FROM bitacora WHERE tipo_bitacora_id=1 AND estado_id=1000 AND peticion_id=$pid");
//DEL  	$qty=($db->next_record()) ? $db->f(0) : "";
//DEL  	$peticiones_pacientes_proc->lblPendiente->SetValue($qty);
//DEL  
//DEL  
//DEL  	$Alt_pid=$peticiones_pacientes_proc->Alt_peticion_id->GetText();
//DEL  	$db->query("SELECT count(*) FROM bitacora WHERE tipo_bitacora_id=1 AND estado_id=1000 AND peticion_id=$Alt_pid");
//DEL  	$qty=($db->next_record()) ? $db->f(0) : "";
//DEL  	$peticiones_pacientes_proc->Alt_lblPendiente->SetValue($qty);
//DEL  
//DEL  	unset($db);
//DEL  
//DEL  
//DEL  // -------------------------


//Custom Code @103-5C6A2E12
// -------------------------
    global $peticiones_pacientes_proc;

	


?>
