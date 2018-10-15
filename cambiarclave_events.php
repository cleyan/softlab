<?php
//BindEvents Method @1-370D5B01
function BindEvents()
{
    global $usuarios;
    global $CCSEvents;
    $usuarios->CCSEvents["BeforeUpdate"] = "usuarios_BeforeUpdate";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//usuarios_BeforeUpdate @2-F87858A4
function usuarios_BeforeUpdate(& $sender)
{
    $usuarios_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $usuarios; //Compatibility
//End usuarios_BeforeUpdate

//Custom Code @11-CC060883
// -------------------------
    global $usuarios;
	global $Redirect;
    // Write your own code here.
		$usuarios->UpdateAllowed=False;
		

	
	$clave_actual=$usuarios->clave_actual->GetValue();
	$clave_nueva=$usuarios->nueva_clave->GetValue();
	$clave_nueva2=$usuarios->nueva_clave2->GetValue();

	//die($clave_actual . $clave_nueva . $clave_nueva2);

	if ($clave_nueva <> $clave_nueva2) 
		$usuarios->Errors->addError("La Nueva clave es distinta en los dos campos");

	$db = new clsDBDatos();
	$sql="SELECT log_usuario FROM usuarios WHERE log_usuario=" . $db->ToSQL(CCGetUserLogin(), ccsText) . " AND clave=" . $db->ToSQL($clave_actual, ccsText) . " AND usuario_id=" . CCGetUserID() ;

	$db->query($sql);

	$resultado=$db->next_record();

	if (!$resultado) $usuarios->Errors->addError("La clave actual es incorrecta");


	//Busca que no vaya un ' en la clave
	if ((strrchr($clave_nueva, "'")) OR (strrchr($clave_nueva2, "'"))) $usuarios->Errors->addError("La nueva clave contiene caracteres no autorizados, use letras y números");


	if ($usuarios->Errors->Count()==0){
		$sql="UPDATE usuarios SET clave='$clave_nueva' WHERE usuario_id=".CCGetUserID();
		$db->query($sql);

		header("Location: login.php?Logout=true");

	} 
		

	unset($db);

	
	


// -------------------------
//End Custom Code

//Close usuarios_BeforeUpdate @2-44B2B08D
    return $usuarios_BeforeUpdate;
}
//End Close usuarios_BeforeUpdate

//Page_BeforeOutput @1-DB329FD4
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $cambiarclave; //Compatibility
//End Page_BeforeOutput

//Custom Code @12-2A29BDB7
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
