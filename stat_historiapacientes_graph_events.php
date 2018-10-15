<?php
//BindEvents Method @1-8DDDA944
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//Page_AfterInitialize @1-17851E32
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $stat_historiapacientes_graph; //Compatibility
//End Page_AfterInitialize

//Custom Code @2-84DBE350
// -------------------------
    global $stat_historiapacientes_graph;
	global $xfecha;
	
	$paciente_id=CCGetParam("paciente_id","");
	$test_id=CCGetParam("test_id","");

	$db = new clsDBDatos();
	$sql="select nom_test from test where test_id=$test_id";

	$db->query($sql);

	$nom_test=($db->next_record()) ? $db->f(0) : "N/D" ;

	$db->close();
	unset($db);


	$db2 = new clsDBDatos();

	$sql2="select concat(nombres, ' ' , apellidos) as nom_pac from pacientes where paciente_id=$paciente_id";



	$db2->query($sql2);

	$nom_pac=($db2->next_record()) ? $db2->f(0) : "N/D" ;
	$db2->close();
	unset($db2);


//die("test: $nom_test - pac: $nom_pac <br/>sql: $sql <br/>sql2:$sql2");


	include ("jpgraph/jpgraph.php");
	include ("jpgraph/jpgraph_line.php");

	//Obtiene los datos

	$db = new clsDBDatos();

	$sql="SELECT paciente_id, resultados.valor, DATE_FORMAT(coalesce(resultados.fecha_modificacion, resultados.fecha_creacion),'%d/%m/%Y') as fecha, cod_test, nom_test, aislado, compuesto, formula 
			FROM (resultados LEFT JOIN peticiones ON
			resultados.peticion_id = peticiones.peticion_id) LEFT JOIN test ON
			resultados.test_id = test.test_id
			WHERE ( test.test_id = $test_id AND peticiones.paciente_id = $paciente_id)";

	$db->query($sql);

	//$tmp_y=array();
	$tmp_y="";
	$tmp_f="";
	while ($db->next_record()) {
		if ($tmp_y=="") {
			$tmp_y=floatval($db->f('valor'));
			$tmp_f=$db->f('fecha');
		} else {
			$tmp_y=$tmp_y . ", " . floatval($db->f('valor'));
			$tmp_f=$tmp_f . ", " . $db->f('fecha');

		}
		$qty++;
		$sum+=floatval($db->f('valor'));

	}

	$media=$sum/$qty;
		
	unset($db);

	if ($tmp_y=="" or $qty<=1) {
		$fp=fopen("images/error_grafico.png",'r');
		fpassthru ($fp);
		exit;
	}

	$ydata=split(",",$tmp_y);
	$ydataex=split(",","x,$tmp_y,x");
	$xfecha=split(",","0,$tmp_f,0");

	$sdev=stat_sd($ydata);

	$sdev1=$media + ($sdev);
	$sdev2=$media - ($sdev);

	$sdev12=$media + ($sdev *2);
	$sdev22=$media - ($sdev *2);

	//echo "eval: \$ydata = array('x',$tmp_y, 'x');";
//	eval("\$ydata = array('x',$tmp_y,'x');");

	$y_media_data=array_fill(0,$qty+2,$media);
	$y_media_sd1 =array_fill(0,$qty+2,$sdev1);
	$y_media_sd2 =array_fill(0,$qty+2,$sdev2);

	$y_media_sd12 =array_fill(0,$qty+2,$sdev12);
	$y_media_sd22 =array_fill(0,$qty+2,$sdev22);

	//die("<pre>" . print_r($ydata,true) . "</pre>");

	//$ydata = array(11,3,8,12,5,1,9,13,5,7);

	// Create the graph. These two calls are always required
	$graph = new Graph(700,300,"auto");    
	$graph->SetScale("textlin");

	// Adjust the margin
	$graph->img->SetMargin(40,20,20,40);
	$graph->SetShadow();

	// Create the linear plot
	$lineplot=new LinePlot($ydataex);
	$lineplot->mark->SetType(MARK_IMG_MBALL,'red');
	$lineplot->value->show();

	//Crear la media
	$linemedia= new LinePlot($y_media_data);
	//Crear las SD
	$line_sd1 = new LinePlot($y_media_sd1);
	$line_sd2 = new LinePlot($y_media_sd2);
	$line_sd12 = new LinePlot($y_media_sd12);
	$line_sd22 = new LinePlot($y_media_sd22);



	// Add the plot to the graph
	$graph->Add($linemedia);
	$graph->Add($line_sd1);
	$graph->Add($line_sd2);
	$graph->Add($line_sd12);
	$graph->Add($line_sd22);
	$graph->Add($lineplot);


	$graph->title->Set("Evolución de $nom_test para $nom_pac");

	$graph->yaxis->title->Set("Valores");
	$graph->yaxis->SetColor("red");
	$graph->yaxis->SetWeight(3);
	//$graph->xaxis->HideLabels();

	$graph->title->SetFont(FF_FONT1,FS_BOLD);
	$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
	$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

	$graph->footer->left->Set("(C) 2004-2009 Leytec.net");
	$graph->footer->right->Set("MEDIA: " . number_format($media,2,".","") . " SD: ". number_format($sdev,2,".",""));



	$graph->xaxis->SetLabelFormatCallback('callfecha');

	$lineplot->SetColor("blue");
	$lineplot->SetWeight(3);

	$linemedia->SetColor("green");
	$linemedia->SetWeight(1);

	$line_sd1->SetColor("orange");
	$line_sd1->SetWeight(1);

	$line_sd2->SetColor("orange");
	$line_sd2->SetWeight(1);

	$line_sd12->SetColor("red");
	$line_sd12->SetWeight(1);

	$line_sd22->SetColor("red");
	$line_sd22->SetWeight(1);



	// Display the graph
	$graph->Stroke();

//die("<pre>" . print_r($graph,true) . "</pre>");

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-C68058B0
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $stat_historiapacientes_graph; //Compatibility
//End Page_BeforeOutput

//Custom Code @3-2A29BDB7
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

function callfecha($label){
	
	global $xfecha;

//Array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss")

	$tmpfecha=$xfecha[$label] ;
	
	if ($tmpfecha != "" && $tmpfecha != 0) {
		return $tmpfecha ;//. '-' .  $tmpfecha;

	} else {

		return '';
	}

}

?>
