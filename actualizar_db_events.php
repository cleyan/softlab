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

//Custom Code @8-FF3FD3DA
// -------------------------
    global $NewRecord1;
    // Write your own code here.

	$importar=$NewRecord1->importar->GetValue();
	$archivo=$NewRecord1->archivo->GetValue();

	$db= new clsDBDatos();

	echo ("[[[[[INICIO]]]]]<br/>");
	if ($archivo !="" AND $importar==1){
		$arrfile=file("./TEMP/$archivo");
		while (list($clave, $valor) = each ($arrfile)){
			$lineaSQL=$valor;
			echo "<small>SQL: $lineaSQL</small><br/>";
			if (strlen($lineaSQL)<10) {
				echo "<small><b>---> Instrucción demasiado Corta</b></small><br/>";
			} elseif (strpos($lineaSQL, ";")===false) {
				echo "<small><b>---> Instrucción No termina con ;</b></small><br/>";
			} else {
				$ok=$db->query($lineaSQL);
				$ok=($ok==1) ? "OK" : "Err";
				echo "<small><b>---> $ok</b></small><br/>";
			}				
		}
	}

	die("[[[[[[[FIN]]]]]]]]<br/>");
	unset($db);

// -------------------------
//End Custom Code

//Close NewRecord1_Button_Insert_OnClick @5-A9FC55FD
    return $NewRecord1_Button_Insert_OnClick;
}
//End Close NewRecord1_Button_Insert_OnClick

//Page_BeforeOutput @1-49A434D5
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $actualizar_db; //Compatibility
//End Page_BeforeOutput

//Custom Code @15-2A29BDB7
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
