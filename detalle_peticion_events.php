<?php
// //Events @1-F81417CB

//DEL  // -------------------------
//DEL      global $detalle_peticion;
//DEL  	global $peticiones_estados_estado;
//DEL  
//DEL  	$peticion_id=CCGetParam("peticion_id","0");
//DEL  	if ($peticion_id=="0") $peticion_id=CCGetParam("s_peticion_id","0");
//DEL  	
//DEL  	$db= new clsDBDatos();
//DEL  	$sql="SELECT paciente_id FROM peticiones WHERE peticion_id=$peticion_id LIMIT 1"; 
//DEL  	$db->query($sql);
//DEL  	$paciente_id=($db->next_record()) ? $db->f(0) : 0;
//DEL  	
//DEL  	unset($db);
//DEL  
//DEL  	$Edad=GetEdadEx($paciente_id);
//DEL  
//DEL  	$detalle_peticion->peticiones_estados_estado->edad->SetValue($Edad);
//DEL  
//DEL  // -------------------------

//detalle_peticion_peticiones_estados_estado_BeforeShow @5-95A448BE
function detalle_peticion_peticiones_estados_estado_BeforeShow(& $sender)
{
    $detalle_peticion_peticiones_estados_estado_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $detalle_peticion; //Compatibility
//End detalle_peticion_peticiones_estados_estado_BeforeShow

//Custom Code @62-4928A3B9
// -------------------------
    global $detalle_peticion;
	global $peticiones_estados_estado;

	$peticion_id=CCGetParam("peticion_id","0");
	if ($peticion_id=="0") $peticion_id=CCGetParam("s_peticion_id","0");
	
	$db= new clsDBDatos();
	$sql="SELECT paciente_id FROM peticiones WHERE peticion_id=$peticion_id LIMIT 1"; 
	$db->query($sql);
	$paciente_id=($db->next_record()) ? $db->f(0) : 0;
	
//Anotar la Edad
	$Edad=GetEdadEx($paciente_id);
	$detalle_peticion->peticiones_estados_estado->edad->SetValue($Edad);

//Calcular Abonos, Valor de Petición y Saldo Pendiente
	$sql="SELECT sum(valor) as sum_valor FROM detalle_pago WHERE peticion_id=$peticion_id";
	$db->query($sql);
    
	$valor = ($db->next_record()) ? $db->f("sum_valor") : 0;

	$sql="SELECT sum(precio) as sum_valor FROM peticiones_detalle WHERE peticion_id=$peticion_id";
	$db->query($sql);
	
	$valpet=($db->next_record()) ? $db->f("sum_valor") : 0;

	$sql="SELECT estado_pago_id FROM peticiones WHERE peticion_id=$peticion_id";
	$db->query($sql);
	
	$estado_pago_id=($db->next_record()) ? $db->f(0) : 0;

	
	unset($db);
	
	$saldo=$valpet-$valor;

	unset($db);

//Anotar Valor y Saldo
	$detalle_peticion->peticiones_estados_estado->valor->SetValue($valpet);
	$detalle_peticion->peticiones_estados_estado->saldo->SetValue($saldo);

//Alarma de no pagado	
	if ($estado_pago_id==1) { //Pagado
		$detalle_peticion->peticiones_estados_estado->img_aviso->SetValue('<img src="images/greenball.gif" border="0">');
	} elseif ($estado_pago_id==2) {//Abonado
		$detalle_peticion->peticiones_estados_estado->img_aviso->SetValue('<img src="images/yellowball.gif" border="0">');
	} else { // No pagado
		$detalle_peticion->peticiones_estados_estado->img_aviso->SetValue('<img src="images/redball.gif" border="0">');
	}

// -------------------------
//End Custom Code

//Close detalle_peticion_peticiones_estados_estado_BeforeShow @5-5DF79331
    return $detalle_peticion_peticiones_estados_estado_BeforeShow;
}
//End Close detalle_peticion_peticiones_estados_estado_BeforeShow


?>
