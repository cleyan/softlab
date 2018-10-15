<?php
//BindEvents Method @1-EEEB7A2A
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_BeforeShow @1-C7403A70
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $edit_peticion; //Compatibility
//End Page_BeforeShow

//Custom Code @3-A82F42E8
// -------------------------
    global $add_peticion;

	//PreparaTablaTestFrecuente();
	//PreparaTablaResto();

    // Write your own code here.
// -------------------------
//End Custom Code

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_AfterInitialize @1-2B289D16
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $edit_peticion; //Compatibility
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

	//Se presionó el botón grabar
	if ($grabar!=""){
		//Agregar nueva petición
		if(ValidaDatos())
		{
			//Grabar los nuevos registros en DB
			$peticion_id=GrabarDatosEdit();
			//Después de grabar manda si continuar ve el detalle de la grabación
			if($accion=="continuar") {
				$Redirect="det_Peticion.php?peticion_id=$peticion_id";
			} else {
				$Redirect="add_peticion.php"; //CargaCampos();
			}

		} else {
			// Falló la validación al grabar
			// Reescribir los datos enviados
			ReescribirDatos();
		}
	} else if ($cancelar!=""){
			$Redirect="ver_Peticiones.php";
	} else if ($peticion_id==""){
		$Redirect="ver_Peticiones.php";
	} else {		
		$seccion_id=CCGetParam("seccion_id","");
		//La hoja viene nueva
		if ($seccion_id==""){
			CargaCampos();
		} else {
			ReescribirDatos();
		}
		$status_peticion->SetValue("EDITANDO PETICION: $peticion_id");
	}

	//Muestra el contenido de los errores si es que está
	$mensajes->SetValue(AddError());

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-AEBD1F76
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $edit_peticion; //Compatibility
//End Page_BeforeOutput

//Custom Code @39-2A29BDB7
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
function PreparaTablaTestFrecuente($seleccion="")
{
    global $add_peticion;
  	global $mensajes;
  	global $lblTest;
  	global $listaTest;
  	global $restoTest;

	if ($seleccion=="") $seleccion=array();

  	$cols=GetConfig('add_peticion_col');
	$use_largo=GetConfig('add_peticion_nom_largo');
	$lst_largo=GetConfig('add_peticion_nom_largo_list');
	$min_list=intval(GetConfig('add_peticion_minimo_item_list'));

	$seccion_id=CCGetParam("seccion_id","");
	$test_peticion=$seleccion;

  	///Esta seleccion es solo de los que van en el menu principal
  	$sSQL= "SELECT test_id, ".
  					"secciones_id, ".
  					"test.equipo_id AS test_equipo_id, ".
  					"cod_test, ".
  					"nom_test, ".
  					"acceso_rapido, ".
  					"orden_peticion, ".
  					"aislado, ".
					"compuesto, ".
  					"seccion_id, ".
  					" nom_seccion, ".
  					"equipos.equipo_id AS equipos_equipo_id, ".
  					"nom_equipo ".
  		   " FROM (test LEFT JOIN secciones ON test.secciones_id = secciones.seccion_id) LEFT JOIN equipos ON".
  		   " test.equipo_id = equipos.equipo_id WHERE test.aislado = 'V' ".
  		   " ORDER BY seccion_id, orden_peticion, cod_test";
  
  			//AND test.acceso_rapido = 'V'

  	$db = new clsDBDatos();
  	$db->query($sSQL);
  	$peticiones = array();
  
  	while ($db->next_record())
  	{
  		$p = array();
  		$p["test_id"] = $db->f("test_id");
  		$p["secciones_id"] = $db->f("secciones_id");
  		$p["test_equipo_id"] = $db->f("test_equipo_id");
  		$p["cod_test"] = $db->f("cod_test");
  		$p["nom_test"] = $db->f("nom_test");
  		$p["acceso_rapido"] = $db->f("acceso_rapido");
  		$p["orden_peticion"] = $db->f("orden_peticion");
  		$p["aislado"] = $db->f("aislado");
  		$p["compuesto"] = $db->f("compuesto");
  		$p["seccion_id"] = $db->f("seccion_id");
  		$p["nom_seccion"] = $db->f("nom_seccion");
  		$p["equipos_equipo_id"] = $db->f("equipos_equipo_id");
  		$p["nom_equipo"] = $db->f("nom_equipo");
  
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
		$lst_pet= ($val["compuesto"]=='V') ? "*-$lst_pet" : $lst_pet;

		// Add para recuperar los grabados/seleccionados
		if ($test_peticion[$val["test_id"]]!="" and $test_peticion[$val["test_id"]] != "COMP"){
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
				$fondo=red;
		  		if ($col==1) {
		  			$contenidoHTML.='<tr> <td bgcolor="$fondo" nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td bgcolor="$fondo" nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td bgcolor="$fondo" nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
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
			  			$contenidoHTML.='<tr> <td class="'.$clase.'" nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
			  		} else if ($col==$cols) {
			  			$contenidoHTML.='<td  class="'.$clase.'" nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
			  		} else 
			  			$contenidoHTML.='<td  class="'.$clase.'" nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';

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
		  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';

			}
		}
  	}
  
  
  	$lblTest->SetValue("<table width=100%>$contenidoHTML</table>");
  	if($row<$min_list) $row=$min_list;
  	$listaTest->SetValue('<select name="lista_test" size="'.$row.'" class="InLineInput" id="lista_test" style="WIDTH: 100%"></select>');

}
//FIN PreraraTablaTestFrecuente()


