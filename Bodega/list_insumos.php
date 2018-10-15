<?php
//Include Common Files @1-5508EFE4
define("RelativePath", "..");
define("PathToCurrentPage", "/Bodega/");
define("FileName", "list_insumos.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordinsumosSearch { //insumosSearch Class @3-362075BB

//Variables @3-9E315808

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

//Class_Initialize Event @3-2A6CCC67
    function clsRecordinsumosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record insumosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "insumosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_keyword = new clsControl(ccsTextBox, "s_keyword", "s_keyword", ccsText, "", CCGetRequestParam("s_keyword", $Method, NULL), $this);
            $this->insumosPageSize = new clsControl(ccsListBox, "insumosPageSize", "insumosPageSize", ccsText, "", CCGetRequestParam("insumosPageSize", $Method, NULL), $this);
            $this->insumosPageSize->DSType = dsListOfValues;
            $this->insumosPageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-70F27AA7
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_keyword->Validate() && $Validation);
        $Validation = ($this->insumosPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_keyword->Errors->Count() == 0);
        $Validation =  $Validation && ($this->insumosPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-385DDB57
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_keyword->Errors->Count());
        $errors = ($errors || $this->insumosPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-90DBB7EC
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
        $Redirect = "list_insumos.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "list_insumos.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-23541C40
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

        $this->insumosPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_keyword->Errors->ToString());
            $Error = ComposeStrings($Error, $this->insumosPageSize->Errors->ToString());
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

        $this->s_keyword->Show();
        $this->insumosPageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End insumosSearch Class @3-FCB6E20C

