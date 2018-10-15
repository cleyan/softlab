<?php
//Include Common Files @1-E45DAF91
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_resultado_imagen.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordresultados { //resultados Class @2-D4D14F9D

//Variables @2-9E315808

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

//Class_Initialize Event @2-B0886B9C
    function clsRecordresultados($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record resultados/Error";
        $this->DataSource = new clsresultadosDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "resultados";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "multipart/form-data";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->valor = new clsControl(ccsTextBox, "valor", "Valor", ccsText, "", CCGetRequestParam("valor", $Method, NULL), $this);
            $this->archivo = new clsFileUpload("archivo", "Archivo adjunto", "TEMP/", "resultado/", "*.bmp", "*.exe;*.php;*.pl;*.html;*.htm", 300000, $this);
            $this->archivo->Required = true;
            $this->nom_valor_enviar = new clsControl(ccsHidden, "nom_valor_enviar", "nom_valor_enviar", ccsText, "", CCGetRequestParam("nom_valor_enviar", $Method, NULL), $this);
            $this->resultado_id = new clsControl(ccsHidden, "resultado_id", "Id", ccsInteger, "", CCGetRequestParam("resultado_id", $Method, NULL), $this);
            $this->test_id = new clsControl(ccsHidden, "test_id", "Test Id", ccsInteger, "", CCGetRequestParam("test_id", $Method, NULL), $this);
            $this->s_peticion_id = new clsControl(ccsHidden, "s_peticion_id", "Peticion Id", ccsInteger, "", CCGetRequestParam("s_peticion_id", $Method, NULL), $this);
            $this->muestra_id = new clsControl(ccsHidden, "muestra_id", "Muestra Id", ccsText, "", CCGetRequestParam("muestra_id", $Method, NULL), $this);
            $this->estado_id = new clsControl(ccsHidden, "estado_id", "Estado Id", ccsInteger, "", CCGetRequestParam("estado_id", $Method, NULL), $this);
            $this->fecha_creacion = new clsControl(ccsHidden, "fecha_creacion", "Fecha Creacion", ccsText, "", CCGetRequestParam("fecha_creacion", $Method, NULL), $this);
            $this->hora_creacion = new clsControl(ccsHidden, "hora_creacion", "Hora Creacion", ccsText, "", CCGetRequestParam("hora_creacion", $Method, NULL), $this);
            $this->ingresado_por = new clsControl(ccsHidden, "ingresado_por", "Ingresado Por", ccsInteger, "", CCGetRequestParam("ingresado_por", $Method, NULL), $this);
            $this->pagina = new clsControl(ccsHidden, "pagina", "pagina", ccsText, "", CCGetRequestParam("pagina", $Method, NULL), $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->estado_id->Value) && !strlen($this->estado_id->Value) && $this->estado_id->Value !== false)
                    $this->estado_id->SetText(10);
                if(!is_array($this->fecha_creacion->Value) && !strlen($this->fecha_creacion->Value) && $this->fecha_creacion->Value !== false)
                    $this->fecha_creacion->SetText(GetFechaServer(server));
                if(!is_array($this->hora_creacion->Value) && !strlen($this->hora_creacion->Value) && $this->hora_creacion->Value !== false)
                    $this->hora_creacion->SetText(GetFechaServer('server_hora'));
                if(!is_array($this->ingresado_por->Value) && !strlen($this->ingresado_por->Value) && $this->ingresado_por->Value !== false)
                    $this->ingresado_por->SetText(CCGetUserId());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-43092C4C
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlresultado_id"] = CCGetFromGet("resultado_id", NULL);
    }
//End Initialize Method

