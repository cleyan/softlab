<?php
//Include Common Files @1-6ECA52A2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "win_add_paciente.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordpacientes { //pacientes Class @2-633F8F80

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

//Class_Initialize Event @2-614D0A1F
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
        $this->Visible = (CCSecurityAccessCheck("4;5;12;13;14;15;16;17;18;20") == "success");
        if($this->Visible)
        {
            $this->ReadAllowed = $this->ReadAllowed && CCUserInGroups(CCGetGroupID(), "4;5;12;13;14;15;16;17;18;20");
            $this->InsertAllowed = CCUserInGroups(CCGetGroupID(), "4;5;12;13;14;15;16;17;18;20");
            $this->UpdateAllowed = CCUserInGroups(CCGetGroupID(), "4;5;12;13;14;15;16;17;18;20");
            $this->DeleteAllowed = CCUserInGroups(CCGetGroupID(), "16;17;18;20");
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
            $this->rut = new clsControl(ccsTextBox, "rut", "R.U.T.", ccsText, "", CCGetRequestParam("rut", $Method, NULL), $this);
            $this->ficha = new clsControl(ccsTextBox, "ficha", "Ficha", ccsText, "", CCGetRequestParam("ficha", $Method, NULL), $this);
            $this->nombres = new clsControl(ccsTextBox, "nombres", "Nombres", ccsText, "", CCGetRequestParam("nombres", $Method, NULL), $this);
            $this->nombres->Required = true;
            $this->apellidos = new clsControl(ccsTextBox, "apellidos", "Apellidos", ccsText, "", CCGetRequestParam("apellidos", $Method, NULL), $this);
            $this->apellidos->Required = true;
            $this->direccion = new clsControl(ccsTextBox, "direccion", "direccion", ccsText, "", CCGetRequestParam("direccion", $Method, NULL), $this);
            $this->fono = new clsControl(ccsTextBox, "fono", "fono", ccsText, "", CCGetRequestParam("fono", $Method, NULL), $this);
            $this->celular = new clsControl(ccsTextBox, "celular", "celular", ccsText, "", CCGetRequestParam("celular", $Method, NULL), $this);
            $this->ciudad = new clsControl(ccsTextBox, "ciudad", "ciudad", ccsText, "", CCGetRequestParam("ciudad", $Method, NULL), $this);
            $this->email = new clsControl(ccsTextBox, "email", "email", ccsText, "", CCGetRequestParam("email", $Method, NULL), $this);
            $this->fecha_nacimiento = new clsControl(ccsTextBox, "fecha_nacimiento", "Fecha Nacimiento", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("fecha_nacimiento", $Method, NULL), $this);
            $this->fecha_nacimiento->Required = true;
            $this->edad_calc = new clsControl(ccsLabel, "edad_calc", "edad_calc", ccsText, "", CCGetRequestParam("edad_calc", $Method, NULL), $this);
            $this->edad = new clsControl(ccsTextBox, "edad", "edad", ccsText, "", CCGetRequestParam("edad", $Method, NULL), $this);
            $this->sexo_id = new clsControl(ccsListBox, "sexo_id", "Sexo", ccsInteger, "", CCGetRequestParam("sexo_id", $Method, NULL), $this);
            $this->sexo_id->DSType = dsTable;
            $this->sexo_id->DataSource = new clsDBDatos();
            $this->sexo_id->ds = & $this->sexo_id->DataSource;
            $this->sexo_id->DataSource->SQL = "SELECT * \n" .
"FROM sexos {SQL_Where} {SQL_OrderBy}";
            list($this->sexo_id->BoundColumn, $this->sexo_id->TextColumn, $this->sexo_id->DBFormat) = array("sexo_id", "nom_sexo", "");
            $this->sexo_id->Required = true;
            $this->prevision_id = new clsControl(ccsListBox, "prevision_id", "Prevision", ccsInteger, "", CCGetRequestParam("prevision_id", $Method, NULL), $this);
            $this->prevision_id->DSType = dsTable;
            $this->prevision_id->DataSource = new clsDBDatos();
            $this->prevision_id->ds = & $this->prevision_id->DataSource;
            $this->prevision_id->DataSource->SQL = "SELECT * \n" .
"FROM previsiones {SQL_Where} {SQL_OrderBy}";
            $this->prevision_id->DataSource->Order = "nom_prevision";
            list($this->prevision_id->BoundColumn, $this->prevision_id->TextColumn, $this->prevision_id->DBFormat) = array("prevision_id", "nom_prevision", "");
            $this->prevision_id->DataSource->Parameters["expr17"] = 'V';
            $this->prevision_id->DataSource->wp = new clsSQLParameters();
            $this->prevision_id->DataSource->wp->AddParameter("1", "expr17", ccsText, "", "", $this->prevision_id->DataSource->Parameters["expr17"], "", false);
            $this->prevision_id->DataSource->wp->Criterion[1] = $this->prevision_id->DataSource->wp->Operation(opEqual, "activo", $this->prevision_id->DataSource->wp->GetDBValue("1"), $this->prevision_id->DataSource->ToSQL($this->prevision_id->DataSource->wp->GetDBValue("1"), ccsText),false);
            $this->prevision_id->DataSource->Where = 
                 $this->prevision_id->DataSource->wp->Criterion[1];
            $this->prevision_id->DataSource->Order = "nom_prevision";
            $this->prevision_id->Required = true;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-26EB49A0
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlpaciente_id"] = CCGetFromGet("paciente_id", NULL);
    }
