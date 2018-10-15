<?php
//BindEvents Method @1-0D26E892
function BindEvents()
{
    global $valores_resultado;
    global $CCSEvents;
    $valores_resultado->nom_test->CCSEvents["BeforeShow"] = "valores_resultado_nom_test_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//valores_resultado_nom_test_BeforeShow @20-87C101A8
function valores_resultado_nom_test_BeforeShow(& $sender)
{
    $valores_resultado_nom_test_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $valores_resultado; //Compatibility
//End valores_resultado_nom_test_BeforeShow

//DLookup @21-9E662C6F
    global $DBDatos;
    global $valores_resultado;

	$test_id=CCGetParam("test_id","");

    $result = CCDLookUp("nom_test", "test", "test_id=$test_id", $DBDatos);
    $result = strval($result);
    $valores_resultado->nom_test->SetValue($result);
//End DLookup

//Close valores_resultado_nom_test_BeforeShow @20-BE169798
    return $valores_resultado_nom_test_BeforeShow;
}
//End Close valores_resultado_nom_test_BeforeShow

//DEL      echo "<b>Se han grabado los Cambios</b></br>";

//Page_AfterInitialize @1-E2B83004
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_list_resultados; //Compatibility
//End Page_AfterInitialize

//Custom Code @19-D9C09957
// -------------------------
    global $add_list_resultados;
	global $valores_resultado;
	global $lbl_onload;


	$test_id=CCGetParam("test_id","");
	if ($test_id=="") {
		echo '<center><img id="Image1" src="images/menu/important.gif" name="Image1"><h1>Debe grabar antes el test</h1></center>';
		exit;
	} 

	$db=new clsDBDatos();
	$sql="SELECT compuesto FROM test WHERE test_id=$test_id";
	$db->query($sql);
	
	$compuesto=($db->next_record()) ? $db->f(0) : "" ;

	unset($db);

	if ($compuesto != 'F') {
		print("<h1>El Test no Puede Tener una lista de Valores</h1>");
		exit;
	}






// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-4C0A1451
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_list_resultados; //Compatibility
//End Page_BeforeOutput

//Custom Code @31-2A29BDB7
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
