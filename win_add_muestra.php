<?php
//Include Common Files @1-FF7CB1BC
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "win_add_muestra.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtipos_muestra { //tipos_muestra Class @2-80BBC66D

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

//Class_Initialize Event @2-183BCBF3
    function clsRecordtipos_muestra($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tipos_muestra/Error";
        $this->DataSource = new clstipos_muestraDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tipos_muestra";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->tipo_muestra_id = new clsControl(ccsHidden, "tipo_muestra_id", "Tipo Muestra Id", ccsInteger, "", CCGetRequestParam("tipo_muestra_id", $Method, NULL), $this);
            $this->activo = new clsControl(ccsHidden, "activo", "Activo", ccsText, "", CCGetRequestParam("activo", $Method, NULL), $this);
            $this->muestra_last_id = new clsControl(ccsHidden, "muestra_last_id", "muestra_last_id", ccsText, "", CCGetRequestParam("muestra_last_id", $Method, NULL), $this);
            $this->last_nom_muestra = new clsControl(ccsHidden, "last_nom_muestra", "last_nom_muestra", ccsText, "", CCGetRequestParam("last_nom_muestra", $Method, NULL), $this);
            $this->nom_tipo_muestra = new clsControl(ccsTextBox, "nom_tipo_muestra", "Tipo de Muestra", ccsText, "", CCGetRequestParam("nom_tipo_muestra", $Method, NULL), $this);
            $this->nom_tipo_muestra->Required = true;
            $this->indicacion_id = new clsControl(ccsListBox, "indicacion_id", "Indicación", ccsInteger, "", CCGetRequestParam("indicacion_id", $Method, NULL), $this);
            $this->indicacion_id->DSType = dsTable;
            $this->indicacion_id->DataSource = new clsDBDatos();
            $this->indicacion_id->ds = & $this->indicacion_id->DataSource;
            $this->indicacion_id->DataSource->SQL = "SELECT * \n" .
"FROM indicaciones_muestra {SQL_Where} {SQL_OrderBy}";
            list($this->indicacion_id->BoundColumn, $this->indicacion_id->TextColumn, $this->indicacion_id->DBFormat) = array("indicacion_muestra_id", "nom_indicacion", "");
            $this->indicacion_id->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->activo->Value) && !strlen($this->activo->Value) && $this->activo->Value !== false)
                    $this->activo->SetText('V');
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-710FB8A2
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urltipo_muestra_id"] = CCGetFromGet("tipo_muestra_id", NULL);
    }
//End Initialize Method

