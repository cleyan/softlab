<?php
//Include Common Files @1-C72A0C3C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ver_hojatrabajo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_detalle_test_sSearch { //peticiones_detalle_test_sSearch Class @27-DC12B2B8

//Variables @27-9E315808

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

//Class_Initialize Event @27-9835F91F
    function clsRecordpeticiones_detalle_test_sSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_detalle_test_sSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_detalle_test_sSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_test_equipo_id = new clsControl(ccsListBox, "s_test_equipo_id", "s_test_equipo_id", ccsInteger, "", CCGetRequestParam("s_test_equipo_id", $Method, NULL), $this);
            $this->s_test_equipo_id->DSType = dsTable;
            $this->s_test_equipo_id->DataSource = new clsDBDatos();
            $this->s_test_equipo_id->ds = & $this->s_test_equipo_id->DataSource;
            $this->s_test_equipo_id->DataSource->SQL = "SELECT * \n" .
"FROM equipos {SQL_Where} {SQL_OrderBy}";
            list($this->s_test_equipo_id->BoundColumn, $this->s_test_equipo_id->TextColumn, $this->s_test_equipo_id->DBFormat) = array("equipo_id", "nom_equipo", "");
            $this->s_secciones_id = new clsControl(ccsListBox, "s_secciones_id", "s_secciones_id", ccsInteger, "", CCGetRequestParam("s_secciones_id", $Method, NULL), $this);
            $this->s_secciones_id->DSType = dsTable;
            $this->s_secciones_id->DataSource = new clsDBDatos();
            $this->s_secciones_id->ds = & $this->s_secciones_id->DataSource;
            $this->s_secciones_id->DataSource->SQL = "SELECT * \n" .
"FROM secciones {SQL_Where} {SQL_OrderBy}";
            list($this->s_secciones_id->BoundColumn, $this->s_secciones_id->TextColumn, $this->s_secciones_id->DBFormat) = array("seccion_id", "nom_seccion", "");
            $this->s_fecha = new clsControl(ccsTextBox, "s_fecha", "s_fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha", $Method, NULL), $this);
            $this->s_estado_id = new clsControl(ccsListBox, "s_estado_id", "s_estado_id", ccsText, "", CCGetRequestParam("s_estado_id", $Method, NULL), $this);
            $this->s_estado_id->DSType = dsTable;
            $this->s_estado_id->DataSource = new clsDBDatos();
            $this->s_estado_id->ds = & $this->s_estado_id->DataSource;
            $this->s_estado_id->DataSource->SQL = "SELECT * \n" .
"FROM estados {SQL_Where} {SQL_OrderBy}";
            $this->s_estado_id->DataSource->Order = "estado_id";
            list($this->s_estado_id->BoundColumn, $this->s_estado_id->TextColumn, $this->s_estado_id->DBFormat) = array("estado_id", "nom_estado", "");
            $this->s_estado_id->DataSource->Parameters["expr267"] = 'peticiones_detalle';
            $this->s_estado_id->DataSource->Parameters["expr269"] = 'V';
            $this->s_estado_id->DataSource->wp = new clsSQLParameters();
            $this->s_estado_id->DataSource->wp->AddParameter("1", "expr267", ccsText, "", "", $this->s_estado_id->DataSource->Parameters["expr267"], "", true);
            $this->s_estado_id->DataSource->wp->AddParameter("2", "expr269", ccsText, "", "", $this->s_estado_id->DataSource->Parameters["expr269"], "", false);
            $this->s_estado_id->DataSource->wp->Criterion[1] = $this->s_estado_id->DataSource->wp->Operation(opEqual, "usar_en", $this->s_estado_id->DataSource->wp->GetDBValue("1"), $this->s_estado_id->DataSource->ToSQL($this->s_estado_id->DataSource->wp->GetDBValue("1"), ccsText),true);
            $this->s_estado_id->DataSource->wp->Criterion[2] = $this->s_estado_id->DataSource->wp->Operation(opEqual, "activo", $this->s_estado_id->DataSource->wp->GetDBValue("2"), $this->s_estado_id->DataSource->ToSQL($this->s_estado_id->DataSource->wp->GetDBValue("2"), ccsText),false);
            $this->s_estado_id->DataSource->Where = $this->s_estado_id->DataSource->wp->opAND(
                 false, 
                 $this->s_estado_id->DataSource->wp->Criterion[1], 
                 $this->s_estado_id->DataSource->wp->Criterion[2]);
            $this->s_estado_id->DataSource->Order = "estado_id";
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->s_fecha->Value) && !strlen($this->s_fecha->Value) && $this->s_fecha->Value !== false)
                    $this->s_fecha->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Validate Method @27-BF49CAC2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_test_equipo_id->Validate() && $Validation);
        $Validation = ($this->s_secciones_id->Validate() && $Validation);
        $Validation = ($this->s_fecha->Validate() && $Validation);
        $Validation = ($this->s_estado_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_test_equipo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_secciones_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_estado_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @27-A9FDFFA4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_test_equipo_id->Errors->Count());
        $errors = ($errors || $this->s_secciones_id->Errors->Count());
        $errors = ($errors || $this->s_fecha->Errors->Count());
        $errors = ($errors || $this->s_estado_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @27-7219C161
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
        $Redirect = "ver_hojatrabajo.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ver_hojatrabajo.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @27-A77199ED
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

        $this->s_test_equipo_id->Prepare();
        $this->s_secciones_id->Prepare();
        $this->s_estado_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_test_equipo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_secciones_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_estado_id->Errors->ToString());
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

        $this->s_test_equipo_id->Show();
        $this->s_secciones_id->Show();
        $this->s_fecha->Show();
        $this->s_estado_id->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_detalle_test_sSearch Class @27-FCB6E20C

