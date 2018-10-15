<?php
//Include Common Files @1-73440969
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "add_pago_peticion.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecorddetalle_pago { //detalle_pago Class @2-6D4BC002

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

//Class_Initialize Event @2-462CA328
    function clsRecorddetalle_pago($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record detalle_pago/Error";
        $this->DataSource = new clsdetalle_pagoDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "detalle_pago";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->paciente = new clsControl(ccsLabel, "paciente", "paciente", ccsText, "", CCGetRequestParam("paciente", $Method, NULL), $this);
            $this->paciente->HTML = true;
            $this->lb_peticion_id = new clsControl(ccsLabel, "lb_peticion_id", "lb_peticion_id", ccsText, "", CCGetRequestParam("lb_peticion_id", $Method, NULL), $this);
            $this->lb_peticion_id->HTML = true;
            $this->forma_pago_id = new clsControl(ccsListBox, "forma_pago_id", "Forma de Pago", ccsInteger, "", CCGetRequestParam("forma_pago_id", $Method, NULL), $this);
            $this->forma_pago_id->DSType = dsTable;
            $this->forma_pago_id->DataSource = new clsDBDatos();
            $this->forma_pago_id->ds = & $this->forma_pago_id->DataSource;
            $this->forma_pago_id->DataSource->SQL = "SELECT * \n" .
"FROM formas_pago {SQL_Where} {SQL_OrderBy}";
            $this->forma_pago_id->DataSource->Order = "nom_forma_pago";
            list($this->forma_pago_id->BoundColumn, $this->forma_pago_id->TextColumn, $this->forma_pago_id->DBFormat) = array("forma_pago_id", "nom_forma_pago", "");
            $this->forma_pago_id->DataSource->Order = "nom_forma_pago";
            $this->forma_pago_id->Required = true;
            $this->fecha_documento = new clsControl(ccsTextBox, "fecha_documento", "Fecha", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha_documento", $Method, NULL), $this);
            $this->fecha_documento->Required = true;
            $this->nom_banco = new clsControl(ccsListBox, "nom_banco", "Banco", ccsText, "", CCGetRequestParam("nom_banco", $Method, NULL), $this);
            $this->nom_banco->DSType = dsTable;
            $this->nom_banco->DataSource = new clsDBDatos();
            $this->nom_banco->ds = & $this->nom_banco->DataSource;
            $this->nom_banco->DataSource->SQL = "SELECT * \n" .
"FROM bancos {SQL_Where} {SQL_OrderBy}";
            $this->nom_banco->DataSource->Order = "nom_banco";
            list($this->nom_banco->BoundColumn, $this->nom_banco->TextColumn, $this->nom_banco->DBFormat) = array("banco_id", "nom_banco", "");
            $this->nom_banco->DataSource->Order = "nom_banco";
            $this->user_id = new clsControl(ccsHidden, "user_id", "user_id", ccsInteger, "", CCGetRequestParam("user_id", $Method, NULL), $this);
            $this->prevision_id = new clsControl(ccsListBox, "prevision_id", "Previsión", ccsInteger, "", CCGetRequestParam("prevision_id", $Method, NULL), $this);
            $this->prevision_id->DSType = dsTable;
            $this->prevision_id->DataSource = new clsDBDatos();
            $this->prevision_id->ds = & $this->prevision_id->DataSource;
            $this->prevision_id->DataSource->SQL = "SELECT * \n" .
"FROM previsiones {SQL_Where} {SQL_OrderBy}";
            $this->prevision_id->DataSource->Order = "nom_prevision";
            list($this->prevision_id->BoundColumn, $this->prevision_id->TextColumn, $this->prevision_id->DBFormat) = array("prevision_id", "nom_prevision", "");
            $this->prevision_id->DataSource->Parameters["urlactivo"] = CCGetFromGet("activo", NULL);
            $this->prevision_id->DataSource->wp = new clsSQLParameters();
            $this->prevision_id->DataSource->wp->AddParameter("1", "urlactivo", ccsText, "", "", $this->prevision_id->DataSource->Parameters["urlactivo"], 'V', false);
            $this->prevision_id->DataSource->wp->Criterion[1] = $this->prevision_id->DataSource->wp->Operation(opEqual, "activo", $this->prevision_id->DataSource->wp->GetDBValue("1"), $this->prevision_id->DataSource->ToSQL($this->prevision_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->prevision_id->DataSource->Where = 
                 $this->prevision_id->DataSource->wp->Criterion[1];
            $this->prevision_id->DataSource->Order = "nom_prevision";
            $this->num_cheque_bono = new clsControl(ccsTextBox, "num_cheque_bono", "Nº Documento", ccsText, "", CCGetRequestParam("num_cheque_bono", $Method, NULL), $this);
            $this->num_cheque_bono->Required = true;
            $this->peticion_id = new clsControl(ccsHidden, "peticion_id", "Peticion Id", ccsInteger, "", CCGetRequestParam("peticion_id", $Method, NULL), $this);
            $this->max_valor = new clsControl(ccsHidden, "max_valor", "max_valor", ccsInteger, "", CCGetRequestParam("max_valor", $Method, NULL), $this);
            $this->fecha_ingreso = new clsControl(ccsHidden, "fecha_ingreso", "fecha_ingreso", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "HH", ":", "nn", ":", "ss"), CCGetRequestParam("fecha_ingreso", $Method, NULL), $this);
            $this->valor = new clsControl(ccsTextBox, "valor", "Valor", ccsInteger, "", CCGetRequestParam("valor", $Method, NULL), $this);
            $this->valor->Required = true;
            $this->lb_max_valor = new clsControl(ccsLabel, "lb_max_valor", "lb_max_valor", ccsText, "", CCGetRequestParam("lb_max_valor", $Method, NULL), $this);
            $this->lb_max_valor->HTML = true;
            $this->detalle_pago_id = new clsControl(ccsHidden, "detalle_pago_id", "Id", ccsInteger, "", CCGetRequestParam("detalle_pago_id", $Method, NULL), $this);
            $this->max_valor_actual = new clsControl(ccsHidden, "max_valor_actual", "max_valor_actual", ccsInteger, "", CCGetRequestParam("max_valor_actual", $Method, NULL), $this);
            $this->observacion = new clsControl(ccsTextArea, "observacion", "observacion", ccsText, "", CCGetRequestParam("observacion", $Method, NULL), $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->fecha_documento->Value) && !strlen($this->fecha_documento->Value) && $this->fecha_documento->Value !== false)
                    $this->fecha_documento->SetValue(time());
                if(!is_array($this->user_id->Value) && !strlen($this->user_id->Value) && $this->user_id->Value !== false)
                    $this->user_id->SetText(CCGetUserID());
                if(!is_array($this->fecha_ingreso->Value) && !strlen($this->fecha_ingreso->Value) && $this->fecha_ingreso->Value !== false)
                    $this->fecha_ingreso->SetValue(time());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-559FB87D
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urldetalle_pago_id"] = CCGetFromGet("detalle_pago_id", NULL);
    }
//End Initialize Method

//Validate Method @2-00918E51
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->forma_pago_id->Validate() && $Validation);
        $Validation = ($this->fecha_documento->Validate() && $Validation);
        $Validation = ($this->nom_banco->Validate() && $Validation);
        $Validation = ($this->user_id->Validate() && $Validation);
        $Validation = ($this->prevision_id->Validate() && $Validation);
        $Validation = ($this->num_cheque_bono->Validate() && $Validation);
        $Validation = ($this->peticion_id->Validate() && $Validation);
        $Validation = ($this->max_valor->Validate() && $Validation);
        $Validation = ($this->fecha_ingreso->Validate() && $Validation);
        $Validation = ($this->valor->Validate() && $Validation);
        $Validation = ($this->detalle_pago_id->Validate() && $Validation);
        $Validation = ($this->max_valor_actual->Validate() && $Validation);
        $Validation = ($this->observacion->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->forma_pago_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha_documento->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_banco->Errors->Count() == 0);
        $Validation =  $Validation && ($this->user_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->prevision_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->num_cheque_bono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->peticion_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->max_valor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha_ingreso->Errors->Count() == 0);
        $Validation =  $Validation && ($this->valor->Errors->Count() == 0);
        $Validation =  $Validation && ($this->detalle_pago_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->max_valor_actual->Errors->Count() == 0);
        $Validation =  $Validation && ($this->observacion->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-035B3202
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->paciente->Errors->Count());
        $errors = ($errors || $this->lb_peticion_id->Errors->Count());
        $errors = ($errors || $this->forma_pago_id->Errors->Count());
        $errors = ($errors || $this->fecha_documento->Errors->Count());
        $errors = ($errors || $this->nom_banco->Errors->Count());
        $errors = ($errors || $this->user_id->Errors->Count());
        $errors = ($errors || $this->prevision_id->Errors->Count());
        $errors = ($errors || $this->num_cheque_bono->Errors->Count());
        $errors = ($errors || $this->peticion_id->Errors->Count());
        $errors = ($errors || $this->max_valor->Errors->Count());
        $errors = ($errors || $this->fecha_ingreso->Errors->Count());
        $errors = ($errors || $this->valor->Errors->Count());
        $errors = ($errors || $this->lb_max_valor->Errors->Count());
        $errors = ($errors || $this->detalle_pago_id->Errors->Count());
        $errors = ($errors || $this->max_valor_actual->Errors->Count());
        $errors = ($errors || $this->observacion->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-553B7771
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

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            } else if($this->Button_Cancel->Pressed) {
                $this->PressedButton = "Button_Cancel";
            }
        }
        $Redirect = "add_pago_peticion.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "list_pago_peticion.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "list_pago_peticion.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "list_pago_peticion.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "list_pago_peticion.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-747F48FB
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->forma_pago_id->SetValue($this->forma_pago_id->GetValue(true));
        $this->DataSource->fecha_documento->SetValue($this->fecha_documento->GetValue(true));
        $this->DataSource->nom_banco->SetValue($this->nom_banco->GetValue(true));
        $this->DataSource->prevision_id->SetValue($this->prevision_id->GetValue(true));
        $this->DataSource->num_cheque_bono->SetValue($this->num_cheque_bono->GetValue(true));
        $this->DataSource->peticion_id->SetValue($this->peticion_id->GetValue(true));
        $this->DataSource->fecha_ingreso->SetValue($this->fecha_ingreso->GetValue(true));
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
        $this->DataSource->detalle_pago_id->SetValue($this->detalle_pago_id->GetValue(true));
        $this->DataSource->observacion->SetValue($this->observacion->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-EBA0756C
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->forma_pago_id->SetValue($this->forma_pago_id->GetValue(true));
        $this->DataSource->fecha_documento->SetValue($this->fecha_documento->GetValue(true));
        $this->DataSource->nom_banco->SetValue($this->nom_banco->GetValue(true));
        $this->DataSource->prevision_id->SetValue($this->prevision_id->GetValue(true));
        $this->DataSource->num_cheque_bono->SetValue($this->num_cheque_bono->GetValue(true));
        $this->DataSource->peticion_id->SetValue($this->peticion_id->GetValue(true));
        $this->DataSource->fecha_ingreso->SetValue($this->fecha_ingreso->GetValue(true));
        $this->DataSource->valor->SetValue($this->valor->GetValue(true));
        $this->DataSource->detalle_pago_id->SetValue($this->detalle_pago_id->GetValue(true));
        $this->DataSource->observacion->SetValue($this->observacion->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-1A21F4BF
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

        $this->forma_pago_id->Prepare();
        $this->nom_banco->Prepare();
        $this->prevision_id->Prepare();

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
                    $this->forma_pago_id->SetValue($this->DataSource->forma_pago_id->GetValue());
                    $this->fecha_documento->SetValue($this->DataSource->fecha_documento->GetValue());
                    $this->nom_banco->SetValue($this->DataSource->nom_banco->GetValue());
                    $this->prevision_id->SetValue($this->DataSource->prevision_id->GetValue());
                    $this->num_cheque_bono->SetValue($this->DataSource->num_cheque_bono->GetValue());
                    $this->peticion_id->SetValue($this->DataSource->peticion_id->GetValue());
                    $this->fecha_ingreso->SetValue($this->DataSource->fecha_ingreso->GetValue());
                    $this->valor->SetValue($this->DataSource->valor->GetValue());
                    $this->detalle_pago_id->SetValue($this->DataSource->detalle_pago_id->GetValue());
                    $this->observacion->SetValue($this->DataSource->observacion->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->paciente->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lb_peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->forma_pago_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha_documento->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_banco->Errors->ToString());
            $Error = ComposeStrings($Error, $this->user_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->prevision_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->num_cheque_bono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->peticion_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->max_valor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha_ingreso->Errors->ToString());
            $Error = ComposeStrings($Error, $this->valor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lb_max_valor->Errors->ToString());
            $Error = ComposeStrings($Error, $this->detalle_pago_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->max_valor_actual->Errors->ToString());
            $Error = ComposeStrings($Error, $this->observacion->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->paciente->Show();
        $this->lb_peticion_id->Show();
        $this->forma_pago_id->Show();
        $this->fecha_documento->Show();
        $this->nom_banco->Show();
        $this->user_id->Show();
        $this->prevision_id->Show();
        $this->num_cheque_bono->Show();
        $this->peticion_id->Show();
        $this->max_valor->Show();
        $this->fecha_ingreso->Show();
        $this->valor->Show();
        $this->lb_max_valor->Show();
        $this->detalle_pago_id->Show();
        $this->max_valor_actual->Show();
        $this->observacion->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End detalle_pago Class @2-FCB6E20C

class clsdetalle_pagoDataSource extends clsDBDatos {  //detalle_pagoDataSource Class @2-85BEA3BC

//DataSource Variables @2-73598958
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $paciente;
    public $lb_peticion_id;
    public $forma_pago_id;
    public $fecha_documento;
    public $nom_banco;
    public $user_id;
    public $prevision_id;
    public $num_cheque_bono;
    public $peticion_id;
    public $max_valor;
    public $fecha_ingreso;
    public $valor;
    public $lb_max_valor;
    public $detalle_pago_id;
    public $max_valor_actual;
    public $observacion;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-90B6C804
    function clsdetalle_pagoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record detalle_pago/Error";
        $this->Initialize();
        $this->paciente = new clsField("paciente", ccsText, "");
        
        $this->lb_peticion_id = new clsField("lb_peticion_id", ccsText, "");
        
        $this->forma_pago_id = new clsField("forma_pago_id", ccsInteger, "");
        
        $this->fecha_documento = new clsField("fecha_documento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nom_banco = new clsField("nom_banco", ccsText, "");
        
        $this->user_id = new clsField("user_id", ccsInteger, "");
        
        $this->prevision_id = new clsField("prevision_id", ccsInteger, "");
        
        $this->num_cheque_bono = new clsField("num_cheque_bono", ccsText, "");
        
        $this->peticion_id = new clsField("peticion_id", ccsInteger, "");
        
        $this->max_valor = new clsField("max_valor", ccsInteger, "");
        
        $this->fecha_ingreso = new clsField("fecha_ingreso", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->valor = new clsField("valor", ccsInteger, "");
        
        $this->lb_max_valor = new clsField("lb_max_valor", ccsText, "");
        
        $this->detalle_pago_id = new clsField("detalle_pago_id", ccsInteger, "");
        
        $this->max_valor_actual = new clsField("max_valor_actual", ccsInteger, "");
        
        $this->observacion = new clsField("observacion", ccsText, "");
        

        $this->InsertFields["forma_pago_id"] = array("Name" => "forma_pago_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["fecha_documento"] = array("Name" => "fecha_documento", "Value" => "", "DataType" => ccsDate);
        $this->InsertFields["banco_id"] = array("Name" => "banco_id", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["prevision_id"] = array("Name" => "prevision_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["num_cheque_bono"] = array("Name" => "num_cheque_bono", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["peticion_id"] = array("Name" => "peticion_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["fecha_ingreso"] = array("Name" => "fecha_ingreso", "Value" => "", "DataType" => ccsDate);
        $this->InsertFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["detalle_pago_id"] = array("Name" => "detalle_pago_id", "Value" => "", "DataType" => ccsInteger);
        $this->InsertFields["observacion"] = array("Name" => "observacion", "Value" => "", "DataType" => ccsText);
        $this->InsertFields["usuario_id"] = array("Name" => "usuario_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["forma_pago_id"] = array("Name" => "forma_pago_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["fecha_documento"] = array("Name" => "fecha_documento", "Value" => "", "DataType" => ccsDate);
        $this->UpdateFields["banco_id"] = array("Name" => "banco_id", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["prevision_id"] = array("Name" => "prevision_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["num_cheque_bono"] = array("Name" => "num_cheque_bono", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["peticion_id"] = array("Name" => "peticion_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["fecha_ingreso"] = array("Name" => "fecha_ingreso", "Value" => "", "DataType" => ccsDate);
        $this->UpdateFields["valor"] = array("Name" => "valor", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["detalle_pago_id"] = array("Name" => "detalle_pago_id", "Value" => "", "DataType" => ccsInteger);
        $this->UpdateFields["observacion"] = array("Name" => "observacion", "Value" => "", "DataType" => ccsText);
        $this->UpdateFields["usuario_id"] = array("Name" => "usuario_id", "Value" => "", "DataType" => ccsInteger);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-46BA6C90
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urldetalle_pago_id", ccsInteger, "", "", $this->Parameters["urldetalle_pago_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "detalle_pago_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-D3F06D05
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM detalle_pago {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-C92319B2
    function SetValues()
    {
        $this->forma_pago_id->SetDBValue(trim($this->f("forma_pago_id")));
        $this->fecha_documento->SetDBValue(trim($this->f("fecha_documento")));
        $this->nom_banco->SetDBValue($this->f("banco_id"));
        $this->prevision_id->SetDBValue(trim($this->f("prevision_id")));
        $this->num_cheque_bono->SetDBValue($this->f("num_cheque_bono"));
        $this->peticion_id->SetDBValue(trim($this->f("peticion_id")));
        $this->fecha_ingreso->SetDBValue(trim($this->f("fecha_ingreso")));
        $this->valor->SetDBValue(trim($this->f("valor")));
        $this->detalle_pago_id->SetDBValue(trim($this->f("detalle_pago_id")));
        $this->observacion->SetDBValue($this->f("observacion"));
    }
//End SetValues Method

//Insert Method @2-27F594D9
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["forma_pago_id"] = new clsSQLParameter("ctrlforma_pago_id", ccsInteger, "", "", $this->forma_pago_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fecha_documento"] = new clsSQLParameter("ctrlfecha_documento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->fecha_documento->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["banco_id"] = new clsSQLParameter("ctrlnom_banco", ccsText, "", "", $this->nom_banco->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["prevision_id"] = new clsSQLParameter("ctrlprevision_id", ccsInteger, "", "", $this->prevision_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["num_cheque_bono"] = new clsSQLParameter("ctrlnum_cheque_bono", ccsText, "", "", $this->num_cheque_bono->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["peticion_id"] = new clsSQLParameter("ctrlpeticion_id", ccsInteger, "", "", $this->peticion_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fecha_ingreso"] = new clsSQLParameter("ctrlfecha_ingreso", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "HH", ":", "nn", ":", "ss"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->fecha_ingreso->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor"] = new clsSQLParameter("ctrlvalor", ccsInteger, "", "", $this->valor->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["detalle_pago_id"] = new clsSQLParameter("ctrldetalle_pago_id", ccsInteger, "", "", $this->detalle_pago_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["observacion"] = new clsSQLParameter("ctrlobservacion", ccsText, "", "", $this->observacion->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["usuario_id"] = new clsSQLParameter("expr110", ccsInteger, "", "", CCGetUserID(), "", false, $this->ErrorBlock);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        if (!is_null($this->cp["forma_pago_id"]->GetValue()) and !strlen($this->cp["forma_pago_id"]->GetText()) and !is_bool($this->cp["forma_pago_id"]->GetValue())) 
            $this->cp["forma_pago_id"]->SetValue($this->forma_pago_id->GetValue(true));
        if (!is_null($this->cp["fecha_documento"]->GetValue()) and !strlen($this->cp["fecha_documento"]->GetText()) and !is_bool($this->cp["fecha_documento"]->GetValue())) 
            $this->cp["fecha_documento"]->SetValue($this->fecha_documento->GetValue(true));
        if (!is_null($this->cp["banco_id"]->GetValue()) and !strlen($this->cp["banco_id"]->GetText()) and !is_bool($this->cp["banco_id"]->GetValue())) 
            $this->cp["banco_id"]->SetValue($this->nom_banco->GetValue(true));
        if (!is_null($this->cp["prevision_id"]->GetValue()) and !strlen($this->cp["prevision_id"]->GetText()) and !is_bool($this->cp["prevision_id"]->GetValue())) 
            $this->cp["prevision_id"]->SetValue($this->prevision_id->GetValue(true));
        if (!is_null($this->cp["num_cheque_bono"]->GetValue()) and !strlen($this->cp["num_cheque_bono"]->GetText()) and !is_bool($this->cp["num_cheque_bono"]->GetValue())) 
            $this->cp["num_cheque_bono"]->SetValue($this->num_cheque_bono->GetValue(true));
        if (!is_null($this->cp["peticion_id"]->GetValue()) and !strlen($this->cp["peticion_id"]->GetText()) and !is_bool($this->cp["peticion_id"]->GetValue())) 
            $this->cp["peticion_id"]->SetValue($this->peticion_id->GetValue(true));
        if (!is_null($this->cp["fecha_ingreso"]->GetValue()) and !strlen($this->cp["fecha_ingreso"]->GetText()) and !is_bool($this->cp["fecha_ingreso"]->GetValue())) 
            $this->cp["fecha_ingreso"]->SetValue($this->fecha_ingreso->GetValue(true));
        if (!is_null($this->cp["valor"]->GetValue()) and !strlen($this->cp["valor"]->GetText()) and !is_bool($this->cp["valor"]->GetValue())) 
            $this->cp["valor"]->SetValue($this->valor->GetValue(true));
        if (!is_null($this->cp["detalle_pago_id"]->GetValue()) and !strlen($this->cp["detalle_pago_id"]->GetText()) and !is_bool($this->cp["detalle_pago_id"]->GetValue())) 
            $this->cp["detalle_pago_id"]->SetValue($this->detalle_pago_id->GetValue(true));
        if (!is_null($this->cp["observacion"]->GetValue()) and !strlen($this->cp["observacion"]->GetText()) and !is_bool($this->cp["observacion"]->GetValue())) 
            $this->cp["observacion"]->SetValue($this->observacion->GetValue(true));
        if (!is_null($this->cp["usuario_id"]->GetValue()) and !strlen($this->cp["usuario_id"]->GetText()) and !is_bool($this->cp["usuario_id"]->GetValue())) 
            $this->cp["usuario_id"]->SetValue(CCGetUserID());
        $this->InsertFields["forma_pago_id"]["Value"] = $this->cp["forma_pago_id"]->GetDBValue(true);
        $this->InsertFields["fecha_documento"]["Value"] = $this->cp["fecha_documento"]->GetDBValue(true);
        $this->InsertFields["banco_id"]["Value"] = $this->cp["banco_id"]->GetDBValue(true);
        $this->InsertFields["prevision_id"]["Value"] = $this->cp["prevision_id"]->GetDBValue(true);
        $this->InsertFields["num_cheque_bono"]["Value"] = $this->cp["num_cheque_bono"]->GetDBValue(true);
        $this->InsertFields["peticion_id"]["Value"] = $this->cp["peticion_id"]->GetDBValue(true);
        $this->InsertFields["fecha_ingreso"]["Value"] = $this->cp["fecha_ingreso"]->GetDBValue(true);
        $this->InsertFields["valor"]["Value"] = $this->cp["valor"]->GetDBValue(true);
        $this->InsertFields["detalle_pago_id"]["Value"] = $this->cp["detalle_pago_id"]->GetDBValue(true);
        $this->InsertFields["observacion"]["Value"] = $this->cp["observacion"]->GetDBValue(true);
        $this->InsertFields["usuario_id"]["Value"] = $this->cp["usuario_id"]->GetDBValue(true);
        $this->SQL = CCBuildInsert("detalle_pago", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-894E0A3B
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->cp["forma_pago_id"] = new clsSQLParameter("ctrlforma_pago_id", ccsInteger, "", "", $this->forma_pago_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fecha_documento"] = new clsSQLParameter("ctrlfecha_documento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->fecha_documento->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["banco_id"] = new clsSQLParameter("ctrlnom_banco", ccsText, "", "", $this->nom_banco->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["prevision_id"] = new clsSQLParameter("ctrlprevision_id", ccsInteger, "", "", $this->prevision_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["num_cheque_bono"] = new clsSQLParameter("ctrlnum_cheque_bono", ccsText, "", "", $this->num_cheque_bono->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["peticion_id"] = new clsSQLParameter("ctrlpeticion_id", ccsInteger, "", "", $this->peticion_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["fecha_ingreso"] = new clsSQLParameter("ctrlfecha_ingreso", ccsDate, array("dd", "/", "mm", "/", "yyyy", " ", "HH", ":", "nn", ":", "ss"), array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"), $this->fecha_ingreso->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["valor"] = new clsSQLParameter("ctrlvalor", ccsInteger, "", "", $this->valor->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["detalle_pago_id"] = new clsSQLParameter("ctrldetalle_pago_id", ccsInteger, "", "", $this->detalle_pago_id->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["observacion"] = new clsSQLParameter("ctrlobservacion", ccsText, "", "", $this->observacion->GetValue(true), "", false, $this->ErrorBlock);
        $this->cp["usuario_id"] = new clsSQLParameter("expr124", ccsInteger, "", "", CCGetUserID(), "", false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urldetalle_pago_id", ccsInteger, "", "", CCGetFromGet("detalle_pago_id", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["forma_pago_id"]->GetValue()) and !strlen($this->cp["forma_pago_id"]->GetText()) and !is_bool($this->cp["forma_pago_id"]->GetValue())) 
            $this->cp["forma_pago_id"]->SetValue($this->forma_pago_id->GetValue(true));
        if (!is_null($this->cp["fecha_documento"]->GetValue()) and !strlen($this->cp["fecha_documento"]->GetText()) and !is_bool($this->cp["fecha_documento"]->GetValue())) 
            $this->cp["fecha_documento"]->SetValue($this->fecha_documento->GetValue(true));
        if (!is_null($this->cp["banco_id"]->GetValue()) and !strlen($this->cp["banco_id"]->GetText()) and !is_bool($this->cp["banco_id"]->GetValue())) 
            $this->cp["banco_id"]->SetValue($this->nom_banco->GetValue(true));
        if (!is_null($this->cp["prevision_id"]->GetValue()) and !strlen($this->cp["prevision_id"]->GetText()) and !is_bool($this->cp["prevision_id"]->GetValue())) 
            $this->cp["prevision_id"]->SetValue($this->prevision_id->GetValue(true));
        if (!is_null($this->cp["num_cheque_bono"]->GetValue()) and !strlen($this->cp["num_cheque_bono"]->GetText()) and !is_bool($this->cp["num_cheque_bono"]->GetValue())) 
            $this->cp["num_cheque_bono"]->SetValue($this->num_cheque_bono->GetValue(true));
        if (!is_null($this->cp["peticion_id"]->GetValue()) and !strlen($this->cp["peticion_id"]->GetText()) and !is_bool($this->cp["peticion_id"]->GetValue())) 
            $this->cp["peticion_id"]->SetValue($this->peticion_id->GetValue(true));
        if (!is_null($this->cp["fecha_ingreso"]->GetValue()) and !strlen($this->cp["fecha_ingreso"]->GetText()) and !is_bool($this->cp["fecha_ingreso"]->GetValue())) 
            $this->cp["fecha_ingreso"]->SetValue($this->fecha_ingreso->GetValue(true));
        if (!is_null($this->cp["valor"]->GetValue()) and !strlen($this->cp["valor"]->GetText()) and !is_bool($this->cp["valor"]->GetValue())) 
            $this->cp["valor"]->SetValue($this->valor->GetValue(true));
        if (!is_null($this->cp["detalle_pago_id"]->GetValue()) and !strlen($this->cp["detalle_pago_id"]->GetText()) and !is_bool($this->cp["detalle_pago_id"]->GetValue())) 
            $this->cp["detalle_pago_id"]->SetValue($this->detalle_pago_id->GetValue(true));
        if (!is_null($this->cp["observacion"]->GetValue()) and !strlen($this->cp["observacion"]->GetText()) and !is_bool($this->cp["observacion"]->GetValue())) 
            $this->cp["observacion"]->SetValue($this->observacion->GetValue(true));
        if (!is_null($this->cp["usuario_id"]->GetValue()) and !strlen($this->cp["usuario_id"]->GetText()) and !is_bool($this->cp["usuario_id"]->GetValue())) 
            $this->cp["usuario_id"]->SetValue(CCGetUserID());
        $wp->Criterion[1] = $wp->Operation(opEqual, "detalle_pago_id", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["forma_pago_id"]["Value"] = $this->cp["forma_pago_id"]->GetDBValue(true);
        $this->UpdateFields["fecha_documento"]["Value"] = $this->cp["fecha_documento"]->GetDBValue(true);
        $this->UpdateFields["banco_id"]["Value"] = $this->cp["banco_id"]->GetDBValue(true);
        $this->UpdateFields["prevision_id"]["Value"] = $this->cp["prevision_id"]->GetDBValue(true);
        $this->UpdateFields["num_cheque_bono"]["Value"] = $this->cp["num_cheque_bono"]->GetDBValue(true);
        $this->UpdateFields["peticion_id"]["Value"] = $this->cp["peticion_id"]->GetDBValue(true);
        $this->UpdateFields["fecha_ingreso"]["Value"] = $this->cp["fecha_ingreso"]->GetDBValue(true);
        $this->UpdateFields["valor"]["Value"] = $this->cp["valor"]->GetDBValue(true);
        $this->UpdateFields["detalle_pago_id"]["Value"] = $this->cp["detalle_pago_id"]->GetDBValue(true);
        $this->UpdateFields["observacion"]["Value"] = $this->cp["observacion"]->GetDBValue(true);
        $this->UpdateFields["usuario_id"]["Value"] = $this->cp["usuario_id"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("detalle_pago", $this->UpdateFields, $this);
        $this->SQL .= strlen($Where) ? " WHERE " . $Where : $Where;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-C853FDF7
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM detalle_pago";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End detalle_pagoDataSource Class @2-FCB6E20C

class clsGriddetalle_pago_formas_pago { //detalle_pago_formas_pago class @37-2DEADF60

//Variables @37-F22EF636

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
    public $Sorter_fecha_ingreso;
    public $Sorter_nom_forma_pago;
    public $Sorter_nom_banco;
    public $Sorter_nom_prevision;
    public $Sorter_fecha_documento;
    public $Sorter_num_cheque_bono;
    public $Sorter_valor;
    public $Sorter_nom_usuario;
//End Variables

//Class_Initialize Event @37-2EA029BC
    function clsGriddetalle_pago_formas_pago($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "detalle_pago_formas_pago";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid detalle_pago_formas_pago";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsdetalle_pago_formas_pagoDataSource($this);
        $this->ds = & $this->DataSource;
        $this->SorterName = CCGetParam("detalle_pago_formas_pagoOrder", "");
        $this->SorterDirection = CCGetParam("detalle_pago_formas_pagoDir", "");

        $this->fecha_ingreso = new clsControl(ccsLabel, "fecha_ingreso", "fecha_ingreso", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha_ingreso", ccsGet, NULL), $this);
        $this->nom_forma_pago = new clsControl(ccsLabel, "nom_forma_pago", "nom_forma_pago", ccsText, "", CCGetRequestParam("nom_forma_pago", ccsGet, NULL), $this);
        $this->nom_banco = new clsControl(ccsLabel, "nom_banco", "nom_banco", ccsText, "", CCGetRequestParam("nom_banco", ccsGet, NULL), $this);
        $this->nom_prevision = new clsControl(ccsLabel, "nom_prevision", "nom_prevision", ccsText, "", CCGetRequestParam("nom_prevision", ccsGet, NULL), $this);
        $this->fecha_documento = new clsControl(ccsLabel, "fecha_documento", "fecha_documento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha_documento", ccsGet, NULL), $this);
        $this->num_cheque_bono = new clsControl(ccsLabel, "num_cheque_bono", "num_cheque_bono", ccsText, "", CCGetRequestParam("num_cheque_bono", ccsGet, NULL), $this);
        $this->valor = new clsControl(ccsLabel, "valor", "valor", ccsInteger, array(False, 0, Null, "", False, "\$", "", 1, True, ""), CCGetRequestParam("valor", ccsGet, NULL), $this);
        $this->nom_usuario = new clsControl(ccsLabel, "nom_usuario", "nom_usuario", ccsText, "", CCGetRequestParam("nom_usuario", ccsGet, NULL), $this);
        $this->Sorter_fecha_ingreso = new clsSorter($this->ComponentName, "Sorter_fecha_ingreso", $FileName, $this);
        $this->Sorter_nom_forma_pago = new clsSorter($this->ComponentName, "Sorter_nom_forma_pago", $FileName, $this);
        $this->Sorter_nom_banco = new clsSorter($this->ComponentName, "Sorter_nom_banco", $FileName, $this);
        $this->Sorter_nom_prevision = new clsSorter($this->ComponentName, "Sorter_nom_prevision", $FileName, $this);
        $this->Sorter_fecha_documento = new clsSorter($this->ComponentName, "Sorter_fecha_documento", $FileName, $this);
        $this->Sorter_num_cheque_bono = new clsSorter($this->ComponentName, "Sorter_num_cheque_bono", $FileName, $this);
        $this->Sorter_valor = new clsSorter($this->ComponentName, "Sorter_valor", $FileName, $this);
        $this->Sorter_nom_usuario = new clsSorter($this->ComponentName, "Sorter_nom_usuario", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @37-75D22D4D
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @37-3491EE63
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
            $this->ControlsVisible["fecha_ingreso"] = $this->fecha_ingreso->Visible;
            $this->ControlsVisible["nom_forma_pago"] = $this->nom_forma_pago->Visible;
            $this->ControlsVisible["nom_banco"] = $this->nom_banco->Visible;
            $this->ControlsVisible["nom_prevision"] = $this->nom_prevision->Visible;
            $this->ControlsVisible["fecha_documento"] = $this->fecha_documento->Visible;
            $this->ControlsVisible["num_cheque_bono"] = $this->num_cheque_bono->Visible;
            $this->ControlsVisible["valor"] = $this->valor->Visible;
            $this->ControlsVisible["nom_usuario"] = $this->nom_usuario->Visible;
            while ($this->ForceIteration ||  ($this->HasRecord = $this->DataSource->has_next_record())) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->fecha_ingreso->SetValue($this->DataSource->fecha_ingreso->GetValue());
                $this->nom_forma_pago->SetValue($this->DataSource->nom_forma_pago->GetValue());
                $this->nom_banco->SetValue($this->DataSource->nom_banco->GetValue());
                $this->nom_prevision->SetValue($this->DataSource->nom_prevision->GetValue());
                $this->fecha_documento->SetValue($this->DataSource->fecha_documento->GetValue());
                $this->num_cheque_bono->SetValue($this->DataSource->num_cheque_bono->GetValue());
                $this->valor->SetValue($this->DataSource->valor->GetValue());
                $this->nom_usuario->SetValue($this->DataSource->nom_usuario->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->fecha_ingreso->Show();
                $this->nom_forma_pago->Show();
                $this->nom_banco->Show();
                $this->nom_prevision->Show();
                $this->fecha_documento->Show();
                $this->num_cheque_bono->Show();
                $this->valor->Show();
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
        $this->Sorter_fecha_ingreso->Show();
        $this->Sorter_nom_forma_pago->Show();
        $this->Sorter_nom_banco->Show();
        $this->Sorter_nom_prevision->Show();
        $this->Sorter_fecha_documento->Show();
        $this->Sorter_num_cheque_bono->Show();
        $this->Sorter_valor->Show();
        $this->Sorter_nom_usuario->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @37-FB17EE0F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->fecha_ingreso->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_forma_pago->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_banco->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_prevision->Errors->ToString());
        $errors = ComposeStrings($errors, $this->fecha_documento->Errors->ToString());
        $errors = ComposeStrings($errors, $this->num_cheque_bono->Errors->ToString());
        $errors = ComposeStrings($errors, $this->valor->Errors->ToString());
        $errors = ComposeStrings($errors, $this->nom_usuario->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End detalle_pago_formas_pago Class @37-FCB6E20C

class clsdetalle_pago_formas_pagoDataSource extends clsDBDatos {  //detalle_pago_formas_pagoDataSource Class @37-F3DC9F54

//DataSource Variables @37-9FB9A59B
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $fecha_ingreso;
    public $nom_forma_pago;
    public $nom_banco;
    public $nom_prevision;
    public $fecha_documento;
    public $num_cheque_bono;
    public $valor;
    public $nom_usuario;
//End DataSource Variables

//DataSourceClass_Initialize Event @37-03DF46DF
    function clsdetalle_pago_formas_pagoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid detalle_pago_formas_pago";
        $this->Initialize();
        $this->fecha_ingreso = new clsField("fecha_ingreso", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->nom_forma_pago = new clsField("nom_forma_pago", ccsText, "");
        
        $this->nom_banco = new clsField("nom_banco", ccsText, "");
        
        $this->nom_prevision = new clsField("nom_prevision", ccsText, "");
        
        $this->fecha_documento = new clsField("fecha_documento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->num_cheque_bono = new clsField("num_cheque_bono", ccsText, "");
        
        $this->valor = new clsField("valor", ccsInteger, "");
        
        $this->nom_usuario = new clsField("nom_usuario", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @37-174E1D8A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_fecha_ingreso" => array("fecha_ingreso", ""), 
            "Sorter_nom_forma_pago" => array("nom_forma_pago", ""), 
            "Sorter_nom_banco" => array("nom_banco", ""), 
            "Sorter_nom_prevision" => array("nom_prevision", ""), 
            "Sorter_fecha_documento" => array("fecha_documento", ""), 
            "Sorter_num_cheque_bono" => array("num_cheque_bono", ""), 
            "Sorter_valor" => array("valor", ""), 
            "Sorter_nom_usuario" => array("nom_usuario", "")));
    }
//End SetOrder Method

//Prepare Method @37-89C31502
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpeticion_id", ccsInteger, "", "", $this->Parameters["urlpeticion_id"], 0, false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "detalle_pago.peticion_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @37-0418BACE
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((detalle_pago LEFT JOIN formas_pago ON\n\n" .
        "detalle_pago.forma_pago_id = formas_pago.forma_pago_id) LEFT JOIN usuarios ON\n\n" .
        "detalle_pago.usuario_id = usuarios.usuario_id) LEFT JOIN bancos ON\n\n" .
        "detalle_pago.banco_id = bancos.banco_id) LEFT JOIN previsiones ON\n\n" .
        "detalle_pago.prevision_id = previsiones.prevision_id";
        $this->SQL = "SELECT detalle_pago.*, nom_forma_pago, nom_usuario, nom_banco, nom_prevision \n\n" .
        "FROM (((detalle_pago LEFT JOIN formas_pago ON\n\n" .
        "detalle_pago.forma_pago_id = formas_pago.forma_pago_id) LEFT JOIN usuarios ON\n\n" .
        "detalle_pago.usuario_id = usuarios.usuario_id) LEFT JOIN bancos ON\n\n" .
        "detalle_pago.banco_id = bancos.banco_id) LEFT JOIN previsiones ON\n\n" .
        "detalle_pago.prevision_id = previsiones.prevision_id {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @37-72D8FEE8
    function SetValues()
    {
        $this->fecha_ingreso->SetDBValue(trim($this->f("fecha_ingreso")));
        $this->nom_forma_pago->SetDBValue($this->f("nom_forma_pago"));
        $this->nom_banco->SetDBValue($this->f("nom_banco"));
        $this->nom_prevision->SetDBValue($this->f("nom_prevision"));
        $this->fecha_documento->SetDBValue(trim($this->f("fecha_documento")));
        $this->num_cheque_bono->SetDBValue($this->f("num_cheque_bono"));
        $this->valor->SetDBValue(trim($this->f("valor")));
        $this->nom_usuario->SetDBValue($this->f("nom_usuario"));
    }
//End SetValues Method

} //End detalle_pago_formas_pagoDataSource Class @37-FCB6E20C

//Include Page implementation @35-3294FEB1
include_once(RelativePath . "/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-763015D2
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
$TemplateFileName = "add_pago_peticion.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-51A1B968
include_once("./add_pago_peticion_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-DE55E0AE
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$detalle_pago = new clsRecorddetalle_pago("", $MainPage);
$detalle_pago_formas_pago = new clsGriddetalle_pago_formas_pago("", $MainPage);
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$MainPage->detalle_pago = & $detalle_pago;
$MainPage->detalle_pago_formas_pago = & $detalle_pago_formas_pago;
$MainPage->calendar_tag = & $calendar_tag;
$detalle_pago->Initialize();
$detalle_pago_formas_pago->Initialize();
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

//Execute Components @1-14C60BCD
$calendar_tag->Operations();
$detalle_pago->Operation();
//End Execute Components

//Go to destination page @1-8AEA8D9A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($detalle_pago);
    unset($detalle_pago_formas_pago);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-382F0A74
$detalle_pago->Show();
$detalle_pago_formas_pago->Show();
$calendar_tag->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C126E79E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($detalle_pago);
unset($detalle_pago_formas_pago);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($Tpl);
//End Unload Page


?>
