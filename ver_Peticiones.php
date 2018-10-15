<?php
//Include Common Files @1-5B0B08A7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ver_Peticiones.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_estados_estadoSearch { //peticiones_estados_estadoSearch Class @123-6B15A500

//Variables @123-9E315808

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

//Class_Initialize Event @123-20FA5C3C
    function clsRecordpeticiones_estados_estadoSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_estados_estadoSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_estados_estadoSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_peticion_id = new clsControl(ccsTextBox, "s_peticion_id", "s_peticion_id", ccsInteger, "", CCGetRequestParam("s_peticion_id", $Method, NULL), $this);
            $this->s_fecha_ini = new clsControl(ccsTextBox, "s_fecha_ini", "s_fecha_ini", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_ini", $Method, NULL), $this);
            $this->s_fecha_fin = new clsControl(ccsTextBox, "s_fecha_fin", "s_fecha_fin", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_fin", $Method, NULL), $this);
            $this->s_nombres = new clsControl(ccsTextBox, "s_nombres", "s_nombres", ccsText, "", CCGetRequestParam("s_nombres", $Method, NULL), $this);
            $this->s_apellidos = new clsControl(ccsTextBox, "s_apellidos", "s_apellidos", ccsText, "", CCGetRequestParam("s_apellidos", $Method, NULL), $this);
            $this->s_rut = new clsControl(ccsTextBox, "s_rut", "s_rut", ccsText, "", CCGetRequestParam("s_rut", $Method, NULL), $this);
            $this->s_procedencia_id = new clsControl(ccsListBox, "s_procedencia_id", "s_procedencia_id", ccsInteger, "", CCGetRequestParam("s_procedencia_id", $Method, NULL), $this);
            $this->s_procedencia_id->DSType = dsTable;
            $this->s_procedencia_id->DataSource = new clsDBDatos();
            $this->s_procedencia_id->ds = & $this->s_procedencia_id->DataSource;
            $this->s_procedencia_id->DataSource->SQL = "SELECT * \n" .
"FROM procedencias {SQL_Where} {SQL_OrderBy}";
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            list($this->s_procedencia_id->BoundColumn, $this->s_procedencia_id->TextColumn, $this->s_procedencia_id->DBFormat) = array("procedencia_id", "nom_procedencia", "");
            $this->s_procedencia_id->DataSource->wp = new clsSQLParameters();
            $this->s_procedencia_id->DataSource->wp->Criterion[1] = "( ". GetCondicion('procedencia') ." )";
            $this->s_procedencia_id->DataSource->Where = 
                 $this->s_procedencia_id->DataSource->wp->Criterion[1];
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            $this->s_estado_id = new clsControl(ccsListBox, "s_estado_id", "s_estado_id", ccsInteger, "", CCGetRequestParam("s_estado_id", $Method, NULL), $this);
            $this->s_estado_id->DSType = dsTable;
            $this->s_estado_id->DataSource = new clsDBDatos();
            $this->s_estado_id->ds = & $this->s_estado_id->DataSource;
            $this->s_estado_id->DataSource->SQL = "SELECT * \n" .
"FROM estados {SQL_Where} {SQL_OrderBy}";
            $this->s_estado_id->DataSource->Order = "estado_id";
            list($this->s_estado_id->BoundColumn, $this->s_estado_id->TextColumn, $this->s_estado_id->DBFormat) = array("estado_id", "nom_estado", "");
            $this->s_estado_id->DataSource->Parameters["expr200"] = 'peticiones';
            $this->s_estado_id->DataSource->wp = new clsSQLParameters();
            $this->s_estado_id->DataSource->wp->AddParameter("1", "expr200", ccsText, "", "", $this->s_estado_id->DataSource->Parameters["expr200"], 'peticiones', false);
            $this->s_estado_id->DataSource->wp->Criterion[1] = $this->s_estado_id->DataSource->wp->Operation(opEqual, "usar_en", $this->s_estado_id->DataSource->wp->GetDBValue("1"), $this->s_estado_id->DataSource->ToSQL($this->s_estado_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->s_estado_id->DataSource->Where = 
                 $this->s_estado_id->DataSource->wp->Criterion[1];
            $this->s_estado_id->DataSource->Order = "estado_id";
            $this->s_estado_pago_id = new clsControl(ccsListBox, "s_estado_pago_id", "s_estado_pago_id", ccsInteger, "", CCGetRequestParam("s_estado_pago_id", $Method, NULL), $this);
            $this->s_estado_pago_id->DSType = dsTable;
            $this->s_estado_pago_id->DataSource = new clsDBDatos();
            $this->s_estado_pago_id->ds = & $this->s_estado_pago_id->DataSource;
            $this->s_estado_pago_id->DataSource->SQL = "SELECT * \n" .
"FROM estados_pagos {SQL_Where} {SQL_OrderBy}";
            list($this->s_estado_pago_id->BoundColumn, $this->s_estado_pago_id->TextColumn, $this->s_estado_pago_id->DBFormat) = array("estado_pago_id", "nom_estado_pago", "");
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->s_fecha_ini->Value) && !strlen($this->s_fecha_ini->Value) && $this->s_fecha_ini->Value !== false)
                    $this->s_fecha_ini->SetValue(time());
                if(!is_array($this->s_fecha_fin->Value) && !strlen($this->s_fecha_fin->Value) && $this->s_fecha_fin->Value !== false)
                    $this->s_fecha_fin->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Validate Method @123-3EA7FD17
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $Validation = ($this->s_fecha_ini->Validate() && $Validation);
        $Validation = ($this->s_fecha_fin->Validate() && $Validation);
        $Validation = ($this->s_nombres->Validate() && $Validation);
        $Validation = ($this->s_apellidos->Validate() && $Validation);
        $Validation = ($this->s_rut->Validate() && $Validation);
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_estado_id->Validate() && $Validation);
        $Validation = ($this->s_estado_pago_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_ini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_fin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombres->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_apellidos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_rut->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_estado_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_estado_pago_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @123-75D1C4A5
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->s_fecha_ini->Errors->Count());
        $errors = ($errors || $this->s_fecha_fin->Errors->Count());
        $errors = ($errors || $this->s_nombres->Errors->Count());
        $errors = ($errors || $this->s_apellidos->Errors->Count());
        $errors = ($errors || $this->s_rut->Errors->Count());
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_estado_id->Errors->Count());
        $errors = ($errors || $this->s_estado_pago_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @123-0CE1E26D
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
        $Redirect = "ver_Peticiones.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ver_Peticiones.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @123-9887C954
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

        $this->s_procedencia_id->Prepare();
        $this->s_estado_id->Prepare();
        $this->s_estado_pago_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_ini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_fin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombres->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_apellidos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_rut->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_estado_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_estado_pago_id->Errors->ToString());
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
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->s_nombres->Show();
        $this->s_apellidos->Show();
        $this->s_rut->Show();
        $this->s_procedencia_id->Show();
        $this->s_estado_id->Show();
        $this->s_estado_pago_id->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_estados_estadoSearch Class @123-FCB6E20C

