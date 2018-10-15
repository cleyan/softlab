<?php
//BindEvents Method @1-C5085A3A
function BindEvents()
{
    global $grupos;
    global $grupos1;
    global $CCSEvents;
    $grupos->grupos_TotalRecords->CCSEvents["BeforeShow"] = "grupos_grupos_TotalRecords_BeforeShow";
    $grupos1->CCSEvents["BeforeSelect"] = "grupos1_BeforeSelect";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//grupos_grupos_TotalRecords_BeforeShow @8-99A7C3C4
function grupos_grupos_TotalRecords_BeforeShow(& $sender)
{
    $grupos_grupos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos; //Compatibility
//End grupos_grupos_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close grupos_grupos_TotalRecords_BeforeShow @8-25D96082
    return $grupos_grupos_TotalRecords_BeforeShow;
}
//End Close grupos_grupos_TotalRecords_BeforeShow

//grupos1_BeforeSelect @26-9C79ADD2
function grupos1_BeforeSelect(& $sender)
{
    $grupos1_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos1; //Compatibility
//End grupos1_BeforeSelect

//Custom Code @104-B9081658
// -------------------------
    global $grupos1;
    // Write your own code here.

	$grupo_id=CCGetParam("grupo_id","");
	$nuevo=CCGetParam("nuevo","");

	if ($grupo_id=="" && $nuevo=="") $grupos1->Visible=false;

// -------------------------
//End Custom Code

//Close grupos1_BeforeSelect @26-02E8C95B
    return $grupos1_BeforeSelect;
}
//End Close grupos1_BeforeSelect

//DEL  // -------------------------
//DEL      global $grupos;
//DEL      // Write your own code here.
//DEL  
//DEL  	global $r;
//DEL      // Write your own code here.
//DEL  
//DEL  	if ($r==1) {
//DEL  		$grupos->imgsube->SetValue('');
//DEL  	} else 
//DEL  		$grupos->imgsube->SetValue('<img class="" alt="Sube un lugar" src="images/1uparrow.png" border="0">');	
//DEL  
//DEL  	if ($r >= $grupos->ds->RecordsCount) {
//DEL  		$grupos->img_baja->SetValue('');
//DEL  	} else	
//DEL  		$grupos->img_baja->SetValue('<img class="" alt="Baja un lugar" src="images/1downarrow.png" border="0">');	
//DEL  
//DEL  	$r++;
//DEL  
//DEL  
//DEL  
//DEL  // -------------------------

//Page_AfterInitialize @1-6C675EB4
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $def_grupos; //Compatibility
//End Page_AfterInitialize

//Custom Code @97-79117F71
// -------------------------
    global $def_grupos;
    // Write your own code here.

	$accion=CCGetParam("accion","");
	$orden_informe_id=CCGetParam("orden_informe_id","0");
	$grupo_id=CCGetParam("orden_grupo_id","0");

	if ($accion=="subir" && intval($orden_informe_id)>1){
		$db= new clsDBDatos();
		$sql="UPDATE grupos SET orden=orden - 1 WHERE informe_id=$orden_informe_id and grupo_id=$grupo_id";
		$db->query($sql);
		$db->close();

	} elseif ($accion=="bajar" && intval($orden_informe_id)>1){
		$db= new clsDBDatos();
		$sql="UPDATE grupos SET orden=orden + 1 WHERE informe_id=$orden_informe_id and grupo_id=$grupo_id";
		$db->query($sql);
		$db->close();
	}


// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-FA83D244
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $def_grupos; //Compatibility
//End Page_BeforeOutput

//Custom Code @114-2A29BDB7
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
