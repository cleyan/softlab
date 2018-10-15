<?php
//Include Common Files @1-B45D714A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "list_medicos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmedicos_especialidadesSearch { //medicos_especialidadesSearch Class @8-07AF8C59

//Variables @8-9E315808

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

//Class_Initialize Event @8-7F2FB854
    function clsRecordmedicos_especialidadesSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record medicos_especialidadesSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "medicos_especialidadesSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_nom_medico = new clsControl(ccsTextBox, "s_nom_medico", "s_nom_medico", ccsText, "", CCGetRequestParam("s_nom_medico", $Method, NULL), $this);
            $this->s_especialidad_id = new clsControl(ccsListBox, "s_especialidad_id", "s_especialidad_id", ccsText, "", CCGetRequestParam("s_especialidad_id", $Method, NULL), $this);
            $this->s_especialidad_id->DSType = dsTable;
            $this->s_especialidad_id->DataSource = new clsDBDatos();
            $this->s_especialidad_id->ds = & $this->s_especialidad_id->DataSource;
            $this->s_especialidad_id->DataSource->SQL = "SELECT * \n" .
"FROM especialidades {SQL_Where} {SQL_OrderBy}";
            $this->s_especialidad_id->DataSource->Order = "nom_especialidad";
            list($this->s_especialidad_id->BoundColumn, $this->s_especialidad_id->TextColumn, $this->s_especialidad_id->DBFormat) = array("especialidad_id", "nom_especialidad", "");
            $this->s_especialidad_id->DataSource->Order = "nom_especialidad";
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @8-A35AC09C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nom_medico->Validate() && $Validation);
        $Validation = ($this->s_especialidad_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nom_medico->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_especialidad_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @8-289E2460
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nom_medico->Errors->Count());
        $errors = ($errors || $this->s_especialidad_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @8-941A92C4
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "list_medicos.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "list_medicos.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @8-76BDAD20
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

        $this->s_especialidad_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_nom_medico->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_especialidad_id->Errors->ToString());
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

        $this->s_nom_medico->Show();
        $this->s_especialidad_id->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End medicos_especialidadesSearch Class @8-FCB6E20C

