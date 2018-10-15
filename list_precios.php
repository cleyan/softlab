<?php
//Include Common Files @1-49AA5C14
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "list_precios.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordprecios_test_test_procedeSearch { //precios_test_test_procedeSearch Class @32-C8EB684B

//Variables @32-9E315808

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

//Class_Initialize Event @32-4712B75F
    function clsRecordprecios_test_test_procedeSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record precios_test_test_procedeSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "precios_test_test_procedeSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_precios_test_procedencia_id = new clsControl(ccsListBox, "s_precios_test_procedencia_id", "s_precios_test_procedencia_id", ccsInteger, "", CCGetRequestParam("s_precios_test_procedencia_id", $Method, NULL), $this);
            $this->s_precios_test_procedencia_id->DSType = dsTable;
            $this->s_precios_test_procedencia_id->DataSource = new clsDBDatos();
            $this->s_precios_test_procedencia_id->ds = & $this->s_precios_test_procedencia_id->DataSource;
            $this->s_precios_test_procedencia_id->DataSource->SQL = "SELECT * \n" .
"FROM procedencias {SQL_Where} {SQL_OrderBy}";
            list($this->s_precios_test_procedencia_id->BoundColumn, $this->s_precios_test_procedencia_id->TextColumn, $this->s_precios_test_procedencia_id->DBFormat) = array("procedencia_id", "nom_procedencia", "");
            $this->s_precios_test_prevision_id = new clsControl(ccsListBox, "s_precios_test_prevision_id", "s_precios_test_prevision_id", ccsInteger, "", CCGetRequestParam("s_precios_test_prevision_id", $Method, NULL), $this);
            $this->s_precios_test_prevision_id->DSType = dsTable;
            $this->s_precios_test_prevision_id->DataSource = new clsDBDatos();
            $this->s_precios_test_prevision_id->ds = & $this->s_precios_test_prevision_id->DataSource;
            $this->s_precios_test_prevision_id->DataSource->SQL = "SELECT * \n" .
"FROM previsiones {SQL_Where} {SQL_OrderBy}";
            list($this->s_precios_test_prevision_id->BoundColumn, $this->s_precios_test_prevision_id->TextColumn, $this->s_precios_test_prevision_id->DBFormat) = array("prevision_id", "nom_prevision", "");
            $this->s_nom_test = new clsControl(ccsTextBox, "s_nom_test", "s_nom_test", ccsText, "", CCGetRequestParam("s_nom_test", $Method, NULL), $this);
            $this->precios_test_test_procedePageSize = new clsControl(ccsListBox, "precios_test_test_procedePageSize", "precios_test_test_procedePageSize", ccsText, "", CCGetRequestParam("precios_test_test_procedePageSize", $Method, NULL), $this);
            $this->precios_test_test_procedePageSize->DSType = dsListOfValues;
            $this->precios_test_test_procedePageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @32-12678FCB
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_precios_test_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_precios_test_prevision_id->Validate() && $Validation);
        $Validation = ($this->s_nom_test->Validate() && $Validation);
        $Validation = ($this->precios_test_test_procedePageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_precios_test_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_precios_test_prevision_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nom_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->precios_test_test_procedePageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @32-7E5A3D4A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_precios_test_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_precios_test_prevision_id->Errors->Count());
        $errors = ($errors || $this->s_nom_test->Errors->Count());
        $errors = ($errors || $this->precios_test_test_procedePageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @32-539D7B41
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
        $Redirect = "list_precios.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "list_precios.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @32-D0DA5613
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

        $this->s_precios_test_procedencia_id->Prepare();
        $this->s_precios_test_prevision_id->Prepare();
        $this->precios_test_test_procedePageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_precios_test_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_precios_test_prevision_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nom_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->precios_test_test_procedePageSize->Errors->ToString());
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

        $this->s_precios_test_procedencia_id->Show();
        $this->s_precios_test_prevision_id->Show();
        $this->s_nom_test->Show();
        $this->precios_test_test_procedePageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End precios_test_test_procedeSearch Class @32-FCB6E20C

