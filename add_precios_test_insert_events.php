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

//Custom Code @15-36DADE84
// -------------------------
    global $precios_test;
    global $DBDatos;

	$prevision_aplicar= $precios_test->prevision_aplicar_id->GetValue();
	$prevision_base_id=$precios_test->prevision_base_id->GetValue();
	$procedencia_base_id=intval($precios_test->procedencia_base_id->GetValue());
	$procedencia_id=intval($precios_test->procedencia_id->GetValue());

	if ($procedencia_base_id=="") {
		$precios_test->Errors->addError("Debe seleccionar Una procedencia Base");
	}

	$existen_datos = intval(CCGetDBValue("SELECT count(*) FROM precios_test WHERE prevision_id='$prevision_aplicar' and procedencia_id=$procedencia_id",$DBDatos));
	if($existen_datos > 0){
		$precios_test->Errors->addError("Ya existen precios para la previsión seleccionada");
	}
		
	if ($procedencia_id==0) {//todos las procedencia
		$existen_prevision_base = intval(CCGetDBValue("SELECT count(*) FROM precios_test WHERE prevision_id='$prevision_base_id'",$DBDatos));
		if($existen_prevision_base == 0){
			$precios_test->Errors->addError("No hay precios definidos para la previsión seleccionada como parametro base.");
		}
	} else {
		$existen_prevision_base = intval(CCGetDBValue("SELECT count(*) FROM precios_test WHERE prevision_id='$prevision_base_id' and procedencia_id=$procedencia_base_id",$DBDatos));
		if($existen_prevision_base == 0){
			$precios_test->Errors->addError("No hay precios definidos para la previsión o procdencia seleccionados como parametros base.");
		}
		
	}
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

//Custom Code @16-36DADE84
// -------------------------
    global $precios_test;
    ingresar_precios();
	$precios_test->InsertAllowed = false;
	die(header("Location: add_precios_test_insert.php"));
// -------------------------
//End Custom Code

//Close precios_test_BeforeInsert @2-059C1850
    return $precios_test_BeforeInsert;
}
//End Close precios_test_BeforeInsert

//Page_BeforeOutput @1-9CF52709
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_precios_test_insert; //Compatibility
//End Page_BeforeOutput

//Custom Code @23-2A29BDB7
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

function ingresar_precios(){
	global $precios_test;
	global $DBDatos;

	$prevision_base_id = $precios_test->prevision_base_id->GetValue();
	$procedencia_id = $precios_test->procedencia_id->GetValue();
	$prevision_aplicar_id = $precios_test->prevision_aplicar_id->GetValue();
	$factor = doubleval($precios_test->factor->GetValue());
	$procedencia_base_id=intval($precios_test->procedencia_base_id->GetValue());

	if($procedencia_id != "0") {
		$sql_busca_test="SELECT test_id, precio ".
						"FROM precios_test ".
						"WHERE prevision_id='$prevision_base_id' ".
						"AND procedencia_id='$procedencia_base_id'";
		$db = new clsDBDatos();
		$db->query($sql_busca_test);
		if($db->next_record()){
			do{
				$test_id = $db->f("test_id");
				$precio = $db->f("precio");
				$precio_nuevo = intval($precio * $factor);
				$sql_insert="INSERT INTO precios_test (test_id, prevision_id, procedencia_id, precio) ".
							"VALUES('$test_id', '$prevision_aplicar_id', '$procedencia_id', '$precio_nuevo')";
				//ejecutar insert
	
					//primero busca si ya esta
					$dbF=new clsDBDatos();
					$dbF->query("select count(*) from precios_test where test_id=$test_id and prevision_id='$prevision_aplicar_id' and procedencia_id='$procedencia_id'");
					$qty=($dbF->next_record()) ? $dbF->f(0) : 0;
					unset($dbF);
					//inserta solo si no existia	
					if ($qty==0) CCGetDBValue($sql_insert,$DBDatos);
	
			}
			while($db->next_record());
		}
		unset($db);
	}
	else{
		//primero se obtienen todas las procedencias existentes
		$sql_procedencias = "SELECT procedencia_id FROM procedencias";
		$db = new clsDBDatos();
		$db->query($sql_procedencias);	
		$procedencias = array();
		while($db->next_record()){ 
			$procedencias[] = $db->f("procedencia_id");
		}
		unset($db);
	
		//luego se buscar todos los test a guardar
		$sql_busca_test = "SELECT test_id, precio FROM precios_test WHERE prevision_id='$prevision_base_id' AND procedencia_id='$procedencia_base_id'";
		$db = new clsDBDatos();
		$db->query($sql_busca_test);
		if($db->next_record()){
			do{
				$test_id = $db->f("test_id");
				$precio = $db->f("precio");
				$precio_nuevo = intval($precio * $factor);
				reset($procedencias);
				while (list ($clave, $new_procedencia_id) = each ($procedencias)) {
						$sql_insert="INSERT INTO precios_test (test_id, prevision_id, procedencia_id, precio) ".
									"VALUES('$test_id', '$prevision_aplicar_id', '$new_procedencia_id', '$precio_nuevo')";
					//ejecutar insert
					
					//primero busca si ya esta
					$dbF=new clsDBDatos();
					$dbF->query("select count(*) from precios_test where test_id=$test_id and prevision_id='$prevision_aplicar_id' and procedencia_id='$new_procedencia_id'");
					$qty=($dbF->next_record()) ? $dbF->f(0) : 0;
					unset($dbF);
					//inserta solo si no existia	
					if ($qty==0) CCGetDBValue($sql_insert,$DBDatos);
				}
			}
			while($db->next_record());
		}
		unset($db);
	}
}
?>
