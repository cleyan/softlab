<?php
//Include Common Files @1-68CF7C01
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ingresar_resultados_equipo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_detalle_resultSearch { //peticiones_detalle_resultSearch Class @42-8E4CF355

//Variables @42-9E315808

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

//Class_Initialize Event @42-6CB5E6F2
    function clsRecordpeticiones_detalle_resultSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_detalle_resultSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_detalle_resultSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_equipo_id = new clsControl(ccsListBox, "s_equipo_id", "s_equipo_id", ccsInteger, "", CCGetRequestParam("s_equipo_id", $Method, NULL), $this);
            $this->s_equipo_id->DSType = dsTable;
            $this->s_equipo_id->DataSource = new clsDBDatos();
            $this->s_equipo_id->ds = & $this->s_equipo_id->DataSource;
            $this->s_equipo_id->DataSource->SQL = "SELECT * \n" .
"FROM equipos {SQL_Where} {SQL_OrderBy}";
            $this->s_equipo_id->DataSource->Order = "nom_equipo";
            list($this->s_equipo_id->BoundColumn, $this->s_equipo_id->TextColumn, $this->s_equipo_id->DBFormat) = array("equipo_id", "nom_equipo", "");
            $this->s_equipo_id->DataSource->Parameters["urlactivo"] = CCGetFromGet("activo", NULL);
            $this->s_equipo_id->DataSource->wp = new clsSQLParameters();
            $this->s_equipo_id->DataSource->wp->AddParameter("1", "urlactivo", ccsText, "", "", $this->s_equipo_id->DataSource->Parameters["urlactivo"], 'V', false);
            $this->s_equipo_id->DataSource->wp->Criterion[1] = $this->s_equipo_id->DataSource->wp->Operation(opEqual, "activo", $this->s_equipo_id->DataSource->wp->GetDBValue("1"), $this->s_equipo_id->DataSource->ToSQL($this->s_equipo_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_equipo_id->DataSource->Where = 
                 $this->s_equipo_id->DataSource->wp->Criterion[1];
            $this->s_equipo_id->DataSource->Order = "nom_equipo";
            $this->peticiones_detalle_resultPageSize = new clsControl(ccsListBox, "peticiones_detalle_resultPageSize", "peticiones_detalle_resultPageSize", ccsText, "", CCGetRequestParam("peticiones_detalle_resultPageSize", $Method, NULL), $this);
            $this->peticiones_detalle_resultPageSize->DSType = dsListOfValues;
            $this->peticiones_detalle_resultPageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @42-BA7DBFCF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_equipo_id->Validate() && $Validation);
        $Validation = ($this->peticiones_detalle_resultPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_equipo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->peticiones_detalle_resultPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @42-21FC0E3B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_equipo_id->Errors->Count());
        $errors = ($errors || $this->peticiones_detalle_resultPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @42-DB923925
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
        $Redirect = "ingresar_resultados_equipo.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ingresar_resultados_equipo.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @42-521C92A0
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

        $this->s_equipo_id->Prepare();
        $this->peticiones_detalle_resultPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_equipo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->peticiones_detalle_resultPageSize->Errors->ToString());
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

        $this->s_equipo_id->Show();
        $this->peticiones_detalle_resultPageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_detalle_resultSearch Class @42-FCB6E20C

class clsEditableGridpeticiones_detalle_result { //peticiones_detalle_result Class @2-3DCAFD67

//Variables @2-5625FCAC

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
    public $Sorter_test_id;
    public $Sorter_valor;
    public $Sorter_archivo;
//End Variables

//Class_Initialize Event @2-F409EDAF
    function clsEditableGridpeticiones_detalle_result($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid peticiones_detalle_result/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "peticiones_detalle_result";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_detalle_resultDataSource($this);
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

        $this->SorterName = CCGetParam("peticiones_detalle_resultOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_detalle_resultDir", "");

        $this->linea = new clsControl(ccsHidden, "linea", "linea", ccsInteger, "", NULL, $this);
        $this->peticiones_detalle_result_TotalRecords = new clsControl(ccsLabel, "peticiones_detalle_result_TotalRecords", "peticiones_detalle_result_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_muestra_id = new clsSorter($this->ComponentName, "Sorter_muestra_id", $FileName, $this);
        $this->Sorter_test_id = new clsSorter($this->ComponentName, "Sorter_test_id", $FileName, $this);
        $this->Sorter_valor = new clsSorter($this->ComponentName, "Sorter_valor", $FileName, $this);
        $this->Sorter_archivo = new clsSorter($this->ComponentName, "Sorter_archivo", $FileName, $this);
        $this->muestra_id = new clsControl(ccsHidden, "muestra_id", "Muestra Id", ccsInteger, "", NULL, $this);
        $this->lb_muestra_id = new clsControl(ccsLabel, "lb_muestra_id", "lb_muestra_id", ccsInteger, "", NULL, $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", NULL, $this);
        $this->test_id = new clsControl(ccsHidden, "test_id", "Test Id", ccsInteger, "", NULL, $this);
        $this->valor = new clsControl(ccsTextBox, "valor", "Valor", ccsText, "", NULL, $this);
        $this->lb_list_resultados = new clsControl(ccsLabel, "lb_list_resultados", "lb_list_resultados", ccsText, "", NULL, $this);
        $this->lb_list_resultados->HTML = true;
        $this->estado_id = new clsControl(ccsHidden, "estado_id", "Estado Id", ccsInteger, "", NULL, $this);
        $this->fecha = new clsControl(ccsHidden, "fecha", "Fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), NULL, $this);
        $this->hora = new clsControl(ccsHidden, "hora", "Hora", ccsDate, array("H", ":", "nn", ":", "ss"), NULL, $this);
        $this->ingresado_por = new clsControl(ccsHidden, "ingresado_por", "Ingresado Por", ccsInteger, "", NULL, $this);
        $this->validado_por = new clsControl(ccsHidden, "validado_por", "Validado Por", ccsInteger, "", NULL, $this);
        $this->archivo = new clsControl(ccsTextBox, "archivo", "Archivo", ccsText, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-71440CD1
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_equipo_id"] = CCGetFromGet("s_equipo_id", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-FE2D1128
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["muestra_id"][$RowNumber] = CCGetFromPost("muestra_id_" . $RowNumber, NULL);
            $this->FormParameters["test_id"][$RowNumber] = CCGetFromPost("test_id_" . $RowNumber, NULL);
            $this->FormParameters["valor"][$RowNumber] = CCGetFromPost("valor_" . $RowNumber, NULL);
            $this->FormParameters["estado_id"][$RowNumber] = CCGetFromPost("estado_id_" . $RowNumber, NULL);
            $this->FormParameters["fecha"][$RowNumber] = CCGetFromPost("fecha_" . $RowNumber, NULL);
            $this->FormParameters["hora"][$RowNumber] = CCGetFromPost("hora_" . $RowNumber, NULL);
            $this->FormParameters["ingresado_por"][$RowNumber] = CCGetFromPost("ingresado_por_" . $RowNumber, NULL);
            $this->FormParameters["validado_por"][$RowNumber] = CCGetFromPost("validado_por_" . $RowNumber, NULL);
            $this->FormParameters["archivo"][$RowNumber] = CCGetFromPost("archivo_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-5FE1BC7B
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
            $this->fecha->SetText($this->FormParameters["fecha"][$this->RowNumber], $this->RowNumber);
            $this->hora->SetText($this->FormParameters["hora"][$this->RowNumber], $this->RowNumber);
            $this->ingresado_por->SetText($this->FormParameters["ingresado_por"][$this->RowNumber], $this->RowNumber);
            $this->validado_por->SetText($this->FormParameters["validado_por"][$this->RowNumber], $this->RowNumber);
            $this->archivo->SetText($this->FormParameters["archivo"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-8F779A2D
    function ValidateRow()
    {
        global $CCSLocales;
        $this->muestra_id->Validate();
        $this->test_id->Validate();
        $this->valor->Validate();
        $this->estado_id->Validate();
        $this->fecha->Validate();
        $this->hora->Validate();
        $this->ingresado_por->Validate();
        $this->validado_por->Validate();
        $this->archivo->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->muestra_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->estado_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->hora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ingresado_por->Errors->ToString());
        $errors = ComposeStrings($errors, $this->validado_por->Errors->ToString());
        $errors = ComposeStrings($errors, $this->archivo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->muestra_id->Errors->Clear();
        $this->test_id->Errors->Clear();
        $this->valor->Errors->Clear();
        $this->estado_id->Errors->Clear();
        $this->fecha->Errors->Clear();
        $this->hora->Errors->Clear();
        $this->ingresado_por->Errors->Clear();
        $this->validado_por->Errors->Clear();
        $this->archivo->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-E195EA69
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["muestra_id"][$this->RowNumber]) && count($this->FormParameters["muestra_id"][$this->RowNumber])) || strlen($this->FormParameters["muestra_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["test_id"][$this->RowNumber]) && count($this->FormParameters["test_id"][$this->RowNumber])) || strlen($this->FormParameters["test_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["valor"][$this->RowNumber]) && count($this->FormParameters["valor"][$this->RowNumber])) || strlen($this->FormParameters["valor"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["estado_id"][$this->RowNumber]) && count($this->FormParameters["estado_id"][$this->RowNumber])) || strlen($this->FormParameters["estado_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["fecha"][$this->RowNumber]) && count($this->FormParameters["fecha"][$this->RowNumber])) || strlen($this->FormParameters["fecha"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["hora"][$this->RowNumber]) && count($this->FormParameters["hora"][$this->RowNumber])) || strlen($this->FormParameters["hora"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["ingresado_por"][$this->RowNumber]) && count($this->FormParameters["ingresado_por"][$this->RowNumber])) || strlen($this->FormParameters["ingresado_por"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["validado_por"][$this->RowNumber]) && count($this->FormParameters["validado_por"][$this->RowNumber])) || strlen($this->FormParameters["validado_por"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["archivo"][$this->RowNumber]) && count($this->FormParameters["archivo"][$this->RowNumber])) || strlen($this->FormParameters["archivo"][$this->RowNumber]));
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

//UpdateGrid Method @2-E2666D7D
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
            $this->fecha->SetText($this->FormParameters["fecha"][$this->RowNumber], $this->RowNumber);
            $this->hora->SetText($this->FormParameters["hora"][$this->RowNumber], $this->RowNumber);
            $this->ingresado_por->SetText($this->FormParameters["ingresado_por"][$this->RowNumber], $this->RowNumber);
            $this->validado_por->SetText($this->FormParameters["validado_por"][$this->RowNumber], $this->RowNumber);
            $this->archivo->SetText($this->FormParameters["archivo"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @2-E78A094D
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->hora->SetValue($this->hora->GetValue(true));
        $this->DataSource->archivo->SetValue($this->archivo->GetValue(true));
        $this->DataSource->ingresado_por->SetValue($this->ingresado_por->GetValue(true));
        $this->DataSource->validado_por->SetValue($this->validado_por->GetValue(true));
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

//UpdateRow Method @2-9CEB5FCE
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->muestra_id->SetValue($this->muestra_id->GetValue(true));
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->hora->SetValue($this->hora->GetValue(true));
        $this->DataSource->archivo->SetValue($this->archivo->GetValue(true));
        $this->DataSource->ingresado_por->SetValue($this->ingresado_por->GetValue(true));
        $this->DataSource->validado_por->SetValue($this->validado_por->GetValue(true));
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

//FormScript Method @2-BCA1996D
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var peticiones_detalle_resultElements;\n";
        $script .= "var peticiones_detalle_resultEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "muestra_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "test_idID = 1;\n";
        $script .= "var " . $this->ComponentName . "valorID = 2;\n";
        $script .= "var " . $this->ComponentName . "estado_idID = 3;\n";
        $script .= "var " . $this->ComponentName . "fechaID = 4;\n";
        $script .= "var " . $this->ComponentName . "horaID = 5;\n";
        $script .= "var " . $this->ComponentName . "ingresado_porID = 6;\n";
        $script .= "var " . $this->ComponentName . "validado_porID = 7;\n";
        $script .= "var " . $this->ComponentName . "archivoID = 8;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 9;\n";
        $script .= "\nfunction initpeticiones_detalle_resultElements() {\n";
        $script .= "\tvar ED = document.forms[\"peticiones_detalle_result\"];\n";
        $script .= "\tpeticiones_detalle_resultElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.muestra_id_" . $i . ", " . "ED.test_id_" . $i . ", " . "ED.valor_" . $i . ", " . "ED.estado_id_" . $i . ", " . "ED.fecha_" . $i . ", " . "ED.hora_" . $i . ", " . "ED.ingresado_por_" . $i . ", " . "ED.validado_por_" . $i . ", " . "ED.archivo_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
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

//Show Method @2-BD064C8E
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
        $this->ControlsVisible["lb_muestra_id"] = $this->lb_muestra_id->Visible;
        $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
        $this->ControlsVisible["test_id"] = $this->test_id->Visible;
        $this->ControlsVisible["valor"] = $this->valor->Visible;
        $this->ControlsVisible["lb_list_resultados"] = $this->lb_list_resultados->Visible;
        $this->ControlsVisible["estado_id"] = $this->estado_id->Visible;
        $this->ControlsVisible["fecha"] = $this->fecha->Visible;
        $this->ControlsVisible["hora"] = $this->hora->Visible;
        $this->ControlsVisible["ingresado_por"] = $this->ingresado_por->Visible;
        $this->ControlsVisible["validado_por"] = $this->validado_por->Visible;
        $this->ControlsVisible["archivo"] = $this->archivo->Visible;
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
                    $this->lb_list_resultados->SetText("");
                    $this->CheckBox_Delete->SetValue(false);
                    $this->muestra_id->SetValue($this->DataSource->muestra_id->GetValue());
                    $this->lb_muestra_id->SetValue($this->DataSource->lb_muestra_id->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                    $this->valor->SetValue($this->DataSource->valor->GetValue());
                    $this->estado_id->SetValue($this->DataSource->estado_id->GetValue());
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->hora->SetValue($this->DataSource->hora->GetValue());
                    $this->ingresado_por->SetValue($this->DataSource->ingresado_por->GetValue());
                    $this->validado_por->SetValue($this->DataSource->validado_por->GetValue());
                    $this->archivo->SetValue($this->DataSource->archivo->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->lb_muestra_id->SetText("");
                    $this->nom_test->SetText("");
                    $this->lb_list_resultados->SetText("");
                    $this->lb_muestra_id->SetValue($this->DataSource->lb_muestra_id->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->muestra_id->SetText($this->FormParameters["muestra_id"][$this->RowNumber], $this->RowNumber);
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->valor->SetText($this->FormParameters["valor"][$this->RowNumber], $this->RowNumber);
                    $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
                    $this->fecha->SetText($this->FormParameters["fecha"][$this->RowNumber], $this->RowNumber);
                    $this->hora->SetText($this->FormParameters["hora"][$this->RowNumber], $this->RowNumber);
                    $this->ingresado_por->SetText($this->FormParameters["ingresado_por"][$this->RowNumber], $this->RowNumber);
                    $this->validado_por->SetText($this->FormParameters["validado_por"][$this->RowNumber], $this->RowNumber);
                    $this->archivo->SetText($this->FormParameters["archivo"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->muestra_id->SetText("");
                    $this->lb_muestra_id->SetText("");
                    $this->nom_test->SetText("");
                    $this->test_id->SetText("");
                    $this->valor->SetText("");
                    $this->lb_list_resultados->SetText("");
                    $this->estado_id->SetText("");
                    $this->fecha->SetText("");
                    $this->hora->SetText("");
                    $this->ingresado_por->SetText(CCGetUserID());
                    $this->validado_por->SetText("");
                    $this->archivo->SetText("");
                } else {
                    $this->lb_muestra_id->SetText("");
                    $this->nom_test->SetText("");
                    $this->lb_list_resultados->SetText("");
                    $this->muestra_id->SetText($this->FormParameters["muestra_id"][$this->RowNumber], $this->RowNumber);
                    $this->test_id->SetText($this->FormParameters["test_id"][$this->RowNumber], $this->RowNumber);
                    $this->valor->SetText($this->FormParameters["valor"][$this->RowNumber], $this->RowNumber);
                    $this->estado_id->SetText($this->FormParameters["estado_id"][$this->RowNumber], $this->RowNumber);
                    $this->fecha->SetText($this->FormParameters["fecha"][$this->RowNumber], $this->RowNumber);
                    $this->hora->SetText($this->FormParameters["hora"][$this->RowNumber], $this->RowNumber);
                    $this->ingresado_por->SetText($this->FormParameters["ingresado_por"][$this->RowNumber], $this->RowNumber);
                    $this->validado_por->SetText($this->FormParameters["validado_por"][$this->RowNumber], $this->RowNumber);
                    $this->archivo->SetText($this->FormParameters["archivo"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->muestra_id->Show($this->RowNumber);
                $this->lb_muestra_id->Show($this->RowNumber);
                $this->nom_test->Show($this->RowNumber);
                $this->test_id->Show($this->RowNumber);
                $this->valor->Show($this->RowNumber);
                $this->lb_list_resultados->Show($this->RowNumber);
                $this->estado_id->Show($this->RowNumber);
                $this->fecha->Show($this->RowNumber);
                $this->hora->Show($this->RowNumber);
                $this->ingresado_por->Show($this->RowNumber);
                $this->validado_por->Show($this->RowNumber);
                $this->archivo->Show($this->RowNumber);
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
        $this->peticiones_detalle_result_TotalRecords->Show();
        $this->Sorter_muestra_id->Show();
        $this->Sorter_test_id->Show();
        $this->Sorter_valor->Show();
        $this->Sorter_archivo->Show();
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

} //End peticiones_detalle_result Class @2-FCB6E20C

class clspeticiones_detalle_resultDataSource extends clsDBDatos {  //peticiones_detalle_resultDataSource Class @2-4774E709

//DataSource Variables @2-DE8B6E62
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
    public $lb_muestra_id;
    public $nom_test;
    public $test_id;
    public $valor;
    public $lb_list_resultados;
    public $estado_id;
    public $fecha;
    public $hora;
    public $ingresado_por;
    public $validado_por;
    public $archivo;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-ABD97E52
    function clspeticiones_detalle_resultDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid peticiones_detalle_result/Error";
        $this->Initialize();
        $this->muestra_id = new clsField("muestra_id", ccsInteger, "");
        
        $this->lb_muestra_id = new clsField("lb_muestra_id", ccsInteger, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->valor = new clsField("valor", ccsText, "");
        
        $this->lb_list_resultados = new clsField("lb_list_resultados", ccsText, "");
        
        $this->estado_id = new clsField("estado_id", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->hora = new clsField("hora", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->ingresado_por = new clsField("ingresado_por", ccsInteger, "");
        
        $this->validado_por = new clsField("validado_por", ccsInteger, "");
        
        $this->archivo = new clsField("archivo", ccsText, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsDate);
        $this->InsertFields["hora"] = array("Name" => "hora", "Value" => "", "DataType" => ccsDate);
        $this->InsertFields["archivo"] = array("Name" => "archivo", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["ingresado_por"] = array("Name" => "ingresado_por", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["validado_por"] = array("Name" => "validado_por", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["muestra_id"] = array("Name" => "muestra_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsDate);
        $this->UpdateFields["hora"] = array("Name" => "hora", "Value" => "", "DataType" => ccsDate);
        $this->UpdateFields["archivo"] = array("Name" => "archivo", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["ingresado_por"] = array("Name" => "ingresado_por", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["validado_por"] = array("Name" => "validado_por", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-AF0F9518
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_muestra_id" => array("peticiones_detalle.muestra_id", ""), 
            "Sorter_test_id" => array("resultados.test_id", ""), 
            "Sorter_valor" => array("valor", ""), 
            "Sorter_archivo" => array("archivo", "")));
    }
//End SetOrder Method

//Prepare Method @2-494433E0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_equipo_id", ccsInteger, "", "", $this->Parameters["urls_equipo_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "test.equipo_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-346008EC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (peticiones_detalle LEFT JOIN test ON\n\n" .
        "peticiones_detalle.test_id = test.test_id) LEFT JOIN peticiones ON\n\n" .
        "peticiones_detalle.peticion_id = peticiones.peticion_id";
        $this->SQL = "SELECT peticiones_detalle.peticion_id AS peticiones_detalle_peticion_id, muestra_id AS peticion_detalle_muestra_id, peticiones_detalle.test_id AS peticion_detalle_test_id,\n\n" .
        "decompuesto, equipo_id, cod_test, nom_test, paciente_id \n\n" .
        "FROM (peticiones_detalle LEFT JOIN test ON\n\n" .
        "peticiones_detalle.test_id = test.test_id) LEFT JOIN peticiones ON\n\n" .
        "peticiones_detalle.peticion_id = peticiones.peticion_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-FB6A3EE3
    function SetValues()
    {
        $this->muestra_id->SetDBValue(trim($this->f("peticion_detalle_muestra_id")));
        $this->lb_muestra_id->SetDBValue(trim($this->f("peticion_detalle_muestra_id")));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->test_id->SetDBValue(trim($this->f("peticion_detalle_test_id")));
        $this->valor->SetDBValue($this->f("valor"));
        $this->estado_id->SetDBValue(trim($this->f("estado_id")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->hora->SetDBValue(trim($this->f("hora")));
        $this->ingresado_por->SetDBValue(trim($this->f("ingresado_por")));
        $this->validado_por->SetDBValue(trim($this->f("validado_por")));
        $this->archivo->SetDBValue($this->f("archivo"));
    }
//End SetValues Method

//Insert Method @2-1F7FA7FB
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["test_id"] = new clsSQLParameter("ctrltest_id", ccsInteger, "", "", $this->test_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["estado_id"] = new clsSQLParameter("ctrlestado_id", ccsInteger, "", "", $this->estado_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor"] = new clsSQLParameter("ctrlvalor", ccsText, "", "", $this->valor->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fecha"] = new clsSQLParameter("ctrlfecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->fecha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["hora"] = new clsSQLParameter("ctrlhora", ccsDate, array("H", ":", "nn", ":", "ss"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->hora->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["archivo"] = new clsSQLParameter("ctrlarchivo", ccsText, "", "", $this->archivo->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["ingresado_por"] = new clsSQLParameter("ctrlingresado_por", ccsInteger, "", "", $this->ingresado_por->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["validado_por"] = new clsSQLParameter("ctrlvalidado_por", ccsInteger, "", "", $this->validado_por->GetValue(true), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["test_id"]->GetValue()) and !strlen($this->cp["test_id"]->GetText()) and !is_bool($this->cp["test_id"]->GetValue())) 
            $this->cp["test_id"]->SetValue($this->test_id->GetValue(true));
        if (!is_null($this->cp["estado_id"]->GetValue()) and !strlen($this->cp["estado_id"]->GetText()) and !is_bool($this->cp["estado_id"]->GetValue())) 
            $this->cp["estado_id"]->SetValue($this->estado_id->GetValue(true));
        if (!is_null($this->cp["valor"]->GetValue()) and !strlen($this->cp["valor"]->GetText()) and !is_bool($this->cp["valor"]->GetValue())) 
            $this->cp["valor"]->SetValue($this->valor->GetValue(true));
        if (!is_null($this->cp["fecha"]->GetValue()) and !strlen($this->cp["fecha"]->GetText()) and !is_bool($this->cp["fecha"]->GetValue())) 
            $this->cp["fecha"]->SetValue($this->fecha->GetValue(true));
        if (!is_null($this->cp["hora"]->GetValue()) and !strlen($this->cp["hora"]->GetText()) and !is_bool($this->cp["hora"]->GetValue())) 
            $this->cp["hora"]->SetValue($this->hora->GetValue(true));
        if (!is_null($this->cp["archivo"]->GetValue()) and !strlen($this->cp["archivo"]->GetText()) and !is_bool($this->cp["archivo"]->GetValue())) 
            $this->cp["archivo"]->SetValue($this->archivo->GetValue(true));
        if (!is_null($this->cp["ingresado_por"]->GetValue()) and !strlen($this->cp["ingresado_por"]->GetText()) and !is_bool($this->cp["ingresado_por"]->GetValue())) 
            $this->cp["ingresado_por"]->SetValue($this->ingresado_por->GetValue(true));
        if (!is_null($this->cp["validado_por"]->GetValue()) and !strlen($this->cp["validado_por"]->GetText()) and !is_bool($this->cp["validado_por"]->GetValue())) 
            $this->cp["validado_por"]->SetValue($this->validado_por->GetValue(true));
        $this->InsertFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->InsertFields["estado_id"]["Value"] = $this->cp["estado_id"]->GetDBValue(true);
        $this->InsertFields["valor"]["Value"] = $this->cp["valor"]->GetDBValue(true);
        $this->InsertFields["fecha"]["Value"] = $this->cp["fecha"]->GetDBValue(true);
        $this->InsertFields["hora"]["Value"] = $this->cp["hora"]->GetDBValue(true);
        $this->InsertFields["archivo"]["Value"] = $this->cp["archivo"]->GetDBValue(true);
        $this->InsertFields["ingresado_por"]["Value"] = $this->cp["ingresado_por"]->GetDBValue(true);
        $this->InsertFields["validado_por"]["Value"] = $this->cp["validado_por"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("resultados", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-848DBE12
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
        $this->cp["fecha"] = new clsSQLParameter("ctrlfecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->fecha->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["hora"] = new clsSQLParameter("ctrlhora", ccsDate, array("H", ":", "nn", ":", "ss"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->hora->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["archivo"] = new clsSQLParameter("ctrlarchivo", ccsText, "", "", $this->archivo->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["ingresado_por"] = new clsSQLParameter("ctrlingresado_por", ccsInteger, "", "", $this->ingresado_por->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["validado_por"] = new clsSQLParameter("ctrlvalidado_por", ccsInteger, "", "", $this->validado_por->GetValue(true), "", false, $this->ErrorBlock);
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
        if (!is_null($this->cp["fecha"]->GetValue()) and !strlen($this->cp["fecha"]->GetText()) and !is_bool($this->cp["fecha"]->GetValue())) 
            $this->cp["fecha"]->SetValue($this->fecha->GetValue(true));
        if (!is_null($this->cp["hora"]->GetValue()) and !strlen($this->cp["hora"]->GetText()) and !is_bool($this->cp["hora"]->GetValue())) 
            $this->cp["hora"]->SetValue($this->hora->GetValue(true));
        if (!is_null($this->cp["archivo"]->GetValue()) and !strlen($this->cp["archivo"]->GetText()) and !is_bool($this->cp["archivo"]->GetValue())) 
            $this->cp["archivo"]->SetValue($this->archivo->GetValue(true));
        if (!is_null($this->cp["ingresado_por"]->GetValue()) and !strlen($this->cp["ingresado_por"]->GetText()) and !is_bool($this->cp["ingresado_por"]->GetValue())) 
            $this->cp["ingresado_por"]->SetValue($this->ingresado_por->GetValue(true));
        if (!is_null($this->cp["validado_por"]->GetValue()) and !strlen($this->cp["validado_por"]->GetText()) and !is_bool($this->cp["validado_por"]->GetValue())) 
            $this->cp["validado_por"]->SetValue($this->validado_por->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "resultado_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["test_id"]["Value"] = $this->cp["test_id"]->GetDBValue(true);
        $this->UpdateFields["muestra_id"]["Value"] = $this->cp["muestra_id"]->GetDBValue(true);
        $this->UpdateFields["estado_id"]["Value"] = $this->cp["estado_id"]->GetDBValue(true);
        $this->UpdateFields["valor"]["Value"] = $this->cp["valor"]->GetDBValue(true);
        $this->UpdateFields["fecha"]["Value"] = $this->cp["fecha"]->GetDBValue(true);
        $this->UpdateFields["hora"]["Value"] = $this->cp["hora"]->GetDBValue(true);
        $this->UpdateFields["archivo"]["Value"] = $this->cp["archivo"]->GetDBValue(true);
        $this->UpdateFields["ingresado_por"]["Value"] = $this->cp["ingresado_por"]->GetDBValue(true);
        $this->UpdateFields["validado_por"]["Value"] = $this->cp["validado_por"]->GetDBValue(true);
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

} //End peticiones_detalle_resultDataSource Class @2-FCB6E20C

//Initialize Page @1-9C15C1B1
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
$TemplateFileName = "ingresar_resultados_equipo.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-A570F08D
include_once("./ingresar_resultados_equipo_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-CD3D016E
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_detalle_resultSearch = new clsRecordpeticiones_detalle_resultSearch("", $MainPage);
$peticiones_detalle_result = new clsEditableGridpeticiones_detalle_result("", $MainPage);
$MainPage->peticiones_detalle_resultSearch = & $peticiones_detalle_resultSearch;
$MainPage->peticiones_detalle_result = & $peticiones_detalle_result;
$peticiones_detalle_result->Initialize();
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

//Execute Components @1-20D1341A
$peticiones_detalle_result->Operation();
$peticiones_detalle_resultSearch->Operation();
//End Execute Components

//Go to destination page @1-D142420B
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_detalle_resultSearch);
    unset($peticiones_detalle_result);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-FF5C7FB5
$peticiones_detalle_resultSearch->Show();
$peticiones_detalle_result->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-B0E4C2A8
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_detalle_resultSearch);
unset($peticiones_detalle_result);
unset($Tpl);
//End Unload Page


?>
