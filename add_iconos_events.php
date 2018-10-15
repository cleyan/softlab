<?php
//BindEvents Method @1-6EDF0C6C
function BindEvents()
{
    global $iconos;
    global $CCSEvents;
    $iconos->iconos_TotalRecords->CCSEvents["BeforeShow"] = "iconos_iconos_TotalRecords_BeforeShow";
    $iconos->path_icono->CCSEvents["BeforeShow"] = "iconos_path_icono_BeforeShow";
    $iconos->Alt_path_icono->CCSEvents["BeforeShow"] = "iconos_Alt_path_icono_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
}
//End BindEvents Method

//iconos_iconos_TotalRecords_BeforeShow @4-1D0C4141
function iconos_iconos_TotalRecords_BeforeShow(& $sender)
{
    $iconos_iconos_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $iconos; //Compatibility
//End iconos_iconos_TotalRecords_BeforeShow

//Retrieve number of records @5-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close iconos_iconos_TotalRecords_BeforeShow @4-87B9C184
    return $iconos_iconos_TotalRecords_BeforeShow;
}
//End Close iconos_iconos_TotalRecords_BeforeShow

//iconos_path_icono_BeforeShow @30-1957AED0
function iconos_path_icono_BeforeShow(& $sender)
{
    $iconos_path_icono_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $iconos; //Compatibility
//End iconos_path_icono_BeforeShow

//Custom Code @32-F096C108
// -------------------------
    global $iconos;
  	$path = "images/".$iconos->path->GetValue();
 	$imagen = "<img src='$path' border=\"0\">";
    $iconos->path_icono->SetValue($imagen);

// -------------------------
//End Custom Code

//Close iconos_path_icono_BeforeShow @30-F96CF334
    return $iconos_path_icono_BeforeShow;
}
//End Close iconos_path_icono_BeforeShow

//iconos_Alt_path_icono_BeforeShow @31-F33E32A2
function iconos_Alt_path_icono_BeforeShow(& $sender)
{
    $iconos_Alt_path_icono_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $iconos; //Compatibility
//End iconos_Alt_path_icono_BeforeShow

//Custom Code @33-F096C108
// -------------------------
    global $iconos;
  	$path = "images/".$iconos->alt_path->GetValue();
 	$imagen = "<img src='$path' border=\"0\">";
    $iconos->Alt_path_icono->SetValue($imagen);
// -------------------------
//End Custom Code

//Close iconos_Alt_path_icono_BeforeShow @31-E278F7CC
    return $iconos_Alt_path_icono_BeforeShow;
}
//End Close iconos_Alt_path_icono_BeforeShow

//Page_BeforeOutput @1-64DA7579
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $add_iconos; //Compatibility
//End Page_BeforeOutput

//Custom Code @37-2A29BDB7
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
