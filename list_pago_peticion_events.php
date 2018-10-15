<?php
//BindEvents Method @1-743D9143
function BindEvents()
{
    global $detalle_pago_bancos_forma;
    global $CCSEvents;
    $detalle_pago_bancos_forma->subTotal->CCSEvents["BeforeShow"] = "detalle_pago_bancos_forma_subTotal_BeforeShow";
    $detalle_pago_bancos_forma->CCSEvents["BeforeShow"] = "detalle_pago_bancos_forma_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//detalle_pago_bancos_forma_subTotal_BeforeShow @93-FBF64D72
function detalle_pago_bancos_forma_subTotal_BeforeShow(& $sender)
{
    $detalle_pago_bancos_forma_subTotal_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago_bancos_forma; //Compatibility
//End detalle_pago_bancos_forma_subTotal_BeforeShow

//Custom Code @121-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close detalle_pago_bancos_forma_subTotal_BeforeShow @93-7613E214
    return $detalle_pago_bancos_forma_subTotal_BeforeShow;
}
//End Close detalle_pago_bancos_forma_subTotal_BeforeShow

//DEL  // -------------------------
//DEL      global $detalle_pago_bancos_forma;
//DEL  
//DEL  	$peticion_id=CCGetParam("peticion_id","0");
//DEL  
//DEL  	$db = new clsDBDatos();
//DEL  	$sql="SELECT sum(valor) as sum_valor FROM detalle_pago WHERE peticion_id=$peticion_id";
//DEL  	$db->query($sql);
//DEL      
//DEL  	$valor = ($db->next_record()) ? $db->f("sum_valor") : 0;
//DEL  
//DEL  	$sql="SELECT sum(precio) as sum_valor FROM peticiones_detalle WHERE peticion_id=$peticion_id";
//DEL  	$db->query($sql);
//DEL  	
//DEL  	$valpet=($db->next_record()) ? $db->f("sum_valor") : 0;
//DEL  	
//DEL  	unset($db);
//DEL  	
//DEL  	$saldo=$valpet-$valor;
//DEL  
//DEL  	$detalle_pago_bancos_forma->subTotal->SetValue($valor);
//DEL  	$detalle_pago_bancos_forma->Saldo->SetValue($saldo);
//DEL  
//DEL  	if ($saldo==0) { 
//DEL  		$detalle_pago_bancos_forma->lnkAddPago->SetLink("JavaScript:alert('No hay saldo pendiente en esta petición');");
//DEL  	}
//DEL  
//DEL  
//DEL  // -------------------------

//detalle_pago_bancos_forma_BeforeShow @47-A5D90EFE
function detalle_pago_bancos_forma_BeforeShow(& $sender)
{
    $detalle_pago_bancos_forma_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_pago_bancos_forma; //Compatibility
//End detalle_pago_bancos_forma_BeforeShow

//Custom Code @122-88C0E2C9
// -------------------------
    global $detalle_pago_bancos_forma;
    // Write your own code here.

		$peticion_id=CCGetParam("peticion_id","0");

	$db = new clsDBDatos();
	$sql="SELECT sum(valor) as sum_valor FROM detalle_pago WHERE peticion_id=$peticion_id";
	$db->query($sql);
    
	$valor = ($db->next_record()) ? $db->f("sum_valor") : 0;

	$sql="SELECT sum(precio) as sum_valor FROM peticiones_detalle WHERE peticion_id=$peticion_id";
	$db->query($sql);
	
	$valpet=($db->next_record()) ? $db->f("sum_valor") : 0;
	
	unset($db);
	
	$saldo=$valpet-$valor;

	$detalle_pago_bancos_forma->subTotal->SetValue($valor);
	$detalle_pago_bancos_forma->Saldo->SetValue($saldo);

	if ($saldo==0) { 
		$detalle_pago_bancos_forma->lnkAddPago->SetLink("JavaScript:alert('No hay saldo pendiente en esta petición');");
	}

// -------------------------
//End Custom Code

//Close detalle_pago_bancos_forma_BeforeShow @47-4DF50A8F
    return $detalle_pago_bancos_forma_BeforeShow;
}
//End Close detalle_pago_bancos_forma_BeforeShow

//Page_BeforeOutput @1-C968805A
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_pago_peticion; //Compatibility
//End Page_BeforeOutput

//Custom Code @140-2A29BDB7
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
