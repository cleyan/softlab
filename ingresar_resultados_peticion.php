<?php
//Include Common Files @1-43B60ECF
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ingresar_resultados_peticion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_detalle_testSearch { //peticiones_detalle_testSearch Class @10-1F1B362F

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

//Class_Initialize Event @10-BAE0E984
    function clsRecordpeticiones_detalle_testSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_detalle_testSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_detalle_testSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_peticion_id = new clsControl(ccsTextBox, "s_peticion_id", "s_peticion_id", ccsInteger, "", CCGetRequestParam("s_peticion_id", $Method, NULL), $this);
            $this->peticiones_detalle_testPageSize = new clsControl(ccsListBox, "peticiones_detalle_testPageSize", "peticiones_detalle_testPageSize", ccsText, "", CCGetRequestParam("peticiones_detalle_testPageSize", $Method, NULL), $this);
            $this->peticiones_detalle_testPageSize->DSType = dsListOfValues;
            $this->peticiones_detalle_testPageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @10-3EB4B468
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $Validation = ($this->peticiones_detalle_testPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->peticiones_detalle_testPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @10-5F735E8C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->peticiones_detalle_testPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @10-2D310D4E
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
        $Redirect = "ingresar_resultados_peticion.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ingresar_resultados_peticion.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @10-0DC56D64
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

        $this->peticiones_detalle_testPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->peticiones_detalle_testPageSize->Errors->ToString());
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

        $this->s_peticion_id->Show();
        $this->peticiones_detalle_testPageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_detalle_testSearch Class @10-FCB6E20C

class clsEditableGridpeticiones_detalle_test { //peticiones_detalle_test Class @2-AF326D64

//Variables @2-9E2AA073

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
    public $Sorter_muestra_id;
    public $Sorter_nom_test;
    public $Sorter_estado_id;
//End Variables

//Class_Initialize Event @2-E06A1B3B
    function clsEditableGridpeticiones_detalle_test($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid peticiones_detalle_test/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "peticiones_detalle_test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_detalle_testDataSource($this);
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

        $this->SorterName = CCGetParam("peticiones_detalle_testOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_detalle_testDir", "");

        $this->linea = new clsControl(ccsTextBox, "linea", "linea", ccsText, "", NULL, $this);
        $this->Sorter_muestra_id = new clsSorter($this->ComponentName, "Sorter_muestra_id", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_estado_id = new clsSorter($this->ComponentName, "Sorter_estado_id", $FileName, $this);
        $this->muestra_id = new clsControl(ccsTextBox, "muestra_id", "Muestra Id", ccsText, "", NULL, $this);
        $this->test_id = new clsControl(ccsTextBox, "test_id", "Test Id", ccsInteger, "", NULL, $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "Nom Test", ccsText, "", NULL, $this);
        $this->valor = new clsControl(ccsTextBox, "valor", "valor", ccsText, "", NULL, $this);
        $this->estado_id = new clsControl(ccsTextBox, "estado_id", "Estado Id", ccsInteger, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-7ADB968B
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_peticion_id"] = CCGetFromGet("s_peticion_id", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-67575B9C
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["muestra_id"][$RowNumber] = CCGetFromPost("muestra_id_" . $RowNumber, NULL);
            $this->FormParameters["test_id"][$RowNumber] = CCGetFromPost("test_id_" . $RowNumber, NULL);
            $this->FormParameters["valor"][$RowNumber] = CCGetFromPost("valor_" . $RowNumber, NULL);
            $this->FormParameters["estado_id"][$RowNumber] = CCGetFromPost("estado_id_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-D1A15685
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->muestra_id->SetText($this->FormParameters["muestra_id"][$this->RowNumber], $this->RowNumber);
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->valor->SetText($this->FormParameters["valor"][$this->RowNumber], $this->RowNumber);
            $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-9A8269A5
    function ValidateRow()
    {
        global $CCSLocales;
        $this->muestra_id->Validate();
        $this->test_id->Validate();
        $this->valor->Validate();
        $this->estado_id->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->muestra_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->estado_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->muestra_id->Errors->Clear();
        $this->test_id->Errors->Clear();
        $this->valor->Errors->Clear();
        $this->estado_id->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-47052590
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["muestra_id"][$this->RowNumber]) && count($this->FormParameters["muestra_id"][$this->RowNumber])) || strlen($this->FormParameters["muestra_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["test_id"][$this->RowNumber]) && count($this->FormParameters["test_id"][$this->RowNumber])) || strlen($this->FormParameters["test_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["valor"][$this->RowNumber]) && count($this->FormParameters["valor"][$this->RowNumber])) || strlen($this->FormParameters["valor"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["estado_id"][$this->RowNumber]) && count($this->FormParameters["estado_id"][$this->RowNumber])) || strlen($this->FormParameters["estado_id"][$this->RowNumber]));
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

//UpdateGrid Method @2-0F9ED30E
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->muestra_id->SetText($this->FormParameters["muestra_id"][$this->RowNumber], $this->RowNumber);
            $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
            $this->valor->SetText($this->FormParameters["valor"][$this->RowNumber], $this->RowNumber);
            $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @2-1CED9C1B
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->muestra_id->SetValue($this->muestra_id->GetValue(true));
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
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

//UpdateRow Method @2-D058038D
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->muestra_id->SetValue($this->muestra_id->GetValue(true));
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
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

//FormScript Method @2-0C5D5710
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var peticiones_detalle_testElements;\n";
        $script .= "var peticiones_detalle_testEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "muestra_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "test_idID = 1;\n";
        $script .= "var " . $this->ComponentName . "valorID = 2;\n";
        $script .= "var " . $this->ComponentName . "estado_idID = 3;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 4;\n";
        $script .= "\nfunction initpeticiones_detalle_testElements() {\n";
        $script .= "\tvar ED = document.forms[\"peticiones_detalle_test\"];\n";
        $script .= "\tpeticiones_detalle_testElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.muestra_id_" . $i . ", " . "ED.test_id_" . $i . ", " . "ED.valor_" . $i . ", " . "ED.estado_id_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-69E01441
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
            for($i = 2; $i < sizeof($pieces); $i = $i + 0)  {
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-BF9CEBD0
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-C83AA6B7
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
        $this->ControlsVisible["muestra_id"] = $this->muestra_id->Visible;
        $this->ControlsVisible["test_id"] = $this->test_id->Visible;
        $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
        $this->ControlsVisible["valor"] = $this->valor->Visible;
        $this->ControlsVisible["estado_id"] = $this->estado_id->Visible;
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
                    $this->valor->SetText("");
                    $this->CheckBox_Delete->SetValue(false);
                    $this->muestra_id->SetValue($this->DataSource->muestra_id->GetValue());
                    $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->estado_id->SetValue($this->DataSource->estado_id->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->nom_test->SetText("");
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->muestra_id->SetText($this->FormParameters["muestra_id"][$this->RowNumber], $this->RowNumber);
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->valor->SetText($this->FormParameters["valor"][$this->RowNumber], $this->RowNumber);
                    $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->muestra_id->SetText("");
                    $this->test_id->SetText("");
                    $this->nom_test->SetText("");
                    $this->valor->SetText("");
                    $this->estado_id->SetText("");
                } else {
                    $this->nom_test->SetText("");
                    $this->muestra_id->SetText($this->FormParameters["muestra_id"][$this->RowNumber], $this->RowNumber);
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->valor->SetText($this->FormParameters["valor"][$this->RowNumber], $this->RowNumber);
                    $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->muestra_id->Show($this->RowNumber);
                $this->test_id->Show($this->RowNumber);
                $this->nom_test->Show($this->RowNumber);
                $this->valor->Show($this->RowNumber);
                $this->estado_id->Show($this->RowNumber);
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
                        $is_next_record =  $this->ReadAllowed && $this->DataSource->next_record() && $this->RowNumber < $this->UpdatedRows;
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
        $this->linea->Show();
        $this->Sorter_muestra_id->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_estado_id->Show();
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

} //End peticiones_detalle_test Class @2-FCB6E20C

class clspeticiones_detalle_testDataSource extends clsDBDatos {  //peticiones_detalle_testDataSource Class @2-7CD75560

//DataSource Variables @2-32D9C6EA
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

    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $muestra_id;
    public $test_id;
    public $nom_test;
    public $valor;
    public $estado_id;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4C5777A1
    function clspeticiones_detalle_testDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid peticiones_detalle_test/Error";
        $this->Initialize();
        $this->muestra_id = new clsField("muestra_id", ccsText, "");
        
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->valor = new clsField("valor", ccsText, "");
        
        $this->estado_id = new clsField("estado_id", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["muestra_id"] = array("Name" => "muestra_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["muestra_id"] = array("Name" => "muestra_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsText);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-8D975AA5
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_muestra_id" => array("muestra_id", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_estado_id" => array("estado_id", "")));
    }
//End SetOrder Method

//Prepare Method @2-D4DFCF55
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_peticion_id", ccsInteger, "", "", $this->Parameters["urls_peticion_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-287CED4A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM peticiones_detalle LEFT JOIN test ON\n\n" .
        "peticiones_detalle.test_id = test.test_id";
        $this->SQL = "SELECT peticiones_detalle.*, nom_test \n\n" .
        "FROM peticiones_detalle LEFT JOIN test ON\n\n" .
        "peticiones_detalle.test_id = test.test_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-32D77D2F
    function SetValues()
    {
        $this->muestra_id->SetDBValue($this->f("muestra_id"));
        $this->test_id->SetDBValue(trim($this->f("test_id")));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->estado_id->SetDBValue(trim($this->f("estado_id")));
    }
//End SetValues Method

//Insert Method @2-598A1258
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["test_id"] = new clsSQLParameter("ctrltest_id", ccsInteger, "", "", $this->test_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["muestra_id"] = new clsSQLParameter("ctrlmuestra_id", ccsInteger, "", "", $this->muestra_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["estado_id"] = new clsSQLParameter("ctrlestado_id", ccsInteger, "", "", $this->estado_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor"] = new clsSQLParameter("ctrlvalor", ccsText, "", "", $this->valor->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue($this->test_id->GetValue(true));
        if (!is_null($this->cp["muestra_id"]->GetValue()) and !strlen($this->cp["muestra_id"]->GetText()) and !is_bool($this->cp["muestra_id"]->GetValue())) 
            $this->cp["muestra_id"]->SetValue($this->muestra_id->GetValue(true));
        if (!is_null($this->cp["estado_id"]->GetValue()) and !strlen($this->cp["estado_id"]->GetText()) and !is_bool($this->cp["estado_id"]->GetValue())) 
            $this->cp["estado_id"]->SetValue($this->estado_id->GetValue(true));
        if (!is_null($this->cp["valor"]->GetValue()) and !strlen($this->cp["valor"]->GetText()) and !is_bool($this->cp["valor"]->GetValue())) 
            $this->cp["valor"]->SetValue($this->valor->GetValue(true));
        $this->InsertFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->InsertFields["muestra_id"]["Value"] = $this->cp["muestra_id"]->GetDBValue(true);
        $this->InsertFields["estado_id"]["Value"] = $this->cp["estado_id"]->GetDBValue(true);
        $this->InsertFields["valor"]["Value"] = $this->cp["valor"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("resultados", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-A389419E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["test_id"] = new clsSQLParameter("ctrltest_id", ccsInteger, "", "", $this->test_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["muestra_id"] = new clsSQLParameter("ctrlmuestra_id", ccsInteger, "", "", $this->muestra_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["estado_id"] = new clsSQLParameter("ctrlestado_id", ccsInteger, "", "", $this->estado_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor"] = new clsSQLParameter("ctrlvalor", ccsText, "", "", $this->valor->GetValue(true), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlresultado_id", ccsInteger, "", "", CCGetFromGet("resultado_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue($this->test_id->GetValue(true));
        if (!is_null($this->cp["muestra_id"]->GetValue()) and !strlen($this->cp["muestra_id"]->GetText()) and !is_bool($this->cp["muestra_id"]->GetValue())) 
            $this->cp["muestra_id"]->SetValue($this->muestra_id->GetValue(true));
        if (!is_null($this->cp["estado_id"]->GetValue()) and !strlen($this->cp["estado_id"]->GetText()) and !is_bool($this->cp["estado_id"]->GetValue())) 
            $this->cp["estado_id"]->SetValue($this->estado_id->GetValue(true));
        if (!is_null($this->cp["valor"]->GetValue()) and !strlen($this->cp["valor"]->GetText()) and !is_bool($this->cp["valor"]->GetValue())) 
            $this->cp["valor"]->SetValue($this->valor->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "resultado_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->UpdateFields["muestra_id"]["Value"] = $this->cp["muestra_id"]->GetDBValue(true);
        $this->UpdateFields["estado_id"]["Value"] = $this->cp["estado_id"]->GetDBValue(true);
        $this->UpdateFields["valor"]["Value"] = $this->cp["valor"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("resultados", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-B049A8C2
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlresultado_id", ccsInteger, "", "", CCGetFromGet("resultado_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $wp->Criterion[1] = $wp->Operation(opEqual, "resultado_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->SQL = "DELETE FROM resultados";
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End peticiones_detalle_testDataSource Class @2-FCB6E20C

//Initialize Page @1-57EE4207
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
$TemplateFileName = "ingresar_resultados_peticion.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-386A891B
include_once("./ingresar_resultados_peticion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-97798544
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_detalle_testSearch = new clsRecordpeticiones_detalle_testSearch("", $MainPage);
$peticiones_detalle_test = new clsEditableGridpeticiones_detalle_test("", $MainPage);
$MainPage->peticiones_detalle_testSearch = & $peticiones_detalle_testSearch;
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

//Execute Components @1-2474BD98
$peticiones_detalle_test->Operation();
$peticiones_detalle_testSearch->Operation();
//End Execute Components

//Go to destination page @1-FE87CE0E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_detalle_testSearch);
    unset($peticiones_detalle_test);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BA83AE96
$peticiones_detalle_testSearch->Show();
$peticiones_detalle_test->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-FED57CE2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_detalle_testSearch);
unset($peticiones_detalle_test);
unset($Tpl);
//End Unload Page


?>
