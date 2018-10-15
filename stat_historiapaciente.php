<?php
//Include Common Files @1-7F5AAF55
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "stat_historiapaciente.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordresultados_testSearch { //resultados_testSearch Class @49-1BAA75FD

//Variables @49-9E315808

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

//Class_Initialize Event @49-5F386395
    function clsRecordresultados_testSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record resultados_testSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "resultados_testSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->lbl_nom_paciente = new clsControl(ccsLabel, "lbl_nom_paciente", "lbl_nom_paciente", ccsText, "", CCGetRequestParam("lbl_nom_paciente", $Method, NULL), $this);
            $this->s_keyword = new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @49-A144A629
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @49-F4B64A40
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->lbl_nom_paciente->Errors->Count());
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @49-5EB5AC58
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
        $Redirect = "stat_historiapaciente.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "stat_historiapaciente.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_keyword", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @49-A18DB9D3
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->lbl_nom_paciente->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
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

        $this->lbl_nom_paciente->Show();
        $this->s_keyword->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End resultados_testSearch Class @49-FCB6E20C

class clsGridresultados_test { //resultados_test class @37-A41328E7

//Variables @37-72019751

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
    public $Sorter_cod_test;
    public $Sorter_nom_test;
//End Variables

//Class_Initialize Event @37-4DD5E3BF
    function clsGridresultados_test($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "resultados_test";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid resultados_test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsresultados_testDataSource($this);
        $this->ds = & $this->DataSource;
        $this->SorterName = CCGetParam("resultados_testOrder", "");
        $this->SorterDirection = CCGetParam("resultados_testDir", "");

        $this->lnkVerHistoria = new clsControl(ccsImageLink, "lnkVerHistoria", "lnkVerHistoria", ccsText, "", CCGetRequestParam("lnkVerHistoria", ccsGet, NULL), $this);
        $this->lnkVerHistoria->HTML = true;
        $this->lnkVerHistoria->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->lnkVerHistoria->Page = "";
        $this->test_id = new clsControl(ccsHidden, "test_id", "test_id", ccsInteger, "", CCGetRequestParam("test_id", ccsGet, NULL), $this);
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->qty = new clsControl(ccsLabel, "qty", "qty", ccsInteger, "", CCGetRequestParam("qty", ccsGet, NULL), $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Page = "menu_principal.php";
    }
//End Class_Initialize Event

//Initialize Method @37-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @37-20F1E2FC
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
        $this->DataSource->Parameters["urlpaciente_id"] = CCGetFromGet("paciente_id", NULL);

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
            $this->ControlsVisible["lnkVerHistoria"] = $this->lnkVerHistoria->Visible;
            $this->ControlsVisible["test_id"] = $this->test_id->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            $this->ControlsVisible["qty"] = $this->qty->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                $this->qty->SetValue($this->DataSource->qty->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lnkVerHistoria->Show();
                $this->test_id->Show();
                $this->cod_test->Show();
                $this->nom_test->Show();
                $this->qty->Show();
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
        $this->Sorter_cod_test->Show();
        $this->Sorter_nom_test->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @37-5FBFCEB4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lnkVerHistoria->Errors->ToString());
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End resultados_test Class @37-FCB6E20C

class clsresultados_testDataSource extends clsDBDatos {  //resultados_testDataSource Class @37-D7A5118B

//DataSource Variables @37-EFD4C7EC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $test_id;
    public $cod_test;
    public $nom_test;
    public $qty;
//End DataSource Variables

//DataSourceClass_Initialize Event @37-212FE4E6
    function clsresultados_testDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid resultados_test";
        $this->Initialize();
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->qty = new clsField("qty", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @37-75CF4D98
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "cod_test";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_cod_test" => array("cod_test", ""), 
            "Sorter_nom_test" => array("nom_test", "")));
    }
//End SetOrder Method

//Prepare Method @37-55BB5900
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urlpaciente_id", ccsInteger, "", "", $this->Parameters["urlpaciente_id"], 0, false);
    }
//End Prepare Method

//Open Method @37-513574BF
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM (resultados LEFT JOIN peticiones ON\n" .
        "resultados.peticion_id = peticiones.peticion_id) LEFT JOIN test ON\n" .
        "resultados.test_id = test.test_id\n" .
        "WHERE ( test.cod_test LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR test.cod_test LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' )\n" .
        "AND peticiones.paciente_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and test.compuesto='F' and test.aislado='V'\n" .
        "GROUP BY test.test_id, cod_test, nom_test";
        $this->SQL = "SELECT DISTINCT count(*) as qty, test.test_id, cod_test, nom_test FROM (resultados LEFT JOIN peticiones ON\n" .
        "resultados.peticion_id = peticiones.peticion_id) LEFT JOIN test ON\n" .
        "resultados.test_id = test.test_id\n" .
        "WHERE ( test.cod_test LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%'\n" .
        "OR test.cod_test LIKE '%" . $this->SQLValue($this->wp->GetDBValue("1"), ccsText) . "%' )\n" .
        "AND peticiones.paciente_id = " . $this->SQLValue($this->wp->GetDBValue("2"), ccsInteger) . " and test.compuesto='F' and test.aislado='V'\n" .
        "GROUP BY test.test_id, cod_test, nom_test {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @37-7FC1FF07
    function SetValues()
    {
        $this->test_id->SetDBValue(trim($this->f("test_id")));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->qty->SetDBValue(trim($this->f("qty")));
    }
//End SetValues Method

} //End resultados_testDataSource Class @37-FCB6E20C

//Include Page implementation @150-3DD2EFDC
include_once(RelativePath . "/Header.php");
//End Include Page implementation



//Initialize Page @1-A0DA8F8B
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
$TemplateFileName = "stat_historiapaciente.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-A155B45F
include_once("./stat_historiapaciente_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1ADEAE21
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$resultados_testSearch = new clsRecordresultados_testSearch("", $MainPage);
$resultados_test = new clsGridresultados_test("", $MainPage);
$Header = new clsHeader("", "Header", $MainPage);
$Header->Initialize();
$MainPage->resultados_testSearch = & $resultados_testSearch;
$MainPage->resultados_test = & $resultados_test;
$MainPage->Header = & $Header;
$resultados_test->Initialize();
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

//Execute Components @1-808968D0
$Header->Operations();
$resultados_testSearch->Operation();
//End Execute Components

//Go to destination page @1-C52013E4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($resultados_testSearch);
    unset($resultados_test);
    $Header->Class_Terminate();
    unset($Header);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2C9A562D
$resultados_testSearch->Show();
$resultados_test->Show();
$Header->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9AE81738
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($resultados_testSearch);
unset($resultados_test);
$Header->Class_Terminate();
unset($Header);
unset($Tpl);
//End Unload Page


?>
