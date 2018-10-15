<?php
//BindEvents Method @1-3B319AF9
function BindEvents()
{
    global $test_secciones_equiposSearch;
    global $test_secciones_equipos;
    global $CCSEvents;
    $test_secciones_equiposSearch->CCSEvents["BeforeShow"] = "test_secciones_equiposSearch_BeforeShow";
    $test_secciones_equipos->CCSEvents["BeforeShowRow"] = "test_secciones_equipos_BeforeShowRow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//test_secciones_equiposSearch_BeforeShow @19-D82626BE
function test_secciones_equiposSearch_BeforeShow(& $sender)
{
    $test_secciones_equiposSearch_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test_secciones_equiposSearch; //Compatibility
//End test_secciones_equiposSearch_BeforeShow

//Custom Code @57-40E56DC0
// -------------------------
    global $test_secciones_equiposSearch;
    // Write your own code here.

      global $DBDatos;

	  $seccion_id=CCGetParam("seccion_id","");
	  if ($seccion_id!="") {
	      $result = CCDLookUp("nom_seccion", "secciones", "seccion_id=$seccion_id", $DBDatos);
	      $test_secciones_equiposSearch->nombre_seccion->SetValue("<strong>$result</strong>");
	  	  $test_secciones_equiposSearch->lbl_hideseccion->SetValue('style="display: none"');
	  } else {
	  	  $test_secciones_equiposSearch->lbl_hideseccion->SetValue('');

	  }

// -------------------------
//End Custom Code

//Close test_secciones_equiposSearch_BeforeShow @19-6A551DC7
    return $test_secciones_equiposSearch_BeforeShow;
}
//End Close test_secciones_equiposSearch_BeforeShow

//test_secciones_equipos_BeforeShowRow @2-6FEF83FD
function test_secciones_equipos_BeforeShowRow(& $sender)
{
    $test_secciones_equipos_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $test_secciones_equipos; //Compatibility
//End test_secciones_equipos_BeforeShowRow

//Custom Code @58-FEF9D1E4
// -------------------------
    global $test_secciones_equipos;
    // Write your own code here.


    	$test_id=$test_secciones_equipos->test_id->GetValue();
    	$cod_test=$test_secciones_equipos->cod_test->GetValue();
    
    	$objeto="<input name=\"test_peticion[$test_id]\" id=\"$cod_test\" value=\"$test_id\" type=\"checkbox\">";
    	$test_secciones_equipos->lblOp->SetValue($objeto);
    
    	$Alt_test_id=$test_secciones_equipos->Alt_test_id->GetValue();
    	$Alt_cod_test=$test_secciones_equipos->Alt_cod_test->GetValue();
    
    	$Alt_objeto="<input name=\"test_peticion[$Alt_test_id]\" id=\"$Alt_cod_test\" value=\"$Alt_test_id\" type=\"checkbox\">";
    	$test_secciones_equipos->Alt_lblOp->SetValue($Alt_objeto);
  



// -------------------------
//End Custom Code

//Close test_secciones_equipos_BeforeShowRow @2-29A6A62F
    return $test_secciones_equipos_BeforeShowRow;
}
//End Close test_secciones_equipos_BeforeShowRow

//Page_BeforeOutput @1-4993B1E1
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $frmEligeTest; //Compatibility
//End Page_BeforeOutput

//Custom Code @61-2A29BDB7
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
