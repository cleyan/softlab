<?php
//BindEvents Method @1-0EBC3CF0
function BindEvents()
{
    global $ayuda;
    global $CCSEvents;
    $ayuda->ayuda_TotalRecords->CCSEvents["BeforeShow"] = "ayuda_ayuda_TotalRecords_BeforeShow";
    $ayuda->CCSEvents["BeforeShowRow"] = "ayuda_BeforeShowRow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//ayuda_ayuda_TotalRecords_BeforeShow @6-FDB6D553
function ayuda_ayuda_TotalRecords_BeforeShow(& $sender)
{
    $ayuda_ayuda_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ayuda; //Compatibility
//End ayuda_ayuda_TotalRecords_BeforeShow

//Retrieve number of records @7-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close ayuda_ayuda_TotalRecords_BeforeShow @6-ABF97EAD
    return $ayuda_ayuda_TotalRecords_BeforeShow;
}
//End Close ayuda_ayuda_TotalRecords_BeforeShow

//ayuda_BeforeShowRow @2-17D030D3
function ayuda_BeforeShowRow(& $sender)
{
    $ayuda_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $ayuda; //Compatibility
//End ayuda_BeforeShowRow

//Custom Code @18-96315816
// -------------------------
    global $ayuda;
	global $ayudaSearch;
    // Write your own code here.

	if ($ayudaSearch->todo->GetValue()!=true){
		$ayuda->contenido->Visible=false;
		$ayuda->Alt_contenido->Visible=false;
	}

// -------------------------
//End Custom Code

//Close ayuda_BeforeShowRow @2-C9FF11A4
    return $ayuda_BeforeShowRow;
}
//End Close ayuda_BeforeShowRow

//Page_BeforeOutput @1-845BB283
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $busca_ayuda; //Compatibility
//End Page_BeforeOutput

//Custom Code @19-2A29BDB7
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
