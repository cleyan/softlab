<?php
//BindEvents Method @1-342BADD2
function BindEvents()
{
    global $informes;
    global $NewRecord1;
    global $CCSEvents;
    $informes->qty_grupo->CCSEvents["BeforeShow"] = "informes_qty_grupo_BeforeShow";
    $NewRecord1->qty_test->CCSEvents["BeforeShow"] = "NewRecord1_qty_test_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//informes_qty_grupo_BeforeShow @44-74EA7BA0
function informes_qty_grupo_BeforeShow(& $sender)
{
    $informes_qty_grupo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $informes; //Compatibility
//End informes_qty_grupo_BeforeShow

//Custom Code @61-F8123F1D
// -------------------------
    global $informes;
    // Write your own code here.


	$informe_id=CCGetParam("informe_id","0");

	$db= new clsDBDatos();
	$sql="SELECT count(*) as qty FROM grupos where informe_id=$informe_id";
	$db->query($sql);

	$qty=($db->next_record()) ? $db->f(0) : "0" ;
	unset($db);

	$informes->qty_grupo->SetValue($qty);

	
// -------------------------
//End Custom Code

//Close informes_qty_grupo_BeforeShow @44-D1B07DFD
    return $informes_qty_grupo_BeforeShow;
}
//End Close informes_qty_grupo_BeforeShow

//NewRecord1_qty_test_BeforeShow @17-727667A8
function NewRecord1_qty_test_BeforeShow(& $sender)
{
    $NewRecord1_qty_test_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $NewRecord1; //Compatibility
//End NewRecord1_qty_test_BeforeShow

//Custom Code @62-FF3FD3DA
// -------------------------
    global $NewRecord1;
    // Write your own code here.

	$informe_id=CCGetParam("informe_id","0");

	$db= new clsDBDatos();
	$sql="SELECT count(*) as qty FROM test WHERE informe_id=$informe_id";
	$db->query($sql);

	$qty=($db->next_record()) ? $db->f(0) : "0" ;
	unset($db);

	$NewRecord1->qty_test->SetValue($qty);

// -------------------------
//End Custom Code

//Close NewRecord1_qty_test_BeforeShow @17-EDF6AE54
    return $NewRecord1_qty_test_BeforeShow;
}
//End Close NewRecord1_qty_test_BeforeShow

//DEL  // -------------------------
//DEL      global $NewRecord1;
//DEL      // Write your own code here.
//DEL  
//DEL  		echo "Registros " . $NewRecord1->qty->GetValue();
//DEL  		echo "<pre>" . print_r($NewRecord1->qty,true) . "</pre>";
//DEL  		echo "<pre>" . print_r($NewRecord1,true) . "</pre>";
//DEL  
//DEL  		$NewRecord1->nuevo_informe_id->Visible=false;
//DEL  
//DEL  // -------------------------

//Page_AfterInitialize @1-177A41CD
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $elim_informe; //Compatibility
//End Page_AfterInitialize

//Custom Code @9-AD957894
// -------------------------
    global $elim_informe;
    // Write your own code here.

	$informe_id=CCGetParam("informe_id","0");
	
	$db=new clsDBDatos();

	$boton_si=CCGetParam("si","");
	$boton_no=CCGetParam("no","");
	$informe_id=CCGetParam("informe_id","0");
	$nuevo_informe_id=CCGetParam("nuevo_informe_id","0");

	if ($boton_no!=""){
		header("Location: def_informe.php");
		exit;
	} elseif ($boton_si!=""){
		$db = new clsDBDatos();

		//Inicia la eliminacion en cascada

		//1) El Informe
		$sql="DELETE FROM informes WHERE informe_id=$informe_id";
		$db->query($sql);

		//2) Los grupos detalle
		$sql="DELETE FROM grupos_detalle WHERE grupo_id IN (SELECT grupos.grupo_id FROM grupos WHERE informe_id = $informe_id)";
		$db->query($sql);	

		//3) Los grupos del Informe 
		$sql="DELETE FROM grupos WHERE informe_id=$informe_id";
		$db->query($sql);	

		//4) El informe_detalle (los test asociados)
		$sql="DELETE FROM informes_detalle WHERE informe_id=$informe_id";
		$db->query($sql);	

		//5) Informes predeterminados
		$sql="UPDATE test SET informe_id=$nuevo_informe_id WHERE informe_id=$informe_id";
		$db->query($sql);

		$db->close();

		header("Location: def_informe.php");
		exit;

	} 


//	echo "<pre>".print_r($_REQUEST,true)."</pre>";



// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeOutput @1-E7C8F99F
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $elim_informe; //Compatibility
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


?>