//End Initialize Method

//Validate Method @2-B8FF99DA
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->rut->SetValue($this->rut->GetValue());
        if(CCDLookUp("COUNT(*)", "pacientes", "rut=" . $this->DataSource->ToSQL($this->DataSource->rut->GetDBValue(), $this->DataSource->rut->DataType) . $Where, $this->DataSource) > 0)
            $this->rut->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "R.U.T."));
        if(strlen($this->email->GetText()) && !preg_match ("/^[\w\.-]{1,}\@([\da-zA-Z-]{1,}\.){1,}[\da-zA-Z-]+$/", $this->email->GetText())) {
            $this->email->Errors->addError($CCSLocales->GetText("CCS_MaskValidation", "email"));
        }
        $Validation = ($this->rut->Validate() && $Validation);
        $Validation = ($this->ficha->Validate() && $Validation);
        $Validation = ($this->nombres->Validate() && $Validation);
        $Validation = ($this->apellidos->Validate() && $Validation);
        $Validation = ($this->direccion->Validate() && $Validation);
        $Validation = ($this->fono->Validate() && $Validation);
        $Validation = ($this->celular->Validate() && $Validation);
        $Validation = ($this->ciudad->Validate() && $Validation);
        $Validation = ($this->email->Validate() && $Validation);
        $Validation = ($this->fecha_nacimiento->Validate() && $Validation);
        $Validation = ($this->edad->Validate() && $Validation);
        $Validation = ($this->sexo_id->Validate() && $Validation);
        $Validation = ($this->prevision_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->rut->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ficha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nombres->Errors->Count() == 0);
        $Validation =  $Validation && ($this->apellidos->Errors->Count() == 0);
        $Validation =  $Validation && ($this->direccion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fono->Errors->Count() == 0);
        $Validation =  $Validation && ($this->celular->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ciudad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha_nacimiento->Errors->Count() == 0);
        $Validation =  $Validation && ($this->edad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->sexo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->prevision_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-66391883
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->rut->Errors->Count());
        $errors = ($errors || $this->ficha->Errors->Count());
        $errors = ($errors || $this->nombres->Errors->Count());
        $errors = ($errors || $this->apellidos->Errors->Count());
        $errors = ($errors || $this->direccion->Errors->Count());
        $errors = ($errors || $this->fono->Errors->Count());
        $errors = ($errors || $this->celular->Errors->Count());
        $errors = ($errors || $this->ciudad->Errors->Count());
        $errors = ($errors || $this->email->Errors->Count());
        $errors = ($errors || $this->fecha_nacimiento->Errors->Count());
        $errors = ($errors || $this->edad_calc->Errors->Count());
        $errors = ($errors || $this->edad->Errors->Count());
        $errors = ($errors || $this->sexo_id->Errors->Count());
        $errors = ($errors || $this->prevision_id->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-8705AECE
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
            }
        }
        $Redirect = "frmBuscarPaciente.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete" && $this->DeleteAllowed) {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert" && $this->InsertAllowed) {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update" && $this->UpdateAllowed) {
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

//InsertRow Method @2-CABEA307
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->rut->SetValue($this->rut->GetValue(true));
        $this->DataSource->ficha->SetValue($this->ficha->GetValue(true));
        $this->DataSource->nombres->SetValue($this->nombres->GetValue(true));
        $this->DataSource->apellidos->SetValue($this->apellidos->GetValue(true));
        $this->DataSource->direccion->SetValue($this->direccion->GetValue(true));
        $this->DataSource->fono->SetValue($this->fono->GetValue(true));
        $this->DataSource->celular->SetValue($this->celular->GetValue(true));
        $this->DataSource->ciudad->SetValue($this->ciudad->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->fecha_nacimiento->SetValue($this->fecha_nacimiento->GetValue(true));
        $this->DataSource->edad_calc->SetValue($this->edad_calc->GetValue(true));
        $this->DataSource->edad->SetValue($this->edad->GetValue(true));
        $this->DataSource->sexo_id->SetValue($this->sexo_id->GetValue(true));
        $this->DataSource->prevision_id->SetValue($this->prevision_id->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-12F4A7A4
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->rut->SetValue($this->rut->GetValue(true));
        $this->DataSource->ficha->SetValue($this->ficha->GetValue(true));
        $this->DataSource->nombres->SetValue($this->nombres->GetValue(true));
        $this->DataSource->apellidos->SetValue($this->apellidos->GetValue(true));
        $this->DataSource->direccion->SetValue($this->direccion->GetValue(true));
        $this->DataSource->fono->SetValue($this->fono->GetValue(true));
        $this->DataSource->celular->SetValue($this->celular->GetValue(true));
        $this->DataSource->ciudad->SetValue($this->ciudad->GetValue(true));
        $this->DataSource->email->SetValue($this->email->GetValue(true));
        $this->DataSource->fecha_nacimiento->SetValue($this->fecha_nacimiento->GetValue(true));
        $this->DataSource->edad_calc->SetValue($this->edad_calc->GetValue(true));
        $this->DataSource->edad->SetValue($this->edad->GetValue(true));
        $this->DataSource->sexo_id->SetValue($this->sexo_id->GetValue(true));
        $this->DataSource->prevision_id->SetValue($this->prevision_id->GetValue(true));
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

//Show Method @2-A6ECBE9B
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

        $this->sexo_id->Prepare();
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
                    $this->rut->SetValue($this->DataSource->rut->GetValue());
                    $this->ficha->SetValue($this->DataSource->ficha->GetValue());
                    $this->nombres->SetValue($this->DataSource->nombres->GetValue());
                    $this->apellidos->SetValue($this->DataSource->apellidos->GetValue());
                    $this->direccion->SetValue($this->DataSource->direccion->GetValue());
                    $this->fono->SetValue($this->DataSource->fono->GetValue());
                    $this->celular->SetValue($this->DataSource->celular->GetValue());
                    $this->ciudad->SetValue($this->DataSource->ciudad->GetValue());
                    $this->email->SetValue($this->DataSource->email->GetValue());
                    $this->fecha_nacimiento->SetValue($this->DataSource->fecha_nacimiento->GetValue());
                    $this->edad->SetValue($this->DataSource->edad->GetValue());
                    $this->sexo_id->SetValue($this->DataSource->sexo_id->GetValue());
                    $this->prevision_id->SetValue($this->DataSource->prevision_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->rut->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ficha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nombres->Errors->ToString());
            $Error = ComposeStrings($Error, $this->apellidos->Errors->ToString());
            $Error = ComposeStrings($Error, $this->direccion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fono->Errors->ToString());
            $Error = ComposeStrings($Error, $this->celular->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ciudad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha_nacimiento->Errors->ToString());
            $Error = ComposeStrings($Error, $this->edad_calc->Errors->ToString());
            $Error = ComposeStrings($Error, $this->edad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->sexo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->prevision_id->Errors->ToString());
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

        $this->rut->Show();
        $this->ficha->Show();
        $this->nombres->Show();
        $this->apellidos->Show();
        $this->direccion->Show();
        $this->fono->Show();
        $this->celular->Show();
        $this->ciudad->Show();
        $this->email->Show();
        $this->fecha_nacimiento->Show();
        $this->edad_calc->Show();
        $this->edad->Show();
        $this->sexo_id->Show();
        $this->prevision_id->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End pacientes Class @2-FCB6E20C

class clspacientesDataSource extends clsDBDatos {  //pacientesDataSource Class @2-BFE569F0

//DataSource Variables @2-14C8D702
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
    public $rut;
    public $ficha;
    public $nombres;
    public $apellidos;
    public $direccion;
    public $fono;
    public $celular;
    public $ciudad;
    public $email;
    public $fecha_nacimiento;
    public $edad_calc;
    public $edad;
    public $sexo_id;
    public $prevision_id;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-72DBA32D
    function clspacientesDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record pacientes/Error";
        $this->Initialize();
        $this->rut = new clsField("rut", ccsText, "");
        
        $this->ficha = new clsField("ficha", ccsText, "");
        
        $this->nombres = new clsField("nombres", ccsText, "");
        
        $this->apellidos = new clsField("apellidos", ccsText, "");
        
        $this->direccion = new clsField("direccion", ccsText, "");
        
        $this->fono = new clsField("fono", ccsText, "");
        
        $this->celular = new clsField("celular", ccsText, "");
        
        $this->ciudad = new clsField("ciudad", ccsText, "");
        
        $this->email = new clsField("email", ccsText, "");
        
        $this->fecha_nacimiento = new clsField("fecha_nacimiento", ccsDate, array("yyyy", "-", "mm", "-", "dd", " ", "HH", ":", "nn", ":", "ss"));
        
        $this->edad_calc = new clsField("edad_calc", ccsText, "");
        
        $this->edad = new clsField("edad", ccsText, "");
        
        $this->sexo_id = new clsField("sexo_id", ccsInteger, "");
        
        $this->prevision_id = new clsField("prevision_id", ccsInteger, "");
        

        $this->InsertFields["rut"] = array("Name" => "rut", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ficha"] = array("Name" => "ficha", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["nombres"] = array("Name" => "nombres", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["apellidos"] = array("Name" => "apellidos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["direccion"] = array("Name" => "direccion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fono"] = array("Name" => "fono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["celular"] = array("Name" => "celular", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ciudad"] = array("Name" => "ciudad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["fecha_nacimiento"] = array("Name" => "fecha_nacimiento", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["edad"] = array("Name" => "edad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["sexo_id"] = array("Name" => "sexo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["prevision_id"] = array("Name" => "prevision_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["rut"] = array("Name" => "rut", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ficha"] = array("Name" => "ficha", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["nombres"] = array("Name" => "nombres", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["apellidos"] = array("Name" => "apellidos", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["direccion"] = array("Name" => "direccion", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fono"] = array("Name" => "fono", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["celular"] = array("Name" => "celular", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ciudad"] = array("Name" => "ciudad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["email"] = array("Name" => "email", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["fecha_nacimiento"] = array("Name" => "fecha_nacimiento", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["edad"] = array("Name" => "edad", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["sexo_id"] = array("Name" => "sexo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["prevision_id"] = array("Name" => "prevision_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-D1AD7AEC
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

//Open Method @2-D16C1DEA
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

//SetValues Method @2-622C11DA
    function SetValues()
    {
        $this->rut->SetDBValue($this->f("rut"));
        $this->ficha->SetDBValue($this->f("ficha"));
        $this->nombres->SetDBValue($this->f("nombres"));
        $this->apellidos->SetDBValue($this->f("apellidos"));
        $this->direccion->SetDBValue($this->f("direccion"));
        $this->fono->SetDBValue($this->f("fono"));
        $this->celular->SetDBValue($this->f("celular"));
        $this->ciudad->SetDBValue($this->f("ciudad"));
        $this->email->SetDBValue($this->f("email"));
        $this->fecha_nacimiento->SetDBValue(trim($this->f("fecha_nacimiento")));
        $this->edad->SetDBValue($this->f("edad"));
        $this->sexo_id->SetDBValue(trim($this->f("sexo_id")));
        $this->prevision_id->SetDBValue(trim($this->f("prevision_id")));
    }
//End SetValues Method

//Insert Method @2-49C2972D
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["rut"]["Value"] = $this->rut->GetDBValue(true);
        $this->InsertFields["ficha"]["Value"] = $this->ficha->GetDBValue(true);
        $this->InsertFields["nombres"]["Value"] = $this->nombres->GetDBValue(true);
        $this->InsertFields["apellidos"]["Value"] = $this->apellidos->GetDBValue(true);
        $this->InsertFields["direccion"]["Value"] = $this->direccion->GetDBValue(true);
        $this->InsertFields["fono"]["Value"] = $this->fono->GetDBValue(true);
        $this->InsertFields["celular"]["Value"] = $this->celular->GetDBValue(true);
        $this->InsertFields["ciudad"]["Value"] = $this->ciudad->GetDBValue(true);
        $this->InsertFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->InsertFields["fecha_nacimiento"]["Value"] = $this->fecha_nacimiento->GetDBValue(true);
        $this->InsertFields["edad"]["Value"] = $this->edad->GetDBValue(true);
        $this->InsertFields["sexo_id"]["Value"] = $this->sexo_id->GetDBValue(true);
        $this->InsertFields["prevision_id"]["Value"] = $this->prevision_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("pacientes", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-BF09C017
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["rut"]["Value"] = $this->rut->GetDBValue(true);
        $this->UpdateFields["ficha"]["Value"] = $this->ficha->GetDBValue(true);
        $this->UpdateFields["nombres"]["Value"] = $this->nombres->GetDBValue(true);
        $this->UpdateFields["apellidos"]["Value"] = $this->apellidos->GetDBValue(true);
        $this->UpdateFields["direccion"]["Value"] = $this->direccion->GetDBValue(true);
        $this->UpdateFields["fono"]["Value"] = $this->fono->GetDBValue(true);
        $this->UpdateFields["celular"]["Value"] = $this->celular->GetDBValue(true);
        $this->UpdateFields["ciudad"]["Value"] = $this->ciudad->GetDBValue(true);
        $this->UpdateFields["email"]["Value"] = $this->email->GetDBValue(true);
        $this->UpdateFields["fecha_nacimiento"]["Value"] = $this->fecha_nacimiento->GetDBValue(true);
        $this->UpdateFields["edad"]["Value"] = $this->edad->GetDBValue(true);
        $this->UpdateFields["sexo_id"]["Value"] = $this->sexo_id->GetDBValue(true);
        $this->UpdateFields["prevision_id"]["Value"] = $this->prevision_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("pacientes", $this->UpdateFields, $this);
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

//Delete Method @2-FF306EC8
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM pacientes";
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

} //End pacientesDataSource Class @2-FCB6E20C

//Initialize Page @1-91734FAB
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
$TemplateFileName = "win_add_paciente.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "./";
$PathToRootOpt = "";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Include events file @1-B1C05337
include_once("./win_add_paciente_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-FC1D39FF
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$pacientes = new clsRecordpacientes("", $MainPage);
$ImageLink1 = new clsControl(ccsImageLink, "ImageLink1", "ImageLink1", ccsText, "", CCGetRequestParam("ImageLink1", ccsGet, NULL), $MainPage);
$ImageLink1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
$ImageLink1->Page = "#";
$MainPage->pacientes = & $pacientes;
$MainPage->ImageLink1 = & $ImageLink1;
$pacientes->Initialize();
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

//Execute Components @1-BA05631C
$pacientes->Operation();
//End Execute Components

//Go to destination page @1-478AC2B9
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($pacientes);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-052414ED
$pacientes->Show();
$ImageLink1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BE810F2E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($pacientes);
unset($Tpl);
//End Unload Page


?>
