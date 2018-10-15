<?php
//BindEvents Method @1-F176CC89
function BindEvents()
{
    global $usuarios;
    global $CCSEvents;
    $usuarios->usuarios_TotalRecords->CCSEvents["BeforeShow"] = "usuarios_usuarios_TotalRecords_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//usuarios_usuarios_TotalRecords_BeforeShow @45-7AF263C6
function usuarios_usuarios_TotalRecords_BeforeShow(& $sender)
{
    $usuarios_usuarios_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $usuarios; //Compatibility
//End usuarios_usuarios_TotalRecords_BeforeShow

//Retrieve number of records @46-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close usuarios_usuarios_TotalRecords_BeforeShow @45-AE3D16EF
    return $usuarios_usuarios_TotalRecords_BeforeShow;
}
//End Close usuarios_usuarios_TotalRecords_BeforeShow

//Page_BeforeOutput @1-C0679E32
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_usuarios; //Compatibility
//End Page_BeforeOutput

//Custom Code @74-2A29BDB7
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
