<?php
//BindEvents Method @1-DA8026D8
function BindEvents()
{
    global $insumos;
    global $CCSEvents;
    $insumos->insumos_TotalRecords->CCSEvents["BeforeShow"] = "insumos_insumos_TotalRecords_BeforeShow";
    $insumos->CCSEvents["BeforeShowRow"] = "insumos_BeforeShowRow";
    $insumos->ds->CCSEvents["BeforeExecuteDelete"] = "insumos_ds_BeforeExecuteDelete";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//insumos_insumos_TotalRecords_BeforeShow @8-6536C8CB
function insumos_insumos_TotalRecords_BeforeShow(& $sender)
{
    $insumos_insumos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_insumos_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close insumos_insumos_TotalRecords_BeforeShow @8-57BED996
    return $insumos_insumos_TotalRecords_BeforeShow;
}
//End Close insumos_insumos_TotalRecords_BeforeShow

//insumos_BeforeShowRow @2-B0AE3002
function insumos_BeforeShowRow(& $sender)
{
    $insumos_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_BeforeShowRow

//Custom Code @30-6F502BC2
// -------------------------
    global $insumos;
	global $RowNumber;
	//$insumos_x_test->EmptyRows=10;
//Increase the row number and set it within the HTML
  $RowNumber++;

  $insumos->RowIDAttribute->SetValue($RowNumber);
	
//Configure the row's properties based on its state (empty or filled)
  if (($RowNumber <= $insumos->PageSize) && ($RowNumber <= $insumos->ds->RecordsCount)) {
     $insumos->RowNameAttribute->SetValue("FillRow");
  } else {
   	$insumos->RowNameAttribute->SetValue("EmptyRow");
   	$insumos->RowStyleAttribute->SetValue("style=\"display:none;\"");
     	
   	if($insumos->RowsErrors[$RowNumber]) {
      $insumos->RowStyleAttribute->SetValue("");
    }
  }
// -------------------------
//End Custom Code

//Close insumos_BeforeShowRow @2-93413EFE
    return $insumos_BeforeShowRow;
}
//End Close insumos_BeforeShowRow

//insumos_ds_BeforeExecuteDelete @2-853E95D0
function insumos_ds_BeforeExecuteDelete(& $sender)
{
    $insumos_ds_BeforeExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_ds_BeforeExecuteDelete

//Custom Code @31-6F502BC2
// -------------------------
    global $insumos;
  //Create a new database connection object
  $db = new clsDBDatos();
  
  //Get the where parameters
  $insumoID = $insumos->ds->Where;
  if (strlen($insumoID) > 0) {
    //Update employees table
    $db->query("UPDATE insumos SET insumo_id = NULL WHERE " . $insumoID);
  }

  //Close and destroy the database connection object
  $db->close();
// -------------------------
//End Custom Code

//Close insumos_ds_BeforeExecuteDelete @2-9DAD4FB7
    return $insumos_ds_BeforeExecuteDelete;
}
//End Close insumos_ds_BeforeExecuteDelete

//Page_BeforeOutput @1-4BC1F3F2
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $list_insumos; //Compatibility
//End Page_BeforeOutput

//Custom Code @49-2A29BDB7
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
