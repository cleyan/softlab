<?php
//Include Common Files @1-C487EBF2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "list_informes.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

//Include Page implementation @71-548A6019
include_once(RelativePath . "/avisos.php");
//End Include Page implementation

class clsRecordinforme_datosSearch { //informe_datosSearch Class @3-EBBF47A2

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

//Class_Initialize Event @3-0D0E59E0
    function clsRecordinforme_datosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record informe_datosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "informe_datosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_peticion_id = new clsControl(ccsTextBox, "s_peticion_id", "s_peticion_id", ccsInteger, "", CCGetRequestParam("s_peticion_id", $Method, NULL), $this);
            $this->s_paciente = new clsControl(ccsTextBox, "s_paciente", "s_paciente", ccsText, "", CCGetRequestParam("s_paciente", $Method, NULL), $this);
            $this->s_fecha_ini = new clsControl(ccsTextBox, "s_fecha_ini", "Fecha Inicial", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_ini", $Method, NULL), $this);
            $this->s_fecha_ini->Required = true;
            $this->s_fecha_fin = new clsControl(ccsTextBox, "s_fecha_fin", "Fecha Final", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("s_fecha_fin", $Method, NULL), $this);
            $this->s_fecha_fin->Required = true;
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
            $this->Panel1 = new clsPanel("Panel1", $this);
            $this->filtra = new clsControl(ccsCheckBox, "filtra", "filtra", ccsInteger, "", CCGetRequestParam("filtra", $Method, NULL), $this);
            $this->filtra->CheckedValue = $this->filtra->GetParsedValue(1);
            $this->filtra->UncheckedValue = $this->filtra->GetParsedValue(0);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->Panel1->AddComponent("filtra", $this->filtra);
            if(!$this->FormSubmitted) {
                if(!is_array($this->s_fecha_ini->Value) && !strlen($this->s_fecha_ini->Value) && $this->s_fecha_ini->Value !== false)
                    $this->s_fecha_ini->SetValue(time());
                if(!is_array($this->s_fecha_fin->Value) && !strlen($this->s_fecha_fin->Value) && $this->s_fecha_fin->Value !== false)
                    $this->s_fecha_fin->SetValue(time());
                if(!is_array($this->filtra->Value) && !strlen($this->filtra->Value) && $this->filtra->Value !== false)
                    $this->filtra->SetValue(false);
            }
        }
    }
//End Class_Initialize Event

//Validate Method @3-DA79FAAE
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $Validation = ($this->s_paciente->Validate() && $Validation);
        $Validation = ($this->s_fecha_ini->Validate() && $Validation);
        $Validation = ($this->s_fecha_fin->Validate() && $Validation);
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $Validation = ($this->filtra->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_paciente->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_ini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_fin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->filtra->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-974EB732
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->s_paciente->Errors->Count());
        $errors = ($errors || $this->s_fecha_ini->Errors->Count());
        $errors = ($errors || $this->s_fecha_fin->Errors->Count());
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->filtra->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @3-81FB7C83
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
        $Redirect = "list_informes.php" . "?" . CCGetQueryString("All", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "list_informes.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_peticion_id", "s_paciente", "s_fecha_ini", "s_fecha_fin", "s_procedencia_id", "filtra", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-287F171D
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

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_paciente->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_ini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_fin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->filtra->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        if($this->FormSubmitted || CCGetFromGet("ccsForm")) {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        } else {
            $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("All", ""), "ccsForm", $CCSForm);
        }
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
        $this->s_paciente->Show();
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->s_procedencia_id->Show();
        $this->Panel1->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End informe_datosSearch Class @3-FCB6E20C

class clsGridinforme_datos { //informe_datos class @2-5AF9B16F

//Variables @2-A71CD2D0

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
//End Variables

//Class_Initialize Event @2-C905C9B7
    function clsGridinforme_datos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "informe_datos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid informe_datos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinforme_datosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->SorterName = CCGetParam("informe_datosOrder", "");
        $this->SorterDirection = CCGetParam("informe_datosDir", "");

