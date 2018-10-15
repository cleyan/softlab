<?php
class clsGriddetalle_peticionpeticiones_estados_estado { //peticiones_estados_estado class @5-D479F9DA

//Variables @5-6E51DF5A

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

//Class_Initialize Event @5-60836399
    function clsGriddetalle_peticionpeticiones_estados_estado($RelativePath, & $Parent)
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
        $this->DataSource = new clsdetalle_peticionpeticiones_estados_estadoDataSource($this);
        $this->ds = & $this->DataSource;

        $this->peticion_id = new clsControl(ccsLabel, "peticion_id", "peticion_id", ccsInteger, "", CCGetRequestParam("peticion_id", ccsGet, NULL), $this);
        $this->rut = new clsControl(ccsLabel, "rut", "rut", ccsText, "", CCGetRequestParam("rut", ccsGet, NULL), $this);
        $this->ficha = new clsControl(ccsLabel, "ficha", "ficha", ccsText, "", CCGetRequestParam("ficha", ccsGet, NULL), $this);
        $this->nombres = new clsControl(ccsLabel, "nombres", "nombres", ccsText, "", CCGetRequestParam("nombres", ccsGet, NULL), $this);
        $this->apellidos = new clsControl(ccsLabel, "apellidos", "apellidos", ccsText, "", CCGetRequestParam("apellidos", ccsGet, NULL), $this);
        $this->nom_prevision = new clsControl(ccsLabel, "nom_prevision", "nom_prevision", ccsText, "", CCGetRequestParam("nom_prevision", ccsGet, NULL), $this);
        $this->fecha = new clsControl(ccsLabel, "fecha", "fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha", ccsGet, NULL), $this);
        $this->hora = new clsControl(ccsLabel, "hora", "hora", ccsDate, array("H", ":", "nn"), CCGetRequestParam("hora", ccsGet, NULL), $this);
        $this->fecha_nacimiento = new clsControl(ccsLabel, "fecha_nacimiento", "fecha_nacimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha_nacimiento", ccsGet, NULL), $this);
        $this->edad = new clsControl(ccsLabel, "edad", "edad", ccsText, "", CCGetRequestParam("edad", ccsGet, NULL), $this);
        $this->nom_medico = new clsControl(ccsLabel, "nom_medico", "nom_medico", ccsText, "", CCGetRequestParam("nom_medico", ccsGet, NULL), $this);
        $this->nom_estado_pago = new clsControl(ccsLabel, "nom_estado_pago", "nom_estado_pago", ccsText, "", CCGetRequestParam("nom_estado_pago", ccsGet, NULL), $this);
        $this->img_aviso = new clsControl(ccsLabel, "img_aviso", "img_aviso", ccsText, "", CCGetRequestParam("img_aviso", ccsGet, NULL), $this);
        $this->img_aviso->HTML = true;
        $this->pacientes_fono = new clsControl(ccsLabel, "pacientes_fono", "pacientes_fono", ccsText, "", CCGetRequestParam("pacientes_fono", ccsGet, NULL), $this);
        $this->nom_estado = new clsControl(ccsLabel, "nom_estado", "nom_estado", ccsText, "", CCGetRequestParam("nom_estado", ccsGet, NULL), $this);
        $this->celular = new clsControl(ccsLabel, "celular", "celular", ccsText, "", CCGetRequestParam("celular", ccsGet, NULL), $this);
        $this->valor = new clsControl(ccsLabel, "valor", "valor", ccsInteger, array(False, 0, Null, "", False, "\$", "", 1, True, ""), CCGetRequestParam("valor", ccsGet, NULL), $this);
        $this->pacientes_email = new clsControl(ccsLabel, "pacientes_email", "pacientes_email", ccsText, "", CCGetRequestParam("pacientes_email", ccsGet, NULL), $this);
        $this->saldo = new clsControl(ccsLabel, "saldo", "saldo", ccsInteger, array(False, 0, Null, "", False, "\$", "", 1, True, ""), CCGetRequestParam("saldo", ccsGet, NULL), $this);
        $this->nom_procedencia = new clsControl(ccsLabel, "nom_procedencia", "nom_procedencia", ccsText, "", CCGetRequestParam("nom_procedencia", ccsGet, NULL), $this);
        $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "nom_usuario", ccsText, "", CCGetRequestParam("nom_usuario", ccsGet, NULL), $this);
        $this->observaciones = new clsControl(ccsLabel, "observaciones", "observaciones", ccsText, "", CCGetRequestParam("observaciones", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @5-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @5-0A92DEA4
    function Show()
    {
        $Tpl = CCGetTemplate($this);
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlpeticion_id"] = CCGetFromGet("peticion_id", NULL);
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
            $this->ControlsVisible["rut"] = $this->rut->Visible;
            $this->ControlsVisible["ficha"] = $this->ficha->Visible;
            $this->ControlsVisible["nombres"] = $this->nombres->Visible;
            $this->ControlsVisible["apellidos"] = $this->apellidos->Visible;
            $this->ControlsVisible["nom_prevision"] = $this->nom_prevision->Visible;
            $this->ControlsVisible["fecha"] = $this->fecha->Visible;
            $this->ControlsVisible["hora"] = $this->hora->Visible;
            $this->ControlsVisible["fecha_nacimiento"] = $this->fecha_nacimiento->Visible;
            $this->ControlsVisible["edad"] = $this->edad->Visible;
            $this->ControlsVisible["nom_medico"] = $this->nom_medico->Visible;
            $this->ControlsVisible["nom_estado_pago"] = $this->nom_estado_pago->Visible;
            $this->ControlsVisible["img_aviso"] = $this->img_aviso->Visible;
            $this->ControlsVisible["pacientes_fono"] = $this->pacientes_fono->Visible;
            $this->ControlsVisible["nom_estado"] = $this->nom_estado->Visible;
            $this->ControlsVisible["celular"] = $this->celular->Visible;
            $this->ControlsVisible["valor"] = $this->valor->Visible;
            $this->ControlsVisible["pacientes_email"] = $this->pacientes_email->Visible;
            $this->ControlsVisible["saldo"] = $this->saldo->Visible;
            $this->ControlsVisible["nom_procedencia"] = $this->nom_procedencia->Visible;
            $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
            $this->ControlsVisible["observaciones"] = $this->observaciones->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                $this->rut->SetValue($this->DataSource->rut->GetValue());
                $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                $this->hora->SetValue($this->DataSource->hora->GetValue());
                $this->fecha_nacimiento->SetValue($this->DataSource->fecha_nacimiento->GetValue());
                $this->nom_medico->SetValue($this->DataSource->nom_medico->GetValue());
                $this->nom_estado_pago->SetValue($this->DataSource->nom_estado_pago->GetValue());
                $this->pacientes_fono->SetValue($this->DataSource->pacientes_fono->GetValue());
                $this->nom_estado->SetValue($this->DataSource->nom_estado->GetValue());
                $this->celular->SetValue($this->DataSource->celular->GetValue());
                $this->pacientes_email->SetValue($this->DataSource->pacientes_email->GetValue());
                $this->nom_procedencia->SetValue($this->DataSource->nom_procedencia->GetValue());
                $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                $this->observaciones->SetValue($this->DataSource->observaciones->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->peticion_id->Show();
                $this->rut->Show();
                $this->ficha->Show();
                $this->nombres->Show();
                $this->apellidos->Show();
                $this->nom_prevision->Show();
                $this->fecha->Show();
                $this->hora->Show();
                $this->fecha_nacimiento->Show();
                $this->edad->Show();
                $this->nom_medico->Show();
                $this->nom_estado_pago->Show();
                $this->img_aviso->Show();
                $this->pacientes_fono->Show();
                $this->nom_estado->Show();
                $this->celular->Show();
                $this->valor->Show();
                $this->pacientes_email->Show();
                $this->saldo->Show();
                $this->nom_procedencia->Show();
                $this->nom_usuario->Show();
                $this->observaciones->Show();
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

//GetErrors Method @5-565CCD3C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->peticion_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->rut->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ficha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nombres->Errors->ToString());
        $errors = ComposeStrings($errors, $this->apellidos->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha->Errors->ToString());
        $errors = ComposeStrings($errors, $this->hora->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_nacimiento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->edad->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_medico->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado_pago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->img_aviso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pacientes_fono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_estado->Errors->ToString());
        $errors = ComposeStrings($errors, $this->celular->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->pacientes_email->Errors->ToString());
        $errors = ComposeStrings($errors, $this->saldo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_procedencia->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->observaciones->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End peticiones_estados_estado Class @5-FCB6E20C

class clsdetalle_peticionpeticiones_estados_estadoDataSource extends clsDBDatos {  //peticiones_estados_estadoDataSource Class @5-DFCB74A0

//DataSource Variables @5-29103F70
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $peticion_id;
    public $rut;
    public $ficha;
    public $nombres;
    public $apellidos;
    public $nom_prevision;
    public $fecha;
    public $hora;
    public $fecha_nacimiento;
    public $nom_medico;
    public $nom_estado_pago;
    public $pacientes_fono;
    public $nom_estado;
    public $celular;
    public $pacientes_email;
    public $nom_procedencia;
    public $nom_usuario;
    public $observaciones;
//End DataSource Variables

//DataSourceClass_Initialize Event @5-A8657BB7
    function clsdetalle_peticionpeticiones_estados_estadoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid peticiones_estados_estado";
        $this->Initialize();
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->nom_prevision = new clsField("nom_prevision", ccsText, "");
        
        $this->fecha = new clsField("fecha", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->hora = new clsField("hora", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->fecha_nacimiento = new clsField("fecha_nacimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nom_medico = new clsField("nom_medico", ccsText, "");
        
        $this->nom_estado_pago = new clsField("nom_estado_pago", ccsText, "");
        
        $this->pacientes_fono = new clsField("pacientes_fono", ccsText, "");
        
        $this->nom_estado = new clsField("nom_estado", ccsText, "");
        
        $this->celular = new clsField("celular", ccsText, "");
        
        $this->pacientes_email = new clsField("pacientes_email", ccsText, "");
        
        $this->nom_procedencia = new clsField("nom_procedencia", ccsText, "");
        
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        
        $this->observaciones = new clsField("observaciones", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @5-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @5-625A1D07
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
        $this->wp->AddParameter("2", "urls_peticion_id", ccsInteger, "", "", $this->Parameters["urls_peticion_id"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "peticiones.peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "peticiones.peticion_id", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsInteger),false);
        $this->Where = $this->wp->opOR(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @5-30C61B15
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((((((peticiones LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id) LEFT JOIN estados_pagos ON\n\n" .
        "peticiones.estado_pago_id = estados_pagos.estado_pago_id) LEFT JOIN medicos ON\n\n" .
        "peticiones.medico_id = medicos.medico_id) LEFT JOIN pacientes ON\n\n" .
        "peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN previsiones ON\n\n" .
        "peticiones.prevision_id = previsiones.prevision_id) LEFT JOIN procedencias ON\n\n" .
        "peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN usuarios ON\n\n" .
        "peticiones.usuario_id = usuarios.usuario_id";
        $this->SQL = "SELECT peticiones.*, nom_estado, nom_estado_pago, nom_medico, rut, ficha, nombres, apellidos, fecha_nacimiento, pacientes.fono AS pacientes_fono,\n\n" .
        "celular, pacientes.email AS pacientes_email, nom_prevision, nom_procedencia, nom_usuario \n\n" .
        "FROM ((((((peticiones LEFT JOIN estados ON\n\n" .
        "peticiones.estado_id = estados.estado_id) LEFT JOIN estados_pagos ON\n\n" .
        "peticiones.estado_pago_id = estados_pagos.estado_pago_id) LEFT JOIN medicos ON\n\n" .
        "peticiones.medico_id = medicos.medico_id) LEFT JOIN pacientes ON\n\n" .
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

//SetValues Method @5-AF7D05E4
    function SetValues()
    {
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->rut->SetDBValue($this->f("rut"));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->hora->SetDBValue(trim($this->f("hora")));
        $this->fecha_nacimiento->SetDBValue(trim($this->f("fecha_nacimiento")));
        $this->nom_medico->SetDBValue($this->f("nom_medico"));
        $this->nom_estado_pago->SetDBValue($this->f("nom_estado_pago"));
        $this->pacientes_fono->SetDBValue($this->f("pacientes_fono"));
        $this->nom_estado->SetDBValue($this->f("nom_estado"));
        $this->celular->SetDBValue($this->f("celular"));
        $this->pacientes_email->SetDBValue($this->f("pacientes_email"));
        $this->nom_procedencia->SetDBValue($this->f("nom_procedencia"));
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
        $this->observaciones->SetDBValue($this->f("observaciones"));
    }
//End SetValues Method

} //End peticiones_estados_estadoDataSource Class @5-FCB6E20C

class clsdetalle_peticion { //detalle_peticion class @1-3797A049

//Variables @1-EEEBE252
    public $ComponentType = "IncludablePage";
    public $Connections = array();
    public $FileName = "";
    public $Redirect = "";
    public $Tpl = "";
    public $TemplateFileName = "";
    public $BlockToParse = "";
    public $ComponentName = "";
    public $Attributes = "";

    // Events;
    public $CCSEvents = "";
    public $CCSEventResult = "";
    public $RelativePath;
    public $Visible;
    public $Parent;
    public $TemplateSource;
//End Variables

//Class_Initialize Event @1-78837FB6
    function clsdetalle_peticion($RelativePath, $ComponentName, & $Parent)
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = $ComponentName;
        $this->RelativePath = $RelativePath;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->FileName = "detalle_peticion.php";
        $this->Redirect = "";
        $this->TemplateFileName = "detalle_peticion.html";
        $this->BlockToParse = "main";
        $this->TemplateEncoding = "UTF-8";
        $this->ContentType = "text/html";
    }
//End Class_Initialize Event

//Class_Terminate Event @1-33C34905
    function Class_Terminate()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUnload", $this);
        unset($this->peticiones_estados_estado);
    }
//End Class_Terminate Event

//BindEvents Method @1-035F9F31
    function BindEvents()
    {
        $this->peticiones_estados_estado->CCSEvents["BeforeShow"] = "detalle_peticion_peticiones_estados_estado_BeforeShow";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInitialize", $this);
    }
//End BindEvents Method

//Operations Method @1-7E2A14CF
    function Operations()
    {
        global $Redirect;
        if(!$this->Visible)
            return "";
    }
//End Operations Method

//Initialize Method @1-2BBEBEE7
    function Initialize($Path = "")
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        global $Scripts;
        $IncScripts = "|";
        $SList = explode("|", $IncScripts);
        foreach ($SList as $Script) {
            if ($Script != "" && strpos($Scripts, "|" . $Script . "|") === false)  $Scripts = $Scripts . $Script . "|";
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInitialize", $this);
        if(!$this->Visible)
            return "";
        $this->Attributes = & $this->Parent->Attributes;
        $this->DBDatos = new clsDBDatos();
        $this->Connections["Datos"] = & $this->DBDatos;

        // Create Components
        $this->peticiones_estados_estado = new clsGriddetalle_peticionpeticiones_estados_estado($this->RelativePath, $this);
        $this->peticiones_estados_estado->Initialize();
        $this->BindEvents();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnInitializeView", $this);
    }
//End Initialize Method

//Show Method @1-13E92E5D
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        $block_path = $Tpl->block_path;
        if ($this->TemplateSource) {
            $Tpl->LoadTemplateFromStr($this->TemplateSource, $this->ComponentName, $this->TemplateEncoding);
        } else {
            $Tpl->LoadTemplate("/" . $this->TemplateFileName, $this->ComponentName, $this->TemplateEncoding, "remove");
        }
        $Tpl->block_path = $Tpl->block_path . "/" . $this->ComponentName;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) {
            $Tpl->block_path = $block_path;
            $Tpl->SetVar($this->ComponentName, "");
            return "";
        }
        $this->Attributes->Show();
        $this->peticiones_estados_estado->Show();
        $Tpl->Parse();
        $Tpl->block_path = $block_path;
        $TplData = $Tpl->GetVar($this->ComponentName);
        $Tpl->SetVar($this->ComponentName, $TplData);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeOutput", $this);
    }
//End Show Method

} //End detalle_peticion Class @1-FCB6E20C

//Include Event File @1-6E76FB76
include_once(RelativePath . "/detalle_peticion_events.php");
//End Include Event File


?>
