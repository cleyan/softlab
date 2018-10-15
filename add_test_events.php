<?php
//BindEvents Method @1-1C274481
function BindEvents()
{
    global $test;
    global $CCSEvents;
    $test->edit_formula->CCSEvents["BeforeShow"] = "test_edit_formula_BeforeShow";
    $test->lbl_iframe_valores->CCSEvents["BeforeShow"] = "test_lbl_iframe_valores_BeforeShow";
    $test->lbl_iframe_compuesto->CCSEvents["BeforeShow"] = "test_lbl_iframe_compuesto_BeforeShow";
    $test->CCSEvents["OnValidate"] = "test_OnValidate";
    $test->CCSEvents["BeforeDelete"] = "test_BeforeDelete";
    $test->CCSEvents["AfterDelete"] = "test_AfterDelete";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//DEL  // -------------------------
//DEL      global $test;
//DEL      // Write your own code here.
//DEL  
//DEL  	$test->cod_test->SetValue(strtoupper($test->cod_test->GetValue()));
//DEL  
//DEL  // -------------------------

//test_edit_formula_BeforeShow @40-6D953E7F
function test_edit_formula_BeforeShow(& $sender)
{
    $test_edit_formula_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_edit_formula_BeforeShow

//Custom Code @41-BC68F432
// -------------------------
    global $test;
    // Write your own code here.
// -------------------------
	if ($test->formula->GetValue()=='V'){
		$test->edit_formula->SetValue('<img src="images/kcalc.gif" align="middle" border="0">');
	} else {
		$test->edit_formula->SetValue('');
	}
//End Custom Code

//Close test_edit_formula_BeforeShow @40-DF5DD10F
    return $test_edit_formula_BeforeShow;
}
//End Close test_edit_formula_BeforeShow

//test_lbl_iframe_valores_BeforeShow @77-55D225AF
function test_lbl_iframe_valores_BeforeShow(& $sender)
{
    $test_lbl_iframe_valores_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_lbl_iframe_valores_BeforeShow

//Custom Code @78-BC68F432
// -------------------------
    global $test;
    // Write your own code here.


	$test_id=CCGetParam("test_id","0");
	$compuesto=$test->compuesto->GetValue();
	
	if ($compuesto=="F"){
		$iframe='<div class="tab-page" id="valores" style="HEIGHT: 100%">
                  <h2 class="tab">Valores</h2>
                  <script type="text/javascript">
					tabPane1.addTabPage( document.getElementById( "valores" ) );
				</script>
                  <table width="100%" height="100%">
                    <tr>
                      <td width="100%">'.
						 "<iframe name=\"iframevalores\" frameborder=\"no\" src=\"add_list_resultados.php?test_id=$test_id\" style=\"width:100%; height:300px\"></iframe>"
					  .'</td> 
                    </tr> 
                  </table>
                </div>';
	} else {
		$iframe="";
	}

	$test->lbl_iframe_valores->SetValue($iframe);

// -------------------------
//End Custom Code

//Close test_lbl_iframe_valores_BeforeShow @77-1EFC4393
    return $test_lbl_iframe_valores_BeforeShow;
}
//End Close test_lbl_iframe_valores_BeforeShow

//DEL  // -------------------------
//DEL      global $test;
//DEL      // Write your own code here.
//DEL  
//DEL  	$test->lbl_test_id->SetValue(CCGetParam("test_id","0"));
//DEL  
//DEL  // -------------------------

//test_lbl_iframe_compuesto_BeforeShow @75-95669949
function test_lbl_iframe_compuesto_BeforeShow(& $sender)
{
    $test_lbl_iframe_compuesto_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_lbl_iframe_compuesto_BeforeShow

//Custom Code @76-BC68F432
// -------------------------
    global $test;
	
    // Write your own code here.
	$test_id=CCGetParam("test_id","0");
	$compuesto=$test->compuesto->GetValue();

	if ($compuesto=='V') {
		$iframe='<div class="tab-page" id="compuesto"> '.
                '  <h2 class="tab">Compuesto</h2>      '.  
                '  <script type="text/javascript">     '.
				'	   tabPane1.addTabPage( document.getElementById( "compuesto" ) );'.
				'  </script>                           '.
                '  <table width="100%" height="100%">  '.
                '    <tr>                               '.
                '      <td width="100%">'. "<iframe name=\"iframecompuesto\" frameborder=\"no\" src=\"add_compuesto_detalle.php?comp_test_id=$test_id\" style=\"width:100%; height:300px\"></iframe>" .'</td>    '.
                '    </tr>                             '.
                '  </table>                            '. 
                '</div>                                ';
	} else {
		$iframe=""; 
	}

	$test->lbl_iframe_compuesto->SetValue($iframe);

// -------------------------
//End Custom Code

//Close test_lbl_iframe_compuesto_BeforeShow @75-DCC2DBD5
    return $test_lbl_iframe_compuesto_BeforeShow;
}
//End Close test_lbl_iframe_compuesto_BeforeShow

//test_OnValidate @2-F26C5890
function test_OnValidate(& $sender)
{
    $test_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_OnValidate

//Custom Code @60-BC68F432
// -------------------------
    global $test;
    // Write your own code here.

	$accion=GetConfig("cambiar_str_test_auto");

	switch ($accion) {
    case "Mayusculas":
		$test->nom_test->SetValue(strtoupper($test->nom_test->GetValue()));
		$test->cod_test->SetValue(strtoupper($test->cod_test->GetValue()));

        break;

    case "Minusculas":
		$test->nom_test->SetValue(strtolower($test->nom_test->GetValue()));
		$test->cod_test->SetValue(strtolower($test->cod_test->GetValue()));

        break;

	}



// -------------------------
//End Custom Code

//Close test_OnValidate @2-C8002AC0
    return $test_OnValidate;
}
//End Close test_OnValidate

//test_BeforeDelete @2-2B51D1F5
function test_BeforeDelete(& $sender)
{
    $test_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_BeforeDelete

//Custom Code @97-2A29BDB7
// -------------------------
    // recupera el test

	$test_id=CCGetParam("test_id","");

	if ($test_id == ""){
		$test->Errors->addError("Hubo un error al recuperar el código del test para eliminarlo");
	} else {
		//primero vericica si el test es parte de un compuesto
		$db=new clsDBDatos();
		$sql="SELECT COUNT(*) FROM compuesto_detalle WHERE test_id=$test_id";
		$db->query($sql);

		$qty=($db->next_record()) ? $db->f(0) : 0;

		if ($qty > 0) {
			$test->DeleteAllowed=false;
			$test->Errors->addError("El test que quiere eliminar participa en $qty compuestos");
		}

		//primero vericica si el test esta en alguna petición
		$db=new clsDBDatos();
		$sql="SELECT COUNT(*) FROM peticiones_detalle WHERE test_id=$test_id";
		$db->query($sql);

		$qty=($db->next_record()) ? $db->f(0) : 0;

		if ($qty > 0) {
			$test->DeleteAllowed=false;
			$test->Errors->addError("El test que quiere eliminar están en algunas peticiones, no se puede eliminar");
		}

		//primero vericica si el test esta en resultados
		$db=new clsDBDatos();
		$sql="SELECT COUNT(*) FROM resultados WHERE test_id=$test_id";
		$db->query($sql);

		$qty=($db->next_record()) ? $db->f(0) : 0;

		if ($qty > 0) {
			$test->DeleteAllowed=false;
			$test->Errors->addError("El test que quiere eliminar tiene resultados, no se puede eliminar");
		}

		//verifica que le test no es parte de una formula
		$sql="SELECT COUNT(*) FROM formulas WHERE a = $test_id OR
												 b = $test_id OR
												 c = $test_id OR
												 d = $test_id OR
												 e = $test_id OR
												 f = $test_id OR
												 g = $test_id OR
												 h = $test_id OR
												 i = $test_id OR
												 j = $test_id OR
												 k = $test_id OR
												 l = $test_id";
		$db->query($sql);

		$qty=($db->next_record()) ? $db->f(0) : 0;

		if ($qty > 0) {
			$test->DeleteAllowed=false;
			$test->Errors->addError("El test que quiere eliminar es parte de una formula, no se puede eliminar.");
		}

		unset($db);



	}
// -------------------------
//End Custom Code

//Close test_BeforeDelete @2-B95FCA7B
    return $test_BeforeDelete;
}
//End Close test_BeforeDelete

//test_AfterDelete @2-709A8F2B
function test_AfterDelete(& $sender)
{
    $test_AfterDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test; //Compatibility
//End test_AfterDelete

//Custom Code @98-2A29BDB7
// -------------------------
    // Recupera Test

	$test_id=CCGetParam("test_id","");
	
	//Eliminación en cascadas
	if ($test_id != "") {

		//Elimina la asociación de test compuestos
		$db = new clsDBDatos();
		$sql="DELETE FROM compuesto_detalle WHERE comp_test_id=$test_id";
		$db->query($sql);

		//Elimina las fórmulas
		$sql="DELETE FROM formulas WHERE test_id=$test_id";
		$db->query($sql);

		//Elimina los Rangos de referencia
		$sql="DELETE FROM valores_referencia WHERE test_id=$test_id";
		$db->query($sql);

		//Elimina los Valores de resultado
		$sql="DELETE FROM valores_resultado WHERE test_id=$test_id";
		$db->query($sql);

		//Elimina los respaldos de precio
		$sql="DELETE FROM respaldos_precios_test WHERE test_id=$test_id";
		$db->query($sql);

		//elimina los precios del test
		$sql="DELETE FROM precios_test WHERE test_id=$test_id";
		$db->query($sql);

		//elimina del detalle de perfil
		$sql="DELETE FROM perfiles_detalle WHERE test_id=$test_id";
		$db->query($sql);

		//elimina de insumos_x_test
		$sql="DELETE FROM insumos_x_test WHERE test_id=$test_id";
		$db->query($sql);

		//elimina de informes_detalle
		$sql="DELETE FROM informes_detalle WHERE test_id=$test_id";
		$db->query($sql);

		//elimina de grupos_detalle
		$sql="DELETE FROM grupos_detalle WHERE test_id=$test_id";
		$db->query($sql);

		//elimina de las equivalencias
		$sql="DELETE FROM equivalencias WHERE test_id=$test_id";
		$db->query($sql);



		unset($db);


	}


// -------------------------
//End Custom Code

//Close test_AfterDelete @2-25575F4B
    return $test_AfterDelete;
}
//End Close test_AfterDelete

//Page_BeforeOutput @1-9ACD9E2F
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_test; //Compatibility
//End Page_BeforeOutput

//Custom Code @96-2A29BDB7
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
