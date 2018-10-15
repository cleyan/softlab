<?php
//Include Common Files @1-B4EBEE8C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "cfg_menus.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordmenuSearch { //menuSearch Class @3-F7AFE48E

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

//Class_Initialize Event @3-8076DEC8
    function clsRecordmenuSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record menuSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "menuSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_caption = new clsControl(ccsTextBox, "s_caption", "s_caption", ccsText, "", CCGetRequestParam("s_caption", $Method, NULL), $this);
            $this->s_niver_minimo_id = new clsControl(ccsListBox, "s_niver_minimo_id", "s_niver_minimo_id", ccsInteger, "", CCGetRequestParam("s_niver_minimo_id", $Method, NULL), $this);
            $this->s_niver_minimo_id->DSType = dsTable;
            $this->s_niver_minimo_id->DataSource = new clsDBDatos();
            $this->s_niver_minimo_id->ds = & $this->s_niver_minimo_id->DataSource;
            $this->s_niver_minimo_id->DataSource->SQL = "SELECT * \n" .
"FROM niveles_acceso {SQL_Where} {SQL_OrderBy}";
            list($this->s_niver_minimo_id->BoundColumn, $this->s_niver_minimo_id->TextColumn, $this->s_niver_minimo_id->DBFormat) = array("nivel_acceso_id", "nom_nivel_acceso", "");
            $this->menuPageSize = new clsControl(ccsListBox, "menuPageSize", "menuPageSize", ccsText, "", CCGetRequestParam("menuPageSize", $Method, NULL), $this);
            $this->menuPageSize->DSType = dsListOfValues;
            $this->menuPageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-95A4800B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_caption->Validate() && $Validation);
        $Validation = ($this->s_niver_minimo_id->Validate() && $Validation);
        $Validation = ($this->menuPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_caption->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_niver_minimo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->menuPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-CDE2E46D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_caption->Errors->Count());
        $errors = ($errors || $this->s_niver_minimo_id->Errors->Count());
        $errors = ($errors || $this->menuPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-344B2D95
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
        $Redirect = "cfg_menus.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "cfg_menus.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-1FF63415
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

        $this->s_niver_minimo_id->Prepare();
        $this->menuPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_caption->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_niver_minimo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->menuPageSize->Errors->ToString());
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

        $this->s_caption->Show();
        $this->s_niver_minimo_id->Show();
        $this->menuPageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End menuSearch Class @3-FCB6E20C

