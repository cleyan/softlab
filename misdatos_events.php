<?php
//BindEvents Method @1-ABD88325
function BindEvents()
{
    global $usuarios;
    global $CCSEvents;
    $usuarios->lblfirma->CCSEvents["BeforeShow"] = "usuarios_lblfirma_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//usuarios_lblfirma_BeforeShow @36-378CA27F
function usuarios_lblfirma_BeforeShow(& $sender)
{
    $usuarios_lblfirma_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $usuarios; //Compatibility
//End usuarios_lblfirma_BeforeShow

//Custom Code @37-CC060883
// -------------------------
    global $usuarios;
    // Write your own code here.

	$filefirma="firmas/".$usuarios->firma_imagen->GetValue();
	
	if (file_exists($filefirma) && $filefirma != "firmas/") {
		$usuarios->lblfirma->SetValue('<img src="'.$filefirma.'" border="1" height=\"100\" width=\"250\">');
	} else {
		$usuarios->lblfirma->SetValue('');
	}		


// -------------------------
//End Custom Code

//Close usuarios_lblfirma_BeforeShow @36-56300371
    return $usuarios_lblfirma_BeforeShow;
}
//End Close usuarios_lblfirma_BeforeShow

//Page_BeforeOutput @1-E99A653E
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $misdatos; //Compatibility
//End Page_BeforeOutput

//Custom Code @38-2A29BDB7
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
