<?php
//BindEvents Method @1-6E892E22
function BindEvents()
{
    global $resultados;
    global $CCSEvents;
    $resultados->img_archivo->CCSEvents["BeforeShow"] = "resultados_img_archivo_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//resultados_img_archivo_BeforeShow @48-B8E90480
function resultados_img_archivo_BeforeShow(& $sender)
{
    $resultados_img_archivo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $resultados; //Compatibility
//End resultados_img_archivo_BeforeShow

//Custom Code @49-1292BE33
// -------------------------
    global $resultados;
    // Write your own code here.

	$archivo=$resultados->archivo->GetValue();

	if($archivo != "") {
		$resultados->img_archivo->SetValue("<img src=\"resultado/$archivo\" boder=\"0\">");
	}

// -------------------------
//End Custom Code

//Close resultados_img_archivo_BeforeShow @48-EAD8E4C0
    return $resultados_img_archivo_BeforeShow;
}
//End Close resultados_img_archivo_BeforeShow

//Page_BeforeOutput @1-2E816CE6
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_resultado_ver_imagen; //Compatibility
//End Page_BeforeOutput

//Custom Code @51-2A29BDB7
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
