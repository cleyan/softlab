<?php
//BindEvents Method @1-256EDB59
function BindEvents()
{
    global $peticiones_pacientes;
    global $test_resultados_estadosSearch;
    global $test_resultados_estados;
    global $CCSEvents;
    $peticiones_pacientes->Edad->CCSEvents["BeforeShow"] = "peticiones_pacientes_Edad_BeforeShow";
    $test_resultados_estadosSearch->CCSEvents["BeforeShow"] = "test_resultados_estadosSearch_BeforeShow";
    $test_resultados_estados->CCSEvents["BeforeShowRow"] = "test_resultados_estados_BeforeShowRow";
    $test_resultados_estados->CCSEvents["BeforeShow"] = "test_resultados_estados_BeforeShow";
    $test_resultados_estados->ds->CCSEvents["BeforeBuildSelect"] = "test_resultados_estados_ds_BeforeBuildSelect";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//peticiones_pacientes_Edad_BeforeShow @155-5CCFC2F0
function peticiones_pacientes_Edad_BeforeShow(& $sender)
{
    $peticiones_pacientes_Edad_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $peticiones_pacientes; //Compatibility
//End peticiones_pacientes_Edad_BeforeShow

//Custom Code @371-E6A394E6
// -------------------------
    global $peticiones_pacientes;
    // Write your own code here.

  	$paciente_id=$peticiones_pacientes->paciente_id->GetValue();  
  	$peticiones_pacientes->Edad->SetValue(GetEdadEx($paciente_id));



// -------------------------
//End Custom Code

//Close peticiones_pacientes_Edad_BeforeShow @155-C34F9767
    return $peticiones_pacientes_Edad_BeforeShow;
}
//End Close peticiones_pacientes_Edad_BeforeShow

//test_resultados_estadosSearch_BeforeShow @71-3D0A4B7D
function test_resultados_estadosSearch_BeforeShow(& $sender)
{
    $test_resultados_estadosSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test_resultados_estadosSearch; //Compatibility
//End test_resultados_estadosSearch_BeforeShow

//Custom Code @370-FD569926
// -------------------------
    global $test_resultados_estadosSearch;
    // Write your own code here.

	$peticion_id=CCGetParam("s_peticion_id","");

	if ($peticion_id=="") {
		$test_resultados_estadosSearch->Visible=False;
	} else {
		$db= new clsDBDatos();
		$sql="select count(*) as qty from resultados where peticion_id=".intval($peticion_id);
		$db->query($sql);

		if ($db->next_record()) $qty=$db->f(0);
		if ($qty<1) $test_resultados_estadosSearch->Visible=False;

		unset($db);
	}


// -------------------------
//End Custom Code

//Close test_resultados_estadosSearch_BeforeShow @71-2F590345
    return $test_resultados_estadosSearch_BeforeShow;
}
//End Close test_resultados_estadosSearch_BeforeShow

//test_resultados_estados_BeforeShowRow @22-7E472BD5
function test_resultados_estados_BeforeShowRow(& $sender)
{
    $test_resultados_estados_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test_resultados_estados; //Compatibility
//End test_resultados_estados_BeforeShowRow

//Custom Code @366-1D6724E5
// -------------------------
    global $test_resultados_estados;
    // Write your own code here.

	$resultado_id=$test_resultados_estados->marcador->GetValue();

	$sql="SELECT secciones_id, equipo_id, cod_test, nom_test, unidad_medida, aislado, 
	        compuesto, formula, resultado_id, resultados.peticion_id AS resultados_peticion_id,
		    resultados.test_id AS resultados_test_id, resultados.estado_id AS resultados_estado_id, 
			valor, nom_estado, decompuesto, test_main_id 
		  FROM ((resultados LEFT JOIN test ON
			resultados.test_id = test.test_id) LEFT JOIN estados ON
			resultados.estado_id = estados.estado_id) LEFT JOIN peticiones_detalle ON
			peticiones_detalle.peticion_id = resultados.peticion_id 
		  AND peticiones_detalle.test_id = resultados.test_id
		  WHERE resultados.resultado_id = $resultado_id";

	$db = new clsDBDatos();
	$db->query($sql);
	
	if ($db->next_record()) {
		$escompuesto=$db->f("compuesto");
		$decompuesto=$db->f("decompuesto");
		$test_id=$db->f("resultados_test_id");
		$peticion_id=$db->f("resultados_peticion_id");
	}

	unset($db);

	if ($escompuesto=='V') {
		$test_resultados_estados->marcador->SetValue("");
		$test_resultados_estados->nom_estado->SetValue("");

	} else {
		$test_resultados_estados->marcador->SetValue("<input id=\"marca\" type=\"checkbox\" name=\"marca[]\" value=\"$resultado_id\">");
	}

	if ($decompuesto=='V') {
		$test_resultados_estados->lblDeCompuesto->SetValue("··>");
	} else {
		$test_resultados_estados->lblDeCompuesto->SetValue("");
	}

	//Busca primero de quien es la peticion
	$db=new clsDBDatos();
	$sql="SELECT paciente_id FROM peticiones WHERE peticion_id=$peticion_id";
	$db->query($sql);

	$paciente_id=($db->next_record()) ? $db->f(0) : 0;

	//Busca si hay resultados anteriores para este Test
	$sql="SELECT count(*) AS qty FROM resultados " .
		 " INNER JOIN peticiones ON (resultados.peticion_id = peticiones.peticion_id)" .
		 " WHERE " .
  		 "    peticiones.paciente_id = $paciente_id AND ".
  		 "    resultados.test_id = $test_id AND ".
  		 "    resultados.estado_id = 20";
		
	$db->query($sql);

	$qty=($db->next_record()) ? $db->f(0) : 0;

	unset($db);

	if ($qty>1){
		$test_resultados_estados->lnkHistoria->SetValue("[H]");
		$test_resultados_estados->lnkHistoria->SetLink("JavaScript:openWindow('ver_grafico.php?test_id=$test_id&paciente_id=$paciente_id&tipo=historia_paciente','verHistoria',720,500);");
	} else {
		$test_resultados_estados->lnkHistoria->SetValue("");
	}



// -------------------------
//End Custom Code

//Close test_resultados_estados_BeforeShowRow @22-4E4B45A6
    return $test_resultados_estados_BeforeShowRow;
}
//End Close test_resultados_estados_BeforeShowRow

//test_resultados_estados_BeforeShow @22-61F78A44
function test_resultados_estados_BeforeShow(& $sender)
{
    $test_resultados_estados_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test_resultados_estados; //Compatibility
//End test_resultados_estados_BeforeShow

//Custom Code @368-1D6724E5
// -------------------------
    global $test_resultados_estados;
    // Write your own code here.

	$peticion_id=CCGetParam("s_peticion_id","0");
	if ($peticion_id=="0") {
		$test_resultados_estados->Visible=False;
	} elseif ($test_resultados_estados->ds->RecordsCount == 0) {
		$test_resultados_estados->Visible=False;
	} else {
		$test_resultados_estados->Visible=True;
	}



// -------------------------
//End Custom Code

//Close test_resultados_estados_BeforeShow @22-77AC9139
    return $test_resultados_estados_BeforeShow;
}
//End Close test_resultados_estados_BeforeShow

//test_resultados_estados_ds_BeforeBuildSelect @22-CE832D7C
function test_resultados_estados_ds_BeforeBuildSelect(& $sender)
{
    $test_resultados_estados_ds_BeforeBuildSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test_resultados_estados; //Compatibility
//End test_resultados_estados_ds_BeforeBuildSelect

//Custom Code @369-1D6724E5
// -------------------------
    global $test_resultados_estados;
    // Write your own code here.

	$peticion_id=CCGetParam("s_peticion_id","0");
		$msg=ActualizaPeticion($peticion_id);

		if ($msg != "") echo $msg;

// -------------------------
//End Custom Code

//Close test_resultados_estados_ds_BeforeBuildSelect @22-42976478
    return $test_resultados_estados_ds_BeforeBuildSelect;
}
//End Close test_resultados_estados_ds_BeforeBuildSelect

//Page_AfterInitialize @1-53835D03
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $validar_resultados_peticion; //Compatibility
//End Page_AfterInitialize

//Custom Code @367-806E4AEE
// -------------------------
    global $validar_resultados_peticion;
    // Write your own code here.

	$accion=CCGetParam("Accion","");
	
	if ($accion=="Aceptar"){
		$ejec= " estado_id=20 ";
	} else if ($accion=="Rechazar") {
		$ejec= " estado_id=30 ";
	} else if ($accion=="Borrar") {
		$ejec= " estado_id=10 ";
	} 

	if ($accion != "") {

		$items="";

		$marca=CCGetParam("marca","");

		if (is_array($marca)) {

			reset ($marca);
			while (list ($clave, $val) = each ($marca)) {
				if ($items=="") {
					$items=$val;
				} else {
					$items.=", $val";
				}
			}	
			$sql="UPDATE resultados SET $ejec WHERE resultado_id IN ($items)";
		}
	
	}

	if ($items != "") {
		$db= new clsDBDatos();
		$db->query($sql);
		unset($db);
	}


// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-EDA22EA7
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $validar_resultados_peticion; //Compatibility
//End Page_BeforeOutput

//Custom Code @372-2A29BDB7
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