class clsGridmedicos_especialidades { //medicos_especialidades class @2-F73175EC

//Variables @2-F4568E4A

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sorter_nom_medico;
    public $Sorter_nom_especialidad;
    public $Sorter_fono;
    public $Sorter_email;
    public $Sorter_activo;
//End Variables

//Class_Initialize Event @2-9A01E8BE
    function clsGridmedicos_especialidades($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "medicos_especialidades";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid medicos_especialidades";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsmedicos_especialidadesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("medicos_especialidadesOrder", "");
        $this->SorterDirection = CCGetParam("medicos_especialidadesDir", "");

        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "add_medicos.php";
        $this->nom_medico = new clsControl(ccsLabel, "nom_medico", "nom_medico", ccsText, "", CCGetRequestParam("nom_medico", ccsGet, NULL), $this);
        $this->nom_especialidad = new clsControl(ccsLabel, "nom_especialidad", "nom_especialidad", ccsText, "", CCGetRequestParam("nom_especialidad", ccsGet, NULL), $this);
        $this->fono = new clsControl(ccsLabel, "fono", "fono", ccsText, "", CCGetRequestParam("fono", ccsGet, NULL), $this);
        $this->email = new clsControl(ccsLabel, "email", "email", ccsText, "", CCGetRequestParam("email", ccsGet, NULL), $this);
        $this->activo = new clsControl(ccsLabel, "activo", "activo", ccsText, "", CCGetRequestParam("activo", ccsGet, NULL), $this);
        $this->medicos_especialidades_TotalRecords = new clsControl(ccsLabel, "medicos_especialidades_TotalRecords", "medicos_especialidades_TotalRecords", ccsText, "", CCGetRequestParam("medicos_especialidades_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_nom_medico = new clsSorter($this->ComponentName, "Sorter_nom_medico", $FileName, $this);
        $this->Sorter_nom_especialidad = new clsSorter($this->ComponentName, "Sorter_nom_especialidad", $FileName, $this);
        $this->Sorter_fono = new clsSorter($this->ComponentName, "Sorter_fono", $FileName, $this);
        $this->Sorter_email = new clsSorter($this->ComponentName, "Sorter_email", $FileName, $this);
        $this->Sorter_activo = new clsSorter($this->ComponentName, "Sorter_activo", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-3646756D
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nom_medico"] = CCGetFromGet("s_nom_medico", NULL);
        $this->DataSource->Parameters["urls_especialidad_id"] = CCGetFromGet("s_especialidad_id", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["nom_medico"] = $this->nom_medico->Visible;
            $this->ControlsVisible["nom_especialidad"] = $this->nom_especialidad->Visible;
            $this->ControlsVisible["fono"] = $this->fono->Visible;
            $this->ControlsVisible["email"] = $this->email->Visible;
            $this->ControlsVisible["activo"] = $this->activo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "medico_id", $this->DataSource->f("medico_id"));
                $this->nom_medico->SetValue($this->DataSource->nom_medico->GetValue());
                $this->nom_especialidad->SetValue($this->DataSource->nom_especialidad->GetValue());
                $this->fono->SetValue($this->DataSource->fono->GetValue());
                $this->email->SetValue($this->DataSource->email->GetValue());
                $this->activo->SetValue($this->DataSource->activo->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ImageLink1->Show();
                $this->nom_medico->Show();
                $this->nom_especialidad->Show();
                $this->fono->Show();
                $this->email->Show();
                $this->activo->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->medicos_especialidades_TotalRecords->Show();
        $this->Sorter_nom_medico->Show();
        $this->Sorter_nom_especialidad->Show();
        $this->Sorter_fono->Show();
        $this->Sorter_email->Show();
        $this->Sorter_activo->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-66DA5F28
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_medico->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_especialidad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->activo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End medicos_especialidades Class @2-FCB6E20C

class clsmedicos_especialidadesDataSource extends clsDBDatos {  //medicos_especialidadesDataSource Class @2-598AAA46

//DataSource Variables @2-CF13AFAB
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nom_medico;
    public $nom_especialidad;
    public $fono;
    public $email;
    public $activo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EEFA8F51
    function clsmedicos_especialidadesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid medicos_especialidades";
        $this->Initialize();
        $this->nom_medico = new clsField("nom_medico", ccsText, "");
        
        $this->nom_especialidad = new clsField("nom_especialidad", ccsText, "");
        
        $this->fono = new clsField("fono", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->activo = new clsField("activo", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-69CCCF2C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_medico" => array("nom_medico", ""), 
            "Sorter_nom_especialidad" => array("nom_especialidad", ""), 
            "Sorter_fono" => array("fono", ""), 
            "Sorter_email" => array("email", ""), 
            "Sorter_activo" => array("medicos.activo", "")));
    }
//End SetOrder Method

//Prepare Method @2-0B9762A3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nom_medico", ccsText, "", "", $this->Parameters["urls_nom_medico"], "", false);
        $this->wp->AddParameter("2", "urls_especialidad_id", ccsText, "", "", $this->Parameters["urls_especialidad_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nom_medico", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "medicos.especialidad_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-6F5D75C5
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM medicos LEFT JOIN especialidades ON\n\n" .
        "medicos.especialidad_id = especialidades.especialidad_id";
        $this->SQL = "SELECT medicos.*, nom_especialidad \n\n" .
        "FROM medicos LEFT JOIN especialidades ON\n\n" .
        "medicos.especialidad_id = especialidades.especialidad_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-4A463A79
    function SetValues()
    {
        $this->nom_medico->SetDBValue($this->f("nom_medico"));
        $this->nom_especialidad->SetDBValue($this->f("nom_especialidad"));
        $this->fono->SetDBValue($this->f("fono"));
        $this->email->SetDBValue($this->f("email"));
        $this->activo->SetDBValue($this->f("activo"));
    }
//End SetValues Method

} //End medicos_especialidadesDataSource Class @2-FCB6E20C

//Initialize Page @1-685D3321
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
$TemplateFileName = "list_medicos.html";
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

//Include events file @1-67998CB0
include_once("./list_medicos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8401CA95
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$medicos_especialidadesSearch = new clsRecordmedicos_especialidadesSearch("", $MainPage);
$medicos_especialidades = new clsGridmedicos_especialidades("", $MainPage);
$ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Page = "add_medicos.php";
$ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $MainPage);
$ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink2->Page = "menu_principal.php";
$MainPage->medicos_especialidadesSearch = & $medicos_especialidadesSearch;
$MainPage->medicos_especialidades = & $medicos_especialidades;
$MainPage->ImageLink1 = & $ImageLink1;
$MainPage->ImageLink2 = & $ImageLink2;
$medicos_especialidades->Initialize();
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

//Execute Components @1-180C8DDC
$medicos_especialidadesSearch->Operation();
//End Execute Components

//Go to destination page @1-D0A977EB
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($medicos_especialidadesSearch);
    unset($medicos_especialidades);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-07C2591D
$medicos_especialidadesSearch->Show();
$medicos_especialidades->Show();
$ImageLink1->Show();
$ImageLink2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-649803C3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($medicos_especialidadesSearch);
unset($medicos_especialidades);
unset($Tpl);
//End Unload Page


?>
