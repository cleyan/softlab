<?php
//Include Common Files @1-6708F10F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "cfg_toolbar.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtool_barSearch { //tool_barSearch Class @20-135019C6

//Variables @20-9E315808

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

//Class_Initialize Event @20-EBAA1852
    function clsRecordtool_barSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tool_barSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tool_barSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_usuario_id = new clsControl(ccsListBox, "s_usuario_id", "s_usuario_id", ccsInteger, "", CCGetRequestParam("s_usuario_id", $Method, NULL), $this);
            $this->s_usuario_id->DSType = dsTable;
            $this->s_usuario_id->DataSource = new clsDBDatos();
            $this->s_usuario_id->ds = & $this->s_usuario_id->DataSource;
            $this->s_usuario_id->DataSource->SQL = "SELECT * \n" .
"FROM usuarios {SQL_Where} {SQL_OrderBy}";
            $this->s_usuario_id->DataSource->Order = "nom_usuario";
            list($this->s_usuario_id->BoundColumn, $this->s_usuario_id->TextColumn, $this->s_usuario_id->DBFormat) = array("usuario_id", "nom_usuario", "");
            $this->s_usuario_id->DataSource->Parameters["expr56"] = CCGetUserID();
            $this->s_usuario_id->DataSource->wp = new clsSQLParameters();
            $this->s_usuario_id->DataSource->wp->AddParameter("1", "expr56", ccsInteger, "", "", $this->s_usuario_id->DataSource->Parameters["expr56"], "", false);
            $this->s_usuario_id->DataSource->wp->Criterion[1] = $this->s_usuario_id->DataSource->wp->Operation(opEqual, "usuario_id", $this->s_usuario_id->DataSource->wp->GetDBValue("1"), $this->s_usuario_id->DataSource->ToSQL($this->s_usuario_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->s_usuario_id->DataSource->wp->Criterion[2] = "( " . CCGetGroupID() . " > 16 )";
            $this->s_usuario_id->DataSource->Where = $this->s_usuario_id->DataSource->wp->opOR(
                 false, 
                 $this->s_usuario_id->DataSource->wp->Criterion[1], 
                 $this->s_usuario_id->DataSource->wp->Criterion[2]);
            $this->s_usuario_id->DataSource->Order = "nom_usuario";
            $this->s_contenido = new clsControl(ccsTextBox, "s_contenido", "s_contenido", ccsText, "", CCGetRequestParam("s_contenido", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @20-95825D33
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_usuario_id->Validate() && $Validation);
        $Validation = ($this->s_contenido->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_usuario_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_contenido->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @20-886EF287
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_usuario_id->Errors->Count());
        $errors = ($errors || $this->s_contenido->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @20-36DAD4D0
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
        $Redirect = "cfg_toolbar.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "cfg_toolbar.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @20-4300B8A8
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

        $this->s_usuario_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_usuario_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_contenido->Errors->ToString());
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

        $this->s_usuario_id->Show();
        $this->s_contenido->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tool_barSearch Class @20-FCB6E20C

class clsEditableGridtool_bar { //tool_bar Class @19-C1C235FD

//Variables @19-63D5A53E

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
    public $Sorter_caption;
    public $Sorter_tooltip;
    public $Sorter_accion;
    public $Sorter_usuario_id;
    public $Sorter_actulizar;
    public $Sorter_usar_en;
//End Variables

//Class_Initialize Event @19-AD0A7D04
    function clsEditableGridtool_bar($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid tool_bar/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "tool_bar";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["tool_bar_id"][0] = "tool_bar_id";
        $this->DataSource = new clstool_barDataSource($this);
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

        $this->SorterName = CCGetParam("tool_barOrder", "");
        $this->SorterDirection = CCGetParam("tool_barDir", "");

        $this->tool_bar_TotalRecords = new clsControl(ccsLabel, "tool_bar_TotalRecords", "tool_bar_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_caption = new clsSorter($this->ComponentName, "Sorter_caption", $FileName, $this);
        $this->Sorter_tooltip = new clsSorter($this->ComponentName, "Sorter_tooltip", $FileName, $this);
        $this->Sorter_accion = new clsSorter($this->ComponentName, "Sorter_accion", $FileName, $this);
        $this->Sorter_usuario_id = new clsSorter($this->ComponentName, "Sorter_usuario_id", $FileName, $this);
        $this->Sorter_actulizar = new clsSorter($this->ComponentName, "Sorter_actulizar", $FileName, $this);
        $this->Sorter_usar_en = new clsSorter($this->ComponentName, "Sorter_usar_en", $FileName, $this);
        $this->caption = new clsControl(ccsTextBox, "caption", "Caption", ccsText, "", NULL, $this);
        $this->caption->Required = true;
        $this->tooltip = new clsControl(ccsTextBox, "tooltip", "Tooltip", ccsText, "", NULL, $this);
        $this->tooltip->Required = true;
        $this->accion = new clsControl(ccsTextBox, "accion", "Accion", ccsText, "", NULL, $this);
        $this->accion->Required = true;
        $this->usuario_id = new clsControl(ccsListBox, "usuario_id", "Usuario Id", ccsInteger, "", NULL, $this);
        $this->usuario_id->DSType = dsTable;
        $this->usuario_id->DataSource = new clsDBDatos();
        $this->usuario_id->ds = & $this->usuario_id->DataSource;
        $this->usuario_id->DataSource->SQL = "SELECT * \n" .
"FROM usuarios {SQL_Where} {SQL_OrderBy}";
        list($this->usuario_id->BoundColumn, $this->usuario_id->TextColumn, $this->usuario_id->DBFormat) = array("usuario_id", "nom_usuario", "");
        $this->usuario_id->DataSource->Parameters["expr52"] = CCGetUserID();
        $this->usuario_id->DataSource->wp = new clsSQLParameters();
        $this->usuario_id->DataSource->wp->AddParameter("1", "expr52", ccsInteger, "", "", $this->usuario_id->DataSource->Parameters["expr52"], "", false);
        $this->usuario_id->DataSource->wp->Criterion[1] = $this->usuario_id->DataSource->wp->Operation(opEqual, "usuario_id", $this->usuario_id->DataSource->wp->GetDBValue("1"), $this->usuario_id->DataSource->ToSQL($this->usuario_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
        $this->usuario_id->DataSource->wp->Criterion[2] = "( " . CCGetGroupID() . " > 16 )";
        $this->usuario_id->DataSource->Where = $this->usuario_id->DataSource->wp->opOR(
             false, 
             $this->usuario_id->DataSource->wp->Criterion[1], 
             $this->usuario_id->DataSource->wp->Criterion[2]);
        $this->usuario_id->Required = true;
        $this->actulizar = new clsControl(ccsCheckBox, "actulizar", "Actulizar", ccsText, "", NULL, $this);
        $this->actulizar->CheckedValue = $this->actulizar->GetParsedValue('V');
        $this->actulizar->UncheckedValue = $this->actulizar->GetParsedValue('F');
        $this->usar_en = new clsControl(ccsListBox, "usar_en", "Usar En", ccsText, "", NULL, $this);
        $this->usar_en->DSType = dsListOfValues;
        $this->usar_en->Values = array(array("WIN", "Windows"), array("WEB", "Web"), array("DOS", "Ambos"));
        $this->usar_en->Required = true;
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @19-13338E5B
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_usuario_id"] = CCGetFromGet("s_usuario_id", NULL);
        $this->DataSource->Parameters["urls_caption"] = CCGetFromGet("s_caption", NULL);
        $this->DataSource->Parameters["urls_accion"] = CCGetFromGet("s_accion", NULL);
        $this->DataSource->Parameters["expr54"] = CCGetUserID();
    }
//End Initialize Method

//GetFormParameters Method @19-7C21211E
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["caption"][$RowNumber] = CCGetFromPost("caption_" . $RowNumber, NULL);
            $this->FormParameters["tooltip"][$RowNumber] = CCGetFromPost("tooltip_" . $RowNumber, NULL);
            $this->FormParameters["accion"][$RowNumber] = CCGetFromPost("accion_" . $RowNumber, NULL);
            $this->FormParameters["usuario_id"][$RowNumber] = CCGetFromPost("usuario_id_" . $RowNumber, NULL);
            $this->FormParameters["actulizar"][$RowNumber] = CCGetFromPost("actulizar_" . $RowNumber, NULL);
            $this->FormParameters["usar_en"][$RowNumber] = CCGetFromPost("usar_en_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @19-2A852967
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["tool_bar_id"] = $this->CachedColumns["tool_bar_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
            $this->tooltip->SetText($this->FormParameters["tooltip"][$this->RowNumber], $this->RowNumber);
            $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
            $this->usuario_id->SetText($this->FormParameters["usuario_id"][$this->RowNumber], $this->RowNumber);
            $this->actulizar->SetText($this->FormParameters["actulizar"][$this->RowNumber], $this->RowNumber);
            $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @19-18842E49
    function ValidateRow()
    {
        global $CCSLocales;
        $this->caption->Validate();
        $this->tooltip->Validate();
        $this->accion->Validate();
        $this->usuario_id->Validate();
        $this->actulizar->Validate();
        $this->usar_en->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->caption->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tooltip->Errors->ToString());
        $errors = ComposeStrings($errors, $this->accion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usuario_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->actulizar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->usar_en->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->caption->Errors->Clear();
        $this->tooltip->Errors->Clear();
        $this->accion->Errors->Clear();
        $this->usuario_id->Errors->Clear();
        $this->actulizar->Errors->Clear();
        $this->usar_en->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @19-E057A584
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["caption"][$this->RowNumber]) && count($this->FormParameters["caption"][$this->RowNumber])) || strlen($this->FormParameters["caption"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["tooltip"][$this->RowNumber]) && count($this->FormParameters["tooltip"][$this->RowNumber])) || strlen($this->FormParameters["tooltip"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["accion"][$this->RowNumber]) && count($this->FormParameters["accion"][$this->RowNumber])) || strlen($this->FormParameters["accion"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["usuario_id"][$this->RowNumber]) && count($this->FormParameters["usuario_id"][$this->RowNumber])) || strlen($this->FormParameters["usuario_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["actulizar"][$this->RowNumber]) && count($this->FormParameters["actulizar"][$this->RowNumber])) || strlen($this->FormParameters["actulizar"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["usar_en"][$this->RowNumber]) && count($this->FormParameters["usar_en"][$this->RowNumber])) || strlen($this->FormParameters["usar_en"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @19-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @19-6B923CC2
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

//UpdateGrid Method @19-05E7374A
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["tool_bar_id"] = $this->CachedColumns["tool_bar_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
            $this->tooltip->SetText($this->FormParameters["tooltip"][$this->RowNumber], $this->RowNumber);
            $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
            $this->usuario_id->SetText($this->FormParameters["usuario_id"][$this->RowNumber], $this->RowNumber);
            $this->actulizar->SetText($this->FormParameters["actulizar"][$this->RowNumber], $this->RowNumber);
            $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @19-F75FB699
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->caption->SetValue($this->caption->GetValue(true));
        $this->DataSource->tooltip->SetValue($this->tooltip->GetValue(true));
        $this->DataSource->accion->SetValue($this->accion->GetValue(true));
        $this->DataSource->usuario_id->SetValue($this->usuario_id->GetValue(true));
        $this->DataSource->actulizar->SetValue($this->actulizar->GetValue(true));
        $this->DataSource->usar_en->SetValue($this->usar_en->GetValue(true));
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

//UpdateRow Method @19-0AC58DFD
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->caption->SetValue($this->caption->GetValue(true));
        $this->DataSource->tooltip->SetValue($this->tooltip->GetValue(true));
        $this->DataSource->accion->SetValue($this->accion->GetValue(true));
        $this->DataSource->usuario_id->SetValue($this->usuario_id->GetValue(true));
        $this->DataSource->actulizar->SetValue($this->actulizar->GetValue(true));
        $this->DataSource->usar_en->SetValue($this->usar_en->GetValue(true));
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

//DeleteRow Method @19-A4A656F6
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

//FormScript Method @19-99CDD38B
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var tool_barElements;\n";
        $script .= "var tool_barEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "captionID = 0;\n";
        $script .= "var " . $this->ComponentName . "tooltipID = 1;\n";
        $script .= "var " . $this->ComponentName . "accionID = 2;\n";
        $script .= "var " . $this->ComponentName . "usuario_idID = 3;\n";
        $script .= "var " . $this->ComponentName . "actulizarID = 4;\n";
        $script .= "var " . $this->ComponentName . "usar_enID = 5;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 6;\n";
        $script .= "\nfunction inittool_barElements() {\n";
        $script .= "\tvar ED = document.forms[\"tool_bar\"];\n";
        $script .= "\ttool_barElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.caption_" . $i . ", " . "ED.tooltip_" . $i . ", " . "ED.accion_" . $i . ", " . "ED.usuario_id_" . $i . ", " . "ED.actulizar_" . $i . ", " . "ED.usar_en_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @19-D5EE8CE4
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
                $this->CachedColumns["tool_bar_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["tool_bar_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @19-1A9E2CA7
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["tool_bar_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @19-336F1303
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->usuario_id->Prepare();
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
        $this->ControlsVisible["caption"] = $this->caption->Visible;
        $this->ControlsVisible["tooltip"] = $this->tooltip->Visible;
        $this->ControlsVisible["accion"] = $this->accion->Visible;
        $this->ControlsVisible["usuario_id"] = $this->usuario_id->Visible;
        $this->ControlsVisible["actulizar"] = $this->actulizar->Visible;
        $this->ControlsVisible["usar_en"] = $this->usar_en->Visible;
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
                    $this->CachedColumns["tool_bar_id"][$this->RowNumber] = $this->DataSource->CachedColumns["tool_bar_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->caption->SetValue($this->DataSource->caption->GetValue());
                    $this->tooltip->SetValue($this->DataSource->tooltip->GetValue());
                    $this->accion->SetValue($this->DataSource->accion->GetValue());
                    $this->usuario_id->SetValue($this->DataSource->usuario_id->GetValue());
                    $this->actulizar->SetValue($this->DataSource->actulizar->GetValue());
                    $this->usar_en->SetValue($this->DataSource->usar_en->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
                    $this->tooltip->SetText($this->FormParameters["tooltip"][$this->RowNumber], $this->RowNumber);
                    $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
                    $this->usuario_id->SetText($this->FormParameters["usuario_id"][$this->RowNumber], $this->RowNumber);
                    $this->actulizar->SetText($this->FormParameters["actulizar"][$this->RowNumber], $this->RowNumber);
                    $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["tool_bar_id"][$this->RowNumber] = "";
                    $this->caption->SetText("");
                    $this->tooltip->SetText("");
                    $this->accion->SetText("");
                    $this->usuario_id->SetText("");
                    $this->actulizar->SetValue(false);
                    $this->usar_en->SetText("");
                } else {
                    $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
                    $this->tooltip->SetText($this->FormParameters["tooltip"][$this->RowNumber], $this->RowNumber);
                    $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
                    $this->usuario_id->SetText($this->FormParameters["usuario_id"][$this->RowNumber], $this->RowNumber);
                    $this->actulizar->SetText($this->FormParameters["actulizar"][$this->RowNumber], $this->RowNumber);
                    $this->usar_en->SetText($this->FormParameters["usar_en"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->caption->Show($this->RowNumber);
                $this->tooltip->Show($this->RowNumber);
                $this->accion->Show($this->RowNumber);
                $this->usuario_id->Show($this->RowNumber);
                $this->actulizar->Show($this->RowNumber);
                $this->usar_en->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["tool_bar_id"] == $this->CachedColumns["tool_bar_id"][$this->RowNumber])) {
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
        $this->tool_bar_TotalRecords->Show();
        $this->Sorter_caption->Show();
        $this->Sorter_tooltip->Show();
        $this->Sorter_accion->Show();
        $this->Sorter_usuario_id->Show();
        $this->Sorter_actulizar->Show();
        $this->Sorter_usar_en->Show();
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

} //End tool_bar Class @19-FCB6E20C

class clstool_barDataSource extends clsDBDatos {  //tool_barDataSource Class @19-C0FBED60

//DataSource Variables @19-763044FF
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
    public $caption;
    public $tooltip;
    public $accion;
    public $usuario_id;
    public $actulizar;
    public $usar_en;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @19-9CBB203A
    function clstool_barDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid tool_bar/Error";
        $this->Initialize();
        $this->caption = new clsField("caption", ccsText, "");
        
        $this->tooltip = new clsField("tooltip", ccsText, "");
        
        $this->accion = new clsField("accion", ccsText, "");
        
        $this->usuario_id = new clsField("usuario_id", ccsInteger, "");
        
        $this->actulizar = new clsField("actulizar", ccsText, "");
        
        $this->usar_en = new clsField("usar_en", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["caption"] = array("Name" => "caption", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["tooltip"] = array("Name" => "tooltip", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["accion"] = array("Name" => "accion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["usuario_id"] = array("Name" => "usuario_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["actulizar"] = array("Name" => "actulizar", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["usar_en"] = array("Name" => "usar_en", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["caption"] = array("Name" => "caption", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["tooltip"] = array("Name" => "tooltip", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["accion"] = array("Name" => "accion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["usuario_id"] = array("Name" => "usuario_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["actulizar"] = array("Name" => "actulizar", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["usar_en"] = array("Name" => "usar_en", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @19-D9168E16
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "usuario_id, caption";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_caption" => array("caption", ""), 
            "Sorter_tooltip" => array("tooltip", ""), 
            "Sorter_accion" => array("accion", ""), 
            "Sorter_usuario_id" => array("usuario_id", ""), 
            "Sorter_actulizar" => array("actulizar", ""), 
            "Sorter_usar_en" => array("usar_en", "")));
    }
//End SetOrder Method

//Prepare Method @19-411B7A12
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_usuario_id", ccsInteger, "", "", $this->Parameters["urls_usuario_id"], "", false);
        $this->wp->AddParameter("2", "urls_caption", ccsText, "", "", $this->Parameters["urls_caption"], "", false);
        $this->wp->AddParameter("3", "urls_accion", ccsText, "", "", $this->Parameters["urls_accion"], "", false);
        $this->wp->AddParameter("4", "expr54", ccsInteger, "", "", $this->Parameters["expr54"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "usuario_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "caption", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "accion", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "usuario_id", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsInteger),false);
        $this->wp->Criterion[5] = "( " .  CCGetGroupID() . " > 16 )";
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), $this->wp->opOR(
             true, 
             $this->wp->Criterion[4], 
             $this->wp->Criterion[5]));
    }
//End Prepare Method

//Open Method @19-2F6F4D6E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tool_bar";
        $this->SQL = "SELECT * \n\n" .
        "FROM tool_bar {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @19-FC1F8C11
    function SetValues()
    {
        $this->CachedColumns["tool_bar_id"] = $this->f("tool_bar_id");
        $this->caption->SetDBValue($this->f("caption"));
        $this->tooltip->SetDBValue($this->f("tooltip"));
        $this->accion->SetDBValue($this->f("accion"));
        $this->usuario_id->SetDBValue(trim($this->f("usuario_id")));
        $this->actulizar->SetDBValue($this->f("actulizar"));
        $this->usar_en->SetDBValue($this->f("usar_en"));
    }
//End SetValues Method

//Insert Method @19-76DF793B
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["caption"]["Value"] = $this->caption->GetDBValue(true);
        $this->InsertFields["tooltip"]["Value"] = $this->tooltip->GetDBValue(true);
        $this->InsertFields["accion"]["Value"] = $this->accion->GetDBValue(true);
        $this->InsertFields["usuario_id"]["Value"] = $this->usuario_id->GetDBValue(true);
        $this->InsertFields["actulizar"]["Value"] = $this->actulizar->GetDBValue(true);
        $this->InsertFields["usar_en"]["Value"] = $this->usar_en->GetDBValue(true);
        $this->SQL = CCBuildInsert("tool_bar", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @19-3F628C78
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "tool_bar_id=" . $this->ToSQL($this->CachedColumns["tool_bar_id"], ccsInteger);
        $this->UpdateFields["caption"]["Value"] = $this->caption->GetDBValue(true);
        $this->UpdateFields["tooltip"]["Value"] = $this->tooltip->GetDBValue(true);
        $this->UpdateFields["accion"]["Value"] = $this->accion->GetDBValue(true);
        $this->UpdateFields["usuario_id"]["Value"] = $this->usuario_id->GetDBValue(true);
        $this->UpdateFields["actulizar"]["Value"] = $this->actulizar->GetDBValue(true);
        $this->UpdateFields["usar_en"]["Value"] = $this->usar_en->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tool_bar", $this->UpdateFields, $this);
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

//Delete Method @19-1C7CD0A9
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "tool_bar_id=" . $this->ToSQL($this->CachedColumns["tool_bar_id"], ccsInteger);
        $this->SQL = "DELETE FROM tool_bar";
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

} //End tool_barDataSource Class @19-FCB6E20C

//Initialize Page @1-448E18E4
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
$TemplateFileName = "cfg_toolbar.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-97F21E60
CCSecurityRedirect("4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-33A0322A
include_once("./cfg_toolbar_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C2659D7E
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$tool_barSearch = new clsRecordtool_barSearch("", $MainPage);
$tool_bar = new clsEditableGridtool_bar("", $MainPage);
$MainPage->tool_barSearch = & $tool_barSearch;
$MainPage->tool_bar = & $tool_bar;
$tool_bar->Initialize();
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

//Execute Components @1-FFC950E0
$tool_bar->Operation();
$tool_barSearch->Operation();
//End Execute Components

//Go to destination page @1-E7B9D69D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($tool_barSearch);
    unset($tool_bar);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2054F5D5
$tool_barSearch->Show();
$tool_bar->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D6E828C1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($tool_barSearch);
unset($tool_bar);
unset($Tpl);
//End Unload Page


?>
