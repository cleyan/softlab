<?php
//Include Common Files @1-4A324660
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "acercade.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Initialize Page @1-165CAA3E
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
$TemplateFileName = "acercade.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-BDA62B47
include_once("./acercade_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-B28743AC
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$lbl_registrado = new clsControl(ccsLabel, "lbl_registrado", "lbl_registrado", ccsText, "", CCGetRequestParam("lbl_registrado", ccsGet, NULL), $MainPage);
$lbl_registrado->HTML = true;
$lbl_serie = new clsControl(ccsLabel, "lbl_serie", "lbl_serie", ccsText, "", CCGetRequestParam("lbl_serie", ccsGet, NULL), $MainPage);
$lbl_serie->HTML = true;
$lbl_version = new clsControl(ccsLabel, "lbl_version", "lbl_version", ccsText, "", CCGetRequestParam("lbl_version", ccsGet, NULL), $MainPage);
$lbl_version->HTML = true;
$lbl_usuario = new clsControl(ccsLabel, "lbl_usuario", "lbl_usuario", ccsText, "", CCGetRequestParam("lbl_usuario", ccsGet, NULL), $MainPage);
$lbl_usuario->HTML = true;
$lbl_distribuidor = new clsControl(ccsLabel, "lbl_distribuidor", "lbl_distribuidor", ccsText, "", CCGetRequestParam("lbl_distribuidor", ccsGet, NULL), $MainPage);
$lbl_distribuidor->HTML = true;
$lbl_sw_servidor = new clsControl(ccsLabel, "lbl_sw_servidor", "lbl_sw_servidor", ccsText, "", CCGetRequestParam("lbl_sw_servidor", ccsGet, NULL), $MainPage);
$lbl_sw_servidor->HTML = true;
$lbl_mysql = new clsControl(ccsLabel, "lbl_mysql", "lbl_mysql", ccsText, "", CCGetRequestParam("lbl_mysql", ccsGet, NULL), $MainPage);
$lbl_mysql->HTML = true;
$lbl_servidor = new clsControl(ccsLabel, "lbl_servidor", "lbl_servidor", ccsText, "", CCGetRequestParam("lbl_servidor", ccsGet, NULL), $MainPage);
$lbl_servidor->HTML = true;
$lbl_ip = new clsControl(ccsLabel, "lbl_ip", "lbl_ip", ccsText, "", CCGetRequestParam("lbl_ip", ccsGet, NULL), $MainPage);
$lbl_ip->HTML = true;
$info_distribuidor = new clsControl(ccsLabel, "info_distribuidor", "info_distribuidor", ccsText, "", CCGetRequestParam("info_distribuidor", ccsGet, NULL), $MainPage);
$info_distribuidor->HTML = true;
$MainPage->lbl_registrado = & $lbl_registrado;
$MainPage->lbl_serie = & $lbl_serie;
$MainPage->lbl_version = & $lbl_version;
$MainPage->lbl_usuario = & $lbl_usuario;
$MainPage->lbl_distribuidor = & $lbl_distribuidor;
$MainPage->lbl_sw_servidor = & $lbl_sw_servidor;
$MainPage->lbl_mysql = & $lbl_mysql;
$MainPage->lbl_servidor = & $lbl_servidor;
$MainPage->lbl_ip = & $lbl_ip;
$MainPage->info_distribuidor = & $info_distribuidor;
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

//Show Page @1-C179251F
$lbl_registrado->Show();
$lbl_serie->Show();
$lbl_version->Show();
$lbl_usuario->Show();
$lbl_distribuidor->Show();
$lbl_sw_servidor->Show();
$lbl_mysql->Show();
$lbl_servidor->Show();
$lbl_ip->Show();
$info_distribuidor->Show();
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
