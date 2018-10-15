<?php
//Include Common Files @1-B1F2C3D4
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "win_add_indicacion_muestra.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordindicaciones_muestra { //indicaciones_muestra Class @2-8F5DF4BC

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

//Class_Initialize Event @2-31AE3EC2
    function clsRecordindicaciones_muestra($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record indicaciones_muestra/Error";
        $this->DataSource = new clsindicaciones_muestraDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "indicaciones_muestra";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->activo = new clsControl(ccsHidden, "activo", "Activo", ccsText, "", CCGetRequestParam("activo", $Method, NULL), $this);
            $this->indicacion_muestra_id = new clsControl(ccsHidden, "indicacion_muestra_id", "Indicacion Muestra Id", ccsInteger, "", CCGetRequestParam("indicacion_muestra_id", $Method, NULL), $this);
            $this->nom_indicacion = new clsControl(ccsTextBox, "nom_indicacion", "Nombre descriptivo", ccsText, "", CCGetRequestParam("nom_indicacion", $Method, NULL), $this);
            $this->nom_indicacion->Required = true;
            $this->cuerpo_indicacion = new clsControl(ccsTextArea, "cuerpo_indicacion", "Descripción", ccsMemo, "", CCGetRequestParam("cuerpo_indicacion", $Method, NULL), $this);
            $this->cuerpo_indicacion->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->activo->Value) && !strlen($this->activo->Value) && $this->activo->Value !== false)
                    $this->activo->SetText('V');
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-5F2AA91E
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlindicacion_muestra_id"] = CCGetFromGet("indicacion_muestra_id", NULL);
    }
//End Initialize Method

//Validate Method @2-572F73F7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->activo->Validate() && $Validation);
        $Validation = ($this->indicacion_muestra_id->Validate() && $Validation);
        $Validation = ($this->nom_indicacion->Validate() && $Validation);
        $Validation = ($this->cuerpo_indicacion->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->activo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->indicacion_muestra_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_indicacion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cuerpo_indicacion->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-CF53497F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->activo->Errors->Count());
        $errors = ($errors || $this->indicacion_muestra_id->Errors->Count());
        $errors = ($errors || $this->nom_indicacion->Errors->Count());
        $errors = ($errors || $this->cuerpo_indicacion->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-8A8C267C
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
        $Redirect = "win_add_indicacion_muestra.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            $Redirect = "win_add_muestra.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "win_add_muestra.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-76E18058
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->indicacion_muestra_id->SetValue($this->indicacion_muestra_id->GetValue(true));
        $this->DataSource->nom_indicacion->SetValue($this->nom_indicacion->GetValue(true));
        $this->DataSource->cuerpo_indicacion->SetValue($this->cuerpo_indicacion->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-0B2FFCCA
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->indicacion_muestra_id->SetValue($this->indicacion_muestra_id->GetValue(true));
        $this->DataSource->nom_indicacion->SetValue($this->nom_indicacion->GetValue(true));
        $this->DataSource->cuerpo_indicacion->SetValue($this->cuerpo_indicacion->GetValue(true));
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

//Show Method @2-29DDE6D5
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
                if(!$this->FormSubmitted){
                    $this->activo->SetValue($this->DataSource->activo->GetValue());
                    $this->indicacion_muestra_id->SetValue($this->DataSource->indicacion_muestra_id->GetValue());
                    $this->nom_indicacion->SetValue($this->DataSource->nom_indicacion->GetValue());
                    $this->cuerpo_indicacion->SetValue($this->DataSource->cuerpo_indicacion->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->activo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->indicacion_muestra_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_indicacion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cuerpo_indicacion->Errors->ToString());
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

        $this->activo->Show();
        $this->indicacion_muestra_id->Show();
        $this->nom_indicacion->Show();
        $this->cuerpo_indicacion->Show();
        $this->Button_Insert->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End indicaciones_muestra Class @2-FCB6E20C

class clsindicaciones_muestraDataSource extends clsDBDatos {  //indicaciones_muestraDataSource Class @2-47459147

//DataSource Variables @2-3A5BACC8
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
    public $activo;
    public $indicacion_muestra_id;
    public $nom_indicacion;
    public $cuerpo_indicacion;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C11F6E9B
    function clsindicaciones_muestraDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record indicaciones_muestra/Error";
        $this->Initialize();
        $this->activo = new clsField("activo", ccsText, "");
        
        $this->indicacion_muestra_id = new clsField("indicacion_muestra_id", ccsInteger, "");
        
        $this->nom_indicacion = new clsField("nom_indicacion", ccsText, "");
        
        $this->cuerpo_indicacion = new clsField("cuerpo_indicacion", ccsMemo, "");
        

        $this->InsertFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["indicacion_muestra_id"] = array("Name" => "indicacion_muestra_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_indicacion"] = array("Name" => "nom_indicacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["cuerpo_indicacion"] = array("Name" => "cuerpo_indicacion", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["indicacion_muestra_id"] = array("Name" => "indicacion_muestra_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_indicacion"] = array("Name" => "nom_indicacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cuerpo_indicacion"] = array("Name" => "cuerpo_indicacion", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-FD8437CB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlindicacion_muestra_id", ccsInteger, "", "", $this->Parameters["urlindicacion_muestra_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "indicacion_muestra_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-B5CC3A1E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM indicaciones_muestra {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-5CE5AA6D
    function SetValues()
    {
        $this->activo->SetDBValue($this->f("activo"));
        $this->indicacion_muestra_id->SetDBValue(trim($this->f("indicacion_muestra_id")));
        $this->nom_indicacion->SetDBValue($this->f("nom_indicacion"));
        $this->cuerpo_indicacion->SetDBValue($this->f("cuerpo_indicacion"));
    }
//End SetValues Method

//Insert Method @2-62F0C511
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->InsertFields["indicacion_muestra_id"]["Value"] = $this->indicacion_muestra_id->GetDBValue(true);
        $this->InsertFields["nom_indicacion"]["Value"] = $this->nom_indicacion->GetDBValue(true);
        $this->InsertFields["cuerpo_indicacion"]["Value"] = $this->cuerpo_indicacion->GetDBValue(true);
        $this->SQL = CCBuildInsert("indicaciones_muestra", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-514C035E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->UpdateFields["indicacion_muestra_id"]["Value"] = $this->indicacion_muestra_id->GetDBValue(true);
        $this->UpdateFields["nom_indicacion"]["Value"] = $this->nom_indicacion->GetDBValue(true);
        $this->UpdateFields["cuerpo_indicacion"]["Value"] = $this->cuerpo_indicacion->GetDBValue(true);
        $this->SQL = CCBuildUpdate("indicaciones_muestra", $this->UpdateFields, $this);
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

//Delete Method @2-E526F0E0
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM indicaciones_muestra";
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

} //End indicaciones_muestraDataSource Class @2-FCB6E20C

//Initialize Page @1-8969898F
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
$TemplateFileName = "win_add_indicacion_muestra.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-07FB1527
include_once("./win_add_indicacion_muestra_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DE6193F7
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$indicaciones_muestra = new clsRecordindicaciones_muestra("", $MainPage);
$MainPage->indicaciones_muestra = & $indicaciones_muestra;
$indicaciones_muestra->Initialize();
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

//Execute Components @1-C3BC737F
$indicaciones_muestra->Operation();
//End Execute Components

//Go to destination page @1-56F7E3B4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($indicaciones_muestra);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CD1B5282
$indicaciones_muestra->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C2CAF324
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($indicaciones_muestra);
unset($Tpl);
//End Unload Page


?>
