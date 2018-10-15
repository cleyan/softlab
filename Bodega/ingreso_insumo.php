<?php
//Include Common Files @1-1E41C332
define("RelativePath", "..");
define("PathToCurrentPage", "/Bodega/");
define("FileName", "ingreso_insumo.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordinsumos_ingreso { //insumos_ingreso Class @2-F6043B0E

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

//Class_Initialize Event @2-F1E7EEA8
    function clsRecordinsumos_ingreso($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record insumos_ingreso/Error";
        $this->DataSource = new clsinsumos_ingresoDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "insumos_ingreso";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = explode(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->ingreso_insumo_id = new clsControl(ccsHidden, "ingreso_insumo_id", "Ingreso Insumo Id", ccsInteger, "", CCGetRequestParam("ingreso_insumo_id", $Method, NULL), $this);
            $this->nom_insumo = new clsControl(ccsHidden, "nom_insumo", "nom_insumo", ccsText, "", CCGetRequestParam("nom_insumo", $Method, NULL), $this);
            $this->last_insumo_id = new clsControl(ccsHidden, "last_insumo_id", "last_insumo_id", ccsText, "", CCGetRequestParam("last_insumo_id", $Method, NULL), $this);
            $this->insumo_id = new clsControl(ccsListBox, "insumo_id", "Insumo", ccsInteger, "", CCGetRequestParam("insumo_id", $Method, NULL), $this);
            $this->insumo_id->DSType = dsTable;
            $this->insumo_id->DataSource = new clsDBDatos();
            $this->insumo_id->ds = & $this->insumo_id->DataSource;
            $this->insumo_id->DataSource->SQL = "SELECT * \n" .
"FROM insumos {SQL_Where} {SQL_OrderBy}";
            list($this->insumo_id->BoundColumn, $this->insumo_id->TextColumn, $this->insumo_id->DBFormat) = array("insumo_id", "nom_insumo", "");
            $this->insumo_id->Required = true;
            $this->cantidad = new clsControl(ccsTextBox, "cantidad", "Cantidad", ccsInteger, "", CCGetRequestParam("cantidad", $Method, NULL), $this);
            $this->cantidad->Required = true;
            $this->fecha = new clsControl(ccsTextBox, "fecha", "Fecha", ccsDate, $DefaultDateFormat, CCGetRequestParam("fecha", $Method, NULL), $this);
            $this->fecha->Required = true;
            $this->descripcion = new clsControl(ccsTextArea, "descripcion", "Descripción", ccsMemo, "", CCGetRequestParam("descripcion", $Method, NULL), $this);
            $this->costo = new clsControl(ccsTextBox, "costo", "Costo", ccsFloat, "", CCGetRequestParam("costo", $Method, NULL), $this);
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->Button_Cancel = new clsButton("Button_Cancel", $Method, $this);
            if(!$this->FormSubmitted) {
                if(!is_array($this->fecha->Value) && !strlen($this->fecha->Value) && $this->fecha->Value !== false)
                    $this->fecha->SetText(GetFechaServer());
            }
        }
    }
//End Class_Initialize Event

//Initialize Method @2-8D63DE93
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlingreso_insumo_id"] = CCGetFromGet("ingreso_insumo_id", NULL);
    }
//End Initialize Method

//Validate Method @2-0E7575D5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ingreso_insumo_id->Validate() && $Validation);
        $Validation = ($this->nom_insumo->Validate() && $Validation);
        $Validation = ($this->last_insumo_id->Validate() && $Validation);
        $Validation = ($this->insumo_id->Validate() && $Validation);
        $Validation = ($this->cantidad->Validate() && $Validation);
        $Validation = ($this->fecha->Validate() && $Validation);
        $Validation = ($this->descripcion->Validate() && $Validation);
        $Validation = ($this->costo->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ingreso_insumo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->nom_insumo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->last_insumo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->insumo_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->cantidad->Errors->Count() == 0);
        $Validation =  $Validation && ($this->fecha->Errors->Count() == 0);
        $Validation =  $Validation && ($this->descripcion->Errors->Count() == 0);
        $Validation =  $Validation && ($this->costo->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-5210B3FA
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ingreso_insumo_id->Errors->Count());
        $errors = ($errors || $this->nom_insumo->Errors->Count());
        $errors = ($errors || $this->last_insumo_id->Errors->Count());
        $errors = ($errors || $this->insumo_id->Errors->Count());
        $errors = ($errors || $this->cantidad->Errors->Count());
        $errors = ($errors || $this->fecha->Errors->Count());
        $errors = ($errors || $this->descripcion->Errors->Count());
        $errors = ($errors || $this->costo->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @2-80F5195C
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
        $Redirect = "list_ingreso_insumos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "list_ingreso_insumos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ingreso_insumo_id"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Button_Cancel") {
            $Redirect = "list_ingreso_insumos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ingreso_insumo_id"));
            if(!CCGetEvent($this->Button_Cancel->CCSEvents, "OnClick", $this->Button_Cancel)) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "list_ingreso_insumos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "list_ingreso_insumos.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "ingreso_insumo_id"));
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

