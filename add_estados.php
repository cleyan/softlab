<?php
//Include Common Files @1-09003834
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_estados.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordestadosSearch { //estadosSearch Class @17-795C573E

//Variables @17-9E315808

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

//Class_Initialize Event @17-32E9CE2A
    function clsRecordestadosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record estadosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "estadosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_usar_en = new clsControl(ccsListBox, "s_usar_en", "s_usar_en", ccsText, "", CCGetRequestParam("s_usar_en", $Method, NULL), $this);
            $this->s_usar_en->DSType = dsTable;
            $this->s_usar_en->DataSource = new clsDBDatos();
            $this->s_usar_en->ds = & $this->s_usar_en->DataSource;
            $this->s_usar_en->DataSource->SQL = "SELECT * \n" .
"FROM estados_uso {SQL_Where} {SQL_OrderBy}";
            list($this->s_usar_en->BoundColumn, $this->s_usar_en->TextColumn, $this->s_usar_en->DBFormat) = array("nom_estado", "nom_estado_uso", "");
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @17-BF981253
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_usar_en->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_usar_en->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @17-B8DEE5A4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_usar_en->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @17-F2944531
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
        $Redirect = "add_estados.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "add_estados.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @17-3945A9B0
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

        $this->s_usar_en->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_usar_en->Errors->ToString());
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

        $this->s_usar_en->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End estadosSearch Class @17-FCB6E20C

