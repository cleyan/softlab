<?php
//BindEvents Method @1-6E81000F
function BindEvents()
{
    global $precios_test;
    global $CCSEvents;
    $precios_test->CCSEvents["OnValidate"] = "precios_test_OnValidate";
    $precios_test->CCSEvents["BeforeInsert"] = "precios_test_BeforeInsert";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//precios_test_OnValidate @2-7F9B2A21
function precios_test_OnValidate(& $sender)
{
    $precios_test_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $precios_test; //Compatibility
//End precios_test_OnValidate

//Custom Code @22-36DADE84
// -------------------------
    global $precios_test;
    //global $DBDatos;
	//$test_id = $precios_test->test_id->GetValue();
	//$prevision_id = $precios_test->prevision_id->GetValue();
	//$procedencia_id = $precios_test->procedencia_id->GetValue();

	//$precios_test->Errors->addError("Ya existe un valor para el test, previsión y procedencia seleccionada.");

// -------------------------
//End Custom Code

//Close precios_test_OnValidate @2-6C5A1295
    return $precios_test_OnValidate;
}
//End Close precios_test_OnValidate

//precios_test_BeforeInsert @2-84C84482
function precios_test_BeforeInsert(& $sender)
{
    $precios_test_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $precios_test; //Compatibility
//End precios_test_BeforeInsert

//Custom Code @24-36DADE84
// -------------------------
    global $precios_test;
	insert_precios();
	$precios_test->InsertAllowed = false;

// -------------------------
//End Custom Code

//Close precios_test_BeforeInsert @2-059C1850
    return $precios_test_BeforeInsert;
}
//End Close precios_test_BeforeInsert

//Page_BeforeOutput @1-B57557C2
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_precios_test; //Compatibility
//End Page_BeforeOutput

//Custom Code @30-2A29BDB7
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
function insert_precios(){
    global $precios_test;
    global $DBDatos;

	$test_id = $precios_test->test_id->GetValue();
	$prevision_id = $precios_test->prevision_id->GetValue();
	$procedencia_id = $precios_test->procedencia_id->GetValue();
	//Opción de ingreso de precio para todas las previsiones y procedencias para un test 
	if($prevision_id == "" and $procedencia_id =="" and $test_id!=""){
		$precio = $precios_test->precio->GetValue();
		$previsiones = array();
		$procedencias = array();
		$db = new clsDBDatos();
		$db->query("SELECT prevision_id FROM previsiones");
		while($db->next_record()){
			$previsiones[] = $db->f("prevision_id");
		}
		$db->query("SELECT procedencia_id FROM procedencias");
		while($db->next_record()){
			$procedencias[] = $db->f("procedencia_id");
		}
		for($i=0;$i<sizeof($previsiones);$i++){
			for($j=0;$j<sizeof($procedencias);$j++){
				$prevision_id = $previsiones[$i];
				$procedencia_id = $procedencias[$j];
				$sql_buscar="SELECT count(*) ".
							"FROM precios_test ".
							"WHERE test_id='$test_id' ".
							"AND prevision_id='$prevision_id' ".
							"AND procedencia_id='$procedencia_id'";
				//$db->query($sql_buscar)
				$buscar = intval(CCGetDBValue($sql_buscar,$DBDatos));
				if($buscar == 0){
					$sql_insert="INSERT INTO precios_test (test_id,prevision_id, procedencia_id, precio) ".
								"VALUES('$test_id','$prevision_id','$procedencia_id','$precio');";
					$db->query($sql_insert);
					//echo("$sql_insert<br/>");
				}
				else{
					//Error ya existe
					$prevision = CCGetDBValue("SELECT nom_prevision FROM previsiones WHERE prevision_id='$prevision_id'",$DBDatos);
					$procedencia = CCGetDBValue("SELECT nom_procedencia FROM procedencias WHERE procedencia_id='$procedencia_id'",$DBDatos);
					$precios_test->Errors->addError("Ya existe un precio asignado a este test, que es de procedencia: $procedencia y previsión: $prevision.");
				}
			}
		}
		unset($db);
		//die("Fin 1");
	}
	//opción de ingreso de precio para todas las previsiones para un test
	elseif($prevision_id == "" and $procedencia_id !="" and $test_id!=""){
		$precio = $precios_test->precio->GetValue();
		$previsiones = array();
		$db = new clsDBDatos();
		$db->query("SELECT prevision_id FROM previsiones");
		while($db->next_record()){
			$previsiones[] = $db->f("prevision_id");
		}
		for($i=0;$i<sizeof($previsiones);$i++){
			$prevision_id = $previsiones[$i];
			$sql_buscar="SELECT count(*) ".
						"FROM precios_test ".
						"WHERE test_id='$test_id' ".
						"AND prevision_id='$prevision_id' ".
						"AND procedencia_id='$procedencia_id'";
			$buscar = intval(CCGetDBValue($sql_buscar,$DBDatos));
			if($buscar == 0){
				$sql_insert="INSERT INTO precios_test (test_id,prevision_id, procedencia_id, precio) ".
							"VALUES('$test_id','$prevision_id','$procedencia_id','$precio');";
				$db->query($sql_insert);
				//echo("$sql_insert<br/>");
			}
			else{
				//Error ya existe
					$prevision = CCGetDBValue("SELECT nom_prevision FROM previsiones WHERE prevision_id='$prevision_id'",$DBDatos);
					$procedencia = CCGetDBValue("SELECT nom_procedencia FROM procedencias WHERE procedencia_id='$procedencia_id'",$DBDatos);
					$precios_test->Errors->addError("Ya existe un precio asignado a este test, que es de procedencia: $procedencia y previsión: $prevision.");
			}

		}
		unset($db);
		//die("Fin 2");
	}
	//opción de ingreso de precio para todas las procedencias para un test
	elseif($prevision_id != "" and $procedencia_id =="" and $test_id!=""){
		$precio = $precios_test->precio->GetValue();
		$procedencias = array();
		$db = new clsDBDatos();
		$db->query("SELECT procedencia_id FROM procedencias");
		while($db->next_record()){
			$procedencias[] = $db->f("procedencia_id");
		}
		for($j=0;$j<sizeof($procedencias);$j++){
			$procedencia_id = $procedencias[$j];
			$sql_buscar="SELECT count(*) ".
						"FROM precios_test ".
						"WHERE test_id='$test_id' ".
						"AND prevision_id='$prevision_id' ".
						"AND procedencia_id='$procedencia_id'";
			$buscar = intval(CCGetDBValue($sql_buscar,$DBDatos));
			if($buscar == 0){
				$sql_insert="INSERT INTO precios_test (test_id,prevision_id, procedencia_id, precio) ".
							"VALUES('$test_id','$prevision_id','$procedencia_id','$precio');";
				$db->query($sql_insert);
				//echo("$sql_insert<br/>");
			}
			else{
				//Error ya existe
					$prevision = CCGetDBValue("SELECT nom_prevision FROM previsiones WHERE prevision_id='$prevision_id'",$DBDatos);
					$procedencia = CCGetDBValue("SELECT nom_procedencia FROM procedencias WHERE procedencia_id='$procedencia_id'",$DBDatos);
					$precios_test->Errors->addError("Ya existe un precio asignado a este test, que es de procedencia: $procedencia y previsión: $prevision.");
			}

		}
		unset($db);
		//die("Fin 3");
	}
}
?>