class clsGridpeticiones_estados_estado { //peticiones_estados_estado class @105-41383ED5

//Variables @105-F4659A83

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
    public $Sorter_peticion_id;
    public $Sorter_fecha;
    public $Sorter_nombres;
    public $Sorter_apellidos;
    public $Sorter_rut;
    public $Sorter_ficha;
    public $Sorter_nom_procedencia;
    public $Sorter_nom_estado;
    public $Sorter_nom_estado_pago;
//End Variables

//Class_Initialize Event @105-EC01618D
    function clsGridpeticiones_estados_estado($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_estados_estado";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_estados_estado";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_estados_estadoDataSource($this);
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
        $this->SorterName = CCGetParam("peticiones_estados_estadoOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_estados_estadoDir", "");

        $this->img_pendiente = new clsControl(ccsLink, "img_pendiente", "img_pendiente", ccsText, "", CCGetRequestParam("img_pendiente", ccsGet, NULL), $this);
        $this->img_pendiente->HTML = true;
        $this->img_pendiente->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->img_pendiente->Page = "";
        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "det_Peticion.php";
        $this->ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $this);
        $this->ImageLink2->Page = "add_resultados_peticion2.php";
        $this->ImageLink3 = new clsControl(ccsImageLink, "ImageLink3", "ImageLink3", ccsText, "", CCGetRequestParam("ImageLink3", ccsGet, NULL), $this);
        $this->ImageLink3->Page = "validar_resultados_peticion.php";
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->ficha = new clsControl(ccsLabel, "ficha", "ficha", ccsText, "", CCGetRequestParam("ficha", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "nom_estado", ccsText, "", CCGetRequestParam("nom_estado", ccsGet, NULL), $this);
        $this->nom_estado_pago = new clsControl(ccsLabel, "nom_estado_pago", "nom_estado_pago", ccsText, "", CCGetRequestParam("nom_estado_pago", ccsGet, NULL), $this);
        $this->pendiente = new clsControl(ccsLabel, "pendiente", "pendiente", ccsText, "", CCGetRequestParam("pendiente", ccsGet, NULL), $this);
        $this->pendiente->HTML = true;
        $this->pid = new clsControl(ccsHidden, "pid", "pid", ccsInteger, "", CCGetRequestParam("pid", ccsGet, NULL), $this);
        $this->peticiones_estados_estado_TotalRecords = new clsControl(ccsLabel, "peticiones_estados_estado_TotalRecords", "peticiones_estados_estado_TotalRecords", ccsText, "", CCGetRequestParam("peticiones_estados_estado_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_peticion_id = new clsSorter($this->ComponentName, "Sorter_peticion_id", $FileName, $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_nombres = new clsSorter($this->ComponentName, "Sorter_nombres", $FileName, $this);
        $this->Sorter_apellidos = new clsSorter($this->ComponentName, "Sorter_apellidos", $FileName, $this);
        $this->Sorter_rut = new clsSorter($this->ComponentName, "Sorter_rut", $FileName, $this);
        $this->Sorter_ficha = new clsSorter($this->ComponentName, "Sorter_ficha", $FileName, $this);
        $this->Sorter_nom_procedencia = new clsSorter($this->ComponentName, "Sorter_nom_procedencia", $FileName, $this);
        $this->Sorter_nom_estado = new clsSorter($this->ComponentName, "Sorter_nom_estado", $FileName, $this);
        $this->Sorter_nom_estado_pago = new clsSorter($this->ComponentName, "Sorter_nom_estado_pago", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @105-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @105-9C81DE5E
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_peticion_id"] = CCGetFromGet("s_peticion_id", NULL);
        $this->DataSource->Parameters["urls_fecha_ini"] = CCGetFromGet("s_fecha_ini", NULL);
        $this->DataSource->Parameters["urls_fecha_fin"] = CCGetFromGet("s_fecha_fin", NULL);
        $this->DataSource->Parameters["urls_nombres"] = CCGetFromGet("s_nombres", NULL);
        $this->DataSource->Parameters["urls_apellidos"] = CCGetFromGet("s_apellidos", NULL);
        $this->DataSource->Parameters["urls_estado_id"] = CCGetFromGet("s_estado_id", NULL);
        $this->DataSource->Parameters["urls_estado_pago_id"] = CCGetFromGet("s_estado_pago_id", NULL);
        $this->DataSource->Parameters["urls_rut"] = CCGetFromGet("s_rut", NULL);

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
            $this->ControlsVisible["img_pendiente"] = $this->img_pendiente->Visible;
            $this->ControlsVisible["ImageLink1"] = $this->ImageLink1->Visible;
            $this->ControlsVisible["ImageLink2"] = $this->ImageLink2->Visible;
            $this->ControlsVisible["ImageLink3"] = $this->ImageLink3->Visible;
            $this->ControlsVisible["peticion_id"] = $this->peticion_id->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["rut"] = $this->rut->Visible;
            $this->ControlsVisible["ficha"] = $this->ficha->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
            $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
            $this->ControlsVisible["nom_estado_pago"] = $this->nom_estado_pago->Visible;
            $this->ControlsVisible["pendiente"] = $this->pendiente->Visible;
            $this->ControlsVisible["pid"] = $this->pid->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "peticion_id", $this->DataSource->f("peticion_id"));
                $this->ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink2->Parameters = CCAddParam($this->ImageLink2->Parameters, "s_peticion_id", $this->DataSource->f("peticion_id"));
                $this->ImageLink3->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink3->Parameters = CCAddParam($this->ImageLink3->Parameters, "s_peticion_id", $this->DataSource->f("peticion_id"));
                $this->ImageLink3->Parameters = CCAddParam($this->ImageLink3->Parameters, "peticion_id", $this->DataSource->f("peticion_id"));
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->rut->SetValue($this->DataSource->rut->GetValue());
                $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                $this->nom_estado_pago->SetValue($this->DataSource->nom_estado_pago->GetValue());
                $this->pid->SetValue($this->DataSource->pid->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->img_pendiente->Show();
                $this->ImageLink1->Show();
                $this->ImageLink2->Show();
                $this->ImageLink3->Show();
                $this->peticion_id->Show();
                $this->fecha->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->rut->Show();
                $this->ficha->Show();
                $this->nom_procedencia->Show();
                $this->nom_estado->Show();
                $this->nom_estado_pago->Show();
                $this->pendiente->Show();
                $this->pid->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->peticiones_estados_estado_TotalRecords->Show();
        $this->Sorter_peticion_id->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_nombres->Show();
        $this->Sorter_apellidos->Show();
        $this->Sorter_rut->Show();
        $this->Sorter_ficha->Show();
        $this->Sorter_nom_procedencia->Show();
        $this->Sorter_nom_estado->Show();
        $this->Sorter_nom_estado_pago->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @105-FEC1F4F6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->img_pendiente->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ImageLink3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado_pago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pendiente->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_estados_estado Class @105-FCB6E20C

class clspeticiones_estados_estadoDataSource extends clsDBDatos {  //peticiones_estados_estadoDataSource Class @105-091CAC1E

//DataSource Variables @105-654521BD
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $peticion_id;
    public $fecha;
    public $nombres;
    public $apellidos;
    public $rut;
    public $ficha;
    public $nom_procedencia;
    public $nom_estado;
    public $nom_estado_pago;
    public $pid;
//End DataSource Variables

//DataSourceClass_Initialize Event @105-A21B6CCB
    function clspeticiones_estados_estadoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_estados_estado";
        $this->Initialize();
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        
        $this->nom_estado_pago = new clsField("nom_estado_pago", ccsText, "");
        
        $this->pid = new clsField("pid", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @105-FB3FBE88
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "peticion_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_peticion_id" => array("peticion_id", ""), 
            "Sorter_fecha" => array("fecha", ""), 
            "Sorter_nombres" => array("nombres", ""), 
            "Sorter_apellidos" => array("apellidos", ""), 
            "Sorter_rut" => array("rut", ""), 
            "Sorter_ficha" => array("ficha", ""), 
            "Sorter_nom_procedencia" => array("nom_procedencia", ""), 
            "Sorter_nom_estado" => array("nom_estado", ""), 
            "Sorter_nom_estado_pago" => array("nom_estado_pago", "")));
    }
//End SetOrder Method

//Prepare Method @105-32FE95E8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_peticion_id", ccsInteger, "", "", $this->Parameters["urls_peticion_id"], "", false);
        $this->wp->AddParameter("2", "urls_fecha_ini", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha_ini"], date("d/m/Y"), false);
        $this->wp->AddParameter("3", "urls_fecha_fin", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha_fin"], date("d/m/Y"), false);
        $this->wp->AddParameter("4", "urls_nombres", ccsText, "", "", $this->Parameters["urls_nombres"], "", false);
        $this->wp->AddParameter("5", "urls_apellidos", ccsText, "", "", $this->Parameters["urls_apellidos"], "", false);
        $this->wp->AddParameter("6", "urls_estado_id", ccsInteger, "", "", $this->Parameters["urls_estado_id"], "", false);
        $this->wp->AddParameter("7", "urls_estado_pago_id", ccsInteger, "", "", $this->Parameters["urls_estado_pago_id"], "", false);
        $this->wp->AddParameter("8", "urls_rut", ccsText, "", "", $this->Parameters["urls_rut"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opGreaterThanOrEqual, "fecha", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opLessThanOrEqual, "peticiones.fecha", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsDate),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opContains, "nombres", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsText),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opContains, "apellidos", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsText),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "peticiones.estado_id", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsInteger),false);
        $this->wp->Criterion[7] = $this->wp->Operation(opEqual, "peticiones.estado_pago_id", $this->wp->GetDBValue("7"), $this->ToSQL($this->wp->GetDBValue("7"), ccsInteger),false);
        $this->wp->Criterion[8] = $this->wp->Operation(opContains, "pacientes.rut", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], $this->wp->opAND(
             true, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             true, 
             $this->wp->Criterion[2], 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]), 
             $this->wp->Criterion[5]), 
             $this->wp->Criterion[6]), 
             $this->wp->Criterion[7])), 
             $this->wp->Criterion[8]);
    }
