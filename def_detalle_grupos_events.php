<?php
//BindEvents Method @1-74C6AF80
function BindEvents()
{
    global $grupos_detalle;
    global $CCSEvents;
    $grupos_detalle->nom_grupo->CCSEvents["BeforeShow"] = "grupos_detalle_nom_grupo_BeforeShow";
    $grupos_detalle->grupos_detalle_TotalRecords->CCSEvents["BeforeShow"] = "grupos_detalle_grupos_detalle_TotalRecords_BeforeShow";
    $grupos_detalle->CCSEvents["BeforeShow"] = "grupos_detalle_BeforeShow";
    $grupos_detalle->CCSEvents["BeforeShowRow"] = "grupos_detalle_BeforeShowRow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//grupos_detalle_nom_grupo_BeforeShow @107-2517AEFE
function grupos_detalle_nom_grupo_BeforeShow(& $sender)
{
    $grupos_detalle_nom_grupo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos_detalle; //Compatibility
//End grupos_detalle_nom_grupo_BeforeShow

//DLookup @108-15776C96
    global $DBDatos;
    $Page = CCGetParentPage($sender);
    $ccs_result = CCDLookUp('nom_grupo', 'grupos', "grupo_id=" . CCGetParam("grupo_id","0"), $Page->Connections["Datos"]);
    $ccs_result = strval($ccs_result);
    $Container->nom_grupo->SetValue($ccs_result);
//End DLookup

//Close grupos_detalle_nom_grupo_BeforeShow @107-1A294CC9
    return $grupos_detalle_nom_grupo_BeforeShow;
}
//End Close grupos_detalle_nom_grupo_BeforeShow

//grupos_detalle_grupos_detalle_TotalRecords_BeforeShow @4-DFAE2D11
function grupos_detalle_grupos_detalle_TotalRecords_BeforeShow(& $sender)
{
    $grupos_detalle_grupos_detalle_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos_detalle; //Compatibility
//End grupos_detalle_grupos_detalle_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close grupos_detalle_grupos_detalle_TotalRecords_BeforeShow @4-2149E96A
    return $grupos_detalle_grupos_detalle_TotalRecords_BeforeShow;
}
//End Close grupos_detalle_grupos_detalle_TotalRecords_BeforeShow

//grupos_detalle_BeforeShow @2-59185C5B
function grupos_detalle_BeforeShow(& $sender)
{
    $grupos_detalle_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos_detalle; //Compatibility
//End grupos_detalle_BeforeShow

//Declare Variable @70-BC0ADDB3
    global $r;
    $r = 1;
//End Declare Variable

//Close grupos_detalle_BeforeShow @2-E30C52BB
    return $grupos_detalle_BeforeShow;
}
//End Close grupos_detalle_BeforeShow

//grupos_detalle_BeforeShowRow @2-843BA897
function grupos_detalle_BeforeShowRow(& $sender)
{
    $grupos_detalle_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $grupos_detalle; //Compatibility
//End grupos_detalle_BeforeShowRow

//Custom Code @71-839ABE6C
// -------------------------
    global $grupos_detalle;
	global $r;
    // Write your own code here.

	if ($r==1) {
		$grupos_detalle->imgsube->SetValue('<img class="" alt="Sube un lugar" src="images/restar.png" border="0">');
	} else 
		$grupos_detalle->imgsube->SetValue('<img class="" alt="Sube un lugar" src="images/restar.png" border="0">');	

	if ($r == $grupos_detalle->ds->RecordsCount) {
		$grupos_detalle->img_baja->SetValue('<img class="" alt="Baja un lugar" src="images/sumar.png" border="0">');

	} else {	
		$grupos_detalle->img_baja->SetValue('<img class="" alt="Baja un lugar" src="images/sumar.png" border="0">');	
	}

	if ($r > $grupos_detalle->ds->RecordsCount) {
		$grupos_detalle->imgsube->SetValue('');
		$grupos_detalle->img_baja->SetValue('');	

	}
	$r++;



// -------------------------
//End Custom Code

//Close grupos_detalle_BeforeShowRow @2-9AFBADB9
    return $grupos_detalle_BeforeShowRow;
}
//End Close grupos_detalle_BeforeShowRow

//Page_AfterInitialize @1-9C217443
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $def_detalle_grupos; //Compatibility
//End Page_AfterInitialize

//Custom Code @61-B02D5809
// -------------------------
    global $def_detalle_grupos;
	global $grupos_detalle;

    // Write your own code here.

	$accion=CCGetParam("accion","");
	$test_id=CCGetParam("test_id","0");
	$grupo_id=CCGetParam("grupo_id","0");

	$btngrabar=CCGetParam("Button_Submit","");

	if ($btngrabar=="" && $grupo_id!="0") {
	//Solo ejecuta si es que no se presionó el botón grabar
		switch ($accion) {
			case "sube_inf" :
				if (intval($test_id)<1) break;
				$db= new clsDBDatos();
				$sql="UPDATE test SET orden_informe=orden_informe - 1 WHERE test_id=$test_id";
				$db->query($sql);
				$db->close();
				break;

			case "baja_inf" :
				if (intval($test_id)<1) break;
				$db= new clsDBDatos();
				$sql="UPDATE test SET orden_informe=orden_informe + 1 WHERE test_id=$test_id";
				$db->query($sql);
				$db->close();
				break;

			case "sube_ing" :
				if (intval($test_id)<1) break;
				$db= new clsDBDatos();
				$sql="UPDATE test SET orden_ingreso=orden_ingreso - 1 WHERE test_id=$test_id";
				$db->query($sql);
				$db->close();
				break;

			case "baja_ing" :
				if (intval($test_id)<1) break;
				$db= new clsDBDatos();
				$sql="UPDATE test SET orden_ingreso=orden_ingreso + 1 WHERE test_id=$test_id";
				$db->query($sql);
				$db->close();
				break;

			case "renumerar_inf" :
				$db=new clsDBDatos();
				$sql="SELECT 
					  test.test_id,
					  test.cod_test,
					  test.orden_informe,
					  grupos_detalle.grupo_id
					FROM
					  grupos_detalle
					  LEFT OUTER JOIN test ON (grupos_detalle.test_id = test.test_id)
					WHERE
					  (grupos_detalle.grupo_id = $grupo_id)
					ORDER BY
					  test.orden_informe";
				$db->query($sql);
				$i=1;
				$db2=new clsDBDatos();

				while ($db->next_record()){
					$sql="UPDATE test SET orden_informe=$i WHERE test_id=".$db->f("test_id");
					$db2->query($sql);
					$i++;
				}
				$db->close();
				unset($db2);

				break;

			case "renumerar_ing" :
				$db=new clsDBDatos();
				$sql="SELECT 
					  test.test_id,
					  test.cod_test,
					  test.orden_ingreso,
					  grupos_detalle.grupo_id
					FROM
					  grupos_detalle
					  LEFT OUTER JOIN test ON (grupos_detalle.test_id = test.test_id)
					WHERE
					  (grupos_detalle.grupo_id = $grupo_id)
					ORDER BY
					  test.orden_ingreso";
				$db->query($sql);
				$i=1;
				$db2=new clsDBDatos();

				while ($db->next_record()){
					$sql="UPDATE test SET orden_ingreso=$i WHERE test_id=".$db->f("test_id");
					$db2->query($sql);
					$i++;
				}
				$db->close();
				unset($db2);

				break;
			//fIN SWITCH
		}

	}
// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-FF6F6BAB
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $def_detalle_grupos; //Compatibility
//End Page_BeforeOutput

//Custom Code @109-2A29BDB7
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