class clsEditableGridestados { //estados Class @2-0376F301

//Variables @2-03AC68E1

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $StoredValues;
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
    public $ID;
    public $Sorter_nom_estado;
    public $Sorter_usar_en;
//End Variables

//Class_Initialize Event @2-C247E938
    function clsEditableGridestados($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid estados/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "estados";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["estado_id"][0] = "estado_id";
        $this->DataSource = new clsestadosDataSource($this);
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

        $this->EmptyRows = 1;
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

        $this->SorterName = CCGetParam("estadosOrder", "");
        $this->SorterDirection = CCGetParam("estadosDir", "");

        $this->estados_TotalRecords = new clsControl(ccsLabel, "estados_TotalRecords", "estados_TotalRecords", ccsText, "", NULL, $this);
        $this->ID = new clsSorter($this->ComponentName, "ID", $FileName, $this);
        $this->Sorter_nom_estado = new clsSorter($this->ComponentName, "Sorter_nom_estado", $FileName, $this);
        $this->Sorter_usar_en = new clsSorter($this->ComponentName, "Sorter_usar_en", $FileName, $this);
        $this->estado_id = new clsControl(ccsTextBox, "estado_id", "estado_id", ccsInteger, "", NULL, $this);
        $this->estado_id->Required = true;
        $this->nom_estado = new clsControl(ccsTextBox, "nom_estado", "Nombre de estado", ccsText, "", NULL, $this);
        $this->nom_estado->Required = true;
        $this->usar_en = new clsControl(ccsListBox, "usar_en", "usar en", ccsText, "", NULL, $this);
        $this->usar_en->DSType = dsTable;
        $this->usar_en->DataSource = new clsDBDatos();
        $this->usar_en->ds = & $this->usar_en->DataSource;
        $this->usar_en->DataSource->SQL = "SELECT * \n" .
"FROM estados_uso {SQL_Where} {SQL_OrderBy}";
        list($this->usar_en->BoundColumn, $this->usar_en->TextColumn, $this->usar_en->DBFormat) = array("nom_estado", "nom_estado_uso", "");
        $this->usar_en->Required = true;
        $this->predeterminado = new clsControl(ccsCheckBox, "predeterminado", "predeterminado", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->predeterminado->CheckedValue = true;
        $this->predeterminado->UncheckedValue = false;
        $this->activo = new clsControl(ccsCheckBox, "activo", "activo", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->activo->CheckedValue = true;
        $this->activo->UncheckedValue = false;
        $this->visible_validacion = new clsControl(ccsCheckBox, "visible_validacion", "visible_validacion", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->visible_validacion->CheckedValue = true;
        $this->visible_validacion->UncheckedValue = false;
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator1 = new clsNavigator($this->ComponentName, "Navigator1", $FileName, 10, tpSimple, $this);
        $this->Navigator1->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-12C2B660
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_usar_en"] = CCGetFromGet("s_usar_en", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-5E855712
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["estado_id"][$RowNumber] = CCGetFromPost("estado_id_" . $RowNumber, NULL);
            $this->FormParameters["nom_estado"][$RowNumber] = CCGetFromPost("nom_estado_" . $RowNumber, NULL);
            $this->FormParameters["usar_en"][$RowNumber] = CCGetFromPost("usar_en_" . $RowNumber, NULL);
            $this->FormParameters["predeterminado"][$RowNumber] = CCGetFromPost("predeterminado_" . $RowNumber, NULL);
            $this->FormParameters["activo"][$RowNumber] = CCGetFromPost("activo_" . $RowNumber, NULL);
            $this->FormParameters["visible_validacion"][$RowNumber] = CCGetFromPost("visible_validacion_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-E1FE52BD
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $this->StoredValues = array();

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["estado_id"] = $this->CachedColumns["estado_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
            $this->nom_estado->SetText($this->FormParameters["nom_estado"][$this->RowNumber], $this->RowNumber);
            $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
            $this->predeterminado->SetText($this->FormParameters["predeterminado"][$this->RowNumber], $this->RowNumber);
            $this->activo->SetText($this->FormParameters["activo"][$this->RowNumber], $this->RowNumber);
            $this->visible_validacion->SetText($this->FormParameters["visible_validacion"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-B761F9C1
    function ValidateRow()
    {
        global $CCSLocales;
        if(strlen($this->CachedColumns["estado_id"][$this->RowNumber])) 
            $Where = " AND estado_id <> " . $this->DataSource->ToSQL($this->CachedColumns["estado_id"][$this->RowNumber], ccsInteger); 
        else
            $Where = "";
        if (!isset($this->StoredValues["estado_id"])) $this->StoredValues["estado_id"] = array();
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue());
        if(CCDLookUp("COUNT(*)", "estados", "estado_id=" . $this->DataSource->ToSQL($this->DataSource->estado_id->GetDBValue(), $this->DataSource->estado_id->DataType) . $Where, $this->DataSource) > 0)
            $this->estado_id->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "estado_id"));
        else if (in_array($this->estado_id->GetValue(), $this->StoredValues["estado_id"]))
            $this->estado_id->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "estado_id"));
        $this->StoredValues["estado_id"][] = $this->estado_id->GetValue();
        $this->estado_id->Validate();
        $this->nom_estado->Validate();
        $this->usar_en->Validate();
        $this->predeterminado->Validate();
        $this->activo->Validate();
        $this->visible_validacion->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->estado_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usar_en->Errors->ToString());
        $errors = ComposeStrings($errors, $this->predeterminado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->activo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->visible_validacion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->estado_id->Errors->Clear();
        $this->nom_estado->Errors->Clear();
        $this->usar_en->Errors->Clear();
        $this->predeterminado->Errors->Clear();
        $this->activo->Errors->Clear();
        $this->visible_validacion->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-F5FCB622
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["estado_id"][$this->RowNumber]) && count($this->FormParameters["estado_id"][$this->RowNumber])) || strlen($this->FormParameters["estado_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nom_estado"][$this->RowNumber]) && count($this->FormParameters["nom_estado"][$this->RowNumber])) || strlen($this->FormParameters["nom_estado"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["usar_en"][$this->RowNumber]) && count($this->FormParameters["usar_en"][$this->RowNumber])) || strlen($this->FormParameters["usar_en"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["predeterminado"][$this->RowNumber]) && count($this->FormParameters["predeterminado"][$this->RowNumber])) || strlen($this->FormParameters["predeterminado"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["activo"][$this->RowNumber]) && count($this->FormParameters["activo"][$this->RowNumber])) || strlen($this->FormParameters["activo"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["visible_validacion"][$this->RowNumber]) && count($this->FormParameters["visible_validacion"][$this->RowNumber])) || strlen($this->FormParameters["visible_validacion"][$this->RowNumber]));
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

//Operation Method @2-5566944D
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
            } else {
                $Redirect = "menu_principal.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @2-2E103E40
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["estado_id"] = $this->CachedColumns["estado_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
            $this->nom_estado->SetText($this->FormParameters["nom_estado"][$this->RowNumber], $this->RowNumber);
            $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
            $this->predeterminado->SetText($this->FormParameters["predeterminado"][$this->RowNumber], $this->RowNumber);
            $this->activo->SetText($this->FormParameters["activo"][$this->RowNumber], $this->RowNumber);
            $this->visible_validacion->SetText($this->FormParameters["visible_validacion"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @2-D0B79537
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->nom_estado->SetValue($this->nom_estado->GetValue(true));
        $this->DataSource->usar_en->SetValue($this->usar_en->GetValue(true));
        $this->DataSource->predeterminado->SetValue($this->predeterminado->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->visible_validacion->SetValue($this->visible_validacion->GetValue(true));
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

//UpdateRow Method @2-08A8FD64
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->nom_estado->SetValue($this->nom_estado->GetValue(true));
        $this->DataSource->usar_en->SetValue($this->usar_en->GetValue(true));
        $this->DataSource->predeterminado->SetValue($this->predeterminado->GetValue(true));
        $this->DataSource->activo->SetValue($this->activo->GetValue(true));
        $this->DataSource->visible_validacion->SetValue($this->visible_validacion->GetValue(true));
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

//FormScript Method @2-F7857AB0
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var estadosElements;\n";
        $script .= "var estadosEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "estado_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "nom_estadoID = 1;\n";
        $script .= "var " . $this->ComponentName . "usar_enID = 2;\n";
        $script .= "var " . $this->ComponentName . "predeterminadoID = 3;\n";
        $script .= "var " . $this->ComponentName . "activoID = 4;\n";
        $script .= "var " . $this->ComponentName . "visible_validacionID = 5;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 6;\n";
        $script .= "\nfunction initestadosElements() {\n";
        $script .= "\tvar ED = document.forms[\"estados\"];\n";
        $script .= "\testadosElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.estado_id_" . $i . ", " . "ED.nom_estado_" . $i . ", " . "ED.usar_en_" . $i . ", " . "ED.predeterminado_" . $i . ", " . "ED.activo_" . $i . ", " . "ED.visible_validacion_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-4FA99E0B
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
                $this->CachedColumns["estado_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["estado_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-EC265831
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["estado_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-2E314D3E
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->usar_en->Prepare();

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
        $this->ControlsVisible["estado_id"] = $this->estado_id->Visible;
        $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
        $this->ControlsVisible["usar_en"] = $this->usar_en->Visible;
        $this->ControlsVisible["predeterminado"] = $this->predeterminado->Visible;
        $this->ControlsVisible["activo"] = $this->activo->Visible;
        $this->ControlsVisible["visible_validacion"] = $this->visible_validacion->Visible;
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
                    $this->CachedColumns["estado_id"][$this->RowNumber] = $this->DataSource->CachedColumns["estado_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->estado_id->SetValue($this->DataSource->estado_id->GetValue());
                    $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                    $this->usar_en->SetValue($this->DataSource->usar_en->GetValue());
                    $this->predeterminado->SetValue($this->DataSource->predeterminado->GetValue());
                    $this->activo->SetValue($this->DataSource->activo->GetValue());
                    $this->visible_validacion->SetValue($this->DataSource->visible_validacion->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
                    $this->nom_estado->SetText($this->FormParameters["nom_estado"][$this->RowNumber], $this->RowNumber);
                    $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
                    $this->predeterminado->SetText($this->FormParameters["predeterminado"][$this->RowNumber], $this->RowNumber);
                    $this->activo->SetText($this->FormParameters["activo"][$this->RowNumber], $this->RowNumber);
                    $this->visible_validacion->SetText($this->FormParameters["visible_validacion"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["estado_id"][$this->RowNumber] = "";
                    $this->estado_id->SetText("");
                    $this->nom_estado->SetText("");
                    $this->usar_en->SetText("");
                    $this->predeterminado->SetValue(false);
                    $this->activo->SetValue(false);
                    $this->visible_validacion->SetValue(false);
                } else {
                    $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
                    $this->nom_estado->SetText($this->FormParameters["nom_estado"][$this->RowNumber], $this->RowNumber);
                    $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
                    $this->predeterminado->SetText($this->FormParameters["predeterminado"][$this->RowNumber], $this->RowNumber);
                    $this->activo->SetText($this->FormParameters["activo"][$this->RowNumber], $this->RowNumber);
                    $this->visible_validacion->SetText($this->FormParameters["visible_validacion"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->estado_id->Show($this->RowNumber);
                $this->nom_estado->Show($this->RowNumber);
                $this->usar_en->Show($this->RowNumber);
                $this->predeterminado->Show($this->RowNumber);
                $this->activo->Show($this->RowNumber);
                $this->visible_validacion->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["estado_id"] == $this->CachedColumns["estado_id"][$this->RowNumber])) {
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
        $this->Navigator1->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator1->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator1->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator1->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator1->TotalPages <= 1 && $this->Navigator1->PageNumber == 1) || $this->Navigator1->PageSize == "") {
            $this->Navigator1->Visible = false;
        }
        $this->estados_TotalRecords->Show();
        $this->ID->Show();
        $this->Sorter_nom_estado->Show();
        $this->Sorter_usar_en->Show();
        $this->Navigator1->Show();
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

} //End estados Class @2-FCB6E20C

class clsestadosDataSource extends clsDBDatos {  //estadosDataSource Class @2-0F1E21AF

//DataSource Variables @2-59B6AE20
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
    public $estado_id;
    public $nom_estado;
    public $usar_en;
    public $predeterminado;
    public $activo;
    public $visible_validacion;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-06F5758D
    function clsestadosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid estados/Error";
        $this->Initialize();
        $this->estado_id = new clsField("estado_id", ccsInteger, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        
        $this->usar_en = new clsField("usar_en", ccsText, "");
        
        $this->predeterminado = new clsField("predeterminado", ccsBoolean, $this->BooleanFormat);
        
        $this->activo = new clsField("activo", ccsBoolean, $this->BooleanFormat);
        
        $this->visible_validacion = new clsField("visible_validacion", ccsBoolean, $this->BooleanFormat);
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["nom_estado"] = array("Name" => "nom_estado", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usar_en"] = array("Name" => "usar_en", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["predeterminado"] = array("Name" => "predeterminado", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsBoolean);
        $this->InsertFields["visible_validacion"] = array("Name" => "visible_validacion", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_estado"] = array("Name" => "nom_estado", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usar_en"] = array("Name" => "usar_en", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["predeterminado"] = array("Name" => "predeterminado", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["activo"] = array("Name" => "activo", "Value" => "", "DataType" => ccsBoolean);
        $this->UpdateFields["visible_validacion"] = array("Name" => "visible_validacion", "Value" => "", "DataType" => ccsBoolean);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-54B42523
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("ID" => array("estado_id", ""), 
            "Sorter_nom_estado" => array("nom_estado", ""), 
            "Sorter_usar_en" => array("usar_en", "")));
    }
//End SetOrder Method

//Prepare Method @2-6DFD6C05
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_usar_en", ccsText, "", "", $this->Parameters["urls_usar_en"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "usar_en", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-2BDECE19
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM estados";
        $this->SQL = "SELECT * \n\n" .
        "FROM estados {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-516A09EC
    function SetValues()
    {
        $this->CachedColumns["estado_id"] = $this->f("estado_id");
        $this->estado_id->SetDBValue(trim($this->f("estado_id")));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
        $this->usar_en->SetDBValue($this->f("usar_en"));
        $this->predeterminado->SetDBValue(trim($this->f("predeterminado")));
        $this->activo->SetDBValue(trim($this->f("activo")));
        $this->visible_validacion->SetDBValue(trim($this->f("visible_validacion")));
    }
//End SetValues Method

//Insert Method @2-F805ABC4
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["estado_id"]["Value"] = $this->estado_id->GetDBValue(true);
        $this->InsertFields["nom_estado"]["Value"] = $this->nom_estado->GetDBValue(true);
        $this->InsertFields["usar_en"]["Value"] = $this->usar_en->GetDBValue(true);
        $this->InsertFields["predeterminado"]["Value"] = $this->predeterminado->GetDBValue(true);
        $this->InsertFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->InsertFields["visible_validacion"]["Value"] = $this->visible_validacion->GetDBValue(true);
        $this->SQL = CCBuildInsert("estados", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-9CBE9C55
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "estado_id=" . $this->ToSQL($this->CachedColumns["estado_id"], ccsInteger);
        $this->UpdateFields["estado_id"]["Value"] = $this->estado_id->GetDBValue(true);
        $this->UpdateFields["nom_estado"]["Value"] = $this->nom_estado->GetDBValue(true);
        $this->UpdateFields["usar_en"]["Value"] = $this->usar_en->GetDBValue(true);
        $this->UpdateFields["predeterminado"]["Value"] = $this->predeterminado->GetDBValue(true);
        $this->UpdateFields["activo"]["Value"] = $this->activo->GetDBValue(true);
        $this->UpdateFields["visible_validacion"]["Value"] = $this->visible_validacion->GetDBValue(true);
        $this->SQL = CCBuildUpdate("estados", $this->UpdateFields, $this);
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

//Delete Method @2-54A95305
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "estado_id=" . $this->ToSQL($this->CachedColumns["estado_id"], ccsInteger);
        $this->SQL = "DELETE FROM estados";
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

} //End estadosDataSource Class @2-FCB6E20C

//Initialize Page @1-981AD7BD
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
$TemplateFileName = "add_estados.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-2E557B45
CCSecurityRedirect("20", "error_nivel.php");
//End Authenticate User

//Include events file @1-9F85137F
include_once("./add_estados_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D173BC67
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$estadosSearch = new clsRecordestadosSearch("", $MainPage);
$estados = new clsEditableGridestados("", $MainPage);
$MainPage->estadosSearch = & $estadosSearch;
$MainPage->estados = & $estados;
$estados->Initialize();
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

//Execute Components @1-D511F9F9
$estados->Operation();
$estadosSearch->Operation();
//End Execute Components

//Go to destination page @1-75E1B230
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($estadosSearch);
    unset($estados);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B069E833
$estadosSearch->Show();
$estados->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A843A3BF
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($estadosSearch);
unset($estados);
unset($Tpl);
//End Unload Page


?>