//InsertRow Method @2-BBFF6E20
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ingreso_insumo_id->SetValue($this->ingreso_insumo_id->GetValue(true));
        $this->DataSource->nom_insumo->SetValue($this->nom_insumo->GetValue(true));
        $this->DataSource->last_insumo_id->SetValue($this->last_insumo_id->GetValue(true));
        $this->DataSource->insumo_id->SetValue($this->insumo_id->GetValue(true));
        $this->DataSource->cantidad->SetValue($this->cantidad->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->descripcion->SetValue($this->descripcion->GetValue(true));
        $this->DataSource->costo->SetValue($this->costo->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-DA67E91A
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ingreso_insumo_id->SetValue($this->ingreso_insumo_id->GetValue(true));
        $this->DataSource->nom_insumo->SetValue($this->nom_insumo->GetValue(true));
        $this->DataSource->last_insumo_id->SetValue($this->last_insumo_id->GetValue(true));
        $this->DataSource->insumo_id->SetValue($this->insumo_id->GetValue(true));
        $this->DataSource->cantidad->SetValue($this->cantidad->GetValue(true));
        $this->DataSource->fecha->SetValue($this->fecha->GetValue(true));
        $this->DataSource->descripcion->SetValue($this->descripcion->GetValue(true));
        $this->DataSource->costo->SetValue($this->costo->GetValue(true));
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

//Show Method @2-94A12C4F
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

        $this->insumo_id->Prepare();

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
                    $this->ingreso_insumo_id->SetValue($this->DataSource->ingreso_insumo_id->GetValue());
                    $this->insumo_id->SetValue($this->DataSource->insumo_id->GetValue());
                    $this->cantidad->SetValue($this->DataSource->cantidad->GetValue());
                    $this->fecha->SetValue($this->DataSource->fecha->GetValue());
                    $this->descripcion->SetValue($this->DataSource->descripcion->GetValue());
                    $this->costo->SetValue($this->DataSource->costo->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ingreso_insumo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->nom_insumo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->last_insumo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->insumo_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->cantidad->Errors->ToString());
            $Error = ComposeStrings($Error, $this->fecha->Errors->ToString());
            $Error = ComposeStrings($Error, $this->descripcion->Errors->ToString());
            $Error = ComposeStrings($Error, $this->costo->Errors->ToString());
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

        $this->ingreso_insumo_id->Show();
        $this->nom_insumo->Show();
        $this->last_insumo_id->Show();
        $this->insumo_id->Show();
        $this->cantidad->Show();
        $this->fecha->Show();
        $this->descripcion->Show();
        $this->costo->Show();
        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->Button_Cancel->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End insumos_ingreso Class @2-FCB6E20C

class clsinsumos_ingresoDataSource extends clsDBDatos {  //insumos_ingresoDataSource Class @2-3CDA2098

//DataSource Variables @2-2D15233C
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
    public $ingreso_insumo_id;
    public $nom_insumo;
    public $last_insumo_id;
    public $insumo_id;
    public $cantidad;
    public $fecha;
    public $descripcion;
    public $costo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C77E8434
    function clsinsumos_ingresoDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record insumos_ingreso/Error";
        $this->Initialize();
        $this->ingreso_insumo_id = new clsField("ingreso_insumo_id", ccsInteger, "");
        
        $this->nom_insumo = new clsField("nom_insumo", ccsText, "");
        
        $this->last_insumo_id = new clsField("last_insumo_id", ccsText, "");
        
        $this->insumo_id = new clsField("insumo_id", ccsInteger, "");
        
        $this->cantidad = new clsField("cantidad", ccsInteger, "");
        
        $this->fecha = new clsField("fecha", ccsDate, $this->DateFormat);
        
        $this->descripcion = new clsField("descripcion", ccsMemo, "");
        
        $this->costo = new clsField("costo", ccsFloat, "");
        

        $this->InsertFields["ingreso_insumo_id"] = array("Name" => "ingreso_insumo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["insumo_id"] = array("Name" => "insumo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["cantidad"] = array("Name" => "cantidad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["descripcion"] = array("Name" => "descripcion", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["costo"] = array("Name" => "costo", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["ingreso_insumo_id"] = array("Name" => "ingreso_insumo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["insumo_id"] = array("Name" => "insumo_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["cantidad"] = array("Name" => "cantidad", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["fecha"] = array("Name" => "fecha", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["descripcion"] = array("Name" => "descripcion", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["costo"] = array("Name" => "costo", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-C59AD89D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlingreso_insumo_id", ccsInteger, "", "", $this->Parameters["urlingreso_insumo_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ingreso_insumo_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-76ADFA5D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM insumos_ingreso {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-433F6C35
    function SetValues()
    {
        $this->ingreso_insumo_id->SetDBValue(trim($this->f("ingreso_insumo_id")));
        $this->insumo_id->SetDBValue(trim($this->f("insumo_id")));
        $this->cantidad->SetDBValue(trim($this->f("cantidad")));
        $this->fecha->SetDBValue(trim($this->f("fecha")));
        $this->descripcion->SetDBValue($this->f("descripcion"));
        $this->costo->SetDBValue(trim($this->f("costo")));
    }
//End SetValues Method

//Insert Method @2-85047832
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ingreso_insumo_id"]["Value"] = $this->ingreso_insumo_id->GetDBValue(true);
        $this->InsertFields["insumo_id"]["Value"] = $this->insumo_id->GetDBValue(true);
        $this->InsertFields["cantidad"]["Value"] = $this->cantidad->GetDBValue(true);
        $this->InsertFields["fecha"]["Value"] = $this->fecha->GetDBValue(true);
        $this->InsertFields["descripcion"]["Value"] = $this->descripcion->GetDBValue(true);
        $this->InsertFields["costo"]["Value"] = $this->costo->GetDBValue(true);
        $this->SQL = CCBuildInsert("insumos_ingreso", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-65B936B5
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ingreso_insumo_id"]["Value"] = $this->ingreso_insumo_id->GetDBValue(true);
        $this->UpdateFields["insumo_id"]["Value"] = $this->insumo_id->GetDBValue(true);
        $this->UpdateFields["cantidad"]["Value"] = $this->cantidad->GetDBValue(true);
        $this->UpdateFields["fecha"]["Value"] = $this->fecha->GetDBValue(true);
        $this->UpdateFields["descripcion"]["Value"] = $this->descripcion->GetDBValue(true);
        $this->UpdateFields["costo"]["Value"] = $this->costo->GetDBValue(true);
        $this->SQL = CCBuildUpdate("insumos_ingreso", $this->UpdateFields, $this);
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

//Delete Method @2-4928B04D
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM insumos_ingreso";
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

} //End insumos_ingresoDataSource Class @2-FCB6E20C

//Include Page implementation @25-07A1C36D
include_once(RelativePath . "/Bodega/calendar_tag.php");
//End Include Page implementation

//Initialize Page @1-F9FB3C3F
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
$TemplateFileName = "ingreso_insumo.html";
$BlockToParse = "main";
$TemplateEncoding = "ISO-8859-1";
$ContentType = "text/html";
$PathToRoot = "../";
$PathToRootOpt = "../";
$Scripts = "|js/jquery/jquery.js|js/jquery/event-manager.js|js/jquery/selectors.js|";
$Charset = $Charset ? $Charset : "iso-8859-1";
//End Initialize Page

//Authenticate User @1-1C6D62C5
CCSecurityRedirect("16;17;18;19;20", "error_nivel.php");
//End Authenticate User

//Include events file @1-67C91F3F
include_once("./ingreso_insumo_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A3646DCA
$DBDatos = new clsDBDatos();
$MainPage->Connections["Datos"] = & $DBDatos;
$Attributes = new clsAttributes("page:");
$Attributes->SetValue("pathToRoot", $PathToRoot);
$MainPage->Attributes = & $Attributes;

// Controls
$insumos_ingreso = new clsRecordinsumos_ingreso("", $MainPage);
$calendar_tag = new clscalendar_tag("", "calendar_tag", $MainPage);
$calendar_tag->Initialize();
$MainPage->insumos_ingreso = & $insumos_ingreso;
$MainPage->calendar_tag = & $calendar_tag;
$insumos_ingreso->Initialize();
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

//Initialize HTML Template @1-1D8FC0E6
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
$Attributes->SetValue("pathToRoot", "../");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-E2257C68
$calendar_tag->Operations();
$insumos_ingreso->Operation();
//End Execute Components

//Go to destination page @1-07E03F92
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBDatos->close();
    header("Location: " . $Redirect);
    unset($insumos_ingreso);
    $calendar_tag->Class_Terminate();
    unset($calendar_tag);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B32CDA46
$insumos_ingreso->Show();
$calendar_tag->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$main_block = CCConvertEncoding($main_block, $FileEncoding, $CCSLocales->GetFormatInfo("Encoding"));
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5654C142
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBDatos->close();
unset($insumos_ingreso);
$calendar_tag->Class_Terminate();
unset($calendar_tag);
unset($Tpl);
//End Unload Page


?>
