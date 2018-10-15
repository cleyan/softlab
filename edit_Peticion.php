<?php
//Include Common Files @1-4078DA0D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "edit_peticion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files


//Initialize Page @1-A7B11FAB
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";
$TemplateSource = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "edit_peticion.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-ECE50CEE
CCSecurityRedirect("4;5;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-3B529E18
include_once("./edit_peticion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-53B94811
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$status_peticion = new clsControl(ccsLabel, "status_peticion", "status_peticion", ccsText, "", CCGetRequestParam("status_peticion", ccsGet, NULL), $MainPage);
$mensajes = new clsControl(ccsLabel, "mensajes", "mensajes", ccsText, "", CCGetRequestParam("mensajes", ccsGet, NULL), $MainPage);
$mensajes->HTML = true;
$nom_paciente = new clsControl(ccsLabel, "nom_paciente", "nom_paciente", ccsText, "", CCGetRequestParam("nom_paciente", ccsGet, NULL), $MainPage);
$paciente_id = new clsControl(ccsLabel, "paciente_id", "paciente_id", ccsText, "", CCGetRequestParam("paciente_id", ccsGet, NULL), $MainPage);
$estado_id = new clsControl(ccsLabel, "estado_id", "estado_id", ccsInteger, "", CCGetRequestParam("estado_id", ccsGet, NULL), $MainPage);
$peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsText, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $MainPage);
$peticion_id->HTML = true;
$fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsText, "", CCGetRequestParam("fecha", ccsGet, NULL), $MainPage);
$fecha->HTML = true;
$hora = new clsControl(ccsLabel, "hora", "hora", ccsText, "", CCGetRequestParam("hora", ccsGet, NULL), $MainPage);
$hora->HTML = true;
$opPrevision = new clsControl(ccsLabel, "opPrevision", "opPrevision", ccsText, "", CCGetRequestParam("opPrevision", ccsGet, NULL), $MainPage);
$opPrevision->HTML = true;
$opMedico = new clsControl(ccsLabel, "opMedico", "opMedico", ccsText, "", CCGetRequestParam("opMedico", ccsGet, NULL), $MainPage);
$opMedico->HTML = true;
$valorOp = new clsControl(ccsLabel, "valorOp", "valorOp", ccsText, "", CCGetRequestParam("valorOp", ccsGet, NULL), $MainPage);
$valorOp->HTML = true;
$opPrioridad = new clsControl(ccsLabel, "opPrioridad", "opPrioridad", ccsText, "", CCGetRequestParam("opPrioridad", ccsGet, NULL), $MainPage);
$opPrioridad->HTML = true;
$op_seccion_id = new clsControl(ccsLabel, "op_seccion_id", "op_seccion_id", ccsText, "", CCGetRequestParam("op_seccion_id", ccsGet, NULL), $MainPage);
$op_seccion_id->HTML = true;
$lblTest = new clsControl(ccsLabel, "lblTest", "lblTest", ccsText, "", CCGetRequestParam("lblTest", ccsGet, NULL), $MainPage);
$lblTest->HTML = true;
$listaTest = new clsControl(ccsLabel, "listaTest", "listaTest", ccsText, "", CCGetRequestParam("listaTest", ccsGet, NULL), $MainPage);
$listaTest->HTML = true;
$observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $MainPage);
$restoTest = new clsControl(ccsLabel, "restoTest", "restoTest", ccsText, "", CCGetRequestParam("restoTest", ccsGet, NULL), $MainPage);
$restoTest->HTML = true;
$MainPage->status_peticion = & $status_peticion;
$MainPage->mensajes = & $mensajes;
$MainPage->nom_paciente = & $nom_paciente;
$MainPage->paciente_id = & $paciente_id;
$MainPage->estado_id = & $estado_id;
$MainPage->peticion_id = & $peticion_id;
$MainPage->fecha = & $fecha;
$MainPage->hora = & $hora;
$MainPage->opPrevision = & $opPrevision;
$MainPage->opMedico = & $opMedico;
$MainPage->valorOp = & $valorOp;
$MainPage->opPrioridad = & $opPrioridad;
$MainPage->op_seccion_id = & $op_seccion_id;
$MainPage->lblTest = & $lblTest;
$MainPage->listaTest = & $listaTest;
$MainPage->observaciones = & $observaciones;
$MainPage->restoTest = & $restoTest;
$ScriptIncludes = "";
$SList = explode("|", $Scripts);
foreach ($SList as $Script) {
    if ($Script != "") $ScriptIncludes = $ScriptIncludes . "<script src=\"" . $PathToRoot . $Script . "\" type=\"text/javascript\"></script>\n";
}
$Attributes->SetValue("scriptIncludes", $ScriptIncludes);

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-5D816F46
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
if (strlen($TemplateSource)) {
    $Tpl->LoadTemplateFromStr($TemplateSource, $BlockToParse, "ISO-8859-1", "replace");
} else {
    $Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "ISO-8859-1", "replace");
}
$Tpl->SetVar("CCS_PathToRoot", $PathToRoot);
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Go to destination page @1-FBA93089
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    header("Location: " . $Redirect);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7E01BB74
$status_peticion->Show();
$mensajes->Show();
$nom_paciente->Show();
$paciente_id->Show();
$estado_id->Show();
$peticion_id->Show();
$fecha->Show();
$hora->Show();
$opPrevision->Show();
$opMedico->Show();
$valorOp->Show();
$opPrioridad->Show();
$op_seccion_id->Show();
$lblTest->Show();
$listaTest->Show();
$observaciones->Show();
$restoTest->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-74A7C1E7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
unset($Tpl);
//End Unload Page


?>
