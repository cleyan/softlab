<?php
//Include Common Files @1-6BED9600
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_perfiles_detalle.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordperfiles { //perfiles Class @2-E262D33D

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

//Class_Initialize Event @2-D0FDF361
    function clsRecordperfiles($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record perfiles/Error";
        $this->DataSource = new clsperfilesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "perfiles";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->perfil_id = new clsControl(ccsHidden, "perfil_id", "Perfil Id", ccsInteger, "", CCGetRequestParam("perfil_id", $Method, NULL), $this);
            $this->nom_perfil = new clsControl(ccsHidden, "nom_perfil", "Nombre del perfil", ccsText, "", CCGetRequestParam("nom_perfil", $Method, NULL), $this);
            $this->nom_perfil->Required = true;
            $this->LinkedID = new clsControl(ccsHidden, "LinkedID", "LinkedID", ccsText, "", CCGetRequestParam("LinkedID", $Method, NULL), $this);
            $this->listbox_perfiles = new clsControl(ccsLabel, "listbox_perfiles", "listbox_perfiles", ccsText, "", CCGetRequestParam("listbox_perfiles", $Method, NULL), $this);
            $this->listbox_perfiles->HTML = true;
            $this->cadena = new clsControl(ccsTextBox, "cadena", "cadena", ccsText, "", CCGetRequestParam("cadena", $Method, NULL), $this);
            $this->list_test_asignados = new clsControl(ccsListBox, "list_test_asignados", "list_test_asignados", ccsInteger, "", CCGetRequestParam("list_test_asignados", $Method, NULL), $this);
            $this->list_test_asignados->Multiple = true;
            $this->list_test_asignados->DSType = dsTable;
            $this->list_test_asignados->DataSource = new clsDBDatos();
            $this->list_test_asignados->ds = & $this->list_test_asignados->DataSource;
            $this->list_test_asignados->DataSource->SQL = "SELECT perfiles_detalle.*, nom_test \n" .
"FROM perfiles_detalle LEFT JOIN test ON\n" .
"perfiles_detalle.test_id = test.test_id {SQL_Where} {SQL_OrderBy}";
            $this->list_test_asignados->DataSource->Order = "nom_test";
            list($this->list_test_asignados->BoundColumn, $this->list_test_asignados->TextColumn, $this->list_test_asignados->DBFormat) = array("test_id", "nom_test", "");
            $this->list_test_asignados->DataSource->Parameters["urlperfil_id"] = CCGetFromGet("perfil_id", NULL);
            $this->list_test_asignados->DataSource->wp = new clsSQLParameters();
            $this->list_test_asignados->DataSource->wp->AddParameter("1", "urlperfil_id", ccsInteger, "", "", $this->list_test_asignados->DataSource->Parameters["urlperfil_id"], -1, false);
            $this->list_test_asignados->DataSource->wp->Criterion[1] = $this->list_test_asignados->DataSource->wp->Operation(opEqual, "perfiles_detalle.perfil_id", $this->list_test_asignados->DataSource->wp->GetDBValue("1"), $this->list_test_asignados->DataSource->ToSQL($this->list_test_asignados->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->list_test_asignados->DataSource->Where = 
                 $this->list_test_asignados->DataSource->wp->Criterion[1];
            $this->list_test_asignados->DataSource->Order = "nom_test";
            $this->list_test = new clsControl(ccsListBox, "list_test", "list_test", ccsText, "", CCGetRequestParam("list_test", $Method, NULL), $this);
            $this->list_test->Multiple = true;
            $this->list_test->DSType = dsTable;
            $this->list_test->DataSource = new clsDBDatos();
            $this->list_test->ds = & $this->list_test->DataSource;
            $this->list_test->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->list_test->DataSource->Order = "nom_test";
            list($this->list_test->BoundColumn, $this->list_test->TextColumn, $this->list_test->DBFormat) = array("test_id", "nom_test", "");
            $this->list_test->DataSource->Parameters["url'V'"] = CCGetFromGet("'V'", NULL);
            $this->list_test->DataSource->wp = new clsSQLParameters();
            $this->list_test->DataSource->wp->AddParameter("1", "url'V'", ccsText, "", "", $this->list_test->DataSource->Parameters["url'V'"], 'V', false);
            $this->list_test->DataSource->wp->Criterion[1] = $this->list_test->DataSource->wp->Operation(opEqual, "aislado", $this->list_test->DataSource->wp->GetDBValue("1"), $this->list_test->DataSource->ToSQL($this->list_test->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->list_test->DataSource->Where = 
                 $this->list_test->DataSource->wp->Criterion[1];
            $this->list_test->DataSource->Order = "nom_test";
            $this->Button1 = new clsButton("Button1", $Method, $this);
            $this->Button2 = new clsButton("Button2", $Method, $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->perfil_id->Value) && !strlen($this->perfil_id->Value) && $this->perfil_id->Value !== false)
                    $this->perfil_id->SetText(0);
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-DA166178
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlperfil_id"] = CCGetFromGet("perfil_id", NULL);
    }
//End Initialize Method

//Validate Method @2-B64FE02A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->perfil_id->Validate() && $Validation);
        $Validation = ($this->nom_perfil->Validate() && $Validation);
        $Validation = ($this->LinkedID->Validate() && $Validation);
        $Validation = ($this->cadena->Validate() && $Validation);
        $Validation = ($this->list_test_asignados->Validate() && $Validation);
        $Validation = ($this->list_test->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->perfil_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_perfil->Errors->Count() == 0);
        $Validation =  $Validation && ($this->LinkedID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cadena->Errors->Count() == 0);
        $Validation =  $Validation && ($this->list_test_asignados->Errors->Count() == 0);
        $Validation =  $Validation && ($this->list_test->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-AAF49D55
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->perfil_id->Errors->Count());
        $errors = ($errors || $this->nom_perfil->Errors->Count());
        $errors = ($errors || $this->LinkedID->Errors->Count());
        $errors = ($errors || $this->listbox_perfiles->Errors->Count());
        $errors = ($errors || $this->cadena->Errors->Count());
        $errors = ($errors || $this->list_test_asignados->Errors->Count());
        $errors = ($errors || $this->list_test->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-EA29933E
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
            if($this->Button1->Pressed) {
                $this->PressedButton = "Button1";
            } else if($this->Button2->Pressed) {
                $this->PressedButton = "Button2";
            } else if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "add_perfiles_detalle.php";
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "add_perfiles_detalle.php";
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "add_perfiles_detalle.php";
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button1") {
                if(!CCGetEvent($this->Button1->CCSEvents, "OnClick", $this->Button1)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button2") {
                if(!CCGetEvent($this->Button2->CCSEvents, "OnClick", $this->Button2)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Insert") {
                $Redirect = "add_perfiles_detalle.php";
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "add_perfiles_detalle.php";
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

//InsertRow Method @2-D282E375
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->perfil_id->SetValue($this->perfil_id->GetValue(true));
        $this->DataSource->nom_perfil->SetValue($this->nom_perfil->GetValue(true));
        $this->DataSource->LinkedID->SetValue($this->LinkedID->GetValue(true));
        $this->DataSource->listbox_perfiles->SetValue($this->listbox_perfiles->GetValue(true));
        $this->DataSource->cadena->SetValue($this->cadena->GetValue(true));
        $this->DataSource->list_test_asignados->SetValue($this->list_test_asignados->GetValue(true));
        $this->DataSource->list_test->SetValue($this->list_test->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-F3D0D8E3
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->perfil_id->SetValue($this->perfil_id->GetValue(true));
        $this->DataSource->nom_perfil->SetValue($this->nom_perfil->GetValue(true));
        $this->DataSource->LinkedID->SetValue($this->LinkedID->GetValue(true));
        $this->DataSource->listbox_perfiles->SetValue($this->listbox_perfiles->GetValue(true));
        $this->DataSource->cadena->SetValue($this->cadena->GetValue(true));
        $this->DataSource->list_test_asignados->SetValue($this->list_test_asignados->GetValue(true));
        $this->DataSource->list_test->SetValue($this->list_test->GetValue(true));
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

//Show Method @2-5B9DDE1E
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

        $this->list_test_asignados->Prepare();
        $this->list_test->Prepare();

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
                    $this->perfil_id->SetValue($this->DataSource->perfil_id->GetValue());
                    $this->nom_perfil->SetValue($this->DataSource->nom_perfil->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->perfil_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_perfil->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkedID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->listbox_perfiles->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cadena->Errors->ToString());
            $Error = ComposeStrings($Error, $this->list_test_asignados->Errors->ToString());
            $Error = ComposeStrings($Error, $this->list_test->Errors->ToString());
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

        $this->perfil_id->Show();
        $this->nom_perfil->Show();
        $this->LinkedID->Show();
        $this->listbox_perfiles->Show();
        $this->cadena->Show();
        $this->list_test_asignados->Show();
        $this->list_test->Show();
        $this->Button1->Show();
        $this->Button2->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End perfiles Class @2-FCB6E20C

class clsperfilesDataSource extends clsDBDatos {  //perfilesDataSource Class @2-B6B2DBCE

//DataSource Variables @2-F3656049
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
    public $perfil_id;
    public $nom_perfil;
    public $LinkedID;
    public $listbox_perfiles;
    public $cadena;
    public $list_test_asignados;
    public $list_test;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FD661CA8
    function clsperfilesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record perfiles/Error";
        $this->Initialize();
        $this->perfil_id = new clsField("perfil_id", ccsInteger, "");
        
        $this->nom_perfil = new clsField("nom_perfil", ccsText, "");
        
        $this->LinkedID = new clsField("LinkedID", ccsText, "");
        
        $this->listbox_perfiles = new clsField("listbox_perfiles", ccsText, "");
        
        $this->cadena = new clsField("cadena", ccsText, "");
        
        $this->list_test_asignados = new clsField("list_test_asignados", ccsInteger, "");
        
        $this->list_test = new clsField("list_test", ccsText, "");
        

        $this->InsertFields["perfil_id"] = array("Name" => "perfil_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_perfil"] = array("Name" => "nom_perfil", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["perfil_id"] = array("Name" => "perfil_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_perfil"] = array("Name" => "nom_perfil", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-ABECF074
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlperfil_id", ccsInteger, "", "", $this->Parameters["urlperfil_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "perfil_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-D8EDC291
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM perfiles {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-43FB3F13
    function SetValues()
    {
        $this->perfil_id->SetDBValue(trim($this->f("perfil_id")));
        $this->nom_perfil->SetDBValue($this->f("nom_perfil"));
    }
//End SetValues Method

//Insert Method @2-CE799290
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["perfil_id"]["Value"] = $this->perfil_id->GetDBValue(true);
        $this->InsertFields["nom_perfil"]["Value"] = $this->nom_perfil->GetDBValue(true);
        $this->SQL = CCBuildInsert("perfiles", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-F5B864F7
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["perfil_id"]["Value"] = $this->perfil_id->GetDBValue(true);
        $this->UpdateFields["nom_perfil"]["Value"] = $this->nom_perfil->GetDBValue(true);
        $this->SQL = CCBuildUpdate("perfiles", $this->UpdateFields, $this);
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

//Delete Method @2-35B9D402
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM perfiles";
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

} //End perfilesDataSource Class @2-FCB6E20C

//Initialize Page @1-34FEBCA4
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
$TemplateFileName = "add_perfiles_detalle.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-6EB86FCF
include_once("./add_perfiles_detalle_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DFF61078
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$perfiles = new clsRecordperfiles("", $MainPage);
$MainPage->perfiles = & $perfiles;
$perfiles->Initialize();
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

//Execute Components @1-D13F9286
$perfiles->Operation();
//End Execute Components

//Go to destination page @1-75D0DBE0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($perfiles);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-75A40B8F
$perfiles->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-51676FE4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($perfiles);
unset($Tpl);
//End Unload Page


?>
