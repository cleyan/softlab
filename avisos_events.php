<?php
// //Events @1-F81417CB

//avisos_lbl_aviso_BeforeShow @2-D762F19C
function avisos_lbl_aviso_BeforeShow(& $sender)
{
    $avisos_lbl_aviso_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $avisos; //Compatibility
//End avisos_lbl_aviso_BeforeShow

//Custom Code @3-806C464C
// -------------------------
    global $avisos;
    // Write your own code here.


	$aviso=CCGetParam("aviso","");

	$etq='<table width="100%" align="center" border="0" cellspacing="0" cellpadding="2" bgcolor="#FF9900">'.
	  	  '	<tr>'.
	      ' 	<td><img id="Image1" src="images/emblem-info.png" align="left" name="Image1">'.$aviso.'</td> '.
	  	  '	</tr>'.
		  '	</table>';


	if ($aviso!=""){
		$avisos->lbl_aviso->SetValue($etq);
	} 

// -------------------------
//End Custom Code

//Close avisos_lbl_aviso_BeforeShow @2-70AB897F
    return $avisos_lbl_aviso_BeforeShow;
}
//End Close avisos_lbl_aviso_BeforeShow

//avisos_BeforeOutput @1-0ED7678B
function avisos_BeforeOutput(& $sender)
{
    $avisos_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $avisos; //Compatibility
//End avisos_BeforeOutput

//Custom Code @4-2A29BDB7
// -------------------------
    // Write your own code here.


// -------------------------
//End Custom Code

//Close avisos_BeforeOutput @1-85A82011
    return $avisos_BeforeOutput;
}
//End Close avisos_BeforeOutput
?>