class clsGridpeticiones_detalle_test_s { //peticiones_detalle_test_s class @2-E715A937

//Variables @2-CD54BAFD

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
    public $AltRowControls;
    public $IsAltRow;
    public $Sorter_muestra_id;
    public $Sorter_nom_prioridad;
//End Variables

//Class_Initialize Event @2-00357CB7
    function clsGridpeticiones_detalle_test_s($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_detalle_test_s";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_detalle_test_s";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_detalle_test_sDataSource($this);
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
        $this->SorterName = CCGetParam("peticiones_detalle_test_sOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_detalle_test_sDir", "");

        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->muestra_id = new clsControl(ccsLabel, "muestra_id", "muestra_id", ccsText, "", CCGetRequestParam("muestra_id", ccsGet, NULL), $this);
        $this->nom_test = new clsControl(ccsLabel, "nom_test", "nom_test", ccsText, "", CCGetRequestParam("nom_test", ccsGet, NULL), $this);
        $this->nom_tipo_muestra = new clsControl(ccsLabel, "nom_tipo_muestra", "nom_tipo_muestra", ccsText, "", CCGetRequestParam("nom_tipo_muestra", ccsGet, NULL), $this);
        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "nom_estado", ccsText, "", CCGetRequestParam("nom_estado", ccsGet, NULL), $this);
        $this->nom_prioridad = new clsControl(ccsLabel, "nom_prioridad", "nom_prioridad", ccsText, "", CCGetRequestParam("nom_prioridad", ccsGet, NULL), $this);
        $this->Alt_nombres = new clsControl(ccsLabel, "Alt_nombres", "Alt_nombres", ccsText, "", CCGetRequestParam("Alt_nombres", ccsGet, NULL), $this);
        $this->Alt_apellidos = new clsControl(ccsLabel, "Alt_apellidos", "Alt_apellidos", ccsText, "", CCGetRequestParam("Alt_apellidos", ccsGet, NULL), $this);
        $this->Alt_muestra_id = new clsControl(ccsLabel, "Alt_muestra_id", "Alt_muestra_id", ccsText, "", CCGetRequestParam("Alt_muestra_id", ccsGet, NULL), $this);
        $this->Alt_nom_test = new clsControl(ccsLabel, "Alt_nom_test", "Alt_nom_test", ccsText, "", CCGetRequestParam("Alt_nom_test", ccsGet, NULL), $this);
        $this->Alt_nom_tipo_muestra = new clsControl(ccsLabel, "Alt_nom_tipo_muestra", "Alt_nom_tipo_muestra", ccsText, "", CCGetRequestParam("Alt_nom_tipo_muestra", ccsGet, NULL), $this);
        $this->Alt_nom_estado = new clsControl(ccsLabel, "Alt_nom_estado", "Alt_nom_estado", ccsText, "", CCGetRequestParam("Alt_nom_estado", ccsGet, NULL), $this);
        $this->Alt_nom_prioridad = new clsControl(ccsLabel, "Alt_nom_prioridad", "Alt_nom_prioridad", ccsText, "", CCGetRequestParam("Alt_nom_prioridad", ccsGet, NULL), $this);
        $this->peticiones_detalle_test_s_TotalRecords = new clsControl(ccsLabel, "peticiones_detalle_test_s_TotalRecords", "peticiones_detalle_test_s_TotalRecords", ccsText, "", CCGetRequestParam("peticiones_detalle_test_s_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_muestra_id = new clsSorter($this->ComponentName, "Sorter_muestra_id", $FileName, $this);
        $this->Sorter_nom_prioridad = new clsSorter($this->ComponentName, "Sorter_nom_prioridad", $FileName, $this);
        $this->Navigator1 = new clsNavigator($this->ComponentName, "Navigator1", $FileName, 10, tpSimple, $this);
        $this->Navigator1->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-849C178C
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_test_equipo_id"] = CCGetFromGet("s_test_equipo_id", NULL);
        $this->DataSource->Parameters["urls_secciones_id"] = CCGetFromGet("s_secciones_id", NULL);
        $this->DataSource->Parameters["urls_muestra_id"] = CCGetFromGet("s_muestra_id", NULL);
        $this->DataSource->Parameters["urls_test_test_id"] = CCGetFromGet("s_test_test_id", NULL);
        $this->DataSource->Parameters["urls_fecha"] = CCGetFromGet("s_fecha", NULL);
        $this->DataSource->Parameters["expr192"] = 'V';
        $this->DataSource->Parameters["urls_estado_id"] = CCGetFromGet("s_estado_id", NULL);
        $this->DataSource->Parameters["expr426"] = 'V';

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
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["muestra_id"] = $this->muestra_id->Visible;
            $this->ControlsVisible["nom_test"] = $this->nom_test->Visible;
            $this->ControlsVisible["nom_tipo_muestra"] = $this->nom_tipo_muestra->Visible;
            $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
            $this->ControlsVisible["nom_prioridad"] = $this->nom_prioridad->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                    $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                    $this->muestra_id->SetValue($this->DataSource->muestra_id->GetValue());
                    $this->nom_test->SetValue($this->DataSource->nom_test->GetValue());
                    $this->nom_tipo_muestra->SetValue($this->DataSource->nom_tipo_muestra->GetValue());
                    $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                    $this->nom_prioridad->SetValue($this->DataSource->nom_prioridad->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->nombres->Show();
                    $this->apellidos->Show();
                    $this->muestra_id->Show();
                    $this->nom_test->Show();
                    $this->nom_tipo_muestra->Show();
                    $this->nom_estado->Show();
                    $this->nom_prioridad->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_nombres->SetValue($this->DataSource->Alt_nombres->GetValue());
                    $this->Alt_apellidos->SetValue($this->DataSource->Alt_apellidos->GetValue());
                    $this->Alt_muestra_id->SetValue($this->DataSource->Alt_muestra_id->GetValue());
                    $this->Alt_nom_test->SetValue($this->DataSource->Alt_nom_test->GetValue());
                    $this->Alt_nom_tipo_muestra->SetValue($this->DataSource->Alt_nom_tipo_muestra->GetValue());
                    $this->Alt_nom_estado->SetValue($this->DataSource->Alt_nom_estado->GetValue());
                    $this->Alt_nom_prioridad->SetValue($this->DataSource->Alt_nom_prioridad->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_nombres->Show();
                    $this->Alt_apellidos->Show();
                    $this->Alt_muestra_id->Show();
                    $this->Alt_nom_test->Show();
                    $this->Alt_nom_tipo_muestra->Show();
                    $this->Alt_nom_estado->Show();
                    $this->Alt_nom_prioridad->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parseto("AltRow", true, "Row");
                }
                $this->IsAltRow = (!$this->IsAltRow);
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
        $this->peticiones_detalle_test_s_TotalRecords->Show();
        $this->Sorter_muestra_id->Show();
        $this->Sorter_nom_prioridad->Show();
        $this->Navigator1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-2A464416
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->muestra_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_tipo_muestra->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_prioridad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_muestra_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_tipo_muestra->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_prioridad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_detalle_test_s Class @2-FCB6E20C

class clspeticiones_detalle_test_sDataSource extends clsDBDatos {  //peticiones_detalle_test_sDataSource Class @2-B56D81CF

//DataSource Variables @2-32873D75
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nombres;
    public $apellidos;
    public $muestra_id;
    public $nom_test;
    public $nom_tipo_muestra;
    public $nom_estado;
    public $nom_prioridad;
    public $Alt_nombres;
    public $Alt_apellidos;
    public $Alt_muestra_id;
    public $Alt_nom_test;
    public $Alt_nom_tipo_muestra;
    public $Alt_nom_estado;
    public $Alt_nom_prioridad;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7B4753B0
    function clspeticiones_detalle_test_sDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_detalle_test_s";
        $this->Initialize();
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->muestra_id = new clsField("muestra_id", ccsText, "");
        
        $this->nom_test = new clsField("nom_test", ccsText, "");
        
        $this->nom_tipo_muestra = new clsField("nom_tipo_muestra", ccsText, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        
        $this->nom_prioridad = new clsField("nom_prioridad", ccsText, "");
        
        $this->Alt_nombres = new clsField("Alt_nombres", ccsText, "");
        
        $this->Alt_apellidos = new clsField("Alt_apellidos", ccsText, "");
        
        $this->Alt_muestra_id = new clsField("Alt_muestra_id", ccsText, "");
        
        $this->Alt_nom_test = new clsField("Alt_nom_test", ccsText, "");
        
        $this->Alt_nom_tipo_muestra = new clsField("Alt_nom_tipo_muestra", ccsText, "");
        
        $this->Alt_nom_estado = new clsField("Alt_nom_estado", ccsText, "");
        
        $this->Alt_nom_prioridad = new clsField("Alt_nom_prioridad", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-BE74E937
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "peticiones.peticion_id, detalle_peticion_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_muestra_id" => array("muestra_id", ""), 
            "Sorter_nom_prioridad" => array("nom_prioridad", "")));
    }
//End SetOrder Method

//Prepare Method @2-2385FEAD
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_test_equipo_id", ccsInteger, "", "", $this->Parameters["urls_test_equipo_id"], "", false);
        $this->wp->AddParameter("2", "urls_secciones_id", ccsInteger, "", "", $this->Parameters["urls_secciones_id"], "", false);
        $this->wp->AddParameter("3", "urls_muestra_id", ccsText, "", "", $this->Parameters["urls_muestra_id"], "", false);
        $this->wp->AddParameter("4", "urls_test_test_id", ccsInteger, "", "", $this->Parameters["urls_test_test_id"], "", false);
        $this->wp->AddParameter("5", "urls_fecha", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha"], GetFechaServer(), false);
        $this->wp->AddParameter("6", "expr192", ccsText, "", "", $this->Parameters["expr192"], 'V', false);
        $this->wp->AddParameter("7", "urls_estado_id", ccsInteger, "", "", $this->Parameters["urls_estado_id"], "", false);
        $this->wp->AddParameter("8", "expr426", ccsText, "", "", $this->Parameters["expr426"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "test.equipo_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "test.secciones_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "peticiones_detalle.muestra_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "test.test_id", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsInteger),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "peticiones.fecha", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsDate),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "test.aislado", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsText),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opEqual, "peticiones_detalle.estado_id", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsInteger),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opNotEqual, "peticiones_detalle.decompuesto", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
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
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7]), 
             $this->wp->Criterion[8]);
    }
//End Prepare Method

//Open Method @2-5E5477F2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((((((test RIGHT JOIN peticiones_detalle ON\n\n" .
        "peticiones_detalle.test_id = test.test_id) LEFT JOIN equipos ON\n\n" .
        "test.equipo_id = equipos.equipo_id) LEFT JOIN secciones ON\n\n" .
        "test.secciones_id = secciones.seccion_id) LEFT JOIN tipos_muestra ON\n\n" .
        "test.tipo_muestra_id = tipos_muestra.tipo_muestra_id) LEFT JOIN prioridades ON\n\n" .
        "peticiones_detalle.prioridad_id = prioridades.prioridad_id) LEFT JOIN peticiones ON\n\n" .
        "peticiones_detalle.peticion_id = peticiones.peticion_id) LEFT JOIN estados ON\n\n" .
        "peticiones_detalle.estado_id = estados.estado_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id";
        $this->SQL = "SELECT detalle_peticion_id, peticiones_detalle.peticion_id AS peticiones_detalle_peticion_id, muestra_id, peticiones_detalle.test_id AS peticiones_detalle_test_id,\n\n" .
        "peticiones_detalle.estado_id AS peticiones_detalle_estado_id, peticiones_detalle.prioridad_id AS peticiones_detalle_prioridad_id,\n\n" .
        "test.test_id AS test_test_id, secciones_id, test.equipo_id AS test_equipo_id, cod_test, nom_test, seccion_id, nom_seccion,\n\n" .
        "equipos.equipo_id AS equipos_equipo_id, nom_equipo, prioridades.prioridad_id AS prioridades_prioridad_id, nom_prioridad,\n\n" .
        "fecha, nom_tipo_muestra, nombres, apellidos, nom_estado \n\n" .
        "FROM (((((((test RIGHT JOIN peticiones_detalle ON\n\n" .
        "peticiones_detalle.test_id = test.test_id) LEFT JOIN equipos ON\n\n" .
        "test.equipo_id = equipos.equipo_id) LEFT JOIN secciones ON\n\n" .
        "test.secciones_id = secciones.seccion_id) LEFT JOIN tipos_muestra ON\n\n" .
        "test.tipo_muestra_id = tipos_muestra.tipo_muestra_id) LEFT JOIN prioridades ON\n\n" .
        "peticiones_detalle.prioridad_id = prioridades.prioridad_id) LEFT JOIN peticiones ON\n\n" .
        "peticiones_detalle.peticion_id = peticiones.peticion_id) LEFT JOIN estados ON\n\n" .
        "peticiones_detalle.estado_id = estados.estado_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9A54FA94
    function SetValues()
    {
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->muestra_id->SetDBValue($this->f("muestra_id"));
        $this->nom_test->SetDBValue($this->f("cod_test"));
        $this->nom_tipo_muestra->SetDBValue($this->f("nom_tipo_muestra"));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
        $this->nom_prioridad->SetDBValue($this->f("nom_prioridad"));
        $this->Alt_nombres->SetDBValue($this->f("nombres"));
        $this->Alt_apellidos->SetDBValue($this->f("apellidos"));
        $this->Alt_muestra_id->SetDBValue($this->f("muestra_id"));
        $this->Alt_nom_test->SetDBValue($this->f("cod_test"));
        $this->Alt_nom_tipo_muestra->SetDBValue($this->f("nom_tipo_muestra"));
        $this->Alt_nom_estado->SetDBValue($this->f("nom_estado"));
        $this->Alt_nom_prioridad->SetDBValue($this->f("nom_prioridad"));
    }
//End SetValues Method

} //End peticiones_detalle_test_sDataSource Class @2-FCB6E20C

//Include Page implementation @440-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-10706362
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
$TemplateFileName = "ver_hojatrabajo.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-ECE50CEE
CCSecurityRedirect("4;5;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-B128D438
include_once("./ver_hojatrabajo_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D91467F2
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$fun_imprimir = new clsControl(ccsLabel, "fun_imprimir", "fun_imprimir", ccsText, "", CCGetRequestParam("fun_imprimir", ccsGet, NULL), $MainPage);
$fun_imprimir->HTML = true;
$peticiones_detalle_test_sSearch = new clsRecordpeticiones_detalle_test_sSearch("", $MainPage);
$peticiones_detalle_test_s = new clsGridpeticiones_detalle_test_s("", $MainPage);
$calendar_tag1 = new clscalendar_tag("", "calendar_tag1", $MainPage);
$calendar_tag1->Initialize();
$MainPage->fun_imprimir = & $fun_imprimir;
$MainPage->peticiones_detalle_test_sSearch = & $peticiones_detalle_test_sSearch;
$MainPage->peticiones_detalle_test_s = & $peticiones_detalle_test_s;
$MainPage->calendar_tag1 = & $calendar_tag1;
$peticiones_detalle_test_s->Initialize();
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

//Execute Components @1-52EE80BC
$calendar_tag1->Operations();
$peticiones_detalle_test_sSearch->Operation();
//End Execute Components

//Go to destination page @1-B4CF93CE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_detalle_test_sSearch);
    unset($peticiones_detalle_test_s);
    $calendar_tag1->Class_Terminate();
    unset($calendar_tag1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-43122D91
$peticiones_detalle_test_sSearch->Show();
$peticiones_detalle_test_s->Show();
$calendar_tag1->Show();
$fun_imprimir->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EEF34F86
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_detalle_test_sSearch);
unset($peticiones_detalle_test_s);
$calendar_tag1->Class_Terminate();
unset($calendar_tag1);
unset($Tpl);
//End Unload Page


?>
