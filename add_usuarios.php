<?php
//Include Common Files @1-5548D266
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_usuarios.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordusuariosSearch { //usuariosSearch Class @3-479B4C56

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

//Class_Initialize Event @3-8FB49BAC
    function clsRecordusuariosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record usuariosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "usuariosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_usuario = new clsControl(ccsTextBox, "s_usuario", "s_usuario", ccsText, "", CCGetRequestParam("s_usuario", $Method, NULL), $this);
            $this->s_nivel = new clsControl(ccsListBox, "s_nivel", "s_nivel", ccsInteger, "", CCGetRequestParam("s_nivel", $Method, NULL), $this);
            $this->s_nivel->DSType = dsTable;
            $this->s_nivel->DataSource = new clsDBDatos();
            $this->s_nivel->ds = & $this->s_nivel->DataSource;
            $this->s_nivel->DataSource->SQL = "SELECT * \n" .
"FROM niveles_acceso {SQL_Where} {SQL_OrderBy}";
            list($this->s_nivel->BoundColumn, $this->s_nivel->TextColumn, $this->s_nivel->DBFormat) = array("nivel_acceso_id", "nom_nivel_acceso", "");
            $this->s_nivel->DataSource->Parameters["expr42"] = CCGetGroupID();
            $this->s_nivel->DataSource->wp = new clsSQLParameters();
            $this->s_nivel->DataSource->wp->AddParameter("1", "expr42", ccsInteger, "", "", $this->s_nivel->DataSource->Parameters["expr42"], "", true);
            $this->s_nivel->DataSource->wp->Criterion[1] = $this->s_nivel->DataSource->wp->Operation(opLessThanOrEqual, "nivel_acceso_id", $this->s_nivel->DataSource->wp->GetDBValue("1"), $this->s_nivel->DataSource->ToSQL($this->s_nivel->DataSource->wp->GetDBValue("1"), ccsInteger),true);
            $this->s_nivel->DataSource->Where = 
                 $this->s_nivel->DataSource->wp->Criterion[1];
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-CE94A35B
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_usuario->Validate() && $Validation);
        $Validation = ($this->s_nivel->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_usuario->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nivel->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-B52AC0CF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_usuario->Errors->Count());
        $errors = ($errors || $this->s_nivel->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-0E721A23
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
        $Redirect = "add_usuarios.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "add_usuarios.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-66F757DE
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

        $this->s_nivel->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_usuario->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nivel->Errors->ToString());
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

        $this->s_usuario->Show();
        $this->s_nivel->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End usuariosSearch Class @3-FCB6E20C

