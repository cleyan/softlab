<?php
//Include Common Files @1-A7C70D01
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "cambiarclave.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordusuarios { //usuarios Class @2-E7FA739F

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

//Class_Initialize Event @2-CFC28706
    function clsRecordusuarios($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record usuarios/Error";
        $this->DataSource = new clsusuariosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "usuarios";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "Nom Usuario", ccsText, "", CCGetRequestParam("nom_usuario", $Method, NULL), $this);
            $this->log_usuario = new clsControl(ccsLabel, "log_usuario", "Log Usuario", ccsText, "", CCGetRequestParam("log_usuario", $Method, NULL), $this);
            $this->clave_actual = new clsControl(ccsTextBox, "clave_actual", "Clave actual", ccsText, "", CCGetRequestParam("clave_actual", $Method, NULL), $this);
            $this->clave_actual->Required = true;
            $this->nueva_clave = new clsControl(ccsTextBox, "nueva_clave", "Nueva Clave", ccsText, "", CCGetRequestParam("nueva_clave", $Method, NULL), $this);
            $this->nueva_clave->Required = true;
            $this->nueva_clave2 = new clsControl(ccsTextBox, "nueva_clave2", "Repetir NUeva clave", ccsText, "", CCGetRequestParam("nueva_clave2", $Method, NULL), $this);
            $this->nueva_clave2->Required = true;
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-A0F7AC58
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["expr5"] = CCGetUserID();
    }
//End Initialize Method

//Validate Method @2-71BFEA87
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->clave_actual->Validate() && $Validation);
        $Validation = ($this->nueva_clave->Validate() && $Validation);
        $Validation = ($this->nueva_clave2->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->clave_actual->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nueva_clave->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nueva_clave2->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-9A4F77FC
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nom_usuario->Errors->Count());
        $errors = ($errors || $this->log_usuario->Errors->Count());
        $errors = ($errors || $this->clave_actual->Errors->Count());
        $errors = ($errors || $this->nueva_clave->Errors->Count());
        $errors = ($errors || $this->nueva_clave2->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-815609EA
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
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Cancel";
            if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "menu_principal.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Update") {
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

//UpdateRow Method @2-15021BA1
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nom_usuario->SetValue($this->nom_usuario->GetValue(true));
        $this->DataSource->log_usuario->SetValue($this->log_usuario->GetValue(true));
        $this->DataSource->clave_actual->SetValue($this->clave_actual->GetValue(true));
        $this->DataSource->nueva_clave->SetValue($this->nueva_clave->GetValue(true));
        $this->DataSource->nueva_clave2->SetValue($this->nueva_clave2->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-8B888ADD
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
                $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                $this->log_usuario->SetValue($this->DataSource->log_usuario->GetValue());
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nom_usuario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->log_usuario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->clave_actual->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nueva_clave->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nueva_clave2->Errors->ToString());
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
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->nom_usuario->Show();
        $this->log_usuario->Show();
        $this->clave_actual->Show();
        $this->nueva_clave->Show();
        $this->nueva_clave2->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End usuarios Class @2-FCB6E20C

class clsusuariosDataSource extends clsDBDatos {  //usuariosDataSource Class @2-A570ED29

//DataSource Variables @2-64B77726
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $nom_usuario;
    public $log_usuario;
    public $clave_actual;
    public $nueva_clave;
    public $nueva_clave2;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-0056C1F3
    function clsusuariosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record usuarios/Error";
        $this->Initialize();
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        
        $this->log_usuario = new clsField("log_usuario", ccsText, "");
        
        $this->clave_actual = new clsField("clave_actual", ccsText, "");
        
        $this->nueva_clave = new clsField("nueva_clave", ccsText, "");
        
        $this->nueva_clave2 = new clsField("nueva_clave2", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-FE6AB337
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "expr5", ccsInteger, "", "", $this->Parameters["expr5"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "usuario_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-A074CE66
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM usuarios {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-551B5FEE
    function SetValues()
    {
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
        $this->log_usuario->SetDBValue($this->f("log_usuario"));
    }
//End SetValues Method

//Update Method @2-8017492B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->SQL = CCBuildUpdate("usuarios", $this->UpdateFields, $this);
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

} //End usuariosDataSource Class @2-FCB6E20C

//Initialize Page @1-8319F9D3
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
$TemplateFileName = "cambiarclave.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-75B72F97
include_once("./cambiarclave_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-5BFBAE43
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$usuarios = new clsRecordusuarios("", $MainPage);
$MainPage->usuarios = & $usuarios;
$usuarios->Initialize();
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

//Execute Components @1-5F7C2662
$usuarios->Operation();
//End Execute Components

//Go to destination page @1-7F48EDF9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($usuarios);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A1A27AB6
$usuarios->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-DF24DB00
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($usuarios);
unset($Tpl);
//End Unload Page


?>
