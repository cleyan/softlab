<?php
//BindEvents Method @1-8DDDA944
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_AfterInitialize @1-6B6DBF31
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ver_grafico; //Compatibility
//End Page_AfterInitialize

//Custom Code @2-37293EEF
// -------------------------
    global $ver_grafico;
	global $lbl_grafico;
	global $lbl_tabla;
    // Write your own code here.

	$tipo=CCGetParam("tipo","");

	$paciente_id=CCGetParam("paciente_id","");
	$test_id=CCGetParam("test_id","");
	
	if ($tipo=="historia_paciente"){
		$lbl_grafico->SetValue("<img src=\"stat_historiapacientes_graph.php?paciente_id=$paciente_id&test_id=$test_id\">");

		$db = new clsDBDatos();

		$sql="SELECT paciente_id, resultados.valor, resultados.muestra_id, DATE_FORMAT(coalesce(resultados.fecha_modificacion, resultados.fecha_creacion),'%d/%m/Y') as fecha, cod_test, nom_test, test.unidad_medida 
				FROM (resultados LEFT JOIN peticiones ON
				resultados.peticion_id = peticiones.peticion_id) LEFT JOIN test ON
				resultados.test_id = test.test_id
				WHERE ( test.test_id = $test_id AND peticiones.paciente_id = $paciente_id)";

		$db->query($sql);

		$tabla= "<table class=\"InLineFormTABLE\"><tr class=\"InLineColumnTD\"><td>MuestraID</td><td>Fecha</td><td colspan=\"2\">Valor</td></tr>";

		while ($db->next_record()){
			$tabla.="<tr class=\"InLineDataTD\">";
			$tabla.="<td>" . $db->f("muestra_id"). "</td>\n";
			$tabla.="<td>" . $db->f("fecha"). "</td>\n";
			$tabla.="<td align=\"right\">" . $db->f("valor"). "</td>\n";
			$tabla.="<td>" . $db->f("unidad_medida"). "</td>\n";
			$tabla.="</tr>";
		}
		$tabla.="</table>";

		$lbl_tabla->SetValue($tabla);
			
	}		


// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-D646A9A1
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ver_grafico; //Compatibility
//End Page_BeforeOutput

//Custom Code @9-2A29BDB7
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