//Validate Method @2-8BD563FE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->tipo_muestra_id->Validate() && $Validation);
        $Validation = ($this->activo->Validate() && $Validation);
        $Validation = ($this->muestra_last_id->Validate() && $Validation);
        $Validation = ($this->last_nom_muestra->Validate() && $Validation);
        $Validation = ($this->nom_tipo_muestra->Validate() && $Validation);
        $Validation = ($this->indicacion_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->tipo_muestra_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->activo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->muestra_last_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->last_nom_muestra->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_tipo_muestra->Errors->Count() == 0);
        $Validation =  $Validation && ($this->indicacion_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-BEDDECA3
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->tipo_muestra_id->Errors->Count());
        $errors = ($errors || $this->activo->Errors->Count());
        $errors = ($errors || $this->muestra_last_id->Errors->Count());
        $errors = ($errors || $this->last_nom_muestra->Errors->Count());
        $errors = ($errors || $this->nom_tipo_muestra->Errors->Count());
        $errors = ($errors || $this->indicacion_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-905FEA0E
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
            $this->PressedButton = $this->EditMode ? "Button_Cancel" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "win_add_muestra.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "add_test.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-D56BCB06
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->tipo_muestra_id->SetValue($this->tipo_muestra_id->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->muestra_last_id->SetValue($this->muestra_last_id->GetValue(true));
        $this->DataSource->last_nom_muestra->SetValue($this->last_nom_muestra->GetValue(true));
        $this->DataSource->nom_tipo_muestra->SetValue($this->nom_tipo_muestra->GetValue(true));
        $this->DataSource->indicacion_id->SetValue($this->indicacion_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-D8A5C4AF
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->tipo_muestra_id->SetValue($this->tipo_muestra_id->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->muestra_last_id->SetValue($this->muestra_last_id->GetValue(true));
        $this->DataSource->last_nom_muestra->SetValue($this->last_nom_muestra->GetValue(true));
        $this->DataSource->nom_tipo_muestra->SetValue($this->nom_tipo_muestra->GetValue(true));
        $this->DataSource->indicacion_id->SetValue($this->indicacion_id->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-B4B22B83
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

        $this->indicacion_id->Prepare();

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
                if(!$this->FormSubmitted){
                    $this->tipo_muestra_id->SetValue($this->DataSource->tipo_muestra_id->GetValue());
                    $this->activo->SetValue($this->DataSource->activo->GetValue());
                    $this->nom_tipo_muestra->SetValue($this->DataSource->nom_tipo_muestra->GetValue());
                    $this->indicacion_id->SetValue($this->DataSource->indicacion_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->tipo_muestra_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->activo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->muestra_last_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->last_nom_muestra->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_tipo_muestra->Errors->ToString());
            $Error = ComposeStrings($Error, $this->indicacion_id->Errors->ToString());
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

        $this->tipo_muestra_id->Show();
        $this->activo->Show();
        $this->muestra_last_id->Show();
        $this->last_nom_muestra->Show();
        $this->nom_tipo_muestra->Show();
        $this->indicacion_id->Show();
        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tipos_muestra Class @2-FCB6E20C

class clstipos_muestraDataSource extends clsDBDatos {  //tipos_muestraDataSource Class @2-1A0C3B64

//DataSource Variables @2-627BDCBE
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $tipo_muestra_id;
    public $activo;
    public $muestra_last_id;
    public $last_nom_muestra;
    public $nom_tipo_muestra;
    public $indicacion_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-ED87185E
    function clstipos_muestraDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tipos_muestra/Error";
        $this->Initialize();
        $this->tipo_muestra_id = new clsField("tipo_muestra_id", ccsInteger, "");
        
        $this->activo = new clsField("activo", ccsText, "");
        
        $this->muestra_last_id = new clsField("muestra_last_id", ccsText, "");
        
        $this->last_nom_muestra = new clsField("last_nom_muestra", ccsText, "");
        
        $this->nom_tipo_muestra = new clsField("nom_tipo_muestra", ccsText, "");
        
        $this->indicacion_id = new clsField("indicacion_id", ccsInteger, "");
        

        $this->InsertFields["tipo_muestra_id"] = array("Name" => "tipo_muestra_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_tipo_muestra"] = array("Name" => "nom_tipo_muestra", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["indicacion_id"] = array("Name" => "indicacion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipo_muestra_id"] = array("Name" => "tipo_muestra_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_tipo_muestra"] = array("Name" => "nom_tipo_muestra", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["indicacion_id"] = array("Name" => "indicacion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-9B51FA1E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltipo_muestra_id", ccsInteger, "", "", $this->Parameters["urltipo_muestra_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tipo_muestra_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-0C12394D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tipos_muestra {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E59EF9B4
    function SetValues()
    {
        $this->tipo_muestra_id->SetDBValue(trim($this->f("tipo_muestra_id")));
        $this->activo->SetDBValue($this->f("activo"));
        $this->nom_tipo_muestra->SetDBValue($this->f("nom_tipo_muestra"));
        $this->indicacion_id->SetDBValue(trim($this->f("indicacion_id")));
    }
//End SetValues Method

//Insert Method @2-3960B791
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["tipo_muestra_id"]["Value"] = $this->tipo_muestra_id->GetDBValue(true);
        $this->InsertFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->InsertFields["nom_tipo_muestra"]["Value"] = $this->nom_tipo_muestra->GetDBValue(true);
        $this->InsertFields["indicacion_id"]["Value"] = $this->indicacion_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("tipos_muestra", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-30394BDB
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["tipo_muestra_id"]["Value"] = $this->tipo_muestra_id->GetDBValue(true);
        $this->UpdateFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->UpdateFields["nom_tipo_muestra"]["Value"] = $this->nom_tipo_muestra->GetDBValue(true);
        $this->UpdateFields["indicacion_id"]["Value"] = $this->indicacion_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tipos_muestra", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-AAF6B037
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tipos_muestra";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End tipos_muestraDataSource Class @2-FCB6E20C

//Initialize Page @1-EC84D793
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
$TemplateFileName = "win_add_muestra.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-837311B2
include_once("./win_add_muestra_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9DB698AA
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$tipos_muestra = new clsRecordtipos_muestra("", $MainPage);
$MainPage->tipos_muestra = & $tipos_muestra;
$tipos_muestra->Initialize();
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

//Execute Components @1-D87109F8
$tipos_muestra->Operation();
//End Execute Components

//Go to destination page @1-988EA276
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($tipos_muestra);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-297D4624
$tipos_muestra->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F1AE892A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($tipos_muestra);
unset($Tpl);
//End Unload Page


?>
