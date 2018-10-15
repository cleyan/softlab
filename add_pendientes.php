<?php
//Include Common Files @1-5A15B179
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_pendientes.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordbitacora { //bitacora Class @18-70B6DB6E

//Variables @18-9E315808

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

//Class_Initialize Event @18-06854D9C
    function clsRecordbitacora($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record bitacora/Error";
        $this->DataSource = new clsbitacoraDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "bitacora";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "Peticion Id", ccsInteger, "", CCGetRequestParam("peticion_id", $Method, NULL), $this);
            $this->fecha = new clsControl(ccsTextBox, "fecha", "Fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", $Method, NULL), $this);
            $this->fecha->Required = true;
            $this->descripcion = new clsControl(ccsTextArea, "descripcion", "Descripcion", ccsMemo, "", CCGetRequestParam("descripcion", $Method, NULL), $this);
            $this->descripcion->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->fecha->Value) && !strlen($this->fecha->Value) && $this->fecha->Value !== false)
                    $this->fecha->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @18-E1E5466E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlbitacora_id"] = CCGetFromGet("bitacora_id", NULL);
    }
//End Initialize Method

//Validate Method @18-21C7BEC8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->fecha->Validate() && $Validation);
        $Validation = ($this->descripcion->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->fecha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->descripcion->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @18-EC9C25D9
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->peticion_id->Errors->Count());
        $errors = ($errors || $this->fecha->Errors->Count());
        $errors = ($errors || $this->descripcion->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @18-03A09849
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "closeandrefresh.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @18-F86337E8
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->descripcion->SetValue($this->descripcion->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @18-1FC4F261
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                if(!$this->FormSubmitted){
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->descripcion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->peticion_id->Show();
        $this->fecha->Show();
        $this->descripcion->Show();
        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End bitacora Class @18-FCB6E20C

class clsbitacoraDataSource extends clsDBDatos {  //bitacoraDataSource Class @18-F29C5A76

//DataSource Variables @18-4F57FFC3
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

    // Datasource fields
    public $peticion_id;
    public $fecha;
    public $descripcion;
//End DataSource Variables

//DataSourceClass_Initialize Event @18-8995DD88
    function clsbitacoraDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record bitacora/Error";
        $this->Initialize();
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->descripcion = new clsField("descripcion", ccsMemo, "");
        

        $this->InsertFields["peticion_id"] = array("Name" => "peticion_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsDate);
        $this->InsertFields["descripcion"] = array("Name" => "descripcion", "Value" => "", "DataType" => ccsMemo);
        $this->InsertFields["tipo_bitacora_id"] = array("Name" => "tipo_bitacora_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["usuario_id"] = array("Name" => "usuario_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["nivel_id"] = array("Name" => "nivel_id", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @18-886BA96B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlbitacora_id", ccsInteger, "", "", $this->Parameters["urlbitacora_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "bitacora_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @18-7020B723
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM bitacora {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @18-923670BA
    function SetValues()
    {
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->descripcion->SetDBValue($this->f("descripcion"));
    }
//End SetValues Method

//Insert Method @18-B04E34F7
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["peticion_id"] = new clsSQLParameter("urlpeticion_id", ccsInteger, "", "", CCGetFromGet("peticion_id", NULL), "", false, $this->ErrorBlock);
        $this->cp["fecha"] = new clsSQLParameter("ctrlfecha", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->fecha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["descripcion"] = new clsSQLParameter("ctrldescripcion", ccsMemo, "", "", $this->descripcion->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["tipo_bitacora_id"] = new clsSQLParameter("expr34", ccsInteger, "", "", 1, "", false, $this->ErrorBlock);
        $this->cp["usuario_id"] = new clsSQLParameter("expr35", ccsInteger, "", "", CCGetUserID(), "", false, $this->ErrorBlock);
        $this->cp["estado_id"] = new clsSQLParameter("expr36", ccsInteger, "", "", 1000, "", false, $this->ErrorBlock);
        $this->cp["nivel_id"] = new clsSQLParameter("expr37", ccsInteger, "", "", 2, "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["peticion_id"]->GetValue()) and !strlen($this->cp["peticion_id"]->GetText()) and !is_bool($this->cp["peticion_id"]->GetValue())) 
            $this->cp["peticion_id"]->SetText(CCGetFromGet("peticion_id", NULL));
        if (!is_null($this->cp["fecha"]->GetValue()) and !strlen($this->cp["fecha"]->GetText()) and !is_bool($this->cp["fecha"]->GetValue())) 
            $this->cp["fecha"]->SetValue($this->fecha->GetValue(true));
        if (!is_null($this->cp["descripcion"]->GetValue()) and !strlen($this->cp["descripcion"]->GetText()) and !is_bool($this->cp["descripcion"]->GetValue())) 
            $this->cp["descripcion"]->SetValue($this->descripcion->GetValue(true));
        if (!is_null($this->cp["tipo_bitacora_id"]->GetValue()) and !strlen($this->cp["tipo_bitacora_id"]->GetText()) and !is_bool($this->cp["tipo_bitacora_id"]->GetValue())) 
            $this->cp["tipo_bitacora_id"]->SetValue(1);
        if (!is_null($this->cp["usuario_id"]->GetValue()) and !strlen($this->cp["usuario_id"]->GetText()) and !is_bool($this->cp["usuario_id"]->GetValue())) 
            $this->cp["usuario_id"]->SetValue(CCGetUserID());
        if (!is_null($this->cp["estado_id"]->GetValue()) and !strlen($this->cp["estado_id"]->GetText()) and !is_bool($this->cp["estado_id"]->GetValue())) 
            $this->cp["estado_id"]->SetValue(1000);
        if (!is_null($this->cp["nivel_id"]->GetValue()) and !strlen($this->cp["nivel_id"]->GetText()) and !is_bool($this->cp["nivel_id"]->GetValue())) 
            $this->cp["nivel_id"]->SetValue(2);
        $this->InsertFields["peticion_id"]["Value"] = $this->cp["peticion_id"]->GetDBValue(true);
        $this->InsertFields["fecha"]["Value"] = $this->cp["fecha"]->GetDBValue(true);
        $this->InsertFields["descripcion"]["Value"] = $this->cp["descripcion"]->GetDBValue(true);
        $this->InsertFields["tipo_bitacora_id"]["Value"] = $this->cp["tipo_bitacora_id"]->GetDBValue(true);
        $this->InsertFields["usuario_id"]["Value"] = $this->cp["usuario_id"]->GetDBValue(true);
        $this->InsertFields["estado_id"]["Value"] = $this->cp["estado_id"]->GetDBValue(true);
        $this->InsertFields["nivel_id"]["Value"] = $this->cp["nivel_id"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("bitacora", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End bitacoraDataSource Class @18-FCB6E20C

//Include Page implementation @17-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-8033C5EA
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
$TemplateFileName = "add_pendientes.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-297D3FD3
include_once("./add_pendientes_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1A91DAEC
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$bitacora = new clsRecordbitacora("", $MainPage);
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$MainPage->bitacora = & $bitacora;
$MainPage->calendar_tag = & $calendar_tag;
$bitacora->Initialize();
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

//Execute Components @1-E2EF9B25
$calendar_tag->Operations();
$bitacora->Operation();
//End Execute Components

//Go to destination page @1-7D6C61FA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($bitacora);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-6F82F473
$bitacora->Show();
$calendar_tag->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2AC1C26A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($bitacora);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($Tpl);
//End Unload Page


?>
