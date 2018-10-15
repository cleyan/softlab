<?php
//BindEvents Method @1-B31357B1
function BindEvents()
{
    global $filtro;
    global $grilla;
    global $CCSEvents;
    $filtro->CCSEvents["OnValidate"] = "filtro_OnValidate";
    $grilla->CCSEvents["BeforeShow"] = "grilla_BeforeShow";
    $grilla->CCSEvents["BeforeSelect"] = "grilla_BeforeSelect";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//filtro_OnValidate @2-BAD5946E
function filtro_OnValidate(& $sender)
{
    $filtro_OnValidate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $filtro; //Compatibility
//End filtro_OnValidate

//Custom Code @15-EB30A51E
// -------------------------
    global $filtro;
	$peticion_id = CCGetParam("s_peticion_id","");
    if($peticion_id==""){
		$filtro->Errors->AddError("Ingrese una petición...>");
	}
	elseif(!existe_peticion($peticion_id)){											//FUNCIÓN 19
		$filtro->Errors->AddError("Petición no valida...");
	}

// -------------------------
//End Custom Code

//Close filtro_OnValidate @2-8B5C100F
    return $filtro_OnValidate;
}
//End Close filtro_OnValidate

//grilla_BeforeShow @5-D2619E53
function grilla_BeforeShow(& $sender)
{
    $grilla_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grilla; //Compatibility
//End grilla_BeforeShow

//Custom Code @14-CC4399D6
// -------------------------
    global $grilla;
	global $filtro;

	$s_peticion_id = CCGetParam("s_peticion_id","");
	$grilla->peticion_id->SetValue($s_peticion_id);
	$accion = $_POST["Guardar"];

	if($accion == "Guardar"){
		guardar_resultados(CCGetParam("peticion_id",""));	//FUNCIÓN 16
	}
	//elseif($s_peticion_id!=""){
		$peticiones = peticion_detalle($s_peticion_id);		//FUNCIÓN 03

		$col_mostrar = array();
		$c = array();
		$c["col_peticion"]= false;
		$c["col_muestraID"]= true;
		$c["col_paciente"]= false;
		$c["col_test"]= true;
		$c["col_seccion"]= false;
		$c["col_equipo"]= false;
		$c["col_resultado"]= true;
		$c["col_estado"]= true;
		$c["col_archivo"]= usar_columna_archivo($peticiones);
		$c["col_mult_resultado"]= usar_col_mult_resultado($peticiones);
		
		$col_mostrar[] = $c;

		$pagina="peticion";
		$grilla->inf_peticion->SetValue(generar_inf_Peticion($s_peticion_id));						//FUNCIÓN 01
		$grilla->grilla_peticiones->SetValue(generar_grila_resultados($peticiones,$col_mostrar,$pagina));	//FUNCIÓN 02
	//}
// -------------------------
//End Custom Code

//Close grilla_BeforeShow @5-B321444F
    return $grilla_BeforeShow;
}
//End Close grilla_BeforeShow

//grilla_BeforeSelect @5-3553B509
function grilla_BeforeSelect(& $sender)
{
    $grilla_BeforeSelect = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grilla; //Compatibility
//End grilla_BeforeSelect

//Custom Code @22-CC4399D6
// -------------------------
    global $grilla;
    // Write your own code here.

	$peticion_id=CCGetParam("s_peticion_id","");

	if ($peticion_id=="") {
		$grilla->Visible=False;
	} else {
		$grilla->Visible=True;
	}


// -------------------------
//End Custom Code

//Close grilla_BeforeSelect @5-A9845E6A
    return $grilla_BeforeSelect;
}
//End Close grilla_BeforeSelect

//Page_BeforeOutput @1-55CC5F7A
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_resultados_peticion2; //Compatibility
//End Page_BeforeOutput

//Custom Code @34-2A29BDB7
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