        $this->lnkInforme = new clsControl(ccsImageLink, "lnkInforme", "lnkInforme", ccsText, "", CCGetRequestParam("lnkInforme", ccsGet, NULL), $this);
        $this->lnkInforme->Page = "list_informes.php";
        $this->peticion_id = new clsControl(ccsLink, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->peticion_id->Page = "list_informes.php";
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->Sorter_peticion_id = new clsSorter($this->ComponentName, "Sorter_peticion_id", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-4CFA898E
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_fecha_ini"] = CCGetFromGet("s_fecha_ini", NULL);
        $this->DataSource->Parameters["urls_fecha_fin"] = CCGetFromGet("s_fecha_fin", NULL);
        $this->DataSource->Parameters["urls_procedencia_id"] = CCGetFromGet("s_procedencia_id", NULL);
        $this->DataSource->Parameters["expr85"] = CCGetGroupID();
        $this->DataSource->Parameters["expr86"] = GetUserProcedenciaID();

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
            $this->ControlsVisible["lnkInforme"] = $this->lnkInforme->Visible;
            $this->ControlsVisible["peticion_id"] = $this->peticion_id->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->lnkInforme->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->lnkInforme->Parameters = CCAddParam($this->lnkInforme->Parameters, "peticion_id", $this->DataSource->f("peticion_id"));
                $this->lnkInforme->Parameters = CCAddParam($this->lnkInforme->Parameters, "s_nombres", $this->DataSource->f("nombres"));
                $this->lnkInforme->Parameters = CCAddParam($this->lnkInforme->Parameters, "s_apellidos", $this->DataSource->f("apellidos"));
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                $this->peticion_id->Parameters = CCGetQueryString("QueryString", array("aviso", "ccsForm"));
                $this->peticion_id->Parameters = CCAddParam($this->peticion_id->Parameters, "peticion_id", $this->DataSource->f("peticion_id"));
                $this->peticion_id->Parameters = CCAddParam($this->peticion_id->Parameters, "s_apellidos", $this->DataSource->f("apellidos"));
                $this->peticion_id->Parameters = CCAddParam($this->peticion_id->Parameters, "s_nombres", $this->DataSource->f("nombres"));
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lnkInforme->Show();
                $this->peticion_id->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->fecha->Show();
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
        $this->Sorter_peticion_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-910A2A13
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lnkInforme->Errors->ToString());
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End informe_datos Class @2-FCB6E20C

class clsinforme_datosDataSource extends clsDBDatos {  //informe_datosDataSource Class @2-4EAE0447

//DataSource Variables @2-0783CFFD
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $peticion_id;
    public $nombres;
    public $apellidos;
    public $fecha;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-875FFC37
    function clsinforme_datosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid informe_datos";
        $this->Initialize();
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-84566BB8
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "informe_datos.peticion_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_peticion_id" => array("peticion_id", "")));
    }
//End SetOrder Method

//Prepare Method @2-E57226B6
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_fecha_ini", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("yyyy", "/", "mm", "/", "dd", " "), $this->Parameters["urls_fecha_ini"], time(), false);
        $this->wp->AddParameter("2", "urls_fecha_fin", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("yyyy", "/", "mm", "/", "dd"), $this->Parameters["urls_fecha_fin"], time(), false);
        $this->wp->AddParameter("3", "urls_procedencia_id", ccsText, "", "", $this->Parameters["urls_procedencia_id"], 0, false);
        $this->wp->AddParameter("4", "expr85", ccsText, "", "", $this->Parameters["expr85"], "", false);
        $this->wp->AddParameter("5", "expr86", ccsText, "", "", $this->Parameters["expr86"], "", false);
    }
//End Prepare Method

//Open Method @2-EC69B5F6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM informe_datos LEFT OUTER JOIN pacientes ON (informe_datos.paciente_id = pacientes.paciente_id) \n" .
        "WHERE \n" .
        "(informe_datos.fecha BETWEEN '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsDate) . "' AND '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsDate) . "') \n" .
        "AND \n" .
        "(informe_datos.procedencia_id=" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " or '0'='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "')\n" .
        "AND\n" .
        "(informe_datos.procedencia_id=" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . " OR " . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . " > 4)";
        $this->SQL = "SELECT DISTINCT informe_datos.peticion_id, informe_datos.nom_procedencia, pacientes.nombres, pacientes.apellidos , informe_datos.fecha, informe_datos.nom_procedencia FROM informe_datos LEFT OUTER JOIN pacientes ON (informe_datos.paciente_id = pacientes.paciente_id) \n" .
        "WHERE \n" .
        "(informe_datos.fecha BETWEEN '" . $this->SQLValue($this->wp->GetDBValue("1"), ccsDate) . "' AND '" . $this->SQLValue($this->wp->GetDBValue("2"), ccsDate) . "') \n" .
        "AND \n" .
        "(informe_datos.procedencia_id=" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . " or '0'='" . $this->SQLValue($this->wp->GetDBValue("3"), ccsText) . "')\n" .
        "AND\n" .
        "(informe_datos.procedencia_id=" . $this->SQLValue($this->wp->GetDBValue("5"), ccsText) . " OR " . $this->SQLValue($this->wp->GetDBValue("4"), ccsText) . " > 4) {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-54101B4D
    function SetValues()
    {
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
    }
