<?php
//BindEvents Method @1-F9CD2503
function BindEvents()
{
    global $detalle_pago;
    global $CCSEvents;
    $detalle_pago->paciente->CCSEvents["BeforeShow"] = "detalle_pago_paciente_BeforeShow";
    $detalle_pago->lb_peticion_id->CCSEvents["BeforeShow"] = "detalle_pago_lb_peticion_id_BeforeShow";
    $detalle_pago->max_valor->CCSEvents["BeforeShow"] = "detalle_pago_max_valor_BeforeShow";
    $detalle_pago->fecha_ingreso->CCSEvents["BeforeShow"] = "detalle_pago_fecha_ingreso_BeforeShow";
    $detalle_pago->lb_max_valor->CCSEvents["BeforeShow"] = "detalle_pago_lb_max_valor_BeforeShow";
    $detalle_pago->CCSEvents["OnValidate"] = "detalle_pago_OnValidate";
    $detalle_pago->CCSEvents["AfterUpdate"] = "detalle_pago_AfterUpdate";
    $detalle_pago->CCSEvents["AfterDelete"] = "detalle_pago_AfterDelete";
    $detalle_pago->CCSEvents["AfterInsert"] = "detalle_pago_AfterInsert";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//detalle_pago_paciente_BeforeShow @19-B9AC97DD
function detalle_pago_paciente_BeforeShow(& $sender)
{
    $detalle_pago_paciente_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_paciente_BeforeShow

//Custom Code @20-A4C49402
// -------------------------
    global $detalle_pago;
    $peticion_id = $detalle_pago->peticion_id->GetValue();
	$db = new clsDBDatos();
	if($peticion_id!=""){
		$db->query("SELECT paciente_id FROM peticiones WHERE peticion_id=$peticion_id");
		if($db->next_record())
			$paciente_id = $db->f("paciente_id");
		if($paciente_id!=""){
			$db->query("SELECT nombres, apellidos FROM pacientes WHERE paciente_id=$paciente_id");
			if($db->next_record())
				$nombre = $db->f("nombres")." ".$db->f("apellidos");
		}
		$detalle_pago->paciente->SetValue($nombre);
	}
// -------------------------
//End Custom Code

//Close detalle_pago_paciente_BeforeShow @19-32A7562F
    return $detalle_pago_paciente_BeforeShow;
}
//End Close detalle_pago_paciente_BeforeShow

//detalle_pago_lb_peticion_id_BeforeShow @17-AFFDE0F0
function detalle_pago_lb_peticion_id_BeforeShow(& $sender)
{
    $detalle_pago_lb_peticion_id_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_lb_peticion_id_BeforeShow

//Custom Code @25-A4C49402
// -------------------------
    global $detalle_pago;
    $detalle_pago->lb_peticion_id->SetValue($detalle_pago->peticion_id->GetValue());
// -------------------------
//End Custom Code

//Close detalle_pago_lb_peticion_id_BeforeShow @17-8A36A29E
    return $detalle_pago_lb_peticion_id_BeforeShow;
}
//End Close detalle_pago_lb_peticion_id_BeforeShow

//detalle_pago_max_valor_BeforeShow @26-F979999D
function detalle_pago_max_valor_BeforeShow(& $sender)
{
    $detalle_pago_max_valor_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_max_valor_BeforeShow

//Custom Code @27-A4C49402
// -------------------------
    global $detalle_pago;
    $peticion_id = $detalle_pago->peticion_id->GetValue();
	$db = new clsDBDatos();
	//Busca el Total de la Petición
	$db->query("SELECT SUM(precio) AS cobrado FROM peticiones_detalle WHERE peticion_id=$peticion_id");

	if($db->next_record())
		$cobrado= $db->f("cobrado");
	
	//Busca el total de Abonos
	$db->query("SELECT SUM(valor) AS pagado FROM detalle_pago WHERE peticion_id=$peticion_id");
	if($db->next_record())
		$pagado= $db->f("pagado");


	unset($db);

	$max_valor = $cobrado-$pagado;
	$detalle_pago->max_valor->SetValue($max_valor);
// -------------------------
//End Custom Code

//Close detalle_pago_max_valor_BeforeShow @26-70608F74
    return $detalle_pago_max_valor_BeforeShow;
}
//End Close detalle_pago_max_valor_BeforeShow

//detalle_pago_fecha_ingreso_BeforeShow @21-88A12EA4
function detalle_pago_fecha_ingreso_BeforeShow(& $sender)
{
    $detalle_pago_fecha_ingreso_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_fecha_ingreso_BeforeShow

//Custom Code @24-A4C49402
// -------------------------
    global $detalle_pago;
	if($detalle_pago->fecha_ingreso->GetValue()=="")
    	$detalle_pago->fecha_ingreso->SetValue(GetFechaServer('server'));
	
// -------------------------
//End Custom Code

//Close detalle_pago_fecha_ingreso_BeforeShow @21-AFBAE0C0
    return $detalle_pago_fecha_ingreso_BeforeShow;
}
//End Close detalle_pago_fecha_ingreso_BeforeShow

//detalle_pago_lb_max_valor_BeforeShow @28-A74D8FC2
function detalle_pago_lb_max_valor_BeforeShow(& $sender)
{
    $detalle_pago_lb_max_valor_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_lb_max_valor_BeforeShow

//Custom Code @29-A4C49402
// -------------------------
    global $detalle_pago;
	$detalle_pago_id = $detalle_pago->detalle_pago_id->GetValue();

	//Si estamos editando una peticion
	//El Valor debiera ser el que esta grabado
	if($detalle_pago_id!=""){
		$db = new clsDBDatos();
		$db->query("SELECT valor FROM detalle_pago WHERE detalle_pago_id=$detalle_pago_id");
	    if($db->next_record())
			$valor = $db->f("valor");
	}
	else{
		$valor = 0;
	}


	$max_valor = $detalle_pago->max_valor->GetValue();
	$total_max = $valor + $max_valor;
	$detalle_pago->max_valor_actual->SetValue($total_max);

	$msg = "Máximo valor a Ingresar: $total_max";
    $detalle_pago->lb_max_valor->SetValue($msg);

	if($total_max==0){
		$detalle_pago->Button_Insert->Visible = false;
	}
// -------------------------
//End Custom Code

//Close detalle_pago_lb_max_valor_BeforeShow @28-FBA71363
    return $detalle_pago_lb_max_valor_BeforeShow;
}
//End Close detalle_pago_lb_max_valor_BeforeShow

//detalle_pago_OnValidate @2-0E356F98
function detalle_pago_OnValidate(& $sender)
{
    $detalle_pago_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_OnValidate

//Custom Code @30-A4C49402
// -------------------------
    global $detalle_pago;
    $valor = $detalle_pago->valor->GetValue();
	$max_valor = $detalle_pago->max_valor_actual->GetValue();
	if($valor > $max_valor){
		$detalle_pago->Errors->addError("El valor ingresado excede el monto máximo");
	}

	$banco=$detalle_pago->nom_banco->GetValue();
	$prevision=$detalle_pago->prevision_id->GetValue();
	$fpago=$detalle_pago->forma_pago_id->GetValue();

	//1=Efectivo
	//2=Cheque
	//3=Bono
	//4=Garantía

	if ($fpago==3 && $prevision==""){
		$detalle_pago->Errors->addError("Debe seleccionar La previsión del Bono");
	} elseif ($fpago==2 && $banco=="") {
		$detalle_pago->Errors->addError("Debe seleccionar El Banco");
	} elseif ($fpago==1 && ($prevision<>"" || $banco<>"")) {
		$detalle_pago->Errors->addError("Para Abonos en efectivo Deje en blanco Banco y Previsión ");
	}

// -------------------------
//End Custom Code

//Close detalle_pago_OnValidate @2-D96BFE41
    return $detalle_pago_OnValidate;
}
//End Close detalle_pago_OnValidate

//detalle_pago_AfterUpdate @2-D4213D47
function detalle_pago_AfterUpdate(& $sender)
{
    $detalle_pago_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_AfterUpdate

//Custom Code @32-A4C49402
// -------------------------
    global $detalle_pago;
	$peticion_id = $detalle_pago->peticion_id->GetValue();
    $estado_pago = estado_pago($peticion_id);
	update_estado_pago($peticion_id, $estado_pago);
// -------------------------
//End Custom Code

//Close detalle_pago_AfterUpdate @2-23DD2158
    return $detalle_pago_AfterUpdate;
}
//End Close detalle_pago_AfterUpdate

//detalle_pago_AfterDelete @2-2B18BCA2
function detalle_pago_AfterDelete(& $sender)
{
    $detalle_pago_AfterDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_AfterDelete

//Custom Code @33-A4C49402
// -------------------------
    global $detalle_pago;
	$peticion_id = $detalle_pago->peticion_id->GetValue();
	update_estado_pago($peticion_id);

// -------------------------
//End Custom Code

//Close detalle_pago_AfterDelete @2-BFF98729
    return $detalle_pago_AfterDelete;
}
//End Close detalle_pago_AfterDelete

//detalle_pago_AfterInsert @2-A5B12DA1
function detalle_pago_AfterInsert(& $sender)
{
    $detalle_pago_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago; //Compatibility
//End detalle_pago_AfterInsert

//Custom Code @34-A4C49402
// -------------------------
    global $detalle_pago;
	$peticion_id = $detalle_pago->peticion_id->GetValue();
    $estado_pago = estado_pago($peticion_id);
	update_estado_pago($peticion_id, $estado_pago);
// -------------------------
//End Custom Code

//Close detalle_pago_AfterInsert @2-ECF4E0D7
    return $detalle_pago_AfterInsert;
}
//End Close detalle_pago_AfterInsert

//Page_BeforeOutput @1-61A4FCBC
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_pago_peticion; //Compatibility
//End Page_BeforeOutput

//Custom Code @125-2A29BDB7
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
