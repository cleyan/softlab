<?php
//Include Common Files @1-56EC8E78
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "modificar_precios_desde_respaldo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecords_fecha { //s_fecha Class @25-8ABB9BB8

//Variables @25-9E315808

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

//Class_Initialize Event @25-ECAEE547
    function clsRecords_fecha($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record s_fecha/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "s_fecha";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_fecha = new clsControl(ccsListBox, "s_fecha", "s_fecha", ccsText, "", CCGetRequestParam("s_fecha", $Method, NULL), $this);
            $this->s_fecha->DSType = dsListOfValues;
            $this->s_fecha->Values = array(array("", "seleccionar fecha"));
            $this->respaldos_precios_test_tePageSize = new clsControl(ccsListBox, "respaldos_precios_test_tePageSize", "respaldos_precios_test_tePageSize", ccsText, "", CCGetRequestParam("respaldos_precios_test_tePageSize", $Method, NULL), $this);
            $this->respaldos_precios_test_tePageSize->DSType = dsListOfValues;
            $this->respaldos_precios_test_tePageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->bt_cambiaFecha = new clsButton("bt_cambiaFecha", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @25-8C6C9808
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_fecha->Validate() && $Validation);
        $Validation = ($this->respaldos_precios_test_tePageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_fecha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->respaldos_precios_test_tePageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @25-12B31F27
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_fecha->Errors->Count());
        $errors = ($errors || $this->respaldos_precios_test_tePageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @25-F5B290AB
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
            } else if($this->bt_cambiaFecha->Pressed) {
                $this->PressedButton = "bt_cambiaFecha";
            }
        }
        $Redirect = "modificar_precios_desde_respaldo.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "modificar_precios_desde_respaldo.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "bt_cambiaFecha", "bt_cambiaFecha_x", "bt_cambiaFecha_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "bt_cambiaFecha") {
                if(!CCGetEvent($this->bt_cambiaFecha->CCSEvents, "OnClick", $this->bt_cambiaFecha)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @25-9DA16A67
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

        $this->s_fecha->Prepare();
        $this->respaldos_precios_test_tePageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->respaldos_precios_test_tePageSize->Errors->ToString());
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

        $this->s_fecha->Show();
        $this->respaldos_precios_test_tePageSize->Show();
        $this->Button_DoSearch->Show();
        $this->bt_cambiaFecha->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End s_fecha Class @25-FCB6E20C