class clsGridprecios_test_test_procede { //precios_test_test_procede class @2-C153DAE9

//Variables @2-51B584CB

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
    public $Sorter_precio;
    public $Sorter_nom_prevision;
    public $Sorter_nom_procedencia;
//End Variables

//Class_Initialize Event @2-72B186F5
    function clsGridprecios_test_test_procede($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "precios_test_test_procede";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid precios_test_test_procede";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsprecios_test_test_procedeDataSource($this);
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
        $this->SorterName = CCGetParam("precios_test_test_procedeOrder", "");
        $this->SorterDirection = CCGetParam("precios_test_test_procedeDir", "");

        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "codigo_fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->precio = new clsControl(ccsLabel, "precio", "precio", ccsInteger, "", CCGetRequestParam("precio", ccsGet, NULL), $this);
        $this->nom_prevision = new clsControl(ccsLabel, "nom_prevision", "nom_prevision", ccsText, "", CCGetRequestParam("nom_prevision", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->Alt_codigo_fonasa = new clsControl(ccsLabel, "Alt_codigo_fonasa", "Alt_codigo_fonasa", ccsText, "", CCGetRequestParam("Alt_codigo_fonasa", ccsGet, NULL), $this);
        $this->Alt_nom_test = new clsControl(ccsLabel, "Alt_nom_test", "Alt_nom_test", ccsText, "", CCGetRequestParam("Alt_nom_test", ccsGet, NULL), $this);
        $this->Alt_precio = new clsControl(ccsLabel, "Alt_precio", "Alt_precio", ccsInteger, "", CCGetRequestParam("Alt_precio", ccsGet, NULL), $this);
        $this->Alt_nom_prevision = new clsControl(ccsLabel, "Alt_nom_prevision", "Alt_nom_prevision", ccsText, "", CCGetRequestParam("Alt_nom_prevision", ccsGet, NULL), $this);
        $this->Alt_nom_procedencia = new clsControl(ccsLabel, "Alt_nom_procedencia", "Alt_nom_procedencia", ccsText, "", CCGetRequestParam("Alt_nom_procedencia", ccsGet, NULL), $this);
        $this->precios_test_test_procede_TotalRecords = new clsControl(ccsLabel, "precios_test_test_procede_TotalRecords", "precios_test_test_procede_TotalRecords", ccsText, "", CCGetRequestParam("precios_test_test_procede_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_codigo_fonasa = new clsSorter($this->ComponentName, "Sorter_codigo_fonasa", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_precio = new clsSorter($this->ComponentName, "Sorter_precio", $FileName, $this);
        $this->Sorter_nom_prevision = new clsSorter($this->ComponentName, "Sorter_nom_prevision", $FileName, $this);
        $this->Sorter_nom_procedencia = new clsSorter($this->ComponentName, "Sorter_nom_procedencia", $FileName, $this);
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

//Show Method @2-CE68CC69
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_precios_test_procedencia_id"] = CCGetFromGet("s_precios_test_procedencia_id", NULL);
        $this->DataSource->Parameters["urls_precios_test_prevision_id"] = CCGetFromGet("s_precios_test_prevision_id", NULL);
        $this->DataSource->Parameters["urls_nom_test"] = CCGetFromGet("s_nom_test", NULL);
        $this->DataSource->Parameters["expr59"] = 'V';

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
            $this->ControlsVisible["precio"] = $this->precio->Visible;
            $this->ControlsVisible["nom_prevision"] = $this->nom_prevision->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
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
                    $this->precio->SetValue($this->DataSource->precio->GetValue());
                    $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                    $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->codigo_fonasa->Show();
                    $this->nom_test->Show();
                    $this->precio->Show();
                    $this->nom_prevision->Show();
                    $this->nom_procedencia->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_codigo_fonasa->SetValue($this->DataSource->Alt_codigo_fonasa->GetValue());
                    $this->Alt_nom_test->SetValue($this->DataSource->Alt_nom_test->GetValue());
                    $this->Alt_precio->SetValue($this->DataSource->Alt_precio->GetValue());
                    $this->Alt_nom_prevision->SetValue($this->DataSource->Alt_nom_prevision->GetValue());
                    $this->Alt_nom_procedencia->SetValue($this->DataSource->Alt_nom_procedencia->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_codigo_fonasa->Show();
                    $this->Alt_nom_test->Show();
                    $this->Alt_precio->Show();
                    $this->Alt_nom_prevision->Show();
                    $this->Alt_nom_procedencia->Show();
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
        $this->precios_test_test_procede_TotalRecords->Show();
        $this->Sorter_codigo_fonasa->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_precio->Show();
        $this->Sorter_nom_prevision->Show();
        $this->Sorter_nom_procedencia->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-A0210D01
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->precio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_precio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End precios_test_test_procede Class @2-FCB6E20C

class clsprecios_test_test_procedeDataSource extends clsDBDatos {  //precios_test_test_procedeDataSource Class @2-244060CE

//DataSource Variables @2-AB2248E1
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
    public $precio;
    public $nom_prevision;
    public $nom_procedencia;
    public $Alt_codigo_fonasa;
    public $Alt_nom_test;
    public $Alt_precio;
    public $Alt_nom_prevision;
    public $Alt_nom_procedencia;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7FEE043B
    function clsprecios_test_test_procedeDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid precios_test_test_procede";
        $this->Initialize();
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->precio = new clsField("precio", ccsInteger, "");
        
        $this->nom_prevision = new clsField("nom_prevision", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->Alt_codigo_fonasa = new clsField("Alt_codigo_fonasa", ccsText, "");
        
        $this->Alt_nom_test = new clsField("Alt_nom_test", ccsText, "");
        
        $this->Alt_precio = new clsField("Alt_precio", ccsInteger, "");
        
        $this->Alt_nom_prevision = new clsField("Alt_nom_prevision", ccsText, "");
        
        $this->Alt_nom_procedencia = new clsField("Alt_nom_procedencia", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-B49A2CD3
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_precio" => array("precio", ""), 
            "Sorter_nom_prevision" => array("nom_prevision", ""), 
            "Sorter_nom_procedencia" => array("nom_procedencia", "")));
    }
//End SetOrder Method

//Prepare Method @2-7132D737
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_precios_test_procedencia_id", ccsInteger, "", "", $this->Parameters["urls_precios_test_procedencia_id"], "", false);
        $this->wp->AddParameter("2", "urls_precios_test_prevision_id", ccsInteger, "", "", $this->Parameters["urls_precios_test_prevision_id"], "", false);
        $this->wp->AddParameter("3", "urls_nom_test", ccsText, "", "", $this->Parameters["urls_nom_test"], "", false);
        $this->wp->AddParameter("4", "expr59", ccsText, "", "", $this->Parameters["expr59"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "precios_test.procedencia_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "precios_test.prevision_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "nom_test", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "test.aislado", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @2-FFA62585
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((precios_test LEFT JOIN test ON\n\n" .
        "precios_test.test_id = test.test_id) LEFT JOIN procedencias ON\n\n" .
        "precios_test.procedencia_id = procedencias.procedencia_id) LEFT JOIN previsiones ON\n\n" .
        "precios_test.prevision_id = previsiones.prevision_id";
        $this->SQL = "SELECT precios_test.procedencia_id AS precios_test_procedencia_id, precios_test.test_id AS precios_test_test_id, precios_test.prevision_id AS precios_test_prevision_id,\n\n" .
        "precio, codigo_fonasa, nom_test, nom_procedencia, nom_prevision \n\n" .
        "FROM ((precios_test LEFT JOIN test ON\n\n" .
        "precios_test.test_id = test.test_id) LEFT JOIN procedencias ON\n\n" .
        "precios_test.procedencia_id = procedencias.procedencia_id) LEFT JOIN previsiones ON\n\n" .
        "precios_test.prevision_id = previsiones.prevision_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CF38724A
    function SetValues()
    {
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->precio->SetDBValue(trim($this->f("precio")));
        $this->nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->Alt_codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->Alt_nom_test->SetDBValue($this->f("nom_test"));
        $this->Alt_precio->SetDBValue(trim($this->f("precio")));
        $this->Alt_nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->Alt_nom_procedencia->SetDBValue($this->f("nom_procedencia"));
    }
//End SetValues Method

} //End precios_test_test_procedeDataSource Class @2-FCB6E20C

//Initialize Page @1-A13670E6
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
$TemplateFileName = "list_precios.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-AA54A103
CCSecurityRedirect("15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-72658737
include_once("./list_precios_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-20578EB0
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$precios_test_test_procedeSearch = new clsRecordprecios_test_test_procedeSearch("", $MainPage);
$precios_test_test_procede = new clsGridprecios_test_test_procede("", $MainPage);
$MainPage->precios_test_test_procedeSearch = & $precios_test_test_procedeSearch;
$MainPage->precios_test_test_procede = & $precios_test_test_procede;
$precios_test_test_procede->Initialize();
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

//Execute Components @1-FF3B8C06
$precios_test_test_procedeSearch->Operation();
//End Execute Components

//Go to destination page @1-BD5EA243
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($precios_test_test_procedeSearch);
    unset($precios_test_test_procede);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B13B8280
$precios_test_test_procedeSearch->Show();
$precios_test_test_procede->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-380BAD48
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($precios_test_test_procedeSearch);
unset($precios_test_test_procede);
unset($Tpl);
//End Unload Page


?>
