<?php
//Include Common Files @1-E293D804
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "edit_precios_test.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordprecios_test_testSearch { //precios_test_testSearch Class @12-316AC272

//Variables @12-9E315808

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

//Class_Initialize Event @12-82CD5253
    function clsRecordprecios_test_testSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record precios_test_testSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "precios_test_testSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_codigo_fonasa = new clsControl(ccsTextBox, "s_codigo_fonasa", "s_codigo_fonasa", ccsText, "", CCGetRequestParam("s_codigo_fonasa", $Method, NULL), $this);
            $this->s_cod_test = new clsControl(ccsTextBox, "s_cod_test", "s_cod_test", ccsText, "", CCGetRequestParam("s_cod_test", $Method, NULL), $this);
            $this->s_prevision_id = new clsControl(ccsListBox, "s_prevision_id", "s_prevision_id", ccsInteger, "", CCGetRequestParam("s_prevision_id", $Method, NULL), $this);
            $this->s_prevision_id->DSType = dsTable;
            $this->s_prevision_id->DataSource = new clsDBDatos();
            $this->s_prevision_id->ds = & $this->s_prevision_id->DataSource;
            $this->s_prevision_id->DataSource->SQL = "SELECT * \n" .
"FROM previsiones {SQL_Where} {SQL_OrderBy}";
            list($this->s_prevision_id->BoundColumn, $this->s_prevision_id->TextColumn, $this->s_prevision_id->DBFormat) = array("prevision_id", "nom_prevision", "");
            $this->s_procedencia_id = new clsControl(ccsListBox, "s_procedencia_id", "s_procedencia_id", ccsText, "", CCGetRequestParam("s_procedencia_id", $Method, NULL), $this);
            $this->s_procedencia_id->DSType = dsTable;
            $this->s_procedencia_id->DataSource = new clsDBDatos();
            $this->s_procedencia_id->ds = & $this->s_procedencia_id->DataSource;
            $this->s_procedencia_id->DataSource->SQL = "SELECT * \n" .
"FROM procedencias {SQL_Where} {SQL_OrderBy}";
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            list($this->s_procedencia_id->BoundColumn, $this->s_procedencia_id->TextColumn, $this->s_procedencia_id->DBFormat) = array("procedencia_id", "nom_procedencia", "");
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            $this->s_nom_test = new clsControl(ccsTextBox, "s_nom_test", "s_nom_test", ccsText, "", CCGetRequestParam("s_nom_test", $Method, NULL), $this);
            $this->precios_test_testPageSize = new clsControl(ccsListBox, "precios_test_testPageSize", "precios_test_testPageSize", ccsText, "", CCGetRequestParam("precios_test_testPageSize", $Method, NULL), $this);
            $this->precios_test_testPageSize->DSType = dsListOfValues;
            $this->precios_test_testPageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @12-D7876D8F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_codigo_fonasa->Validate() && $Validation);
        $Validation = ($this->s_cod_test->Validate() && $Validation);
        $Validation = ($this->s_prevision_id->Validate() && $Validation);
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_nom_test->Validate() && $Validation);
        $Validation = ($this->precios_test_testPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_codigo_fonasa->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_cod_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_prevision_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nom_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->precios_test_testPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @12-317079C7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_codigo_fonasa->Errors->Count());
        $errors = ($errors || $this->s_cod_test->Errors->Count());
        $errors = ($errors || $this->s_prevision_id->Errors->Count());
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_nom_test->Errors->Count());
        $errors = ($errors || $this->precios_test_testPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @12-32B17B42
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
        $Redirect = "edit_precios_test.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "edit_precios_test.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @12-F64D777B
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

        $this->s_prevision_id->Prepare();
        $this->s_procedencia_id->Prepare();
        $this->precios_test_testPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_codigo_fonasa->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_cod_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_prevision_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nom_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->precios_test_testPageSize->Errors->ToString());
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

        $this->s_codigo_fonasa->Show();
        $this->s_cod_test->Show();
        $this->s_prevision_id->Show();
        $this->s_procedencia_id->Show();
        $this->s_nom_test->Show();
        $this->precios_test_testPageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End precios_test_testSearch Class @12-FCB6E20C

class clsEditableGridprecios_test_test { //precios_test_test Class @2-2082A0A0

//Variables @2-28B3F431

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;

