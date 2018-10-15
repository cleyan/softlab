<?php
//Include Common Files @1-A1BD36D5
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "detalle_demoras.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridpeticiones_detalle_test { //peticiones_detalle_test class @2-BA58B5A7

//Variables @2-2D61ABEA

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
    public $AltRowControls;
    public $IsAltRow;
    public $Sorter_codigo_fonasa;
    public $Sorter_nom_test;
    public $Sorter_dias_demora;
//End Variables

//Class_Initialize Event @2-04E1EB18
    function clsGridpeticiones_detalle_test($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_detalle_test";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_detalle_test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_detalle_testDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 1000;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 1000)
            $this->PageSize = 1000;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("peticiones_detalle_testOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_detalle_testDir", "");

        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "codigo_fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->dias_demora = new clsControl(ccsLabel, "dias_demora", "dias_demora", ccsInteger, "", CCGetRequestParam("dias_demora", ccsGet, NULL), $this);
        $this->entrega = new clsControl(ccsLabel, "entrega", "entrega", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("entrega", ccsGet, NULL), $this);
        $this->Alt_codigo_fonasa = new clsControl(ccsLabel, "Alt_codigo_fonasa", "Alt_codigo_fonasa", ccsText, "", CCGetRequestParam("Alt_codigo_fonasa", ccsGet, NULL), $this);
        $this->Alt_nom_test = new clsControl(ccsLabel, "Alt_nom_test", "Alt_nom_test", ccsText, "", CCGetRequestParam("Alt_nom_test", ccsGet, NULL), $this);
        $this->Alt_dias_demora = new clsControl(ccsLabel, "Alt_dias_demora", "Alt_dias_demora", ccsInteger, "", CCGetRequestParam("Alt_dias_demora", ccsGet, NULL), $this);
        $this->Alt_entrega = new clsControl(ccsLabel, "Alt_entrega", "Alt_entrega", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("Alt_entrega", ccsGet, NULL), $this);
        $this->Sorter_codigo_fonasa = new clsSorter($this->ComponentName, "Sorter_codigo_fonasa", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_dias_demora = new clsSorter($this->ComponentName, "Sorter_dias_demora", $FileName, $this);
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink1->Page = "";
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

//Show Method @2-9209C18C
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);

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
            $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            $this->ControlsVisible["dias_demora"] = $this->dias_demora->Visible;
            $this->ControlsVisible["entrega"] = $this->entrega->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->dias_demora->SetValue($this->DataSource->dias_demora->GetValue());
                    $this->entrega->SetValue($this->DataSource->entrega->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->codigo_fonasa->Show();
                    $this->nom_test->Show();
                    $this->dias_demora->Show();
                    $this->entrega->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_codigo_fonasa->SetValue($this->DataSource->Alt_codigo_fonasa->GetValue());
                    $this->Alt_nom_test->SetValue($this->DataSource->Alt_nom_test->GetValue());
                    $this->Alt_dias_demora->SetValue($this->DataSource->Alt_dias_demora->GetValue());
                    $this->Alt_entrega->SetValue($this->DataSource->Alt_entrega->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_codigo_fonasa->Show();
                    $this->Alt_nom_test->Show();
                    $this->Alt_dias_demora->Show();
                    $this->Alt_entrega->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parseto("AltRow", true, "Row");
                }
                $this->IsAltRow = (!$this->IsAltRow);
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
        $this->Sorter_codigo_fonasa->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_dias_demora->Show();
        $this->ImageLink1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4C84CDBF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->dias_demora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->entrega->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_dias_demora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_entrega->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_detalle_test Class @2-FCB6E20C

class clspeticiones_detalle_testDataSource extends clsDBDatos {  //peticiones_detalle_testDataSource Class @2-7CD75560

//DataSource Variables @2-D95624D2
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $codigo_fonasa;
    public $nom_test;
    public $dias_demora;
    public $entrega;
    public $Alt_codigo_fonasa;
    public $Alt_nom_test;
    public $Alt_dias_demora;
    public $Alt_entrega;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-19AE3471
    function clspeticiones_detalle_testDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_detalle_test";
        $this->Initialize();
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->dias_demora = new clsField("dias_demora", ccsInteger, "");
        
        $this->entrega = new clsField("entrega", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
        
        $this->Alt_codigo_fonasa = new clsField("Alt_codigo_fonasa", ccsText, "");
        
        $this->Alt_nom_test = new clsField("Alt_nom_test", ccsText, "");
        
        $this->Alt_dias_demora = new clsField("Alt_dias_demora", ccsInteger, "");
        
        $this->Alt_entrega = new clsField("Alt_entrega", ccsDate, array("yyyy", "-", "mm", "-", "dd"));
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-0ECAD843
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "orden_informe";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_dias_demora" => array("demora", "")));
    }
//End SetOrder Method

//Prepare Method @2-22B7FB8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
    }
//End Prepare Method

//Open Method @2-4B427279
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM peticiones_detalle LEFT JOIN test ON\n" .
        "peticiones_detalle.test_id = test.test_id\n" .
        "WHERE peticiones_detalle.peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "and aislado='V' and decompuesto='F'";
        $this->SQL = "SELECT peticion_id, codigo_fonasa, nom_test, orden_informe, coalesce(dias_demora,0) as demora,\n" .
        "ADDDATE(CURDATE(),INTERVAL coalesce(dias_demora,0) DAY) as entrega\n" .
        "FROM peticiones_detalle LEFT JOIN test ON\n" .
        "peticiones_detalle.test_id = test.test_id\n" .
        "WHERE peticiones_detalle.peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "and aislado='V' and decompuesto='F' {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-7EB0501B
    function SetValues()
    {
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->dias_demora->SetDBValue(trim($this->f("demora")));
        $this->entrega->SetDBValue(trim($this->f("entrega")));
        $this->Alt_codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->Alt_nom_test->SetDBValue($this->f("nom_test"));
        $this->Alt_dias_demora->SetDBValue(trim($this->f("demora")));
        $this->Alt_entrega->SetDBValue(trim($this->f("entrega")));
    }
//End SetValues Method

} //End peticiones_detalle_testDataSource Class @2-FCB6E20C

//Initialize Page @1-8B924BBB
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
$TemplateFileName = "detalle_demoras.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-7B3C2E16
include_once("./detalle_demoras_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-6BDF1919
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_detalle_test = new clsGridpeticiones_detalle_test("", $MainPage);
$MainPage->peticiones_detalle_test = & $peticiones_detalle_test;
$peticiones_detalle_test->Initialize();
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

//Go to destination page @1-CACCB0A6
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_detalle_test);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-D5D4F68E
$peticiones_detalle_test->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-57BEC456
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_detalle_test);
unset($Tpl);
//End Unload Page


?>
