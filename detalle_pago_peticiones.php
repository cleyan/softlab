<?php
//Include Common Files @1-42F5F0A6
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "detalle_pago_peticiones.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpeticiones_estados_pagosSearch { //peticiones_estados_pagosSearch Class @139-11F89ED5

//Variables @139-9E315808

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

//Class_Initialize Event @139-D2870370
    function clsRecordpeticiones_estados_pagosSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record peticiones_estados_pagosSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "peticiones_estados_pagosSearch";
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
            $this->s_rut = new clsControl(ccsTextBox, "s_rut", "s_rut", ccsText, "", CCGetRequestParam("s_rut", $Method, NULL), $this);
            $this->s_nombres = new clsControl(ccsTextBox, "s_nombres", "s_nombres", ccsText, "", CCGetRequestParam("s_nombres", $Method, NULL), $this);
            $this->s_apellidos = new clsControl(ccsTextBox, "s_apellidos", "s_apellidos", ccsText, "", CCGetRequestParam("s_apellidos", $Method, NULL), $this);
            $this->s_estado_pago_id = new clsControl(ccsListBox, "s_estado_pago_id", "s_estado_pago_id", ccsInteger, "", CCGetRequestParam("s_estado_pago_id", $Method, NULL), $this);
            $this->s_estado_pago_id->DSType = dsTable;
            $this->s_estado_pago_id->DataSource = new clsDBDatos();
            $this->s_estado_pago_id->ds = & $this->s_estado_pago_id->DataSource;
            $this->s_estado_pago_id->DataSource->SQL = "SELECT * \n" .
"FROM estados_pagos {SQL_Where} {SQL_OrderBy}";
            list($this->s_estado_pago_id->BoundColumn, $this->s_estado_pago_id->TextColumn, $this->s_estado_pago_id->DBFormat) = array("estado_pago_id", "nom_estado_pago", "");
            $this->s_procedencia_id = new clsControl(ccsListBox, "s_procedencia_id", "s_procedencia_id", ccsInteger, "", CCGetRequestParam("s_procedencia_id", $Method, NULL), $this);
            $this->s_procedencia_id->DSType = dsTable;
            $this->s_procedencia_id->DataSource = new clsDBDatos();
            $this->s_procedencia_id->ds = & $this->s_procedencia_id->DataSource;
            $this->s_procedencia_id->DataSource->SQL = "SELECT * \n" .
"FROM procedencias {SQL_Where} {SQL_OrderBy}";
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            list($this->s_procedencia_id->BoundColumn, $this->s_procedencia_id->TextColumn, $this->s_procedencia_id->DBFormat) = array("procedencia_id", "nom_procedencia", "");
            $this->s_procedencia_id->DataSource->Parameters["expr175"] = GetUserProcedenciaID();
            $this->s_procedencia_id->DataSource->wp = new clsSQLParameters();
            $this->s_procedencia_id->DataSource->wp->AddParameter("1", "expr175", ccsInteger, "", "", $this->s_procedencia_id->DataSource->Parameters["expr175"], "", false);
            $this->s_procedencia_id->DataSource->wp->Criterion[1] = $this->s_procedencia_id->DataSource->wp->Operation(opEqual, "procedencia_id", $this->s_procedencia_id->DataSource->wp->GetDBValue("1"), $this->s_procedencia_id->DataSource->ToSQL($this->s_procedencia_id->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->s_procedencia_id->DataSource->wp->Criterion[2] = "( " . CCGetGroupID() . " > 4 )";
            $this->s_procedencia_id->DataSource->Where = $this->s_procedencia_id->DataSource->wp->opOR(
                 false, 
                 $this->s_procedencia_id->DataSource->wp->Criterion[1], 
                 $this->s_procedencia_id->DataSource->wp->Criterion[2]);
            $this->s_procedencia_id->DataSource->Order = "nom_procedencia";
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->s_procedencia_id->Value) && !strlen($this->s_procedencia_id->Value) && $this->s_procedencia_id->Value !== false)
                    $this->s_procedencia_id->SetText(GetUserProcedenciaID());
            }
        }
    }
