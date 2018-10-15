<?php
//BindEvents Method @1-6795D5D4
function BindEvents()
{
    global $NewRecord1;
    global $CCSEvents;
    $NewRecord1->Button_Insert->CCSEvents["OnClick"] = "NewRecord1_Button_Insert_OnClick";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//NewRecord1_Button_Insert_OnClick @5-848B3021
function NewRecord1_Button_Insert_OnClick(& $sender)
{
    $NewRecord1_Button_Insert_OnClick = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_Button_Insert_OnClick



//DEL      global $DBDatos;
//DEL      global $nom_prevision;
//DEL      $result = CCDLookUp("nom_prevision", "previsiones", "prevision_id=$prevision_id", $DBDatos);
//DEL      $result = strval($result);
//DEL      $nom_prevision = $result;


//Custom Code @11-FF3FD3DA
// -------------------------
    global $NewRecord1;
    global $DBDatos;
    // Write your own code here.

	$prevision_id=$NewRecord1->prevision_id->GetValue();
	$procedencia_id=$NewRecord1->procedencia_id->GetValue();
	$archivo=$NewRecord1->archivo->GetValue();
	$creartest=$NewRecord1->creartest->GetValue();
	$eliminar=$NewRecord1->eliminarlistas->GetValue();

    $result = CCDLookUp("nom_prevision", "previsiones", "prevision_id=$prevision_id", $DBDatos);
    $result = strval($result);
    $nom_prevision = $result;

	if ($procedencia_id==(-1)) {
		$nom_procedencia="Todas las Procedencias";
	} else {
	    $result = CCDLookUp("nom_procedencia", "procedencias", "procedencia_id=$procedencia_id", $DBDatos);
	    $result = strval($result);
	    $nom_procedencia = $result;
	}


	$rev='<html>
<head>
<title>importar_precios</title><meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="Themes/InLine/Style.css">
</head>
<body class="InLinePageBODY">
';
	$rev.='<table class=\"InLineFormTABLE\"  cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">'.
		  "<tr class=\"InLineFormHeaderFont\">".
		  "<td colspan=\"3\">Importar Precios desde Archivo</td></tr>".
		  "<tr  class=\"InLineDataTD\">\n".
		  "<td> Procedencia: $procedencia_id - $nom_procedencia</td>".
		  "<td>Previsión: $prevision_id - $nom_prevision<br/></td>".
		  "<td>Archivo: $archivo </td>".
		  "</tr></table>\n ";

	echo $rev ."<br/>";


	$db= new clsDBDatos();
	$db2=new clsDBDatos();
	$db3=new clsDBDatos();

	//Eliminar primero los precios
	if ($eliminar==1) {
		$sql="DELETE FROM precios_test";
	} else {
		if ($procedencia_id==(-1)) {
			$sql="DELETE FROM precios_test WHERE prevision_id=$prevision_id";
		} else {
			$sql="DELETE FROM precios_test WHERE prevision_id=$prevision_id AND procedencia_id=$procedencia_id";
		}
	}
	$db->query($sql);

	print("<table class=\"InLineFormTABLE\"  cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">\n".
		  "<tr class=\"InLineFormHeaderFont\">".
		  "<td>Eliminando.... </td>".
		  "</tr><tr class=\"InLineDataTD\">\n".
		  "<td>Se han eliminado: ". $db->affected_rows() . " registros</td>".
		  "</tr></table>");
	
	echo "<br/>Leyendo Archivo....<br/><br/>";

	//Carga el archivo en un array
	$arrfile=file("./TEMP/$archivo");

	echo "Ok....<br/><br/><b>ESPERE POR FAVOR, IMPORTANDO PRECIOS....</b><br/><br/>";
	//Itera atraves del contenido del archivo
	print("<table class=\"InLineFormTABLE\"  cellspacing=\"0\" cellpadding=\"3\" width=\"100%\">\n".
		  "<tr class=\"InLineFormHeaderFont\">".
		  "<td>Info</td>\n".
		  "<td>Codigo</td>\n".
		  "<td>Test  </td>\n".
		  "<td>Valor </td>\n".
		  "</tr>");

	define("CODIGO",0);
	define("GLOSA",1);
	define("PRECIO",2);

	$qty=0;
	$nuevotest=0;

	while (list($clave, $valor) = each ($arrfile)){
		//print(" <tr><td colspan=\"4\" bgcolor=red>Leyendo Linea: $valor</td><tr>\n");
		$linea=split(chr(9),$valor);
		//solo funciona si viene un precio >0
		if (intval($linea[PRECIO])>0){
			$codigo=$linea[CODIGO];
			$glosa=$linea[GLOSA];
			$precio=$linea[PRECIO];

			print("<tr class=\"InLineDataTD\">\n".
				  "<td>Leído</td>\n".
				  "<td>$codigo</td>\n".
				  "<td>$glosa</td>\n".
				  "<td>$precio</td>\n".
				  "</tr>");
			//Consulta si hay test con el código de fonasa		
			$sql="SELECT * FROM test WHERE codigo_fonasa='$codigo'";
			$db->query($sql);
			$hay=false;
			//si hay consigue los test
			if ($db->next_record()){
				$hay=true;
				$test_id=$db->f("test_id");
				$cod_test=$db->f("cod_test");

			//	echo "<pre>". print_r($db,true). "</pre>";

				//Si se seleccionaron todos las procedencias
				if ($procedencia_id==(-1)) {
					$sql="SELECT * FROM procedencias";
					$db3->query($sql);
					while ($db3->next_record()){
						$t_nom_procedencia=$db3->f("nom_procedencia");
						$t_procedencia_id=$db3->f("procedencia_id");

						$qty++;

						$sql="INSERT INTO precios_test (`procedencia_id`, `test_id`, `prevision_id`, `precio`) ".
							 " VALUES ('$t_procedencia_id','$test_id','$prevision_id','$precio')";
	
						$db2->query($sql);

						print("<tr bgcolor=green>\n".
							  "<td>Creando Precio</td>\n".
							  "<td colspan=\"3\">Se creó el precio para el Test: $test_id - $cod_test, Procedencia: $t_nom_procedencia </td>\n".
							  "</tr>");
						
					}
				} else {
					//Solo una procedencia en particluar
					$qty++;

					$sql="INSERT INTO precios_test (`procedencia_id`, `test_id`, `prevision_id`, `precio`) ".
						 " VALUES ('$procedencia_id','$test_id','$prevision_id','$precio')";
	
					$db2->query($sql);

					print("<tr bgcolor=green>\n".
						  "<td>Creando Precio</td>\n".
						  "<td colspan=\"3\">Se creó el precio ara el Test: $cod_test y la procedencia $nom_procedencia</td>\n".
						  "</tr>");
				}

			} 

			//Si el Test no existía
			if ($hay==false){
				//Si se pidió crearlo
				if ($creartest=='V'){
					$sql="INSERT INTO test (`codigo_fonasa`, `nom_test`) VALUES ('$codigo','$glosa')";
					$db->query($sql);
					
					$test_id=mysql_insert_id();
					$nuevotest++;

					//Si se seleccionaron todos las procedencias
					if ($procedencia_id==(-1)) {
						$sql="SELECT * FROM procedencias";
						$db3->query($sql);
						while ($db3->next_record()){
							$t_nom_procedencia=$db3->f("nom_procedencia");
							$t_procedencia_id=$db3->f("procedencia_id");

							$qty++;

							$sql="INSERT INTO precios_test (`procedencia_id`, `test_id`, `prevision_id`, `precio`) ".
								 " VALUES ('$t_procedencia_id','$test_id','$prevision_id','$precio')";
	
							$db2->query($sql);

							print("<tr bgcolor=green>\n".
								  "<td>Creando Precio</td>\n".
								  "<td colspan=\"3\">Se creó el precio para el Test: $test_id - $glosa, Procedencia: $t_nom_procedencia </td>\n".
								  "</tr>");
						
						} 
					} else {
							//Se seleccionó sólo una procedencia

						$sql="INSERT INTO precios_test (`procedencia_id`, `test_id`, `prevision_id`, `precio`) ".
							 " VALUES ('$procedencia_id','$test_id','$prevision_id','$precio')";
	
						$db2->query($sql);
						$qty++;


						print("<tr bgcolor=yellow>\n".
							  "<td>Creando Test</td>\n".
							  "<td colspan=\"3\">Se creó el Test: $glosa </td>\n".
							  "</tr>");

						print("<tr bgcolor=green>\n".
							  "<td>Creando Precio</td>\n".
							  "<td colspan=\"3\">Se creó el precio para el Test: $glosa </td>\n".
							  "</tr>");
					}

				} else {
					//No esta el test pero se eligió no crearlo
					print("<tr bgcolor=yellow>\n".
						  "<td>Omitiendo Test</td>\n".
						  "<td colspan=\"3\">No se encontró el Test: $glosa pero se omitió su creación</td>\n".
						  "</tr>");					
				}

			}

		}
	}

	print("<tr bgcolor=red>\n".
	  "<td>TOTAL</td>\n".
	  "<td colspan=\"3\">Se crearon $qty precios y $nuevotest Nuevos Test.</td>\n".
	  "</tr>");

	print("</table>".
		'<form action="menu_principal.php"><input class="InLineButton" type="submit" value=" OK " name="btnok" id="btnok"></form>'.
		"<script>alert('Se Crearon:  \\n     $qty precios en la tabla precios_test \\n     $nuevotest Nuevos Test \\n Para: \\n     Previsión $prevision_id - $nom_prevision \\n     Procedencia $procedencia_id - $nom_procedencia');getElementByID('btnok').focus();</script>\n".
		"</body></html>\n");

	unset($db);
	unset($db2);
	unset($db3);

	exit;






// -------------------------
//End Custom Code

//Close NewRecord1_Button_Insert_OnClick @5-A9FC55FD
    return $NewRecord1_Button_Insert_OnClick;
}
//End Close NewRecord1_Button_Insert_OnClick

//Page_BeforeOutput @1-2987FB44
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $importar_precios; //Compatibility
//End Page_BeforeOutput

//Custom Code @18-2A29BDB7
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