class clsEditableGridinsumos { //insumos Class @2-A7BD5530

//Variables @2-E038EB36

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
    public $Sorter_cod_insumo;
    public $Sorter_nom_insumo;
    public $Sorter_stock_min;
    public $Sorter_stock_max;
//End Variables

//Class_Initialize Event @2-D7604A16
    function clsEditableGridinsumos($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid insumos/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "insumos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["insumo_id"][0] = "insumo_id";
        $this->DataSource = new clsinsumosDataSource($this);
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

        $this->EmptyRows = 10;
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

        $this->SorterName = CCGetParam("insumosOrder", "");
        $this->SorterDirection = CCGetParam("insumosDir", "");

        $this->insumos_TotalRecords = new clsControl(ccsLabel, "insumos_TotalRecords", "insumos_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_cod_insumo = new clsSorter($this->ComponentName, "Sorter_cod_insumo", $FileName, $this);
        $this->Sorter_nom_insumo = new clsSorter($this->ComponentName, "Sorter_nom_insumo", $FileName, $this);
        $this->Sorter_stock_min = new clsSorter($this->ComponentName, "Sorter_stock_min", $FileName, $this);
        $this->Sorter_stock_max = new clsSorter($this->ComponentName, "Sorter_stock_max", $FileName, $this);
        $this->RowIDAttribute = new clsControl(ccsLabel, "RowIDAttribute", "RowIDAttribute", ccsText, "", NULL, $this);
        $this->RowNameAttribute = new clsControl(ccsLabel, "RowNameAttribute", "RowNameAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute = new clsControl(ccsLabel, "RowStyleAttribute", "RowStyleAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute->HTML = true;
        $this->cod_insumo = new clsControl(ccsTextBox, "cod_insumo", "Cod Insumo", ccsText, "", NULL, $this);
        $this->nom_insumo = new clsControl(ccsTextBox, "nom_insumo", "Nom Insumo", ccsText, "", NULL, $this);
        $this->unidad_medida = new clsControl(ccsTextBox, "unidad_medida", "unidad medida", ccsText, "", NULL, $this);
        $this->stock_min = new clsControl(ccsTextBox, "stock_min", "Stock Min", ccsInteger, "", NULL, $this);
        $this->stock_max = new clsControl(ccsTextBox, "stock_max", "Stock Max", ccsInteger, "", NULL, $this);
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

//Initialize Method @2-A0E4509A
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_keyword"] = CCGetFromGet("s_keyword", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-8B4F8292
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["cod_insumo"][$RowNumber] = CCGetFromPost("cod_insumo_" . $RowNumber, NULL);
            $this->FormParameters["nom_insumo"][$RowNumber] = CCGetFromPost("nom_insumo_" . $RowNumber, NULL);
            $this->FormParameters["unidad_medida"][$RowNumber] = CCGetFromPost("unidad_medida_" . $RowNumber, NULL);
            $this->FormParameters["stock_min"][$RowNumber] = CCGetFromPost("stock_min_" . $RowNumber, NULL);
            $this->FormParameters["stock_max"][$RowNumber] = CCGetFromPost("stock_max_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-BE6A5A7E
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["insumo_id"] = $this->CachedColumns["insumo_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->cod_insumo->SetText($this->FormParameters["cod_insumo"][$this->RowNumber], $this->RowNumber);
            $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
            $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
            $this->stock_min->SetText($this->FormParameters["stock_min"][$this->RowNumber], $this->RowNumber);
            $this->stock_max->SetText($this->FormParameters["stock_max"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-C4CD86B0
    function ValidateRow()
    {
        global $CCSLocales;
        $this->cod_insumo->Validate();
        $this->nom_insumo->Validate();
        $this->unidad_medida->Validate();
        $this->stock_min->Validate();
        $this->stock_max->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->cod_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_insumo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->unidad_medida->Errors->ToString());
        $errors = ComposeStrings($errors, $this->stock_min->Errors->ToString());
        $errors = ComposeStrings($errors, $this->stock_max->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->cod_insumo->Errors->Clear();
        $this->nom_insumo->Errors->Clear();
        $this->unidad_medida->Errors->Clear();
        $this->stock_min->Errors->Clear();
        $this->stock_max->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-2ACB40B6
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["cod_insumo"][$this->RowNumber]) && count($this->FormParameters["cod_insumo"][$this->RowNumber])) || strlen($this->FormParameters["cod_insumo"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nom_insumo"][$this->RowNumber]) && count($this->FormParameters["nom_insumo"][$this->RowNumber])) || strlen($this->FormParameters["nom_insumo"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["unidad_medida"][$this->RowNumber]) && count($this->FormParameters["unidad_medida"][$this->RowNumber])) || strlen($this->FormParameters["unidad_medida"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["stock_min"][$this->RowNumber]) && count($this->FormParameters["stock_min"][$this->RowNumber])) || strlen($this->FormParameters["stock_min"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["stock_max"][$this->RowNumber]) && count($this->FormParameters["stock_max"][$this->RowNumber])) || strlen($this->FormParameters["stock_max"][$this->RowNumber]));
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

//Operation Method @2-C69EA4B0
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

//UpdateGrid Method @2-9DFC0818
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["insumo_id"] = $this->CachedColumns["insumo_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->cod_insumo->SetText($this->FormParameters["cod_insumo"][$this->RowNumber], $this->RowNumber);
            $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
            $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
            $this->stock_min->SetText($this->FormParameters["stock_min"][$this->RowNumber], $this->RowNumber);
            $this->stock_max->SetText($this->FormParameters["stock_max"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @2-34FC6748
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->cod_insumo->SetValue($this->cod_insumo->GetValue(true));
        $this->DataSource->nom_insumo->SetValue($this->nom_insumo->GetValue(true));
        $this->DataSource->unidad_medida->SetValue($this->unidad_medida->GetValue(true));
        $this->DataSource->stock_min->SetValue($this->stock_min->GetValue(true));
        $this->DataSource->stock_max->SetValue($this->stock_max->GetValue(true));
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

//UpdateRow Method @2-27B0AB30
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->cod_insumo->SetValue($this->cod_insumo->GetValue(true));
        $this->DataSource->nom_insumo->SetValue($this->nom_insumo->GetValue(true));
        $this->DataSource->unidad_medida->SetValue($this->unidad_medida->GetValue(true));
        $this->DataSource->stock_min->SetValue($this->stock_min->GetValue(true));
        $this->DataSource->stock_max->SetValue($this->stock_max->GetValue(true));
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

//FormScript Method @2-FFA11195
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var insumosElements;\n";
        $script .= "var insumosEmptyRows = 10;\n";
        $script .= "var " . $this->ComponentName . "cod_insumoID = 0;\n";
        $script .= "var " . $this->ComponentName . "nom_insumoID = 1;\n";
        $script .= "var " . $this->ComponentName . "unidad_medidaID = 2;\n";
        $script .= "var " . $this->ComponentName . "stock_minID = 3;\n";
        $script .= "var " . $this->ComponentName . "stock_maxID = 4;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 5;\n";
        $script .= "\nfunction initinsumosElements() {\n";
        $script .= "\tvar ED = document.forms[\"insumos\"];\n";
        $script .= "\tinsumosElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.cod_insumo_" . $i . ", " . "ED.nom_insumo_" . $i . ", " . "ED.unidad_medida_" . $i . ", " . "ED.stock_min_" . $i . ", " . "ED.stock_max_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-39FB254C
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
                $this->CachedColumns["insumo_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["insumo_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-E5858825
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["insumo_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-98F84FA9
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
        $this->ControlsVisible["RowIDAttribute"] = $this->RowIDAttribute->Visible;
        $this->ControlsVisible["RowNameAttribute"] = $this->RowNameAttribute->Visible;
        $this->ControlsVisible["RowStyleAttribute"] = $this->RowStyleAttribute->Visible;
        $this->ControlsVisible["cod_insumo"] = $this->cod_insumo->Visible;
        $this->ControlsVisible["nom_insumo"] = $this->nom_insumo->Visible;
        $this->ControlsVisible["unidad_medida"] = $this->unidad_medida->Visible;
        $this->ControlsVisible["stock_min"] = $this->stock_min->Visible;
        $this->ControlsVisible["stock_max"] = $this->stock_max->Visible;
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
                    $this->CachedColumns["insumo_id"][$this->RowNumber] = $this->DataSource->CachedColumns["insumo_id"];
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->CheckBox_Delete->SetValue(false);
                    $this->cod_insumo->SetValue($this->DataSource->cod_insumo->GetValue());
                    $this->nom_insumo->SetValue($this->DataSource->nom_insumo->GetValue());
                    $this->unidad_medida->SetValue($this->DataSource->unidad_medida->GetValue());
                    $this->stock_min->SetValue($this->DataSource->stock_min->GetValue());
                    $this->stock_max->SetValue($this->DataSource->stock_max->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->cod_insumo->SetText($this->FormParameters["cod_insumo"][$this->RowNumber], $this->RowNumber);
                    $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
                    $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
                    $this->stock_min->SetText($this->FormParameters["stock_min"][$this->RowNumber], $this->RowNumber);
                    $this->stock_max->SetText($this->FormParameters["stock_max"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["insumo_id"][$this->RowNumber] = "";
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->cod_insumo->SetText("");
                    $this->nom_insumo->SetText("");
                    $this->unidad_medida->SetText("");
                    $this->stock_min->SetText("");
                    $this->stock_max->SetText("");
                } else {
                    $this->RowIDAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->cod_insumo->SetText($this->FormParameters["cod_insumo"][$this->RowNumber], $this->RowNumber);
                    $this->nom_insumo->SetText($this->FormParameters["nom_insumo"][$this->RowNumber], $this->RowNumber);
                    $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
                    $this->stock_min->SetText($this->FormParameters["stock_min"][$this->RowNumber], $this->RowNumber);
                    $this->stock_max->SetText($this->FormParameters["stock_max"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->RowIDAttribute->Show($this->RowNumber);
                $this->RowNameAttribute->Show($this->RowNumber);
                $this->RowStyleAttribute->Show($this->RowNumber);
                $this->cod_insumo->Show($this->RowNumber);
                $this->nom_insumo->Show($this->RowNumber);
                $this->unidad_medida->Show($this->RowNumber);
                $this->stock_min->Show($this->RowNumber);
                $this->stock_max->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["insumo_id"] == $this->CachedColumns["insumo_id"][$this->RowNumber])) {
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
        $this->insumos_TotalRecords->Show();
        $this->Sorter_cod_insumo->Show();
        $this->Sorter_nom_insumo->Show();
        $this->Sorter_stock_min->Show();
        $this->Sorter_stock_max->Show();
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

} //End insumos Class @2-FCB6E20C

class clsinsumosDataSource extends clsDBDatos {  //insumosDataSource Class @2-B44978F7

//DataSource Variables @2-1348910C
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
    public $cod_insumo;
    public $nom_insumo;
    public $unidad_medida;
    public $stock_min;
    public $stock_max;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A1632713
    function clsinsumosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid insumos/Error";
        $this->Initialize();
        $this->RowIDAttribute = new clsField("RowIDAttribute", ccsText, "");
        
        $this->RowNameAttribute = new clsField("RowNameAttribute", ccsText, "");
        
        $this->RowStyleAttribute = new clsField("RowStyleAttribute", ccsText, "");
        
        $this->cod_insumo = new clsField("cod_insumo", ccsText, "");
        
        $this->nom_insumo = new clsField("nom_insumo", ccsText, "");
        
        $this->unidad_medida = new clsField("unidad_medida", ccsText, "");
        
        $this->stock_min = new clsField("stock_min", ccsInteger, "");
        
        $this->stock_max = new clsField("stock_max", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["cod_insumo"] = array("Name" => "cod_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_insumo"] = array("Name" => "nom_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["unidad_medida"] = array("Name" => "unidad_medida", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["stock_min"] = array("Name" => "stock_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["stock_max"] = array("Name" => "stock_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["cod_insumo"] = array("Name" => "cod_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_insumo"] = array("Name" => "nom_insumo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["unidad_medida"] = array("Name" => "unidad_medida", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["stock_min"] = array("Name" => "stock_min", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["stock_max"] = array("Name" => "stock_max", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-C980E7B6
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_cod_insumo" => array("cod_insumo", ""), 
            "Sorter_nom_insumo" => array("nom_insumo", ""), 
            "Sorter_stock_min" => array("stock_min", ""), 
            "Sorter_stock_max" => array("stock_max", "")));
    }
//End SetOrder Method

//Prepare Method @2-41325B30
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->wp->AddParameter("2", "urls_keyword", ccsText, "", "", $this->Parameters["urls_keyword"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "cod_insumo", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "nom_insumo", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-BAC3AD4B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM insumos";
        $this->SQL = "SELECT * \n\n" .
        "FROM insumos {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E78D5B8C
    function SetValues()
    {
        $this->CachedColumns["insumo_id"] = $this->f("insumo_id");
        $this->cod_insumo->SetDBValue($this->f("cod_insumo"));
        $this->nom_insumo->SetDBValue($this->f("nom_insumo"));
        $this->unidad_medida->SetDBValue($this->f("unidad_medida"));
        $this->stock_min->SetDBValue(trim($this->f("stock_min")));
        $this->stock_max->SetDBValue(trim($this->f("stock_max")));
    }
//End SetValues Method

//Insert Method @2-E728C599
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["cod_insumo"]["Value"] = $this->cod_insumo->GetDBValue(true);
        $this->InsertFields["nom_insumo"]["Value"] = $this->nom_insumo->GetDBValue(true);
        $this->InsertFields["unidad_medida"]["Value"] = $this->unidad_medida->GetDBValue(true);
        $this->InsertFields["stock_min"]["Value"] = $this->stock_min->GetDBValue(true);
        $this->InsertFields["stock_max"]["Value"] = $this->stock_max->GetDBValue(true);
        $this->SQL = CCBuildInsert("insumos", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-A72AB25C
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "insumo_id=" . $this->ToSQL($this->CachedColumns["insumo_id"], ccsInteger);
        $this->UpdateFields["cod_insumo"]["Value"] = $this->cod_insumo->GetDBValue(true);
        $this->UpdateFields["nom_insumo"]["Value"] = $this->nom_insumo->GetDBValue(true);
        $this->UpdateFields["unidad_medida"]["Value"] = $this->unidad_medida->GetDBValue(true);
        $this->UpdateFields["stock_min"]["Value"] = $this->stock_min->GetDBValue(true);
        $this->UpdateFields["stock_max"]["Value"] = $this->stock_max->GetDBValue(true);
        $this->SQL = CCBuildUpdate("insumos", $this->UpdateFields, $this);
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

//Delete Method @2-6E5CDA6B
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "insumo_id=" . $this->ToSQL($this->CachedColumns["insumo_id"], ccsInteger);
        $this->SQL = "DELETE FROM insumos";
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

} //End insumosDataSource Class @2-FCB6E20C

//Initialize Page @1-9B7E1EF0
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
$TemplateFileName = "list_insumos.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "../";
$PathToRootOpt = "../";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-1C6D62C5
CCSecurityRedirect("16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-6D107EB6
include_once("./list_insumos_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A83F29B8
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$insumosSearch = new clsRecordinsumosSearch("", $MainPage);
$insumos = new clsEditableGridinsumos("", $MainPage);
$MainPage->insumosSearch = & $insumosSearch;
$MainPage->insumos = & $insumos;
$insumos->Initialize();
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

//Execute Components @1-A9D314F5
$insumos->Operation();
$insumosSearch->Operation();
//End Execute Components

//Go to destination page @1-09235F3C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($insumosSearch);
    unset($insumos);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9FDF5630
$insumosSearch->Show();
$insumos->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-814EC22F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($insumosSearch);
unset($insumos);
unset($Tpl);
//End Unload Page


?>
