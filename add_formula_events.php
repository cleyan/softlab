<?php
//BindEvents Method @1-66742845
function BindEvents()
{
    global $formulas;
    global $CCSEvents;
    $formulas->CCSEvents["BeforeShow"] = "formulas_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//formulas_BeforeShow @3-409460AA
function formulas_BeforeShow(& $sender)
{
    $formulas_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $formulas; //Compatibility
//End formulas_BeforeShow

//Custom Code @24-4C2335AE
// -------------------------
    global $formulas;
    global $nom_test;
	 
	$test_id=CCGetParam("test_id","0");


	if ($test_id=="")
		$formulas->Visible=false;
		 

	$db = new clsDBDatos();
	$db->query("select nom_test, formula from test where test_id=$test_id");
	
	if($db->next_record()){
		$nombre_test= $db->f(0);
		$formula=$db->f(1);	
	} else {
		$nombre_test= '<center><img id="Image1" src="images/menu/important.gif" name="Image1"><h1>NO se encuentra el Test</h1></center>';
	}

	unset($db);

	if ($formula!='V') {
		$formulas->Visible=False;
		$nombre_test.='<center><img id="Image1" src="images/menu/important.gif" name="Image1"><h1>Este NO es un Test de <em>Fórmula</em></h1>(Si esta creando el test, primero grabe la característica <em>es una fórmula</em> entes de querer editarla)</center>';
	}			

	$nom_test->SetValue($nombre_test);

	
// -------------------------
//End Custom Code

//Close formulas_BeforeShow @3-51ABAFC2
    return $formulas_BeforeShow;
}
//End Close formulas_BeforeShow

//Page_BeforeOutput @1-0820A49C
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_formula; //Compatibility
//End Page_BeforeOutput

//Custom Code @73-2A29BDB7
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

//DEL  // -------------------------
//DEL      global $formulas;
//DEL      // Write your own code here.
//DEL  	global $alerta_grabado;
//DEL  
//DEL  	$msg= "<script>Alert('Se han grabado los Cambios');</script>";
//DEL  
//DEL  	$alerta_grabado->SetValue($msg);
//DEL  
//DEL  	die($msg);
//DEL  // -------------------------

?>