//End Prepare Method

//Open Method @105-D4C85579
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((peticiones LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id) LEFT JOIN estados_pagos ON\n\n" .
        "peticiones.estado_pago_id = estados_pagos.estado_pago_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id";
        $this->SQL = "SELECT peticiones.*, nom_estado, nom_estado_pago, rut, ficha, nombres, apellidos, nom_procedencia \n\n" .
        "FROM (((peticiones LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id) LEFT JOIN estados_pagos ON\n\n" .
        "peticiones.estado_pago_id = estados_pagos.estado_pago_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @105-FC766369
    function SetValues()
    {
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->rut->SetDBValue($this->f("rut"));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
        $this->nom_estado_pago->SetDBValue($this->f("nom_estado_pago"));
        $this->pid->SetDBValue(trim($this->f("peticion_id")));
    }
//End SetValues Method

} //End peticiones_estados_estadoDataSource Class @105-FCB6E20C

//Include Page implementation @96-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-16C10866
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
$TemplateFileName = "ver_Peticiones.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-235FDDA2
CCSecurityRedirect("4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20", "");
//End Authenticate User

//Include events file @1-D83B15AC
include_once("./ver_Peticiones_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A5221EB3
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_estados_estadoSearch = new clsRecordpeticiones_estados_estadoSearch("", $MainPage);
$peticiones_estados_estado = new clsGridpeticiones_estados_estado("", $MainPage);
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$MainPage->peticiones_estados_estadoSearch = & $peticiones_estados_estadoSearch;
$MainPage->peticiones_estados_estado = & $peticiones_estados_estado;
$MainPage->calendar_tag = & $calendar_tag;
$peticiones_estados_estado->Initialize();
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

//Execute Components @1-9C125A6D
$calendar_tag->Operations();
$peticiones_estados_estadoSearch->Operation();
//End Execute Components

//Go to destination page @1-61EAA654
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_estados_estadoSearch);
    unset($peticiones_estados_estado);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A6E2B41A
$peticiones_estados_estadoSearch->Show();
$peticiones_estados_estado->Show();
$calendar_tag->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6A8C7BC2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_estados_estadoSearch);
unset($peticiones_estados_estado);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($Tpl);
//End Unload Page


?>
