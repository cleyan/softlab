<?php
//BindEvents Method @1-E0949B07
function BindEvents()
{
    global $insumos_x_test;
    global $CCSEvents;
    $insumos_x_test->nom_test->CCSEvents["BeforeShow"] = "insumos_x_test_nom_test_BeforeShow";
    $insumos_x_test->insumos_x_test_TotalRecords->CCSEvents["BeforeShow"] = "insumos_x_test_insumos_x_test_TotalRecords_BeforeShow";
    $insumos_x_test->CCSEvents["BeforeShow"] = "insumos_x_test_BeforeShow";
    $insumos_x_test->CCSEvents["BeforeSubmit"] = "insumos_x_test_BeforeSubmit";
    $insumos_x_test->ds->CCSEvents["BeforeExecuteDelete"] = "insumos_x_test_ds_BeforeExecuteDelete";
    $insumos_x_test->CCSEvents["BeforeShowRow"] = "insumos_x_test_BeforeShowRow";
    $insumos_x_test->CCSEvents["OnValidate"] = "insumos_x_test_OnValidate";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//insumos_x_test_nom_test_BeforeShow @60-72451ACB
function insumos_x_test_nom_test_BeforeShow(& $sender)
{
    $insumos_x_test_nom_test_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_x_test; //Compatibility
//End insumos_x_test_nom_test_BeforeShow

//Custom Code @61-70B2F9E6
// -------------------------
    global $insumos_x_test;
    global $DBDatos;

	$nom_test = CCGetDBValue("SELECT nom_test FROM test WHERE test_id='".CCGetParam("test_id","0")."'",$DBDatos);
	$insumos_x_test->nom_test->SetValue($nom_test);
// -------------------------
//End Custom Code

//Close insumos_x_test_nom_test_BeforeShow @60-B73B504A
    return $insumos_x_test_nom_test_BeforeShow;
}
//End Close insumos_x_test_nom_test_BeforeShow

//insumos_x_test_insumos_x_test_TotalRecords_BeforeShow @6-23CEFC9E
function insumos_x_test_insumos_x_test_TotalRecords_BeforeShow(& $sender)
{
    $insumos_x_test_insumos_x_test_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_x_test; //Compatibility
//End insumos_x_test_insumos_x_test_TotalRecords_BeforeShow

//Retrieve number of records @7-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close insumos_x_test_insumos_x_test_TotalRecords_BeforeShow @6-2630F31E
    return $insumos_x_test_insumos_x_test_TotalRecords_BeforeShow;
}
//End Close insumos_x_test_insumos_x_test_TotalRecords_BeforeShow

//insumos_x_test_BeforeShow @2-2C5EB6DA
function insumos_x_test_BeforeShow(& $sender)
{
    $insumos_x_test_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_x_test; //Compatibility
//End insumos_x_test_BeforeShow

//Custom Code @68-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close insumos_x_test_BeforeShow @2-53E35055
    return $insumos_x_test_BeforeShow;
}
//End Close insumos_x_test_BeforeShow

//insumos_x_test_BeforeSubmit @2-53B0FAB4
function insumos_x_test_BeforeSubmit(& $sender)
{
    $insumos_x_test_BeforeSubmit = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_x_test; //Compatibility
//End insumos_x_test_BeforeSubmit

//Custom Code @69-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close insumos_x_test_BeforeSubmit @2-016AC615
    return $insumos_x_test_BeforeSubmit;
}
//End Close insumos_x_test_BeforeSubmit

//insumos_x_test_ds_BeforeExecuteDelete @2-1CCDB515
function insumos_x_test_ds_BeforeExecuteDelete(& $sender)
{
    $insumos_x_test_ds_BeforeExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_x_test; //Compatibility
//End insumos_x_test_ds_BeforeExecuteDelete

//Custom Code @70-70B2F9E6
// -------------------------
    global $insumos_x_test;
  //Create a new database connection object
  $db = new clsDBDatos();
  
  //Get the where parameters
  $insumoID = $insumos_x_test->ds->Where;
  if (strlen($insumoID) > 0) {
    //Update employees table
    $db->query("UPDATE insumos_x_test SET insumo_id = NULL WHERE " . $insumoID);
  }

  //Close and destroy the database connection object
  $db->close();
// -------------------------
//End Custom Code

//Close insumos_x_test_ds_BeforeExecuteDelete @2-521E2C1B
    return $insumos_x_test_ds_BeforeExecuteDelete;
}
//End Close insumos_x_test_ds_BeforeExecuteDelete

$RowNumber = 0;
//insumos_x_test_BeforeShowRow @2-F48243AE
function insumos_x_test_BeforeShowRow(& $sender)
{
    $insumos_x_test_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_x_test; //Compatibility
//End insumos_x_test_BeforeShowRow

//Custom Code @71-70B2F9E6
// -------------------------
    global $insumos_x_test;
	global $RowNumber;
	//$insumos_x_test->EmptyRows=10;
//Increase the row number and set it within the HTML
  $RowNumber++;

  $insumos_x_test->RowIDAttribute->SetValue($RowNumber);
	
//Configure the row's properties based on its state (empty or filled)
  if (($RowNumber <= $insumos_x_test->PageSize) && ($RowNumber <= $insumos_x_test->ds->RecordsCount)) {
     $insumos_x_test->RowNameAttribute->SetValue("FillRow");
  } else {
   	$insumos_x_test->RowNameAttribute->SetValue("EmptyRow");
   	$insumos_x_test->RowStyleAttribute->SetValue("style=\"display:none;\"");
     	
   	if($insumos_x_test->RowsErrors[$RowNumber]) {
      $insumos_x_test->RowStyleAttribute->SetValue("");
    }
  }
	//$insumos_x_test->total_registros->SetValue($insumos_x_test->ds->RecordsCount);
	//$insumos_x_test->total_filas->SetValue($RowNumber);
	//echo("Reg: ".$insumos_x_test->ds->RecordsCount." filas: ".$RowNumber."<br/>");
// -------------------------
//End Custom Code

//Close insumos_x_test_BeforeShowRow @2-3B04CDC8
    return $insumos_x_test_BeforeShowRow;
}
//End Close insumos_x_test_BeforeShowRow

//insumos_x_test_OnValidate @2-DAEE8AD8
function insumos_x_test_OnValidate(& $sender)
{
    $insumos_x_test_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos_x_test; //Compatibility
//End insumos_x_test_OnValidate

//Custom Code @72-70B2F9E6
// -------------------------
    global $insumos_x_test;
    
// -------------------------
//End Custom Code

//Close insumos_x_test_OnValidate @2-6C1834DC
    return $insumos_x_test_OnValidate;
}
//End Close insumos_x_test_OnValidate

//Page_BeforeOutput @1-C65DAB54
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $asignar_insumos_test; //Compatibility
//End Page_BeforeOutput

//Custom Code @90-2A29BDB7
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