class clsEditableGridusuarios { //usuarios Class @43-7F48A57B

//Variables @43-EEC73A4B

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
    public $Sorter_nom_usuario;
    public $Sorter_log_usuario;
    public $Sorter_clave;
    public $Sorter_procedencia_id;
    public $Sorter_seccion_id;
//End Variables

//Class_Initialize Event @43-87652C97
    function clsEditableGridusuarios($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid usuarios/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "usuarios";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["usuario_id"][0] = "usuario_id";
        $this->DataSource = new clsusuariosDataSource($this);
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

        $this->SorterName = CCGetParam("usuariosOrder", "");
        $this->SorterDirection = CCGetParam("usuariosDir", "");

        $this->usuarios_TotalRecords = new clsControl(ccsLabel, "usuarios_TotalRecords", "usuarios_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_nom_usuario = new clsSorter($this->ComponentName, "Sorter_nom_usuario", $FileName, $this);
        $this->Sorter_log_usuario = new clsSorter($this->ComponentName, "Sorter_log_usuario", $FileName, $this);
        $this->Sorter_clave = new clsSorter($this->ComponentName, "Sorter_clave", $FileName, $this);
        $this->Sorter_procedencia_id = new clsSorter($this->ComponentName, "Sorter_procedencia_id", $FileName, $this);
        $this->Sorter_seccion_id = new clsSorter($this->ComponentName, "Sorter_seccion_id", $FileName, $this);
        $this->nom_usuario = new clsControl(ccsTextBox, "nom_usuario", "Nom Usuario", ccsText, "", NULL, $this);
        $this->nom_usuario->Required = true;
        $this->log_usuario = new clsControl(ccsTextBox, "log_usuario", "Log Usuario", ccsText, "", NULL, $this);
        $this->log_usuario->Required = true;
        $this->clave = new clsControl(ccsTextBox, "clave", "Clave", ccsText, "", NULL, $this);
        $this->clave->Required = true;
        $this->nivel_acceso_id = new clsControl(ccsListBox, "nivel_acceso_id", "Nivel Acceso Id", ccsInteger, "", NULL, $this);
        $this->nivel_acceso_id->DSType = dsTable;
        $this->nivel_acceso_id->DataSource = new clsDBDatos();
        $this->nivel_acceso_id->ds = & $this->nivel_acceso_id->DataSource;
        $this->nivel_acceso_id->DataSource->SQL = "SELECT * \n" .
"FROM niveles_acceso {SQL_Where} {SQL_OrderBy}";
        $this->nivel_acceso_id->DataSource->Order = "nivel_acceso_id";
        list($this->nivel_acceso_id->BoundColumn, $this->nivel_acceso_id->TextColumn, $this->nivel_acceso_id->DBFormat) = array("nivel_acceso_id", "nom_nivel_acceso", "");
        $this->nivel_acceso_id->DataSource->Parameters["expr65"] = CCGetGroupID();
        $this->nivel_acceso_id->DataSource->wp = new clsSQLParameters();
        $this->nivel_acceso_id->DataSource->wp->AddParameter("1", "expr65", ccsInteger, "", "", $this->nivel_acceso_id->DataSource->Parameters["expr65"], "", true);
        $this->nivel_acceso_id->DataSource->wp->Criterion[1] = $this->nivel_acceso_id->DataSource->wp->Operation(opLessThanOrEqual, "nivel_acceso_id", $this->nivel_acceso_id->DataSource->wp->GetDBValue("1"), $this->nivel_acceso_id->DataSource->ToSQL($this->nivel_acceso_id->DataSource->wp->GetDBValue("1"), ccsInteger),true);
        $this->nivel_acceso_id->DataSource->Where = 
             $this->nivel_acceso_id->DataSource->wp->Criterion[1];
        $this->nivel_acceso_id->DataSource->Order = "nivel_acceso_id";
        $this->nivel_acceso_id->Required = true;
        $this->procedencia_id = new clsControl(ccsListBox, "procedencia_id", "Procedencia Id", ccsInteger, "", NULL, $this);
        $this->procedencia_id->DSType = dsTable;
        $this->procedencia_id->DataSource = new clsDBDatos();
        $this->procedencia_id->ds = & $this->procedencia_id->DataSource;
        $this->procedencia_id->DataSource->SQL = "SELECT * \n" .
"FROM procedencias {SQL_Where} {SQL_OrderBy}";
        $this->procedencia_id->DataSource->Order = "nom_procedencia";
        list($this->procedencia_id->BoundColumn, $this->procedencia_id->TextColumn, $this->procedencia_id->DBFormat) = array("procedencia_id", "nom_procedencia", "");
        $this->procedencia_id->DataSource->Order = "nom_procedencia";
        $this->seccion_id = new clsControl(ccsListBox, "seccion_id", "Seccion Id", ccsInteger, "", NULL, $this);
        $this->seccion_id->DSType = dsTable;
        $this->seccion_id->DataSource = new clsDBDatos();
        $this->seccion_id->ds = & $this->seccion_id->DataSource;
        $this->seccion_id->DataSource->SQL = "SELECT * \n" .
"FROM secciones {SQL_Where} {SQL_OrderBy}";
        $this->seccion_id->DataSource->Order = "nom_seccion";
        list($this->seccion_id->BoundColumn, $this->seccion_id->TextColumn, $this->seccion_id->DBFormat) = array("seccion_id", "nom_seccion", "");
        $this->seccion_id->DataSource->Parameters["expr66"] = 'V';
        $this->seccion_id->DataSource->wp = new clsSQLParameters();
        $this->seccion_id->DataSource->wp->AddParameter("1", "expr66", ccsText, "", "", $this->seccion_id->DataSource->Parameters["expr66"], 'V', false);
        $this->seccion_id->DataSource->wp->Criterion[1] = $this->seccion_id->DataSource->wp->Operation(opEqual, "activo", $this->seccion_id->DataSource->wp->GetDBValue("1"), $this->seccion_id->DataSource->ToSQL($this->seccion_id->DataSource->wp->GetDBValue("1"), ccsText),false);
        $this->seccion_id->DataSource->Where = 
             $this->seccion_id->DataSource->wp->Criterion[1];
        $this->seccion_id->DataSource->Order = "nom_seccion";
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @43-67D2480F
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_usuario"] = CCGetFromGet("s_usuario", NULL);
        $this->DataSource->Parameters["expr69"] = CCGetGroupID();
    }
//End Initialize Method

//GetFormParameters Method @43-B4529C09
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["nom_usuario"][$RowNumber] = CCGetFromPost("nom_usuario_" . $RowNumber, NULL);
            $this->FormParameters["log_usuario"][$RowNumber] = CCGetFromPost("log_usuario_" . $RowNumber, NULL);
            $this->FormParameters["clave"][$RowNumber] = CCGetFromPost("clave_" . $RowNumber, NULL);
            $this->FormParameters["nivel_acceso_id"][$RowNumber] = CCGetFromPost("nivel_acceso_id_" . $RowNumber, NULL);
            $this->FormParameters["procedencia_id"][$RowNumber] = CCGetFromPost("procedencia_id_" . $RowNumber, NULL);
            $this->FormParameters["seccion_id"][$RowNumber] = CCGetFromPost("seccion_id_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @43-1D80EA8D
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $this->StoredValues = array();

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["usuario_id"] = $this->CachedColumns["usuario_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->nom_usuario->SetText($this->FormParameters["nom_usuario"][$this->RowNumber], $this->RowNumber);
            $this->log_usuario->SetText($this->FormParameters["log_usuario"][$this->RowNumber], $this->RowNumber);
            $this->clave->SetText($this->FormParameters["clave"][$this->RowNumber], $this->RowNumber);
            $this->nivel_acceso_id->SetText($this->FormParameters["nivel_acceso_id"][$this->RowNumber], $this->RowNumber);
            $this->procedencia_id->SetText($this->FormParameters["procedencia_id"][$this->RowNumber], $this->RowNumber);
            $this->seccion_id->SetText($this->FormParameters["seccion_id"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @43-21DCD87B
    function ValidateRow()
    {
        global $CCSLocales;
        if(strlen($this->CachedColumns["usuario_id"][$this->RowNumber])) 
            $Where = " AND usuario_id <> " . $this->DataSource->ToSQL($this->CachedColumns["usuario_id"][$this->RowNumber], ccsInteger); 
        else
            $Where = "";
        if (!isset($this->StoredValues["nom_usuario"])) $this->StoredValues["nom_usuario"] = array();
        $this->DataSource->nom_usuario->SetValue($this->nom_usuario->GetValue());
        if(CCDLookUp("COUNT(*)", "usuarios", "nom_usuario=" . $this->DataSource->ToSQL($this->DataSource->nom_usuario->GetDBValue(), $this->DataSource->nom_usuario->DataType) . $Where, $this->DataSource) > 0)
            $this->nom_usuario->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Nom Usuario"));
        else if (in_array($this->nom_usuario->GetValue(), $this->StoredValues["nom_usuario"]))
            $this->nom_usuario->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Nom Usuario"));
        $this->StoredValues["nom_usuario"][] = $this->nom_usuario->GetValue();
        if (!isset($this->StoredValues["log_usuario"])) $this->StoredValues["log_usuario"] = array();
        $this->DataSource->log_usuario->SetValue($this->log_usuario->GetValue());
        if(CCDLookUp("COUNT(*)", "usuarios", "log_usuario=" . $this->DataSource->ToSQL($this->DataSource->log_usuario->GetDBValue(), $this->DataSource->log_usuario->DataType) . $Where, $this->DataSource) > 0)
            $this->log_usuario->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Log Usuario"));
        else if (in_array($this->log_usuario->GetValue(), $this->StoredValues["log_usuario"]))
            $this->log_usuario->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Log Usuario"));
        $this->StoredValues["log_usuario"][] = $this->log_usuario->GetValue();
        $this->nom_usuario->Validate();
        $this->log_usuario->Validate();
        $this->clave->Validate();
        $this->nivel_acceso_id->Validate();
        $this->procedencia_id->Validate();
        $this->seccion_id->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->nom_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->log_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->clave->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nivel_acceso_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->procedencia_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->seccion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->nom_usuario->Errors->Clear();
        $this->log_usuario->Errors->Clear();
        $this->clave->Errors->Clear();
        $this->nivel_acceso_id->Errors->Clear();
        $this->procedencia_id->Errors->Clear();
        $this->seccion_id->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @43-A74B10D3
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["nom_usuario"][$this->RowNumber]) && count($this->FormParameters["nom_usuario"][$this->RowNumber])) || strlen($this->FormParameters["nom_usuario"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["log_usuario"][$this->RowNumber]) && count($this->FormParameters["log_usuario"][$this->RowNumber])) || strlen($this->FormParameters["log_usuario"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["clave"][$this->RowNumber]) && count($this->FormParameters["clave"][$this->RowNumber])) || strlen($this->FormParameters["clave"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nivel_acceso_id"][$this->RowNumber]) && count($this->FormParameters["nivel_acceso_id"][$this->RowNumber])) || strlen($this->FormParameters["nivel_acceso_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["procedencia_id"][$this->RowNumber]) && count($this->FormParameters["procedencia_id"][$this->RowNumber])) || strlen($this->FormParameters["procedencia_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["seccion_id"][$this->RowNumber]) && count($this->FormParameters["seccion_id"][$this->RowNumber])) || strlen($this->FormParameters["seccion_id"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @43-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @43-5566944D
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

//UpdateGrid Method @43-2C054354
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["usuario_id"] = $this->CachedColumns["usuario_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->nom_usuario->SetText($this->FormParameters["nom_usuario"][$this->RowNumber], $this->RowNumber);
            $this->log_usuario->SetText($this->FormParameters["log_usuario"][$this->RowNumber], $this->RowNumber);
            $this->clave->SetText($this->FormParameters["clave"][$this->RowNumber], $this->RowNumber);
            $this->nivel_acceso_id->SetText($this->FormParameters["nivel_acceso_id"][$this->RowNumber], $this->RowNumber);
            $this->procedencia_id->SetText($this->FormParameters["procedencia_id"][$this->RowNumber], $this->RowNumber);
            $this->seccion_id->SetText($this->FormParameters["seccion_id"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @43-EDE4630B
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->nom_usuario->SetValue($this->nom_usuario->GetValue(true));
        $this->DataSource->log_usuario->SetValue($this->log_usuario->GetValue(true));
        $this->DataSource->clave->SetValue($this->clave->GetValue(true));
        $this->DataSource->nivel_acceso_id->SetValue($this->nivel_acceso_id->GetValue(true));
        $this->DataSource->procedencia_id->SetValue($this->procedencia_id->GetValue(true));
        $this->DataSource->seccion_id->SetValue($this->seccion_id->GetValue(true));
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

//UpdateRow Method @43-04AD498E
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->nom_usuario->SetValue($this->nom_usuario->GetValue(true));
        $this->DataSource->log_usuario->SetValue($this->log_usuario->GetValue(true));
        $this->DataSource->clave->SetValue($this->clave->GetValue(true));
        $this->DataSource->nivel_acceso_id->SetValue($this->nivel_acceso_id->GetValue(true));
        $this->DataSource->procedencia_id->SetValue($this->procedencia_id->GetValue(true));
        $this->DataSource->seccion_id->SetValue($this->seccion_id->GetValue(true));
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

//DeleteRow Method @43-A4A656F6
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

//FormScript Method @43-3B702CA1
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var usuariosElements;\n";
        $script .= "var usuariosEmptyRows = 1;\n";
        $script .= "var " . $this->ComponentName . "nom_usuarioID = 0;\n";
        $script .= "var " . $this->ComponentName . "log_usuarioID = 1;\n";
        $script .= "var " . $this->ComponentName . "claveID = 2;\n";
        $script .= "var " . $this->ComponentName . "nivel_acceso_idID = 3;\n";
        $script .= "var " . $this->ComponentName . "procedencia_idID = 4;\n";
        $script .= "var " . $this->ComponentName . "seccion_idID = 5;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 6;\n";
        $script .= "\nfunction initusuariosElements() {\n";
        $script .= "\tvar ED = document.forms[\"usuarios\"];\n";
        $script .= "\tusuariosElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.nom_usuario_" . $i . ", " . "ED.log_usuario_" . $i . ", " . "ED.clave_" . $i . ", " . "ED.nivel_acceso_id_" . $i . ", " . "ED.procedencia_id_" . $i . ", " . "ED.seccion_id_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @43-57209705
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
                $this->CachedColumns["usuario_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["usuario_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @43-229AAFF7
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["usuario_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @43-26FC3613
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->nivel_acceso_id->Prepare();
        $this->procedencia_id->Prepare();
        $this->seccion_id->Prepare();

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
        $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
        $this->ControlsVisible["log_usuario"] = $this->log_usuario->Visible;
        $this->ControlsVisible["clave"] = $this->clave->Visible;
        $this->ControlsVisible["nivel_acceso_id"] = $this->nivel_acceso_id->Visible;
        $this->ControlsVisible["procedencia_id"] = $this->procedencia_id->Visible;
        $this->ControlsVisible["seccion_id"] = $this->seccion_id->Visible;
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
                    $this->CachedColumns["usuario_id"][$this->RowNumber] = $this->DataSource->CachedColumns["usuario_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                    $this->log_usuario->SetValue($this->DataSource->log_usuario->GetValue());
                    $this->clave->SetValue($this->DataSource->clave->GetValue());
                    $this->nivel_acceso_id->SetValue($this->DataSource->nivel_acceso_id->GetValue());
                    $this->procedencia_id->SetValue($this->DataSource->procedencia_id->GetValue());
                    $this->seccion_id->SetValue($this->DataSource->seccion_id->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->nom_usuario->SetText($this->FormParameters["nom_usuario"][$this->RowNumber], $this->RowNumber);
                    $this->log_usuario->SetText($this->FormParameters["log_usuario"][$this->RowNumber], $this->RowNumber);
                    $this->clave->SetText($this->FormParameters["clave"][$this->RowNumber], $this->RowNumber);
                    $this->nivel_acceso_id->SetText($this->FormParameters["nivel_acceso_id"][$this->RowNumber], $this->RowNumber);
                    $this->procedencia_id->SetText($this->FormParameters["procedencia_id"][$this->RowNumber], $this->RowNumber);
                    $this->seccion_id->SetText($this->FormParameters["seccion_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["usuario_id"][$this->RowNumber] = "";
                    $this->nom_usuario->SetText("");
                    $this->log_usuario->SetText("");
                    $this->clave->SetText("");
                    $this->nivel_acceso_id->SetText("");
                    $this->procedencia_id->SetText("");
                    $this->seccion_id->SetText("");
                } else {
                    $this->nom_usuario->SetText($this->FormParameters["nom_usuario"][$this->RowNumber], $this->RowNumber);
                    $this->log_usuario->SetText($this->FormParameters["log_usuario"][$this->RowNumber], $this->RowNumber);
                    $this->clave->SetText($this->FormParameters["clave"][$this->RowNumber], $this->RowNumber);
                    $this->nivel_acceso_id->SetText($this->FormParameters["nivel_acceso_id"][$this->RowNumber], $this->RowNumber);
                    $this->procedencia_id->SetText($this->FormParameters["procedencia_id"][$this->RowNumber], $this->RowNumber);
                    $this->seccion_id->SetText($this->FormParameters["seccion_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->nom_usuario->Show($this->RowNumber);
                $this->log_usuario->Show($this->RowNumber);
                $this->clave->Show($this->RowNumber);
                $this->nivel_acceso_id->Show($this->RowNumber);
                $this->procedencia_id->Show($this->RowNumber);
                $this->seccion_id->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["usuario_id"] == $this->CachedColumns["usuario_id"][$this->RowNumber])) {
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
        $this->usuarios_TotalRecords->Show();
        $this->Sorter_nom_usuario->Show();
        $this->Sorter_log_usuario->Show();
        $this->Sorter_clave->Show();
        $this->Sorter_procedencia_id->Show();
        $this->Sorter_seccion_id->Show();
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

} //End usuarios Class @43-FCB6E20C

class clsusuariosDataSource extends clsDBDatos {  //usuariosDataSource Class @43-A570ED29

//DataSource Variables @43-DFE55BEF
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
    public $nom_usuario;
    public $log_usuario;
    public $clave;
    public $nivel_acceso_id;
    public $procedencia_id;
    public $seccion_id;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @43-81243FA2
    function clsusuariosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid usuarios/Error";
        $this->Initialize();
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        
        $this->log_usuario = new clsField("log_usuario", ccsText, "");
        
        $this->clave = new clsField("clave", ccsText, "");
        
        $this->nivel_acceso_id = new clsField("nivel_acceso_id", ccsInteger, "");
        
        $this->procedencia_id = new clsField("procedencia_id", ccsInteger, "");
        
        $this->seccion_id = new clsField("seccion_id", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["nom_usuario"] = array("Name" => "nom_usuario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["log_usuario"] = array("Name" => "log_usuario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["clave"] = array("Name" => "clave", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nivel_acceso_id"] = array("Name" => "nivel_acceso_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["procedencia_id"] = array("Name" => "procedencia_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["seccion_id"] = array("Name" => "seccion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_usuario"] = array("Name" => "nom_usuario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["log_usuario"] = array("Name" => "log_usuario", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["clave"] = array("Name" => "clave", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nivel_acceso_id"] = array("Name" => "nivel_acceso_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["procedencia_id"] = array("Name" => "procedencia_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["seccion_id"] = array("Name" => "seccion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @43-AE82A12B
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "nom_usuario";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_usuario" => array("nom_usuario", ""), 
            "Sorter_log_usuario" => array("log_usuario", ""), 
            "Sorter_clave" => array("clave", ""), 
            "Sorter_procedencia_id" => array("procedencia_id", ""), 
            "Sorter_seccion_id" => array("seccion_id", "")));
    }
//End SetOrder Method

//Prepare Method @43-1A27D37A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_usuario", ccsText, "", "", $this->Parameters["urls_usuario"], "", false);
        $this->wp->AddParameter("2", "urls_usuario", ccsText, "", "", $this->Parameters["urls_usuario"], "", false);
        $this->wp->AddParameter("3", "expr69", ccsInteger, "", "", $this->Parameters["expr69"], "", true);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "log_usuario", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "nom_usuario", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opLessThanOrEqual, "nivel_acceso_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),true);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opOR(
             true, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @43-0C45F8BC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM usuarios";
        $this->SQL = "SELECT * \n\n" .
        "FROM usuarios {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @43-E8157EFF
    function SetValues()
    {
        $this->CachedColumns["usuario_id"] = $this->f("usuario_id");
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
        $this->log_usuario->SetDBValue($this->f("log_usuario"));
        $this->clave->SetDBValue($this->f("clave"));
        $this->nivel_acceso_id->SetDBValue(trim($this->f("nivel_acceso_id")));
        $this->procedencia_id->SetDBValue(trim($this->f("procedencia_id")));
        $this->seccion_id->SetDBValue(trim($this->f("seccion_id")));
    }
//End SetValues Method

//Insert Method @43-683F4943
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["nom_usuario"]["Value"] = $this->nom_usuario->GetDBValue(true);
        $this->InsertFields["log_usuario"]["Value"] = $this->log_usuario->GetDBValue(true);
        $this->InsertFields["clave"]["Value"] = $this->clave->GetDBValue(true);
        $this->InsertFields["nivel_acceso_id"]["Value"] = $this->nivel_acceso_id->GetDBValue(true);
        $this->InsertFields["procedencia_id"]["Value"] = $this->procedencia_id->GetDBValue(true);
        $this->InsertFields["seccion_id"]["Value"] = $this->seccion_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("usuarios", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @43-B2DCE9C3
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "usuario_id=" . $this->ToSQL($this->CachedColumns["usuario_id"], ccsInteger);
        $this->UpdateFields["nom_usuario"]["Value"] = $this->nom_usuario->GetDBValue(true);
        $this->UpdateFields["log_usuario"]["Value"] = $this->log_usuario->GetDBValue(true);
        $this->UpdateFields["clave"]["Value"] = $this->clave->GetDBValue(true);
        $this->UpdateFields["nivel_acceso_id"]["Value"] = $this->nivel_acceso_id->GetDBValue(true);
        $this->UpdateFields["procedencia_id"]["Value"] = $this->procedencia_id->GetDBValue(true);
        $this->UpdateFields["seccion_id"]["Value"] = $this->seccion_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("usuarios", $this->UpdateFields, $this);
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

//Delete Method @43-12AC65CB
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "usuario_id=" . $this->ToSQL($this->CachedColumns["usuario_id"], ccsInteger);
        $this->SQL = "DELETE FROM usuarios";
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

} //End usuariosDataSource Class @43-FCB6E20C

//Initialize Page @1-270AB444
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
$TemplateFileName = "add_usuarios.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-AE20F43E
CCSecurityRedirect("16;17;18;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-0F7D5361
include_once("./add_usuarios_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8C64A980
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$usuariosSearch = new clsRecordusuariosSearch("", $MainPage);
$usuarios = new clsEditableGridusuarios("", $MainPage);
$MainPage->usuariosSearch = & $usuariosSearch;
$MainPage->usuarios = & $usuarios;
$usuarios->Initialize();
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

//Execute Components @1-36D09E89
$usuarios->Operation();
$usuariosSearch->Operation();
//End Execute Components

//Go to destination page @1-2EA018F4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($usuariosSearch);
    unset($usuarios);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-AD81D082
$usuariosSearch->Show();
$usuarios->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1FD0133B
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($usuariosSearch);
unset($usuarios);
unset($Tpl);
//End Unload Page


?>
