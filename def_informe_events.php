<?php
//BindEvents Method @1-A4DE96F1
function BindEvents()
{
    global $informes;
    global $informes1;
    global $CCSEvents;
    $informes->informes_TotalRecords->CCSEvents["BeforeShow"] = "informes_informes_TotalRecords_BeforeShow";
    $informes->CCSEvents["BeforeShowRow"] = "informes_BeforeShowRow";
    $informes->CCSEvents["BeforeShow"] = "informes_BeforeShow";
    $informes1->CCSEvents["BeforeDelete"] = "informes1_BeforeDelete";
    $informes1->CCSEvents["BeforeShow"] = "informes1_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//informes_informes_TotalRecords_BeforeShow @7-C4AC1AA8
function informes_informes_TotalRecords_BeforeShow(& $sender)
{
    $informes_informes_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informes; //Compatibility
//End informes_informes_TotalRecords_BeforeShow

//Retrieve number of records @8-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close informes_informes_TotalRecords_BeforeShow @7-C38B7AD9
    return $informes_informes_TotalRecords_BeforeShow;
}
//End Close informes_informes_TotalRecords_BeforeShow

//informes_BeforeShowRow @2-C310504F
function informes_BeforeShowRow(& $sender)
{
    $informes_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informes; //Compatibility
//End informes_BeforeShowRow

//Custom Code @49-F8123F1D
// -------------------------
    global $informes;
	global $r;
    // Write your own code here.
	
	$detalle_informe_id=CCGetParam("detalle_informe_id","0");
	$informe_id=$informes->informe_id->GetValue();
	$limpiar=CCGetParam("limpiar","no");
	

	$informes->lbl_lin_fondo->SetValue("images/treemenu/line.gif");

	if ($limpiar=="no" && $informe_id==$detalle_informe_id){
		$db= new clsDBDatos();
		$sql="SELECT grupo_id, nom_grupo FROM grupos WHERE informe_id=$detalle_informe_id ORDER BY orden";
		$db->query($sql);
		$tmp_grupo="";
		while ($db->next_record()){
			//Recupera los grupos del informe elegido
			$tmp_grupo.="<tr><td></td><td><a href=\"def_grupos.php?s_informe_id=$informe_id&grupo_id=".$db->f('grupo_id').'" title="Editar el Grupo '. $db->f('nom_grupo') .' " ><img src="images/treemenu/file.png" border="0"></a></td><td>'.$db->f("nom_grupo")."</td></tr>";

		}
		//Si no hay lo informa
		$tmp_grupo=($tmp_grupo=="")? '<tr><td><img src="images/treemenu/editdelete.png"></td><td>No hay grupos definidos</td></tr>' : $tmp_grupo;

		//crea el menu para los grupos

		//Coloca el menu al inicio
		$tmp_grupo='<tr><td><img src="images/treemenu/folder-expanded.gif"></td><td colspan="2"> '."Grupos del Informe".'</td></tr>' . $tmp_grupo;

		//Termina la tabla
		$tmp_grupo="<table border=\"0\">$tmp_grupo</table>";

		//Asigna el resultado final
		$informes->lbl_det_grupo->SetValue($tmp_grupo);

		//muestra icono
		$informes->det_grupo->SetValue('<img src="images/configure16.png" border="0">');

		if ($informes->ds->RecordsCount==$r) {	
			$informes->lbl_lin_fondo->SetValue("");
			$informes->lbl_tree_1->SetValue('<img class="" src="images/treemenu/branchbottom.gif">');
		} else 
			$informes->lbl_tree_1->SetValue('<img class="" src="images/treemenu/branch.gif">');

		$informes->icon_plus->Parameters = CCAddParam($informes->icon_plus->Parameters, "limpiar", "true");
		if ($r==1) {
			$informes->icon_plus->SetValue('<img src="images/treemenu/minustop.gif" border="0">');
		} else 
			$informes->icon_plus->SetValue('<img src="images/treemenu/minus.gif" border="0">');


	} else {
		$informes->lbl_tree_1->SetValue('');
		$informes->lbl_det_grupo->SetValue("");
		//no muestra icono
		$informes->det_grupo->SetValue('');

		if ($r==1) {
			$informes->icon_plus->SetValue('<img src="images/treemenu/plustop.gif" border="0">');
		} elseif ($informes->ds->RecordsCount==$r) {
			$informes->icon_plus->SetValue('<img src="images/treemenu/plusbottom.gif" border="0">');
		} else 
			$informes->icon_plus->SetValue('<img src="images/treemenu/plus.gif" border="0">');
	}
//	$informes->linea->SetValue($r++);"
	$r++;

// -------------------------
//End Custom Code

//Close informes_BeforeShowRow @2-7C819F83
    return $informes_BeforeShowRow;
}
//End Close informes_BeforeShowRow

//informes_BeforeShow @2-AE484394
function informes_BeforeShow(& $sender)
{
    $informes_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informes; //Compatibility
//End informes_BeforeShow

//Declare Variable @55-BC0ADDB3
    global $r;
    $r = 1;
//End Declare Variable

//Close informes_BeforeShow @2-83A1CE78
    return $informes_BeforeShow;
}
//End Close informes_BeforeShow

//informes1_BeforeDelete @24-802AEE51
function informes1_BeforeDelete(& $sender)
{
    $informes1_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informes1; //Compatibility
//End informes1_BeforeDelete

//Custom Code @59-5C8C581D
// -------------------------
    global $informes1;
	global $Redirect;

    // Write your own code here.

	$informes1->DeleteAllowed=false;

	$informe_id=CCGetParam("informe_id","");

	header("Location: elim_informe.php?informe_id=$informe_id");

	exit;

// -------------------------
//End Custom Code

//Close informes1_BeforeDelete @24-40DC3EB7
    return $informes1_BeforeDelete;
}
//End Close informes1_BeforeDelete

//informes1_BeforeShow @24-F628DD27
function informes1_BeforeShow(& $sender)
{
    $informes1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informes1; //Compatibility
//End informes1_BeforeShow

//Custom Code @64-5C8C581D
// -------------------------
    global $informes1;
    // Write your own code here.

	$accion=CCGetParam("accion","");
	$informe_id=CCGetParam("informe_id","");

	if ($informe_id=="" and $accion!="agregar"){
		$informes1->Visible=false;
	} else {
		$informes1->Visble=true;
	}

// -------------------------
//End Custom Code

//Close informes1_BeforeShow @24-69091C28
    return $informes1_BeforeShow;
}
//End Close informes1_BeforeShow

//Page_BeforeOutput @1-540991A4
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $def_informe; //Compatibility
//End Page_BeforeOutput

//Custom Code @71-2A29BDB7
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

//DEL  // -------------------------
//DEL      global $informes1;
//DEL      // Write your own code here.
//DEL  
//DEL  	$informe_id=CCGetParam("informe_id","0");
//DEL  	
//DEL  	$db=new clsDBDatos();
//DEL  
//DEL  	//Inicia la eliminacion en cascada
//DEL  	//1) Los grupos detalle
//DEL  	$sql="DELETE FROM grupos_detalle WHERE grupo_id IN (SELECT grupos.grupo_id FROM grupos WHERE informe_id = $informe_id)";
//DEL  	$db->query($sql);	
//DEL  
//DEL  	//2) Los grupos del Informe 
//DEL  	$sql="DELETE FROM grupos WHERE informe_id=$informe_id";
//DEL  	$db->query($sql);	
//DEL  
//DEL  	//3) El informe_detalle (los test asociados)
//DEL  	$sql="DELETE FROM informes_detalle WHERE informe_id=$informe_id";
//DEL  	$db->query($sql);	
//DEL  
//DEL  
//DEL  	$db->close();
//DEL  // -------------------------



?>