//----------------------------------------------------------------------------------------
// Funcion PreparaTablaResto()
function PreparaTablaResto($seleccion="")
{
    global $add_peticion;
  	global $mensajes;
  	global $lblTest;
  	global $listaTest;
  	global $restoTest;
  
	if ($seleccion=="") $seleccion=array();

  	$cols=GetConfig('add_peticion_col');
	$use_largo=GetConfig('add_peticion_nom_largo');
	$lst_largo=GetConfig('add_peticion_nom_largo_list');

	$seccion_id=CCGetParam("seccion_id","");
	$test_peticion=$seleccion;

  	$sSQL= "SELECT test_id, ".
  					"secciones_id, ".
  					"test.equipo_id AS test_equipo_id, ".
  					"cod_test, ".
  					"nom_test, ".
  					"acceso_rapido, ".
  					"orden_peticion, ".
  					"aislado, ".
  					"seccion_id, ".
  					" nom_seccion, ".
  					"equipos.equipo_id AS equipos_equipo_id, ".
  					"nom_equipo ".
  		   " FROM (test LEFT JOIN secciones ON test.secciones_id = secciones.seccion_id) LEFT JOIN equipos ON".
  		   " test.equipo_id = equipos.equipo_id WHERE test.aislado = 'V' AND test.acceso_rapido <> 'V'".
  		   " ORDER BY seccion_id, orden_peticion, cod_test";
  
  	$db2 = new clsDBDatos();
  	$db2->query($sSQL);
  	$peticiones2 = array();
  
  	while ($db2->next_record())
  	{
  		$p2 = array();
  		$p2["test_id"] = $db2->f("test_id");
  		$p2["secciones_id"] = $db2->f("secciones_id");
  		$p2["test_equipo_id"] = $db2->f("test_equipo_id");
  		$p2["cod_test"] = $db2->f("cod_test");
  		$p2["nom_test"] = $db2->f("nom_test");
  		$p2["acceso_rapido"] = $db2->f("acceso_rapido");
  		$p2["orden_peticion"] = $db2->f("orden_peticion");
  		$p2["aislado"] = $db2->f("aislado");
  		$p2["seccion_id"] = $db2->f("seccion_id");
  		$p2["nom_seccion"] = $db2->f("nom_seccion");
  		$p2["equipos_equipo_id"] = $db2->f("equipos_equipo_id");
  		$p2["nom_equipo"] = $db2->f("nom_equipo");
  
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
		if ($test_peticion[$val["test_id"]]!="" and $test_peticion[$val["test_id"]] != "COMP"){
				//Se recupera un test antes seleccionado
				$nom_seccion=$val["nom_seccion"];
				if ($nom_seccion!=$nom_seccion_old){
					//Nueva seccion encotrada
					$contenidoHTML.="<tr class=\"InLineColumnTD\"> <td colspan=\"$cols\">$nom_seccion</td></tr>";
					$nom_seccion_old=$nom_seccion;
					$col=1;
				}

		  		if ($col==1) {
		  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox" checked>'.$nom_pet.'</td>';
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
			  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
			  		} else if ($col==$cols) {
			  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
			  		} else 
			  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';

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
		  			$contenidoHTML.='<tr class="'.$clase.'"> <td nowrap><input  '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';
		  		} else if ($col==$cols) {
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td></tr>';
		  		} else
		  			$contenidoHTML.='<td nowrap><input '.$evento.' name="test_peticion['.$val["test_id"].']" id="'.$val["cod_test"].'" value="'.$lst_pet.'" type="checkbox">'.$nom_pet.'</td>';

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
	global $nom_paciente;
	global $paciente_id;
	global $observaciones;
	global $peticion_id;
	global $opPrevision;
	global $opMedico;


	$varpeticion_id=CCGetParam("peticion_id","");
	$seccion_id=CCGetParam("seccion_id","");

	$peticion_id->SetValue($varpeticion_id);
	

		$sSQL="SELECT 
			  peticiones.peticion_id,
			  peticiones.paciente_id,
			  peticiones.procedencia_id,
			  peticiones.prevision_id,
			  peticiones.medico_id,
			  peticiones.estado_id,
			  peticiones.fecha,
			  peticiones.observaciones,
			  peticiones.hora,
			  pacientes.rut,
			  pacientes.ficha,
			  pacientes.prevision_id,
			  previsiones.nom_prevision,
			  pacientes.nombres,
			  pacientes.apellidos,
			  estados.nom_estado,
			  peticiones_detalle.test_id,
			  peticiones_detalle.prioridad_id,
			  peticiones_detalle.precio,
			  peticiones_detalle.decompuesto
			FROM
			  peticiones_detalle
			  RIGHT OUTER JOIN peticiones ON (peticiones_detalle.peticion_id = peticiones.peticion_id)
			  LEFT OUTER JOIN pacientes ON (peticiones.paciente_id = pacientes.paciente_id)
			  LEFT OUTER JOIN previsiones ON (pacientes.prevision_id = previsiones.prevision_id)
			  LEFT OUTER JOIN procedencias ON (peticiones.procedencia_id = procedencias.procedencia_id)
			  LEFT OUTER JOIN estados ON (peticiones.estado_id = estados.estado_id)
			  WHERE peticiones.peticion_id=$varpeticion_id";


	$db = new clsDBDatos();
  	$db->query($sSQL);
  	$peticiones = array();
  
  	while ($db->next_record())
  	{
  		$p = array();

		$p["peticion_id"] = $db->f("peticion_id");
		$p["paciente_id"] = $db->f("paciente_id");
		$p["procedencia_id"] = $db->f("procedencia_id");
		$p["prevision_id"] = $db->f("prevision_id");
		$p["medico_id"] = $db->f("medico_id");
		$p["estado_id"] = $db->f("estado_id");
		$p["fecha"] = $db->f("fecha");
		$p["observaciones"] = $db->f("observaciones");
		$p["hora"] = $db->f("hora");
		$p["rut"] = $db->f("rut");
		$p["ficha"] = $db->f("ficha");
		$p["prevision_id"] = $db->f("prevision_id");
		$p["nom_prevision"] = $db->f("nom_prevision");
		$p["nombres"] = $db->f("nombres");
		$p["apellidos"] = $db->f("apellidos");
		$p["nom_estado"] = $db->f("nom_estado");
		$p["test_id"] = $db->f("test_id");
		$p["prioridad_id"] = $db->f("prioridad_id");
		$p["precio"] = $db->f("precio");
		$p["decompuesto"] = $db->f("decompuesto");
		
		$peticiones[]= $p;
	}

	while (list ($clave, $val) = each ($peticiones)) {
		//Recupera campos comunes		
		$paciente_id->SetValue($val["paciente_id"]);
		$nom_paciente->SetValue($val["nombres"]." ".$val["apellidos"]);
	  	$fecha->SetValue(date("d/m/Y", strtotime($val["fecha"])));
	  	$hora->SetValue(date("H:i", strtotime($val["hora"])));
	  	$estado_id->SetValue($val["estado_id"]);

		//Llena las procedencias
		CrearListBox($valorOp, $val["procedencia_id"], "procedencias", "procedencia_id", "nom_procedencia");
		//Llena las prioridades
		CrearListBox($opPrioridad, $val["prioridad_id"], "prioridades", "prioridad_id", "nom_prioridad", "activo='V'");
		//Llena las secciones
		CrearListBox($op_seccion_id, $seccion_id, "secciones", "seccion_id", "nom_seccion", "activo='V'","","Todas las secciones");

		//Llena las previsiones
		CrearListBox($opPrevision, $val["prevision_id"], "previsiones", "prevision_id", "nom_prevision");
		//Llena los medicos
		CrearListBox($opMedico, $val["medico_id"], "medicos", "medico_id", "nom_medico");


		$observaciones->SetValue($val["observaciones"]);

		//Recupera si es de un compuesto
		$decompuesto=($val["decompuesto"]=='V')? "COMP": "SOLO";

		//crea el array de los test seleccionados
		$test_peticion[$val["test_id"]]=$decompuesto;
	}

	unset($db);

	PreparaTablaTestFrecuente($test_peticion);
	//PreparaTablaResto($test_peticion);

}
//Fin CargaCampos()


//-------------------------------------------------------------------------------------
// Funcion ValidaDatos()
function ValidaDatos()
{
	
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
	$peticion_id 	=CCGetParam('peticion_id',"");

	$malo="";

	$malo .= $nom_paciente 	 ? "" : "<br/>Falta Nombre del Paciente";
	$malo .= $paciente_id	 ? "" : "<br/>Falta paciente_id";
	$malo .= $estado_id		 ? "" : "<br/>Falta estado_id";
	$malo .= $fecha			 ? "" : "<br/>Falta fecha";
	$malo .= $hora			 ? "" : "<br/>Falta hora";
	$malo .= $procedencia_id ? "" : "<br/>Falta Seleccionar procedencia";
	$malo .= $prevision_id   ? "" : "<br/>Falta Seleccionar la previsión del paciente";
	$malo .= $medico_id 	 ? "" : "<br/>Falta Seleccionar el médico solicitante";
	$malo .= $test_peticion	 ? "" : "<br/>No se ha pedido ningún test";
	$malo .= $prioridad_id	 ? "" : "<br/>No se ha seleccionado prioridad para el test";
	$malo .= $peticion_id	 ? "" : "<br/>Se perdió el número de Petición no puede seguir editando";

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
		if($cadenaerror!="")
		{
			$cadenaerror.="<br/>$nuevoerror";
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
function GrabarDatosEdit()
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
	$peticion_id	=CCGetParam('peticion_id',"");
	$conservar_id	=CCGetParam('conservar_id',"");

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

	//construye el SQL
	$sSQL="UPDATE peticiones SET 
			paciente_id='$paciente_id', 
			procedencia_id='$procedencia_id', 
			prevision_id='$prevision_id',
			medico_id='$medico_id',
			estado_id='$estado_id', 
			fecha='$fecha', 
			hora='$hora', 
			observaciones='$observaciones' where peticion_id=$peticion_id";

	//ejecuta el sql
	//echo "<br/><b>Grabado de Peticion: </b>$sSQL"; 
	$db->query($sSQL);

	//Obtiene el ultimo ID insertado
	//$peticion_id=mysql_insert_id();

	$estado_pet_id=GetEstadoPredet('peticiones_detalle');

	//elimina las peticiones asociadas pero antes guarda un array con los estados de cada test
	$sSQL="SELECT * FROM peticiones_detalle where peticion_id=$peticion_id";
	$db->query($sSQL);
	while($db->next_record()){
		$estados[$db->f("test_id")]=$db->f("estado_id");
		$det_mid[$db->f("test_id")]=$db->f("muestra_id");
	}
	//Ahora si elimna
	$sSQL="DELETE FROM peticiones_detalle where peticion_id=$peticion_id";
	$db->query($sSQL);
	
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

//				if ($conservar_id=='SI') $muestra_id=($det_mid[$test_id]!="") ? $det_mid[$test_id]: $muestra_id;
				$estado_id=($estados[$test_id]!="") ? $estados[$test_id] : $estado_id;

				//pregunta por el tipo de muestra para colocarlos en nro_tubo
				$nro_tubo=GetTipoMuestra($test_id);
				
				//Crea la consulta para insertar valores
				$sSQL="INSERT INTO peticiones_detalle (detalle_peticion_id, peticion_id, muestra_id, test_id, test_main_id, estado_id, prioridad_id, precio, nro_tubo) ".
					  "values('','$peticion_id', '$peticion_id-$nro_tubo', '$test_id', '$test_id', '$estado_pet_id', '$prioridad_id', '$precio', '$nro_tubo')";

				//ejecuta el sql
				$db->query($sSQL);

				//Prepara consulta para buscar por contenido de compuesto
				$sSQL="SELECT `compuesto_detalle`.`comp_test_id`, `compuesto_detalle`.`test_id` AS test_id_comp, `test`.`nom_test` FROM".
  					  " `test` RIGHT OUTER JOIN `compuesto_detalle` ON (`test`.`test_id` = `compuesto_detalle`.`test_id`) WHERE `comp_test_id`=$test_id order by test.orden_informe";
				
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
	global $peticion_id;
	global $opPrevision;
	global $opMedico;
	
	$nom_paciente->SetValue(CCGetRequestParam('nom_paciente',ccsPost));
	$paciente_id->SetValue(CCGetRequestParam('paciente_id',ccsPost));
	$estado_id->SetValue(CCGetRequestParam('estado_id',ccsPost));
	$fecha->SetValue(CCGetRequestParam('fecha',ccsPost));
	$hora->SetValue(CCGetRequestParam('hora',ccsPost));
	$observaciones->SetValue(CCGetRequestParam('observaciones',ccsPost));
	$peticion_id->SetValue(CCGetParam("peticion_id",""));
	$test_peticion=CCGetParam("test_peticion","");

	//CrearListBox(&$obj_label, $sel_id="", $tabla, $campo_id, $campo_txt, $condicion="", $def_id="", $def_txt="Elija un valor")
	$procedencia_id=CCGetRequestParam('procedencia_id',ccsPost);
	CrearListBox($valorOp, $procedencia_id, 'procedencias', 'procedencia_id', 'nom_procedencia');

	$prioridad_id=CCGetRequestParam('prioridad_id',ccsPost);
	CrearListBox($opPrioridad, $prioridad_id, 'prioridades', 'prioridad_id', 'nom_prioridad', "activo='V'");

	//Llena las secciones
	$seccion_id=CCGetParam('seccion_id','');
	CrearListBox($op_seccion_id, $seccion_id, "secciones", "seccion_id", "nom_seccion", "activo='V'","","Todas las secciones");

	//Llena las previsiones
	$prevision_id=CCGetRequestParam('prevision_id',ccsPost);
	CrearListBox($opPrevision, $prevision_id, 'previsiones', 'prevision_id', 'nom_prevision');

	//Llena los medicos
	$medico_id=CCGetRequestParam('medico_id',ccsPost);
	CrearListBox($opMedico, $medico_id, 'medicos', 'medico_id', 'nom_medico');

	PreparaTablaTestFrecuente($test_peticion);
	PreparaTablaResto($test_peticion);

}
// Fin Reescribir Datos



?>
