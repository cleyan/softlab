<?php
//Include Common Files @1-CCBB13BC
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "peticiones.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_pacientes_procSearch { //peticiones_pacientes_procSearch Class @26-A2BA154F

//Variables @26-9E315808

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

//Class_Initialize Event @26-2F354290
    function clsRecordpeticiones_pacientes_procSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_pacientes_procSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_pacientes_procSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_nombres = new clsControl(ccsTextBox, "s_nombres", "s_nombres", ccsText, "", CCGetRequestParam("s_nombres", $Method, NULL), $this);
            $this->s_peticiones_procedencia_id = new clsControl(ccsTextBox, "s_peticiones_procedencia_id", "s_peticiones_procedencia_id", ccsInteger, "", CCGetRequestParam("s_peticiones_procedencia_id", $Method, NULL), $this);
            $this->s_peticiones_estado_id = new clsControl(ccsTextBox, "s_peticiones_estado_id", "s_peticiones_estado_id", ccsInteger, "", CCGetRequestParam("s_peticiones_estado_id", $Method, NULL), $this);
            $this->s_fecha = new clsControl(ccsTextBox, "s_fecha", "s_fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_fecha", $Method, NULL), $this);
            $this->DatePicker_s_fecha = new clsDatePicker("DatePicker_s_fecha", "peticiones_pacientes_procSearch", "s_fecha", $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @26-03C08FFA
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_nombres->Validate() && $Validation);
        $Validation = ($this->s_peticiones_procedencia_id->Validate() && $Validation);
        $Validation = ($this->s_peticiones_estado_id->Validate() && $Validation);
        $Validation = ($this->s_fecha->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_nombres->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_peticiones_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_peticiones_estado_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @26-7118B515
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_nombres->Errors->Count());
        $errors = ($errors || $this->s_peticiones_procedencia_id->Errors->Count());
        $errors = ($errors || $this->s_peticiones_estado_id->Errors->Count());
        $errors = ($errors || $this->s_fecha->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_fecha->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @26-203AD011
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
        $Redirect = "peticiones.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "peticiones.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @26-141FF821
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
            $Error = ComposeStrings($Error, $this->s_nombres->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_peticiones_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_peticiones_estado_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_fecha->Errors->ToString());
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

        $this->s_nombres->Show();
        $this->s_peticiones_procedencia_id->Show();
        $this->s_peticiones_estado_id->Show();
        $this->s_fecha->Show();
        $this->DatePicker_s_fecha->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_pacientes_procSearch Class @26-FCB6E20C

class clsGridpeticiones_pacientes_proc { //peticiones_pacientes_proc class @2-43F535CB

//Variables @2-4D08F4B3

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
    public $Sorter_nom_estado;
    public $Sorter_rut;
    public $Sorter_ficha;
    public $Sorter_nombres;
    public $Sorter_apellidos;
    public $Sorter_peticion_id;
    public $Sorter_fecha;
    public $Sorter_hora;
    public $Sorter_observaciones;
    public $Sorter_nom_procedencia;
//End Variables

//Class_Initialize Event @2-DF7E6411
    function clsGridpeticiones_pacientes_proc($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_pacientes_proc";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->IsAltRow = false;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_pacientes_proc";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_pacientes_procDataSource($this);
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
        $this->SorterName = CCGetParam("peticiones_pacientes_procOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_pacientes_procDir", "");

        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "nom_estado", ccsText, "", CCGetRequestParam("nom_estado", ccsGet, NULL), $this);
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->ficha = new clsControl(ccsLabel, "ficha", "ficha", ccsText, "", CCGetRequestParam("ficha", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->hora = new clsControl(ccsLabel, "hora", "hora", ccsDate, $DefaultDateFormat, CCGetRequestParam("hora", ccsGet, NULL), $this);
        $this->observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->Alt_nom_estado = new clsControl(ccsLabel, "Alt_nom_estado", "Alt_nom_estado", ccsText, "", CCGetRequestParam("Alt_nom_estado", ccsGet, NULL), $this);
        $this->Alt_rut = new clsControl(ccsLabel, "Alt_rut", "Alt_rut", ccsText, "", CCGetRequestParam("Alt_rut", ccsGet, NULL), $this);
        $this->Alt_ficha = new clsControl(ccsLabel, "Alt_ficha", "Alt_ficha", ccsText, "", CCGetRequestParam("Alt_ficha", ccsGet, NULL), $this);
        $this->Alt_nombres = new clsControl(ccsLabel, "Alt_nombres", "Alt_nombres", ccsText, "", CCGetRequestParam("Alt_nombres", ccsGet, NULL), $this);
        $this->Alt_apellidos = new clsControl(ccsLabel, "Alt_apellidos", "Alt_apellidos", ccsText, "", CCGetRequestParam("Alt_apellidos", ccsGet, NULL), $this);
        $this->Alt_peticion_id = new clsControl(ccsLabel, "Alt_peticion_id", "Alt_peticion_id", ccsInteger, "", CCGetRequestParam("Alt_peticion_id", ccsGet, NULL), $this);
        $this->Alt_fecha = new clsControl(ccsLabel, "Alt_fecha", "Alt_fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("Alt_fecha", ccsGet, NULL), $this);
        $this->Alt_hora = new clsControl(ccsLabel, "Alt_hora", "Alt_hora", ccsDate, $DefaultDateFormat, CCGetRequestParam("Alt_hora", ccsGet, NULL), $this);
        $this->Alt_observaciones = new clsControl(ccsLabel, "Alt_observaciones", "Alt_observaciones", ccsText, "", CCGetRequestParam("Alt_observaciones", ccsGet, NULL), $this);
        $this->Alt_nom_procedencia = new clsControl(ccsLabel, "Alt_nom_procedencia", "Alt_nom_procedencia", ccsText, "", CCGetRequestParam("Alt_nom_procedencia", ccsGet, NULL), $this);
        $this->peticiones_pacientes_proc_TotalRecords = new clsControl(ccsLabel, "peticiones_pacientes_proc_TotalRecords", "peticiones_pacientes_proc_TotalRecords", ccsText, "", CCGetRequestParam("peticiones_pacientes_proc_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_nom_estado = new clsSorter($this->ComponentName, "Sorter_nom_estado", $FileName, $this);
        $this->Sorter_rut = new clsSorter($this->ComponentName, "Sorter_rut", $FileName, $this);
        $this->Sorter_ficha = new clsSorter($this->ComponentName, "Sorter_ficha", $FileName, $this);
        $this->Sorter_nombres = new clsSorter($this->ComponentName, "Sorter_nombres", $FileName, $this);
        $this->Sorter_apellidos = new clsSorter($this->ComponentName, "Sorter_apellidos", $FileName, $this);
        $this->Sorter_peticion_id = new clsSorter($this->ComponentName, "Sorter_peticion_id", $FileName, $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_hora = new clsSorter($this->ComponentName, "Sorter_hora", $FileName, $this);
        $this->Sorter_observaciones = new clsSorter($this->ComponentName, "Sorter_observaciones", $FileName, $this);
        $this->Sorter_nom_procedencia = new clsSorter($this->ComponentName, "Sorter_nom_procedencia", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-35386272
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nombres"] = CCGetFromGet("s_nombres", NULL);
        $this->DataSource->Parameters["urls_peticiones_procedencia_id"] = CCGetFromGet("s_peticiones_procedencia_id", NULL);
        $this->DataSource->Parameters["urls_peticiones_estado_id"] = CCGetFromGet("s_peticiones_estado_id", NULL);
        $this->DataSource->Parameters["urls_fecha"] = CCGetFromGet("s_fecha", NULL);

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
            $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
            $this->ControlsVisible["rut"] = $this->rut->Visible;
            $this->ControlsVisible["ficha"] = $this->ficha->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["peticion_id"] = $this->peticion_id->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["hora"] = $this->hora->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                if(!$this->IsAltRow)
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                    $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                    $this->rut->SetValue($this->DataSource->rut->GetValue());
                    $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                    $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                    $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                    $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->hora->SetValue($this->DataSource->hora->GetValue());
                    $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                    $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->nom_estado->Show();
                    $this->rut->Show();
                    $this->ficha->Show();
                    $this->nombres->Show();
                    $this->apellidos->Show();
                    $this->peticion_id->Show();
                    $this->fecha->Show();
                    $this->hora->Show();
                    $this->observaciones->Show();
                    $this->nom_procedencia->Show();
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                    $Tpl->parse("Row", true);
                }
                else
                {
                    $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/AltRow";
                    $this->Alt_nom_estado->SetValue($this->DataSource->Alt_nom_estado->GetValue());
                    $this->Alt_rut->SetValue($this->DataSource->Alt_rut->GetValue());
                    $this->Alt_ficha->SetValue($this->DataSource->Alt_ficha->GetValue());
                    $this->Alt_nombres->SetValue($this->DataSource->Alt_nombres->GetValue());
                    $this->Alt_apellidos->SetValue($this->DataSource->Alt_apellidos->GetValue());
                    $this->Alt_peticion_id->SetValue($this->DataSource->Alt_peticion_id->GetValue());
                    $this->Alt_fecha->SetValue($this->DataSource->Alt_fecha->GetValue());
                    $this->Alt_hora->SetValue($this->DataSource->Alt_hora->GetValue());
                    $this->Alt_observaciones->SetValue($this->DataSource->Alt_observaciones->GetValue());
                    $this->Alt_nom_procedencia->SetValue($this->DataSource->Alt_nom_procedencia->GetValue());
                    $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                    $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                    $this->Attributes->Show();
                    $this->Alt_nom_estado->Show();
                    $this->Alt_rut->Show();
                    $this->Alt_ficha->Show();
                    $this->Alt_nombres->Show();
                    $this->Alt_apellidos->Show();
                    $this->Alt_peticion_id->Show();
                    $this->Alt_fecha->Show();
                    $this->Alt_hora->Show();
                    $this->Alt_observaciones->Show();
                    $this->Alt_nom_procedencia->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if (($this->Navigator->TotalPages <= 1 && $this->Navigator->PageNumber == 1) || $this->Navigator->PageSize == "") {
            $this->Navigator->Visible = false;
        }
        $this->peticiones_pacientes_proc_TotalRecords->Show();
        $this->Sorter_nom_estado->Show();
        $this->Sorter_rut->Show();
        $this->Sorter_ficha->Show();
        $this->Sorter_nombres->Show();
        $this->Sorter_apellidos->Show();
        $this->Sorter_peticion_id->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_hora->Show();
        $this->Sorter_observaciones->Show();
        $this->Sorter_nom_procedencia->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-8F32144E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->hora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_hora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Alt_nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_pacientes_proc Class @2-FCB6E20C

class clspeticiones_pacientes_procDataSource extends clsDBDatos {  //peticiones_pacientes_procDataSource Class @2-33CC6345

//DataSource Variables @2-51F5D0AF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $nom_estado;
    public $rut;
    public $ficha;
    public $nombres;
    public $apellidos;
    public $peticion_id;
    public $fecha;
    public $hora;
    public $observaciones;
    public $nom_procedencia;
    public $Alt_nom_estado;
    public $Alt_rut;
    public $Alt_ficha;
    public $Alt_nombres;
    public $Alt_apellidos;
    public $Alt_peticion_id;
    public $Alt_fecha;
    public $Alt_hora;
    public $Alt_observaciones;
    public $Alt_nom_procedencia;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-693F3951
    function clspeticiones_pacientes_procDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_pacientes_proc";
        $this->Initialize();
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, $this->DateFormat);
        
        $this->hora = new clsField("hora", ccsDate, $this->DateFormat);
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->Alt_nom_estado = new clsField("Alt_nom_estado", ccsText, "");
        
        $this->Alt_rut = new clsField("Alt_rut", ccsText, "");
        
        $this->Alt_ficha = new clsField("Alt_ficha", ccsText, "");
        
        $this->Alt_nombres = new clsField("Alt_nombres", ccsText, "");
        
        $this->Alt_apellidos = new clsField("Alt_apellidos", ccsText, "");
        
        $this->Alt_peticion_id = new clsField("Alt_peticion_id", ccsInteger, "");
        
        $this->Alt_fecha = new clsField("Alt_fecha", ccsDate, $this->DateFormat);
        
        $this->Alt_hora = new clsField("Alt_hora", ccsDate, $this->DateFormat);
        
        $this->Alt_observaciones = new clsField("Alt_observaciones", ccsText, "");
        
        $this->Alt_nom_procedencia = new clsField("Alt_nom_procedencia", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4BCE34FC
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_nom_estado" => array("nom_estado", ""), 
            "Sorter_rut" => array("rut", ""), 
            "Sorter_ficha" => array("ficha", ""), 
            "Sorter_nombres" => array("nombres", ""), 
            "Sorter_apellidos" => array("apellidos", ""), 
            "Sorter_peticion_id" => array("peticion_id", ""), 
            "Sorter_fecha" => array("fecha", ""), 
            "Sorter_hora" => array("hora", ""), 
            "Sorter_observaciones" => array("observaciones", ""), 
            "Sorter_nom_procedencia" => array("nom_procedencia", "")));
    }
//End SetOrder Method

//Prepare Method @2-B650D4C6
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nombres", ccsText, "", "", $this->Parameters["urls_nombres"], "", false);
        $this->wp->AddParameter("2", "urls_peticiones_procedencia_id", ccsInteger, "", "", $this->Parameters["urls_peticiones_procedencia_id"], "", false);
        $this->wp->AddParameter("3", "urls_peticiones_estado_id", ccsInteger, "", "", $this->Parameters["urls_peticiones_estado_id"], "", false);
        $this->wp->AddParameter("4", "urls_fecha", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombres", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "peticiones.procedencia_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "peticiones.estado_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "fecha", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]), 
             $this->wp->Criterion[4]);
    }
//End Prepare Method

//Open Method @2-A7C1EDBE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((peticiones LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id";
        $this->SQL = "SELECT peticion_id, peticiones.paciente_id AS peticiones_paciente_id, peticiones.procedencia_id AS peticiones_procedencia_id, peticiones.estado_id AS peticiones_estado_id,\n\n" .
        "fecha, hora, observaciones, pacientes.paciente_id AS pacientes_paciente_id, rut, ficha, nombres, apellidos, procedencias.procedencia_id AS procedencias_procedencia_id,\n\n" .
        "nom_procedencia, estados.estado_id AS estados_estado_id, nom_estado \n\n" .
        "FROM ((peticiones LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-695E1A83
    function SetValues()
    {
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
        $this->rut->SetDBValue($this->f("rut"));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->hora->SetDBValue(trim($this->f("hora")));
        $this->observaciones->SetDBValue($this->f("observaciones"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->Alt_nom_estado->SetDBValue($this->f("nom_estado"));
        $this->Alt_rut->SetDBValue($this->f("rut"));
        $this->Alt_ficha->SetDBValue($this->f("ficha"));
        $this->Alt_nombres->SetDBValue($this->f("nombres"));
        $this->Alt_apellidos->SetDBValue($this->f("apellidos"));
        $this->Alt_peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->Alt_fecha->SetDBValue(trim($this->f("fecha")));
        $this->Alt_hora->SetDBValue(trim($this->f("hora")));
        $this->Alt_observaciones->SetDBValue($this->f("observaciones"));
        $this->Alt_nom_procedencia->SetDBValue($this->f("nom_procedencia"));
    }
//End SetValues Method

} //End peticiones_pacientes_procDataSource Class @2-FCB6E20C

//Initialize Page @1-D3EAE8A9
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
$TemplateFileName = "peticiones.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-101BF1B1
include_once("./peticiones_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D2631BF5
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_pacientes_procSearch = new clsRecordpeticiones_pacientes_procSearch("", $MainPage);
$peticiones_pacientes_proc = new clsGridpeticiones_pacientes_proc("", $MainPage);
$MainPage->peticiones_pacientes_procSearch = & $peticiones_pacientes_procSearch;
$MainPage->peticiones_pacientes_proc = & $peticiones_pacientes_proc;
$peticiones_pacientes_proc->Initialize();
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

//Execute Components @1-FA92F0D7
$peticiones_pacientes_procSearch->Operation();
//End Execute Components

//Go to destination page @1-E7C75649
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_pacientes_procSearch);
    unset($peticiones_pacientes_proc);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-CF45CF67
$peticiones_pacientes_procSearch->Show();
$peticiones_pacientes_proc->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-6B3F9121
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_pacientes_procSearch);
unset($peticiones_pacientes_proc);
unset($Tpl);
//End Unload Page


?>
