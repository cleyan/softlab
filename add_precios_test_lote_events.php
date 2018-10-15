<?php
//BindEvents Method @1-0A73AB74
function BindEvents()
{
    global $precios_test;
    global $CCSEvents;
    $precios_test->ayuda_1->CCSEvents["BeforeShow"] = "precios_test_ayuda_1_BeforeShow";
    $precios_test->CCSEvents["BeforeInsert"] = "precios_test_BeforeInsert";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//precios_test_ayuda_1_BeforeShow @30-D59B7B04
function precios_test_ayuda_1_BeforeShow(& $sender)
{
    $precios_test_ayuda_1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $precios_test; //Compatibility
//End precios_test_ayuda_1_BeforeShow

//Custom Code @33-36DADE84
// -------------------------
    global $precios_test;
    global $DBDatos;

	$icono_id = CCGetDBValue("SELECT icono_id FROM mensajes_ayuda WHERE mensaje_ayuda_id='PRECIOSLOTE_FACTOR'",$DBDatos);
	$icono = "images/".CCGetDBValue("SELECT path_icono FROM iconos WHERE icono_id='$icono_id'",$DBDatos);
	$ayuda = CCGetDBValue("SELECT mensaje FROM mensajes_ayuda WHERE mensaje_ayuda_id='PRECIOSLOTE_FACTOR'",$DBDatos);
	$titulo = CCGetDBValue("SELECT nom_mensaje FROM mensajes_ayuda WHERE mensaje_ayuda_id='PRECIOSLOTE_FACTOR'",$DBDatos);
	$precios_test->ayuda_1->SetValue($ayuda);
	$precios_test->titulo_ayuda_1->SetValue($titulo);
	$precios_test->icono_ayuda_1->SetValue($icono);
// -------------------------
//End Custom Code

//Close precios_test_ayuda_1_BeforeShow @30-A2743488
    return $precios_test_ayuda_1_BeforeShow;
}
//End Close precios_test_ayuda_1_BeforeShow

//precios_test_BeforeInsert @2-84C84482
function precios_test_BeforeInsert(& $sender)
{
    $precios_test_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $precios_test; //Compatibility
//End precios_test_BeforeInsert

//Custom Code @23-36DADE84
// -------------------------
    global $precios_test;
	global $Redirect;
	//RespaldarPrecios();
    actualizar_precios();
	$precios_test->InsertAllowed = false;
	die(header("Location: add_precios_test_lote.php"));
// -------------------------
//End Custom Code

//Close precios_test_BeforeInsert @2-059C1850
    return $precios_test_BeforeInsert;
}
//End Close precios_test_BeforeInsert

//Page_BeforeOutput @1-61F3F71C
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_precios_test_lote; //Compatibility
//End Page_BeforeOutput

//Custom Code @39-2A29BDB7
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

function actualizar_precios(){ 

	global $DBDatos;
	global $precios_test;
  
	//Previsión base para la actualización de precios
	$prevision_base_id = $precios_test->prevision_base_id->GetValue();

	//parametros condicionanates para la actualización
	$procedencia_id = $precios_test->procedencia_id->GetValue();
	$factor = $precios_test->factor->GetValue();
	$factor = doubleval($factor);
	$prevision_id = $precios_test->prevision_id->GetValue();
	
	//parametros condicionantes de busqueda
	$test_id = $precios_test->test_id->GetValue();
	$seccion_id = $precios_test->seccion_id->GetValue();
	$equipo_id = $precios_test->equipo_id->GetValue();

	//generación de la sentencia sql para buscar todos los test bajo las condiciones anteriores.
	
	$sql_buscar_tests = "SELECT test_id FROM test ";
	
	if($test_id != "0" or $seccion_id != "0" or $equipo_id != "0"){
		$sql_buscar_tests .= "WHERE ";
	}
	//-----------------------------------------------------------------------------------------
	if($test_id != "0"){
		$sql_buscar_tests .= "test_id='$test_id' ";
	}
	//-----------------------------------------------------------------------------------------
	if($seccion_id != "0" and $test_id == "0"){
		$sql_buscar_tests .= "seccion_id='$seccion_id' ";
	}
	elseif($seccion_id != "0" and $test_id != "0"){
		$sql_buscar_tests .= "AND seccion_id='$seccion_id' ";
	}
	//-----------------------------------------------------------------------------------------
	if($equipo_id != "0" and $seccion_id == "0" and $test_id=="0"){
		$sql_buscar_tests .= "equipo_id='$equipo_id' ";
	}
	elseif($equipo_id != "0" and $seccion_id != "0" and $test_id=="0"){
		$sql_buscar_tests .= "AND equipo_id='$equipo_id' ";
	}
	elseif($equipo_id != "0" and $test_id != "0" and $test_id != "0"){
		$sql_buscar_tests .= "AND equipo_id='$equipo_id' ";
	}							
	//-----------------------------------------------------------------------------------------
	//echo("sql: $sql_buscar_tests<br/>");
	//echo("test: $test_id <br/>seccion: $seccion_id<br/>equipo: $equipo_id<br/>factor: $factor<br/>");
	//se crea conección a la base de datos para realizar consulta creada anteriormente
	$bd = new clsDBDatos();
	$test_a_cambiar_valor = new clsDBDatos(); 
	//echo("test seleccionados: $sql_buscar_tests<br/><br/>");
	$bd->query($sql_buscar_tests);
	if($bd->next_record()){
		do{
			$test = $bd->f("test_id");
			//echo("Test_ID: $test<br/>");
			if($prevision_base_id != "0"){
				$test_a_cambiar_valor->query("SELECT precio_test_id FROM precios_test WHERE test_id='$test' AND prevision_id='$prevision_base_id'");
			}
			else{
				$test_a_cambiar_valor->query("SELECT precio_test_id FROM precios_test WHERE test_id='$test'");
			}
			if($test_a_cambiar_valor->next_record()){
				do{
					$precio_id = $test_a_cambiar_valor->f("precio_test_id");
					//echo("precioID: $precio_id<br/>");
					$precio_base = CCGetDBValue("SELECT precio FROM precios_test WHERE precio_test_id='$precio_id'",$DBDatos);
					$precio_nuevo = intval($precio_base * doubleval($factor));

					//echo("precio base: $precio_base -- precio nuevo: $precio_nuevo ===>> factor aplicado: $factor ");

					if($precio_nuevo != "0"){
						if($procedencia_id!="0" and $prevision_id!="0"){
							$sql_update = "UPDATE precios_test SET precio='$precio_nuevo' WHERE precio_test_id='$precio_id' AND test_id='$test' AND procedencia_id='$procedencia_id' AND prevision_id='$prevision_id'";
						}
						elseif($procedencia_id!="0" and $prevision_id=="0"){
							$sql_update = "UPDATE precios_test SET precio='$precio_nuevo' WHERE precio_test_id='$precio_id' AND test_id='$test' AND procedencia_id='$procedencia_id'";
						}
						elseif($procedencia_id=="0" and $prevision_id!="0"){
							$sql_update = "UPDATE precios_test SET precio='$precio_nuevo' WHERE precio_test_id='$precio_id' AND test_id='$test' AND prevision_id='$prevision_id'";
						}
						elseif($procedencia_id=="0" and $prevision_id=="0"){
							$sql_update = "UPDATE precios_test SET precio='$precio_nuevo' WHERE precio_test_id='$precio_id' AND test_id='$test'";
						}
						//echo("UPDATE: $sql_update<br/>");
						//aqui se ejecuta el update segun las condiciones dadas.
						$update = new clsDBDatos();
						$update->query($sql_update);
						unset($update);
					}
				}
				while($test_a_cambiar_valor->next_record());
			}
			
		}			
		while($bd->next_record());
	}
	unset($test_a_cambiar_valor);
	unset($bd);  
}
		
?>
