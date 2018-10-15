<?php
//BindEvents Method @1-65987590
function BindEvents()
{
    global $insumos;
    global $CCSEvents;
    $insumos->CCSEvents["BeforeShow"] = "insumos_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//insumos_BeforeShow @3-3EEBBDCB
function insumos_BeforeShow(& $sender)
{
    $insumos_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $insumos; //Compatibility
//End insumos_BeforeShow

//Custom Code @22-6F502BC2
// -------------------------
    global $insumos;
   /* $last_insumo_id= CCGetParam("last_insumo_id","");
	$last_nom_insumo= CCGetParam("last_nom_insumo","");
    $script="
	<html>
	<title>Softlab</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<head>
	<script>
		function pasar_valor(f){
			//alert('entro a la funcion');
			if(f.last_insert_id.value != ''){
				//alert('entro al if');
				window.opener.insumos_x_test.$last_insumo_id.value = f.last_insert_id.value;
				window.opener.insumos_x_test.$last_nom_insumo.value = f.nom_insumo.value;
				window.opener.insumos_x_test.$last_insumo_id.focus();
				window.close();
				//alert('final del if');
			}	
		}
	</script>";
	echo($script);*/
// -------------------------
//End Custom Code

//Close insumos_BeforeShow @3-92FA6728
    return $insumos_BeforeShow;
}
//End Close insumos_BeforeShow

//Page_BeforeOutput @1-C1D3576D
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_insumo; //Compatibility
//End Page_BeforeOutput

//Custom Code @35-2A29BDB7
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
