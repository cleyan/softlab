<?php
//Include Common Files @1-971BCC49
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "list_test.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtestSearch { //testSearch Class @4-B331BB78

//Variables @4-9E315808

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

//Class_Initialize Event @4-0DB077F9
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
            $this->s_nom_test = new clsControl(ccsTextBox, "s_nom_test", "s_nom_test", ccsText, "", CCGetRequestParam("s_nom_test", $Method, NULL), $this);
            $this->s_seccion = new clsControl(ccsListBox, "s_seccion", "s_seccion", ccsInteger, "", CCGetRequestParam("s_seccion", $Method, NULL), $this);
            $this->s_seccion->DSType = dsTable;
            $this->s_seccion->DataSource = new clsDBDatos();
            $this->s_seccion->ds = & $this->s_seccion->DataSource;
            $this->s_seccion->DataSource->SQL = "SELECT * \n" .
"FROM secciones {SQL_Where} {SQL_OrderBy}";
            $this->s_seccion->DataSource->Order = "nom_seccion";
            list($this->s_seccion->BoundColumn, $this->s_seccion->TextColumn, $this->s_seccion->DBFormat) = array("seccion_id", "nom_seccion", "");
            $this->s_seccion->DataSource->Parameters["urlactivo"] = CCGetFromGet("activo", NULL);
            $this->s_seccion->DataSource->wp = new clsSQLParameters();
            $this->s_seccion->DataSource->wp->AddParameter("1", "urlactivo", ccsText, "", "", $this->s_seccion->DataSource->Parameters["urlactivo"], 'V', false);
            $this->s_seccion->DataSource->wp->Criterion[1] = $this->s_seccion->DataSource->wp->Operation(opEqual, "activo", $this->s_seccion->DataSource->wp->GetDBValue("1"), $this->s_seccion->DataSource->ToSQL($this->s_seccion->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_seccion->DataSource->Where = 
                 $this->s_seccion->DataSource->wp->Criterion[1];
            $this->s_seccion->DataSource->Order = "nom_seccion";
            $this->s_equipo = new clsControl(ccsListBox, "s_equipo", "s_equipo", ccsInteger, "", CCGetRequestParam("s_equipo", $Method, NULL), $this);
            $this->s_equipo->DSType = dsTable;
            $this->s_equipo->DataSource = new clsDBDatos();
            $this->s_equipo->ds = & $this->s_equipo->DataSource;
            $this->s_equipo->DataSource->SQL = "SELECT * \n" .
"FROM equipos {SQL_Where} {SQL_OrderBy}";
            $this->s_equipo->DataSource->Order = "nom_equipo";
            list($this->s_equipo->BoundColumn, $this->s_equipo->TextColumn, $this->s_equipo->DBFormat) = array("equipo_id", "nom_equipo", "");
            $this->s_equipo->DataSource->Parameters["urlactivo"] = CCGetFromGet("activo", NULL);
            $this->s_equipo->DataSource->wp = new clsSQLParameters();
            $this->s_equipo->DataSource->wp->AddParameter("1", "urlactivo", ccsText, "", "", $this->s_equipo->DataSource->Parameters["urlactivo"], 'V', false);
            $this->s_equipo->DataSource->wp->Criterion[1] = $this->s_equipo->DataSource->wp->Operation(opEqual, "activo", $this->s_equipo->DataSource->wp->GetDBValue("1"), $this->s_equipo->DataSource->ToSQL($this->s_equipo->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_equipo->DataSource->Where = 
                 $this->s_equipo->DataSource->wp->Criterion[1];
            $this->s_equipo->DataSource->Order = "nom_equipo";
            $this->s_aislado = new clsControl(ccsListBox, "s_aislado", "s_aislado", ccsText, "", CCGetRequestParam("s_aislado", $Method, NULL), $this);
            $this->s_aislado->DSType = dsListOfValues;
            $this->s_aislado->Values = array(array("V", "Aislados"), array("F", "No aislados"));
            $this->s_compuesto = new clsControl(ccsListBox, "s_compuesto", "s_compuesto", ccsText, "", CCGetRequestParam("s_compuesto", $Method, NULL), $this);
            $this->s_compuesto->DSType = dsListOfValues;
            $this->s_compuesto->Values = array(array("V", "Compuestos"), array("F", "No Compuestos"));
            $this->s_formula = new clsControl(ccsListBox, "s_formula", "s_formula", ccsText, "", CCGetRequestParam("s_formula", $Method, NULL), $this);
            $this->s_formula->DSType = dsListOfValues;
            $this->s_formula->Values = array(array("V", "Test es Fórmula"), array("F", "Test NO es Fórmula"));
            $this->s_imprimible = new clsControl(ccsListBox, "s_imprimible", "s_imprimible", ccsText, "", CCGetRequestParam("s_imprimible", $Method, NULL), $this);
            $this->s_imprimible->DSType = dsListOfValues;
            $this->s_imprimible->Values = array(array("V", "SI de puede imprimir"), array("F", "NO se puede imprimir"));
            $this->s_acceso_rapido = new clsControl(ccsListBox, "s_acceso_rapido", "s_acceso_rapido", ccsText, "", CCGetRequestParam("s_acceso_rapido", $Method, NULL), $this);
            $this->s_acceso_rapido->DSType = dsListOfValues;
            $this->s_acceso_rapido->Values = array(array("V", "Acceso rápido"), array("F", "No acceso rápido"));
            $this->testPageSize = new clsControl(ccsListBox, "testPageSize", "testPageSize", ccsText, "", CCGetRequestParam("testPageSize", $Method, NULL), $this);
            $this->testPageSize->DSType = dsListOfValues;
            $this->testPageSize->Values = array(array("", "Seleccionar Valor"), array("5", "5"), array("10", "10"), array("25", "25"), array("100", "100"));
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @4-4A8E8B4C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nom_test->Validate() && $Validation);
        $Validation = ($this->s_seccion->Validate() && $Validation);
        $Validation = ($this->s_equipo->Validate() && $Validation);
        $Validation = ($this->s_aislado->Validate() && $Validation);
        $Validation = ($this->s_compuesto->Validate() && $Validation);
        $Validation = ($this->s_formula->Validate() && $Validation);
        $Validation = ($this->s_imprimible->Validate() && $Validation);
        $Validation = ($this->s_acceso_rapido->Validate() && $Validation);
        $Validation = ($this->testPageSize->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nom_test->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_seccion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_equipo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_aislado->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_compuesto->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_formula->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_imprimible->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_acceso_rapido->Errors->Count() == 0);
        $Validation =  $Validation && ($this->testPageSize->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @4-178C8776
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nom_test->Errors->Count());
        $errors = ($errors || $this->s_seccion->Errors->Count());
        $errors = ($errors || $this->s_equipo->Errors->Count());
        $errors = ($errors || $this->s_aislado->Errors->Count());
        $errors = ($errors || $this->s_compuesto->Errors->Count());
        $errors = ($errors || $this->s_formula->Errors->Count());
        $errors = ($errors || $this->s_imprimible->Errors->Count());
        $errors = ($errors || $this->s_acceso_rapido->Errors->Count());
        $errors = ($errors || $this->testPageSize->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @4-63964EBD
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
        $Redirect = "list_test.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "testPage"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "list_test.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y", "testPage")), CCGetQueryString("QueryString", array("s_nom_test", "s_seccion", "s_equipo", "s_aislado", "s_compuesto", "s_formula", "s_imprimible", "s_acceso_rapido", "testPageSize", "ccsForm", "testPage")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @4-18FEB70F
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

        $this->s_seccion->Prepare();
        $this->s_equipo->Prepare();
        $this->s_aislado->Prepare();
        $this->s_compuesto->Prepare();
        $this->s_formula->Prepare();
        $this->s_imprimible->Prepare();
        $this->s_acceso_rapido->Prepare();
        $this->testPageSize->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_nom_test->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_seccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_equipo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_aislado->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_compuesto->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_formula->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_imprimible->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_acceso_rapido->Errors->ToString());
            $Error = ComposeStrings($Error, $this->testPageSize->Errors->ToString());
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

        $this->s_nom_test->Show();
        $this->s_seccion->Show();
        $this->s_equipo->Show();
        $this->s_aislado->Show();
        $this->s_compuesto->Show();
        $this->s_formula->Show();
        $this->s_imprimible->Show();
        $this->s_acceso_rapido->Show();
        $this->testPageSize->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End testSearch Class @4-FCB6E20C

class clsGridtest { //test class @3-062E0013

//Variables @3-87EC59F2

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
    public $Sort_codigo_fonasa;
    public $Sorter_cod_test;
    public $Sorter_nom_test;
    public $C;
    public $F;
    public $I;
    public $A;
//End Variables

//Class_Initialize Event @3-67D109AF
    function clsGridtest($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "test";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid test";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
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
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;
        $this->SorterName = CCGetParam("testOrder", "");
        $this->SorterDirection = CCGetParam("testDir", "");

        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "add_test.php";
        $this->ImageLink3 = new clsControl(ccsImageLink, "ImageLink3", "ImageLink3", ccsText, "", CCGetRequestParam("ImageLink3", ccsGet, NULL), $this);
        $this->ImageLink3->Page = "add_valores_referencia.php";
        $this->ImageLink7 = new clsControl(ccsImageLink, "ImageLink7", "ImageLink7", ccsText, "", CCGetRequestParam("ImageLink7", ccsGet, NULL), $this);
        $this->ImageLink7->Page = "asignar_insumos_test.php";
        $this->test_id = new clsControl(ccsHidden, "test_id", "test_id", ccsInteger, "", CCGetRequestParam("test_id", ccsGet, NULL), $this);
        $this->h_compuesto = new clsControl(ccsHidden, "h_compuesto", "h_compuesto", ccsText, "", CCGetRequestParam("h_compuesto", ccsGet, NULL), $this);
        $this->formula = new clsControl(ccsHidden, "formula", "formula", ccsText, "", CCGetRequestParam("formula", ccsGet, NULL), $this);
        $this->imprimible = new clsControl(ccsHidden, "imprimible", "imprimible", ccsText, "", CCGetRequestParam("imprimible", ccsGet, NULL), $this);
        $this->aislado = new clsControl(ccsHidden, "aislado", "aislado", ccsText, "", CCGetRequestParam("aislado", ccsGet, NULL), $this);
        $this->codigo_fonasa = new clsControl(ccsLabel, "codigo_fonasa", "codigo_fonasa", ccsText, "", CCGetRequestParam("codigo_fonasa", ccsGet, NULL), $this);
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->lbl_compuesto = new clsControl(ccsLink, "lbl_compuesto", "lbl_compuesto", ccsText, "", CCGetRequestParam("lbl_compuesto", ccsGet, NULL), $this);
        $this->lbl_compuesto->HTML = true;
        $this->lbl_compuesto->Page = "list_test.php";
        $this->lbl_formula = new clsControl(ccsLink, "lbl_formula", "lbl_formula", ccsText, "", CCGetRequestParam("lbl_formula", ccsGet, NULL), $this);
        $this->lbl_formula->HTML = true;
        $this->lbl_formula->Page = "list_test.php";
        $this->lbl_imprimible = new clsControl(ccsLink, "lbl_imprimible", "lbl_imprimible", ccsText, "", CCGetRequestParam("lbl_imprimible", ccsGet, NULL), $this);
        $this->lbl_imprimible->HTML = true;
        $this->lbl_imprimible->Page = "list_test.php";
        $this->lbl_aislado = new clsControl(ccsLink, "lbl_aislado", "lbl_aislado", ccsText, "", CCGetRequestParam("lbl_aislado", ccsGet, NULL), $this);
        $this->lbl_aislado->HTML = true;
        $this->lbl_aislado->Page = "list_test.php";
        $this->test_TotalRecords = new clsControl(ccsLabel, "test_TotalRecords", "test_TotalRecords", ccsText, "", CCGetRequestParam("test_TotalRecords", ccsGet, NULL), $this);
        $this->Sort_codigo_fonasa = new clsSorter($this->ComponentName, "Sort_codigo_fonasa", $FileName, $this);
        $this->Sorter_cod_test = new clsSorter($this->ComponentName, "Sorter_cod_test", $FileName, $this);
        $this->Sorter_nom_test = new clsSorter($this->ComponentName, "Sorter_nom_test", $FileName, $this);
        $this->C = new clsSorter($this->ComponentName, "C", $FileName, $this);
        $this->F = new clsSorter($this->ComponentName, "F", $FileName, $this);
        $this->I = new clsSorter($this->ComponentName, "I", $FileName, $this);
        $this->A = new clsSorter($this->ComponentName, "A", $FileName, $this);
        $this->Navigator1 = new clsNavigator($this->ComponentName, "Navigator1", $FileName, 10, tpSimple, $this);
        $this->Navigator1->PageSizes = array("1", "5", "10", "25", "50");
        $this->agregartest = new clsControl(ccsImageLink, "agregartest", "agregartest", ccsText, "", CCGetRequestParam("agregartest", ccsGet, NULL), $this);
        $this->agregartest->Page = "add_test.php";
        $this->ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ImageLink2->Page = "menu_principal.php";
    }
//End Class_Initialize Event

//Initialize Method @3-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @3-3BF5DEAB
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nom_test"] = CCGetFromGet("s_nom_test", NULL);
        $this->DataSource->Parameters["urls_aislado"] = CCGetFromGet("s_aislado", NULL);
        $this->DataSource->Parameters["urls_compuesto"] = CCGetFromGet("s_compuesto", NULL);
        $this->DataSource->Parameters["urls_acceso_rapido"] = CCGetFromGet("s_acceso_rapido", NULL);
        $this->DataSource->Parameters["urls_equipo"] = CCGetFromGet("s_equipo", NULL);
        $this->DataSource->Parameters["urls_seccion"] = CCGetFromGet("s_seccion", NULL);
        $this->DataSource->Parameters["urls_formula"] = CCGetFromGet("s_formula", NULL);
        $this->DataSource->Parameters["urls_imprimible"] = CCGetFromGet("s_imprimible", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["ImageLink3"] = $this->ImageLink3->Visible;
            $this->ControlsVisible["ImageLink7"] = $this->ImageLink7->Visible;
            $this->ControlsVisible["test_id"] = $this->test_id->Visible;
            $this->ControlsVisible["h_compuesto"] = $this->h_compuesto->Visible;
            $this->ControlsVisible["formula"] = $this->formula->Visible;
            $this->ControlsVisible["imprimible"] = $this->imprimible->Visible;
            $this->ControlsVisible["aislado"] = $this->aislado->Visible;
            $this->ControlsVisible["codigo_fonasa"] = $this->codigo_fonasa->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            $this->ControlsVisible["lbl_compuesto"] = $this->lbl_compuesto->Visible;
            $this->ControlsVisible["lbl_formula"] = $this->lbl_formula->Visible;
            $this->ControlsVisible["lbl_imprimible"] = $this->lbl_imprimible->Visible;
            $this->ControlsVisible["lbl_aislado"] = $this->lbl_aislado->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "test_id", $this->DataSource->f("test_id"));
                $this->ImageLink3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink3->Parameters = CCAddParam($this->ImageLink3->Parameters, "test_id", $this->DataSource->f("test_id"));
                $this->ImageLink7->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink7->Parameters = CCAddParam($this->ImageLink7->Parameters, "test_id", $this->DataSource->f("test_id"));
                $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                $this->h_compuesto->SetValue($this->DataSource->h_compuesto->GetValue());
                $this->formula->SetValue($this->DataSource->formula->GetValue());
                $this->imprimible->SetValue($this->DataSource->imprimible->GetValue());
                $this->aislado->SetValue($this->DataSource->aislado->GetValue());
                $this->codigo_fonasa->SetValue($this->DataSource->codigo_fonasa->GetValue());
                $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                $this->lbl_compuesto->Parameters = "";
                $this->lbl_compuesto->Parameters = CCAddParam($this->lbl_compuesto->Parameters, "s_compuesto", $this->DataSource->f("compuesto"));
                $this->lbl_formula->Parameters = "";
                $this->lbl_formula->Parameters = CCAddParam($this->lbl_formula->Parameters, "s_formula", $this->DataSource->f("formula"));
                $this->lbl_imprimible->Parameters = "";
                $this->lbl_imprimible->Parameters = CCAddParam($this->lbl_imprimible->Parameters, "s_imprimible", $this->DataSource->f("imprimible"));
                $this->lbl_aislado->Parameters = "";
                $this->lbl_aislado->Parameters = CCAddParam($this->lbl_aislado->Parameters, "s_aislado", $this->DataSource->f("aislado"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ImageLink1->Show();
                $this->ImageLink3->Show();
                $this->ImageLink7->Show();
                $this->test_id->Show();
                $this->h_compuesto->Show();
                $this->formula->Show();
                $this->imprimible->Show();
                $this->aislado->Show();
                $this->codigo_fonasa->Show();
                $this->cod_test->Show();
                $this->nom_test->Show();
                $this->lbl_compuesto->Show();
                $this->lbl_formula->Show();
                $this->lbl_imprimible->Show();
                $this->lbl_aislado->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Navigator1->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator1->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator1->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator1->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator1->TotalPages <= 1 && $this->Navigator1->PageNumber == 1) || $this->Navigator1->PageSize == "") {
            $this->Navigator1->Visible = false;
        }
        $this->agregartest->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->agregartest->Parameters = CCAddParam($this->agregartest->Parameters, "test_id", "");
        $this->test_TotalRecords->Show();
        $this->Sort_codigo_fonasa->Show();
        $this->Sorter_cod_test->Show();
        $this->Sorter_nom_test->Show();
        $this->C->Show();
        $this->F->Show();
        $this->I->Show();
        $this->A->Show();
        $this->Navigator1->Show();
        $this->agregartest->Show();
        $this->ImageLink2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @3-92E5849F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink7->Errors->ToString());
        $errors = ComposeStrings($errors, $this->test_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->h_compuesto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->formula->Errors->ToString());
        $errors = ComposeStrings($errors, $this->imprimible->Errors->ToString());
        $errors = ComposeStrings($errors, $this->aislado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->codigo_fonasa->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_compuesto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_formula->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_imprimible->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_aislado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End test Class @3-FCB6E20C

class clstestDataSource extends clsDBDatos {  //testDataSource Class @3-EDACDDB4

//DataSource Variables @3-C7410D9D
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $test_id;
    public $h_compuesto;
    public $formula;
    public $imprimible;
    public $aislado;
    public $codigo_fonasa;
    public $cod_test;
    public $nom_test;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-0B430601
    function clstestDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid test";
        $this->Initialize();
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->h_compuesto = new clsField("h_compuesto", ccsText, "");
        
        $this->formula = new clsField("formula", ccsText, "");
        
        $this->imprimible = new clsField("imprimible", ccsText, "");
        
        $this->aislado = new clsField("aislado", ccsText, "");
        
        $this->codigo_fonasa = new clsField("codigo_fonasa", ccsText, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @3-CBE1B64F
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "codigo_fonasa, cod_test, nom_test";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sort_codigo_fonasa" => array("codigo_fonasa", ""), 
            "Sorter_cod_test" => array("cod_test", ""), 
            "Sorter_nom_test" => array("nom_test", ""), 
            "C" => array("compuesto", ""), 
            "F" => array("formula", ""), 
            "I" => array("imprimible", ""), 
            "A" => array("aislado", "")));
    }
//End SetOrder Method

//Prepare Method @3-E74BD4E9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nom_test", ccsText, "", "", $this->Parameters["urls_nom_test"], "", false);
        $this->wp->AddParameter("2", "urls_nom_test", ccsText, "", "", $this->Parameters["urls_nom_test"], "", false);
        $this->wp->AddParameter("3", "urls_nom_test", ccsText, "", "", $this->Parameters["urls_nom_test"], "", false);
        $this->wp->AddParameter("4", "urls_aislado", ccsText, "", "", $this->Parameters["urls_aislado"], "", false);
        $this->wp->AddParameter("5", "urls_compuesto", ccsText, "", "", $this->Parameters["urls_compuesto"], "", false);
        $this->wp->AddParameter("6", "urls_acceso_rapido", ccsText, "", "", $this->Parameters["urls_acceso_rapido"], "", false);
        $this->wp->AddParameter("7", "urls_equipo", ccsInteger, "", "", $this->Parameters["urls_equipo"], "", false);
        $this->wp->AddParameter("8", "urls_seccion", ccsInteger, "", "", $this->Parameters["urls_seccion"], "", false);
        $this->wp->AddParameter("9", "urls_formula", ccsText, "", "", $this->Parameters["urls_formula"], "", false);
        $this->wp->AddParameter("10", "urls_imprimible", ccsText, "", "", $this->Parameters["urls_imprimible"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "cod_test", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "codigo_fonasa", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "nom_test", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "aislado", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "compuesto", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "acceso_rapido", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opEqual, "equipo_id", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsInteger),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opEqual, "secciones_id", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsInteger),false);
        $this->wp->Criterion[9] = $this->wp->Operation(opEqual, "formula", $this->wp->GetDBValue("9"), $this->ToSQL($this->wp->GetDBValue("9"), ccsText),false);
        $this->wp->Criterion[10] = $this->wp->Operation(opEqual, "imprimible", $this->wp->GetDBValue("10"), $this->ToSQL($this->wp->GetDBValue("10"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opOR(
             true, $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]), 
             $this->wp->Criterion[8]), 
             $this->wp->Criterion[9]), 
             $this->wp->Criterion[10]);
    }
//End Prepare Method

//Open Method @3-32968567
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

//SetValues Method @3-3FC3830A
    function SetValues()
    {
        $this->test_id->SetDBValue(trim($this->f("test_id")));
        $this->h_compuesto->SetDBValue($this->f("compuesto"));
        $this->formula->SetDBValue($this->f("formula"));
        $this->imprimible->SetDBValue($this->f("imprimible"));
        $this->aislado->SetDBValue($this->f("aislado"));
        $this->codigo_fonasa->SetDBValue($this->f("codigo_fonasa"));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->nom_test->SetDBValue($this->f("nom_test"));
    }
//End SetValues Method

} //End testDataSource Class @3-FCB6E20C

//Initialize Page @1-9291C213
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
$TemplateFileName = "list_test.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-D321F2FB
CCSecurityRedirect("15;16;17;18;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-AE1B9DB8
include_once("./list_test_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F5DB4D1C
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$testSearch = new clsRecordtestSearch("", $MainPage);
$test = new clsGridtest("", $MainPage);
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

//Execute Components @1-E8B5E447
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
