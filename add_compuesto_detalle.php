<?php
//Include Common Files @1-A7C48DE6
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_compuesto_detalle.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files



class clsRecordcompuesto_detalle { //compuesto_detalle Class @11-DAD02D28

//Variables @11-9E315808

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

//Class_Initialize Event @11-0B940AAA
    function clsRecordcompuesto_detalle($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record compuesto_detalle/Error";
        $this->DataSource = new clscompuesto_detalleDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "compuesto_detalle";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->comp_test_id = new clsControl(ccsHidden, "comp_test_id", "Comp Test Id", ccsInteger, "", CCGetRequestParam("comp_test_id", $Method, NULL), $this);
            $this->LinkedID = new clsControl(ccsHidden, "LinkedID", "LinkedID", ccsText, "", CCGetRequestParam("LinkedID", $Method, NULL), $this);
            $this->lbl_grabado = new clsControl(ccsLabel, "lbl_grabado", "lbl_grabado", ccsText, "", CCGetRequestParam("lbl_grabado", $Method, NULL), $this);
            $this->lbl_grabado->HTML = true;
            $this->cadena = new clsControl(ccsTextBox, "cadena", "cadena", ccsText, "", CCGetRequestParam("cadena", $Method, NULL), $this);
            $this->list_compuestos = new clsControl(ccsListBox, "list_compuestos", "list_compuestos", ccsInteger, "", CCGetRequestParam("list_compuestos", $Method, NULL), $this);
            $this->list_compuestos->Multiple = true;
            $this->list_compuestos->DSType = dsTable;
            $this->list_compuestos->DataSource = new clsDBDatos();
            $this->list_compuestos->ds = & $this->list_compuestos->DataSource;
            $this->list_compuestos->DataSource->SQL = "SELECT compuesto_detalle.*, cod_test, nom_test \n" .
"FROM test RIGHT JOIN compuesto_detalle ON\n" .
"test.test_id = compuesto_detalle.test_id {SQL_Where} {SQL_OrderBy}";
            $this->list_compuestos->DataSource->Order = "cod_test";
            list($this->list_compuestos->BoundColumn, $this->list_compuestos->TextColumn, $this->list_compuestos->DBFormat) = array("test_id", "cod_test", "");
            $this->list_compuestos->DataSource->Parameters["urlcomp_test_id"] = CCGetFromGet("comp_test_id", NULL);
            $this->list_compuestos->DataSource->wp = new clsSQLParameters();
            $this->list_compuestos->DataSource->wp->AddParameter("1", "urlcomp_test_id", ccsInteger, "", "", $this->list_compuestos->DataSource->Parameters["urlcomp_test_id"], -1, false);
            $this->list_compuestos->DataSource->wp->Criterion[1] = $this->list_compuestos->DataSource->wp->Operation(opEqual, "compuesto_detalle.comp_test_id", $this->list_compuestos->DataSource->wp->GetDBValue("1"), $this->list_compuestos->DataSource->ToSQL($this->list_compuestos->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->list_compuestos->DataSource->Where = 
                 $this->list_compuestos->DataSource->wp->Criterion[1];
            $this->list_compuestos->DataSource->Order = "cod_test";
            $this->list_test = new clsControl(ccsListBox, "list_test", "list_test", ccsInteger, "", CCGetRequestParam("list_test", $Method, NULL), $this);
            $this->list_test->Multiple = true;
            $this->list_test->DSType = dsTable;
            $this->list_test->DataSource = new clsDBDatos();
            $this->list_test->ds = & $this->list_test->DataSource;
            $this->list_test->DataSource->SQL = "SELECT * \n" .
"FROM test {SQL_Where} {SQL_OrderBy}";
            $this->list_test->DataSource->Order = "cod_test";
            list($this->list_test->BoundColumn, $this->list_test->TextColumn, $this->list_test->DBFormat) = array("test_id", "cod_test", "");
            $this->list_test->DataSource->Parameters["expr68"] = 'V';
            $this->list_test->DataSource->Parameters["urlcomp_test_id"] = CCGetFromGet("comp_test_id", NULL);
            $this->list_test->DataSource->wp = new clsSQLParameters();
            $this->list_test->DataSource->wp->AddParameter("1", "expr68", ccsText, "", "", $this->list_test->DataSource->Parameters["expr68"], 'V', false);
            $this->list_test->DataSource->wp->AddParameter("2", "urlcomp_test_id", ccsInteger, "", "", $this->list_test->DataSource->Parameters["urlcomp_test_id"], "", false);
            $this->list_test->DataSource->wp->Criterion[1] = $this->list_test->DataSource->wp->Operation(opNotEqual, "compuesto", $this->list_test->DataSource->wp->GetDBValue("1"), $this->list_test->DataSource->ToSQL($this->list_test->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->list_test->DataSource->wp->Criterion[2] = $this->list_test->DataSource->wp->Operation(opNotEqual, "test_id", $this->list_test->DataSource->wp->GetDBValue("2"), $this->list_test->DataSource->ToSQL($this->list_test->DataSource->wp->GetDBValue("2"), ccsInteger),false);
            $this->list_test->DataSource->Where = $this->list_test->DataSource->wp->opAND(
                 false, 
                 $this->list_test->DataSource->wp->Criterion[1], 
                 $this->list_test->DataSource->wp->Criterion[2]);
            $this->list_test->DataSource->Order = "cod_test";
            $this->bt_derecho = new clsButton("bt_derecho", $Method, $this);
            $this->bt_izquierdo = new clsButton("bt_izquierdo", $Method, $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", $Method, NULL), $this);
            $this->ImageLink1->Page = "orden_ingreso.php";
        }
    }
//End Class_Initialize Event

//Initialize Method @11-DADBFF9C
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlcomp_test_id"] = CCGetFromGet("comp_test_id", NULL);
    }
//End Initialize Method

//Validate Method @11-4F6A3780
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->comp_test_id->Validate() && $Validation);
        $Validation = ($this->LinkedID->Validate() && $Validation);
        $Validation = ($this->cadena->Validate() && $Validation);
        $Validation = ($this->list_compuestos->Validate() && $Validation);
        $Validation = ($this->list_test->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->comp_test_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->LinkedID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cadena->Errors->Count() == 0);
        $Validation =  $Validation && ($this->list_compuestos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->list_test->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @11-81C7542E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->comp_test_id->Errors->Count());
        $errors = ($errors || $this->LinkedID->Errors->Count());
        $errors = ($errors || $this->lbl_grabado->Errors->Count());
        $errors = ($errors || $this->cadena->Errors->Count());
        $errors = ($errors || $this->list_compuestos->Errors->Count());
        $errors = ($errors || $this->list_test->Errors->Count());
        $errors = ($errors || $this->ImageLink1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @11-84F45A57
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
            if($this->bt_derecho->Pressed) {
                $this->PressedButton = "bt_derecho";
            } else if($this->bt_izquierdo->Pressed) {
                $this->PressedButton = "bt_izquierdo";
            } else if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = "add_compuesto_detalle.php";
        if($this->PressedButton == "bt_derecho") {
            if(!CCGetEvent($this->bt_derecho->CCSEvents, "OnClick", $this->bt_derecho)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "bt_izquierdo") {
            if(!CCGetEvent($this->bt_izquierdo->CCSEvents, "OnClick", $this->bt_izquierdo)) {
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

//InsertRow Method @11-3882CE34
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->comp_test_id->SetValue($this->comp_test_id->GetValue(true));
        $this->DataSource->LinkedID->SetValue($this->LinkedID->GetValue(true));
        $this->DataSource->lbl_grabado->SetValue($this->lbl_grabado->GetValue(true));
        $this->DataSource->cadena->SetValue($this->cadena->GetValue(true));
        $this->DataSource->list_compuestos->SetValue($this->list_compuestos->GetValue(true));
        $this->DataSource->list_test->SetValue($this->list_test->GetValue(true));
        $this->DataSource->ImageLink1->SetValue($this->ImageLink1->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @11-CE32770C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->comp_test_id->SetValue($this->comp_test_id->GetValue(true));
        $this->DataSource->LinkedID->SetValue($this->LinkedID->GetValue(true));
        $this->DataSource->lbl_grabado->SetValue($this->lbl_grabado->GetValue(true));
        $this->DataSource->cadena->SetValue($this->cadena->GetValue(true));
        $this->DataSource->list_compuestos->SetValue($this->list_compuestos->GetValue(true));
        $this->DataSource->list_test->SetValue($this->list_test->GetValue(true));
        $this->DataSource->ImageLink1->SetValue($this->ImageLink1->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @11-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @11-60ECA3BC
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

        $this->list_compuestos->Prepare();
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
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "comp_test_id", $this->DataSource->f("comp_test_id"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->comp_test_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkedID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lbl_grabado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cadena->Errors->ToString());
            $Error = ComposeStrings($Error, $this->list_compuestos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->list_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ImageLink1->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->comp_test_id->Show();
        $this->LinkedID->Show();
        $this->lbl_grabado->Show();
        $this->cadena->Show();
        $this->list_compuestos->Show();
        $this->list_test->Show();
        $this->bt_derecho->Show();
        $this->bt_izquierdo->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End compuesto_detalle Class @11-FCB6E20C

class clscompuesto_detalleDataSource extends clsDBDatos {  //compuesto_detalleDataSource Class @11-4C7008F1

//DataSource Variables @11-99B34F96
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
    public $comp_test_id;
    public $LinkedID;
    public $lbl_grabado;
    public $cadena;
    public $list_compuestos;
    public $list_test;
    public $ImageLink1;
//End DataSource Variables

//DataSourceClass_Initialize Event @11-66597564
    function clscompuesto_detalleDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record compuesto_detalle/Error";
        $this->Initialize();
        $this->comp_test_id = new clsField("comp_test_id", ccsInteger, "");
        
        $this->LinkedID = new clsField("LinkedID", ccsText, "");
        
        $this->lbl_grabado = new clsField("lbl_grabado", ccsText, "");
        
        $this->cadena = new clsField("cadena", ccsText, "");
        
        $this->list_compuestos = new clsField("list_compuestos", ccsInteger, "");
        
        $this->list_test = new clsField("list_test", ccsInteger, "");
        
        $this->ImageLink1 = new clsField("ImageLink1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @11-6FF5B97D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlcomp_test_id", ccsInteger, "", "", $this->Parameters["urlcomp_test_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "comp_test_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @11-E3467DF8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM compuesto_detalle {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @11-BAF0975B
    function SetValues()
    {
    }
//End SetValues Method

//Insert Method @11-096BC4EE
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->SQL = CCBuildInsert("compuesto_detalle", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @11-ACD9CB91
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->SQL = CCBuildUpdate("compuesto_detalle", $this->UpdateFields, $this);
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

//Delete Method @11-F56A5493
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM compuesto_detalle";
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

} //End compuesto_detalleDataSource Class @11-FCB6E20C

//Initialize Page @1-3E866B7B
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
$TemplateFileName = "add_compuesto_detalle.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-1E208587
CCSecurityRedirect("14;15;16;17;18;19;20", "");
//End Authenticate User

//Include events file @1-278BF37E
include_once("./add_compuesto_detalle_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3BA6C430
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$compuesto_detalle = new clsRecordcompuesto_detalle("", $MainPage);
$MainPage->compuesto_detalle = & $compuesto_detalle;
$compuesto_detalle->Initialize();
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

//Execute Components @1-F743B85C
$compuesto_detalle->Operation();
//End Execute Components

//Go to destination page @1-8919BA7B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($compuesto_detalle);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-56D7163B
$compuesto_detalle->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B48B8898
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($compuesto_detalle);
unset($Tpl);
//End Unload Page


?>