//Validate Method @2-4BA17B7C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->valor->Validate() && $Validation);
        $Validation = ($this->archivo->Validate() && $Validation);
        $Validation = ($this->nom_valor_enviar->Validate() && $Validation);
        $Validation = ($this->resultado_id->Validate() && $Validation);
        $Validation = ($this->test_id->Validate() && $Validation);
        $Validation = ($this->s_peticion_id->Validate() && $Validation);
        $Validation = ($this->muestra_id->Validate() && $Validation);
        $Validation = ($this->estado_id->Validate() && $Validation);
        $Validation = ($this->fecha_creacion->Validate() && $Validation);
        $Validation = ($this->hora_creacion->Validate() && $Validation);
        $Validation = ($this->ingresado_por->Validate() && $Validation);
        $Validation = ($this->pagina->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->valor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->archivo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_valor_enviar->Errors->Count() == 0);
        $Validation =  $Validation && ($this->resultado_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->test_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_peticion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->muestra_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->estado_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha_creacion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->hora_creacion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ingresado_por->Errors->Count() == 0);
        $Validation =  $Validation && ($this->pagina->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-ADB84914
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->valor->Errors->Count());
        $errors = ($errors || $this->archivo->Errors->Count());
        $errors = ($errors || $this->nom_valor_enviar->Errors->Count());
        $errors = ($errors || $this->resultado_id->Errors->Count());
        $errors = ($errors || $this->test_id->Errors->Count());
        $errors = ($errors || $this->s_peticion_id->Errors->Count());
        $errors = ($errors || $this->muestra_id->Errors->Count());
        $errors = ($errors || $this->estado_id->Errors->Count());
        $errors = ($errors || $this->fecha_creacion->Errors->Count());
        $errors = ($errors || $this->hora_creacion->Errors->Count());
        $errors = ($errors || $this->ingresado_por->Errors->Count());
        $errors = ($errors || $this->pagina->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-560CA900
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

        $this->archivo->Upload();

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "closeandrefresh.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Cancel") {
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @2-F649A93B
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
        $this->DataSource->archivo->SetValue($this->archivo->GetValue(true));
        $this->DataSource->nom_valor_enviar->SetValue($this->nom_valor_enviar->GetValue(true));
        $this->DataSource->resultado_id->SetValue($this->resultado_id->GetValue(true));
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->s_peticion_id->SetValue($this->s_peticion_id->GetValue(true));
        $this->DataSource->muestra_id->SetValue($this->muestra_id->GetValue(true));
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->fecha_creacion->SetValue($this->fecha_creacion->GetValue(true));
        $this->DataSource->hora_creacion->SetValue($this->hora_creacion->GetValue(true));
        $this->DataSource->ingresado_por->SetValue($this->ingresado_por->GetValue(true));
        $this->DataSource->pagina->SetValue($this->pagina->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->archivo->Move();
        }
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-E2393D7B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
        $this->DataSource->archivo->SetValue($this->archivo->GetValue(true));
        $this->DataSource->nom_valor_enviar->SetValue($this->nom_valor_enviar->GetValue(true));
        $this->DataSource->resultado_id->SetValue($this->resultado_id->GetValue(true));
        $this->DataSource->test_id->SetValue($this->test_id->GetValue(true));
        $this->DataSource->s_peticion_id->SetValue($this->s_peticion_id->GetValue(true));
        $this->DataSource->muestra_id->SetValue($this->muestra_id->GetValue(true));
        $this->DataSource->estado_id->SetValue($this->estado_id->GetValue(true));
        $this->DataSource->fecha_creacion->SetValue($this->fecha_creacion->GetValue(true));
        $this->DataSource->hora_creacion->SetValue($this->hora_creacion->GetValue(true));
        $this->DataSource->ingresado_por->SetValue($this->ingresado_por->GetValue(true));
        $this->DataSource->pagina->SetValue($this->pagina->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        if($this->DataSource->Errors->Count() == 0) {
            $this->archivo->Move();
        }
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-621E8AAC
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
                if(!$this->FormSubmitted){
                    $this->valor->SetValue($this->DataSource->valor->GetValue());
                    $this->archivo->SetValue($this->DataSource->archivo->GetValue());
                    $this->resultado_id->SetValue($this->DataSource->resultado_id->GetValue());
                    $this->test_id->SetValue($this->DataSource->test_id->GetValue());
                    $this->s_peticion_id->SetValue($this->DataSource->s_peticion_id->GetValue());
                    $this->muestra_id->SetValue($this->DataSource->muestra_id->GetValue());
                    $this->estado_id->SetValue($this->DataSource->estado_id->GetValue());
                    $this->fecha_creacion->SetValue($this->DataSource->fecha_creacion->GetValue());
                    $this->hora_creacion->SetValue($this->DataSource->hora_creacion->GetValue());
                    $this->ingresado_por->SetValue($this->DataSource->ingresado_por->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->valor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->archivo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_valor_enviar->Errors->ToString());
            $Error = ComposeStrings($Error, $this->resultado_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->test_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->muestra_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->estado_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha_creacion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->hora_creacion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ingresado_por->Errors->ToString());
            $Error = ComposeStrings($Error, $this->pagina->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->valor->Show();
        $this->archivo->Show();
        $this->nom_valor_enviar->Show();
        $this->resultado_id->Show();
        $this->test_id->Show();
        $this->s_peticion_id->Show();
        $this->muestra_id->Show();
        $this->estado_id->Show();
        $this->fecha_creacion->Show();
        $this->hora_creacion->Show();
        $this->ingresado_por->Show();
        $this->pagina->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End resultados Class @2-FCB6E20C

class clsresultadosDataSource extends clsDBDatos {  //resultadosDataSource Class @2-3B02F926

//DataSource Variables @2-E17DEF0B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $valor;
    public $archivo;
    public $nom_valor_enviar;
    public $resultado_id;
    public $test_id;
    public $s_peticion_id;
    public $muestra_id;
    public $estado_id;
    public $fecha_creacion;
    public $hora_creacion;
    public $ingresado_por;
    public $pagina;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-A0BF6512
    function clsresultadosDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record resultados/Error";
        $this->Initialize();
        $this->valor = new clsField("valor", ccsText, "");
        
        $this->archivo = new clsField("archivo", ccsText, "");
        
        $this->nom_valor_enviar = new clsField("nom_valor_enviar", ccsText, "");
        
        $this->resultado_id = new clsField("resultado_id", ccsInteger, "");
        
        $this->test_id = new clsField("test_id", ccsInteger, "");
        
        $this->s_peticion_id = new clsField("s_peticion_id", ccsInteger, "");
        
        $this->muestra_id = new clsField("muestra_id", ccsText, "");
        
        $this->estado_id = new clsField("estado_id", ccsInteger, "");
        
        $this->fecha_creacion = new clsField("fecha_creacion", ccsText, "");
        
        $this->hora_creacion = new clsField("hora_creacion", ccsText, "");
        
        $this->ingresado_por = new clsField("ingresado_por", ccsInteger, "");
        
        $this->pagina = new clsField("pagina", ccsText, "");
        

        $this->InsertFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["archivo"] = array("Name" => "archivo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["resultado_id"] = array("Name" => "resultado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["peticion_id"] = array("Name" => "peticion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["muestra_id"] = array("Name" => "muestra_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["fecha_creacion"] = array("Name" => "fecha_creacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["hora_creacion"] = array("Name" => "hora_creacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ingresado_por"] = array("Name" => "ingresado_por", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["archivo"] = array("Name" => "archivo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["resultado_id"] = array("Name" => "resultado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["test_id"] = array("Name" => "test_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["peticion_id"] = array("Name" => "peticion_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["muestra_id"] = array("Name" => "muestra_id", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["estado_id"] = array("Name" => "estado_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["fecha_creacion"] = array("Name" => "fecha_creacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["hora_creacion"] = array("Name" => "hora_creacion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ingresado_por"] = array("Name" => "ingresado_por", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-83D5E209
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlresultado_id", ccsInteger, "", "", $this->Parameters["urlresultado_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "resultado_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-92D7FC98
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM resultados {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-532AA6DF
    function SetValues()
    {
        $this->valor->SetDBValue($this->f("valor"));
        $this->archivo->SetDBValue($this->f("archivo"));
        $this->resultado_id->SetDBValue(trim($this->f("resultado_id")));
        $this->test_id->SetDBValue(trim($this->f("test_id")));
        $this->s_peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->muestra_id->SetDBValue($this->f("muestra_id"));
        $this->estado_id->SetDBValue(trim($this->f("estado_id")));
        $this->fecha_creacion->SetDBValue($this->f("fecha_creacion"));
        $this->hora_creacion->SetDBValue($this->f("hora_creacion"));
        $this->ingresado_por->SetDBValue(trim($this->f("ingresado_por")));
    }
//End SetValues Method

//Insert Method @2-AA34071E
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["valor"]["Value"] = $this->valor->GetDBValue(true);
        $this->InsertFields["archivo"]["Value"] = $this->archivo->GetDBValue(true);
        $this->InsertFields["resultado_id"]["Value"] = $this->resultado_id->GetDBValue(true);
        $this->InsertFields["test_id"]["Value"] = $this->test_id->GetDBValue(true);
        $this->InsertFields["peticion_id"]["Value"] = $this->s_peticion_id->GetDBValue(true);
        $this->InsertFields["muestra_id"]["Value"] = $this->muestra_id->GetDBValue(true);
        $this->InsertFields["estado_id"]["Value"] = $this->estado_id->GetDBValue(true);
        $this->InsertFields["fecha_creacion"]["Value"] = $this->fecha_creacion->GetDBValue(true);
        $this->InsertFields["hora_creacion"]["Value"] = $this->hora_creacion->GetDBValue(true);
        $this->InsertFields["ingresado_por"]["Value"] = $this->ingresado_por->GetDBValue(true);
        $this->SQL = CCBuildInsert("resultados", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-D41D0C72
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["valor"]["Value"] = $this->valor->GetDBValue(true);
        $this->UpdateFields["archivo"]["Value"] = $this->archivo->GetDBValue(true);
        $this->UpdateFields["resultado_id"]["Value"] = $this->resultado_id->GetDBValue(true);
        $this->UpdateFields["test_id"]["Value"] = $this->test_id->GetDBValue(true);
        $this->UpdateFields["peticion_id"]["Value"] = $this->s_peticion_id->GetDBValue(true);
        $this->UpdateFields["muestra_id"]["Value"] = $this->muestra_id->GetDBValue(true);
        $this->UpdateFields["estado_id"]["Value"] = $this->estado_id->GetDBValue(true);
        $this->UpdateFields["fecha_creacion"]["Value"] = $this->fecha_creacion->GetDBValue(true);
        $this->UpdateFields["hora_creacion"]["Value"] = $this->hora_creacion->GetDBValue(true);
        $this->UpdateFields["ingresado_por"]["Value"] = $this->ingresado_por->GetDBValue(true);
        $this->SQL = CCBuildUpdate("resultados", $this->UpdateFields, $this);
        $this->SQL .= strlen($this->Where) ? " WHERE " . $this->Where : $this->Where;
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End resultadosDataSource Class @2-FCB6E20C

//Initialize Page @1-6E2F886C
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
$TemplateFileName = "add_resultado_imagen.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-80AF1378
CCSecurityRedirect("5;11;12;13;14;15;16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-56EE955C
include_once("./add_resultado_imagen_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8DC88338
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$resultados = new clsRecordresultados("", $MainPage);
$MainPage->resultados = & $resultados;
$resultados->Initialize();
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

//Execute Components @1-0886C1D8
$resultados->Operation();
//End Execute Components

//Go to destination page @1-7E67E1E4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($resultados);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-305F0FBC
$resultados->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-67ED208F
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($resultados);
unset($Tpl);
//End Unload Page


?>
