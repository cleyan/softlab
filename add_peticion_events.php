<?php
//BindEvents Method @1-F8C22453
function BindEvents()
{
    global $var_test;
    global $division1;
    global $division;
    global $CCSEvents;
    $var_test->CCSEvents["BeforeShow"] = "var_test_BeforeShow";
    $division1->CCSEvents["BeforeShow"] = "division1_BeforeShow";
    $division->CCSEvents["BeforeShow"] = "division_BeforeShow";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//var_test_BeforeShow @28-91382CAD
function var_test_BeforeShow(& $sender)
{
    $var_test_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $var_test; //Compatibility
//End var_test_BeforeShow

	
//Custom Code @29-98369694
// -------------------------
    global $var_test;
    // Write your own code here.
	$seccion_id=CCGetParam('seccion_id','0');

	if ($seccion_id != '0'){
		$cond="AND secciones_id=$seccion_id";
	} else {
		$cond='';
	}

     $db=new clsDBDatos();
     $sql="SELECT codigo_fonasa, sub_codigo, cod_test, test_id FROM test WHERE aislado='V' $cond";
     $db->query($sql);
     $tmp="";
     while ($db->next_record()){
              if ($tmp=="") {
                    $tmp=  "'". str_replace("'","",$db->f('codigo_fonasa')) . str_replace("'","",$db->f('sub_codigo')) . "\t" . str_replace("'","",$db->f('cod_test')) . "\t" . $db->f('test_id') . "'";
              } else {
                	$tmp.=",'". str_replace("'","",$db->f('codigo_fonasa')) . str_replace("'","",$db->f('sub_codigo')) . "\t" . str_replace("'","",$db->f('cod_test')) . "\t" . $db->f('test_id') . "'";
              }
     }
     unset($db);	

	$var_test->SetValue("var arr_test= new Array($tmp)");
	
// -------------------------
//End Custom Code

//Close var_test_BeforeShow @28-A6723861
    return $var_test_BeforeShow;
}
//End Close var_test_BeforeShow

//division1_BeforeShow @33-5C0B181A
function division1_BeforeShow(& $sender)
{
    $division1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $division1; //Compatibility
//End division1_BeforeShow

//Custom Code @34-0FB9B0B8
// -------------------------
    global $division1;
    // Write your own code here.
	//$division1->SetValue('</td><td class="InLineFormHeaderFont" nowrap width="220" align="middle" valign="center" colspan="2">');
// -------------------------
//End Custom Code

//Close division1_BeforeShow @33-5FBB2DC7
    return $division1_BeforeShow;
}
//End Close division1_BeforeShow

//division_BeforeShow @31-92DF132E
function division_BeforeShow(& $sender)
{
    $division_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $division; //Compatibility
//End division_BeforeShow

//Custom Code @32-7E69AAEF
// -------------------------
    global $division;
    // Write your own code here.
//	$division->SetValue('</td><td align="center" valign="top" class="InLineDataTD">');
// -------------------------
//End Custom Code

//Close division_BeforeShow @31-32DAD7D2
    return $division_BeforeShow;
}
//End Close division_BeforeShow

//Page_BeforeShow @1-8D8FAE55
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_peticion; //Compatibility
//End Page_BeforeShow

//Custom Code @3-A82F42E8
// -------------------------
    global $add_peticion;

	PreparaTablaTestFrecuente();
	//PreparaTablaResto();

    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_AfterInitialize @1-86DAEE94
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_peticion; //Compatibility
//End Page_AfterInitialize

//Custom Code @11-A82F42E8
// -------------------------
    global $add_peticion;
	global $mensajes;
	global $Redirect;
	global $FileName;
	global $PathToRoot;
	global $TemplateFileName;
	global $status_peticion;
	
	$paciente_id=CCGetParam("paciente_id","");
	$grabar=CCGetParam("grabar","");
	$accion=CCGetParam("accion","");
	$cancelar=CCGetParam("cancelar","");
	$peticion_id=CCGetParam("peticion_id","");

	if ($peticion_id!=""){
		$db = new clsDBDatos();
		$db->query("SELECT peticion_id from peticiones WHERE peticion_id=$peticion_id");
		$valor=($db->next_record()) ? $db->f(0) : "";
		if ($valor!=""){
			$Redirect="edit_peticion.php?peticion_id=$peticion_id";
		} else {
			AddError("No se encontró la petición solictada");
		}
	}

	//Se presionó el botón grabar
	if ($grabar!=""){
		//Agregar nueva petición
		if(ValidaDatos())
		{
			//Grabar los nuevos registros en DB
			$peticion_id=GrabarDatosNueva();

			//luego de grabar depende de la acción solicitada
			if ($accion=="nuevo"){
				$Redirect="add_peticion.php?aviso=<b>Petición $peticion_id Grabada Exitosamente</b>";
			} else {//accion=continuar
				$Redirect="det_Peticion.php?peticion_id=$peticion_id&accion=$accion";
			}

		} else {
			//Falló la validación al grabar
			//Reescribir los datos enviados
			ReescribirDatos();
		}
	} else if ($cancelar!=""){
			$Redirect="ver_Peticiones.php";
	} else {		
		$seccion_id=CCGetParam("seccion_id","");

		//echo "SECCIONID: $seccion_id <br/>";

		//La hoja viene nueva
		if ($seccion_id==""){
			CargaCampos();
		} else {
			ReescribirDatos();
		}
		$status_peticion->SetValue("NUEVA PETICION");
	}

	//Muestra el contenido de los errores si es que está
	$mensajes->SetValue(AddError());

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-766856C6
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_peticion; //Compatibility
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


//---------------------------------------------------------------------------
//Funcion PreraraTablaTestFrecuente
function PreparaTablaTestFrecuente()
{
    global $add_peticion;
  	global $mensajes;
  	global $lblTest;
  	global $listaTest;
  	global $restoTest;
  
  	$cols=GetConfig('add_peticion_col');
	$use_largo=GetConfig('add_peticion_nom_largo');
	$lst_largo=GetConfig('add_peticion_nom_largo_list');
	$min_list=intval(GetConfig('add_peticion_minimo_item_list'));

	$seccion_id=CCGetParam("seccion_id","");
	if ($seccion_id<1) $seccion_id="";
	$test_peticion=CCGetParam("test_peticion","");

	$cond_orden=($use_largo=='V') ? "nom_test" : "cod_test";
  	///Esta seleccion es solo de los que van en el menu principal

  	$sSQL="SELECT 
		  test.test_id,
		  test.secciones_id,
		  test.cod_test,
		  test.nom_test,
		  test.acceso_rapido,
		  test.orden_peticion,
		  test.aislado,
		  test.compuesto,
		  secciones.seccion_id,
		  secciones.nom_seccion,
		  secciones.orden
		FROM
		  test
		  LEFT OUTER JOIN secciones ON (test.secciones_id = secciones.seccion_id)
			WHERE test.aislado = 'V' 
		ORDER BY
		  secciones.orden,
		  secciones.nom_seccion,
		  test.orden_peticion,
		  test.$cond_orden ";
    //AND test.acceso_rapido = 'V' "

  //die($sSQL);
  	$db = new clsDBDatos();
  	$db->query($sSQL);
  	$peticiones = array();
  
  	while ($db->next_record())
  	{
  		$p = array();
  		$p["test_id"] = $db->f("test_id");
  		$p["secciones_id"] = $db->f("secciones_id");
  		$p["cod_test"] = $db->f("cod_test");
  		$p["nom_test"] = $db->f("nom_test");
  		$p["acceso_rapido"] = $db->f("acceso_rapido");
  		$p["orden_peticion"] = $db->f("orden_peticion");
  		$p["aislado"] = $db->f("aislado");
  		$p["compuesto"] = $db->f("compuesto");
  		$p["seccion_id"] = $db->f("seccion_id");
  		$p["nom_seccion"] = $db->f("nom_seccion");
  
  		$peticiones[] = $p;
  	}
  	unset($db);
  
  	$evento="onclick=\"crealista()\"";
  	$row=1;
  	$clase="InLineDataTD";
	$puse=false;
  	while (list ($clave, $val) = each ($peticiones)) {
  		$col++;
  		if ($col>$cols) {
  			if ($puse) $row++;
			$puse=false;
  			$col=1;
  			if ($clase=="InLineAltDataTD") {
  				$clase="InLineDataTD";
  			} else {
  				$clase="InLineAltDataTD";
  			}
  		}
		$nom_pet= ($use_largo=='SI') ? $val["nom_test"] : $val["cod_test"];
		$lst_pet= ($lst_largo=='SI') ? $val["nom_test"] : $val["cod_test"];

		$nom_pet= ($val["compuesto"]=='V') ? "<font color=red><b>$nom_pet</b></font>" : $nom_pet;
		$lst_pet= ($val["compuesto"]=='V') ? "* $lst_pet" : $lst_pet;

		// Add para recuperar los grabados/seleccionados
		if ($test_peticion[$val["test_id"]]!=""){
				//Se recupera un test antes seleccionado
				$nom_seccion=$val["nom_seccion"];
				if ($nom_seccion!=$nom_seccion_old){
					//Nueva seccion encotrada
					$contenidoHTML.="<tr class=\"InLineColumnTD\"> <td colspan=\"$cols\">$nom_seccion</td></tr>";
					$nom_seccion_old=$nom_seccion;
					$col=1;
					$row++;
				}
				$puse=true;
		  		if ($col==1) {
		  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
		} else {
			//Si no venían las peticiones de test
			if ($seccion_id!="") {
				//se solicita filtrar una seccion
				if ($val['seccion_id']==$seccion_id){
					$nom_seccion=$val["nom_seccion"];
					if ($nom_seccion!=$nom_seccion_old){
						//Nueva seccion encotrada
						$contenidoHTML.="<tr class=\"InLineColumnTD\"> <td colspan=\"$cols\">$nom_seccion</td></tr>";
						$nom_seccion_old=$nom_seccion;
						$col=1;
						$row++;
					}
  					$puse=true;

			  		if ($col==1) {
			  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
			  		} else if ($col==$cols) {
			  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
			  		} else 
			  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
				}
			} else {
				//Todas las secciones
				$nom_seccion=$val["nom_seccion"];
				if ($nom_seccion!=$nom_seccion_old){
					//Nueva seccion encotrada
					$contenidoHTML.="<tr class=\"InLineColumnTD\"> <td colspan=\"$cols\">$nom_seccion</td></tr>";
					$nom_seccion_old=$nom_seccion;
					$col=1;
					$row++;
				}
  				$puse=true;

		  		if ($col==1) {
		  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
			}
		}
  	}
  
  
  	$lblTest->SetValue("<table width=100% border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"display:none\">$contenidoHTML</table>");
  	if($row<$min_list) $row=$min_list;
  	$listaTest->SetValue('<select name="lista_test" size="'.$row.'" class="InLineInput" id="lista_test" style="WIDTH: 100%; HEIGHT: 200px" ondblclick="sacar_valor();"></select>');
	//$listaTest->SetValue('<select name="lista_test" size="10" class="InLineInput" id="lista_test" style="WIDTH: 100%; HEIGHT:100%;"></select>');

	//Dependiendo de como se quiere mostrar el selector de test

}
//FIN PreraraTablaTestFrecuente()


//----------------------------------------------------------------------------------------
// Funcion PreparaTablaResto()
function PreparaTablaResto()
{
    global $add_peticion;
  	global $mensajes;
  	global $lblTest;
  	global $listaTest;
  	global $restoTest;
  
  	$cols=GetConfig('add_peticion_col');
	$use_largo=GetConfig('add_peticion_nom_largo');
	$lst_largo=GetConfig('add_peticion_nom_largo_list');

	$seccion_id=CCGetParam("seccion_id","");
	if ($seccion_id<1) $seccion_id="";
	$test_peticion=CCGetParam("test_peticion","");

	$cond_orden=($use_largo=='V') ? "nom_test" : "cod_test";

  	$sSQL="SELECT 
		  test.test_id,
		  test.secciones_id,
		  test.cod_test,
		  test.nom_test,
		  test.acceso_rapido,
		  test.orden_peticion,
		  test.aislado,
		  test.compuesto,
		  secciones.seccion_id,
		  secciones.nom_seccion,
		  secciones.orden
		FROM
		  test
		  LEFT OUTER JOIN secciones ON (test.secciones_id = secciones.seccion_id)
		WHERE test.aislado = 'V' AND test.acceso_rapido <> 'V'
		ORDER BY
		  secciones.orden,
		  secciones.nom_seccion,
		  test.orden_peticion,
		  test.$cond_orden ";
	
  	$db2 = new clsDBDatos();
  	$db2->query($sSQL);
  	$peticiones2 = array();
  
  	while ($db2->next_record())
  	{
  		$p2 = array();
  		$p2["test_id"] = $db2->f("test_id");
  		$p2["secciones_id"] = $db2->f("secciones_id");
  		$p2["cod_test"] = $db2->f("cod_test");
  		$p2["nom_test"] = $db2->f("nom_test");
  		$p2["acceso_rapido"] = $db2->f("acceso_rapido");
  		$p2["orden_peticion"] = $db2->f("orden_peticion");
  		$p2["aislado"] = $db2->f("aislado");
  		$p2["seccion_id"] = $db2->f("seccion_id");
  		$p2["nom_seccion"] = $db2->f("nom_seccion");
  
  		$peticiones2[] = $p2;
  	}
  	unset($db2);
  
  	$evento="onclick=\"crealista()\"";
  	$row=1;
  	$clase="InLineDataTD";
  	$contenidoHTML="";
  	while (list ($clave, $val) = each ($peticiones2)) {

  		$col++;
  		if ($col>$cols) {
  			$col=1;
  			$row++;		
  			if ($clase=="InLineAltDataTD") {
  				$clase="InLineDataTD";
  			} else {
  				$clase="InLineAltDataTD";
  			}
  		}
		$nom_pet= ($use_largo=='SI') ? $val["nom_test"] : $val["cod_test"];
		$lst_pet= ($lst_largo=='SI') ? $val["nom_test"] : $val["cod_test"];

		$nom_pet= ($val["compuesto"]=='V') ? "<b>$nom_pet</b>" : $nom_pet;
		$lst_pet= ($val["compuesto"]=='V') ? "*-$lst_pet" : $lst_pet;


		// Add para recuperar los grabados/seleccionados
		if ($test_peticion[$val["test_id"]]!=""){
				//Se recupera un test antes seleccionado
				$nom_seccion=$val["nom_seccion"];
				if ($nom_seccion!=$nom_seccion_old){
					//Nueva seccion encotrada
					$contenidoHTML.="<tr class=\"InLineColumnTD\"> <td colspan=\"$cols\">$nom_seccion</td></tr>";
					$nom_seccion_old=$nom_seccion;
					$col=1;
				}

		  		if ($col==1) {
		  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
		} else {
			//Si no venían las peticiones de test
			if ($seccion_id!="") {
				//se solicita filtrar una seccion
				if ($val['seccion_id']==$seccion_id){
					$nom_seccion=$val["nom_seccion"];
					if ($nom_seccion!=$nom_seccion_old){
						//Nueva seccion encotrada
						$contenidoHTML.="<tr class=\"InLineColumnTD\"> <td colspan=\"$cols\">$nom_seccion</td></tr>";
						$nom_seccion_old=$nom_seccion;
						$col=1;
					}

			  		if ($col==1) {
			  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
			  		} else if ($col==$cols) {
			  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
			  		} else 
			  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
				}
			} else {
				//Todas las secciones
				$nom_seccion=$val["nom_seccion"];
				if ($nom_seccion!=$nom_seccion_old){
					//Nueva seccion encotrada
					$contenidoHTML.="<tr class=\"InLineColumnTD\"> <td colspan=\"$cols\">$nom_seccion</td></tr>";
					$nom_seccion_old=$nom_seccion;
					$col=1;
				}

		  		if ($col==1) {
		  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["test_id"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
			}
		}
  	}

  	$usadiv=GetConfig("add_peticion_showalltest");
	$sentencia="<table width=100%>$contenidoHTML</table>";
	if ($usadiv=='NO')
		$sentencia="<div id=\"otrostest\" class=\"InLineDataTD\" style=\"display:none;\"> $sentencia </div";
	
  	$restoTest->SetValue($sentencia);
}

// Fin PreparaTablaResto()


// ----------------------------------------------------------------------------------
// Funcion CargaCampos()
function CargaCampos()
{
  	global $fecha;
	global $hora;
	global $estado_id;
	global $valorOp;
	global $opPrioridad;
	global $op_seccion_id;
	global $opPrevision;
	global $opMedico;


  	$fecha->SetValue(GetFechaServer('local'));
  	$hora->SetValue(GetFechaServer('H:i'));

  	//Coloca en estado predeterminado en el campo estado
  	$estado_id->SetValue(GetEstadoPredet('peticiones'));

	//Llena las previsiones
	CrearListBox($valorOp, GetUserProcedenciaID(), "procedencias", "procedencia_id", "nom_procedencia");

	//Llena las prioridades
	CrearListBox($opPrioridad, "1", "prioridades", "prioridad_id", "nom_prioridad", "activo='V'");

	//Llena las secciones
	CrearListBox($op_seccion_id, "", "secciones RIGHT OUTER JOIN test ON (secciones.seccion_id = test.secciones_id)", "seccion_id", "nom_seccion", "activo='V'","0","Todas las secciones", true);

	//Llena las previsiones
	CrearListBox($opPrevision, "", "previsiones", "prevision_id", "nom_prevision", "activo='V'","","Elija un Valor");

	//Llena los médicos solicitantes
	CrearListBox($opMedico, "", "medicos", "medico_id", "nom_medico", "activo='V'","","Elija un valor");
}
//Fin CargaCampos()


//-------------------------------------------------------------------------------------
// Funcion ValidaDatos()
function ValidaDatos()
{
	global $status_peticion;

	$nom_paciente	=CCGetRequestParam('nom_paciente',ccsPost);
	$paciente_id	=CCGetRequestParam('paciente_id',ccsPost);
	$estado_id		=CCGetRequestParam('estado_id',ccsPost);
	$fecha			=CCGetRequestParam('fecha',ccsPost);
	$hora			=CCGetRequestParam('hora',ccsPost);
	$procedencia_id	=CCGetRequestParam('procedencia_id',ccsPost);
	$prevision_id	=CCGetRequestParam('prevision_id',ccsPost);
	$medico_id		=CCGetRequestParam('medico_id',ccsPost);
	$test_peticion	=CCGetRequestParam('test_peticion',ccsPost);
	$prioridad_id	=CCGetRequestParam('prioridad_id',ccsPost);
	$observaciones	=CCGetRequestParam('observaciones',ccsPost);

	$malo="";

	$malo .= $nom_paciente 	 ? "" : "<br/>Falta Nombre del Paciente";
	$malo .= $paciente_id	 ? "" : "<br/>Falta paciente_id";
	$malo .= $estado_id		 ? "" : "<br/>Falta estado_id";
	$malo .= $fecha			 ? "" : "<br/>Falta fecha";
	$malo .= $hora			 ? "" : "<br/>Falta hora";
	$malo .= $procedencia_id ? "" : "<br/>Falta Seleccionar procedencia";
	$malo .= $prevision_id 	 ? "" : "<br/>Falta Seleccionar la previsión del Paciente";
	$malo .= $medico_id 	 ? "" : "<br/>Falta Seleccionar el médico solicitante";
	$malo .= $test_peticion	 ? "" : "<br/>No se ha pedido ningún test";
	$malo .= $prioridad_id	 ? "" : "<br/>No se ha seleccionado prioridad para el test";

	//Valida el formato del campo fecha
	// debe ingresar en formato dd/mm/yyyy
	if ( ereg( "([0-9]{1,2})[-/. ]([0-9]{1,2})[-/. ]([0-9]{4})", $fecha, $regs) ) {
		if (checkdate($regs[2],$regs[1],$regs[3]))
		{
			$malo.="";
		} else {
			$malo.="<br/>La fecha $fecha ingresada no es válida";
		}
	} else {
	    $malo.="<br/>Formato de fecha no válido ($fecha), use formato dd/mm/aaaa";
	}

	//Valida el formato del campo hora
	// debe ingresar en formato HH:MM
	if ( ereg( "([0-9]{1,2}):([0-5][0-9])", $hora, $regs) ) {
		if ($regs[1]>24) $malo.="<br/>El valor $hora ingresado no es una hora válida";
	} else {
	    $malo.="<br/>Formato de Hora no válido ($hora), use formato HH:MM";
	}

	$status_peticion->SetValue("NUEVA PETICION");

	AddError($malo);

	$ok= ($malo!="") ? false : true; 

	return $ok;
}
// Fin ValidaDatos()

// --------------------------------------------------------------------------------------
// funcion AddError()
function AddError($nuevoerror="")
{
	static $cadenaerror="";
	
	if ($nuevoerror!="") 
	{
		$nuevoerror=str_replace('<br>', "\n", $nuevoerror);
		$nuevoerror=str_replace ('<br/>', "\n", $nuevoerror);
		$nuevoerror=trim($nuevoerror);
		$nuevoerror=nl2br($nuevoerror);

		if($cadenaerror!="")
		{
			$cadenaerror.="<br>$nuevoerror";
		} else {
			$cadenaerror.="$nuevoerror";
		}
	}

	if ($cadenaerror=="") {
		return false;
	} else {
		return $cadenaerror;
	}

}
//Fin AddError()


/// -----------------------------------------------
// Funcion GrabarDatos()
function GrabarDatosNueva()
{
	global $DBDatos;

	$previsión_id="";

	$nom_paciente	=CCGetRequestParam('nom_paciente',ccsPost);
	$paciente_id	=CCGetRequestParam('paciente_id',ccsPost);
	$estado_id		=CCGetRequestParam('estado_id',ccsPost);
	$fecha			=CCGetRequestParam('fecha',ccsPost);
	$hora			=CCGetRequestParam('hora',ccsPost);
	$procedencia_id	=CCGetRequestParam('procedencia_id',ccsPost);
	$prevision_id	=CCGetRequestParam('prevision_id',ccsPost);
	$medico_id		=CCGetRequestParam('medico_id',ccsPost);
	$test_peticion	=CCGetRequestParam('test_peticion',ccsPost);
	$prioridad_id	=CCGetRequestParam('prioridad_id',ccsPost);
	$observaciones	=CCGetRequestParam('observaciones',ccsPost);

	if ( ereg( "([0-9]{1,2})[/-]([0-9]{1,2})[/-]([0-9]{4})", $fecha, $regs ) ) 
	{
		$newfecha="$regs[3]-$regs[2]-$regs[1]";
    	$fecha=  "$newfecha 00:00:00";
	} else {
	    $fecha=date("Y-m-i 00:00:00");
	}

	if ( ereg( "([0-9]{1,2}):([0-9]{2})", $hora, $regs ) ) 
	{
    	$hora= "$newfecha $regs[1]:$regs[2]:00";
	} else {
	    $hora=date("Y-m-i H:i:s");
	}

	//inicializa la variable
	$db = new clsDBDatos();
	$db2= new clsDBDatos();

	$usuario_id=CCGetUserID();

	//construye el SQL
	$sSQL="INSERT INTO peticiones (peticion_id, paciente_id, procedencia_id, estado_id, fecha, hora, prevision_id, medico_id, observaciones, usuario_id) ".
		  "values('', '$paciente_id', '$procedencia_id', '$estado_id', '$fecha', '$hora', '$prevision_id', '$medico_id','$observaciones','$usuario_id')";
	//ejecuta el sql
	//echo "<br/><b>Grabado de Peticion: </b>$sSQL"; 
	$db->query($sSQL);

	//Obtiene el ultimo ID insertado
	$peticion_id=mysql_insert_id();

	$estado_pet_id=GetEstadoPredet('peticiones_detalle');

	if (is_array($test_peticion))
	{
		reset ($test_peticion);
		while (list ($test_id, $val) = each ($test_peticion)) {
			//echo "<br/>     TestID: $test_id ---> COD: $val<br/>";
		
			//$precio=CCGetDBValue($SQL_precio, $DBDatos);
			if ($val!="")
			{
				//Crea SQL para buscar el precio
				$sSQL="SELECT precio FROM precios_test WHERE ".
  					  " test_id = $test_id AND prevision_id = $prevision_id AND procedencia_id = $procedencia_id";

				//ejecuta el sql
				//echo "<br/><b>Buscando el precio: </b>$sSQL"; 
				$db->query($sSQL);
			
				//Obtiene el Valor (si es que existe, sino coloca 0)
				$precio = $db->next_record() ? $db->f(0) : "0";
				//echo "<br/><b>Precio encontrado: </b>$precio"; 

				//pregunta por el tipo de muestra para colocarlos en nro_tubo
				$nro_tubo=GetTipoMuestra($test_id);

				//Crea la consulta para insertar valores
				$sSQL="INSERT INTO peticiones_detalle (detalle_peticion_id, peticion_id, muestra_id, test_id, test_main_id, estado_id, prioridad_id, precio, nro_tubo) ".
					  "values('','$peticion_id', '$peticion_id-$nro_tubo', '$test_id', '$test_id', '$estado_pet_id', '$prioridad_id', '$precio', '$nro_tubo')";
				
				//ejecuta el sql
				$db->query($sSQL);

				//Prepara consulta para buscar por contenido de compuesto
				$sSQL="SELECT `compuesto_detalle`.`comp_test_id`, `compuesto_detalle`.`test_id` AS test_id_comp, `test`.`nom_test` FROM".
  					  " `test` RIGHT OUTER JOIN `compuesto_detalle` ON (`test`.`test_id` = `compuesto_detalle`.`test_id`) WHERE `comp_test_id`=$test_id order by test.orden_informe ";
				
				$db->query($sSQL);
			//	echo "<b>$sSQL<br/></b>";
				while ($db->next_record()){
					$test_id_comp=$db->f("test_id_comp");
					$nro_tubo=GetTipoMuestra($test_id_comp);
					$sSQL2="INSERT INTO peticiones_detalle (detalle_peticion_id, peticion_id, muestra_id, test_id, test_main_id, estado_id, prioridad_id, precio, decompuesto, nro_tubo) ".
						  "values('','$peticion_id', '$peticion_id-$nro_tubo', '$test_id_comp', '$test_id', '$estado_pet_id', '$prioridad_id', '0', 'V', '$nro_tubo')";
					$db2->query($sSQL2);
			//		echo "$sSQL2<br/>";
				}
			}
		}	
	}
	//termina el objeto
	unset($db);
	unset($db2);

	//Actualiza los estados de Pago
	update_estado_pago($peticion_id);


	//Fabrica las etiquetas de Codigo de Barra
	CrearETQ($peticion_id);

	//devuelve el ulimo id insertado
	return $peticion_id;

	
}
// Fin GrabarDatos()


// ------------------------------------------------
// Funcion ReescribirDatos();

function ReescribirDatos()
{
	global $nom_paciente;
	global $paciente_id;
	global $estado_id;
	global $fecha;
	global $hora;
	global $valorOp;
	global $opPrioridad;
	global $test_peticion;
	global $observaciones;
	global $op_seccion_id;
	global $opPrevision;
	global $opMedico;
	
	$nom_paciente->SetValue(CCGetRequestParam('nom_paciente',ccsPost));
	$paciente_id->SetValue(CCGetRequestParam('paciente_id',ccsPost));
	$estado_id->SetValue(CCGetRequestParam('estado_id',ccsPost));
	$fecha->SetValue(CCGetRequestParam('fecha',ccsPost));
	$hora->SetValue(CCGetRequestParam('hora',ccsPost));
	$observaciones->SetValue(CCGetRequestParam('observaciones',ccsPost));

	//CrearListBox(&$obj_label, $sel_id="", $tabla, $campo_id, $campo_txt, $condicion="", $def_id="", $def_txt="Elija un valor")
	$procedencia_id=CCGetRequestParam('procedencia_id',ccsPost);
	CrearListBox($valorOp, $procedencia_id, 'procedencias', 'procedencia_id', 'nom_procedencia');

	$prioridad_id=CCGetRequestParam('prioridad_id',ccsPost);
	CrearListBox($opPrioridad, $prioridad_id, 'prioridades', 'prioridad_id', 'nom_prioridad', "activo='V'");

	$seccion_id=CCGetParam('seccion_id','');
	//Llena las secciones
	CrearListBox($op_seccion_id, $seccion_id, "secciones", "seccion_id", "nom_seccion", "activo='V'","0","Todas las secciones");

	$prevision_id=CCGetRequestParam('prevision_id',ccsPost);
	CrearListBox($opPrevision, $prevision_id, 'previsiones', 'prevision_id', 'nom_prevision', "activo='V'");

	$medico_id=CCGetRequestParam('medico_id',ccsPost);
	CrearListBox($opMedico, $medico_id, 'medicos', 'medico_id', 'nom_medico', "activo='V'");

	//echo "<pre>".print_r($_POST) ."</pre>";

}
// Fin Reescribir Datos

?>
