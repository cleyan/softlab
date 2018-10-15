<?php
//Include Common Files @1-01FD7202
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_medicos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmedicos { //medicos Class @57-1A1A68E1

//Variables @57-9E315808

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

//Class_Initialize Event @57-F292755A
    function clsRecordmedicos($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record medicos/Error";
        $this->DataSource = new clsmedicosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "medicos";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nom_medico = new clsControl(ccsTextBox, "nom_medico", "Nom Medico", ccsText, "", CCGetRequestParam("nom_medico", $Method, NULL), $this);
            $this->nom_medico->Required = true;
            $this->especialidad_id = new clsControl(ccsListBox, "especialidad_id", "Especialidad Id", ccsText, "", CCGetRequestParam("especialidad_id", $Method, NULL), $this);
            $this->especialidad_id->DSType = dsTable;
            $this->especialidad_id->DataSource = new clsDBDatos();
            $this->especialidad_id->ds = & $this->especialidad_id->DataSource;
            $this->especialidad_id->DataSource->SQL = "SELECT * \n" .
"FROM especialidades {SQL_Where} {SQL_OrderBy}";
            $this->especialidad_id->DataSource->Order = "nom_especialidad";
            list($this->especialidad_id->BoundColumn, $this->especialidad_id->TextColumn, $this->especialidad_id->DBFormat) = array("especialidad_id", "nom_especialidad", "");
            $this->especialidad_id->DataSource->Parameters["expr70"] = 'V';
            $this->especialidad_id->DataSource->wp = new clsSQLParameters();
            $this->especialidad_id->DataSource->wp->AddParameter("1", "expr70", ccsText, "", "", $this->especialidad_id->DataSource->Parameters["expr70"], "", false);
            $this->especialidad_id->DataSource->wp->Criterion[1] = $this->especialidad_id->DataSource->wp->Operation(opEqual, "activo", $this->especialidad_id->DataSource->wp->GetDBValue("1"), $this->especialidad_id->DataSource->ToSQL($this->especialidad_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->especialidad_id->DataSource->Where = 
                 $this->especialidad_id->DataSource->wp->Criterion[1];
            $this->especialidad_id->DataSource->Order = "nom_especialidad";
            $this->fono = new clsControl(ccsTextBox, "fono", "Fono", ccsText, "", CCGetRequestParam("fono", $Method, NULL), $this);
            $this->email = new clsControl(ccsTextBox, "email", "Email", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
            $this->factor = new clsControl(ccsTextBox, "factor", "Factor", ccsFloat, "", CCGetRequestParam("factor", $Method, NULL), $this);
            $this->activo = new clsControl(ccsCheckBox, "activo", "Activo", ccsText, "", CCGetRequestParam("activo", $Method, NULL), $this);
            $this->activo->CheckedValue = $this->activo->GetParsedValue('V');
            $this->activo->UncheckedValue = $this->activo->GetParsedValue('F');
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->activo->Value) && !strlen($this->activo->Value) && $this->activo->Value !== false)
                    $this->activo->SetValue(false);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @57-D9A9E58A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlmedico_id"] = CCGetFromGet("medico_id", NULL);
    }
//End Initialize Method

//Validate Method @57-44E7C4A1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->nom_medico->SetValue($this->nom_medico->GetValue());
        if(CCDLookUp("COUNT(*)", "medicos", "nom_medico=" . $this->DataSource->ToSQL($this->DataSource->nom_medico->GetDBValue(), $this->DataSource->nom_medico->DataType) . $Where, $this->DataSource) > 0)
            $this->nom_medico->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Nom Medico"));
        if(strlen($this->email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->email->GetText())) {
            $this->email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "Email"));
        }
        $Validation = ($this->nom_medico->Validate() && $Validation);
        $Validation = ($this->especialidad_id->Validate() && $Validation);
        $Validation = ($this->fono->Validate() && $Validation);
        $Validation = ($this->email->Validate() && $Validation);
        $Validation = ($this->factor->Validate() && $Validation);
        $Validation = ($this->activo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nom_medico->Errors->Count() == 0);
        $Validation =  $Validation && ($this->especialidad_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->factor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->activo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @57-9BB89F6E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nom_medico->Errors->Count());
        $errors = ($errors || $this->especialidad_id->Errors->Count());
        $errors = ($errors || $this->fono->Errors->Count());
        $errors = ($errors || $this->email->Errors->Count());
        $errors = ($errors || $this->factor->Errors->Count());
        $errors = ($errors || $this->activo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @57-8AD6C2B2
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "list_medicos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @57-F59F3D4C
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->nom_medico->SetValue($this->nom_medico->GetValue(true));
        $this->DataSource->especialidad_id->SetValue($this->especialidad_id->GetValue(true));
        $this->DataSource->fono->SetValue($this->fono->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->factor->SetValue($this->factor->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @57-2EFF2B10
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nom_medico->SetValue($this->nom_medico->GetValue(true));
        $this->DataSource->especialidad_id->SetValue($this->especialidad_id->GetValue(true));
        $this->DataSource->fono->SetValue($this->fono->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->factor->SetValue($this->factor->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @57-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @57-30DA85B0
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

        $this->especialidad_id->Prepare();

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
                    $this->nom_medico->SetValue($this->DataSource->nom_medico->GetValue());
                    $this->especialidad_id->SetValue($this->DataSource->especialidad_id->GetValue());
                    $this->fono->SetValue($this->DataSource->fono->GetValue());
                    $this->email->SetValue($this->DataSource->email->GetValue());
                    $this->factor->SetValue($this->DataSource->factor->GetValue());
                    $this->activo->SetValue($this->DataSource->activo->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nom_medico->Errors->ToString());
            $Error = ComposeStrings($Error, $this->especialidad_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->factor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->activo->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->nom_medico->Show();
        $this->especialidad_id->Show();
        $this->fono->Show();
        $this->email->Show();
        $this->factor->Show();
        $this->activo->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End medicos Class @57-FCB6E20C

class clsmedicosDataSource extends clsDBDatos {  //medicosDataSource Class @57-2988D26C

//DataSource Variables @57-595E5B1F
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
    public $nom_medico;
    public $especialidad_id;
    public $fono;
    public $email;
    public $factor;
    public $activo;
//End DataSource Variables

//DataSourceClass_Initialize Event @57-A830C7A6
    function clsmedicosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record medicos/Error";
        $this->Initialize();
        $this->nom_medico = new clsField("nom_medico", ccsText, "");
        
        $this->especialidad_id = new clsField("especialidad_id", ccsText, "");
        
        $this->fono = new clsField("fono", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->factor = new clsField("factor", ccsFloat, "");
        
        $this->activo = new clsField("activo", ccsText, "");
        

        $this->InsertFields["nom_medico"] = array("Name" => "nom_medico", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["especialidad_id"] = array("Name" => "especialidad_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fono"] = array("Name" => "fono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["factor"] = array("Name" => "factor", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["nom_medico"] = array("Name" => "nom_medico", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["especialidad_id"] = array("Name" => "especialidad_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fono"] = array("Name" => "fono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["factor"] = array("Name" => "factor", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsText);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @57-C284F401
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlmedico_id", ccsInteger, "", "", $this->Parameters["urlmedico_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "medico_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @57-F0768A05
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM medicos {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @57-37D9AF6B
    function SetValues()
    {
        $this->nom_medico->SetDBValue($this->f("nom_medico"));
        $this->especialidad_id->SetDBValue($this->f("especialidad_id"));
        $this->fono->SetDBValue($this->f("fono"));
        $this->email->SetDBValue($this->f("email"));
        $this->factor->SetDBValue(trim($this->f("factor")));
        $this->activo->SetDBValue($this->f("activo"));
    }
//End SetValues Method

//Insert Method @57-B86F09EF
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["nom_medico"]["Value"] = $this->nom_medico->GetDBValue(true);
        $this->InsertFields["especialidad_id"]["Value"] = $this->especialidad_id->GetDBValue(true);
        $this->InsertFields["fono"]["Value"] = $this->fono->GetDBValue(true);
        $this->InsertFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->InsertFields["factor"]["Value"] = $this->factor->GetDBValue(true);
        $this->InsertFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->SQL = CCBuildInsert("medicos", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @57-23E40C44
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["nom_medico"]["Value"] = $this->nom_medico->GetDBValue(true);
        $this->UpdateFields["especialidad_id"]["Value"] = $this->especialidad_id->GetDBValue(true);
        $this->UpdateFields["fono"]["Value"] = $this->fono->GetDBValue(true);
        $this->UpdateFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->UpdateFields["factor"]["Value"] = $this->factor->GetDBValue(true);
        $this->UpdateFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->SQL = CCBuildUpdate("medicos", $this->UpdateFields, $this);
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

//Delete Method @57-6E3325A9
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM medicos";
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

} //End medicosDataSource Class @57-FCB6E20C

//Initialize Page @1-BB5A995A
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
$TemplateFileName = "add_medicos.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-0CEA975A
CCSecurityRedirect("17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-FA13C5B4
include_once("./add_medicos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-34460F49
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$medicos = new clsRecordmedicos("", $MainPage);
$MainPage->medicos = & $medicos;
$medicos->Initialize();
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

//Execute Components @1-54E2DB67
$medicos->Operation();
//End Execute Components

//Go to destination page @1-4607B7A5
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($medicos);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CE56B6A3
$medicos->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B66AA816
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($medicos);
unset($Tpl);
//End Unload Page


?>
