<?php
//BindEvents Method @1-22D551BB
function BindEvents()
{
    global $CCSEvents;
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
}
//End BindEvents Method

//Page_BeforeOutput @1-4AAF6952
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $del_peticion; //Compatibility
//End Page_BeforeOutput

//Custom Code @14-2A29BDB7
// -------------------------
    // Write your own code here.

	CorrigeCodigoEx();


// -------------------------
//End Custom Code

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_AfterInitialize @1-BA1DD100
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $del_peticion; //Compatibility
//End Page_AfterInitialize

//Custom Code @22-2A29BDB7
// -------------------------
    
	$peticion_id = CCGetParam("peticion_id","");
	$accion=CCGetParam("accion","");

	

	$error=false;

	if ($peticion_id >0 && $accion == "eliminar"){			
		$db= new clsDBDatos();
		$sql="";
		//primero verifica si tiene resultados

		$sql="SELECT Count(*) FROM resultados WHERE peticion_id=$peticion_id AND muestra_id<>''";
		$db->query($sql);
		
		$qty= ($db->next_record()) ? $db->f(0) : 0;

		if ($qty > 0) {
			echo "La petición tiene resultados asociados, no se puede eliminar<br>";
			$error=true;
		}

		//Valida si tiene pagos
		$sql="SELECT COUNT(*) FROM detalle_pago WHERE peticion_id=$peticion_id";
		$db->query($sql);

		$qty=($db->next_record()) ? $db->f(0) : 0;

		if ($qty > 0){
			echo "La peticion tiene pagos asociados, no se puede eliminar<br>";
			$error=true;
		}

		if (! $error){
			//Eliminar los detalles
			$sql ="DELETE FROM peticiones_detalle WHERE peticion_id=$peticion_id";
			$db->query($sql);

			//Eliminar los posibles resultados existentes
			$sql="DELETE FROM resultados WHERE peticion_id=$peticion_id";
			$db->query($sql);

			//eliminar el resumen
			//En realidad bloquea el paciente
			$sql="UPDATE peticiones SET paciente_id=-1 WHERE peticion_id=$peticion_id";
			$db->query($sql);

			echo " <h1>SE ha eliminado la Petición</h1>";

		}

		unset($db);

			
		die("<br><br><a href=\"det_Peticion.php?peticion_id=$peticion_id\">[OK]</a>");
	}

// -------------------------
//End Custom Code

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize


?>