    // Class variables
    public $Sorter_codigo_fonasa;
    public $Sorter_nom_test;
    public $Sorter_nom_procedencia;
    public $Sorter_nom_prevision;
    public $Sorter_precio;
//End Variables

//Class_Initialize Event @2-CA2F5585
    function clsEditableGridprecios_test_test($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid precios_test_test/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "precios_test_test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["precio_test_id"][0] = "precio_test_id";
        $this->DataSource = new clsprecios_test_testDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 0;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->SorterName = CCGetParam("precios_test_testOrder", "");
        $this->SorterDirection = CCGetParam("precios_test_testDir", "");

        $this->precios_test_test_TotalRecords = new clsControl(ccsLabel, "precios_test_test_TotalRecords", "precios_test_test_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_codigo_fonasa = new clsSorter($this->ComponentName, "Sorter_codigo_fonasa", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_nom_procedencia = new clsSorter($this->ComponentName, "Sorter_nom_procedencia", $FileName, $this);
        $this->Sorter_nom_prevision = new clsSorter($this->ComponentName, "Sorter_nom_prevision", $FileName, $this);
        $this->Sorter_precio = new clsSorter($this->ComponentName, "Sorter_precio", $FileName, $this);
        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "Codigo Fonasa", ccsText, "", NULL, $this);
        $this->test_id = new clsControl(ccsHidden, "test_id", "Test Id", ccsInteger, "", NULL, $this);
        $this->prevision_id = new clsControl(ccsHidden, "prevision_id", "Prevision Id", ccsInteger, "", NULL, $this);
        $this->precio_test_id = new clsControl(ccsHidden, "precio_test_id", "Precio Test Id", ccsInteger, "", NULL, $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "Nom Test", ccsText, "", NULL, $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", NULL, $this);
        $this->nom_prevision = new clsControl(ccsLabel, "nom_prevision", "nom_prevision", ccsText, "", NULL, $this);
        $this->precio = new clsControl(ccsTextBox, "precio", "Precio", ccsInteger, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-23090044
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_prevision_id"] = CCGetFromGet("s_prevision_id", NULL);
        $this->DataSource->Parameters["urls_codigo_fonasa"] = CCGetFromGet("s_codigo_fonasa", NULL);
        $this->DataSource->Parameters["urls_cod_test"] = CCGetFromGet("s_cod_test", NULL);
        $this->DataSource->Parameters["urls_nom_test"] = CCGetFromGet("s_nom_test", NULL);
        $this->DataSource->Parameters["urls_procedencia_id"] = CCGetFromGet("s_procedencia_id", NULL);
        $this->DataSource->Parameters["expr112"] = 'V';
    }
//End Initialize Method

//GetFormParameters Method @2-0911FF3D
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["test_id"][$RowNumber] = CCGetFromPost("test_id_" . $RowNumber, NULL);
            $this->FormParameters["prevision_id"][$RowNumber] = CCGetFromPost("prevision_id_" . $RowNumber, NULL);
            $this->FormParameters["precio_test_id"][$RowNumber] = CCGetFromPost("precio_test_id_" . $RowNumber, NULL);
            $this->FormParameters["precio"][$RowNumber] = CCGetFromPost("precio_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-CD7D01C7
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["precio_test_id"] = $this->CachedColumns["precio_test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->prevision_id->SetText($this->FormParameters["prevision_id"][$this->RowNumber], $this->RowNumber);
            $this->precio_test_id->SetText($this->FormParameters["precio_test_id"][$this->RowNumber], $this->RowNumber);
            $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @2-5932E078
    function ValidateRow()
    {
        global $CCSLocales;
        $this->test_id->Validate();
        $this->prevision_id->Validate();
        $this->precio_test_id->Validate();
        $this->precio->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->prevision_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->precio_test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->precio->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->test_id->Errors->Clear();
        $this->prevision_id->Errors->Clear();
        $this->precio_test_id->Errors->Clear();
        $this->precio->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-DB281859
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["test_id"][$this->RowNumber]) && count($this->FormParameters["test_id"][$this->RowNumber])) || strlen($this->FormParameters["test_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["prevision_id"][$this->RowNumber]) && count($this->FormParameters["prevision_id"][$this->RowNumber])) || strlen($this->FormParameters["prevision_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["precio_test_id"][$this->RowNumber]) && count($this->FormParameters["precio_test_id"][$this->RowNumber])) || strlen($this->FormParameters["precio_test_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["precio"][$this->RowNumber]) && count($this->FormParameters["precio"][$this->RowNumber])) || strlen($this->FormParameters["precio"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @2-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-6B923CC2
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-81268AF4
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["precio_test_id"] = $this->CachedColumns["precio_test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->prevision_id->SetText($this->FormParameters["prevision_id"][$this->RowNumber], $this->RowNumber);
            $this->precio_test_id->SetText($this->FormParameters["precio_test_id"][$this->RowNumber], $this->RowNumber);
            $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @2-5B47DF8E
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->prevision_id->SetValue($this->prevision_id->GetValue(true));
        $this->DataSource->precio->SetValue($this->precio->GetValue(true));
        $this->DataSource->precio_test_id->SetValue($this->precio_test_id->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @2-A91BA15B
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->prevision_id->SetValue($this->prevision_id->GetValue(true));
        $this->DataSource->precio->SetValue($this->precio->GetValue(true));
        $this->DataSource->precio_test_id->SetValue($this->precio_test_id->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @2-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @2-AA2B5A0D
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var precios_test_testElements;\n";
        $script .= "var precios_test_testEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "test_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "prevision_idID = 1;\n";
        $script .= "var " . $this->ComponentName . "precio_test_idID = 2;\n";
        $script .= "var " . $this->ComponentName . "precioID = 3;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 4;\n";
        $script .= "\nfunction initprecios_test_testElements() {\n";
        $script .= "\tvar ED = document.forms[\"precios_test_test\"];\n";
        $script .= "\tprecios_test_testElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.test_id_" . $i . ", " . "ED.prevision_id_" . $i . ", " . "ED.precio_test_id_" . $i . ", " . "ED.precio_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-D2DC3AF3
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["precio_test_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["precio_test_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-C47B2816
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["precio_test_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-8F8DA24F
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
        $this->ControlsVisible["test_id"] = $this->test_id->Visible;
        $this->ControlsVisible["prevision_id"] = $this->prevision_id->Visible;
        $this->ControlsVisible["precio_test_id"] = $this->precio_test_id->Visible;
        $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
        $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
        $this->ControlsVisible["nom_prevision"] = $this->nom_prevision->Visible;
        $this->ControlsVisible["precio"] = $this->precio->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["precio_test_id"][$this->RowNumber] = $this->DataSource->CachedColumns["precio_test_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                    $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                    $this->prevision_id->SetValue($this->DataSource->prevision_id->GetValue());
                    $this->precio_test_id->SetValue($this->DataSource->precio_test_id->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                    $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                    $this->precio->SetValue($this->DataSource->precio->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->codigo_fonasa->SetText("");
                    $this->nom_test->SetText("");
                    $this->nom_procedencia->SetText("");
                    $this->nom_prevision->SetText("");
                    $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                    $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->prevision_id->SetText($this->FormParameters["prevision_id"][$this->RowNumber], $this->RowNumber);
                    $this->precio_test_id->SetText($this->FormParameters["precio_test_id"][$this->RowNumber], $this->RowNumber);
                    $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["precio_test_id"][$this->RowNumber] = "";
                    $this->codigo_fonasa->SetText("");
                    $this->test_id->SetText("");
                    $this->prevision_id->SetText("");
                    $this->precio_test_id->SetText("");
                    $this->nom_test->SetText("");
                    $this->nom_procedencia->SetText("");
                    $this->nom_prevision->SetText("");
                    $this->precio->SetText("");
                } else {
                    $this->codigo_fonasa->SetText("");
                    $this->nom_test->SetText("");
                    $this->nom_procedencia->SetText("");
                    $this->nom_prevision->SetText("");
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->prevision_id->SetText($this->FormParameters["prevision_id"][$this->RowNumber], $this->RowNumber);
                    $this->precio_test_id->SetText($this->FormParameters["precio_test_id"][$this->RowNumber], $this->RowNumber);
                    $this->precio->SetText($this->FormParameters["precio"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->codigo_fonasa->Show($this->RowNumber);
                $this->test_id->Show($this->RowNumber);
                $this->prevision_id->Show($this->RowNumber);
                $this->precio_test_id->Show($this->RowNumber);
                $this->nom_test->Show($this->RowNumber);
                $this->nom_procedencia->Show($this->RowNumber);
                $this->nom_prevision->Show($this->RowNumber);
                $this->precio->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["precio_test_id"] == $this->CachedColumns["precio_test_id"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->precios_test_test_TotalRecords->Show();
        $this->Sorter_codigo_fonasa->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_nom_procedencia->Show();
        $this->Sorter_nom_prevision->Show();
        $this->Sorter_precio->Show();
        $this->Navigator->Show();
        $this->Button_Submit->Show();
        $this->Cancel->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End precios_test_test Class @2-FCB6E20C

class clsprecios_test_testDataSource extends clsDBDatos {  //precios_test_testDataSource Class @2-54B069D9

//DataSource Variables @2-CCC4C845
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $codigo_fonasa;
    public $test_id;
    public $prevision_id;
    public $precio_test_id;
    public $nom_test;
    public $nom_procedencia;
    public $nom_prevision;
    public $precio;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-36981DE0
    function clsprecios_test_testDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid precios_test_test/Error";
        $this->Initialize();
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->prevision_id = new clsField("prevision_id", ccsInteger, "");
        
        $this->precio_test_id = new clsField("precio_test_id", ccsInteger, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->nom_prevision = new clsField("nom_prevision", ccsText, "");
        
        $this->precio = new clsField("precio", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["prevision_id"] = array("Name" => "prevision_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["precio"] = array("Name" => "precio", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["precio_test_id"] = array("Name" => "precio_test_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["prevision_id"] = array("Name" => "prevision_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["precio"] = array("Name" => "precio", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["precio_test_id"] = array("Name" => "precio_test_id", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-49FFB6C9
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "codigo_fonasa, cod_test, nom_test, nom_prevision";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_nom_procedencia" => array("nom_procedencia", ""), 
            "Sorter_nom_prevision" => array("nom_prevision", ""), 
            "Sorter_precio" => array("precio", "")));
    }
//End SetOrder Method

//Prepare Method @2-12DFAA9E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_prevision_id", ccsInteger, "", "", $this->Parameters["urls_prevision_id"], "", false);
        $this->wp->AddParameter("2", "urls_codigo_fonasa", ccsText, "", "", $this->Parameters["urls_codigo_fonasa"], "", false);
        $this->wp->AddParameter("3", "urls_cod_test", ccsText, "", "", $this->Parameters["urls_cod_test"], "", false);
        $this->wp->AddParameter("4", "urls_nom_test", ccsText, "", "", $this->Parameters["urls_nom_test"], "", false);
        $this->wp->AddParameter("5", "urls_procedencia_id", ccsInteger, "", "", $this->Parameters["urls_procedencia_id"], "", false);
        $this->wp->AddParameter("6", "expr112", ccsText, "", "", $this->Parameters["expr112"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "precios_test.prevision_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "codigo_fonasa", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "cod_test", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "nom_test", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "precios_test.procedencia_id", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsInteger),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "test.aislado", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]);
    }
//End Prepare Method

//Open Method @2-EEDA66A8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((precios_test LEFT JOIN test ON\n\n" .
        "precios_test.test_id = test.test_id) LEFT JOIN previsiones ON\n\n" .
        "precios_test.prevision_id = previsiones.prevision_id) LEFT JOIN procedencias ON\n\n" .
        "precios_test.procedencia_id = procedencias.procedencia_id";
        $this->SQL = "SELECT precios_test.*, codigo_fonasa, cod_test, nom_test, nom_prevision, nom_procedencia \n\n" .
        "FROM ((precios_test LEFT JOIN test ON\n\n" .
        "precios_test.test_id = test.test_id) LEFT JOIN previsiones ON\n\n" .
        "precios_test.prevision_id = previsiones.prevision_id) LEFT JOIN procedencias ON\n\n" .
        "precios_test.procedencia_id = procedencias.procedencia_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-09F0CEFE
    function SetValues()
    {
        $this->CachedColumns["precio_test_id"] = $this->f("precio_test_id");
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->test_id->SetDBValue(trim($this->f("test_id")));
        $this->prevision_id->SetDBValue(trim($this->f("prevision_id")));
        $this->precio_test_id->SetDBValue(trim($this->f("precio_test_id")));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->precio->SetDBValue(trim($this->f("precio")));
    }
//End SetValues Method

//Insert Method @2-9219692C
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["test_id"] = new clsSQLParameter("ctrltest_id", ccsInteger, "", "", $this->test_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["prevision_id"] = new clsSQLParameter("ctrlprevision_id", ccsInteger, "", "", $this->prevision_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["precio"] = new clsSQLParameter("ctrlprecio", ccsInteger, "", "", $this->precio->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["precio_test_id"] = new clsSQLParameter("ctrlprecio_test_id", ccsInteger, "", "", $this->precio_test_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue($this->test_id->GetValue(true));
        if (!is_null($this->cp["prevision_id"]->GetValue()) and !strlen($this->cp["prevision_id"]->GetText()) and !is_bool($this->cp["prevision_id"]->GetValue())) 
            $this->cp["prevision_id"]->SetValue($this->prevision_id->GetValue(true));
        if (!is_null($this->cp["precio"]->GetValue()) and !strlen($this->cp["precio"]->GetText()) and !is_bool($this->cp["precio"]->GetValue())) 
            $this->cp["precio"]->SetValue($this->precio->GetValue(true));
        if (!is_null($this->cp["precio_test_id"]->GetValue()) and !strlen($this->cp["precio_test_id"]->GetText()) and !is_bool($this->cp["precio_test_id"]->GetValue())) 
            $this->cp["precio_test_id"]->SetValue($this->precio_test_id->GetValue(true));
        $this->InsertFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->InsertFields["prevision_id"]["Value"] = $this->cp["prevision_id"]->GetDBValue(true);
        $this->InsertFields["precio"]["Value"] = $this->cp["precio"]->GetDBValue(true);
        $this->InsertFields["precio_test_id"]["Value"] = $this->cp["precio_test_id"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("precios_test", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-BAF0EB7C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["test_id"] = new clsSQLParameter("ctrltest_id", ccsInteger, "", "", $this->test_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["prevision_id"] = new clsSQLParameter("ctrlprevision_id", ccsInteger, "", "", $this->prevision_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["precio"] = new clsSQLParameter("ctrlprecio", ccsInteger, "", "", $this->precio->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["precio_test_id"] = new clsSQLParameter("ctrlprecio_test_id", ccsInteger, "", "", $this->precio_test_id->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsprecio_test_id", ccsInteger, "", "", $this->CachedColumns["precio_test_id"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue($this->test_id->GetValue(true));
        if (!is_null($this->cp["prevision_id"]->GetValue()) and !strlen($this->cp["prevision_id"]->GetText()) and !is_bool($this->cp["prevision_id"]->GetValue())) 
            $this->cp["prevision_id"]->SetValue($this->prevision_id->GetValue(true));
        if (!is_null($this->cp["precio"]->GetValue()) and !strlen($this->cp["precio"]->GetText()) and !is_bool($this->cp["precio"]->GetValue())) 
            $this->cp["precio"]->SetValue($this->precio->GetValue(true));
        if (!is_null($this->cp["precio_test_id"]->GetValue()) and !strlen($this->cp["precio_test_id"]->GetText()) and !is_bool($this->cp["precio_test_id"]->GetValue())) 
            $this->cp["precio_test_id"]->SetValue($this->precio_test_id->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "precio_test_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->UpdateFields["prevision_id"]["Value"] = $this->cp["prevision_id"]->GetDBValue(true);
        $this->UpdateFields["precio"]["Value"] = $this->cp["precio"]->GetDBValue(true);
        $this->UpdateFields["precio_test_id"]["Value"] = $this->cp["precio_test_id"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("precios_test", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-2804F60A
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "dsprecio_test_id", ccsInteger, "", "", $this->CachedColumns["precio_test_id"], "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $wp->Criterion[1] = $wp->Operation(opEqual, "precio_test_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->SQL = "DELETE FROM precios_test";
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End precios_test_testDataSource Class @2-FCB6E20C





//Initialize Page @1-6BA5374C
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
$TemplateFileName = "edit_precios_test.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-1C6D62C5
CCSecurityRedirect("16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-91D8A720
include_once("./edit_precios_test_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4C21657A
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$precios_test_testSearch = new clsRecordprecios_test_testSearch("", $MainPage);
$precios_test_test = new clsEditableGridprecios_test_test("", $MainPage);
$MainPage->precios_test_testSearch = & $precios_test_testSearch;
$MainPage->precios_test_test = & $precios_test_test;
$precios_test_test->Initialize();
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

//Execute Components @1-9F199575
$precios_test_test->Operation();
$precios_test_testSearch->Operation();
//End Execute Components

//Go to destination page @1-B366545C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($precios_test_testSearch);
    unset($precios_test_test);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-84C2CA15
$precios_test_testSearch->Show();
$precios_test_test->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B5573156
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($precios_test_testSearch);
unset($precios_test_test);
unset($Tpl);
//End Unload Page


?>
