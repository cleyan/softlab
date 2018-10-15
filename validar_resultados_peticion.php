<?php
//Include Common Files @1-27C6A824
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "validar_resultados_peticion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_pacientesSearch { //peticiones_pacientesSearch Class @18-E4A6CB0E

//Variables @18-9E315808

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

//Class_Initialize Event @18-E029111C
    function clsRecordpeticiones_pacientesSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_pacientesSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_pacientesSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_peticion_id = new clsControl(ccsTextBox, "s_peticion_id", "Número de Petición", ccsInteger, "", CCGetRequestParam("s_peticion_id", $Method, NULL), $this);
            $this->s_peticion_id->Required = true;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @18-36516E36
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @18-D9227DAE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @18-3565334B
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
        $Redirect = "validar_resultados_peticion.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "validar_resultados_peticion.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @18-D42CD5DB
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
            $Error = ComposeStrings($Error, $this->s_peticion_id->Errors->ToString());
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
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_pacientesSearch Class @18-FCB6E20C

class clsGridpeticiones_pacientes { //peticiones_pacientes class @2-05E0602C

//Variables @2-6E51DF5A

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

//Class_Initialize Event @2-7C919F85
    function clsGridpeticiones_pacientes($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_pacientes";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_pacientes";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_pacientesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 100;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<BR>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->paciente_id = new clsControl(ccsHidden, "paciente_id", "paciente_id", ccsInteger, "", CCGetRequestParam("paciente_id", ccsGet, NULL), $this);
        $this->Hora = new clsControl(ccsLabel, "Hora", "Hora", ccsDate, array("H", ":", "nn"), CCGetRequestParam("Hora", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->fecha_nacimiento = new clsControl(ccsLabel, "fecha_nacimiento", "fecha_nacimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha_nacimiento", ccsGet, NULL), $this);
        $this->Edad = new clsControl(ccsLabel, "Edad", "Edad", ccsText, "", CCGetRequestParam("Edad", ccsGet, NULL), $this);
        $this->Edad->HTML = true;
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

//Show Method @2-F1BA0BAB
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_peticion_id"] = CCGetFromGet("s_peticion_id", NULL);

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
            $this->ControlsVisible["peticion_id"] = $this->peticion_id->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["paciente_id"] = $this->paciente_id->Visible;
            $this->ControlsVisible["Hora"] = $this->Hora->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["fecha_nacimiento"] = $this->fecha_nacimiento->Visible;
            $this->ControlsVisible["Edad"] = $this->Edad->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->paciente_id->SetValue($this->DataSource->paciente_id->GetValue());
                $this->Hora->SetValue($this->DataSource->Hora->GetValue());
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->fecha_nacimiento->SetValue($this->DataSource->fecha_nacimiento->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->peticion_id->Show();
                $this->fecha->Show();
                $this->paciente_id->Show();
                $this->Hora->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->fecha_nacimiento->Show();
                $this->Edad->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-6006A0D4
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->paciente_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Hora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_nacimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Edad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_pacientes Class @2-FCB6E20C

class clspeticiones_pacientesDataSource extends clsDBDatos {  //peticiones_pacientesDataSource Class @2-10690C9F

//DataSource Variables @2-4D331293
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
    public $paciente_id;
    public $Hora;
    public $nombres;
    public $apellidos;
    public $fecha_nacimiento;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-468CA4CF
    function clspeticiones_pacientesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_pacientes";
        $this->Initialize();
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->paciente_id = new clsField("paciente_id", ccsInteger, "");
        
        $this->Hora = new clsField("Hora", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->fecha_nacimiento = new clsField("fecha_nacimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @2-CD784E4E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_peticion_id", ccsInteger, "", "", $this->Parameters["urls_peticion_id"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-D07F4594
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM peticiones INNER JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id";
        $this->SQL = "SELECT peticion_id, peticiones.paciente_id AS peticiones_paciente_id, fecha, hora, nombres, apellidos, fecha_nacimiento \n\n" .
        "FROM peticiones INNER JOIN pacientes ON\n\n" .
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

//SetValues Method @2-116D5697
    function SetValues()
    {
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->paciente_id->SetDBValue(trim($this->f("peticiones_paciente_id")));
        $this->Hora->SetDBValue(trim($this->f("hora")));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->fecha_nacimiento->SetDBValue(trim($this->f("fecha_nacimiento")));
    }
//End SetValues Method

} //End peticiones_pacientesDataSource Class @2-FCB6E20C

class clsRecordtest_resultados_estadosSearch { //test_resultados_estadosSearch Class @71-192050D9

//Variables @71-9E315808

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

//Class_Initialize Event @71-6B5719F8
    function clsRecordtest_resultados_estadosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record test_resultados_estadosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "test_resultados_estadosSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_peticion_id = new clsControl(ccsHidden, "s_peticion_id", "Número de Petición", ccsInteger, "", CCGetRequestParam("s_peticion_id", $Method, NULL), $this);
            $this->s_peticion_id->Required = true;
            $this->s_secciones_id = new clsControl(ccsListBox, "s_secciones_id", "s_secciones_id", ccsInteger, "", CCGetRequestParam("s_secciones_id", $Method, NULL), $this);
            $this->s_secciones_id->DSType = dsSQL;
            $this->s_secciones_id->DataSource = new clsDBDatos();
            $this->s_secciones_id->ds = & $this->s_secciones_id->DataSource;
            list($this->s_secciones_id->BoundColumn, $this->s_secciones_id->TextColumn, $this->s_secciones_id->DBFormat) = array("secciones_id", "nom_seccion", "");
            $this->s_secciones_id->DataSource->Parameters["urls_peticion_id"] = CCGetFromGet("s_peticion_id", NULL);
            $this->s_secciones_id->DataSource->wp = new clsSQLParameters();
            $this->s_secciones_id->DataSource->wp->AddParameter("1", "urls_peticion_id", ccsInteger, "", "", $this->s_secciones_id->DataSource->Parameters["urls_peticion_id"], 0, false);
            $this->s_secciones_id->DataSource->SQL = "SELECT DISTINCT \n" .
            "  secciones.nom_seccion,\n" .
            "  test.secciones_id\n" .
            "FROM\n" .
            "  peticiones_detalle\n" .
            "  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)\n" .
            "  INNER JOIN secciones ON (test.secciones_id = secciones.seccion_id)\n" .
            "WHERE\n" .
            "  (peticiones_detalle.peticion_id = " . $this->s_secciones_id->DataSource->SQLValue($this->s_secciones_id->DataSource->wp->GetDBValue("1"), ccsInteger) . ") {SQL_OrderBy}";
            $this->s_secciones_id->DataSource->Order = "nom_seccion";
            $this->s_equipo_id = new clsControl(ccsListBox, "s_equipo_id", "s_equipo_id", ccsInteger, "", CCGetRequestParam("s_equipo_id", $Method, NULL), $this);
            $this->s_equipo_id->DSType = dsSQL;
            $this->s_equipo_id->DataSource = new clsDBDatos();
            $this->s_equipo_id->ds = & $this->s_equipo_id->DataSource;
            list($this->s_equipo_id->BoundColumn, $this->s_equipo_id->TextColumn, $this->s_equipo_id->DBFormat) = array("equipo_id", "nom_equipo", "");
            $this->s_equipo_id->DataSource->Parameters["urls_peticion_id"] = CCGetFromGet("s_peticion_id", NULL);
            $this->s_equipo_id->DataSource->wp = new clsSQLParameters();
            $this->s_equipo_id->DataSource->wp->AddParameter("1", "urls_peticion_id", ccsInteger, "", "", $this->s_equipo_id->DataSource->Parameters["urls_peticion_id"], 0, false);
            $this->s_equipo_id->DataSource->SQL = "SELECT DISTINCT \n" .
            "  equipos.nom_equipo,\n" .
            "  test.equipo_id\n" .
            "FROM\n" .
            "  peticiones_detalle\n" .
            "  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)\n" .
            "  INNER JOIN equipos ON (test.equipo_id = equipos.equipo_id)\n" .
            "WHERE\n" .
            "  (peticiones_detalle.peticion_id = " . $this->s_equipo_id->DataSource->SQLValue($this->s_equipo_id->DataSource->wp->GetDBValue("1"), ccsInteger) . ") {SQL_OrderBy}";
            $this->s_equipo_id->DataSource->Order = "nom_equipo";
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Validate Method @71-DA7C3325
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $Validation = ($this->s_secciones_id->Validate() && $Validation);
        $Validation = ($this->s_equipo_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_secciones_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_equipo_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @71-58DC526F
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->s_secciones_id->Errors->Count());
        $errors = ($errors || $this->s_equipo_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @71-3565334B
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
        $Redirect = "validar_resultados_peticion.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "validar_resultados_peticion.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @71-9DE922DA
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

        $this->s_secciones_id->Prepare();
        $this->s_equipo_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_secciones_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_equipo_id->Errors->ToString());
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
        $this->s_secciones_id->Show();
        $this->s_equipo_id->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End test_resultados_estadosSearch Class @71-FCB6E20C

class clsGridtest_resultados_estados { //test_resultados_estados class @22-A5A1D422

//Variables @22-6E51DF5A

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

//Class_Initialize Event @22-B5766C81
    function clsGridtest_resultados_estados($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "test_resultados_estados";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid test_resultados_estados";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstest_resultados_estadosDataSource($this);
        $this->ds = & $this->DataSource;

        $this->marcador = new clsControl(ccsLabel, "marcador", "marcador", ccsInteger, "", CCGetRequestParam("marcador", ccsGet, NULL), $this);
        $this->marcador->HTML = true;
        $this->lblDeCompuesto = new clsControl(ccsLabel, "lblDeCompuesto", "lblDeCompuesto", ccsText, "", CCGetRequestParam("lblDeCompuesto", ccsGet, NULL), $this);
        $this->lblDeCompuesto->HTML = true;
        $this->cod_test = new clsControl(ccsLabel, "cod_test", "cod_test", ccsText, "", CCGetRequestParam("cod_test", ccsGet, NULL), $this);
        $this->valor = new clsControl(ccsLabel, "valor", "valor", ccsMemo, "", CCGetRequestParam("valor", ccsGet, NULL), $this);
        $this->unidad_medida = new clsControl(ccsLabel, "unidad_medida", "unidad_medida", ccsText, "", CCGetRequestParam("unidad_medida", ccsGet, NULL), $this);
        $this->repetido = new clsControl(ccsLabel, "repetido", "repetido", ccsText, "", CCGetRequestParam("repetido", ccsGet, NULL), $this);
        $this->lnkHistoria = new clsControl(ccsLink, "lnkHistoria", "lnkHistoria", ccsText, "", CCGetRequestParam("lnkHistoria", ccsGet, NULL), $this);
        $this->lnkHistoria->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->lnkHistoria->Page = "";
        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "nom_estado", ccsText, "", CCGetRequestParam("nom_estado", ccsGet, NULL), $this);
        $this->s_peticion_id = new clsControl(ccsHidden, "s_peticion_id", "s_peticion_id", ccsInteger, "", CCGetRequestParam("s_peticion_id", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @22-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @22-17C9C8F4
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_peticion_id"] = CCGetFromGet("s_peticion_id", NULL);
        $this->DataSource->Parameters["urls_secciones_id"] = CCGetFromGet("s_secciones_id", NULL);
        $this->DataSource->Parameters["urls_equipo_id"] = CCGetFromGet("s_equipo_id", NULL);

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
            $this->ControlsVisible["marcador"] = $this->marcador->Visible;
            $this->ControlsVisible["lblDeCompuesto"] = $this->lblDeCompuesto->Visible;
            $this->ControlsVisible["cod_test"] = $this->cod_test->Visible;
            $this->ControlsVisible["valor"] = $this->valor->Visible;
            $this->ControlsVisible["unidad_medida"] = $this->unidad_medida->Visible;
            $this->ControlsVisible["repetido"] = $this->repetido->Visible;
            $this->ControlsVisible["lnkHistoria"] = $this->lnkHistoria->Visible;
            $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->marcador->SetValue($this->DataSource->marcador->GetValue());
                $this->cod_test->SetValue($this->DataSource->cod_test->GetValue());
                $this->valor->SetValue($this->DataSource->valor->GetValue());
                $this->unidad_medida->SetValue($this->DataSource->unidad_medida->GetValue());
                $this->repetido->SetValue($this->DataSource->repetido->GetValue());
                $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->marcador->Show();
                $this->lblDeCompuesto->Show();
                $this->cod_test->Show();
                $this->valor->Show();
                $this->unidad_medida->Show();
                $this->repetido->Show();
                $this->lnkHistoria->Show();
                $this->nom_estado->Show();
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
        $this->s_peticion_id->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @22-FC7FDD1E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->marcador->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblDeCompuesto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->cod_test->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->unidad_medida->Errors->ToString());
        $errors = ComposeStrings($errors, $this->repetido->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lnkHistoria->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End test_resultados_estados Class @22-FCB6E20C

class clstest_resultados_estadosDataSource extends clsDBDatos {  //test_resultados_estadosDataSource Class @22-AAFEB0BF

//DataSource Variables @22-5EC51E96
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $marcador;
    public $cod_test;
    public $valor;
    public $unidad_medida;
    public $repetido;
    public $nom_estado;
//End DataSource Variables

//DataSourceClass_Initialize Event @22-79EA1725
    function clstest_resultados_estadosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid test_resultados_estados";
        $this->Initialize();
        $this->marcador = new clsField("marcador", ccsInteger, "");
        
        $this->cod_test = new clsField("cod_test", ccsText, "");
        
        $this->valor = new clsField("valor", ccsMemo, "");
        
        $this->unidad_medida = new clsField("unidad_medida", ccsText, "");
        
        $this->repetido = new clsField("repetido", ccsText, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @22-F15A3AC4
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "test_main_id, decompuesto desc, orden_ingreso";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @22-867BDDEF
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_peticion_id", ccsInteger, "", "", $this->Parameters["urls_peticion_id"], 0, false);
        $this->wp->AddParameter("2", "urls_secciones_id", ccsInteger, "", "", $this->Parameters["urls_secciones_id"], "", false);
        $this->wp->AddParameter("3", "urls_equipo_id", ccsInteger, "", "", $this->Parameters["urls_equipo_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resultados.peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "test.secciones_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opEqual, "test.equipo_id", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsInteger),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @22-A9A0BDCB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((resultados LEFT JOIN test ON\n\n" .
        "resultados.test_id = test.test_id) LEFT JOIN estados ON\n\n" .
        "resultados.estado_id = estados.estado_id) LEFT JOIN peticiones_detalle ON\n\n" .
        "peticiones_detalle.peticion_id = resultados.peticion_id AND peticiones_detalle.test_id = resultados.test_id";
        $this->SQL = "SELECT secciones_id, equipo_id, cod_test, nom_test, unidad_medida, aislado, compuesto, formula, resultado_id, resultados.peticion_id AS resultados_peticion_id,\n\n" .
        "resultados.test_id AS resultados_test_id, resultados.estado_id AS resultados_estado_id, valor, nom_estado, decompuesto,\n\n" .
        "test_main_id, repetido \n\n" .
        "FROM ((resultados LEFT JOIN test ON\n\n" .
        "resultados.test_id = test.test_id) LEFT JOIN estados ON\n\n" .
        "resultados.estado_id = estados.estado_id) LEFT JOIN peticiones_detalle ON\n\n" .
        "peticiones_detalle.peticion_id = resultados.peticion_id AND peticiones_detalle.test_id = resultados.test_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @22-9D96AA93
    function SetValues()
    {
        $this->marcador->SetDBValue(trim($this->f("resultado_id")));
        $this->cod_test->SetDBValue($this->f("cod_test"));
        $this->valor->SetDBValue($this->f("valor"));
        $this->unidad_medida->SetDBValue($this->f("unidad_medida"));
        $this->repetido->SetDBValue($this->f("repetido"));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
    }
//End SetValues Method

} //End test_resultados_estadosDataSource Class @22-FCB6E20C

//Initialize Page @1-584EC6B3
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
$TemplateFileName = "validar_resultados_peticion.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-176F2FD9
CCSecurityRedirect("5;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-C48A11F3
include_once("./validar_resultados_peticion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-EE82B80D
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_pacientesSearch = new clsRecordpeticiones_pacientesSearch("", $MainPage);
$peticiones_pacientes = new clsGridpeticiones_pacientes("", $MainPage);
$test_resultados_estadosSearch = new clsRecordtest_resultados_estadosSearch("", $MainPage);
$test_resultados_estados = new clsGridtest_resultados_estados("", $MainPage);
$ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink1->Parameters = CCAddParam($ImageLink1->Parameters, "s_peticion_id", CCGetFromGet("s_peticion_id", NULL));
$ImageLink1->Page = "add_resultados_peticion2.php";
$ImageLink2 = new clsControl(ccsImageLink, "ImageLink2", "ImageLink2", ccsText, "", CCGetRequestParam("ImageLink2", ccsGet, NULL), $MainPage);
$ImageLink2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink2->Page = "menu_principal.php";
$MainPage->peticiones_pacientesSearch = & $peticiones_pacientesSearch;
$MainPage->peticiones_pacientes = & $peticiones_pacientes;
$MainPage->test_resultados_estadosSearch = & $test_resultados_estadosSearch;
$MainPage->test_resultados_estados = & $test_resultados_estados;
$MainPage->ImageLink1 = & $ImageLink1;
$MainPage->ImageLink2 = & $ImageLink2;
$peticiones_pacientes->Initialize();
$test_resultados_estados->Initialize();
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

//Execute Components @1-5D72AE1F
$test_resultados_estadosSearch->Operation();
$peticiones_pacientesSearch->Operation();
//End Execute Components

//Go to destination page @1-ABAA0C1F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_pacientesSearch);
    unset($peticiones_pacientes);
    unset($test_resultados_estadosSearch);
    unset($test_resultados_estados);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F9D3596B
$peticiones_pacientesSearch->Show();
$peticiones_pacientes->Show();
$test_resultados_estadosSearch->Show();
$test_resultados_estados->Show();
$ImageLink1->Show();
$ImageLink2->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C7525E46
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_pacientesSearch);
unset($peticiones_pacientes);
unset($test_resultados_estadosSearch);
unset($test_resultados_estados);
unset($Tpl);
//End Unload Page


?>
