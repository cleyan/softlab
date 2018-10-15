<?php
//BindEvents Method @1-8A72A32B
function BindEvents()
{
    global $valores_referencia1;
    global $CCSEvents;
    $valores_referencia1->Component->CCSEvents["BeforeShow"] = "valores_referencia1_Component_BeforeShow";
    $valores_referencia1->valores_referencia1_TotalRecords->CCSEvents["BeforeShow"] = "valores_referencia1_valores_referencia1_TotalRecords_BeforeShow";
    $valores_referencia1->ds->CCSEvents["AfterExecuteInsert"] = "valores_referencia1_ds_AfterExecuteInsert";
    $valores_referencia1->ds->CCSEvents["AfterExecuteUpdate"] = "valores_referencia1_ds_AfterExecuteUpdate";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//valores_referencia1_Component_BeforeShow @55-DB4C432F
function valores_referencia1_Component_BeforeShow(& $sender)
{
    $valores_referencia1_Component_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $valores_referencia1; //Compatibility
//End valores_referencia1_Component_BeforeShow

//Custom Code @56-2A29BDB7
// -------------------------
	if (strlen(CCGetFromGet("mensaje"))) {  
	     $Component->SetValue(CCGetFromGet("mensaje"));  
	}
// -------------------------
//End Custom Code

//Close valores_referencia1_Component_BeforeShow @55-5C965384
    return $valores_referencia1_Component_BeforeShow;
}
//End Close valores_referencia1_Component_BeforeShow

//valores_referencia1_valores_referencia1_TotalRecords_BeforeShow @17-DADD03C4
function valores_referencia1_valores_referencia1_TotalRecords_BeforeShow(& $sender)
{
    $valores_referencia1_valores_referencia1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $valores_referencia1; //Compatibility
//End valores_referencia1_valores_referencia1_TotalRecords_BeforeShow

//Retrieve number of records @18-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close valores_referencia1_valores_referencia1_TotalRecords_BeforeShow @17-046AE726
    return $valores_referencia1_valores_referencia1_TotalRecords_BeforeShow;
}
//End Close valores_referencia1_valores_referencia1_TotalRecords_BeforeShow

//valores_referencia1_ds_AfterExecuteInsert @15-7405C15F
function valores_referencia1_ds_AfterExecuteInsert(& $sender)
{
    $valores_referencia1_ds_AfterExecuteInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $valores_referencia1; //Compatibility
//End valores_referencia1_ds_AfterExecuteInsert

//Custom Code @57-2A29BDB7
// -------------------------
  
global $Redirect;  
$Redirect = $Redirect."&mensaje=Registro ha sido actualizado";  

// -------------------------
//End Custom Code

//Close valores_referencia1_ds_AfterExecuteInsert @15-586A7B13
    return $valores_referencia1_ds_AfterExecuteInsert;
}
//End Close valores_referencia1_ds_AfterExecuteInsert

//valores_referencia1_ds_AfterExecuteUpdate @15-02E5D94D
function valores_referencia1_ds_AfterExecuteUpdate(& $sender)
{
    $valores_referencia1_ds_AfterExecuteUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $valores_referencia1; //Compatibility
//End valores_referencia1_ds_AfterExecuteUpdate

//Custom Code @58-2A29BDB7
// -------------------------
  
global $Redirect;  
$Redirect = $Redirect."&mensaje=Registro ha sido actualizado";  


// -------------------------
//End Custom Code

//Close valores_referencia1_ds_AfterExecuteUpdate @15-9743BA9C
    return $valores_referencia1_ds_AfterExecuteUpdate;
}
//End Close valores_referencia1_ds_AfterExecuteUpdate

//Page_BeforeOutput @1-ED578160
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_valores_referencia; //Compatibility
//End Page_BeforeOutput

//Custom Code @54-2A29BDB7
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
