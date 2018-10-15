<?php
//Include Common Files @1-16CFC18A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "misdatos.php");
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

//Class_Initialize Event @2-5C526EDF
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
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nom_usuario = new clsControl(ccsTextBox, "nom_usuario", "Nom Usuario", ccsText, "", CCGetRequestParam("nom_usuario", $Method, NULL), $this);
            $this->nom_usuario->Required = true;
            $this->log_usuario = new clsControl(ccsTextBox, "log_usuario", "Log Usuario", ccsText, "", CCGetRequestParam("log_usuario", $Method, NULL), $this);
            $this->log_usuario->Required = true;
            $this->firma_nombre = new clsControl(ccsTextBox, "firma_nombre", "Firma Nombre", ccsText, "", CCGetRequestParam("firma_nombre", $Method, NULL), $this);
            $this->firma_nombre->Required = true;
            $this->firma_titulo = new clsControl(ccsTextBox, "firma_titulo", "Firma Titulo", ccsText, "", CCGetRequestParam("firma_titulo", $Method, NULL), $this);
            $this->firma_imagen = new clsFileUpload("firma_imagen", "Imágen de la firma", "TEMP/", "firmas/", "*.bmp", "*.php;*.htm;*.jpg;*.gif", 100000, $this);
            $this->lblfirma = new clsControl(ccsLabel, "lblfirma", "lblfirma", ccsText, "", CCGetRequestParam("lblfirma", $Method, NULL), $this);
            $this->lblfirma->HTML = true;
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

//Validate Method @2-31DD431B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->nom_usuario->SetValue($this->nom_usuario->GetValue());
        if(CCDLookUp("COUNT(*)", "usuarios", "nom_usuario=" . $this->DataSource->ToSQL($this->DataSource->nom_usuario->GetDBValue(), $this->DataSource->nom_usuario->DataType) . $Where, $this->DataSource) > 0)
            $this->nom_usuario->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Nom Usuario"));
        $this->DataSource->log_usuario->SetValue($this->log_usuario->GetValue());
        if(CCDLookUp("COUNT(*)", "usuarios", "log_usuario=" . $this->DataSource->ToSQL($this->DataSource->log_usuario->GetDBValue(), $this->DataSource->log_usuario->DataType) . $Where, $this->DataSource) > 0)
            $this->log_usuario->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Log Usuario"));
        $Validation = ($this->nom_usuario->Validate() && $Validation);
        $Validation = ($this->log_usuario->Validate() && $Validation);
        $Validation = ($this->firma_nombre->Validate() && $Validation);
        $Validation = ($this->firma_titulo->Validate() && $Validation);
        $Validation = ($this->firma_imagen->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->nom_usuario->Errors->Count() == 0);
        $Validation =  $Validation && ($this->log_usuario->Errors->Count() == 0);
        $Validation =  $Validation && ($this->firma_nombre->Errors->Count() == 0);
        $Validation =  $Validation && ($this->firma_titulo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->firma_imagen->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-D9489E29
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nom_usuario->Errors->Count());
        $errors = ($errors || $this->log_usuario->Errors->Count());
        $errors = ($errors || $this->firma_nombre->Errors->Count());
        $errors = ($errors || $this->firma_titulo->Errors->Count());
        $errors = ($errors || $this->firma_imagen->Errors->Count());
        $errors = ($errors || $this->lblfirma->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-B15D0A3F
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

        $this->firma_imagen->Upload();

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

//UpdateRow Method @2-73AB3889
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nom_usuario->SetValue($this->nom_usuario->GetValue(true));
        $this->DataSource->log_usuario->SetValue($this->log_usuario->GetValue(true));
        $this->DataSource->firma_nombre->SetValue($this->firma_nombre->GetValue(true));
        $this->DataSource->firma_titulo->SetValue($this->firma_titulo->GetValue(true));
        $this->DataSource->firma_imagen->SetValue($this->firma_imagen->GetValue(true));
        $this->DataSource->lblfirma->SetValue($this->lblfirma->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->firma_imagen->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-EB7A6BAF
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
                    $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                    $this->log_usuario->SetValue($this->DataSource->log_usuario->GetValue());
                    $this->firma_nombre->SetValue($this->DataSource->firma_nombre->GetValue());
                    $this->firma_titulo->SetValue($this->DataSource->firma_titulo->GetValue());
                    $this->firma_imagen->SetValue($this->DataSource->firma_imagen->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nom_usuario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->log_usuario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->firma_nombre->Errors->ToString());
            $Error = ComposeStrings($Error, $this->firma_titulo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->firma_imagen->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblfirma->Errors->ToString());
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
        $this->firma_nombre->Show();
        $this->firma_titulo->Show();
        $this->firma_imagen->Show();
        $this->lblfirma->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End usuarios Class @2-FCB6E20C

class clsusuariosDataSource extends clsDBDatos {  //usuariosDataSource Class @2-A570ED29

//DataSource Variables @2-30AAF392
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
    public $firma_nombre;
    public $firma_titulo;
    public $firma_imagen;
    public $lblfirma;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-366F5655
    function clsusuariosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record usuarios/Error";
        $this->Initialize();
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        
        $this->log_usuario = new clsField("log_usuario", ccsText, "");
        
        $this->firma_nombre = new clsField("firma_nombre", ccsText, "");
        
        $this->firma_titulo = new clsField("firma_titulo", ccsText, "");
        
        $this->firma_imagen = new clsField("firma_imagen", ccsText, "");
        
        $this->lblfirma = new clsField("lblfirma", ccsText, "");
        

        $this->UpdateFields["nom_usuario"] = array("Name" => "nom_usuario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["log_usuario"] = array("Name" => "log_usuario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["firma_nombre"] = array("Name" => "firma_nombre", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["firma_titulo"] = array("Name" => "firma_titulo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["firma_imagen"] = array("Name" => "firma_imagen", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//SetValues Method @2-C615443C
    function SetValues()
    {
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
        $this->log_usuario->SetDBValue($this->f("log_usuario"));
        $this->firma_nombre->SetDBValue($this->f("firma_nombre"));
        $this->firma_titulo->SetDBValue($this->f("firma_titulo"));
        $this->firma_imagen->SetDBValue($this->f("firma_imagen"));
    }
//End SetValues Method

//Update Method @2-50208400
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["nom_usuario"]["Value"] = $this->nom_usuario->GetDBValue(true);
        $this->UpdateFields["log_usuario"]["Value"] = $this->log_usuario->GetDBValue(true);
        $this->UpdateFields["firma_nombre"]["Value"] = $this->firma_nombre->GetDBValue(true);
        $this->UpdateFields["firma_titulo"]["Value"] = $this->firma_titulo->GetDBValue(true);
        $this->UpdateFields["firma_imagen"]["Value"] = $this->firma_imagen->GetDBValue(true);
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

//Initialize Page @1-87039E36
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
$TemplateFileName = "misdatos.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-5D0E00EC
CCSecurityRedirect("3;4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20", "");
//End Authenticate User

//Include events file @1-A961EED7
include_once("./misdatos_events.php");
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
