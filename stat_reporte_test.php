<?php
	//Include Common Files 
	define("RelativePath", ".");
	define("PathToCurrentPage", "/");
	define("FileName", "stat_reporte_test.php");
	include(RelativePath . "/Common.php");
	include(RelativePath . "/Template.php");
	include(RelativePath . "/Sorter.php");
	include(RelativePath . "/Navigator.php");
	//Fin includes

	$reporte=CCGetParam("reporte","");
	$exportar=CCGetParam("exportar","");
	$mes=intval(CCGetParam("mes",""));
	$anno=intval(CCGetParam("anno",""));
	$procedencia=CCGetParam("procedencia","");
	$subtitulo="PERIODO: $mes/$anno";

	if (($mes < 1 || $anno < 1) && ($reporte!="" || $exportar != "")) {
		echo "<h1>Debe seleccionar mes y año!</h1>";
		exit();
	} else {
		if ($reporte!='') {
			
			$Redirect="../cgi-bin/repwebexe/execute.pdf?reportname=stat_numerotest_4&aliasname=REPORTE&username=lab&password=lab&ParamMES=$mes&ParamANNO=$anno&ParamSUBTITULO=$subtitulo&ParamPROCEDENCIA=$procedencia";

			header("Location: $Redirect");
			exit();

		} elseif ($exportar!="") {

			include(RelativePath . "/stat_reporte_test_inc.php");
			
			$db=new clsDBDatos();
			$sql="SELECT nom_procedencia FROM procedencias WHERE procedencia_id=$procedencia";
			$db->query($sql);
			$nom_procedencia=($db->next_record()) ? $db->f(0) : "N/D";
			unset($db);
			
			$sql="SELECT `peticiones`.peticion_id, `peticiones`.paciente_id, CONCAT(`pacientes`.apellidos, ',  ' , `pacientes`.nombres) as nom_paciente, 
				  `pacientes`.rut, `procedencias`.nom_procedencia, DATE_FORMAT(`peticiones`.fecha,'%d/%m/%Y'),
				  `test`.cod_test, `test`.nom_test, `test`.codigo_fonasa
				FROM
				  `peticiones`
				  LEFT OUTER JOIN `peticiones_detalle` ON (`peticiones`.peticion_id = `peticiones_detalle`.peticion_id)
				  LEFT OUTER JOIN `pacientes` ON (`peticiones`.paciente_id = `pacientes`.paciente_id)
				  INNER JOIN `procedencias` ON (`peticiones`.procedencia_id = `procedencias`.procedencia_id)
				  INNER JOIN `test` ON (`peticiones_detalle`.test_id = `test`.test_id)
				WHERE
				  `peticiones_detalle`.decompuesto = 'F' AND month(`peticiones`.fecha) = $mes AND year(`peticiones`.fecha)=$anno AND `peticiones`.procedencia_id= $procedencia
				ORDER BY
				  `peticiones`.procedencia_id,
				  `peticiones`.fecha,
				  `peticiones`.paciente_id,
				  `peticiones`.peticion_id,
				  `test`.codigo_fonasa";
				  
			$cabeza="Nº Petición|Cód.Paciente|Paciente|R.U.T.|Procedencia|Fecha|Cód.Test|Test|Cód.Fonasa"; 
				 
			$newexport= new Exportar($sql, "Stat_txp_$mes$anno.xls", "Test Realizados para Procedencia: $nom_procedencia", $subtitulo, $cabeza);
			$newexport->Generar(true);

		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>::: Reporte Detallado :::</title>
</head>

<body>
<form name="ejemplo" method="POST" action="<?=$_SERVER['PHP_SELF']?>">
  <p>Para genera el reporte elija el mes y a&ntilde;os a considerar<br />
  y luego haga click en la opción deseada.</p>
  <table width="100%" border="0" cellspacing="3" cellpadding="0">
    <tr>
      <td>Mes</td>
      <td width="100%"><label>
        <select name="mes" accesskey="m" tabindex="1">
          <option value="1">Enero</option>
          <option value="2">Febrero</option>
          <option value="3">Marzo</option>
          <option value="4">Abril</option>
          <option value="5">Mayo</option>
          <option value="6">Junio</option>
          <option value="7">Julio</option>
          <option value="8">Agosto</option>
          <option value="9">Septiembre</option>
          <option value="10">Octubre</option>
          <option value="11">Noviembre</option>
          <option value="12">Diciembre</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>A&ntilde;o</td>
      <td><label>
        <select name="anno" accesskey="a" tabindex="2">
          <option value="2006">2006</option>
          <option value="2007">2007</option>
		  <option value="2008">2008</option>
		  <option value="2009">2009</option>          
		  <option value="2010">2010</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Procedencia</td>
      <td><select name="procedencia" accesskey="p" tabindex="3">
	  <?php
 
			
			$db = new clsDBDatos();
			$sql="SELECT procedencia_id, nom_procedencia from procedencias";
			$db->query($sql);
			
			while ($db->next_record()){
				$procedencia_id  = $db->f("procedencia_id");
				$nom_procedencia = $db->f("nom_procedencia");
				
				echo "<option value=\"$procedencia_id\">$nom_procedencia</option>";
			}
			
			unset($db);
	  
	  ?>
      </select>
      </td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;<input type="submit" name="reporte" value="Generar Reporte">&nbsp;<input type="submit" name="exportar" value="Exportar a Excel"></td>
    </tr>
  </table>
</form>

</body>
</html>
