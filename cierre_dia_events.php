<?php
//BindEvents Method @1-92644B89
function BindEvents()
{
    global $Tablas;
    global $CCSEvents;
    $Tablas->nom_tabla->CCSEvents["BeforeShow"] = "Tablas_nom_tabla_BeforeShow";
    $Tablas->reparacion->CCSEvents["BeforeShow"] = "Tablas_reparacion_BeforeShow";
    $Tablas->CCSEvents["BeforeSelect"] = "Tablas_BeforeSelect";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Tablas_nom_tabla_BeforeShow @4-DFD2E1EC
function Tablas_nom_tabla_BeforeShow(& $sender)
{
    $Tablas_nom_tabla_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Tablas; //Compatibility
//End Tablas_nom_tabla_BeforeShow

//Custom Code @8-792015C1
// -------------------------
    global $Tablas;

	$tabla=$Tablas->nom_tabla->GetValue();

	$db = new clsDBDatos();
	$sql="REPAIR TABLE $tabla";
	$db->query($sql);
	$resultado=($db->next_record()) ? $db->f(3) : "--";
	
	$Tablas->reparacion->SetValue($resultado);

	$sql="OPTIMIZE TABLE $tabla";
	$db->query($sql);
	$resultado=($db->next_record()) ? $db->f(3) : "--";
	
	$Tablas->optimizar->SetValue($resultado);
	
	$sql="ANALYZE TABLE $tabla";
	$db->query($sql);
	$resultado=($db->next_record()) ? $db->f(3) : "--";
	
	$Tablas->analizar->SetValue($resultado);


	unset($db);


// -------------------------
//End Custom Code

//Close Tablas_nom_tabla_BeforeShow @4-85140E4E
    return $Tablas_nom_tabla_BeforeShow;
}
//End Close Tablas_nom_tabla_BeforeShow

//Tablas_reparacion_BeforeShow @5-3872CA45
function Tablas_reparacion_BeforeShow(& $sender)
{
    $Tablas_reparacion_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Tablas; //Compatibility
//End Tablas_reparacion_BeforeShow

//Custom Code @6-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close Tablas_reparacion_BeforeShow @5-CC09E1A6
    return $Tablas_reparacion_BeforeShow;
}
//End Close Tablas_reparacion_BeforeShow

//Tablas_BeforeSelect @3-CB3E7BE1
function Tablas_BeforeSelect(& $sender)
{
    $Tablas_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Tablas; //Compatibility
//End Tablas_BeforeSelect

//Custom Code @16-792015C1
// -------------------------
    global $Tablas;
    // Write your own code here.

	$s_optimizar=CCGetParam("s_optimizar","");

	if ($s_optimizar=="") {
		$Tablas->Visible=False;
	}

// -------------------------
//End Custom Code

//Close Tablas_BeforeSelect @3-98172E91
    return $Tablas_BeforeSelect;
}
//End Close Tablas_BeforeSelect

//Page_BeforeOutput @1-8E348728
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cierre_dia; //Compatibility
//End Page_BeforeOutput

//Custom Code @22-2A29BDB7
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
