<?php
//BindEvents Method @1-DC752B32
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_BeforeShow @1-8C95ACEE
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_test_peticion; //Compatibility
//End Page_BeforeShow

//Custom Code @3-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

// Custom Code @3-4FC7032E
// -------------------------
    global $add_test_peticion;
	global $lista_de_test;

	$cols=3;

	///Esta seleccion es solo de los que van en el menu principal
	$sSQL= "SELECT test_id, ".
					"secciones_id, ".
					"test.equipo_id AS test_equipo_id, ".
					"cod_test, ".
					"nom_test, ".
					"acceso_rapido, ".
					"orden_peticion, ".
					"aislado, ".
					"seccion_id, ".
					" nom_seccion, ".
					"equipos.equipo_id AS equipos_equipo_id, ".
					"nom_equipo ".
		   " FROM (test LEFT JOIN secciones ON test.secciones_id = secciones.seccion_id) LEFT JOIN equipos ON".
		   " test.equipo_id = equipos.equipo_id WHERE test.aislado = 'V' AND test.acceso_rapido = 'V'".
		   " ORDER BY orden_peticion";

	$db = new clsDBDatos();
	$db->query($sSQL);
	$peticiones = array();

	while ($db->next_record())
	{
		$p = array();
		$p["test_id"] = $db->f("test_id");
		$p["secciones_id"] = $db->f("secciones_id");
		$p["test_equipo_id"] = $db->f("test_equipo_id");
		$p["cod_test"] = $db->f("cod_test");
		$p["nom_test"] = $db->f("nom_test");
		$p["acceso_rapido"] = $db->f("acceso_rapido");
		$p["orden_peticion"] = $db->f("orden_peticion");
		$p["aislado"] = $db->f("aislado");
		$p["seccion_id"] = $db->f("seccion_id");
		$p["nom_seccion"] = $db->f("nom_seccion");
		$p["equipos_equipo_id"] = $db->f("equipos_equipo_id");
		$p["nom_equipo"] = $db->f("nom_equipo");

		$peticiones[] = $p;
	}
	unset($db);

	$clase="InLineDataTD";
	while (list ($clave, $val) = each ($peticiones)) {
	    //echo "$clave => $val<br/>";
		$col++;
		if ($col>$cols) $col=1;

		if ($clase=="InLineAltDataTD") {
			$clase="InLineDataTD";
		} else {
			$clase="InLineAltDataTD";
		}

		if ($col==1) {
			$contenidoHTML.='<tr class="'.$clase.'">                                          
		      				<td nowrap><input name="test_peticion['.$val["test_id"].']" id="test_peticion['.$val["test_id"].']" value="'.$val["cod_test"].'" type="checkbox">'.$val["cod_test"].'</td>';
		   
		} else if ($col==$cols) {
			$contenidoHTML.='<td nowrap><input name="test_peticion['.$val["test_id"].']" id="test_peticion['.$val["test_id"].']" value="'.$val["cod_test"].'" type="checkbox">'.$val["cod_test"].'</td>
							</tr>';
		} else
			$contenidoHTML.='<td nowrap><input name="test_peticion['.$val["test_id"].']" id="test_peticion['.$val["test_id"].']" value="'.$val["cod_test"].'" type="checkbox">'.$val["cod_test"].'</td>';

	}


	$lista_de_test->SetValue("<table><TR><TD colspan=\"$cols\" class=\"InLineFormHeaderFont\">Seleccione el/los Tests a realizar</td></tr>".
							"<tr><td>$contenidoHTML</td></tr></table>");


//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-02043135
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_test_peticion; //Compatibility
//End Page_BeforeOutput

//Custom Code @4-2A29BDB7
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
