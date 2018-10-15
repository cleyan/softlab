<?php
//Include Common Files @1-3B3522E0
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "edit_test.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtestSearch { //testSearch Class @3-B331BB78

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

//Class_Initialize Event @3-CAE6C548
    function clsRecordtestSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record testSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "testSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_secciones_id = new clsControl(ccsTextBox, "s_secciones_id", "s_secciones_id", ccsInteger, "", CCGetRequestParam("s_secciones_id", $Method, NULL), $this);
            $this->s_equipo_id = new clsControl(ccsTextBox, "s_equipo_id", "s_equipo_id", ccsInteger, "", CCGetRequestParam("s_equipo_id", $Method, NULL), $this);
            $this->s_tipo_muestra_id = new clsControl(ccsTextBox, "s_tipo_muestra_id", "s_tipo_muestra_id", ccsInteger, "", CCGetRequestParam("s_tipo_muestra_id", $Method, NULL), $this);
            $this->s_codigo_fonasa = new clsControl(ccsTextBox, "s_codigo_fonasa", "s_codigo_fonasa", ccsText, "", CCGetRequestParam("s_codigo_fonasa", $Method, NULL), $this);
            $this->s_cod_test = new clsControl(ccsTextBox, "s_cod_test", "s_cod_test", ccsText, "", CCGetRequestParam("s_cod_test", $Method, NULL), $this);
            $this->s_nom_test = new clsControl(ccsTextBox, "s_nom_test", "s_nom_test", ccsText, "", CCGetRequestParam("s_nom_test", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-1AA60880
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_secciones_id->Validate() && $Validation);
        $Validation = ($this->s_equipo_id->Validate() && $Validation);
        $Validation = ($this->s_tipo_muestra_id->Validate() && $Validation);
        $Validation = ($this->s_codigo_fonasa->Validate() && $Validation);
        $Validation = ($this->s_cod_test->Validate() && $Validation);
        $Validation = ($this->s_nom_test->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_secciones_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_equipo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_tipo_muestra_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_codigo_fonasa->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_cod_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nom_test->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-93618C7A
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_secciones_id->Errors->Count());
        $errors = ($errors || $this->s_equipo_id->Errors->Count());
        $errors = ($errors || $this->s_tipo_muestra_id->Errors->Count());
        $errors = ($errors || $this->s_codigo_fonasa->Errors->Count());
        $errors = ($errors || $this->s_cod_test->Errors->Count());
        $errors = ($errors || $this->s_nom_test->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-3F388E41
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
        $Redirect = "edit_test.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "edit_test.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-E75FBBDE
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


        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_secciones_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_equipo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_tipo_muestra_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_codigo_fonasa->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_cod_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nom_test->Errors->ToString());
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

        $this->s_secciones_id->Show();
        $this->s_equipo_id->Show();
        $this->s_tipo_muestra_id->Show();
        $this->s_codigo_fonasa->Show();
        $this->s_cod_test->Show();
        $this->s_nom_test->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End testSearch Class @3-FCB6E20C

class clsEditableGridtest { //test Class @2-7BB8C72B

//Variables @2-E63F4891

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
    public $Sorter_secciones_id;
    public $Sorter_equipo_id;
    public $Sorter_tipo_muestra_id;
    public $Sorter_codigo_fonasa;
    public $Sorter_cod_test;
    public $Sorter_nom_test;
    public $Sorter_unidad_medida;
    public $Sorter_acceso_rapido;
    public $Sorter_aislado;
    public $Sorter_compuesto;
    public $Sorter_formato_id;
//End Variables

//Class_Initialize Event @2-46CDB2C9
    function clsEditableGridtest($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid test/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["test_id"][0] = "test_id";
        $this->DataSource = new clstestDataSource($this);
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

        $this->SorterName = CCGetParam("testOrder", "");
        $this->SorterDirection = CCGetParam("testDir", "");

        $this->test_TotalRecords = new clsControl(ccsLabel, "test_TotalRecords", "test_TotalRecords", ccsText, "", NULL, $this);
        $this->Sorter_secciones_id = new clsSorter($this->ComponentName, "Sorter_secciones_id", $FileName, $this);
        $this->Sorter_equipo_id = new clsSorter($this->ComponentName, "Sorter_equipo_id", $FileName, $this);
        $this->Sorter_tipo_muestra_id = new clsSorter($this->ComponentName, "Sorter_tipo_muestra_id", $FileName, $this);
        $this->Sorter_codigo_fonasa = new clsSorter($this->ComponentName, "Sorter_codigo_fonasa", $FileName, $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->Sorter_unidad_medida = new clsSorter($this->ComponentName, "Sorter_unidad_medida", $FileName, $this);
        $this->Sorter_acceso_rapido = new clsSorter($this->ComponentName, "Sorter_acceso_rapido", $FileName, $this);
        $this->Sorter_aislado = new clsSorter($this->ComponentName, "Sorter_aislado", $FileName, $this);
        $this->Sorter_compuesto = new clsSorter($this->ComponentName, "Sorter_compuesto", $FileName, $this);
        $this->Sorter_formato_id = new clsSorter($this->ComponentName, "Sorter_formato_id", $FileName, $this);
        $this->secciones_id = new clsControl(ccsListBox, "secciones_id", "Secciones Id", ccsInteger, "", NULL, $this);
        $this->secciones_id->DSType = dsTable;
        $this->secciones_id->DataSource = new clsDBDatos();
        $this->secciones_id->ds = & $this->secciones_id->DataSource;
        $this->secciones_id->DataSource->SQL = "SELECT * \n" .
"FROM secciones {SQL_Where} {SQL_OrderBy}";
        list($this->secciones_id->BoundColumn, $this->secciones_id->TextColumn, $this->secciones_id->DBFormat) = array("seccion_id", "nom_seccion", "");
        $this->equipo_id = new clsControl(ccsListBox, "equipo_id", "Equipo Id", ccsInteger, "", NULL, $this);
        $this->equipo_id->DSType = dsTable;
        $this->equipo_id->DataSource = new clsDBDatos();
        $this->equipo_id->ds = & $this->equipo_id->DataSource;
        $this->equipo_id->DataSource->SQL = "SELECT * \n" .
"FROM equipos {SQL_Where} {SQL_OrderBy}";
        list($this->equipo_id->BoundColumn, $this->equipo_id->TextColumn, $this->equipo_id->DBFormat) = array("equipo_id", "nom_equipo", "");
        $this->tipo_muestra_id = new clsControl(ccsListBox, "tipo_muestra_id", "Tipo Muestra Id", ccsInteger, "", NULL, $this);
        $this->tipo_muestra_id->DSType = dsTable;
        $this->tipo_muestra_id->DataSource = new clsDBDatos();
        $this->tipo_muestra_id->ds = & $this->tipo_muestra_id->DataSource;
        $this->tipo_muestra_id->DataSource->SQL = "SELECT * \n" .
"FROM tipos_muestra {SQL_Where} {SQL_OrderBy}";
        list($this->tipo_muestra_id->BoundColumn, $this->tipo_muestra_id->TextColumn, $this->tipo_muestra_id->DBFormat) = array("tipo_muestra_id", "nom_tipo_muestra", "");
        $this->codigo_fonasa = new clsControl(ccsTextBox, "codigo_fonasa", "Codigo Fonasa", ccsText, "", NULL, $this);
        $this->cod_test = new clsControl(ccsTextBox, "cod_test", "Cod Test", ccsText, "", NULL, $this);
        $this->nom_test = new clsControl(ccsTextBox, "nom_test", "Nom Test", ccsText, "", NULL, $this);
        $this->unidad_medida = new clsControl(ccsTextBox, "unidad_medida", "Unidad Medida", ccsText, "", NULL, $this);
        $this->acceso_rapido = new clsControl(ccsCheckBox, "acceso_rapido", "Acceso Rapido", ccsText, "", NULL, $this);
        $this->acceso_rapido->CheckedValue = $this->acceso_rapido->GetParsedValue('V');
        $this->acceso_rapido->UncheckedValue = $this->acceso_rapido->GetParsedValue('F');
        $this->aislado = new clsControl(ccsCheckBox, "aislado", "Aislado", ccsText, "", NULL, $this);
        $this->aislado->CheckedValue = $this->aislado->GetParsedValue('V');
        $this->aislado->UncheckedValue = $this->aislado->GetParsedValue('F');
        $this->compuesto = new clsControl(ccsCheckBox, "compuesto", "Compuesto", ccsText, "", NULL, $this);
        $this->compuesto->CheckedValue = $this->compuesto->GetParsedValue('V');
        $this->compuesto->UncheckedValue = $this->compuesto->GetParsedValue('F');
        $this->formato_id = new clsControl(ccsListBox, "formato_id", "Formato Id", ccsInteger, "", NULL, $this);
        $this->formato_id->DSType = dsTable;
        $this->formato_id->DataSource = new clsDBDatos();
        $this->formato_id->ds = & $this->formato_id->DataSource;
        $this->formato_id->DataSource->SQL = "SELECT * \n" .
"FROM formatos {SQL_Where} {SQL_OrderBy}";
        list($this->formato_id->BoundColumn, $this->formato_id->TextColumn, $this->formato_id->DBFormat) = array("formato_id", "nom_formato", "");
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->Cancel = new clsButton("Cancel", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-5A0D7672
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urls_secciones_id"] = CCGetFromGet("s_secciones_id", NULL);
        $this->DataSource->Parameters["urls_equipo_id"] = CCGetFromGet("s_equipo_id", NULL);
        $this->DataSource->Parameters["urls_tipo_muestra_id"] = CCGetFromGet("s_tipo_muestra_id", NULL);
        $this->DataSource->Parameters["urls_codigo_fonasa"] = CCGetFromGet("s_codigo_fonasa", NULL);
        $this->DataSource->Parameters["urls_cod_test"] = CCGetFromGet("s_cod_test", NULL);
        $this->DataSource->Parameters["urls_nom_test"] = CCGetFromGet("s_nom_test", NULL);
    }
//End Initialize Method

//GetFormParameters Method @2-29ADCCB0
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["secciones_id"][$RowNumber] = CCGetFromPost("secciones_id_" . $RowNumber, NULL);
            $this->FormParameters["equipo_id"][$RowNumber] = CCGetFromPost("equipo_id_" . $RowNumber, NULL);
            $this->FormParameters["tipo_muestra_id"][$RowNumber] = CCGetFromPost("tipo_muestra_id_" . $RowNumber, NULL);
            $this->FormParameters["codigo_fonasa"][$RowNumber] = CCGetFromPost("codigo_fonasa_" . $RowNumber, NULL);
            $this->FormParameters["cod_test"][$RowNumber] = CCGetFromPost("cod_test_" . $RowNumber, NULL);
            $this->FormParameters["nom_test"][$RowNumber] = CCGetFromPost("nom_test_" . $RowNumber, NULL);
            $this->FormParameters["unidad_medida"][$RowNumber] = CCGetFromPost("unidad_medida_" . $RowNumber, NULL);
            $this->FormParameters["acceso_rapido"][$RowNumber] = CCGetFromPost("acceso_rapido_" . $RowNumber, NULL);
            $this->FormParameters["aislado"][$RowNumber] = CCGetFromPost("aislado_" . $RowNumber, NULL);
            $this->FormParameters["compuesto"][$RowNumber] = CCGetFromPost("compuesto_" . $RowNumber, NULL);
            $this->FormParameters["formato_id"][$RowNumber] = CCGetFromPost("formato_id_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @2-FA67567D
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["test_id"] = $this->CachedColumns["test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->secciones_id->SetText($this->FormParameters["secciones_id"][$this->RowNumber], $this->RowNumber);
            $this->equipo_id->SetText($this->FormParameters["equipo_id"][$this->RowNumber], $this->RowNumber);
            $this->tipo_muestra_id->SetText($this->FormParameters["tipo_muestra_id"][$this->RowNumber], $this->RowNumber);
            $this->codigo_fonasa->SetText($this->FormParameters["codigo_fonasa"][$this->RowNumber], $this->RowNumber);
            $this->cod_test->SetText($this->FormParameters["cod_test"][$this->RowNumber], $this->RowNumber);
            $this->nom_test->SetText($this->FormParameters["nom_test"][$this->RowNumber], $this->RowNumber);
            $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
            $this->acceso_rapido->SetText($this->FormParameters["acceso_rapido"][$this->RowNumber], $this->RowNumber);
            $this->aislado->SetText($this->FormParameters["aislado"][$this->RowNumber], $this->RowNumber);
            $this->compuesto->SetText($this->FormParameters["compuesto"][$this->RowNumber], $this->RowNumber);
            $this->formato_id->SetText($this->FormParameters["formato_id"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @2-CEE1DEA9
    function ValidateRow()
    {
        global $CCSLocales;
        $this->secciones_id->Validate();
        $this->equipo_id->Validate();
        $this->tipo_muestra_id->Validate();
        $this->codigo_fonasa->Validate();
        $this->cod_test->Validate();
        $this->nom_test->Validate();
        $this->unidad_medida->Validate();
        $this->acceso_rapido->Validate();
        $this->aislado->Validate();
        $this->compuesto->Validate();
        $this->formato_id->Validate();
        $this->CheckBox_Delete->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->secciones_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->equipo_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->tipo_muestra_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->unidad_medida->Errors->ToString());
        $errors = ComposeStrings($errors, $this->acceso_rapido->Errors->ToString());
        $errors = ComposeStrings($errors, $this->aislado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->compuesto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->formato_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $this->secciones_id->Errors->Clear();
        $this->equipo_id->Errors->Clear();
        $this->tipo_muestra_id->Errors->Clear();
        $this->codigo_fonasa->Errors->Clear();
        $this->cod_test->Errors->Clear();
        $this->nom_test->Errors->Clear();
        $this->unidad_medida->Errors->Clear();
        $this->acceso_rapido->Errors->Clear();
        $this->aislado->Errors->Clear();
        $this->compuesto->Errors->Clear();
        $this->formato_id->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @2-7FF3FFCC
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["secciones_id"][$this->RowNumber]) && count($this->FormParameters["secciones_id"][$this->RowNumber])) || strlen($this->FormParameters["secciones_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["equipo_id"][$this->RowNumber]) && count($this->FormParameters["equipo_id"][$this->RowNumber])) || strlen($this->FormParameters["equipo_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["tipo_muestra_id"][$this->RowNumber]) && count($this->FormParameters["tipo_muestra_id"][$this->RowNumber])) || strlen($this->FormParameters["tipo_muestra_id"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["codigo_fonasa"][$this->RowNumber]) && count($this->FormParameters["codigo_fonasa"][$this->RowNumber])) || strlen($this->FormParameters["codigo_fonasa"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["cod_test"][$this->RowNumber]) && count($this->FormParameters["cod_test"][$this->RowNumber])) || strlen($this->FormParameters["cod_test"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["nom_test"][$this->RowNumber]) && count($this->FormParameters["nom_test"][$this->RowNumber])) || strlen($this->FormParameters["nom_test"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["unidad_medida"][$this->RowNumber]) && count($this->FormParameters["unidad_medida"][$this->RowNumber])) || strlen($this->FormParameters["unidad_medida"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["acceso_rapido"][$this->RowNumber]) && count($this->FormParameters["acceso_rapido"][$this->RowNumber])) || strlen($this->FormParameters["acceso_rapido"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["aislado"][$this->RowNumber]) && count($this->FormParameters["aislado"][$this->RowNumber])) || strlen($this->FormParameters["aislado"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["compuesto"][$this->RowNumber]) && count($this->FormParameters["compuesto"][$this->RowNumber])) || strlen($this->FormParameters["compuesto"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["formato_id"][$this->RowNumber]) && count($this->FormParameters["formato_id"][$this->RowNumber])) || strlen($this->FormParameters["formato_id"][$this->RowNumber]));
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

//UpdateGrid Method @2-0F7B23C4
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["test_id"] = $this->CachedColumns["test_id"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->secciones_id->SetText($this->FormParameters["secciones_id"][$this->RowNumber], $this->RowNumber);
            $this->equipo_id->SetText($this->FormParameters["equipo_id"][$this->RowNumber], $this->RowNumber);
            $this->tipo_muestra_id->SetText($this->FormParameters["tipo_muestra_id"][$this->RowNumber], $this->RowNumber);
            $this->codigo_fonasa->SetText($this->FormParameters["codigo_fonasa"][$this->RowNumber], $this->RowNumber);
            $this->cod_test->SetText($this->FormParameters["cod_test"][$this->RowNumber], $this->RowNumber);
            $this->nom_test->SetText($this->FormParameters["nom_test"][$this->RowNumber], $this->RowNumber);
            $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
            $this->acceso_rapido->SetText($this->FormParameters["acceso_rapido"][$this->RowNumber], $this->RowNumber);
            $this->aislado->SetText($this->FormParameters["aislado"][$this->RowNumber], $this->RowNumber);
            $this->compuesto->SetText($this->FormParameters["compuesto"][$this->RowNumber], $this->RowNumber);
            $this->formato_id->SetText($this->FormParameters["formato_id"][$this->RowNumber], $this->RowNumber);
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

//UpdateRow Method @2-BDC3507E
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->secciones_id->SetValue($this->secciones_id->GetValue(true));
        $this->DataSource->equipo_id->SetValue($this->equipo_id->GetValue(true));
        $this->DataSource->tipo_muestra_id->SetValue($this->tipo_muestra_id->GetValue(true));
        $this->DataSource->codigo_fonasa->SetValue($this->codigo_fonasa->GetValue(true));
        $this->DataSource->cod_test->SetValue($this->cod_test->GetValue(true));
        $this->DataSource->nom_test->SetValue($this->nom_test->GetValue(true));
        $this->DataSource->unidad_medida->SetValue($this->unidad_medida->GetValue(true));
        $this->DataSource->acceso_rapido->SetValue($this->acceso_rapido->GetValue(true));
        $this->DataSource->aislado->SetValue($this->aislado->GetValue(true));
        $this->DataSource->compuesto->SetValue($this->compuesto->GetValue(true));
        $this->DataSource->formato_id->SetValue($this->formato_id->GetValue(true));
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

//FormScript Method @2-AAF249A4
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var testElements;\n";
        $script .= "var testEmptyRows = 0;\n";
        $script .= "var " . $this->ComponentName . "secciones_idID = 0;\n";
        $script .= "var " . $this->ComponentName . "equipo_idID = 1;\n";
        $script .= "var " . $this->ComponentName . "tipo_muestra_idID = 2;\n";
        $script .= "var " . $this->ComponentName . "codigo_fonasaID = 3;\n";
        $script .= "var " . $this->ComponentName . "cod_testID = 4;\n";
        $script .= "var " . $this->ComponentName . "nom_testID = 5;\n";
        $script .= "var " . $this->ComponentName . "unidad_medidaID = 6;\n";
        $script .= "var " . $this->ComponentName . "acceso_rapidoID = 7;\n";
        $script .= "var " . $this->ComponentName . "aisladoID = 8;\n";
        $script .= "var " . $this->ComponentName . "compuestoID = 9;\n";
        $script .= "var " . $this->ComponentName . "formato_idID = 10;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 11;\n";
        $script .= "\nfunction inittestElements() {\n";
        $script .= "\tvar ED = document.forms[\"test\"];\n";
        $script .= "\ttestElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.secciones_id_" . $i . ", " . "ED.equipo_id_" . $i . ", " . "ED.tipo_muestra_id_" . $i . ", " . "ED.codigo_fonasa_" . $i . ", " . "ED.cod_test_" . $i . ", " . "ED.nom_test_" . $i . ", " . "ED.unidad_medida_" . $i . ", " . "ED.acceso_rapido_" . $i . ", " . "ED.aislado_" . $i . ", " . "ED.compuesto_" . $i . ", " . "ED.formato_id_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @2-2BCD40EE
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
                $this->CachedColumns["test_id"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["test_id"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @2-CA891C32
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["test_id"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @2-454592A2
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->secciones_id->Prepare();
        $this->equipo_id->Prepare();
        $this->tipo_muestra_id->Prepare();
        $this->formato_id->Prepare();

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
        $this->ControlsVisible["secciones_id"] = $this->secciones_id->Visible;
        $this->ControlsVisible["equipo_id"] = $this->equipo_id->Visible;
        $this->ControlsVisible["tipo_muestra_id"] = $this->tipo_muestra_id->Visible;
        $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
        $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
        $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
        $this->ControlsVisible["unidad_medida"] = $this->unidad_medida->Visible;
        $this->ControlsVisible["acceso_rapido"] = $this->acceso_rapido->Visible;
        $this->ControlsVisible["aislado"] = $this->aislado->Visible;
        $this->ControlsVisible["compuesto"] = $this->compuesto->Visible;
        $this->ControlsVisible["formato_id"] = $this->formato_id->Visible;
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
                    $this->CachedColumns["test_id"][$this->RowNumber] = $this->DataSource->CachedColumns["test_id"];
                    $this->CheckBox_Delete->SetValue(false);
                    $this->secciones_id->SetValue($this->DataSource->secciones_id->GetValue());
                    $this->equipo_id->SetValue($this->DataSource->equipo_id->GetValue());
                    $this->tipo_muestra_id->SetValue($this->DataSource->tipo_muestra_id->GetValue());
                    $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                    $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->unidad_medida->SetValue($this->DataSource->unidad_medida->GetValue());
                    $this->acceso_rapido->SetValue($this->DataSource->acceso_rapido->GetValue());
                    $this->aislado->SetValue($this->DataSource->aislado->GetValue());
                    $this->compuesto->SetValue($this->DataSource->compuesto->GetValue());
                    $this->formato_id->SetValue($this->DataSource->formato_id->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->secciones_id->SetText($this->FormParameters["secciones_id"][$this->RowNumber], $this->RowNumber);
                    $this->equipo_id->SetText($this->FormParameters["equipo_id"][$this->RowNumber], $this->RowNumber);
                    $this->tipo_muestra_id->SetText($this->FormParameters["tipo_muestra_id"][$this->RowNumber], $this->RowNumber);
                    $this->codigo_fonasa->SetText($this->FormParameters["codigo_fonasa"][$this->RowNumber], $this->RowNumber);
                    $this->cod_test->SetText($this->FormParameters["cod_test"][$this->RowNumber], $this->RowNumber);
                    $this->nom_test->SetText($this->FormParameters["nom_test"][$this->RowNumber], $this->RowNumber);
                    $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
                    $this->acceso_rapido->SetText($this->FormParameters["acceso_rapido"][$this->RowNumber], $this->RowNumber);
                    $this->aislado->SetText($this->FormParameters["aislado"][$this->RowNumber], $this->RowNumber);
                    $this->compuesto->SetText($this->FormParameters["compuesto"][$this->RowNumber], $this->RowNumber);
                    $this->formato_id->SetText($this->FormParameters["formato_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["test_id"][$this->RowNumber] = "";
                    $this->secciones_id->SetText("");
                    $this->equipo_id->SetText("");
                    $this->tipo_muestra_id->SetText("");
                    $this->codigo_fonasa->SetText("");
                    $this->cod_test->SetText("");
                    $this->nom_test->SetText("");
                    $this->unidad_medida->SetText("");
                    $this->acceso_rapido->SetValue(false);
                    $this->aislado->SetValue(false);
                    $this->compuesto->SetValue(false);
                    $this->formato_id->SetText("");
                } else {
                    $this->secciones_id->SetText($this->FormParameters["secciones_id"][$this->RowNumber], $this->RowNumber);
                    $this->equipo_id->SetText($this->FormParameters["equipo_id"][$this->RowNumber], $this->RowNumber);
                    $this->tipo_muestra_id->SetText($this->FormParameters["tipo_muestra_id"][$this->RowNumber], $this->RowNumber);
                    $this->codigo_fonasa->SetText($this->FormParameters["codigo_fonasa"][$this->RowNumber], $this->RowNumber);
                    $this->cod_test->SetText($this->FormParameters["cod_test"][$this->RowNumber], $this->RowNumber);
                    $this->nom_test->SetText($this->FormParameters["nom_test"][$this->RowNumber], $this->RowNumber);
                    $this->unidad_medida->SetText($this->FormParameters["unidad_medida"][$this->RowNumber], $this->RowNumber);
                    $this->acceso_rapido->SetText($this->FormParameters["acceso_rapido"][$this->RowNumber], $this->RowNumber);
                    $this->aislado->SetText($this->FormParameters["aislado"][$this->RowNumber], $this->RowNumber);
                    $this->compuesto->SetText($this->FormParameters["compuesto"][$this->RowNumber], $this->RowNumber);
                    $this->formato_id->SetText($this->FormParameters["formato_id"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->secciones_id->Show($this->RowNumber);
                $this->equipo_id->Show($this->RowNumber);
                $this->tipo_muestra_id->Show($this->RowNumber);
                $this->codigo_fonasa->Show($this->RowNumber);
                $this->cod_test->Show($this->RowNumber);
                $this->nom_test->Show($this->RowNumber);
                $this->unidad_medida->Show($this->RowNumber);
                $this->acceso_rapido->Show($this->RowNumber);
                $this->aislado->Show($this->RowNumber);
                $this->compuesto->Show($this->RowNumber);
                $this->formato_id->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["test_id"] == $this->CachedColumns["test_id"][$this->RowNumber])) {
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
        $this->test_TotalRecords->Show();
        $this->Sorter_secciones_id->Show();
        $this->Sorter_equipo_id->Show();
        $this->Sorter_tipo_muestra_id->Show();
        $this->Sorter_codigo_fonasa->Show();
        $this->Sorter_cod_test->Show();
        $this->Sorter_nom_test->Show();
        $this->Sorter_unidad_medida->Show();
        $this->Sorter_acceso_rapido->Show();
        $this->Sorter_aislado->Show();
        $this->Sorter_compuesto->Show();
        $this->Sorter_formato_id->Show();
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

} //End test Class @2-FCB6E20C

class clstestDataSource extends clsDBDatos {  //testDataSource Class @2-EDACDDB4

//DataSource Variables @2-E4010C21
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $UpdateFields = array();

    // Datasource fields
    public $secciones_id;
    public $equipo_id;
    public $tipo_muestra_id;
    public $codigo_fonasa;
    public $cod_test;
    public $nom_test;
    public $unidad_medida;
    public $acceso_rapido;
    public $aislado;
    public $compuesto;
    public $formato_id;
    public $CheckBox_Delete;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-8FDDEF03
    function clstestDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid test/Error";
        $this->Initialize();
        $this->secciones_id = new clsField("secciones_id", ccsInteger, "");
        
        $this->equipo_id = new clsField("equipo_id", ccsInteger, "");
        
        $this->tipo_muestra_id = new clsField("tipo_muestra_id", ccsInteger, "");
        
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->unidad_medida = new clsField("unidad_medida", ccsText, "");
        
        $this->acceso_rapido = new clsField("acceso_rapido", ccsText, "");
        
        $this->aislado = new clsField("aislado", ccsText, "");
        
        $this->compuesto = new clsField("compuesto", ccsText, "");
        
        $this->formato_id = new clsField("formato_id", ccsInteger, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        

        $this->UpdateFields["secciones_id"] = array("Name" => "secciones_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["equipo_id"] = array("Name" => "equipo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["tipo_muestra_id"] = array("Name" => "tipo_muestra_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["codigo_fonasa"] = array("Name" => "codigo_fonasa", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["cod_test"] = array("Name" => "cod_test", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nom_test"] = array("Name" => "nom_test", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["unidad_medida"] = array("Name" => "unidad_medida", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["acceso_rapido"] = array("Name" => "acceso_rapido", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["aislado"] = array("Name" => "aislado", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["compuesto"] = array("Name" => "compuesto", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["formato_id"] = array("Name" => "formato_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4BE1078D
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_secciones_id" => array("secciones_id", ""), 
            "Sorter_equipo_id" => array("equipo_id", ""), 
            "Sorter_tipo_muestra_id" => array("tipo_muestra_id", ""), 
            "Sorter_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_cod_test" => array("cod_test", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "Sorter_unidad_medida" => array("unidad_medida", ""), 
            "Sorter_acceso_rapido" => array("acceso_rapido", ""), 
            "Sorter_aislado" => array("aislado", ""), 
            "Sorter_compuesto" => array("compuesto", ""), 
            "Sorter_formato_id" => array("formato_id", "")));
    }
//End SetOrder Method

//Prepare Method @2-B983BC25
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_secciones_id", ccsInteger, "", "", $this->Parameters["urls_secciones_id"], "", false);
        $this->wp->AddParameter("2", "urls_equipo_id", ccsInteger, "", "", $this->Parameters["urls_equipo_id"], "", false);
        $this->wp->AddParameter("3", "urls_tipo_muestra_id", ccsInteger, "", "", $this->Parameters["urls_tipo_muestra_id"], "", false);
        $this->wp->AddParameter("4", "urls_codigo_fonasa", ccsText, "", "", $this->Parameters["urls_codigo_fonasa"], "", false);
        $this->wp->AddParameter("5", "urls_cod_test", ccsText, "", "", $this->Parameters["urls_cod_test"], "", false);
        $this->wp->AddParameter("6", "urls_nom_test", ccsText, "", "", $this->Parameters["urls_nom_test"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "secciones_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "equipo_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "tipo_muestra_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "codigo_fonasa", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "cod_test", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opContains, "nom_test", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
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

//Open Method @2-32968567
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM test";
        $this->SQL = "SELECT * \n\n" .
        "FROM test {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9E390C9E
    function SetValues()
    {
        $this->CachedColumns["test_id"] = $this->f("test_id");
        $this->secciones_id->SetDBValue(trim($this->f("secciones_id")));
        $this->equipo_id->SetDBValue(trim($this->f("equipo_id")));
        $this->tipo_muestra_id->SetDBValue(trim($this->f("tipo_muestra_id")));
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
        $this->unidad_medida->SetDBValue($this->f("unidad_medida"));
        $this->acceso_rapido->SetDBValue($this->f("acceso_rapido"));
        $this->aislado->SetDBValue($this->f("aislado"));
        $this->compuesto->SetDBValue($this->f("compuesto"));
        $this->formato_id->SetDBValue(trim($this->f("formato_id")));
    }
//End SetValues Method

//Update Method @2-21A1A34F
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "test_id=" . $this->ToSQL($this->CachedColumns["test_id"], ccsInteger);
        $this->UpdateFields["secciones_id"]["Value"] = $this->secciones_id->GetDBValue(true);
        $this->UpdateFields["equipo_id"]["Value"] = $this->equipo_id->GetDBValue(true);
        $this->UpdateFields["tipo_muestra_id"]["Value"] = $this->tipo_muestra_id->GetDBValue(true);
        $this->UpdateFields["codigo_fonasa"]["Value"] = $this->codigo_fonasa->GetDBValue(true);
        $this->UpdateFields["cod_test"]["Value"] = $this->cod_test->GetDBValue(true);
        $this->UpdateFields["nom_test"]["Value"] = $this->nom_test->GetDBValue(true);
        $this->UpdateFields["unidad_medida"]["Value"] = $this->unidad_medida->GetDBValue(true);
        $this->UpdateFields["acceso_rapido"]["Value"] = $this->acceso_rapido->GetDBValue(true);
        $this->UpdateFields["aislado"]["Value"] = $this->aislado->GetDBValue(true);
        $this->UpdateFields["compuesto"]["Value"] = $this->compuesto->GetDBValue(true);
        $this->UpdateFields["formato_id"]["Value"] = $this->formato_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("test", $this->UpdateFields, $this);
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

//Delete Method @2-8C865B4C
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "test_id=" . $this->ToSQL($this->CachedColumns["test_id"], ccsInteger);
        $this->SQL = "DELETE FROM test";
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

} //End testDataSource Class @2-FCB6E20C

//Initialize Page @1-3A3B6482
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
$TemplateFileName = "edit_test.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-AA54A103
CCSecurityRedirect("15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-4DC9FF6D
include_once("./edit_test_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E1F8E9B3
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$testSearch = new clsRecordtestSearch("", $MainPage);
$test = new clsEditableGridtest("", $MainPage);
$MainPage->testSearch = & $testSearch;
$MainPage->test = & $test;
$test->Initialize();
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

//Execute Components @1-3FE3E9FC
$test->Operation();
$testSearch->Operation();
//End Execute Components

//Go to destination page @1-F6FB7497
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($testSearch);
    unset($test);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CCB184FB
$testSearch->Show();
$test->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-56377D9C
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($testSearch);
unset($test);
unset($Tpl);
//End Unload Page


?>
