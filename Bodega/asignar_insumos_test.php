<?php
//Include Common Files @1-1C128CA0
define("RelativePath", "..");
define("PathToCurrentPage", "/Bodega/");
define("FileName", "asignar_insumos_test.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsEditableGridinsumos_x_test { //insumos_x_test Class @2-D45DC5C2

//Variables @2-39B5C534

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
    public $Sorter_insumo_id;
    public $Sorter_cantidad_x_test;
//End Variables

//Class_Initialize Event @2-131FB3B2
    function clsEditableGridinsumos_x_test($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid insumos_x_test/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "insumos_x_test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["insumo_x_test_id"][0] = "insumo_x_test_id";
        $this->DataSource = new clsinsumos_x_testDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 30;
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

        $this->SorterName = CCGetParam("insumos_x_testOrder", "");
        $this->SorterDirection = CCGetParam("insumos_x_testDir", "");

        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", NULL, $this);
        $this->insumos_x_test_TotalRecords = new clsControl(ccsLabel, "insumos_x_test_TotalRecords", "insumos_x_test_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_insumo_id = new clsSorter($this->ComponentName, "Sorter_insumo_id", $FileName, $this);
        $this->Sorter_cantidad_x_test = new clsSorter($this->ComponentName, "Sorter_cantidad_x_test", $FileName, $this);
        $this->RowIDAttribute = new clsControl(ccsLabel, "RowIDAttribute", "RowIDAttribute", ccsText, "", NULL, $this);
        $this->RowNameAttribute = new clsControl(ccsLabel, "RowNameAttribute", "RowNameAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute = new clsControl(ccsLabel, "RowStyleAttribute", "RowStyleAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute->HTML = true;
        $this->nom_insumo = new clsControl(ccsTextBox, "nom_insumo", "nom_insumo", ccsText, "", NULL, $this);
        $this->last_insumo_id = new clsControl(ccsTextBox, "last_insumo_id", "last_insumo_id", ccsInteger, "", NULL, $this);
        $this->insumo_id = new clsControl(ccsListBox, "insumo_id", "Insumo", ccsInteger, "", NULL, $this);
        $this->insumo_id->DSType = dsTable;
        $this->insumo_id->DataSource = new clsDBDatos();
        $this->insumo_id->ds = & $this->insumo_id->DataSource;
        $this->insumo_id->DataSource->SQL = "SELECT * \n" .
"FROM insumos {SQL_Where} {SQL_OrderBy}";
        $this->insumo_id->DataSource->Order = "nom_insumo";
        list($this->insumo_id->BoundColumn, $this->insumo_id->TextColumn, $this->insumo_id->DBFormat) = array("insumo_id", "nom_insumo", "");
        $this->insumo_id->DataSource->Order = "nom_insumo";
        $this->insumo_id->Required = true;
        $this->test_id = new clsControl(ccsHidden, "test_id", "Test Id", ccsInteger, "", NULL, $this);
        $this->cantidad_x_test = new clsControl(ccsTextBox, "cantidad_x_test", "Cantidad X Test", ccsInteger, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->AddRowBtn = new clsButton("AddRowBtn", $Method, $this);
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-6AE259A5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urltest_id"] = CCGetFromGet("test_id", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-A6D10DC6
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["nom_insumo"][$RowNumber] = CCGetFromPost("nom_insumo_" . $RowNumber, NULL);
            $this->FormParameters["last_insumo_id"][$RowNumber] = CCGetFromPost("last_insumo_id_" . $RowNumber, NULL);
            $this->FormParameters["insumo_id"][$RowNumber] = CCGetFromPost("insumo_id_" . $RowNumber, NULL);
            $this->FormParameters["test_id"][$RowNumber] = CCGetFromPost("test_id_" . $RowNumber, NULL);
            $this->FormParameters["cantidad_x_test"][$RowNumber] = CCGetFromPost("cantidad_x_test_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-CE608CB4
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["insumo_x_test_id"] = $this->CachedColumns["insumo_x_test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
            $this->last_insumo_id->SetText($this->FormParameters["last_insumo_id"][$this->RowNumber], $this->RowNumber);
            $this->insumo_id->SetText($this->FormParameters["insumo_id"][$this->RowNumber], $this->RowNumber);
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->cantidad_x_test->SetText($this->FormParameters["cantidad_x_test"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-C7655F9A
    function ValidateRow()
    {
        global $CCSLocales;
        $this->nom_insumo->Validate();
        $this->last_insumo_id->Validate();
        $this->insumo_id->Validate();
        $this->test_id->Validate();
        $this->cantidad_x_test->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->nom_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->last_insumo_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->insumo_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cantidad_x_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->nom_insumo->Errors->Clear();
        $this->last_insumo_id->Errors->Clear();
        $this->insumo_id->Errors->Clear();
        $this->test_id->Errors->Clear();
        $this->cantidad_x_test->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-4C4624A2
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["nom_insumo"][$this->RowNumber]) && count($this->FormParameters["nom_insumo"][$this->RowNumber])) || strlen($this->FormParameters["nom_insumo"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["last_insumo_id"][$this->RowNumber]) && count($this->FormParameters["last_insumo_id"][$this->RowNumber])) || strlen($this->FormParameters["last_insumo_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["insumo_id"][$this->RowNumber]) && count($this->FormParameters["insumo_id"][$this->RowNumber])) || strlen($this->FormParameters["insumo_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["test_id"][$this->RowNumber]) && count($this->FormParameters["test_id"][$this->RowNumber])) || strlen($this->FormParameters["test_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["cantidad_x_test"][$this->RowNumber]) && count($this->FormParameters["cantidad_x_test"][$this->RowNumber])) || strlen($this->FormParameters["cantidad_x_test"][$this->RowNumber]));
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

//Operation Method @2-69846E87
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
        if($this->AddRowBtn->Pressed) {
            $this->PressedButton = "AddRowBtn";
        } else if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->Cancel->Pressed) {
            $this->PressedButton = "Cancel";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "AddRowBtn") {
            if(!CCGetEvent($this->AddRowBtn->CCSEvents, "OnClick", $this->AddRowBtn)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            } else {
                $Redirect = "list_test.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            }
        } else if($this->PressedButton == "Cancel") {
            if(!CCGetEvent($this->Cancel->CCSEvents, "OnClick", $this->Cancel)) {
                $Redirect = "";
            } else {
                $Redirect = "list_test.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "test_id"));
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-65562E65
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["insumo_x_test_id"] = $this->CachedColumns["insumo_x_test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
            $this->last_insumo_id->SetText($this->FormParameters["last_insumo_id"][$this->RowNumber], $this->RowNumber);
            $this->insumo_id->SetText($this->FormParameters["insumo_id"][$this->RowNumber], $this->RowNumber);
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->cantidad_x_test->SetText($this->FormParameters["cantidad_x_test"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @2-03489688
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->insumo_id->SetValue($this->insumo_id->GetValue(true));
        $this->DataSource->cantidad_x_test->SetValue($this->cantidad_x_test->GetValue(true));
        $this->DataSource->unidad_medida->SetValue($this->unidad_medida->GetValue(true));
        $this->DataSource->costo->SetValue($this->costo->GetValue(true));
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

//UpdateRow Method @2-831CAA23
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->nom_insumo->SetValue($this->nom_insumo->GetValue(true));
        $this->DataSource->last_insumo_id->SetValue($this->last_insumo_id->GetValue(true));
        $this->DataSource->insumo_id->SetValue($this->insumo_id->GetValue(true));
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->cantidad_x_test->SetValue($this->cantidad_x_test->GetValue(true));
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

//FormScript Method @2-80D6D9BF
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var insumos_x_testElements;\n";
        $script .= "var insumos_x_testEmptyRows = 30;\n";
        $script .= "var " . $this->ComponentName . "nom_insumoID = 0;\n";
        $script .= "var " . $this->ComponentName . "last_insumo_idID = 1;\n";
        $script .= "var " . $this->ComponentName . "insumo_idID = 2;\n";
        $script .= "var " . $this->ComponentName . "test_idID = 3;\n";
        $script .= "var " . $this->ComponentName . "cantidad_x_testID = 4;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 5;\n";
        $script .= "\nfunction initinsumos_x_testElements() {\n";
        $script .= "\tvar ED = document.forms[\"insumos_x_test\"];\n";
        $script .= "\tinsumos_x_testElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.nom_insumo_" . $i . ", " . "ED.last_insumo_id_" . $i . ", " . "ED.insumo_id_" . $i . ", " . "ED.test_id_" . $i . ", " . "ED.cantidad_x_test_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-E2155552
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
                $this->CachedColumns["insumo_x_test_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["insumo_x_test_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-702A0710
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["insumo_x_test_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-87F56C4A
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->insumo_id->Prepare();

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
        $this->ControlsVisible["RowIDAttribute"] = $this->RowIDAttribute->Visible;
        $this->ControlsVisible["RowNameAttribute"] = $this->RowNameAttribute->Visible;
        $this->ControlsVisible["RowStyleAttribute"] = $this->RowStyleAttribute->Visible;
        $this->ControlsVisible["nom_insumo"] = $this->nom_insumo->Visible;
        $this->ControlsVisible["last_insumo_id"] = $this->last_insumo_id->Visible;
        $this->ControlsVisible["insumo_id"] = $this->insumo_id->Visible;
        $this->ControlsVisible["test_id"] = $this->test_id->Visible;
        $this->ControlsVisible["cantidad_x_test"] = $this->cantidad_x_test->Visible;
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
                    $this->CachedColumns["insumo_x_test_id"][$this->RowNumber] = $this->DataSource->CachedColumns["insumo_x_test_id"];
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->nom_insumo->SetText("");
                    $this->last_insumo_id->SetText("");
                    $this->CheckBox_Delete->SetValue(false);
                    $this->insumo_id->SetValue($this->DataSource->insumo_id->GetValue());
                    $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                    $this->cantidad_x_test->SetValue($this->DataSource->cantidad_x_test->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
                    $this->last_insumo_id->SetText($this->FormParameters["last_insumo_id"][$this->RowNumber], $this->RowNumber);
                    $this->insumo_id->SetText($this->FormParameters["insumo_id"][$this->RowNumber], $this->RowNumber);
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->cantidad_x_test->SetText($this->FormParameters["cantidad_x_test"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["insumo_x_test_id"][$this->RowNumber] = "";
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->nom_insumo->SetText("");
                    $this->last_insumo_id->SetText("");
                    $this->insumo_id->SetText("");
                    $this->test_id->SetText("");
                    $this->cantidad_x_test->SetText("");
                } else {
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
                    $this->last_insumo_id->SetText($this->FormParameters["last_insumo_id"][$this->RowNumber], $this->RowNumber);
                    $this->insumo_id->SetText($this->FormParameters["insumo_id"][$this->RowNumber], $this->RowNumber);
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->cantidad_x_test->SetText($this->FormParameters["cantidad_x_test"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->RowIDAttribute->Show($this->RowNumber);
                $this->RowNameAttribute->Show($this->RowNumber);
                $this->RowStyleAttribute->Show($this->RowNumber);
                $this->nom_insumo->Show($this->RowNumber);
                $this->last_insumo_id->Show($this->RowNumber);
                $this->insumo_id->Show($this->RowNumber);
                $this->test_id->Show($this->RowNumber);
                $this->cantidad_x_test->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["insumo_x_test_id"] == $this->CachedColumns["insumo_x_test_id"][$this->RowNumber])) {
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
        $this->nom_test->Show();
        $this->insumos_x_test_TotalRecords->Show();
        $this->Sorter_insumo_id->Show();
        $this->Sorter_cantidad_x_test->Show();
        $this->Navigator->Show();
        $this->AddRowBtn->Show();
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

} //End insumos_x_test Class @2-FCB6E20C

class clsinsumos_x_testDataSource extends clsDBDatos {  //insumos_x_testDataSource Class @2-641678E7

//DataSource Variables @2-773F95DA
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
    public $RowIDAttribute;
    public $RowNameAttribute;
    public $RowStyleAttribute;
    public $nom_insumo;
    public $last_insumo_id;
    public $insumo_id;
    public $test_id;
    public $cantidad_x_test;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EB603DA8
    function clsinsumos_x_testDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid insumos_x_test/Error";
        $this->Initialize();
        $this->RowIDAttribute = new clsField("RowIDAttribute", ccsText, "");
        
        $this->RowNameAttribute = new clsField("RowNameAttribute", ccsText, "");
        
        $this->RowStyleAttribute = new clsField("RowStyleAttribute", ccsText, "");
        
        $this->nom_insumo = new clsField("nom_insumo", ccsText, "");
        
        $this->last_insumo_id = new clsField("last_insumo_id", ccsInteger, "");
        
        $this->insumo_id = new clsField("insumo_id", ccsInteger, "");
        
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->cantidad_x_test = new clsField("cantidad_x_test", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["insumo_id"] = array("Name" => "insumo_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["cantidad_x_test"] = array("Name" => "cantidad_x_test", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["unidad_medida"] = array("Name" => "unidad_medida", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["costo"] = array("Name" => "costo", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["insumo_id"] = array("Name" => "insumo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["cantidad_x_test"] = array("Name" => "cantidad_x_test", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-BC021869
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_insumo_id" => array("insumo_id", ""), 
            "Sorter_cantidad_x_test" => array("cantidad_x_test", "")));
    }
//End SetOrder Method

//Prepare Method @2-D26ADDE2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urltest_id", ccsInteger, "", "", $this->Parameters["urltest_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "test_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-DCC4CEE8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM insumos_x_test";
        $this->SQL = "SELECT * \n\n" .
        "FROM insumos_x_test {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-63C6B6EC
    function SetValues()
    {
        $this->CachedColumns["insumo_x_test_id"] = $this->f("insumo_x_test_id");
        $this->insumo_id->SetDBValue(trim($this->f("insumo_id")));
        $this->test_id->SetDBValue(trim($this->f("test_id")));
        $this->cantidad_x_test->SetDBValue(trim($this->f("cantidad_x_test")));
    }
//End SetValues Method

//Insert Method @2-6A55864A
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["insumo_id"] = new clsSQLParameter("ctrlinsumo_id", ccsInteger, "", "", $this->insumo_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["test_id"] = new clsSQLParameter("expr56", ccsInteger, "", "", CCGetParam('test_id'), "", false, $this->ErrorBlock);
        $this->cp["cantidad_x_test"] = new clsSQLParameter("ctrlcantidad_x_test", ccsInteger, "", "", $this->cantidad_x_test->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["unidad_medida"] = new clsSQLParameter("ctrlunidad_medida", ccsText, "", "", $this->unidad_medida->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["costo"] = new clsSQLParameter("ctrlcosto", ccsInteger, "", "", $this->costo->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["insumo_id"]->GetValue()) and !strlen($this->cp["insumo_id"]->GetText()) and !is_bool($this->cp["insumo_id"]->GetValue())) 
            $this->cp["insumo_id"]->SetValue($this->insumo_id->GetValue(true));
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue(CCGetParam('test_id'));
        if (!is_null($this->cp["cantidad_x_test"]->GetValue()) and !strlen($this->cp["cantidad_x_test"]->GetText()) and !is_bool($this->cp["cantidad_x_test"]->GetValue())) 
            $this->cp["cantidad_x_test"]->SetValue($this->cantidad_x_test->GetValue(true));
        if (!is_null($this->cp["unidad_medida"]->GetValue()) and !strlen($this->cp["unidad_medida"]->GetText()) and !is_bool($this->cp["unidad_medida"]->GetValue())) 
            $this->cp["unidad_medida"]->SetValue($this->unidad_medida->GetValue(true));
        if (!is_null($this->cp["costo"]->GetValue()) and !strlen($this->cp["costo"]->GetText()) and !is_bool($this->cp["costo"]->GetValue())) 
            $this->cp["costo"]->SetValue($this->costo->GetValue(true));
        $this->InsertFields["insumo_id"]["Value"] = $this->cp["insumo_id"]->GetDBValue(true);
        $this->InsertFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->InsertFields["cantidad_x_test"]["Value"] = $this->cp["cantidad_x_test"]->GetDBValue(true);
        $this->InsertFields["unidad_medida"]["Value"] = $this->cp["unidad_medida"]->GetDBValue(true);
        $this->InsertFields["costo"]["Value"] = $this->cp["costo"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("insumos_x_test", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-67AEB784
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "insumo_x_test_id=" . $this->ToSQL($this->CachedColumns["insumo_x_test_id"], ccsInteger);
        $this->UpdateFields["insumo_id"]["Value"] = $this->insumo_id->GetDBValue(true);
        $this->UpdateFields["test_id"]["Value"] = $this->test_id->GetDBValue(true);
        $this->UpdateFields["cantidad_x_test"]["Value"] = $this->cantidad_x_test->GetDBValue(true);
        $this->SQL = CCBuildUpdate("insumos_x_test", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @2-333F44A5
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "insumo_x_test_id=" . $this->ToSQL($this->CachedColumns["insumo_x_test_id"], ccsInteger);
        $this->SQL = "DELETE FROM insumos_x_test";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End insumos_x_testDataSource Class @2-FCB6E20C

//Initialize Page @1-4F75DCEC
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
$TemplateFileName = "asignar_insumos_test.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "../";
$PathToRootOpt = "../";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-2701C46B
include_once("./asignar_insumos_test_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A9F5CEA9
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$insumos_x_test = new clsEditableGridinsumos_x_test("", $MainPage);
$MainPage->insumos_x_test = & $insumos_x_test;
$insumos_x_test->Initialize();
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

//Initialize HTML Template @1-1D8FC0E6
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
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-9B6FCEDB
$insumos_x_test->Operation();
//End Execute Components

//Go to destination page @1-E678007E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($insumos_x_test);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-158ED816
$insumos_x_test->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-54239618
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($insumos_x_test);
unset($Tpl);
//End Unload Page


?>