//End SetValues Method

} //End informe_datosDataSource Class @2-FCB6E20C

//Include Page implementation @60-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

class clsGridinforme_datos2 { //informe_datos2 class @112-E939360D

//Variables @112-6E51DF5A

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
//End Variables

//Class_Initialize Event @112-473181BC
    function clsGridinforme_datos2($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "informe_datos2";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid informe_datos2";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinforme_datos2DataSource($this);
        $this->ds = & $this->DataSource;

        $this->lbl_icono = new clsControl(ccsLabel, "lbl_icono", "lbl_icono", ccsText, "", CCGetRequestParam("lbl_icono", ccsGet, NULL), $this);
        $this->lbl_icono->HTML = true;
        $this->lbl_chk = new clsControl(ccsLabel, "lbl_chk", "lbl_chk", ccsText, "", CCGetRequestParam("lbl_chk", ccsGet, NULL), $this);
        $this->lbl_chk->HTML = true;
        $this->nom_informe = new clsControl(ccsLabel, "nom_informe", "nom_informe", ccsText, "", CCGetRequestParam("nom_informe", ccsGet, NULL), $this);
        $this->serie = new clsControl(ccsHidden, "serie", "serie", ccsText, "", CCGetRequestParam("serie", ccsGet, NULL), $this);
        $this->informe_id = new clsControl(ccsHidden, "informe_id", "informe_id", ccsInteger, "", CCGetRequestParam("informe_id", ccsGet, NULL), $this);
        $this->firma_nombre = new clsControl(ccsLabel, "firma_nombre", "firma_nombre", ccsText, "", CCGetRequestParam("firma_nombre", ccsGet, NULL), $this);
        $this->fecha_firma = new clsControl(ccsLabel, "fecha_firma", "fecha_firma", ccsText, "", CCGetRequestParam("fecha_firma", ccsGet, NULL), $this);
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->s_nombres = new clsControl(ccsLabel, "s_nombres", "s_nombres", ccsText, "", CCGetRequestParam("s_nombres", ccsGet, NULL), $this);
        $this->s_apellidos = new clsControl(ccsLabel, "s_apellidos", "s_apellidos", ccsText, "", CCGetRequestParam("s_apellidos", ccsGet, NULL), $this);
        $this->s_fecha_ini = new clsControl(ccsHidden, "s_fecha_ini", "s_fecha_ini", ccsText, "", CCGetRequestParam("s_fecha_ini", ccsGet, NULL), $this);
        $this->s_fecha_fin = new clsControl(ccsHidden, "s_fecha_fin", "s_fecha_fin", ccsText, "", CCGetRequestParam("s_fecha_fin", ccsGet, NULL), $this);
        $this->s_paciente = new clsControl(ccsHidden, "s_paciente", "s_paciente", ccsText, "", CCGetRequestParam("s_paciente", ccsGet, NULL), $this);
        $this->s_peticion_id = new clsControl(ccsHidden, "s_peticion_id", "s_peticion_id", ccsText, "", CCGetRequestParam("s_peticion_id", ccsGet, NULL), $this);
        $this->x_peticion_id = new clsControl(ccsHidden, "x_peticion_id", "x_peticion_id", ccsText, "", CCGetRequestParam("x_peticion_id", ccsGet, NULL), $this);
        $this->nom_paciente = new clsControl(ccsHidden, "nom_paciente", "nom_paciente", ccsText, "", CCGetRequestParam("nom_paciente", ccsGet, NULL), $this);
        $this->Imprimir = new clsButton("Imprimir", ccsGet, $this);
    }
//End Class_Initialize Event

//Initialize Method @112-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @112-17CC7F2D
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);

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
            $this->ControlsVisible["lbl_icono"] = $this->lbl_icono->Visible;
            $this->ControlsVisible["lbl_chk"] = $this->lbl_chk->Visible;
            $this->ControlsVisible["nom_informe"] = $this->nom_informe->Visible;
            $this->ControlsVisible["serie"] = $this->serie->Visible;
            $this->ControlsVisible["informe_id"] = $this->informe_id->Visible;
            $this->ControlsVisible["firma_nombre"] = $this->firma_nombre->Visible;
            $this->ControlsVisible["fecha_firma"] = $this->fecha_firma->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->nom_informe->SetValue($this->DataSource->nom_informe->GetValue());
                $this->serie->SetValue($this->DataSource->serie->GetValue());
                $this->informe_id->SetValue($this->DataSource->informe_id->GetValue());
                $this->fecha_firma->SetValue($this->DataSource->fecha_firma->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lbl_icono->Show();
                $this->lbl_chk->Show();
                $this->nom_informe->Show();
                $this->serie->Show();
                $this->informe_id->Show();
                $this->firma_nombre->Show();
                $this->fecha_firma->Show();
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
        $this->x_peticion_id->SetText(CCGetParam("peticion_id",""));
        $this->nom_paciente->SetText(CCGetParam("s_nombres","") . " " . CCGetParam("s_apellidos",""));
        $this->peticion_id->Show();
        $this->s_nombres->Show();
        $this->s_apellidos->Show();
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->s_paciente->Show();
        $this->s_peticion_id->Show();
        $this->x_peticion_id->Show();
        $this->nom_paciente->Show();
        $this->Imprimir->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @112-877FB2BC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lbl_icono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_chk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_informe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->serie->Errors->ToString());
        $errors = ComposeStrings($errors, $this->informe_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->firma_nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_firma->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End informe_datos2 Class @112-FCB6E20C

class clsinforme_datos2DataSource extends clsDBDatos {  //informe_datos2DataSource Class @112-10CA46CC

//DataSource Variables @112-36A163D2
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $x_peticion_id;
    public $nom_paciente;
    public $nom_informe;
    public $serie;
    public $informe_id;
    public $fecha_firma;
//End DataSource Variables

//DataSourceClass_Initialize Event @112-D5C01F29
    function clsinforme_datos2DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid informe_datos2";
        $this->Initialize();
        $this->x_peticion_id = new clsField("x_peticion_id", ccsText, "");
        
        $this->nom_paciente = new clsField("nom_paciente", ccsText, "");
        
        $this->nom_informe = new clsField("nom_informe", ccsText, "");
        
        $this->serie = new clsField("serie", ccsText, "");
        
        $this->informe_id = new clsField("informe_id", ccsInteger, "");
        
        $this->fecha_firma = new clsField("fecha_firma", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @112-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @112-22B7FB8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
    }
//End Prepare Method

//Open Method @112-C9F1FE51
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM informe_datos\n" .
        "WHERE peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "GROUP BY informe_id, nom_informe";
        $this->SQL = "SELECT DISTINCT \n" .
        "MAX(serie) as serie,\n" .
        "informe_id, \n" .
        "nom_informe\n" .
        "FROM informe_datos\n" .
        "WHERE peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "GROUP BY informe_id, nom_informe";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @112-4449BBD5
    function SetValues()
    {
        $this->nom_informe->SetDBValue($this->f("nom_informe"));
        $this->serie->SetDBValue($this->f("serie"));
        $this->informe_id->SetDBValue(trim($this->f("informe_id")));
        $this->fecha_firma->SetDBValue($this->f("serie"));
    }
//End SetValues Method

} //End informe_datos2DataSource Class @112-FCB6E20C

class clsGridinforme_datos1 { //informe_datos1 class @34-C21465CE

//Variables @34-6E51DF5A

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
//End Variables

//Class_Initialize Event @34-82DCE99F
    function clsGridinforme_datos1($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "informe_datos1";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid informe_datos1";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsinforme_datos1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = 20;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->lbl_icono = new clsControl(ccsLabel, "lbl_icono", "lbl_icono", ccsText, "", CCGetRequestParam("lbl_icono", ccsGet, NULL), $this);
        $this->lbl_icono->HTML = true;
        $this->lbl_chk = new clsControl(ccsLabel, "lbl_chk", "lbl_chk", ccsText, "", CCGetRequestParam("lbl_chk", ccsGet, NULL), $this);
        $this->lbl_chk->HTML = true;
        $this->nom_informe = new clsControl(ccsLabel, "nom_informe", "nom_informe", ccsText, "", CCGetRequestParam("nom_informe", ccsGet, NULL), $this);
        $this->serie = new clsControl(ccsHidden, "serie", "serie", ccsText, "", CCGetRequestParam("serie", ccsGet, NULL), $this);
        $this->informe_id = new clsControl(ccsHidden, "informe_id", "informe_id", ccsInteger, "", CCGetRequestParam("informe_id", ccsGet, NULL), $this);
        $this->firma_nombre = new clsControl(ccsLabel, "firma_nombre", "firma_nombre", ccsText, "", CCGetRequestParam("firma_nombre", ccsGet, NULL), $this);
        $this->fecha_firma = new clsControl(ccsLabel, "fecha_firma", "fecha_firma", ccsText, "", CCGetRequestParam("fecha_firma", ccsGet, NULL), $this);
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->s_nombres = new clsControl(ccsLabel, "s_nombres", "s_nombres", ccsText, "", CCGetRequestParam("s_nombres", ccsGet, NULL), $this);
        $this->s_apellidos = new clsControl(ccsLabel, "s_apellidos", "s_apellidos", ccsText, "", CCGetRequestParam("s_apellidos", ccsGet, NULL), $this);
        $this->s_fecha_ini = new clsControl(ccsHidden, "s_fecha_ini", "s_fecha_ini", ccsText, "", CCGetRequestParam("s_fecha_ini", ccsGet, NULL), $this);
        $this->s_fecha_fin = new clsControl(ccsHidden, "s_fecha_fin", "s_fecha_fin", ccsText, "", CCGetRequestParam("s_fecha_fin", ccsGet, NULL), $this);
        $this->s_paciente = new clsControl(ccsHidden, "s_paciente", "s_paciente", ccsText, "", CCGetRequestParam("s_paciente", ccsGet, NULL), $this);
        $this->s_peticion_id = new clsControl(ccsHidden, "s_peticion_id", "s_peticion_id", ccsText, "", CCGetRequestParam("s_peticion_id", ccsGet, NULL), $this);
        $this->x_peticion_id = new clsControl(ccsHidden, "x_peticion_id", "x_peticion_id", ccsText, "", CCGetRequestParam("x_peticion_id", ccsGet, NULL), $this);
        $this->nom_paciente = new clsControl(ccsHidden, "nom_paciente", "nom_paciente", ccsText, "", CCGetRequestParam("nom_paciente", ccsGet, NULL), $this);
        $this->Imprimir = new clsButton("Imprimir", ccsGet, $this);
    }
//End Class_Initialize Event

//Initialize Method @34-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @34-E48C8064
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);

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
            $this->ControlsVisible["lbl_icono"] = $this->lbl_icono->Visible;
            $this->ControlsVisible["lbl_chk"] = $this->lbl_chk->Visible;
            $this->ControlsVisible["nom_informe"] = $this->nom_informe->Visible;
            $this->ControlsVisible["serie"] = $this->serie->Visible;
            $this->ControlsVisible["informe_id"] = $this->informe_id->Visible;
            $this->ControlsVisible["firma_nombre"] = $this->firma_nombre->Visible;
            $this->ControlsVisible["fecha_firma"] = $this->fecha_firma->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->nom_informe->SetValue($this->DataSource->nom_informe->GetValue());
                $this->serie->SetValue($this->DataSource->serie->GetValue());
                $this->informe_id->SetValue($this->DataSource->informe_id->GetValue());
                $this->fecha_firma->SetValue($this->DataSource->fecha_firma->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->lbl_icono->Show();
                $this->lbl_chk->Show();
                $this->nom_informe->Show();
                $this->serie->Show();
                $this->informe_id->Show();
                $this->firma_nombre->Show();
                $this->fecha_firma->Show();
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
        $this->x_peticion_id->SetText(CCGetParam("peticion_id",""));
        $this->nom_paciente->SetText(CCGetParam("s_nombres","") . " " . CCGetParam("s_apellidos",""));
        $this->peticion_id->Show();
        $this->s_nombres->Show();
        $this->s_apellidos->Show();
        $this->s_fecha_ini->Show();
        $this->s_fecha_fin->Show();
        $this->s_paciente->Show();
        $this->s_peticion_id->Show();
        $this->x_peticion_id->Show();
        $this->nom_paciente->Show();
        $this->Imprimir->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @34-877FB2BC
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->lbl_icono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lbl_chk->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_informe->Errors->ToString());
        $errors = ComposeStrings($errors, $this->serie->Errors->ToString());
        $errors = ComposeStrings($errors, $this->informe_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->firma_nombre->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_firma->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End informe_datos1 Class @34-FCB6E20C

class clsinforme_datos1DataSource extends clsDBDatos {  //informe_datos1DataSource Class @34-B5C22DA0

//DataSource Variables @34-36A163D2
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $x_peticion_id;
    public $nom_paciente;
    public $nom_informe;
    public $serie;
    public $informe_id;
    public $fecha_firma;
//End DataSource Variables

//DataSourceClass_Initialize Event @34-7EFCCC73
    function clsinforme_datos1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid informe_datos1";
        $this->Initialize();
        $this->x_peticion_id = new clsField("x_peticion_id", ccsText, "");
        
        $this->nom_paciente = new clsField("nom_paciente", ccsText, "");
        
        $this->nom_informe = new clsField("nom_informe", ccsText, "");
        
        $this->serie = new clsField("serie", ccsText, "");
        
        $this->informe_id = new clsField("informe_id", ccsInteger, "");
        
        $this->fecha_firma = new clsField("fecha_firma", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @34-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @34-22B7FB8C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
    }
//End Prepare Method

//Open Method @34-C9F1FE51
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*) FROM informe_datos\n" .
        "WHERE peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "GROUP BY informe_id, nom_informe";
        $this->SQL = "SELECT DISTINCT \n" .
        "MAX(serie) as serie,\n" .
        "informe_id, \n" .
        "nom_informe\n" .
        "FROM informe_datos\n" .
        "WHERE peticion_id = " . $this->SQLValue($this->wp->GetDBValue("1"), ccsInteger) . "\n" .
        "GROUP BY informe_id, nom_informe";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @34-4449BBD5
    function SetValues()
    {
        $this->nom_informe->SetDBValue($this->f("nom_informe"));
        $this->serie->SetDBValue($this->f("serie"));
        $this->informe_id->SetDBValue(trim($this->f("informe_id")));
        $this->fecha_firma->SetDBValue($this->f("serie"));
    }
//End SetValues Method

} //End informe_datos1DataSource Class @34-FCB6E20C



//Initialize Page @1-0513D01B
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
$TemplateFileName = "list_informes.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|js/jquery/updatepanel/ccs-update-panel.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-F118CE33
CCSecurityRedirect("4;5;12;13;14;15;16;17;18;19;20", "login.php");
//End Authenticate User

//Include events file @1-FB041355
include_once("./list_informes_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-143D65CE
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$avisos = new clsavisos("", "avisos", $MainPage);
$avisos->Initialize();
$informe_datosSearch = new clsRecordinforme_datosSearch("", $MainPage);
$informe_datos = new clsGridinforme_datos("", $MainPage);
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$Panel1 = new clsPanel("Panel1", $MainPage);
$Panel1->GenerateDiv = true;
$Panel1->PanelId = "Panel1";
$informe_datos2 = new clsGridinforme_datos2("", $MainPage);
$informe_datos1 = new clsGridinforme_datos1("", $MainPage);
$MainPage->avisos = & $avisos;
$MainPage->informe_datosSearch = & $informe_datosSearch;
$MainPage->informe_datos = & $informe_datos;
$MainPage->calendar_tag = & $calendar_tag;
$MainPage->Panel1 = & $Panel1;
$MainPage->informe_datos2 = & $informe_datos2;
$MainPage->informe_datos1 = & $informe_datos1;
$Panel1->AddComponent("informe_datos2", $informe_datos2);
$informe_datos->Initialize();
$informe_datos2->Initialize();
$informe_datos1->Initialize();
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

//Execute Components @1-BC78D828
$calendar_tag->Operations();
$informe_datosSearch->Operation();
$avisos->Operations();
//End Execute Components

//Go to destination page @1-89AA239E
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    $avisos->Class_Terminate();
    unset($avisos);
    unset($informe_datosSearch);
    unset($informe_datos);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($informe_datos2);
    unset($informe_datos1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-35B3AE5D
$avisos->Show();
$informe_datosSearch->Show();
$informe_datos->Show();
$calendar_tag->Show();
$informe_datos1->Show();
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BDAE84DC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
$avisos->Class_Terminate();
unset($avisos);
unset($informe_datosSearch);
unset($informe_datos);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($informe_datos2);
unset($informe_datos1);
unset($Tpl);
//End Unload Page


?>
