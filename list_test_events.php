<?php
//BindEvents Method @1-17CD350F
function BindEvents()
{
    global $test;
    global $CCSEvents;
    $test->test_TotalRecords->CCSEvents["BeforeShow"] = "test_test_TotalRecords_BeforeShow";
    $test->CCSEvents["BeforeShowRow"] = "test_BeforeShowRow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//test_test_TotalRecords_BeforeShow @13-7B9961A7
function test_test_TotalRecords_BeforeShow(& $sender)
{
    $test_test_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_test_TotalRecords_BeforeShow

//Retrieve number of records @14-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close test_test_TotalRecords_BeforeShow @13-6CBF7389
    return $test_test_TotalRecords_BeforeShow;
}
//End Close test_test_TotalRecords_BeforeShow

//DEL  // -------------------------
//DEL      global $test;
//DEL  	$test_id = $test->test_id->GetValue();
//DEL  	$comp = $test->h_compuesto->GetValue();
//DEL  	$descrip=$test->cod_test->GetValue();
//DEL  	$test->menu->SetValue(generar_menu($test_id, $comp,"Acciones para: $descrip"));
//DEL     
//DEL  // -------------------------

//DEL  // -------------------------
//DEL      global $test;
//DEL      $test_id = $test->alt_test_id->GetValue();
//DEL  	$comp = $test->alt_h_compuesto->GetValue();
//DEL  	$descrip = $test->Alt_cod_test->GetValue();
//DEL  
//DEL  	$test->alt_menu->SetValue(generar_menu($test_id, $comp,"Acciones para: $descrip"));
//DEL  
//DEL  // -------------------------

//test_BeforeShowRow @3-208B5A3F
function test_BeforeShowRow(& $sender)
{
    $test_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_BeforeShowRow

//Custom Code @90-BC68F432
// -------------------------
    global $test;
    // Write your own code here.

	$comp=$test->h_compuesto->GetValue();

/*	if ($comp!='F'){
		$test->hide_comp_en->SetValue('style="DISPLAY:block"');
		$test->hide_comp_dis->SetValue('style="DISPLAY:none"');
		$test->lbl_compuesto->SetValue('<img alt="Test compuesto" src="images/ico_test_compuesto.png" border="0">');

	} else {
		$test->hide_comp_en->SetValue('style="DISPLAY:none"');
		$test->hide_comp_dis->SetValue('style="DISPLAY:block"');
		$test->lbl_compuesto->SetValue('<img src="images/ico_test_vacio.png" border="0">');
	}
*/
	if ($test->formula->GetValue()=='F'){
		$test->lbl_formula->SetValue('<img src="images/ico_test_vacio.png" border="0">');
	} else 
		$test->lbl_formula->SetValue('<img alt="Fórmula" src="images/ico_test_formula.png" border="0">');

	if ($test->imprimible->GetValue()=='F'){
		$test->lbl_imprimible->SetValue('<img src="images/ico_test_vacio.png" border="0">');
	} else 
		$test->lbl_imprimible->SetValue('<img alt="Imprimible" src="images/ico_test_imprimible.png" border="0">');

	if ($test->aislado->GetValue()=='F'){
		$test->lbl_aislado->SetValue('<img src="images/ico_test_vacio.png" border="0">');
	} else 
		$test->lbl_aislado->SetValue('<img alt="Test aislado" src="images/ico_test_aislado.png" border="0">');

// -------------------------
//End Custom Code

//Close test_BeforeShowRow @3-E91530F1
    return $test_BeforeShowRow;
}
//End Close test_BeforeShowRow

//Page_BeforeOutput @1-1495D802
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_test; //Compatibility
//End Page_BeforeOutput

//Custom Code @136-2A29BDB7
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
	function generar_menu($test_id, $comp, $titulo="menu"){

		global $test;
		global $DBDatos;
		
		$icono_id = CCGetDBValue("SELECT icono_id FROM mensajes_ayuda WHERE mensaje_ayuda_id='LISTTEST_MENU'",$DBDatos);
		$path_icono = "images/".CCGetDBValue("SELECT path_icono FROM iconos WHERE icono_id='$icono_id'",$DBDatos);

		$icono_id_menu = CCGetDBValue("SELECT icono_id FROM mensajes_ayuda WHERE mensaje_ayuda_id='LISTTEST_ICONOTITULO'",$DBDatos);
		$path_icono_menu = "images/".CCGetDBValue("SELECT path_icono FROM iconos WHERE icono_id='$icono_id_menu'",$DBDatos);


		if($comp != "F"){
			$link_compuesto = "<a onclick='javascript:toolTip();' href='add_compuesto_detalle.php?comp_test_id=$test_id'><img alt='Crear o editar compuesto' src='images/trabajo.png' border='0'></a>";
		}
		else{
			$link_compuesto = "";
		}

		$link_add_test = "<a onclick='javascript:toolTip();' href='add_test.php?test_id=$test_id'><img alt='Editar este test' src='images/editar.png' border='0'></a>";
		$link_valores_referencia = "<a onclick='javascript:toolTip();' href='add_valores_referencia.php?test_id=$test_id'><img alt='Editar o eliminar Valores de referencia' src='images/addpeticion.png' border='0'></a>";
		$link_asignar_insumos = "<a onclick='javascript:toolTip();' href='asignar_insumos_test.php?test_id=$test_id'><img alt='Editar o eliminar insumos asignados a este test' src='images/kedit.png' border='0'></a>";

		$menu_html = "<table>".
					"<tr>";
		if($link_compuesto!=""){ $menu_html.= "<td>$link_compuesto</td>"; }
								
		$menu_html.="<td>$link_add_test</td>".
					"<td>$link_valores_referencia</td>".
					"<td>$link_asignar_insumos</td>".
					"</tr>".
					"</table>";

		$menu_html = str_replace("'","&quot;",$menu_html);

		$tooltip_html = "toolTip('$menu_html','$path_icono_menu','$titulo &nbsp;<a href=&quot;javascript:toolTip();&quot; >X</a>')";

		//$menu= "<img onclick=\"$tooltip_html\" src=\"$path_icono\">";
		$menu = "<a href=\"javascript:$tooltip_html\" onMouseOver=\"javascript:window.status='Seleccionar opciones para este test'\"><img width=\"20\" border=\"0\" src=\"$path_icono\" alt=\"Hacer click para ver menú de opciones\"></a>";

		return $menu;
	}

?>
