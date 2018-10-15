<?php
//Include Common Files @1-55CDB9E3
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "elim_informe.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridinformes { //informes class @2-941BB5D0

//Variables @2-6E51DF5A

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
//End Variables

//Class_Initialize Event @2-06829024
    function clsGridinformes($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "informes";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid informes";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinformesDataSource($this);
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

        $this->nom_informe = new clsControl(ccsLabel, "nom_informe", "nom_informe", ccsText, "", CCGetRequestParam("nom_informe", ccsGet, NULL), $this);
        $this->qty_grupo = new clsControl(ccsLink, "qty_grupo", "qty_grupo", ccsInteger, "", CCGetRequestParam("qty_grupo", ccsGet, NULL), $this);
        $this->qty_grupo->Page = "#";
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

//Show Method @2-5A04552E
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlinforme_id"] = CCGetFromGet("informe_id", NULL);

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
            $this->ControlsVisible["nom_informe"] = $this->nom_informe->Visible;
            $this->ControlsVisible["qty_grupo"] = $this->qty_grupo->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                if(!is_array($this->qty_grupo->Value) && !strlen($this->qty_grupo->Value) && $this->qty_grupo->Value !== false)
                    $this->qty_grupo->SetText('0');
                $this->nom_informe->SetValue($this->DataSource->nom_informe->GetValue());
                $this->qty_grupo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->qty_grupo->Parameters = CCAddParam($this->qty_grupo->Parameters, "informe_id", $this->DataSource->f("informe_id"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nom_informe->Show();
                $this->qty_grupo->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-C02D26B4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nom_informe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->qty_grupo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End informes Class @2-FCB6E20C

class clsinformesDataSource extends clsDBDatos {  //informesDataSource Class @2-27A8B5B7

//DataSource Variables @2-E841035A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nom_informe;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-8C40866F
    function clsinformesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid informes";
        $this->Initialize();
        $this->nom_informe = new clsField("nom_informe", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-1E7510A4
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlinforme_id", ccsInteger, "", "", $this->Parameters["urlinforme_id"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "informe_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-1A231B9A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM informes";
        $this->SQL = "SELECT * \n\n" .
        "FROM informes {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-86CFE52D
    function SetValues()
    {
        $this->nom_informe->SetDBValue($this->f("nom_informe"));
    }
//End SetValues Method

} //End informesDataSource Class @2-FCB6E20C

class clsRecordNewRecord1 { //NewRecord1 Class @10-D7EDAFB1

//Variables @10-9E315808

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

//Class_Initialize Event @10-DBBB480A
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
        $this->DataSource = new clsNewRecord1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "NewRecord1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->qty_test = new clsControl(ccsLink, "qty_test", "qty_test", ccsInteger, "", CCGetRequestParam("qty_test", $Method, NULL), $this);
            $this->qty_test->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
            $this->qty_test->Page = "#";
            $this->nom_informe = new clsControl(ccsLabel, "nom_informe", "nom_informe", ccsText, "", CCGetRequestParam("nom_informe", $Method, NULL), $this);
            $this->informe_id = new clsControl(ccsHidden, "informe_id", "informe_id", ccsText, "", CCGetRequestParam("informe_id", $Method, NULL), $this);
            $this->nuevo_informe_id = new clsControl(ccsListBox, "nuevo_informe_id", "nuevo_informe_id", ccsText, "", CCGetRequestParam("nuevo_informe_id", $Method, NULL), $this);
            $this->nuevo_informe_id->DSType = dsTable;
            $this->nuevo_informe_id->DataSource = new clsDBDatos();
            $this->nuevo_informe_id->ds = & $this->nuevo_informe_id->DataSource;
            $this->nuevo_informe_id->DataSource->SQL = "SELECT * \n" .
"FROM informes {SQL_Where} {SQL_OrderBy}";
            list($this->nuevo_informe_id->BoundColumn, $this->nuevo_informe_id->TextColumn, $this->nuevo_informe_id->DBFormat) = array("informe_id", "nom_informe", "");
            $this->nuevo_informe_id->DataSource->Parameters["urlinforme_id"] = CCGetFromGet("informe_id", NULL);
            $this->nuevo_informe_id->DataSource->wp = new clsSQLParameters();
            $this->nuevo_informe_id->DataSource->wp->AddParameter("1", "urlinforme_id", ccsInteger, "", "", $this->nuevo_informe_id->DataSource->Parameters["urlinforme_id"], 0, false);
            $this->nuevo_informe_id->DataSource->wp->Criterion[1] = $this->nuevo_informe_id->DataSource->wp->Operation(opNotEqual, "informe_id", $this->nuevo_informe_id->DataSource->wp->GetDBValue("1"), $this->nuevo_informe_id->DataSource->ToSQL($this->nuevo_informe_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->nuevo_informe_id->DataSource->Where = 
                 $this->nuevo_informe_id->DataSource->wp->Criterion[1];
        }
    }
//End Class_Initialize Event

//Initialize Method @10-059DAC19
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlinforme_id"] = CCGetFromGet("informe_id", NULL);
    }
//End Initialize Method

//Validate Method @10-A4F398EF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->informe_id->Validate() && $Validation);
        $Validation = ($this->nuevo_informe_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->informe_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nuevo_informe_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @10-B21FBD84
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->qty_test->Errors->Count());
        $errors = ($errors || $this->nom_informe->Errors->Count());
        $errors = ($errors || $this->informe_id->Errors->Count());
        $errors = ($errors || $this->nuevo_informe_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @10-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @10-CF176C55
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

        $this->nuevo_informe_id->Prepare();

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
                $this->qty_test->SetValue($this->DataSource->qty_test->GetValue());
                $this->nom_informe->SetValue($this->DataSource->nom_informe->GetValue());
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->qty_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_informe->Errors->ToString());
            $Error = ComposeStrings($Error, $this->informe_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nuevo_informe_id->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->qty_test->Show();
        $this->nom_informe->Show();
        $this->informe_id->Show();
        $this->nuevo_informe_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End NewRecord1 Class @10-FCB6E20C

class clsNewRecord1DataSource extends clsDBDatos {  //NewRecord1DataSource Class @10-5A731400

//DataSource Variables @10-DE33A61B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $qty_test;
    public $nom_informe;
    public $informe_id;
    public $nuevo_informe_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @10-43D813A6
    function clsNewRecord1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record NewRecord1/Error";
        $this->Initialize();
        $this->qty_test = new clsField("qty_test", ccsInteger, "");
        
        $this->nom_informe = new clsField("nom_informe", ccsText, "");
        
        $this->informe_id = new clsField("informe_id", ccsText, "");
        
        $this->nuevo_informe_id = new clsField("nuevo_informe_id", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @10-3706B36A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlinforme_id", ccsInteger, "", "", $this->Parameters["urlinforme_id"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "informe_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @10-BA66769F
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT informes.informe_id AS informes_informe_id, nom_informe \n\n" .
        "FROM informes {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @10-B3A309A2
    function SetValues()
    {
        $this->qty_test->SetDBValue(trim($this->f("qty")));
        $this->nom_informe->SetDBValue($this->f("nom_informe"));
    }
//End SetValues Method

} //End NewRecord1DataSource Class @10-FCB6E20C

//Initialize Page @1-86031B45
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
$TemplateFileName = "elim_informe.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-1C6D62C5
CCSecurityRedirect("16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-4EF2640B
include_once("./elim_informe_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-BA19CC47
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$informe_id = new clsControl(ccsLabel, "informe_id", "informe_id", ccsText, "", CCGetRequestParam("informe_id", ccsGet, NULL), $MainPage);
$informe_id->HTML = true;
$alt_informe_id = new clsControl(ccsLabel, "alt_informe_id", "alt_informe_id", ccsText, "", CCGetRequestParam("alt_informe_id", ccsGet, NULL), $MainPage);
$alt_informe_id->HTML = true;
$informes = new clsGridinformes("", $MainPage);
$NewRecord1 = new clsRecordNewRecord1("", $MainPage);
$MainPage->informe_id = & $informe_id;
$MainPage->alt_informe_id = & $alt_informe_id;
$MainPage->informes = & $informes;
$MainPage->NewRecord1 = & $NewRecord1;
if(!is_array($informe_id->Value) && !strlen($informe_id->Value) && $informe_id->Value !== false)
    $informe_id->SetText(CCGetParam("informe_id",""));
if(!is_array($alt_informe_id->Value) && !strlen($alt_informe_id->Value) && $alt_informe_id->Value !== false)
    $alt_informe_id->SetText(CCGetParam("informe_id",""));
$informes->Initialize();
$NewRecord1->Initialize();
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

//Go to destination page @1-73A2F29A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($informes);
    unset($NewRecord1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-1C95E18D
$informes->Show();
$NewRecord1->Show();
$informe_id->Show();
$alt_informe_id->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5024E6AB
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($informes);
unset($NewRecord1);
unset($Tpl);
//End Unload Page


?>