class clsGridrespaldos_precios_test_te { //respaldos_precios_test_te class @2-1DBC8289

//Variables @2-2F997736

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
    public $Sorter_nom_test;
    public $Sorter_nom_prevision;
    public $Sorter_nom_procedencia;
    public $Sorter_precio;
//End Variables

//Class_Initialize Event @2-C3836BBF
    function clsGridrespaldos_precios_test_te($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "respaldos_precios_test_te";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid respaldos_precios_test_te";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsrespaldos_precios_test_teDataSource($this);
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
        $this->SorterName = CCGetParam("respaldos_precios_test_teOrder", "");
        $this->SorterDirection = CCGetParam("respaldos_precios_test_teDir", "");

        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->nom_prevision = new clsControl(ccsLabel, "nom_prevision", "nom_prevision", ccsText, "", CCGetRequestParam("nom_prevision", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->precio = new clsControl(ccsLabel, "precio", "precio", ccsInteger, array(False, 0, Null, Null, False, "\$", "", 1, True, ""), CCGetRequestParam("precio", ccsGet, NULL), $this);
        $this->Alt_nom_test = new clsControl(ccsLabel, "Alt_nom_test", "Alt_nom_test", ccsText, "", CCGetRequestParam("Alt_nom_test", ccsGet, NULL), $this);
        $this->Alt_nom_prevision = new clsControl(ccsLabel, "Alt_nom_prevision", "Alt_nom_prevision", ccsText, "", CCGetRequestParam("Alt_nom_prevision", ccsGet, NULL), $this);
        $this->Alt_nom_procedencia = new clsControl(ccsLabel, "Alt_nom_procedencia", "Alt_nom_procedencia", ccsText, "", CCGetRequestParam("Alt_nom_procedencia", ccsGet, NULL), $this);
        $this->Alt_precio = new clsControl(ccsLabel, "Alt_precio", "Alt_precio", ccsInteger, array(False, 0, Null, Null, False, "\$", "", 1, True, ""), CCGetRequestParam("Alt_precio", ccsGet, NULL), $this);
        $this->respaldos_precios_test_te_TotalRecords = new clsControl(ccsLabel, "respaldos_precios_test_te_TotalRecords", "respaldos_precios_test_te_TotalRecords", ccsText, "", CCGetRequestParam("respaldos_precios_test_te_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_nom_prevision = new clsSorter($this->ComponentName, "Sorter_nom_prevision", $FileName, $this);
        $this->Sorter_nom_procedencia = new clsSorter($this->ComponentName, "Sorter_nom_procedencia", $FileName, $this);
        $this->Sorter_precio = new clsSorter($this->ComponentName, "Sorter_precio", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
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

//Show Method @2-629209C0
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_fecha"] = CCGetFromGet("s_fecha", NULL);

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
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            $this->ControlsVisible["nom_prevision"] = $this->nom_prevision->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
            $this->ControlsVisible["precio"] = $this->precio->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                    $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                    $this->precio->SetValue($this->DataSource->precio->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->nom_test->Show();
                    $this->nom_prevision->Show();
                    $this->nom_procedencia->Show();
                    $this->precio->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_nom_test->SetValue($this->DataSource->Alt_nom_test->GetValue());
                    $this->Alt_nom_prevision->SetValue($this->DataSource->Alt_nom_prevision->GetValue());
                    $this->Alt_nom_procedencia->SetValue($this->DataSource->Alt_nom_procedencia->GetValue());
                    $this->Alt_precio->SetValue($this->DataSource->Alt_precio->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_nom_test->Show();
                    $this->Alt_nom_prevision->Show();
                    $this->Alt_nom_procedencia->Show();
                    $this->Alt_precio->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->respaldos_precios_test_te_TotalRecords->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_nom_prevision->Show();
        $this->Sorter_nom_procedencia->Show();
        $this->Sorter_precio->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-3DFD28B1
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->precio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_precio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End respaldos_precios_test_te Class @2-FCB6E20C

class clsrespaldos_precios_test_teDataSource extends clsDBDatos {  //respaldos_precios_test_teDataSource Class @2-EADCD51C

//DataSource Variables @2-E6317F5B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nom_test;
    public $nom_prevision;
    public $nom_procedencia;
    public $precio;
    public $Alt_nom_test;
    public $Alt_nom_prevision;
    public $Alt_nom_procedencia;
    public $Alt_precio;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-250AB9D7
    function clsrespaldos_precios_test_teDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid respaldos_precios_test_te";
        $this->Initialize();
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->nom_prevision = new clsField("nom_prevision", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->precio = new clsField("precio", ccsInteger, "");
        
        $this->Alt_nom_test = new clsField("Alt_nom_test", ccsText, "");
        
        $this->Alt_nom_prevision = new clsField("Alt_nom_prevision", ccsText, "");
        
        $this->Alt_nom_procedencia = new clsField("Alt_nom_procedencia", ccsText, "");
        
        $this->Alt_precio = new clsField("Alt_precio", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-3998636B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "nom_test";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_nom_prevision" => array("nom_prevision", ""), 
            "Sorter_nom_procedencia" => array("nom_procedencia", ""), 
            "Sorter_precio" => array("precio", "")));
    }
//End SetOrder Method

//Prepare Method @2-35A76F17
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->Parameters["urls_fecha"], '0000-00-00 00:00:00', false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "fecha", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsDate),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-B9765714
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((respaldos_precios_test INNER JOIN test ON\n\n" .
        "respaldos_precios_test.test_id = test.test_id) INNER JOIN previsiones ON\n\n" .
        "respaldos_precios_test.prevision_id = previsiones.prevision_id) INNER JOIN procedencias ON\n\n" .
        "respaldos_precios_test.procedencia_id = procedencias.procedencia_id";
        $this->SQL = "SELECT respaldos_precios_test.*, nom_test, nom_prevision, nom_procedencia \n\n" .
        "FROM ((respaldos_precios_test INNER JOIN test ON\n\n" .
        "respaldos_precios_test.test_id = test.test_id) INNER JOIN previsiones ON\n\n" .
        "respaldos_precios_test.prevision_id = previsiones.prevision_id) INNER JOIN procedencias ON\n\n" .
        "respaldos_precios_test.procedencia_id = procedencias.procedencia_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-04CDD8D6
    function SetValues()
    {
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->precio->SetDBValue(trim($this->f("precio")));
        $this->Alt_nom_test->SetDBValue($this->f("nom_test"));
        $this->Alt_nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->Alt_nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->Alt_precio->SetDBValue(trim($this->f("precio")));
    }
//End SetValues Method

} //End respaldos_precios_test_teDataSource Class @2-FCB6E20C

//Initialize Page @1-F44071B0
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
$TemplateFileName = "modificar_precios_desde_respaldo.html";
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

//Include events file @1-AA182A64
include_once("./modificar_precios_desde_respaldo_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FCA086C8
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$s_fecha = new clsRecords_fecha("", $MainPage);
$respaldos_precios_test_te = new clsGridrespaldos_precios_test_te("", $MainPage);
$MainPage->s_fecha = & $s_fecha;
$MainPage->respaldos_precios_test_te = & $respaldos_precios_test_te;
$respaldos_precios_test_te->Initialize();
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

//Execute Components @1-18B6377B
$s_fecha->Operation();
//End Execute Components

//Go to destination page @1-CE560CC0
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($s_fecha);
    unset($respaldos_precios_test_te);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-99C2D93D
$s_fecha->Show();
$respaldos_precios_test_te->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D27A9D4E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($s_fecha);
unset($respaldos_precios_test_te);
unset($Tpl);
//End Unload Page


?>