//End Class_Initialize Event

//Validate Method @139-AC59C894
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $Validation = ($this->s_fecha_ini->Validate() && $Validation);
        $Validation = ($this->s_fecha_fin->Validate() && $Validation);
        $Validation = ($this->s_rut->Validate() && $Validation);
        $Validation = ($this->s_nombres->Validate() && $Validation);
        $Validation = ($this->s_apellidos->Validate() && $Validation);
        $Validation = ($this->s_estado_pago_id->Validate() && $Validation);
        $Validation = ($this->s_procedencia_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_ini->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_fecha_fin->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_rut->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_nombres->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_apellidos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_estado_pago_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_procedencia_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @139-122A9539
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->s_fecha_ini->Errors->Count());
        $errors = ($errors || $this->s_fecha_fin->Errors->Count());
        $errors = ($errors || $this->s_rut->Errors->Count());
        $errors = ($errors || $this->s_nombres->Errors->Count());
        $errors = ($errors || $this->s_apellidos->Errors->Count());
        $errors = ($errors || $this->s_estado_pago_id->Errors->Count());
        $errors = ($errors || $this->s_procedencia_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @139-22EC3BD4
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
        $Redirect = "detalle_pago_peticiones.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "detalle_pago_peticiones.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @139-89509695
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

        $this->s_estado_pago_id->Prepare();
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
            $Error = ComposeStrings($Error, $this->s_fecha_ini->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_fecha_fin->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_rut->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_nombres->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_apellidos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_estado_pago_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_procedencia_id->Errors->ToString());
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
        $this->s_rut->Show();
        $this->s_nombres->Show();
        $this->s_apellidos->Show();
        $this->s_estado_pago_id->Show();
        $this->s_procedencia_id->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End peticiones_estados_pagosSearch Class @139-FCB6E20C

class clsRecordpacientes { //pacientes Class @181-633F8F80

//Variables @181-9E315808

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

//Class_Initialize Event @181-B0EB8DD5
    function clsRecordpacientes($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record pacientes/Error";
        $this->DataSource = new clspacientesDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "pacientes";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->nombres = new clsControl(ccsLabel, "nombres", "Nombres", ccsText, "", CCGetRequestParam("nombres", $Method, NULL), $this);
            $this->apellidos = new clsControl(ccsLabel, "apellidos", "Apellidos", ccsText, "", CCGetRequestParam("apellidos", $Method, NULL), $this);
            $this->rut = new clsControl(ccsLabel, "rut", "Rut", ccsText, "", CCGetRequestParam("rut", $Method, NULL), $this);
            $this->ficha = new clsControl(ccsLabel, "ficha", "Ficha", ccsText, "", CCGetRequestParam("ficha", $Method, NULL), $this);
            $this->fono = new clsControl(ccsLabel, "fono", "Fono", ccsText, "", CCGetRequestParam("fono", $Method, NULL), $this);
            $this->celular = new clsControl(ccsLabel, "celular", "Celular", ccsText, "", CCGetRequestParam("celular", $Method, NULL), $this);
            $this->email = new clsControl(ccsLabel, "email", "email", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @181-26EB49A0
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlpaciente_id"] = CCGetFromGet("paciente_id", NULL);
    }
//End Initialize Method

//Validate Method @181-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @181-3C2BA8FF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->nombres->Errors->Count());
        $errors = ($errors || $this->apellidos->Errors->Count());
        $errors = ($errors || $this->rut->Errors->Count());
        $errors = ($errors || $this->ficha->Errors->Count());
        $errors = ($errors || $this->fono->Errors->Count());
        $errors = ($errors || $this->celular->Errors->Count());
        $errors = ($errors || $this->email->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @181-852B7B9B
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        $Redirect = "detalle_pago_peticiones.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @181-0DB6CB78
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
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->rut->SetValue($this->DataSource->rut->GetValue());
                $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                $this->fono->SetValue($this->DataSource->fono->GetValue());
                $this->celular->SetValue($this->DataSource->celular->GetValue());
                $this->email->SetValue($this->DataSource->email->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->nombres->Errors->ToString());
            $Error = ComposeStrings($Error, $this->apellidos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->rut->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ficha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->celular->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
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

        $this->nombres->Show();
        $this->apellidos->Show();
        $this->rut->Show();
        $this->ficha->Show();
        $this->fono->Show();
        $this->celular->Show();
        $this->email->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End pacientes Class @181-FCB6E20C

class clspacientesDataSource extends clsDBDatos {  //pacientesDataSource Class @181-BFE569F0

//DataSource Variables @181-E0110928
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $nombres;
    public $apellidos;
    public $rut;
    public $ficha;
    public $fono;
    public $celular;
    public $email;
//End DataSource Variables

//DataSourceClass_Initialize Event @181-021328F7
    function clspacientesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record pacientes/Error";
        $this->Initialize();
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->fono = new clsField("fono", ccsText, "");
        
        $this->celular = new clsField("celular", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @181-D1AD7AEC
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpaciente_id", ccsInteger, "", "", $this->Parameters["urlpaciente_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "paciente_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @181-D16C1DEA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM pacientes {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @181-3C4635CD
    function SetValues()
    {
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->rut->SetDBValue($this->f("rut"));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->fono->SetDBValue($this->f("fono"));
        $this->celular->SetDBValue($this->f("celular"));
        $this->email->SetDBValue($this->f("email"));
    }
//End SetValues Method

} //End pacientesDataSource Class @181-FCB6E20C

class clsGridpeticiones_estados_pagos { //peticiones_estados_pagos class @119-2D7E17AC

//Variables @119-414FFB19

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
    public $Sorter_nom_procedencia;
    public $Sorter_nom_estado_pago;
    public $Sorter_nom_usuario;
//End Variables

//Class_Initialize Event @119-EFBCF216
    function clsGridpeticiones_estados_pagos($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "peticiones_estados_pagos";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid peticiones_estados_pagos";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clspeticiones_estados_pagosDataSource($this);
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
        $this->SorterName = CCGetParam("peticiones_estados_pagosOrder", "");
        $this->SorterDirection = CCGetParam("peticiones_estados_pagosDir", "");

        $this->ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $this);
        $this->ImageLink1->Page = "list_pago_peticion.php";
        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->nom_estado_pago = new clsControl(ccsLabel, "nom_estado_pago", "nom_estado_pago", ccsText, "", CCGetRequestParam("nom_estado_pago", ccsGet, NULL), $this);
        $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "nom_usuario", ccsText, "", CCGetRequestParam("nom_usuario", ccsGet, NULL), $this);
        $this->peticiones_estados_pagos_TotalRecords = new clsControl(ccsLabel, "peticiones_estados_pagos_TotalRecords", "peticiones_estados_pagos_TotalRecords", ccsText, "", CCGetRequestParam("peticiones_estados_pagos_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_peticion_id = new clsSorter($this->ComponentName, "Sorter_peticion_id", $FileName, $this);
        $this->Sorter_fecha = new clsSorter($this->ComponentName, "Sorter_fecha", $FileName, $this);
        $this->Sorter_nombres = new clsSorter($this->ComponentName, "Sorter_nombres", $FileName, $this);
        $this->Sorter_apellidos = new clsSorter($this->ComponentName, "Sorter_apellidos", $FileName, $this);
        $this->Sorter_nom_procedencia = new clsSorter($this->ComponentName, "Sorter_nom_procedencia", $FileName, $this);
        $this->Sorter_nom_estado_pago = new clsSorter($this->ComponentName, "Sorter_nom_estado_pago", $FileName, $this);
        $this->Sorter_nom_usuario = new clsSorter($this->ComponentName, "Sorter_nom_usuario", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpSimple, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @119-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @119-D0A035BD
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_nombres"] = CCGetFromGet("s_nombres", NULL);
        $this->DataSource->Parameters["urls_apellidos"] = CCGetFromGet("s_apellidos", NULL);
        $this->DataSource->Parameters["urls_rut"] = CCGetFromGet("s_rut", NULL);
        $this->DataSource->Parameters["urls_estado_pago_id"] = CCGetFromGet("s_estado_pago_id", NULL);
        $this->DataSource->Parameters["urls_fecha"] = CCGetFromGet("s_fecha", NULL);
        $this->DataSource->Parameters["urls_procedencia_id"] = CCGetFromGet("s_procedencia_id", NULL);
        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);
        $this->DataSource->Parameters["urlpaciente_id"] = CCGetFromGet("paciente_id", NULL);

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
            $this->ControlsVisible["peticion_id"] = $this->peticion_id->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
            $this->ControlsVisible["nom_estado_pago"] = $this->nom_estado_pago->Visible;
            $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ImageLink1->Parameters = CCAddParam($this->ImageLink1->Parameters, "peticion_id", $this->DataSource->f("peticion_id"));
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                $this->nom_estado_pago->SetValue($this->DataSource->nom_estado_pago->GetValue());
                $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ImageLink1->Show();
                $this->peticion_id->Show();
                $this->fecha->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->nom_procedencia->Show();
                $this->nom_estado_pago->Show();
                $this->nom_usuario->Show();
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
        $this->peticiones_estados_pagos_TotalRecords->Show();
        $this->Sorter_peticion_id->Show();
        $this->Sorter_fecha->Show();
        $this->Sorter_nombres->Show();
        $this->Sorter_apellidos->Show();
        $this->Sorter_nom_procedencia->Show();
        $this->Sorter_nom_estado_pago->Show();
        $this->Sorter_nom_usuario->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @119-3F23C298
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ImageLink1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado_pago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_estados_pagos Class @119-FCB6E20C

class clspeticiones_estados_pagosDataSource extends clsDBDatos {  //peticiones_estados_pagosDataSource Class @119-A13C075B

//DataSource Variables @119-87376E16
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
    public $nom_procedencia;
    public $nom_estado_pago;
    public $nom_usuario;
//End DataSource Variables

//DataSourceClass_Initialize Event @119-BF78A50E
    function clspeticiones_estados_pagosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_estados_pagos";
        $this->Initialize();
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->nom_estado_pago = new clsField("nom_estado_pago", ccsText, "");
        
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @119-F5566EA8
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "peticion_id";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_peticion_id" => array("peticion_id", ""), 
            "Sorter_fecha" => array("fecha", ""), 
            "Sorter_nombres" => array("nombres", ""), 
            "Sorter_apellidos" => array("apellidos", ""), 
            "Sorter_nom_procedencia" => array("nom_procedencia", ""), 
            "Sorter_nom_estado_pago" => array("nom_estado_pago", ""), 
            "Sorter_nom_usuario" => array("nom_usuario", "")));
    }
//End SetOrder Method

//Prepare Method @119-9C1CB949
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_nombres", ccsText, "", "", $this->Parameters["urls_nombres"], "", false);
        $this->wp->AddParameter("2", "urls_apellidos", ccsText, "", "", $this->Parameters["urls_apellidos"], "", false);
        $this->wp->AddParameter("3", "urls_rut", ccsText, "", "", $this->Parameters["urls_rut"], "", false);
        $this->wp->AddParameter("4", "urls_estado_pago_id", ccsInteger, "", "", $this->Parameters["urls_estado_pago_id"], "", false);
        $this->wp->AddParameter("5", "urls_fecha", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_fecha"], "", false);
        $this->wp->AddParameter("6", "urls_procedencia_id", ccsInteger, "", "", $this->Parameters["urls_procedencia_id"], GetUserProcedenciaID(), false);
        $this->wp->AddParameter("8", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], "", false);
        $this->wp->AddParameter("9", "urlpaciente_id", ccsInteger, "", "", $this->Parameters["urlpaciente_id"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "nombres", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "apellidos", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "rut", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->wp->Criterion[4] = $this->wp->Operation(opEqual, "peticiones.estado_pago_id", $this->wp->GetDBValue("4"), $this->ToSQL($this->wp->GetDBValue("4"), ccsInteger),false);
        $this->wp->Criterion[5] = $this->wp->Operation(opEqual, "fecha", $this->wp->GetDBValue("5"), $this->ToSQL($this->wp->GetDBValue("5"), ccsDate),false);
        $this->wp->Criterion[6] = $this->wp->Operation(opEqual, "peticiones.procedencia_id", $this->wp->GetDBValue("6"), $this->ToSQL($this->wp->GetDBValue("6"), ccsInteger),false);
        $this->wp->Criterion[7] = "( " . CCGetGroupID() . " > 4 )";
        $this->wp->Criterion[8] = $this->wp->Operation(opEqual, "peticiones.peticion_id", $this->wp->GetDBValue("8"), $this->ToSQL($this->wp->GetDBValue("8"), ccsInteger),false);
        $this->wp->Criterion[9] = $this->wp->Operation(opEqual, "peticiones.paciente_id", $this->wp->GetDBValue("9"), $this->ToSQL($this->wp->GetDBValue("9"), ccsInteger),false);
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
             $this->wp->Criterion[5]), $this->wp->opOR(
             true, 
             $this->wp->Criterion[6], 
             $this->wp->Criterion[7])), 
             $this->wp->Criterion[8]), 
             $this->wp->Criterion[9]);
    }
//End Prepare Method

//Open Method @119-FBF0E4A8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((((peticiones LEFT JOIN estados_pagos ON\n\n" .
        "peticiones.estado_pago_id = estados_pagos.estado_pago_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN previsiones ON\n\n" .
        "peticiones.prevision_id = previsiones.prevision_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN usuarios ON\n\n" .
        "peticiones.usuario_id = usuarios.usuario_id";
        $this->SQL = "SELECT peticiones.*, nom_estado_pago, rut, nombres, apellidos, nom_prevision, nom_procedencia, nom_usuario \n\n" .
        "FROM ((((peticiones LEFT JOIN estados_pagos ON\n\n" .
        "peticiones.estado_pago_id = estados_pagos.estado_pago_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN previsiones ON\n\n" .
        "peticiones.prevision_id = previsiones.prevision_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN usuarios ON\n\n" .
        "peticiones.usuario_id = usuarios.usuario_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @119-B8F9139A
    function SetValues()
    {
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->nom_estado_pago->SetDBValue($this->f("nom_estado_pago"));
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
    }
//End SetValues Method

} //End peticiones_estados_pagosDataSource Class @119-FCB6E20C

//Include Page implementation @178-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-5576DB33
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
$TemplateFileName = "detalle_pago_peticiones.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-97F21E60
CCSecurityRedirect("4;5;6;7;8;9;10;11;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-B7BD9B75
include_once("./detalle_pago_peticiones_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D6752E20
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$peticiones_estados_pagosSearch = new clsRecordpeticiones_estados_pagosSearch("", $MainPage);
$pacientes = new clsRecordpacientes("", $MainPage);
$peticiones_estados_pagos = new clsGridpeticiones_estados_pagos("", $MainPage);
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$MainPage->peticiones_estados_pagosSearch = & $peticiones_estados_pagosSearch;
$MainPage->pacientes = & $pacientes;
$MainPage->peticiones_estados_pagos = & $peticiones_estados_pagos;
$MainPage->calendar_tag = & $calendar_tag;
$pacientes->Initialize();
$peticiones_estados_pagos->Initialize();
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

//Execute Components @1-C10A17DE
$calendar_tag->Operations();
$pacientes->Operation();
$peticiones_estados_pagosSearch->Operation();
//End Execute Components

//Go to destination page @1-A65EB435
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($peticiones_estados_pagosSearch);
    unset($pacientes);
    unset($peticiones_estados_pagos);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-63DE078C
$peticiones_estados_pagosSearch->Show();
$pacientes->Show();
$peticiones_estados_pagos->Show();
$calendar_tag->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2BB81872
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($peticiones_estados_pagosSearch);
unset($pacientes);
unset($peticiones_estados_pagos);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($Tpl);
//End Unload Page


?>
