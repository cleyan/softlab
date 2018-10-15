<?php
//Include Common Files @1-02716C79
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "importar_precios.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordNewRecord1 { //NewRecord1 Class @2-D7EDAFB1

//Variables @2-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @2-1363C113
    function clsRecordNewRecord1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->archivo = new clsFileUpload("archivo", "archivo", "TEMP/", "./", "*.upd", "", 100000, $this);
            $this->archivo->Required = true;
            $this->prevision_id = new clsControl(ccsListBox, "prevision_id", "Procedencia", ccsInteger, "", CCGetRequestParam("prevision_id", $Method, NULL), $this);
            $this->prevision_id->DSType = dsTable;
            $this->prevision_id->DataSource = new clsDBDatos();
            $this->prevision_id->ds = & $this->prevision_id->DataSource;
            $this->prevision_id->DataSource->SQL = "SELECT * \n" .
"FROM previsiones {SQL_Where} {SQL_OrderBy}";
            list($this->prevision_id->BoundColumn, $this->prevision_id->TextColumn, $this->prevision_id->DBFormat) = array("prevision_id", "nom_prevision", "");
            $this->prevision_id->Required = true;
            $this->procedencia_id = new clsControl(ccsListBox, "procedencia_id", "Procedencia", ccsInteger, "", CCGetRequestParam("procedencia_id", $Method, NULL), $this);
            $this->procedencia_id->DSType = dsTable;
            $this->procedencia_id->DataSource = new clsDBDatos();
            $this->procedencia_id->ds = & $this->procedencia_id->DataSource;
            $this->procedencia_id->DataSource->SQL = "SELECT * \n" .
"FROM procedencias {SQL_Where} {SQL_OrderBy}";
            list($this->procedencia_id->BoundColumn, $this->procedencia_id->TextColumn, $this->procedencia_id->DBFormat) = array("procedencia_id", "nom_procedencia", "");
            $this->procedencia_id->Required = true;
            $this->creartest = new clsControl(ccsRadioButton, "creartest", "creartest", ccsText, "", CCGetRequestParam("creartest", $Method, NULL), $this);
            $this->creartest->DSType = dsListOfValues;
            $this->creartest->Values = array(array("V", "Sí, crear un test no encontrado"), array("F", "No, omitir Test Faltantes"));
            $this->creartest->HTML = true;
            $this->creartest->Required = true;
            $this->eliminarlistas = new clsControl(ccsRadioButton, "eliminarlistas", "Condición de eliminación de listas", ccsText, "", CCGetRequestParam("eliminarlistas", $Method, NULL), $this);
            $this->eliminarlistas->DSType = dsListOfValues;
            $this->eliminarlistas->Values = array(array("1", "Si, Todas"), array("2", "No, sólo la que estoy importando"));
            $this->eliminarlistas->HTML = true;
            $this->eliminarlistas->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-AB5097A9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->archivo->Validate() && $Validation);
        $Validation = ($this->prevision_id->Validate() && $Validation);
        $Validation = ($this->procedencia_id->Validate() && $Validation);
        $Validation = ($this->creartest->Validate() && $Validation);
        $Validation = ($this->eliminarlistas->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->archivo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->prevision_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->creartest->Errors->Count() == 0);
        $Validation =  $Validation && ($this->eliminarlistas->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-CF368C3E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->archivo->Errors->Count());
        $errors = ($errors || $this->prevision_id->Errors->Count());
        $errors = ($errors || $this->procedencia_id->Errors->Count());
        $errors = ($errors || $this->creartest->Errors->Count());
        $errors = ($errors || $this->eliminarlistas->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-FFA992E2
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        $this->archivo->Upload();

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-ABEB2400
    function Show()
    {
        global $CCSUseAmp;
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->prevision_id->Prepare();
        $this->procedencia_id->Prepare();
        $this->creartest->Prepare();
        $this->eliminarlistas->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->archivo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->prevision_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->creartest->Errors->ToString());
            $Error = ComposeStrings($Error, $this->eliminarlistas->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->archivo->Show();
        $this->prevision_id->Show();
        $this->procedencia_id->Show();
        $this->creartest->Show();
        $this->eliminarlistas->Show();
        $this->Button_Insert->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End NewRecord1 Class @2-FCB6E20C

//Initialize Page @1-1D1E53CA
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
$TemplateFileName = "importar_precios.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-0CEA975A
CCSecurityRedirect("17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-B63CF896
include_once("./importar_precios_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-88748775
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$MainPage->NewRecord1 = & $NewRecord1;
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

//Execute Components @1-A09052E6
$NewRecord1->Operation();
//End Execute Components

//Go to destination page @1-74A8DE62
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($NewRecord1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-686669AC
$NewRecord1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-CFFBB3B1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($NewRecord1);
unset($Tpl);
//End Unload Page


?>