class clsEditableGridmenu { //menu Class @2-1BAD33BA

//Variables @2-652CAD45

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
    public $Sorter_icono;
    public $Sorter_accion;
    public $Sorter_niver_minimo_id;
//End Variables

//Class_Initialize Event @2-24816AE7
    function clsEditableGridmenu($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid menu/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "menu";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["menu_id"][0] = "menu_id";
        $this->DataSource = new clsmenuDataSource($this);
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
        $this->FormEnctype = "multipart/form-data";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->SorterName = CCGetParam("menuOrder", "");
        $this->SorterDirection = CCGetParam("menuDir", "");

        $this->Sorter_caption = new clsSorter($this->ComponentName, "Sorter_caption", $FileName, $this);
        $this->Sorter_icono = new clsSorter($this->ComponentName, "Sorter_icono", $FileName, $this);
        $this->Sorter_accion = new clsSorter($this->ComponentName, "Sorter_accion", $FileName, $this);
        $this->Sorter_niver_minimo_id = new clsSorter($this->ComponentName, "Sorter_niver_minimo_id", $FileName, $this);
        $this->caption = new clsControl(ccsTextBox, "caption", "Caption", ccsText, "", NULL, $this);
        $this->FileUpload1 = new clsFileUpload("FileUpload1", "icono", "TEMP/", "images/", "*.jpg;*.gif;*.png", "*.htm;*.html;*.php", 100000, $this);
        $this->accion = new clsControl(ccsTextBox, "accion", "Accion", ccsText, "", NULL, $this);
        $this->niver_minimo_id = new clsControl(ccsListBox, "niver_minimo_id", "Niver Minimo Id", ccsInteger, "", NULL, $this);
        $this->niver_minimo_id->DSType = dsTable;
        $this->niver_minimo_id->DataSource = new clsDBDatos();
        $this->niver_minimo_id->ds = & $this->niver_minimo_id->DataSource;
        $this->niver_minimo_id->DataSource->SQL = "SELECT * \n" .
"FROM niveles_acceso {SQL_Where} {SQL_OrderBy}";
        $this->niver_minimo_id->DataSource->Order = "nom_nivel_acceso";
        list($this->niver_minimo_id->BoundColumn, $this->niver_minimo_id->TextColumn, $this->niver_minimo_id->DBFormat) = array("usuario_id", "nom_usuario", "");
        $this->niver_minimo_id->DataSource->Parameters["expr25"] = CCGetGroupID();
        $this->niver_minimo_id->DataSource->wp = new clsSQLParameters();
        $this->niver_minimo_id->DataSource->wp->AddParameter("1", "expr25", ccsInteger, "", "", $this->niver_minimo_id->DataSource->Parameters["expr25"], 0, false);
        $this->niver_minimo_id->DataSource->wp->Criterion[1] = $this->niver_minimo_id->DataSource->wp->Operation(opLessThanOrEqual, "nivel_acceso_id", $this->niver_minimo_id->DataSource->wp->GetDBValue("1"), $this->niver_minimo_id->DataSource->ToSQL($this->niver_minimo_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
        $this->niver_minimo_id->DataSource->Where = 
             $this->niver_minimo_id->DataSource->wp->Criterion[1];
        $this->niver_minimo_id->DataSource->Order = "nom_nivel_acceso";
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
        $this->ControlsErrors["FileUpload1"] = array();
    }
//End Class_Initialize Event

//Initialize Method @2-FC3CF33F
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_caption"] = CCGetFromGet("s_caption", NULL);
        $this->DataSource->Parameters["urls_niver_minimo_id"] = CCGetFromGet("s_niver_minimo_id", NULL);
        $this->DataSource->Parameters["expr26"] = CCGetGroupID();
    }
//End Initialize Method

//GetFormParameters Method @2-A5A9E063
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["caption"][$RowNumber] = CCGetFromPost("caption_" . $RowNumber, NULL);
            $this->FormParameters["accion"][$RowNumber] = CCGetFromPost("accion_" . $RowNumber, NULL);
            $this->FormParameters["niver_minimo_id"][$RowNumber] = CCGetFromPost("niver_minimo_id_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FileUpload1->Upload($RowNumber);
            $this->FormParameters["FileUpload1"][$RowNumber] = $this->FileUpload1->GetValue();
            $this->ControlsErrors["FileUpload1"][$RowNumber] = $this->FileUpload1->Errors;
            $this->FileUpload1->Errors->Clear();
        }
    }
//End GetFormParameters Method

//Validate Method @2-8E8A92B7
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        $this->ControlsErrors["FileUpload1"][0] = new clsErrors();
        $this->ControlsErrors["FileUpload1"][0]->AddErrors($this->FileUpload1->Errors);
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->FileUpload1->Errors->Clear();
            $this->DataSource->CachedColumns["menu_id"] = $this->CachedColumns["menu_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
            $this->FileUpload1->SetText($this->FormParameters["FileUpload1"][$this->RowNumber], $this->RowNumber);
            $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
            $this->niver_minimo_id->SetText($this->FormParameters["niver_minimo_id"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
            $this->ControlsErrors["FileUpload1"][$this->RowNumber] = new clsErrors();
            $this->ControlsErrors["FileUpload1"][$this->RowNumber]->AddErrors($this->FileUpload1->Errors);
        }
        $this->FileUpload1->Errors->Clear();
        $this->FileUpload1->Errors->AddErrors($this->ControlsErrors["FileUpload1"][0]);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @2-59F4D954
    function ValidateRow()
    {
        global $CCSLocales;
        $this->caption->Validate();
        $this->FileUpload1->Validate();
        $this->accion->Validate();
        $this->niver_minimo_id->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->caption->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FileUpload1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->accion->Errors->ToString());
        $errors = ComposeStrings($errors, $this->niver_minimo_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->caption->Errors->Clear();
        $this->FileUpload1->Errors->Clear();
        $this->accion->Errors->Clear();
        $this->niver_minimo_id->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-500F8587
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["caption"][$this->RowNumber]) && count($this->FormParameters["caption"][$this->RowNumber])) || strlen($this->FormParameters["caption"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["FileUpload1"][$this->RowNumber]) && count($this->FormParameters["FileUpload1"][$this->RowNumber])) || strlen($this->FormParameters["FileUpload1"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["accion"][$this->RowNumber]) && count($this->FormParameters["accion"][$this->RowNumber])) || strlen($this->FormParameters["accion"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["niver_minimo_id"][$this->RowNumber]) && count($this->FormParameters["niver_minimo_id"][$this->RowNumber])) || strlen($this->FormParameters["niver_minimo_id"][$this->RowNumber]));
        $filed = ($filed || $this->FileUpload1->Errors->Count());
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

//UpdateGrid Method @2-81881743
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["menu_id"] = $this->CachedColumns["menu_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
            $this->FileUpload1->SetText($this->FormParameters["FileUpload1"][$this->RowNumber], $this->RowNumber);
            $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
            $this->niver_minimo_id->SetText($this->FormParameters["niver_minimo_id"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @2-D78859A5
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->caption->SetValue($this->caption->GetValue(true));
        $this->DataSource->FileUpload1->SetValue($this->FileUpload1->GetValue(true));
        $this->DataSource->accion->SetValue($this->accion->GetValue(true));
        $this->DataSource->niver_minimo_id->SetValue($this->niver_minimo_id->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        } else {
            $this->FileUpload1->Move();
            $errors = ComposeStrings($errors, $this->FileUpload1->Errors->ToString());
            $this->FileUpload1->Errors->Clear();
            $this->RowsErrors[$this->RowNumber] = $errors;
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @2-A191F357
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->caption->SetValue($this->caption->GetValue(true));
        $this->DataSource->FileUpload1->SetValue($this->FileUpload1->GetValue(true));
        $this->DataSource->accion->SetValue($this->accion->GetValue(true));
        $this->DataSource->niver_minimo_id->SetValue($this->niver_minimo_id->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        } else {
            $this->FileUpload1->Move();
            $errors = ComposeStrings($errors, $this->FileUpload1->Errors->ToString());
            $this->FileUpload1->Errors->Clear();
            $this->RowsErrors[$this->RowNumber] = $errors;
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @2-C275BAEF
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        } else {
            $this->FileUpload1->Delete();
            $errors = ComposeStrings($errors, $this->FileUpload1->Errors->ToString());
            $this->FileUpload1->Errors->Clear();
            $this->RowsErrors[$this->RowNumber] = $errors;
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @2-FCCEC312
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var menuElements;\n";
        $script .= "var menuEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "captionID = 0;\n";
        $script .= "var " . $this->ComponentName . "FileUpload1ID = 1;\n";
        $script .= "var " . $this->ComponentName . "accionID = 2;\n";
        $script .= "var " . $this->ComponentName . "niver_minimo_idID = 3;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 4;\n";
        $script .= "\nfunction initmenuElements() {\n";
        $script .= "\tvar ED = document.forms[\"menu\"];\n";
        $script .= "\tmenuElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.caption_" . $i . ", " . "ED.FileUpload1_" . $i . ", " . "ED.accion_" . $i . ", " . "ED.niver_minimo_id_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-DC2D5E8E
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
                $this->CachedColumns["menu_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["menu_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-54E9C510
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["menu_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-AC430DF4
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->niver_minimo_id->Prepare();

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
        $this->ControlsVisible["FileUpload1"] = $this->FileUpload1->Visible;
        $this->ControlsVisible["accion"] = $this->accion->Visible;
        $this->ControlsVisible["niver_minimo_id"] = $this->niver_minimo_id->Visible;
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
                    $this->CachedColumns["menu_id"][$this->RowNumber] = $this->DataSource->CachedColumns["menu_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->caption->SetValue($this->DataSource->caption->GetValue());
                    $this->FileUpload1->SetValue($this->DataSource->FileUpload1->GetValue());
                    $this->accion->SetValue($this->DataSource->accion->GetValue());
                    $this->niver_minimo_id->SetValue($this->DataSource->niver_minimo_id->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload1->SetText($this->FormParameters["FileUpload1"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload1->Errors->Clear();
                    if (isset($this->ControlsErrors["FileUpload1"][$this->RowNumber]))
                        $this->FileUpload1->Errors->AddErrors($this->ControlsErrors["FileUpload1"][$this->RowNumber]);
                    $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
                    $this->niver_minimo_id->SetText($this->FormParameters["niver_minimo_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["menu_id"][$this->RowNumber] = "";
                    $this->caption->SetText("");
                    $this->FileUpload1->SetText("");
                    $this->accion->SetText("");
                    $this->niver_minimo_id->SetText("");
                    $this->FileUpload1->Errors->Clear();
                    if (isset($this->ControlsErrors["FileUpload1"][$this->RowNumber]))
                        $this->FileUpload1->Errors->AddErrors($this->ControlsErrors["FileUpload1"][$this->RowNumber]);
                } else {
                    $this->caption->SetText($this->FormParameters["caption"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload1->SetText($this->FormParameters["FileUpload1"][$this->RowNumber], $this->RowNumber);
                    $this->FileUpload1->Errors->Clear();
                    if (isset($this->ControlsErrors["FileUpload1"][$this->RowNumber]))
                        $this->FileUpload1->Errors->AddErrors($this->ControlsErrors["FileUpload1"][$this->RowNumber]);
                    $this->accion->SetText($this->FormParameters["accion"][$this->RowNumber], $this->RowNumber);
                    $this->niver_minimo_id->SetText($this->FormParameters["niver_minimo_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->caption->Show($this->RowNumber);
                $this->FileUpload1->Show($this->RowNumber);
                $this->accion->Show($this->RowNumber);
                $this->niver_minimo_id->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["menu_id"] == $this->CachedColumns["menu_id"][$this->RowNumber])) {
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
        $this->Sorter_caption->Show();
        $this->Sorter_icono->Show();
        $this->Sorter_accion->Show();
        $this->Sorter_niver_minimo_id->Show();
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

} //End menu Class @2-FCB6E20C

class clsmenuDataSource extends clsDBDatos {  //menuDataSource Class @2-044516AC

//DataSource Variables @2-C4581A6D
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
    public $FileUpload1;
    public $accion;
    public $niver_minimo_id;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-5CA3D99C
    function clsmenuDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid menu/Error";
        $this->Initialize();
        $this->caption = new clsField("caption", ccsText, "");
        
        $this->FileUpload1 = new clsField("FileUpload1", ccsText, "");
        
        $this->accion = new clsField("accion", ccsText, "");
        
        $this->niver_minimo_id = new clsField("niver_minimo_id", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["caption"] = array("Name" => "caption", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["icono"] = array("Name" => "icono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["accion"] = array("Name" => "accion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["niver_minimo_id"] = array("Name" => "niver_minimo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["caption"] = array("Name" => "caption", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["icono"] = array("Name" => "icono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["accion"] = array("Name" => "accion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["niver_minimo_id"] = array("Name" => "niver_minimo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-D4059002
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_caption" => array("caption", ""), 
            "Sorter_icono" => array("icono", ""), 
            "Sorter_accion" => array("accion", ""), 
            "Sorter_niver_minimo_id" => array("niver_minimo_id", "")));
    }
//End SetOrder Method

//Prepare Method @2-65EE4227
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_caption", ccsText, "", "", $this->Parameters["urls_caption"], "", false);
        $this->wp->AddParameter("2", "urls_niver_minimo_id", ccsInteger, "", "", $this->Parameters["urls_niver_minimo_id"], "", false);
        $this->wp->AddParameter("3", "expr26", ccsInteger, "", "", $this->Parameters["expr26"], 0, false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "caption", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "niver_minimo_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opLessThanOrEqual, "niver_minimo_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-5995FDDD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM menu";
        $this->SQL = "SELECT * \n\n" .
        "FROM menu {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-773FE450
    function SetValues()
    {
        $this->CachedColumns["menu_id"] = $this->f("menu_id");
        $this->caption->SetDBValue($this->f("caption"));
        $this->FileUpload1->SetDBValue($this->f("icono"));
        $this->accion->SetDBValue($this->f("accion"));
        $this->niver_minimo_id->SetDBValue(trim($this->f("niver_minimo_id")));
    }
//End SetValues Method

//Insert Method @2-D7895E64
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["caption"]["Value"] = $this->caption->GetDBValue(true);
        $this->InsertFields["icono"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->InsertFields["accion"]["Value"] = $this->accion->GetDBValue(true);
        $this->InsertFields["niver_minimo_id"]["Value"] = $this->niver_minimo_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("menu", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-78D138EB
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "menu_id=" . $this->ToSQL($this->CachedColumns["menu_id"], ccsInteger);
        $this->UpdateFields["caption"]["Value"] = $this->caption->GetDBValue(true);
        $this->UpdateFields["icono"]["Value"] = $this->FileUpload1->GetDBValue(true);
        $this->UpdateFields["accion"]["Value"] = $this->accion->GetDBValue(true);
        $this->UpdateFields["niver_minimo_id"]["Value"] = $this->niver_minimo_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("menu", $this->UpdateFields, $this);
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

//Delete Method @2-3F77D21A
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "menu_id=" . $this->ToSQL($this->CachedColumns["menu_id"], ccsInteger);
        $this->SQL = "DELETE FROM menu";
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

} //End menuDataSource Class @2-FCB6E20C

//Initialize Page @1-A0114A5B
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
$TemplateFileName = "cfg_menus.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-888B50A6
include_once("./cfg_menus_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-90F862D6
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$menuSearch = new clsRecordmenuSearch("", $MainPage);
$menu = new clsEditableGridmenu("", $MainPage);
$MainPage->menuSearch = & $menuSearch;
$MainPage->menu = & $menu;
$menu->Initialize();
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

//Execute Components @1-49270E65
$menu->Operation();
$menuSearch->Operation();
//End Execute Components

//Go to destination page @1-803F930E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($menuSearch);
    unset($menu);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-11CDBDCD
$menuSearch->Show();
$menu->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-0E528888
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($menuSearch);
unset($menu);
unset($Tpl);
//End Unload Page


?>
